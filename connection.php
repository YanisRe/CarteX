<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="signin.css">
    <title>Connexion - CarteX</title>
</head>

<video autoplay muted loop id="video-background">
    <source src="yugiohanimated2.mp4" type="video/mp4">
</video>

<body>
    <div class="login-container">
        <h2>Connexion</h2>
        <form action="connection.php" method="post">
            <label for="username">Nom d'utilisateur:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Se connecter</button>
        </form>
        
        <div class="register-link">
            <p>Vous n'avez pas de compte ? <a href="signin.php">S'inscrire</a></p>
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

session_start(); //on démarre la session

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $mysqli->prepare($query);

    if ($stmt) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $user['is_admin'] === 1 ? 'admin' : 'user';
                echo "Connexion réussie ! Redirection dans 5 secondes...";
                echo "<script>setTimeout(function(){window.location.href='PageAccueil.php';},5000);</script>";
            } else {
                echo "Nom d'utilisateur ou mot de passe incorrect.";
            }
        } else {
            echo "Nom d'utilisateur ou mot de passe incorrect.";
        }
        $stmt->close();
    } else {
        echo "Erreur dans la requete ... " . $mysqli->error;
    }
}

$mysqli->close();
?>

