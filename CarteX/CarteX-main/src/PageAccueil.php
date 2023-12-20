<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CarteX - Accueil</title>
    <link rel="stylesheet" href="PageAccueil.css">
</head>
<body>

<h1>Bienvenue sur CarteX - Gestion de Cartes Yu-Gi-Oh!</h1>

<!-- Formulaire de recherche par nom et par ID -->
<form action="search.php" method="GET">
    <label for="card_name">Nom de la carte :</label>
    <input type="text" name="card_name" placeholder="Entrez le nom de la carte">
    
    <label for="card_id">ID de la carte :</label>
    <input type="text" name="card_id" placeholder="Entrez l'ID de la carte">

    <button type="submit">Rechercher</button>
</form>

<?php
   
?>

</body>
</html>
