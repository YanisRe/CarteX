<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="signin.css">
    <title>Inscription - CarteX</title>
</head>

<video autoplay muted loop id="video-background">
    <source src="yugiohanimated2.mp4" type="video/mp4">
</video>

<body>
    <div class="login-container">
        <h2>Inscription</h2>
        <form action="signin.php" method="post">
            <label for="username">Nom d'utilisateur:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password" required>

            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="user">Utilisateur</option>
                <option value="admin">Administrateur</option>
            </select>

            <button type="submit">S'inscrire</button>
        </form>
        
        <div class="register-link">
            <div class="register-link">
                <p>Vous avez déja un compte ? <a href="connection.php">Se connecter</a></p>
            </div>
        </div>
    </div>
</body>
</html>

<?php
require __DIR__ . '/vendor/autoload.php'; 

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$host = $_ENV["DB_HOST"];
$database = $_ENV["DB_NAME"];
$user = $_ENV["DB_USERNAME"];
$password = $_ENV["DB_PASSWORD"];

$mysqli = new mysqli($host, $user, $password, $database);

if ($mysqli->connect_error) {
    die("Échec de la connexion à la base de données: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $role = $_POST["role"];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Stocker la valeur 1 ou 0 dans une variable
    $isAdmin = $role === "admin" ? 1 : 0;

    $query = "INSERT INTO users (username, password, is_admin) VALUES (?, ?, ?)";
    $stmt = $mysqli->prepare($query);

    if ($stmt) {
        // Utiliser la variable contenant 1 ou 0 pour bind_param()
        $stmt->bind_param("ssi", $username, $hashedPassword, $isAdmin);
        $stmt->execute();
        echo "Inscription réussie !";
        $stmt->close();
    } else {
        echo "Erreur dans la préparation de la requête: " . $mysqli->error;
    }
}

$mysqli->close();
?>




