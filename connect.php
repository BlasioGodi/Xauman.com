<?php
// Include the database configuration file
require_once 'config.php';

// Create a PDO object with the database details
$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

// Set the error mode to exceptions
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>