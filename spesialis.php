<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dokter</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
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
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>
<body>
<div class="header row">
            <h1>Sistem Informasi Rumah Sakit</h1>
    </div>
        <div class="sidebar">
            <ul class="nav nav-pills nav-stacked">
                <li>        
                <div class="dropdown">
                
                <!-- <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                    Profile <span class="caret"></span>
                
                </button>
                <ul class="dropdown-menu">
                
                <li><a href="reset-password.php">Reset Password</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul> -->
                
            </div></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Profile<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="reset-password.php">Reset Password</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </li>
                <li><a href="welcome.php">Beranda</a></li>
                <li><a href="dokter.php">Dokter</a></li>
                <li><a href="spesialis.php">Spesialisasi Dokter</a></li>
                <li><a href="pasien.php">Data Pasien</a></li>
                <li><a href="#">Rekam Medis</a></li>
                <li><a href="#">Resep Dokter</a></li>
                <li><a href="#">Resep Obat</a></li>
                <li><a href="#">Daftar Obat</a></li>
                <li><a href="#">Transaksi Obat</a></li>
                <li><a href="#">Transaksi</a></li>
            </ul>
        </div>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Informasi Spesialis</h2>
                        <a href="spesialiscreate.php" class="btn btn-success pull-right">Tambah Baru</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";

                    // Attempt select query execution
                    $sql = "SELECT * FROM spesialis";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>ID Spesialis</th>";
                                        echo "<th>Nama Spesialis</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['ID_Spesialis'] . "</td>";
                                        echo "<td>" . $row['Nama_Spesialis'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='dokterread.php?id=". $row['ID_Spesialis'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                            echo "<a href='dokterupdate.php?id=". $row['ID_Spesialis'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='dokterdelete.php?id=". $row['ID_Spesialis'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }

                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
