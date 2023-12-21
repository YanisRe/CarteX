<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - CarteX</title>
</head>
<body>
    <header>
        <h1>Profil de <?php echo $user['username']; ?></h1>
        <a href="accueil.php">Retourner à l'accueil</a>
    </header>
    <div class="main-content">
        <h2>Informations du Profil</h2>
        <p>Nom d'utilisateur: <?php echo $user['username']; ?></p>
        <form action="connection.php" method="post">
            <button type="submit">Se déconnecter</button>
        </form>
    </div>
</body>
</html>
