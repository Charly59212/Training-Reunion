<?php
// Database connection information
$hostname = 'localhost';
$database = 'reunion_island';
$username = 'root';
$password = '';

try {
    // Creating a PDO instance for database connection
    $pdo = new PDO("mysql:host=$hostname;dbname=$database;charset=utf8mb4", $username, $password);
    
    // Configuring PDO options
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Executing SQL queries using $pdo
} catch (PDOException $e) {
    // message in case of connection error
    echo "Erreur de connexion à la base de données : " . $e->GetMessage();
    die(); 
}

?>