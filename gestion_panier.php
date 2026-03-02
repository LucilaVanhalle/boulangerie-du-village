<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// On regarde si le panier existe, sinon on le crée sous forme de tableau
if (!isset($_SESSION["panier"])) {
    $_SESSION["panier"] = [];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST["id_produit"]) && !empty($_POST["quantite"])) {
        $id_produit = $_POST["id_produit"];
        $quantite = $_POST["quantite"];
        // On vérifie à l'intérieur du panier si le produit avec cet id a déjà été ajouté ou pas
        if (isset($_SESSION["panier"][$id_produit])) {

            // Si oui, on rajoute à la quantité existante la nouvelle quantité
            $_SESSION["panier"][$id_produit] = $_SESSION["panier"][$id_produit] + $quantite;

            // Sinon, on assigne cette nouvelle quantité directement
        } else {
            $_SESSION["panier"][$id_produit] = $quantite;
        }
    }
}

header("Location: catalogue.php");
exit();

/* Panier est un tableau qui a pour clé $id_produit qui est l'id du produit ajouté.
Donc le tableau panier a autant de clés que de produits ajoutés.*/
