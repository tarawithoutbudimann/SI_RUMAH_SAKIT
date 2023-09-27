<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$ID_Pasien = $Nama_Pasien = $Jenis_Kelamin = $Agama = $Tempat_Lahir = $Tanggal_Lahir = $Golongan_Darah = $Domisili = $Kontak = "";
$ID_Pasien_err = $Nama_Pasien_err = $Jenis_Kelamin_err = $Agama_err = $Tempat_Lahir_err = $Tanggal_Lahir_err = $Golongan_Darah_err = $Domisili_err = $Kontak_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate ID Pasien
    $input_id_pasien = trim($_POST["id_pasien"]);
    if (empty($input_id_pasien)) {
        $ID_Pasien_err = "Silakan masukkan ID Pasien.";
    } else {
        $ID_Pasien = $input_id_pasien;
    }

    // Validate Nama Pasien
    $input_nama_pasien = trim($_POST["nama_pasien"]);
    if (empty($input_nama_pasien)) {
        $Nama_Pasien_err = "Silakan masukkan nama pasien.";
    } else {
        $Nama_Pasien = $input_nama_pasien;
    }

    // Validate Jenis Kelamin
    $input_jenis_kelamin = trim($_POST["jenis_kelamin"]);
    if (empty($input_jenis_kelamin)) {
        $Jenis_Kelamin_err = "Silakan pilih jenis kelamin.";
    } else {
        $Jenis_Kelamin = $input_jenis_kelamin;
    }

    // Validate Agama
    $input_agama = trim($_POST["agama"]);
    if (empty($input_agama)) {
        $Agama_err = "Silakan pilih agama.";
    } else {
        $Agama = $input_agama;
    }

    // Validate Tempat Lahir
    $input_tempat_lahir = trim($_POST["tempat_lahir"]);
    if (empty($input_tempat_lahir)) {
        $Tempat_Lahir_err = "Silakan masukkan tempat lahir.";
    } else {
        $Tempat_Lahir = $input_tempat_lahir;
    }

    // Validate Tanggal Lahir
    $input_tanggal_lahir = trim($_POST["tanggal_lahir"]);
    if (empty($input_tanggal_lahir)) {
        $Tanggal_Lahir_err = "Silakan masukkan tanggal lahir.";
    } else {
        $Tanggal_Lahir = $input_tanggal_lahir;
    }

    // Validate Golongan Darah
    $input_golongan_darah = trim($_POST["golongan_darah"]);
    if (empty($input_golongan_darah)) {
        $Golongan_Darah_err = "Silakan pilih golongan darah.";
    } else {
        $Golongan_Darah = $input_golongan_darah;
    }

    // Validate Domisili
    $input_domisili = trim($_POST["domisili"]);
    if (empty($input_domisili)) {
        $Domisili_err = "Silakan masukkan domisili.";
    } else {
        $Domisili = $input_domisili;
    }

    // Validate Kontak
    $input_kontak = trim($_POST["kontak"]);
    if (empty($input_kontak)) {
        $Kontak_err = "Silakan masukkan kontak.";
    } else {
        $Kontak = $input_kontak;
    }

    // Check input errors before inserting in database
    if (empty($ID_Pasien_err) && empty($Nama_Pasien_err) && empty($Jenis_Kelamin_err) && empty($Agama_err) && empty($Tempat_Lahir_err) && empty($Tanggal_Lahir_err) && empty($Golongan_Darah_err) && empty($Domisili_err) && empty($Kontak_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO pasien (ID_Pasien, Nama_Pasien, Jenis_Kelamin, Agama, Tempat_Lahir, Tanggal_Lahir, Golongan_Darah, Domisili, Kontak) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = $link ->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param(
                "sssssssss",
                $param_id_pasien,
                $param_nama_pasien,
                $param_jenis_kelamin,
                $param_agama,
                $param_tempat_lahir,
                $param_tanggal_lahir,
                $param_golongan_darah,
                $param_domisili,
                $param_kontak
            );

            // Set parameters
            $param_id_pasien = $ID_Pasien;
            $param_nama_pasien = $Nama_Pasien;
            $param_jenis_kelamin = $Jenis_Kelamin;
            $param_agama = $Agama;
            $param_tempat_lahir = $Tempat_Lahir;
            $param_tanggal_lahir = $Tanggal_Lahir;
            $param_golongan_darah = $Golongan_Darah;
            $param_domisili = $Domisili;
            $param_kontak = $Kontak;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Redirect to landing page
                header("location: index.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css">
    <style type="text/css">
        .wrapper {
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Create Pasien Record</h2>
        <p>Please fill this form and submit to add a new dokter record to the database.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($ID_Pasien_err)) ? 'has-error' : ''; ?>">
                <label>ID Pasien</label>
                <input type="text" name="id_pasien" class="form-control" value="<?php echo $ID_Pasien; ?>">
                <span class="help-block"><?php echo $ID_Pasien_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($Nama_Pasien_err)) ? 'has-error' : ''; ?>">
                <label>Nama Pasien</label>
                <input type="text" name="nama_pasien" class="form-control" value="<?php echo $Nama_Pasien; ?>">
                <span class="help-block"><?php echo $Nama_Pasien_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($jenis_kelamin_err)) ? 'has-error' : ''; ?>">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control">
                    <option value="">Pilih jenis kelamin</option>
                    <option value="Laki-laki" <?php echo ($Jenis_Kelamin === "Laki-laki") ? "selected" : ""; ?>>Laki-laki</option>
                    <option value="Perempuan" <?php echo ($Jenis_Kelamin === "Perempuan") ? "selected" : ""; ?>>Perempuan</option>
                </select>
                <span class="help-block"><?php echo $Jenis_Kelamin_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($Agama_err)) ? 'has-error' : ''; ?>">
                <label>Agama</label>
                <input type="text" name="agama" class="form-control" value="<?php echo $Agama; ?>">
                <span class="help-block"><?php echo $Agama_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($Tempat_Lahir_err)) ? 'has-error' : ''; ?>">
                <label>Tempat Lahir</label>
                <input type="text" name="tempat_lahir" class="form-control" value="<?php echo $Tempat_Lahir; ?>">
                <span class="help-block"><?php echo $Tempat_Lahir_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($Tanggal_Lahir_err)) ? 'has-error' : ''; ?>">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" value="<?php echo $Tanggal_Lahir; ?>">
                <span class="help-block"><?php echo $Tanggal_Lahir_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($Golongan_Darah_err)) ? 'has-error' : ''; ?>">
                <label>Golongan Darah</label>
                <input type="text" name="golongan_darah" class="form-control" value="<?php echo $Golongan_Darah; ?>">
                <span class="help-block"><?php echo $Golongan_Darah_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($Domisili_err)) ? 'has-error' : ''; ?>">
                <label>Domisili</label>
                <input type="text" name="domisili" class="form-control" value="<?php echo $Domisili; ?>">
                <span class="help-block"><?php echo $Domisili_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($Kontak_err)) ? 'has-error' : ''; ?>">
                <label>Kontak</label>
                <input type="text" name="kontak" class="form-control" value="<?php echo $Kontak; ?>">
                <span class="help-block"><?php echo $Kontak_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a href="index.php" class="btn btn-default">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
