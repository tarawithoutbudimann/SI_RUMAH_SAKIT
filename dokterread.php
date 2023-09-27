<?php
// Check existence of id parameter before processing further
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM dokter WHERE ID_Dokter = ?";
    
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
                $id_dokter = $row["ID_Dokter"];
                $nama_dokter = $row["Nama_Dokter"];
                $agama = $row["Agama"];
                $id_jadwal = $row["ID_Jadwal"];
                $tempat_lahirdok = $row["Tempat_LahirDok"];
                $tanggal_lahirdok = $row["Tanggal_LahirDok"];
                $domisili = $row["Domisili"];
                $jenis_kelamin = $row["Jenis_Kelamin"];
                $tarif_dokter= $row["Tarif_Dokter"];
                $id_spesialis= $row["ID_Spesialis"];
                $kontak = $row["Kontak"];
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
                        <label>ID Dokter</label>
                        <p class="form-control-static"><?php echo $id_dokter; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Nama Dokter</label>
                        <p class="form-control-static"><?php echo $nama_dokter; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Agama</label>
                        <p class="form-control-static"><?php echo $agama; ?></p>
                    </div>
                    <div class="form-group">
                        <label>ID Jadwal</label>
                        <p class="form-control-static"><?php echo $id_jadwal; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Tempat Lahir</label>
                        <p class="form-control-static"><?php echo $tempat_lahirdok; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <p class="form-control-static"><?php echo $tanggal_lahirdok; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Domisili</label>
                        <p class="form-control-static"><?php echo $domisili; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <p class="form-control-static"><?php echo $jenis_kelamin; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Tarif</label>
                        <p class="form-control-static"><?php echo $tarif_dokter; ?></p>
                    </div>
                    <div class="form-group">
                        <label>ID Spesialis</label>
                        <p class="form-control-static"><?php echo $id_spesialis; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Kontak</label>
                        <p class="form-control-static"><?php echo $kontak; ?></p>
                    </div>
                    <p><a href="dokter.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
