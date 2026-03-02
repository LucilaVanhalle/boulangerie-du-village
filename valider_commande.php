<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include "dbconfig.php";
include "header.php";

// On donne un numéro de commande aléatoire, le 10000 c'est pour garantir les 5 chiffres
$num_commande = "CMD-" . rand(10000, 99999);

// CURRENT_DATE() pour mettre la date du jour au moment de valider
$stmt = $conn->prepare("INSERT INTO commande (num_commande, date_commande, statut, id_utilisateur) VALUES (?, CURRENT_DATE(), 'En préparation', ?)");
$stmt->bind_param("si", $num_commande, $_SESSION["utilisateur_id"]);

if ($stmt->execute() === TRUE) {

    // On récupère l'id de la commande qui vient juste d'être généré
    $last_id = $conn->insert_id;

    // On refait une autre requête pour insérer dans la table intermédiaire qui relie les commandes et les produits
    foreach ($_SESSION["panier"] as $id_produit => $quantite) {
        $stmt_details = $conn->prepare("INSERT INTO details_commande (id_commande, id_produit, quantite) VALUES (?, ?, ?)");
        $stmt_details->bind_param("iii", $last_id, $id_produit, $quantite);
        $stmt_details->execute();
    }
    // On vide le panier après la validation
    unset($_SESSION["panier"]);

    echo "<main class='page-confirmation'>";
    echo "<div class='carte-confirmation'>";
    echo "<h2 class='titre-confirmation'>Commande confirmée !</h2>";
    echo "<p class='texte-confirmation'>Merci pour votre commande. Veuillez noter que le paiement s'effectuera à la livraison.</p>";
    echo "<div style='margin-top: 2rem;'>
                <a href='index.php' class='btn-primary'>Retour à l'accueil</a>
            </div>";
    echo "</div>
    </main>";
}

include "footer.php";
