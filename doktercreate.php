<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$id_dokter = $nama_dokter = $agama = $id_jadwal = $tempat_lahirdok = $tanggal_lahirdok = $domisili = $jenis_kelamin = $tarif_dokter = $id_spesialis = $kontak = "";
$id_dokter_err = $nama_dokter_err = $agama_err = $id_jadwal_err = $tempat_lahirdok_err = $tanggal_lahirdok_err = $domisili_err = $jenis_kelamin_err = $tarif_dokter_err = $id_spesialis_err = $kontak_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_id_dokter = trim($_POST["id_dokter"]);
    if (empty($input_id_dokter)) {
        $id_dokter_err = "Silakan masukkan id dokter.";
    } else {
        $id_dokter = $input_id_dokter;
    }

    // Validate Nama Dokter
    $input_nama_dokter = trim($_POST["nama_dokter"]);
    if (empty($input_nama_dokter)) {
        $nama_dokter_err = "Silakan masukkan nama dokter.";
    } else {
        $nama_dokter = $input_nama_dokter;
    }

    // Validate Agama
    $input_agama = trim($_POST["agama"]);
    if (empty($input_agama)) {
        $agama_err = "Silakan pilih agama.";
    } else {
        $agama = $input_agama;
    }

    // Validate ID Jadwal
    $input_id_jadwal = trim($_POST["id_jadwal"]);
    if (empty($input_id_jadwal)) {
        $id_jadwal_err = "Silakan masukkan ID Jadwal.";
    } else {
        $id_jadwal = $input_id_jadwal;
    }

    // Validate Tempat Lahir Dokter
    $input_tempat_lahirdok = trim($_POST["tempat_lahirdok"]);
    if (empty($input_tempat_lahirdok)) {
        $tempat_lahirdok_err = "Silakan masukkan tempat lahir dokter.";
    } else {
        $tempat_lahirdok = $input_tempat_lahirdok;
    }

    // Validate Tanggal Lahir Dokter
    $input_tanggal_lahirdok = trim($_POST["tanggal_lahirdok"]);
    if (empty($input_tanggal_lahirdok)) {
        $tanggal_lahirdok_err = "Silakan masukkan tanggal lahir dokter.";
    } else {
        $tanggal_lahirdok = $input_tanggal_lahirdok;
    }

    // Validate Domisili
    $input_domisili = trim($_POST["domisili"]);
    if (empty($input_domisili)) {
        $domisili_err = "Silakan masukkan domisili dokter.";
    } else {
        $domisili = $input_domisili;
    }

    // Validate Jenis Kelamin
    $input_jenis_kelamin = trim($_POST["jenis_kelamin"]);
    if (empty($input_jenis_kelamin)) {
        $jenis_kelamin_err = "Silakan pilih jenis kelamin.";
    } else {
        $jenis_kelamin = $input_jenis_kelamin;
    }

    // Validate Tarif Dokter
    $input_tarif_dokter = trim($_POST["tarif_dokter"]);
    if (empty($input_tarif_dokter)) {
        $tarif_dokter_err = "Silakan masukkan tarif dokter.";
    } else {
        $tarif_dokter = $input_tarif_dokter;
    }

    // Validate ID Spesialis
    $input_id_spesialis = trim($_POST["id_spesialis"]);
    if (empty($input_id_spesialis)) {
        $id_spesialis_err = "Silakan masukkan ID Spesialis.";
    } else {
        $id_spesialis = $input_id_spesialis;
    }

    // Validate Kontak
    $input_kontak = trim($_POST["kontak"]);
    if (empty($input_kontak)) {
        $kontak_err = "Silakan masukkan kontak dokter.";
    } else {
        $kontak = $input_kontak;
    }

    // Check input errors before inserting into database
    if (empty($id_dokter_err) && empty($nama_dokter_err) && empty($agama_err) && empty($id_jadwal_err) && empty($tempat_lahirdok_err) && empty($tanggal_lahirdok_err) && empty($domisili_err) && empty($jenis_kelamin_err) && empty($tarif_dokter_err) && empty($id_spesialis_err) && empty($kontak_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO dokter (id_dokter, nama_dokter, agama, id_jadwal, tempat_lahirdok, tanggal_lahirdok, domisili, jenis_kelamin, tarif_dokter, id_spesialis, kontak) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sssssssssss", $param_id_dokter, $param_nama_dokter, $param_agama, $param_id_jadwal, $param_tempat_lahirdok, $param_tanggal_lahirdok, $param_domisili, $param_jenis_kelamin, $param_tarif_dokter, $param_id_spesialis, $param_kontak);

            // Set parameters
            $param_id_dokter = $id_dokter;
            $param_nama_dokter = $nama_dokter;
            $param_agama = $agama;
            $param_id_jadwal = $id_jadwal;
            $param_tempat_lahirdok = $tempat_lahirdok;
            $param_tanggal_lahirdok = $tanggal_lahirdok;
            $param_domisili = $domisili;
            $param_jenis_kelamin = $jenis_kelamin;
            $param_tarif_dokter = $tarif_dokter;
            $param_id_spesialis = $id_spesialis;
            $param_kontak = $kontak;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Redirect to landing page
                header("location: index.php");
                exit();
            } else {
                echo "Oops! Terjadi kesalahan. Silakan coba lagi nanti.";
            }
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $mysqli->close();
}


// Retrieve data for the dropdown - ID Spesialis
$sql_spesialis= "SELECT ID_Spesialis, Nama_Spesialis FROM spesialis";
$result_spesialis = mysqli_query($link, $sql_spesialis);
$options_spesialis = "";
while ($row_spesialis = mysqli_fetch_array($result_spesialis)) {
    $options_spesialis .= "<option value='" . $row_spesialis['ID_Spesialis'] . "'>" . $row_spesialis['ID_Spesialis'] . " - " . $row_spesialis['Nama_Spesialis'] . "</option>";
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record Doctor</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style type="text/css">
        .wrapper {
            
            width: 500px;
            margin: 0 auto;
        }
        .modal-content {
            padding: 20px;
        }
    </style>
</head>
<body>
        <p>Please fill this form and submit to add a new dokter record to the database.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($id_dokter_err)) ? 'has-error' : ''; ?>">
                <label>ID Dokter</label>
                <input type="text" name="id_dokter" class="form-control" value="<?php echo $id_dokter; ?>">
                <span class="help-block"><?php echo $id_dokter_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($nama_dokter_err)) ? 'has-error' : ''; ?>">
                <label>Nama Dokter</label>
                <input type="text" name="nama_dokter" class="form-control" value="<?php echo $nama_dokter; ?>">
                <span class="help-block"><?php echo $nama_dokter_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($agama_err)) ? 'has-error' : ''; ?>">
                <label>Agama</label>
                <input type="text" name="agama" class="form-control" value="<?php echo $agama; ?>">
                <span class="help-block"><?php echo $agama_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($id_jadwal_err)) ? 'has-error' : ''; ?>">
                <label>ID Jadwal</label>
                <input type="text" name="id_jadwal" class="form-control" value="<?php echo $id_jadwal; ?>">
                <span class="help-block"><?php echo $id_jadwal_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($tempat_lahirdok_err)) ? 'has-error' : ''; ?>">
                <label>Tempat Lahir Dokter</label>
                <input type="text" name="tempat_lahirdok" class="form-control" value="<?php echo $tempat_lahirdok; ?>">
                <span class="help-block"><?php echo $tempat_lahirdok_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($tanggal_lahirdok_err)) ? 'has-error' : ''; ?>">
                <label>Tanggal Lahir Dokter</label>
                <input type="date" name="tanggal_lahirdok" class="form-control" value="<?php echo $tanggal_lahirdok; ?>">
                <span class="help-block"><?php echo $tanggal_lahirdok_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($domisili_err)) ? 'has-error' : ''; ?>">
                <label>Domisili</label>
                <input type="text" name="domisili" class="form-control" value="<?php echo $domisili; ?>">
                <span class="help-block"><?php echo $domisili_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($jenis_kelamin_err)) ? 'has-error' : ''; ?>">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control">
                    <option value="">Pilih jenis kelamin</option>
                    <option value="Laki-laki" <?php echo ($jenis_kelamin === "Laki-laki") ? "selected" : ""; ?>>Laki-laki</option>
                    <option value="Perempuan" <?php echo ($jenis_kelamin === "Perempuan") ? "selected" : ""; ?>>Perempuan</option>
                </select>
                <span class="help-block"><?php echo $jenis_kelamin_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($tarif_dokter_err)) ? 'has-error' : ''; ?>">
                <label>Tarif Dokter</label>
                <input type="text" name="tarif_dokter" class="form-control" value="<?php echo $tarif_dokter; ?>">
                <span class="help-block"><?php echo $tarif_dokter_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($id_spesialis_err)) ? 'has-error' : ''; ?>">
                <label>ID Spesialis</label>
                <select name="id_spesialis" class="form-control select2">
                    <option value="">Pilih ID Spesialis</option>
                        <?php echo $options_spesialis; ?>
                </select>
                <span class="help-block"><?php echo $id_spesialis_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($kontak_err)) ? 'has-error' : ''; ?>">
                <label>Kontak</label>
                <input type="text" name="kontak" class="form-control" value="<?php echo $kontak; ?>">
                <span class="help-block"><?php echo $kontak_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a href="index.php" class="btn btn-default">Cancel</a>
            </div>
        </form>
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