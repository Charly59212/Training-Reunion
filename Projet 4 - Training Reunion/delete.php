<?php
// Starts a session to check if the user is logged in
session_start();

// Checks if user is logged in
if (!isset($_SESSION['name'])) {
    // If not redirected to the login page
    header("Location: index.php");
    exit; // Stop execution after redirection
}

// Includes database connection file
require 'db.php';

// Retrieves the ID of the hike to delete via GET (assigns null if absent)
$id = $_GET['id'] ?? null;

// Checks if an ID was provided
if ($id) {
    // Prepare to delete the hike in the database
    $stmt = $pdo->prepare("DELETE FROM hiking WHERE id = :id");
    $stmt->execute(['id' => $id]); // Execute query with ID

    // Redirection to espace_randonnees.php after deletion
    header("Location: espaces_randonnees.php");
    exit; // Ends script execution
} else {
    die("ID de randonnée manquant !"); // Error message if missing ID
}

?>