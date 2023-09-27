<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$ID_Rec = $ID_Pasien = $Tanggal_Rec = $Diagnosis = "";
$ID_Rec_err = $ID_Pasien_err = $Tanggal_Rec_err = $Diagnosis_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate ID Rec
    $input_ID_Rec = trim($_POST["id_rec"]);
    if (empty($input_ID_Rec)) {
        $ID_Pasien_err = "Silakan masukkan ID Rekam Medis.";
    } else {
        $ID_Rec = $input_ID_Rec;
    }

    // Validate ID Pasien
    $input_ID_Pasien = trim($_POST["id_pasien"]);
    if (empty($input_ID_Pasien)) {
        $ID_Pasien_err = "Silakan masukkan ID pasien.";
    } else {
        $ID_Pasien = $input_ID_Pasien;
    }

    // Validate tanggal rec 
    $input_Tanggal_Rec = trim($_POST["tanggal_rec"]);
    if (empty($input_Tanggal_Rec)) {
        $Tanggal_Rec_err = "Silakan masukkan tanggal Rekam Medis.";
    } else {
        $Tanggal_Rec = $input_Tanggal_Rec;
    }

    // Validate Diagnosis
    $input_Diagnosis = trim($_POST["diagnosis"]);
    if (empty($input_Diagnosis)) {
        $Diagnosis_err = "Silakan masukkan diagnosis dokter.";
    } else {
        $Diagnosis = $input_Diagnosis;
    }

    // Check input errors before inserting in database
    if (empty($ID_Rec_err) && empty($ID_Pasien_err) && empty($Tanggal_Rec_err) && empty($Diagnosis_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO rekam_medis (ID_Rec, ID_Pasien, Tanggal_Rec, Diagnosis) VALUES (?, ?, ?, ?)";

        if ($stmt = $link ->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param(
                "ssss",
                $param_id_rec,
                $param_id_pasien,
                $param_tanggal_rec,
                $param_diagnosis,
            );

            // Set parameters
            $param_id_rec = $ID_Rec;
            $param_id_pasien = $ID_Pasien;
            $param_tanggal_rec = $Tanggal_Rec;
            $param_diagnosis = $Diagnosis;

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
        <h2>Create Meadical Record</h2>
        <p>Please fill this form and submit to add a new medical record to the database.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($ID_Rec_err)) ? 'has-error' : ''; ?>">
                <label>ID Rekam Medis</label>
                <input type="text" name="id_rec" class="form-control" value="<?php echo $ID_Rec; ?>">
                <span class="help-block"><?php echo $ID_Rec_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($ID_Pasien_err)) ? 'has-error' : ''; ?>">
                <label>ID Pasien</label>
                <input type="text" name="id_pasien" class="form-control" value="<?php echo $ID_Pasien; ?>">
                <span class="help-block"><?php echo $ID_Pasien_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($Tanggal_Rec_err)) ? 'has-error' : ''; ?>">
                <label>Tanggal Rekam Medis</label>
                <input type="date" name="tanggal_rec" class="form-control" value="<?php echo $Tanggal_Rec; ?>">
                <span class="help-block"><?php echo $Tanggal_Rec_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($Diagnosis_err)) ? 'has-error' : ''; ?>">
                <label>Diagnosis</label>
                <input type="text" name="diagnosis" class="form-control" value="<?php echo $Diagnosis_err; ?>">
                <span class="help-block"><?php echo $Diagnosis_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a href="index.php" class="btn btn-default">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
