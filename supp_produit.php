<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include "dbconfig.php";

if (isset($_SESSION['role']) && $_SESSION['role'] == "1") {

    if (isset($_GET['id'])) {
        $id_produit = $_GET['id'];
        $stmt = $conn->prepare("DELETE FROM produit WHERE id=?");
        $stmt->bind_param("i", $id_produit);

        $stmt->execute();

        $stmt->close();
        $conn->close();

        header("Location: admin_produits.php");
        exit();
    }
}
