<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dokter</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
                .container {
            max-width: 960px;
            margin: 0 auto;
            padding: 20px;
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
                <li><a href="rekamedis.php">Rekam Medis</a></li>
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
                        <h2 class="pull-left">Informasi Pasien</h2>
                        <a href="pasiencreate.php" class="btn btn-success pull-right" data-toggle="modal" data-target="#exampleModalLong">Tambah Baru</a>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            ...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                        </div>
                    </div>
                    </div>

                    <?php

                    // Include config file
                    require_once "config.php";

                    // Attempt select query execution
                    $sql = "SELECT * FROM pasien";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>ID Pasien</th>";
                                        echo "<th>Nama Pasien</th>";
                                        echo "<th>Jenis Kelamin</th>";
                                        echo "<th>Agama</th>";
                                        echo "<th>Tempat Lahir</th>";
                                        echo "<th>Tanggal Lahir Awal</th>";
                                        echo "<th>Golongan Darah</th>";
                                        echo "<th>Domisili</th>";
                                        echo "<th>Kontak</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['ID_Pasien'] . "</td>";
                                        echo "<td>" . $row['Nama_Pasien'] . "</td>";
                                        echo "<td>" . $row['Jenis_Kelamin'] . "</td>";
                                        echo "<td>" . $row['Agama'] . "</td>";
                                        echo "<td>" . $row['Tempat_Lahir'] . "</td>";
                                        echo "<td>" . $row['Tanggal_Lahir'] . "</td>";
                                        echo "<td>" . $row['Golongan_Darah'] . "</td>";
                                        echo "<td>" . $row['Domisili'] . "</td>";
                                        echo "<td>" . $row['Kontak'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='dokterread.php?id=". $row['ID_Pasien'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                            echo "<a href='dokterupdate.php?id=". $row['ID_Pasien'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='dokterdelete.php?id=". $row['ID_Pasien'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
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
