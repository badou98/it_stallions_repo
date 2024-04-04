<?php

$host = 'localhost';
$dbname = 'ikimina';
$username = 'root';
$password = '';

// Attempt to connect to the database
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
    
   
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
