<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CarteX - Accueil</title>
    <link rel="stylesheet" href="PageAccueil.css">
</head>
<body>

<h1>Bienvenue sur CarteX - Gestion de Cartes Yu-Gi-Oh!</h1>

<form action="search.php" method="POST">
    <label for="card_name">Nom de la carte :</label>
    <input type="text" name="card_name" placeholder="Entrez le nom de la carte">
    
    <label for="card_id">ID de la carte :</label>
    <input type="text" name="card_id" placeholder="Entrez l'ID de la carte">
    <button type="submit">Rechercher</button>
</form>

<div class="cards-container">
    <?php
    //système permettant la connexion sans afficher les identifiants
    require_once __DIR__ . "/vendor/autoload.php"; 

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    $servername = $_ENV["DB_HOST"];
    $port = $_ENV["DB_PORT"];
    $dbname = $_ENV["DB_NAME"];
    $username = $_ENV["DB_USERNAME"];
    $password = $_ENV["DB_PASSWORD"];

    $conn = new mysqli($servername, $username, $password, $dbname);

    //on regarde si la connexion se fait bien
    if ($conn->connect_error) {
        die("Connexion échouée: " . $conn->connect_error);
    }

    //on recupere les données des cartes
    $sql = "SELECT * FROM cards";
    $result = $conn->query($sql);

    //système d'affichage des cartes
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="card">';
            echo '<h2>' . $row['nom'] . '</h2>';
            echo '<p>' . $row['description'] . '</p>';
            echo '<img src="' . $row['imageUrl'] . '" alt="' . $row['nom'] . '">';
            echo '</div>';
        }
    } else {
        echo "Aucune carte trouvée.";
    }

    //déconnexion de la BDD
    $conn->close();
    ?>
</div>

</body>
</html>
