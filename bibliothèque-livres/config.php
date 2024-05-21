<?php
// Configuration de la base de données
$host = 'localhost';
$dbname = 'bibliothèque';
$username = 'root';
$password = 'root'; // Changez le mot de passe si nécessaire

// Créer une connexion à la base de données
$conn = new mysqli($host, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion a échoué: " . $conn->connect_error);
}
?>
