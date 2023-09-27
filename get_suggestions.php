<?php
// Replace with your own database connection code
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rumahsakit";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user input
$input = $_POST['input'];

// Perform a database query to retrieve matching patient IDs based on their names
$sql = "SELECT ID_Pasien FROM pasien WHERE Nama_Pasien LIKE '%$input%'";
$result = $conn->query($sql);

$suggestions = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $suggestions[] = $row['ID_Pasien'];
    }
}

$conn->close();

// Return the suggestions as JSON
echo json_encode(array('suggestions' => $suggestions));
?>
