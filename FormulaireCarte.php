<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $card_id = $_POST["card_id"];
    $card_name = $_POST["card_name"];
    $card_description = $_POST["card_description"];
    $image_url = $_POST["image_url"];
    $card_price = $_POST["card_price"];
    $rarity = $_POST["rarity"];
    $is_banned = $_POST["is_banned"];

    // Vous devrez configurer la connexion à votre base de données ici
    $servername = "votre_serveur";
    $username = "votre_nom_utilisateur";
    $password = "votre_mot_de_passe";
    $dbname = "votre_base_de_donnees";

    // Créer une connexion à la base de données
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("La connexion a échoué : " . $conn->connect_error);
    }

    // Préparer la requête SQL pour l'insertion
    $sql = "INSERT INTO cards (card_id, card_name, card_description, image_url, card_price, rarity, is_banned)
            VALUES ('$card_id', '$card_name', '$card_description', '$image_url', '$card_price', '$rarity', '$is_banned')";

    // Exécuter la requête SQL
    if ($conn->query($sql) === TRUE) {
        echo "La carte a été ajoutée avec succès.";
    } else {
        echo "Erreur lors de l'ajout de la carte : " . $conn->error;
    }

    // Fermer la connexion à la base de données
    $conn->close();
}
?>
