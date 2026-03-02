<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include "dbconfig.php";
include "header.php";

if (isset($_SESSION['role']) && $_SESSION['role'] == "1") {

    echo "<main class='page-admin'>";
    echo "<h1 class='admin-titre'>Gestion du catalogue</h1>";

    echo "<div class='admin-boutons-haut' style='display: flex; justify-content: center; gap: 1.5rem;'>";
    echo "<a class='btn-primary' style='text-decoration: none;' href='ajouter_produit.php'>Ajouter un produit</a>";
    echo "<a class='btn-secondaire' href='admin.php'>Retour au dashboard</a>";
    echo "</div>";

    $sql = ("SELECT id, nom, description, prix FROM produit");
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<div class='table-responsive'>";
        echo "<table class='admin-table'><tr>
        <th>Nom du produit</th>
        <th>Description</th>
        <th>Prix</th>
        <th colspan='2'>Actions</th>
    </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td><strong>" . htmlspecialchars($row["nom"]) . "</strong></td>";
            echo "<td>" . htmlspecialchars($row["description"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["prix"]) . "</td>";
            echo "<td><a class='btn-action btn-modifier' href='modifier_produit.php?id=" . $row["id"] . "'>Modifier</a></td>";
            // On met un pop up de confirmation pour la suppression pour éviter les erreurs
            echo "<td><a class='btn-action btn-supprimer' href='supp_produit.php?id=" . $row["id"] . "' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer ce produit ?\");'>Supprimer</a></td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
    }

    echo "</main>";
    include "footer.php";
}
