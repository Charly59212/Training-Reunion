<?php
// Starts a session
session_start();

// Checks if user is logged in
if (!isset($_SESSION['name'])) {
    // If not redirected to the login page
    header("Location: index.php");
    exit;  // Stop execution after redirection
}

// Includes database connection file
require 'db.php';

// If the user cancels the operation
if (isset($_POST['cancel'])) {
    // Redirection to the hiking area page
    header("Location: espaces_randonnees.php");
    exit; // Ends script execution
}

// Default Difficulty Levels
$default_difficulties = ['très facile', 'facile', 'moyen', 'difficile', 'très difficile'];

// Recovery of difficulty levels from the base
$stmt = $pdo->prepare("SELECT DISTINCT difficulty FROM hiking");
$stmt->execute(); // Execute the query
$db_difficulties = $stmt->fetchAll(PDO::FETCH_COLUMN); // Get the results in tabular form

// Merger of default difficulties with those of the base by eliminating duplicates
$difficulty_levels = array_unique(array_merge($default_difficulties, $db_difficulties));

// Initializes an array with default values ​​for the hike data
$data = [
    'id' => '', // Hike ID
    'name' => '', // Name of the hike
    'difficulty' => '', // Difficulty level
    'distance' => '', // Distance
    'duration' => '', // Duration
    'height_difference' => '' // Height difference
];

// Checks if the form has been submitted for updating
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Secures and recovers data submitted via the form
    $data = array_map('htmlspecialchars', $_POST);

    // Prepare the hike update request
    $stmt = $pdo->prepare("UPDATE hiking 
        SET name = :name, difficulty = :difficulty, distance = :distance, duration = :duration, height_difference = :height_difference 
        WHERE id = :id");    
    $stmt->execute($data); // Execute the query

    // Redirection after update
    header("Location: espaces_randonnees.php");
    exit; // Ends script execution
}    

// Checks if an identifier (ID) was passed via GET
if (!isset($_GET['id'])) {
    exit; // Stop execution if no ID is provided
}
    // Retrieving data from the corresponding hike
    $stmt = $pdo->prepare("SELECT * FROM hiking WHERE id = :id");
    $stmt->execute(['id' => $_GET['id']]); // Execute the query with ID
    $rando = $stmt->fetch(); // Retrieve hiking data

    if ($rando) {
        // Pre-populates the data for the form
        $data = array_map('htmlspecialchars', $rando);
    } else {
        exit; // Stop execution if no trail is found
}    

?>

<?php 
// Includes the header file
require 'assets/addons/header.php'; 
?>

<main>
    <h2 class="maj">Modifier une randonnée</h2>
    <div class="column column-right">
        <!-----Form to modify a hike----->
        <form action="update.php" method="post">
            <!-----Hidden field for hike ID----->
            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">

            <!-----Field for name----->
            <label for="name">Nom :</label>
            <input type="text" id="name" name="name" value="<?php echo $data['name']; ?>" required><br>

            <!-----Difficulty level selector----->
            <label for="difficulty">Difficulté :</label>
            <select id="difficulty" name="difficulty" required>
                <!---Foreach loop that loops through the $difficulty_levels array--->
                <?php foreach ($difficulty_levels as $level): ?>
                    <!----Sets an option in the drop-down menu with the current value---->
                    <option value="<?php echo htmlspecialchars($level); ?>"
                        <?php // If the current level corresponds to $data['difficulty'], selection of the option
                        echo $data['difficulty'] === $level ? "selected" : ""; ?>>
                         <!---Shows difficulty level--->
                        <?php echo htmlspecialchars($level); ?>
                    </option>
                    <!-----End of foreach loop------>
                <?php endforeach; ?>
            </select><br>

            <!-----Field for distance----->
            <label for="distance">Distance (km) :</label>
            <input type="number" id="distance" name="distance" step="0.1" value="<?php echo $data['distance']; ?>" required><br>

            <!-----Field for duration----->
            <label for="duration">Durée :</label>
            <input type="text" id="duration" name="duration" value="<?php echo $data['duration']; ?>" required><br>

            <!-----Field for height difference----->
            <label for="height_difference">Dénivelé (m) :</label>
            <input type="number" id="height_difference" name="height_difference" value="<?php echo $data['height_difference']; ?>" required><br>

            <!-----Confirm and cancel buttons----->
            <div id="update-button">
                <input type="submit" id="valid" class="btn" value="Valider">
                <button type="submit" name="cancel" id="annul" class="btn">Annuler</button>
            </div>
        </form>
    </div>
</main>

<?php 
// Includes footer
require 'assets/addons/footer.php'; 
?>