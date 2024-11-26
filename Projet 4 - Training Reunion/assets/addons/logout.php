<?php
session_start();
session_unset();
session_destroy();
header('Location: ../../index.php'); // Redirection to the home page
exit();
?>