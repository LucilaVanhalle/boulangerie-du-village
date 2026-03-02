<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Ce fichier permet de se connecter à la base de données depuis PHP

$servername = "db";
$username = ""; // Mettre ici votre utilisateur phpMyAdmin
$password = ""; // Mettre ici votre mot de passe phpMyAdmin
$dbname = "boulangerie"; // Nom de la base de données

$conn = new mysqli($servername, $username, $password, $dbname);

$conn->set_charset("utf8mb4");

if ($conn->connect_error) {
    die("Echec de la connexion " . $conn->connect_error);
}
