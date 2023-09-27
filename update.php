<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$tanggal_layanan = $waktu_layanan = $id_pasien = $id_dokter = $keluhan_awal = $username = $id_kunjungan = "";
$tanggal_layanan_err = $waktu_layanan_err = $id_pasien_err = $id_dokter_err = $keluhan_awal_err = $username_err = $id_kunjungan_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate Tanggal_Layanan
    $input_tanggal_layanan = trim($_POST["tanggal_layanan"]);
    if (empty($input_tanggal_layanan)) {
        $tanggal_layanan_err = "Please enter the date of service.";
    } else {
        $tanggal_layanan = $input_tanggal_layanan;
    }

    // Validate Waktu_Layanan
    $input_waktu_layanan = trim($_POST["waktu_layanan"]);
    if (empty($input_waktu_layanan)) {
        $waktu_layanan_err = "Please enter the time of service.";
    } else {
        $waktu_layanan = $input_waktu_layanan;
    }

    // Validate ID_Pasien
    $input_id_pasien = trim($_POST["id_pasien"]);
    if (empty($input_id_pasien)) {
        $id_pasien_err = "Please enter the patient ID.";
    } else {
        $id_pasien = $input_id_pasien;
    }

    // Validate ID_Dokter
    $input_id_dokter = trim($_POST["id_dokter"]);
    if (empty($input_id_dokter)) {
        $id_dokter_err = "Please enter the doctor ID.";
    } else {
        $id_dokter = $input_id_dokter;
    }

    // Validate Keluhan_Awal
    $input_keluhan_awal = trim($_POST["keluhan_awal"]);
    if (empty($input_keluhan_awal)) {
        $keluhan_awal_err = "Please enter the initial complaint.";
    } else {
        $keluhan_awal = $input_keluhan_awal;
    }

    // Validate Username
    $input_username = trim($_POST["username"]);
    if (empty($input_username)) {
        $username_err = "Please enter the username.";
    } else {
        $username = $input_username;
    }

    // Validate ID_Kunjungan
    $input_id_kunjungan = trim($_POST["id_kunjungan"]);
    if (empty($input_id_kunjungan)) {
        $id_kunjungan_err = "Please enter the visit ID.";
    } else {
        $id_kunjungan = $input_id_kunjungan;
    }

    // Check input errors before updating the database
    if (empty($tanggal_layanan_err) && empty($waktu_layanan_err) && empty($id_pasien_err) && empty($id_dokter_err) && empty($keluhan_awal_err) && empty($username_err) && empty($id_kunjungan_err)) {
        // Prepare an update statement
        $sql = "UPDATE resepsionis SET Tanggal_Layanan=?, Waktu_Layanan=?, ID_Pasien=?, ID_Dokter=?, Keluhan_Awal=?, username=? WHERE ID_Kunjungan=?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssi", $param_tanggal_layanan, $param_waktu_layanan, $param_id_pasien, $param_id_dokter, $param_keluhan_awal, $param_username, $param_id_kunjungan);

            // Set parameters
            $param_tanggal_layanan = $tanggal_layanan;
            $param_waktu_layanan = $waktu_layanan;
            $param_id_pasien = $id_pasien;
            $param_id_dokter = $id_dokter;
            $param_keluhan_awal = $keluhan_awal;
            $param_username = $username;
            $param_id_kunjungan = $id_kunjungan;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
} else {
    // Check existence of id parameter before processing further
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        // Get URL parameter
        $id_kunjungan = trim($_GET["id"]);

        // Prepare a select statement
        $sql = "SELECT * FROM resepsionis WHERE ID_Kunjungan = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id_kunjungan);

            // Set parameters
            $param_id_kunjungan = $id_kunjungan;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) == 1) {
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    // Retrieve individual field value
                    $tanggal_layanan = $row["Tanggal_Layanan"];
                    $waktu_layanan = $row["Waktu_Layanan"];
                    $id_pasien = $row["ID_Pasien"];
                    $id_dokter = $row["ID_Dokter"];
                    $keluhan_awal = $row["Keluhan_Awal"];
                    $username = $row["Username"];
                    $id_kunjungan = $row["id_kunjungan"];
                } else {
                    // URL doesn't contain a valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);

        // Close connection
        mysqli_close($link);
    } else {
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Update Record</h2>
                    </div>
                    <p>Please edit the input values and submit to update the record.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($tanggal_layanan_err)) ? 'has-error' : ''; ?>">
                            <label>Tanggal Layanan</label>
                            <input type="text" name="tanggal_layanan" class="form-control" value="<?php echo $tanggal_layanan; ?>">
                            <span class="help-block"><?php echo $tanggal_layanan_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($waktu_layanan_err)) ? 'has-error' : ''; ?>">
                            <label>Waktu Layanan</label>
                            <input type="text" name="waktu_layanan" class="form-control" value="<?php echo $waktu_layanan; ?>">
                            <span class="help-block"><?php echo $waktu_layanan_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($id_pasien_err)) ? 'has-error' : ''; ?>">
                            <label>ID Pasien</label>
                            <input type="text" name="id_pasien" class="form-control" value="<?php echo $id_pasien; ?>">
                            <span class="help-block"><?php echo $id_pasien_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($id_dokter_err)) ? 'has-error' : ''; ?>">
                            <label>ID Dokter</label>
                            <input type="text" name="id_dokter" class="form-control" value="<?php echo $id_dokter; ?>">
                            <span class="help-block"><?php echo $id_dokter_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($keluhan_awal_err)) ? 'has-error' : ''; ?>">
                            <label>Keluhan Awal</label>
                            <textarea name="keluhan_awal" class="form-control"><?php echo $keluhan_awal; ?></textarea>
                            <span class="help-block"><?php echo $keluhan_awal_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                            <span class="help-block"><?php echo $username_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($id_kunjungan_err)) ? 'has-error' : ''; ?>">
                            <label>ID Kunjungan</label>
                            <input type="text" name="id_kunjungan" class="form-control" value="<?php echo $id_kunjungan; ?>">
                            <span class="help-block"><?php echo $id_kunjungan_err; ?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id_kunjungan; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
