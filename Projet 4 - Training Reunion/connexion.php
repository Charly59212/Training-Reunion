<?php
// Starts a session to check if the user is logged in
session_start();

// Includes the header file containing the database
require 'assets/addons/header.php';
?>

<main>

    <!-----Login page------->
    <div class="container">
        <main class="form-container connect">
            <h2>Espace connexion</h2>
            <!-----Login form------->
            <form action="exec_connexion.php" method="POST">
                <!-----Field for email address------->
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required>
                <br>

                <!-----Field for password------->
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
                <br>

                <!----Submit button form---->
                <input type="submit" id="connect" class="btn" value="Se connecter">

                <?php
                // Error message
                if (isset($_SESSION['error_message'])) {
                    echo "<p class='error-message'>" . $_SESSION['error_message'] . "</p>"; // Error message
                    unset($_SESSION['error_message']); // Delete the message to prevent it from persisting
                }
                ?>
            </form>
    </div>
</main>

<!-----Includes footer----->
<?php require 'assets/addons/footer.php'; ?>