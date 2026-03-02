<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

include "dbconfig.php";
include "header.php";

echo "<main class='page-accueil'>";

// La grande bannière message de bienvenue
echo "<div class='accueil-banniere'>";
echo "<h1 class='accueil-titre'>Bienvenue sur le site de la Boulangerie du Village !</h1>";
echo "<p class='accueil-sous-titre'>Des pains artisanaux, des viennoiseries savoureuses et des pâtisseries délicates.</p>";
echo "<a href='catalogue.php' class='btn-primary' style='margin-top: 1rem;'>Découvrir nos produits</a>";
echo "</div>";

// On limite à 3 pour n'avoir que 3 produits affichés sur la page
$sql = "SELECT nom, image, prix FROM produit LIMIT 3";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2 class='accueil-section-titre'>Nos suggestions gourmandes</h2>";
    echo "<div class='accueil-grille-produits'>";

    while ($row = $result->fetch_assoc()) {
        echo "<div class='accueil-carte-produit'>";
        echo "<img class='accueil-image' src='" . htmlspecialchars($row['image']) . "' alt='Photo de " . htmlspecialchars($row['nom']) . "'>";

        echo "<div class='accueil-infos-produit'>";
        echo "<h5 class='accueil-nom-produit'>" . htmlspecialchars($row['nom']) . "</h5>";
        // number_format() pour afficher le prix avec les centimes et avec une virgule au lieu d'un point (car c'est commun d'utiliser une virgule pour les prix)
        echo "<p class='accueil-prix'>" . number_format($row['prix'], 2, ',', ' ') . " €</p>";
        echo "</div>";

        echo "</div>";
    }

    echo "</div>";
}

echo "</main>";

include "footer.php";
