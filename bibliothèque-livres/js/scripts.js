// Ce script peut être utilisé pour ajouter des fonctionnalités JavaScript à votre application
// Par exemple, vous pourriez vouloir ajouter des fonctionnalités interactives à vos formulaires ou à vos éléments de navigation

// Exemple de fonction pour confirmer la suppression d'un livre
function confirmDelete() {
    return confirm("Êtes-vous sûr de vouloir supprimer ce livre ?");
}

const input = document.querySelector('input[type="file"]');
input.addEventListener('change', function() {
    const file = input.files[0];
    const formData = new FormData();
    formData.append('image', file);

    fetch('upload.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        console.log(data); // Affiche la réponse du serveur
    })
    .catch(error => {
        console.error('Erreur:', error);
    });
});
