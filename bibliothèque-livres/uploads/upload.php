<?php
// Vérifie si le fichier a été envoyé sans erreur
if(isset($_FILES["image"]) && $_FILES["image"]["error"] == 0){
    $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "png" => "image/png");
    $filename = $_FILES["image"]["name"];
    $filetype = $_FILES["image"]["type"];
    $filesize = $_FILES["image"]["size"];

    // Vérifie l'extension du fichier
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if(!array_key_exists($ext, $allowed)){
        echo "Erreur: Veuillez sélectionner un format de fichier valide (jpg, jpeg, png).";
        exit();
    }

    // Vérifie la taille du fichier - max 5MB
    $maxsize = 5 * 1024 * 1024;
    if($filesize > $maxsize){
        echo "Erreur: La taille du fichier ne doit pas dépasser 5MB.";
        exit();
    }

    // Vérifie le type MIME du fichier
    if(in_array($filetype, $allowed)){
        // Vérifie les erreurs
        if(move_uploaded_file($_FILES["image"]["tmp_name"], "../uploads/" . $filename)){
            echo "Le fichier ". $filename. " a été téléchargé avec succès.";
        } else{
            echo "Erreur: Il y a eu un problème avec le téléchargement du fichier. Veuillez réessayer.";
        }
    } else{
        echo "Erreur: Il y a eu un problème avec le téléchargement du fichier. Veuillez réessayer.";
    }
} else{
    echo "Erreur: " . $_FILES["image"]["error"];
}
?>
