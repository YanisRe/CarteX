<?php
$host = "localhost";
$user = "nomUtilisateur";
$password = "motDePasse";
$database = "cartex";
$mysqli = new mysqli($host, $user, $password, $database);

if ($mysqli->connect_error) {
    die("Échec de la connexion à la BDD " . $mysqli->connect_error);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $mysqli->prepare($query);
    if ($stmt) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                echo "Connexion réussie!";
            } else {
                echo "Nom d'utilisateur ou mot de passe incorrect.";
            }
        } else {
            echo "Nom d'utilisateur ou mot de passe incorrect.";
        }
        $stmt->close();
    } else {
        echo "Erreur dans la préparation de la requête: " . $mysqli->error;
    }
}

$mysqli->close();
?>
