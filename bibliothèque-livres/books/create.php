<?php
// Afficher les erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inclure la configuration de la base de données
include('../config.php');

// Définir les variables et les initialiser avec des valeurs vides
$titre = $auteur = $description = $image = '';
$titre_err = $auteur_err = $description_err = $image_err = '';

// Traitement du formulaire lors de sa soumission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Valider le titre
    if (empty(trim($_POST["titre"]))) {
        $titre_err = "Veuillez saisir un titre pour le livre.";
    } else {
        $titre = trim($_POST["titre"]);
    }

    // Valider l'auteur
    if (empty(trim($_POST["auteur"]))) {
        $auteur_err = "Veuillez saisir un auteur pour le livre.";
    } else {
        $auteur = trim($_POST["auteur"]);
    }

    // Valider la description
    if (empty(trim($_POST["description"]))) {
        $description_err = "Veuillez saisir une description pour le livre.";
    } else {
        $description = trim($_POST["description"]);
    }

    // Valider l'image
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "png" => "image/png");
        $filename = $_FILES["image"]["name"];
        $filetype = $_FILES["image"]["type"];
        $filesize = $_FILES["image"]["size"];

        // Vérifier l'extension du fichier
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (!array_key_exists($ext, $allowed)) {
            $image_err = "Veuillez sélectionner un format de fichier valide (jpg, jpeg, png).";
        }

        // Vérifier la taille du fichier - max 5MB
        if ($filesize > 5 * 1024 * 1024) {
            $image_err = "La taille du fichier ne doit pas dépasser 5MB.";
        }

        // Vérifier le type MIME du fichier
        if (in_array($filetype, $allowed)) {
            // Vérifier les erreurs
            if (empty($image_err)) {
                // Déplacer le fichier téléchargé vers le répertoire de destination
                $new_filename = uniqid() . "." . $ext;
                $destination = "../uploads/" . $new_filename;
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $destination)) {
                    $image = $new_filename;
                } else {
                    $image_err = "Il y a eu une erreur lors du téléchargement de l'image.";
                }
            }
        } else {
            $image_err = "Il y a eu un problème avec le téléchargement de l'image.";
        }
    }

    // Vérifier s'il n'y a pas d'erreur de validation avant d'insérer les données dans la base de données
    if (empty($titre_err) && empty($auteur_err) && empty($description_err) && empty($image_err)) {
        // Préparer une instruction d'insertion SQL
        $sql = "INSERT INTO livres (titre, auteur, description, image) VALUES (?, ?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            // Liaison des variables à la déclaration préparée en tant que paramètres
            $stmt->bind_param("ssss", $param_titre, $param_auteur, $param_description, $param_image);

            // Définir les paramètres
            $param_titre = $titre;
            $param_auteur = $auteur;
            $param_description = $description;
            $param_image = $image;

            // Exécuter la déclaration préparée
            if ($stmt->execute()) {
                // Redirection vers la page de lecture après l'ajout réussi
                header("location: read.php");
                exit();
            } else {
                echo "Oops! Une erreur s'est produite. Veuillez réessayer plus tard.";
            }

            // Fermer la déclaration préparée
            $stmt->close();
        }
    }

    // Fermer la connexion
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un livre</title>
    <link rel="stylesheet" href="../css/styles.css"> <!-- Assurez-vous d'ajuster le chemin en fonction de votre structure -->
</head>
<body>
    <div class="container">
        <h2>Ajouter un livre</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <div class="form-group <?php echo (!empty($titre_err)) ? 'has-error' : ''; ?>">
                <label>Titre</label>
                <input type="text" name="titre" class="form-control" value="<?php echo $titre; ?>">
                <span class="help-block"><?php echo $titre_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($auteur_err)) ? 'has-error' : ''; ?>">
                <label>Auteur</label>
                <input type="text" name="auteur" class="form-control" value="<?php echo $auteur; ?>">
                <span class="help-block"><?php echo $auteur_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($description_err)) ? 'has-error' : ''; ?>">
                <label>Description</label>
                <textarea name="description" class="form-control"><?php echo $description; ?></textarea>
                <span class="help-block"><?php echo $description_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($image_err)) ? 'has-error' : ''; ?>">
                <label>Image</label>
                <input type="file" name="image" class="form-control">
                <span class="help-block"><?php echo $image_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Ajouter">
                <a href="javascript:history.back()" class="btn btn-default">Retour</a> <!-- Bouton pour revenir à la page précédente -->
                <a href="read.php" class="btn btn-default">Voir les livres</a> <!-- Bouton pour aller à la page de visualisation des livres -->
            </div>
        </form>
    </div>
</body>
</html>
