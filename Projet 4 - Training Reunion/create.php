<?php
// Starts a session 
session_start();

// Checks if user is logged in
if (!isset($_SESSION['name'])) {
    // If not redirected to the login page
    header("Location: index.php");
    exit; // Ends script execution
}

// Includes database connection file
require 'db.php';

// Default Difficulty Levels
$predefined_difficulties = ['très facile', 'facile', 'moyen', 'difficile', 'très difficile'];

// Recovery of difficulty levels from the base
$stmt = $pdo->prepare("SELECT DISTINCT difficulty FROM hiking");
$stmt->execute(); // Exécute the query
$db_difficulties = $stmt->fetchAll(PDO::FETCH_COLUMN); // Get the results in tabular form

// Merger of default difficulties with those of the base by eliminating duplicates
$difficulty_levels = array_unique(array_merge($predefined_difficulties, $db_difficulties));

// Sorts difficulty levels in logical order
sort($difficulty_levels);

// Initializes an array with default values ​​for the hike data
$data = [
    'name' => '', // Hike ID
    'difficulty' => '', // Name of the hike
    'distance' => '', // Distance
    'duration' => '', // Duration
    'height_difference' => '' // Height difference
];

// Checks the form submission with the POST method
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Secure and recover form data
    $data = array_map('htmlspecialchars', $_POST);

    // Executes the insert query
    $stmt = $pdo->prepare("INSERT INTO hiking (name, difficulty, distance, duration, height_difference) 
    VALUES (:name, :difficulty, :distance, :duration, :height_difference)");
    $stmt->execute($data); // Exécute the query

    // Redirect user after update
    header("Location: espaces_randonnees.php");
    exit; // Stop script after redirection
}

// Includes the header file
require 'assets/addons/header.php';
?>

<!--Form to add a new hike-->
<form action="create.php" method="post">

    <!-----Field for name----->
    <label for="name">Nom:</label>
    <input type="text" name="name" required>
    
    <!-----Difficulty level selector----->
    <label for="difficulty">Difficulté:</label>
    <select name="difficulty" required>
        <!---Foreach loop that loops through the $difficulty_levels array--->
        <?php foreach ($difficulty_levels as $level): ?>
            <!---Cycle through each difficulty level in the table--->
        <option value="<?php echo $level; ?>"
        <?php // If the current level matches the value in $data['difficulty']
            echo $data['difficulty'] === $level ? "selected" : ""; ?>>
            <!---Shows the difficulty level with an initial capital letter--->
            <?php echo ucfirst($level); ?>
        </option>
        <!-----End of foreach loop------>
        <?php endforeach; ?>
    </select>

    <!-----Field for distance----->
    <label for="distance">Distance (km):</label>
    <input type="text" name="distance" required>

    <!-----Field for duration----->
    <label for="duration">Durée (hh:mm:ss):</label>
    <input type="text" name="duration" required>

    <!-----Field for height difference----->
    <label for="height_difference">Dénivelé (m):</label>
    <input type="text" name="height_difference" required>

    <!-----Submit button----->
    <input type="submit" value="Ajouter">
</form>

<?php
// Includes footer
 require 'assets/addons/footer.php'; 
?>