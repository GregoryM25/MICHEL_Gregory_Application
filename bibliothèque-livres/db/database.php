<?php
$servername = "localhost";
$username = "root";
$password = "root"; // Utilisez le mot de passe par défaut de MAMP
$dbname = "bibliothèque";
$port = 8889; // Port par défaut de MySQL dans MAMP

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>