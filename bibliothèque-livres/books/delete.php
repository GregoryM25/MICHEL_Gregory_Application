<?php
include('../db/database.php');

// Vérifier si l'ID du livre est passé en paramètre
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Supprimer le livre de la base de données
    $sql = "DELETE FROM livres WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Livre supprimé avec succès";
    } else {
        echo "Erreur lors de la suppression: " . $conn->error;
    }
} else {
    echo "ID du livre non fourni";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Supprimer le livre</title>
</head>
<body>
    <h2>Supprimer le livre</h2>
    <a href="read.php">Retour à la liste des livres</a>
</body>
</html>
