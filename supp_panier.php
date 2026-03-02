<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if (isset($_GET['id_produit'])) {
    $id_produit = $_GET['id_produit'];
    unset($_SESSION["panier"][$id_produit]);
    header("Location: panier.php");
    exit();
}
