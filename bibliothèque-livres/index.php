<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bibliothèque de livres</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Assurez-vous d'ajuster le chemin en fonction de votre structure -->
</head>
<body>
    <header>
        <h1>Bienvenue dans la bibliothèque de livres</h1>
    </header>
    <main>
        <section id="intro">
            <h2>Qu'est-ce que la bibliothèque de livres ?</h2>
            <p>La bibliothèque de livres est une application web simple qui vous permet de gérer une collection de livres. Vous pouvez ajouter de nouveaux livres, voir les livres existants, effectuer des recherches et bien plus encore.</p>
        </section>
        <section id="features">
            <h2>Fonctionnalités principales</h2>
            <ul>
                <li><strong>Ajouter un livre:</strong> Permet d'ajouter un nouveau livre à la collection.</li>
                <li><strong>Voir les livres:</strong> Affiche une liste de tous les livres de la collection.</li>
                <li><strong>Rechercher des livres:</strong> Permet de rechercher des livres par titre, auteur ou description.</li>
            </ul>
        </section>
        <div class="buttons-container">
            <a href="books/create.php" class="btn">Ajouter un livre</a>
            <a href="books/read.php" class="btn">Voir les livres</a>
            <a href="books/search.php" class="btn">Rechercher des livres</a>
        </div>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Bibliothèque de livres. Tous droits réservés.</p>
    </footer>
</body>
</html>
