<?php
// Check existence of id parameter before processing further
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM resepsionis WHERE ID_Kunjungan = ?";
    
    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
    
            if (mysqli_num_rows($result) == 1) {
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use a while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field values
                $id_kunjungan = $row["id_kunjungan"];
                $tanggal_layanan = $row["Tanggal_Layanan"];
                $waktu_layanan = $row["Waktu_Layanan"];
                $id_pasien = $row["ID_Pasien"];
                $id_dokter = $row["ID_Dokter"];
                $keluhan_awal = $row["Keluhan_Awal"];
                $username = $row["Username"];
            } else {
                // URL doesn't contain a valid id parameter. Redirect to error page
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
    // URL doesn't contain an id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
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
                        <h1>View Record</h1>
                    </div>
                    <div class="form-group">
                        <label>ID Kunjungan</label>
                        <p class="form-control-static"><?php echo $id_kunjungan; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Layanan</label>
                        <p class="form-control-static"><?php echo $tanggal_layanan; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Waktu Layanan</label>
                        <p class="form-control-static"><?php echo $waktu_layanan; ?></p>
                    </div>
                    <div class="form-group">
                        <label>ID Pasien</label>
                        <p class="form-control-static"><?php echo $id_pasien; ?></p>
                    </div>
                    <div class="form-group">
                        <label>ID Dokter</label>
                        <p class="form-control-static"><?php echo $id_dokter; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Keluhan Awal</label>
                        <p class="form-control-static"><?php echo $keluhan_awal; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <p class="form-control-static"><?php echo $username; ?></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
