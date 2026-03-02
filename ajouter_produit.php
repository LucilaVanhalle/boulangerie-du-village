<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include "dbconfig.php";

if (isset($_SESSION['role']) && $_SESSION['role'] == "1") {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (!empty($_POST['nom']) && !empty($_POST['description']) && !empty($_POST['prix']) && !empty($_POST['categorie'])) {
            $nom = $_POST['nom'];
            $description = $_POST['description'];
            $prix = $_POST['prix'];
            $categorie = $_POST['categorie'];

            $stmt = $conn->prepare("INSERT INTO produit (nom, description, prix, id_categorie) VALUES (?,?,?,?)");
            $stmt->bind_param("ssdi", $nom, $description, $prix, $categorie);

            // Execution et message de confirmation
            if ($stmt->execute()) {
                $stmt->close();
                $conn->close();
                header("Location: admin_produits.php");
                exit();
            } else {
                echo "<p class='msg-erreur'>Erreur lors de l'ajout : " . $stmt->error . "</p>";
            }
        } else {
            echo "<p class='msg-erreur'>Veuillez remplir tous les champs.</p>";
        }
    }

    include "header.php"; ?>

    <main class="page-formulaire">
        <div class="actions-haut">
            <a class="btn-secondaire" href="admin_produits.php">Retour à la gestion de catalogue</a>
        </div>

        <div class="carte-formulaire">
            <h1 class="titre-formulaire">Ajout d'un produit</h1>
            <form class="formulaire-boulangerie" action="ajouter_produit.php" method="post">

                <div class="groupe-champ">
                    <label class="form-label" for="id_nom">Nom du produit :</label><br />
                    <input class="form-input" type="text" id="id_nom" name="nom" value="" required /><br />
                </div>

                <div class="groupe-champ">
                    <label class="form-label" for="id_description">Description :</label><br />
                    <input class="form-input" type="text" id="id_description" name="description" value="" required /><br />
                </div>

                <div class="groupe-champ">
                    <label class="form-label" for="id_prix">Prix :</label><br />
                    <input class="form-input" type="number" id="id_prix" step="0.01" name="prix" value="" required /><br />
                    <label class="form-label" for="id_categorie">Catégorie :</label>
                    <select class="form-select" name="categorie">
                        <!-- J'ai déterminé la value en fonction de l'id de la catégorie tout en laissant les noms des catégories pour l'admin-->
                        <option value='1'>pains</option>
                        <option value='2'>viennoiseries</option>
                        <option value='3'>pâtisseries</option>
                    </select><br />
                </div>
                <input class="btn-primary btn-submit-form" type="submit" value="Ajouter le produit">

            </form>
        </div>
    </main>

<?php include "footer.php";
} ?>