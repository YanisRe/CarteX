<?php
// Vérifier si le formulaire de création a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $cardId = $_POST['card_id'];
    
    // Récupérer les données de l'API
    $cardData = fetchCardData($cardId);

    // Enregistrer la carte dans un fichier
    saveCardToFile($cardData['data'][0], 'cards.txt');

    echo "La carte a été créée avec succès!";
}
?>

<!-- Formulaire de création de carte -->
<form action="create_card.php" method="POST">
    <label for="card_id">ID de la carte Yu-Gi-Oh! :</label>
    <input type="text" name="card_id" required>
    <button type="submit">Créer la carte</button>
</form>
