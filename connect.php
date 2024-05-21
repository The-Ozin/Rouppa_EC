<?php
$servername = "localhost";
$username = "root";
$password = "wordpass";
$database = "rouppa";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit(); // Terminate script execution if connection fails
}
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Perform query
$query = "SELECT * FROM produto";
$result = mysqli_query($conn, $query);
if ($result === false) {
    die("Error executing query: " . mysqli_error($conn));
}

// Close connection (optional)
// mysqli_close($conn);
?>
