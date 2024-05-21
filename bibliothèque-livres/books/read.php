<?php
// Inclure la configuration de la base de données
include('../config.php');

// Récupérer tous les livres de la base de données
$sql = "SELECT id, titre, auteur, description, image FROM livres";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des livres</title>
    <link rel="stylesheet" href="../css/styles.css"> <!-- Assurez-vous d'ajuster le chemin en fonction de votre structure -->
</head>
<body>
    <div class="container">
        <h2>Liste des livres</h2>
        <a href="create.php" class="btn btn-success">Ajouter un nouveau livre</a>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="book">
                    <?php if (!empty($row["image"])): ?>
                        <img src="../uploads/<?php echo $row["image"]; ?>" alt="Image du livre" class="book-image">
                    <?php endif; ?>
                    <div class="book-details">
                        <h3><?php echo $row["titre"]; ?></h3>
                        <p><strong>Auteur:</strong> <?php echo $row["auteur"]; ?></p>
                        <p><?php echo $row["description"]; ?></p>
                        <a href="update.php?id=<?php echo $row["id"]; ?>" class="btn btn-primary">Modifier</a>
                        <a href="delete.php?id=<?php echo $row["id"]; ?>" class="btn btn-danger">Supprimer</a>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p>Aucun livre trouvé.</p>";
        }
        $conn->close();
        ?>
        <a href="../index.php" class="btn btn-default">Retour</a>
 <!-- Bouton pour revenir à la page précédente -->
    </div>
</body>
</html>
