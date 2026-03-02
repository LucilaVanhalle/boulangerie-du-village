<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include "dbconfig.php";
include "header.php"; ?>

<main class="page-catalogue">
    <h1 class="titre-catalogue">Notre catalogue de produits</h1>

    <div class="catalogue-grille">

        <?php
        // Requête simple pour grouper les produits par catégorie
        $sql = "SELECT produit.*, categorie.nom AS nom_categorie
        FROM produit
        JOIN categorie ON produit.id_categorie = categorie.id
        ORDER BY produit.id_categorie, produit.nom";
        $result = $conn->query($sql);

        $categorie_actuelle = "";

        if ($result->num_rows > 0) {
            // Tant qu'il reste une ligne de produit à lire dans les résultats, on l'extrait sous forme de tableau associatif
            while ($row = $result->fetch_assoc()) {
                // Si la catégorie actuelle est différente de celle dans la ligne en cours, il s'agit donc d'un nouvel en-tête
                if ($categorie_actuelle != $row['nom_categorie']) {
                    echo "<div class='categorie-en-tete'>";
                    echo "<h2 class='categorie-titre'>Nos " . htmlspecialchars($row['nom_categorie']) . "</h2>";
                    echo "</div>";

                    $categorie_actuelle = $row['nom_categorie'];
                }
        ?>
                <div class="produit-carte">
                    <div class="produit-conteneur-interne">
                        <img src="<?php echo htmlspecialchars($row['image']); ?>" class="produit-image" alt="Photo de <?php echo htmlspecialchars($row['nom']); ?>">

                        <div class="produit-infos">
                            <h5 class="produit-nom"><?php echo htmlspecialchars($row['nom']); ?></h5>
                            <p class="produit-description"><?php echo htmlspecialchars($row['description']); ?></p>
                            <p class="produit-prix"><?php echo number_format($row['prix'], 2, ',', ' '); ?> €</p>
                            <form class="produit-formulaire" action="gestion_panier.php" method="POST">
                                <input class="champ-quantite" type="number" name="quantite" value="1" min="1" /><br />
                                <input type="hidden" name="id_produit" value="<?php echo htmlspecialchars($row['id']); ?>">
                                <input class="btn-ajouter" type="submit" value="Ajouter au panier" />
                            </form>
                        </div>
                    </div>
                </div>
        <?php }
        } else {
            echo "<p class='message-vide'>Aucun produit n'est disponible pour le moment.</p>";
        }

        $conn->close();
        ?>
    </div>
</main>

<?php
include "footer.php";
