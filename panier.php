<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include "dbconfig.php";
include "header.php";
?>

<main class="page-panier">
    <h1 class="titre-panier">Récapitulatif du panier</h1>

    <?php

    // On vérifie si le panier existe et n'est pas vide
    if (isset($_SESSION["panier"]) && !empty($_SESSION["panier"])) {

        $total_commande = 0;

        // On crée les en-têtes du tableau
        echo "<div class='table-responsive'>";
        echo "<table class='admin-table'><tr>
        <th>Nom de l'article</th>
        <th>Prix</th>
        <th>Quantité</th>
        <th>Sous-total</th>
        <th>Actions</th>
    </tr>";

        // La boucle passe en revue le tableau panier et assigne la valeur de $quantite à la clé $id_produit
        foreach ($_SESSION["panier"] as $id_produit => $quantite) {
            $stmt = $conn->prepare("SELECT nom, prix FROM produit WHERE id= ?");
            $stmt->bind_param("i", $id_produit);

            $stmt->execute();

            $result = $stmt->get_result();

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {
                    // On accumule les sous-totaux pour en faire le prix total
                    $total_commande = $total_commande + ($row["prix"] * $quantite);
                    echo "<tr>";
                    echo "<td><strong>" . htmlspecialchars($row["nom"]) . "</strong></td>";
                    echo "<td>" . htmlspecialchars($row["prix"]) . " €</td>";
                    echo "<td>" . $quantite . "</td>";
                    echo "<td><strong>" . htmlspecialchars(number_format(($row["prix"] * $quantite), 2, ',', ' ')) . " €</strong></td>";

                    // On fait deux liens qui envoient par la méthode GET l'id du produit en question ainsi que l'action à effectuer
                    echo "<td><a class='btn-qty' href='modifier_quantite.php?id_produit=" . $id_produit . "&action=ajouter'>+</a>";
                    echo "<a class='btn-qty' href='modifier_quantite.php?id_produit=" . $id_produit . "&action=retirer'>-</a>";
                    echo "<a class='btn-action btn-supprimer' href='supp_panier.php?id_produit=" . $id_produit . "'>Supprimer</a></td>";
                    echo "</tr>";
                }
            }
        }

        echo "<tr class='panier-ligne-total'><td colspan='4' style='text-align: right; padding-right: 1rem;'><strong>Total de la commande</strong></td><td>" . number_format($total_commande, 2, ',', ' ') . " €</td></tr>";
        echo "</table>";
        echo "</div>";

        echo "<div class='panier-validation'>";
        // En POST car cela va insérer des données dans la bdd
        echo "<form action='valider_commande.php' method='POST'>
    <input class='btn-primary btn-grand' type='submit'value='Valider ma commande'></form>";
    } else {
        echo "Votre panier est vide :(";
    }

    echo "</main>";

    include "footer.php";
