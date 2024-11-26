<?php
// Starts a session to check if the user is logged in
session_start();

// Includes the header file containing the database
require 'assets/addons/header.php';

// Checks the sending of the request via the form with the POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Stores the email entered by the user
    $email = $_POST['email'];
    // Stores the password entered by the user
    $password = $_POST['password'];

    try {
        // Checking credentials
        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ?"); // Prepare a query to find a user

        $stmt->execute([$email]);// Execute the query with the provided email
        $user = $stmt->fetch(); // Retrieves data as an associative array

        // If the user exists and the password is correct
        if ($user && password_verify($password, $user['password'])) {
            // Stores username and email in the session
            $_SESSION['name'] = $user['name']; // Stores username
            $_SESSION['email'] = $email; // Stores user email
            header('Location: espaces_randonnees.php'); // Redirect to espace_randonnees.php
            exit; //Ends script execution
        } else {
            // If the credentials are incorrect
            $_SESSION['error_message'] = "Mauvais Email ou Mot de Passe."; // Error message in the session
            header('Location: connexion.php'); // Redirect to connexion.php
            exit; // Ends script execution
        }
    } catch (PDOException $e) {
        // Error handling
        $_SESSION['error_message'] = "Erreur de saisie de vos données, veuillez recommencer svp."; // Error message
        header('Location: connexion.php'); // Redirect to la page de connexion
        exit; // Ends script execution
    }
}

?>