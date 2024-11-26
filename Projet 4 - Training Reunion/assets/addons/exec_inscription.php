<?php
// Starts a session
session_start();

// Includes database connection file
require '../../db.php';

// Checks the sending of the request via the form with the POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the data sent from the form
    $name = $_POST['name']; // User name
    $email = $_POST['email'];  // Email
    $password = $_POST['password']; // Password

    // Check if all fields are filled
    if (empty($name) || empty($email) || empty($password)) {
        // Store an error message in the session
        $_SESSION['errorMessage'] = "Tous les champs sont obligatoires.";
        header('Location: ../../index.php'); // // Redirects to index.php
        exit; // Stop script execution after redirection
    } else {
        try {
            // Prepare an SQL query to insert a new user into the table
            $stmt = $pdo->prepare("INSERT INTO utilisateurs (name, email, password) VALUES (?, ?, ?)");

            // Hash the password before storing it in the database
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            // Execute the query with the name, email and hashed password
            $stmt->execute([$name, $email, $hashedPassword]);
            // Success message after registration
            $_SESSION['errorMessage'] = "Inscription réussie ! <br> Vous pouvez maintenant vous connecter.";
            header('Location: ../../index.php'); // Redirect to page index.php
            exit; // Stop script execution after redirection
        } catch (PDOException $e) {
            // Check if the error is due to a constraint violation
            if ($e->getCode() == 23000) {
                $_SESSION['errorMessage'] = "Email ou nom déjà utilisé<br> Veuillez en choisir un autre svp.";
            } else {
                // Generic error message in case of problem
                $_SESSION['errorMessage'] = "Une erreur s\'est produite lors de l\'inscription.";
            }
            header('Location: ../../index.php'); // edirection to index.php
            exit; // Stop script execution after redirection
        }
    }
}

?>