<?php
// admin.php

session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
echo "Bienvenue dans le panneau d'administration, " . $_SESSION['username'] . "!";
?>
