
<?php
$conn = "";
try {
    $servername = "localhost";
    $dbname = "phpDB";
    $username = "root";
    $password = "";
    $pass = "3321";


    $conn = new PDO(
        "mysql:host=$servername; dbname=phpDB",
        $username, $password
    );
    $conn->setAttribute(PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed:"
        . $e->getMessage();
}