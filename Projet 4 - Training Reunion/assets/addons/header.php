<?php
// Start the session if not started yet
if (session_status() === PHP_SESSION_NONE) {
    session_start();}

// Connection check
$isLoggedIn = isset($_SESSION['name']);

// Detects current page
$page = basename($_SERVER['PHP_SELF']);

// Includes database connection file
require "db.php";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Training Réunion</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/randico.png">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Lora:ital,wght@0,400..700;1,400..700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>

<body>

<header>
    <h1>
        <?php
        // Dynamic title depending on the page
        if ($page === 'connexion.php') {
            echo "Connexion à Training Réunion";
        } else {
            echo "Bienvenue sur Training Réunion";
        }
        
        ?>
    </h1>
    <nav>
        <ul>
            <?php
            if ($isLoggedIn) {
                // Links for a logged in user
                if ($page !== 'index.php') {
                    echo '<li><a href="index.php">Accueil</a></li>';
                }
                if ($page !== 'espaces_randonnees.php') {
                    echo '<li><a href="espaces_randonnees.php">Espace Randos</a></li>';
                }
                echo '<li><a href="index.php#toprandos">Top Randos</a></li>';
                if ($page !== 'update.php') {
                    echo '<li><a href="assets/addons/logout.php">Se déconnecter</a></li>';
                }
            } else {
                // Links for a user not logged in
                if ($page !== 'index.php') {
                    echo '<li><a href="index.php">Accueil</a></li>';
                }
                echo '<li><a href="index.php#toprandos">Top Randos</a></li>';
                if ($page !== 'connexion.php') {
                    echo '<li><a href="connexion.php">Connexion</a></li>';
                }
            }
            ?>
        </ul>
    </nav>
</header>

    <!-- Scroll-to-top Button -->
    <a href="#" id="scroll-to-top">▲</a>
    <script>
        // Show or hide the scroll-to-top button
        window.addEventListener("scroll", function() {
            const scrollToTopButton = document.getElementById("scroll-to-top");
            if (window.scrollY > 100) { 
                // Show the arrow after scrolling 100px down
                scrollToTopButton.style.display = "block";
            } else {
                // Hide the arrow if less than 100px down
                scrollToTopButton.style.display = "none";
            }
        });
    </script>