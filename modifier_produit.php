<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include "dbconfig.php";
include "header.php";

if (isset($_SESSION['role']) && $_SESSION['role'] == "1") {
    if (isset($_GET['id'])) {
        $id_produit = $_GET['id'];
        $stmt = $conn->prepare("SELECT * FROM produit WHERE id=?");
        $stmt->bind_param("i", $id_produit);
        $stmt->execute();
        $result = $stmt->get_result();


        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<main class='page-formulaire'>";

            echo "<div class='actions-haut'>";
            echo "<a class='btn-secondaire' href='admin_produits.php'>← Retour au catalogue</a>";
            echo "</div>";

            echo "<div class='carte-formulaire'>";
            echo "<h1 class='titre-formulaire'>Modifier le produit</h1>";

            echo "<form class='formulaire-boulangerie' action='update_produit.php' method='post'>
            <input type='hidden' name='id' value='" . $id_produit . "'>";

            echo "<div class='groupe-champ'>";
            echo "<label class='form-label' for='id_nom'>Nom du produit :</label>";
            echo "<input class='form-input' type='text' id='id_nom' name='nom' value='" . htmlspecialchars($row['nom']) . "'  /><br />";
            echo "</div>";

            echo "<div class='groupe-champ'>";
            echo "<label class='form-label' for='id_description'>Description :</label>";
            echo "<input class='form-input' type='text' id='id_description' name='description' value='" . htmlspecialchars($row['description']) . "'  /><br />";
            echo "</div>";

            echo "<div class='groupe-champ'>";
            echo "<label class='form-label' for='id_prix'>Prix (en €) :</label>";
            echo "<input class='form-input' type='number' step='0.01' id='id_prix' name='prix' min='0' value='" . htmlspecialchars($row['prix']) . "'  /><br />";
            echo "</div>";

            echo "<div class='groupe-champ'>";
            echo "<label class='form-label' for='id_categorie'>Catégorie :</label>";
            echo "<select class='form-select' name='categorie'>";
            echo " <option value='1'>pains</option>";
            echo "   <option value='2'>viennoiseries</option>";
            echo " <option value='3'>pâtisseries</option>";
            echo "</select>";
            echo "</div>";

            echo "<input class='btn-primary btn-submit-form' type='submit' value='Modifier le produit'>";

            echo "</form>";
            echo "</div>";
            echo "</main>";
        }

        $stmt->close();
        $conn->close();
    }
}

include "footer.php";
