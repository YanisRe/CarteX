<?php
$host = "localhost";
$user = "nomUtilisateur";
$password = "motDePasse";
$database = "cartex";

$mysqli = new mysqli($host, $user, $password, $database);

if ($mysqli->connect_error) {
    die("Échec de la connexion à la base de données: " . $mysqli->connect_error);
}

$username = $_POST['username'];
$role = $_POST['role'];

$query = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
$stmt = $mysqli->prepare($query);

if ($stmt) {
    $stmt->bind_param("sss", $username, $password, $role);
    $stmt->execute();
    $stmt->close();
} else {
    echo "Erreur dans la préparation de la requête: " . $mysqli->error;
}

$mysqli->close();
?>