<?php
include('../db/database.php');

$search = '';
$results = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search = $_POST['search'];

    $sql = "SELECT * FROM livres WHERE titre LIKE '%$search%' OR auteur LIKE '%$search%' OR description LIKE '%$search%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $results[] = $row;
        }
    } else {
        echo "Aucun résultat trouvé";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rechercher des livres</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Rechercher des livres</h2>
        <form method="post" action="search.php" class="search-form">
            <div class="form-group">
                <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" class="form-control" required>
                <button type="submit" class="btn btn-primary">Rechercher</button>
            </div>
        </form>
        <a href="../index.php" class="btn btn-default btn-back">Retour</a>
        <?php if (!empty($results)): ?>
            <h3>Résultats de recherche:</h3>
            <table class="results-table">
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Description</th>
                </tr>
                <?php foreach ($results as $book): ?>
                    <tr>
                        <td><?php echo $book['id']; ?></td>
                        <td><?php echo $book['titre']; ?></td>
                        <td><?php echo $book['auteur']; ?></td>
                        <td><?php echo $book['description']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>
