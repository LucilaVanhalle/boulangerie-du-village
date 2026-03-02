<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include "dbconfig.php";

if (isset($_SESSION['role']) && $_SESSION['role'] == "1") {

    if (isset($_GET['num_commande']) && isset($_GET['new_statut'])) {
        $num_commande = $_GET['num_commande'];
        $new_statut = $_GET['new_statut'];

        // On va update le statut selon la variable new_statut envoyée
        if ($new_statut == "prete") {
            $stmt = $conn->prepare("UPDATE commande SET statut = 'Prête à être livrée' WHERE num_commande = ?");
            $stmt->bind_param('s', $num_commande);
            $stmt->execute();
            $stmt->close();
        } elseif ($new_statut == "livree") {
            $stmt = $conn->prepare("UPDATE commande SET statut = 'Livrée' WHERE num_commande = ?");
            $stmt->bind_param('s', $num_commande);
            $stmt->execute();
            $stmt->close();
        }
    }

    $conn->close();

    header("Location: admin.php");
    exit();
}
