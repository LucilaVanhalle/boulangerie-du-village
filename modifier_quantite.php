<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if (isset($_GET['id_produit']) && isset($_GET['action'])) {

    $id_produit = $_GET['id_produit'];
    $action = $_GET['action'];

    if (isset($_SESSION["panier"][$id_produit])) {

        // Le mécanisme n'est pas le même en fonction de l'action envoyée

        if ($action == "ajouter") {
            // S'il y a déjà une quantité, on ajoute de 1
            $_SESSION["panier"][$id_produit]++;
        } elseif ($action == "retirer") {
            // S'il y a déjà une quantité, on diminue de 1
            $_SESSION["panier"][$id_produit]--;

            // S'il n'y a aucune quantité, on supprime le produit du panier
            if ($_SESSION["panier"][$id_produit] == 0) {
                unset($_SESSION["panier"][$id_produit]);
            }
        }
    }
    header("Location: panier.php");
    exit();
}
