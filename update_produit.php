<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include "dbconfig.php";

if (isset($_SESSION['role']) && $_SESSION['role'] == "1") {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id_produit = $_POST['id'];
        $nom = $_POST['nom'];
        $description = $_POST['description'];
        $prix = $_POST['prix'];
        $categorie = $_POST['categorie'];

        $stmt = $conn->prepare("UPDATE produit SET nom=?, description=?, prix=?, id_categorie=? WHERE id=?");
        $stmt->bind_param("ssdii", $nom, $description, $prix, $categorie, $id_produit);

        $stmt->execute();

        $stmt->close();
        $conn->close();

        header("Location: admin_produits.php");
        exit();
    }
}
