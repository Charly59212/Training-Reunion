<?php
// Starts a session to check if the user is logged in
session_start();

// Includes the header file containing the database
require 'assets/addons/header.php';

// Checks if user is logged in
if (!isset($_SESSION['name'])) {
    // If not redirected to the login page
    header('Location: index.php');
    exit; // Stop execution after redirection
}

// Default Difficulty Levels
$default_difficulties = ['très facile', 'facile', 'moyen', 'difficile', 'très difficile'];

// Recovery of difficulty levels from the base
$stmt = $pdo->prepare("SELECT DISTINCT difficulty FROM hiking");
$stmt->execute(); // Execute the query
$db_difficulties = $stmt->fetchAll(PDO::FETCH_COLUMN); // Get the results in tabular form

// Merger of default difficulties with those of the base by eliminating duplicates
$difficulties = array_unique(array_merge($default_difficulties, $db_difficulties));

// Retrieving data from the hiking table
$stmt = $pdo->query("SELECT * FROM hiking");
$randosList = $stmt->fetchAll(PDO::FETCH_ASSOC); // Get the results in tabular form

?>

<main>
    <div class="container intro">
        <h2 class="accueil">Bienvenue sur votre espace personnel <br> <?php echo htmlspecialchars($_SESSION['name']); ?> !</h2>

        <h2>Liste des randonnées</h2>
        <!-----Table of existing hikes----->
        <table class="table-hikes">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Difficulté</th>
                    <th>Distance (km)</th>
                    <th>Durée</th>
                    <th>Dénivelé (m)</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <!---Foreach loop that loops through the rando list--->
                <?php foreach ($randosList as $rando): ?> 
                    <tr>
                        <!-----Opens a new row in the HTML table for each hike---->
                        <td><?php echo htmlspecialchars($rando['name']); ?></td>
                        <td><?php echo htmlspecialchars($rando['difficulty']); ?></td>
                        <td><?php echo htmlspecialchars($rando['distance']); ?></td>
                        <td><?php echo htmlspecialchars($rando['duration']); ?></td>
                        <td><?php echo htmlspecialchars($rando['height_difference']); ?></td>
                        <!------Upadete button----->
                        <td>
                            <a href="update.php?id=<?php echo $rando['id']; ?>" class="btn-update">Modifier</a>
                        </td>
                        <!------Upadete button----->
                        <td>
                            <a href="delete.php?id=<?php echo $rando['id']; ?>" class="btn-delete">Supprimer</a>
                        </td>
                    </tr>
                    <!-----End of foreach loop------>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Ajouter une nouvelle randonnée</h2>
        <div class="column column-right">
            <!-----Form to add a hike----->
            <form action="create.php" method="post" class="form-add-hike">
                <!-----Field for name----->
                <label for="name">Nom :</label>
                <input type="text" name="name" id="name" required>

                <!-----Difficulty level selector----->
                <label for="difficulty">Difficulté :</label>
                <select name="difficulty" id="difficulty" required>
                    <?php foreach ($difficulties as $level): ?>
                        <option value="<?php echo $level; ?>"><?php echo htmlspecialchars($level); ?></option>
                    <?php endforeach; ?>
                </select>

                <!-----Field for distance----->
                <label for="distance">Distance (km) :</label>
                <input type="number" name="distance" id="distance" step="0.1" required>

                <!-----Field for duration----->
                <label for="duration">Durée (hh:mm:ss) :</label>
                <input type="text" name="duration" id="duration" required>

                <!-----Field for height difference----->
                <label for="height_difference">Dénivelé (m) :</label>
                <input type="number" name="height_difference" id="height_difference" required>

                <!-----Valid button-->
                <input type="submit" id="valid" value="Ajouter" class="btn">
            </form>
        </div>

        <!-----Connection validation message------->
        <h2 id="connect-message">Vous êtes connecté !</h2>

        <!------------Disconnect button------------>
        <a href="assets/addons/logout.php" id="annul" class="btn btn-logout">Se déconnecter</a>
    </div>
</main>

<?php
// Includes footer
require 'assets/addons/footer.php'; 
?>