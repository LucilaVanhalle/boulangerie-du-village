<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

include "dbconfig.php";
include "header.php";

// Dans toutes les pages dédiées à l'admin, on impose cette vérification pour éviter qu'un client ait accès à la gestion
if (isset($_SESSION['role']) && $_SESSION['role'] == "1") {

    echo "<main class='page-admin'>";
    echo "<h1 class='admin-titre'>Mon dashboard de boulanger</h1>";

    echo "<div class='admin-boutons-haut'>";
    echo "<a class='btn-secondaire' href='admin_produits.php'>Gérer le catalogue</a>";
    echo "</div>";


    $sql = ("SELECT nom, prenom, tel, email, adresse, commande.num_commande, commande.date_commande, commande.statut FROM utilisateur JOIN commande ON utilisateur.id= commande.id_utilisateur");
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<div class='table-responsive'>";
        echo "<table class='admin-table'><tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Téléphone</th>
        <th>Email</th>
        <th>Adresse</th>
        <th>N° de commande</th>
        <th>Date</th>
        <th>Statut</th>
        <th colspan='2'>Actions</th>
    </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["nom"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["prenom"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["tel"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["adresse"]) . "</td>";
            echo "<td><strong>" . htmlspecialchars($row["num_commande"]) . "</strong></td>";
            echo "<td>" . htmlspecialchars($row["date_commande"]) . "</td>";
            echo "<td><span class='badge-statut'>" . htmlspecialchars($row["statut"]) . "</span></td>";

            // Liens utilisant la méthode GET pour envoyer le numéro de commande et l'action à effectuer au fichier modifier_statut.php
            echo "<td><a class='btn-action btn-prete' href='modifier_statut.php?num_commande=" . $row["num_commande"] . "&new_statut=prete'>Marquer comme 'Prête à être livrée'</a></td>";
            echo "<td><a class='btn-action btn-livree' href='modifier_statut.php?num_commande=" . $row["num_commande"] . "&new_statut=livree'>Marquer comme 'Livrée'</a></td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
    } else {
        echo "<p class='admin-message'>Aucune nouvelle commande...</p>";
    }

    echo "</main>";
    include "footer.php";
}
