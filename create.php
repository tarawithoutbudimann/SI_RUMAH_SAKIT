<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$tanggal_layanan = $id_pasien = $id_dokter = $keluhan_awal = $username = "";
$tanggal_layanan_err = $id_pasien_err = $id_dokter_err = $keluhan_awal_err = $username_err = "";

// Set default timezone to WIB
date_default_timezone_set('Asia/Jakarta');

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate Tanggal Layanan
    $input_tanggal_layanan = trim($_POST["tanggal_layanan"]);
    if (empty($input_tanggal_layanan)) {
        $tanggal_layanan_err = "Please enter the Tanggal Layanan.";
    } else {
        $tanggal_layanan = $input_tanggal_layanan;
    }

    // Set Waktu Layanan to current time
    $waktu_layanan = date("H:i:s");

    // Validate ID Pasien
    $input_id_pasien = trim($_POST["id_pasien"]);
    if (empty($input_id_pasien)) {
        $id_pasien_err = "Please select an ID Pasien.";
    } else {
        $id_pasien = $input_id_pasien;
    }

    // Validate ID Dokter
    $input_id_dokter = trim($_POST["id_dokter"]);
    if (empty($input_id_dokter)) {
        $id_dokter_err = "Please select an ID Dokter.";
    } else {
        $id_dokter = $input_id_dokter;
    }

    // Validate Keluhan Awal
    $input_keluhan_awal = trim($_POST["keluhan_awal"]);
    if (empty($input_keluhan_awal)) {
        $keluhan_awal_err = "Please enter the Keluhan Awal.";
    } else {
        $keluhan_awal = $input_keluhan_awal;
    }

    // Validate Username
    $input_username = trim($_POST["username"]);
    if (empty($input_username)) {
        $username_err = "Please enter a Username.";
    } else {
        $username = $input_username;
    }

    // Check input errors before inserting in database
    if (empty($tanggal_layanan_err) && empty($id_pasien_err) && empty($id_dokter_err) && empty($keluhan_awal_err) && empty($username_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO resepsionis (Tanggal_Layanan, Waktu_Layanan, ID_Pasien, ID_Dokter, Keluhan_Awal, username) VALUES (?, ?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssss", $param_tanggal_layanan, $param_waktu_layanan, $param_id_pasien, $param_id_dokter, $param_keluhan_awal, $param_username);

            // Set parameters
            $param_tanggal_layanan = $tanggal_layanan;
            $param_waktu_layanan = $waktu_layanan;
            $param_id_pasien = $id_pasien;
            $param_id_dokter = $id_dokter;
            $param_keluhan_awal = $keluhan_awal;
            $param_username = $username;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records created successfully. Redirect to landing page
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
}

// Retrieve data for the dropdown - ID Pasien
$sql_pasien = "SELECT ID_Pasien, Nama_Pasien FROM pasien";
$result_pasien = mysqli_query($link, $sql_pasien);
$options_pasien = "";
while ($row_pasien = mysqli_fetch_array($result_pasien)) {
    $options_pasien .= "<option value='" . $row_pasien['ID_Pasien'] . "'>" . $row_pasien['ID_Pasien'] . " - " . $row_pasien['Nama_Pasien'] . "</option>";
}

// Retrieve data for the dropdown - ID Dokter
$sql_dokter = "SELECT dokter.ID_Dokter, dokter.Nama_Dokter, spesialis.Nama_Spesialis FROM dokter INNER JOIN spesialis ON dokter.ID_Spesialis = spesialis.ID_Spesialis";
$result_dokter = mysqli_query($link, $sql_dokter);
$options_dokter = "";
while ($row_dokter = mysqli_fetch_array($result_dokter)) {
    $options_dokter .= "<option value='" . $row_dokter['ID_Dokter'] . "'>" . $row_dokter['ID_Dokter'] . " - " . $row_dokter['Nama_Dokter'] . " - " . $row_dokter['Nama_Spesialis'] . "</option>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style type="text/css">
        .wrapper {
            width: 500px;
            margin: 0 auto;
        }
        .header {
            background-color: #333;
            display: flex;
            color: #fff;
            padding: 10px;
            text-align: center;
            flex-direction: column;
            gap: 10px;
            justify-content: center;
        }

        .header h1 {
            font-size: 24px;
            margin: 0;
        }
        .sidebar {
            background-color: #333;
            padding: 20px;
            height: 100%;
            width: 200px;
            position: fixed;
            left: 0;
            top: 0;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .sidebar li {
            margin-bottom: 10px;
        }
        .sidebar a {
            display: block;
            color: #fff;
            text-decoration: none;
        }
        
        .sidebar li a:hover {
            color: #000;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Tambah Kunjungan</h2>
                    </div>
                    <p>Silahkan isi form di bawah ini kemudian submit untuk menambahkan data kunjungan ke dalam database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($tanggal_layanan_err)) ? 'has-error' : ''; ?>">
                            <label>Tanggal Layanan</label>
                            <input type="date" name="tanggal_layanan" class="form-control" value="<?php echo $tanggal_layanan; ?>">
                            <span class="help-block"><?php echo $tanggal_layanan_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Waktu Layanan</label>
                            <input type="text" name="waktu_layanan" class="form-control" value="<?php echo date('H:i:s'); ?>" readonly>
                        </div>
                        <div class="form-group <?php echo (!empty($id_pasien_err)) ? 'has-error' : ''; ?>">
                            <label>ID Pasien</label>
                            <select name="id_pasien" class="form-control select2">
                                <option value="">Pilih ID Pasien</option>
                                <?php echo $options_pasien; ?>
                            </select>
                            <span class="help-block"><?php echo $id_pasien_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($id_dokter_err)) ? 'has-error' : ''; ?>">
                            <label>ID Dokter</label>
                            <select name="id_dokter" class="form-control select2">
                                <option value="">Pilih ID Dokter</option>
                                <?php echo $options_dokter; ?>
                            </select>
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
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                theme: 'bootstrap'
            });
        });
    </script>
</body>
</html>
