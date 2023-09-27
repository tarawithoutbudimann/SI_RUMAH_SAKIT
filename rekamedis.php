<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Rumah Sakit</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
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
            background-color: violet;
        }
        .content {
            margin-left: 200px;
            padding: 20px;
        }
        .profile {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
        }
        .profile h2 {
            margin-top: 0;
        }
        .dropdown {
            width: fit-content;

        }
        .header-title {
            justify-content: center;
        }
        a.dropdown-toggle {
            width: 160px;
        }
        a.dropdown-toggle::after {
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="header row">
            <h1>Sistem Informasi Rumah Sakit</h1>
    </div>


    <div class="container">
        <div class="sidebar">
            <ul class="nav nav-pills nav-stacked">
                <li>        
                <div class="dropdown">
                
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
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Dashboard</title>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
            <style type="text/css">
                .wrapper {
                    width: 650px;
                    margin: 0 auto;
                }

                .page-header h2 {
                    margin-top: 0;
                }

                table tr td:last-child a {
                    margin-right: 15px;
                }
                .modal-content {
                    padding: 0 0 30px 0;
                }
            </style>
            <script type="text/javascript">
                $(document).ready(function () {
                    $('[data-toggle="tooltip"]').tooltip();
                });
            </script>
        </head>
        <body>
            <div class="wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="page-header clearfix">
                                <h2 class="pull-left">Informasi Rekam Medis</h2>
                                <a href="rekamediscreate.php" class="btn btn-success pull-right"data-toggle="modal" data-target="#exampleModalLong">Tambah Baru</a>
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
                            $sql = "SELECT * FROM rekam_medis";
                            if ($result = mysqli_query($link, $sql)) {
                                if (mysqli_num_rows($result) > 0) {
                                    echo "<table class='table table-bordered table-striped'>";
                                    echo "<thead>";
                                    echo "<tr>";
                                    echo "<th>ID Rekam Medis</th>";
                                    echo "<th>ID Pasien</th>";
                                    echo "<th>Tanggal Rekam Medis</th>";
                                    echo "<th>Diagnosis</th>";
                                    echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    while ($row = mysqli_fetch_array($result)) {
                                        echo "<tr>";
                                        echo "<td>" . $row['ID_Rec'] . "</td>";
                                        echo "<td>" . $row['ID_Pasien'] . "</td>";
                                        echo "<td>" . $row['Tanggal_Rec'] . "</td>";
                                        echo "<td>" . $row['Diagnosis'] . "</td>";
                                        echo "<td>";
                                        echo "<a href='read.php?id=" . $row['ID_Rec'] . "' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                        echo "<a href='update.php?id=" . $row['ID_Rec'] . "' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                        echo "<a href='delete.php?id=" . $row['ID_Rec'] . "' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    echo "</tbody>";
                                    echo "</table>";
                                    // Free result set
                                    mysqli_free_result($result);
                                } else {
                                    echo "<p class='lead'><em>No records were found.</em></p>";
                                }
                            } else {
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
    </div>
</div>
</body>
</html>
