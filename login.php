<?php
$host = "localhost";
$user = "nomUtilisateur";
$password = "motDePasse";
$database = "cartex";

$mysqli = new mysqli($host, $user, $password, $database);

if ($mysqli->connect_error) {
    die("Échec de la connexion à la BDD" . $mysqli->connect_error);
}

$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
$role = $_POST['role'];

$query = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
$stmt = $mysqli->prepare($query);

if ($stmt) {
    $stmt->bind_param("sss", $username, $password, $role);
    $stmt->execute();
    $stmt->close();
} else {
    echo "Erreur" . $mysqli->error;
}
if ($stmt->execute()) {
    session_start();
    $_SESSION['username'] = $username;
    $_SESSION['role'] = $role;
    header("Location: admin.php");
    exit();
} else {
    echo "Erreur" . $stmt->error;
}
            
$mysqli->close();
?>