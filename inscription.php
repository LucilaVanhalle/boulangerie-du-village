<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include "dbconfig.php";
include "header.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sécurité pour ceux qui essaieraient de contourner le required en html
    if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['adresse']) && !empty($_POST['telephone'])) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $tel = $_POST['telephone'];
        $adresse = $_POST['adresse'];

        // On vérifie bien si les mots de passe sont identiques
        if ($_POST['password'] !== $_POST['password_confirmation']) {
            echo "Les mots de passe ne correspondent pas.";
        } else {
            $mot_de_passe = password_hash($_POST['password'], PASSWORD_DEFAULT);

            // Requête préparée
            $stmt = $conn->prepare("INSERT INTO utilisateur (nom, prenom, email, tel, adresse, mot_de_passe, role) VALUES (?,?,?,?,?,?, 0)");
            $stmt->bind_param("ssssss", $nom, $prenom, $email, $tel, $adresse, $mot_de_passe);

            // Execution et message de confirmation
            if ($stmt->execute()) {
                echo "<p class='msg-succes'>Inscription réussie</p>";
            } else {
                echo "<p class='msg-erreur'>Erreur lors de l'inscription : " . $stmt->error . "</p>";
            }

            // On clôture la requête et on ferme la connexion à la bdd
            $stmt->close();
            $conn->close();
        }
    } else {
        echo "<p class='msg-erreur'>Veuillez remplir tous les champs obligatoires.</p>";
    }
}
?>

<main class="page-formulaire">
    <div class="carte-formulaire">
        <h1 class="titre-formulaire">Inscription</h1>
        <form class="formulaire-boulangerie" action="inscription.php" method="post">

            <div class="groupe-champ">
                <label class="form-label" for="id_nom">Nom :</label><br />
                <input class="form-input" type="text" id="id_nom" name="nom" value="" required /><br />
            </div>

            <div class="groupe-champ">
                <label class="form-label" for="id_prenom">Prénom :</label><br />
                <input class="form-input" type="text" id="id_prenom" name="prenom" value="" required /><br />
            </div>

            <div class="groupe-champ">
                <label class="form-label" for="id_email">Email :</label><br />
                <input class="form-input" type="email" id="id_email" name="email" value="" required /><br />
            </div>

            <div class="groupe-champ">
                <label class="form-label" for="id_tel">Numéro de téléphone :</label><br />
                <input class="form-input" type="text" id="id_tel" name="telephone" value="" required /><br />
            </div>

            <div class="groupe-champ">
                <label class="form-label" for="id_adresse">Adresse :</label><br />
                <input class="form-input" type="text" id="id_adresse" name="adresse" value="" /><br />
            </div>

            <div class="groupe-champ">
                <label class="form-label" for="id_password">Mot de passe :</label><br />
                <input class="form-input" type="password" id="id_password" name="password" value="" required /><br />
            </div>

            <div class="groupe-champ">
                <label class="form-label" for="id_conf_password">Confirmer le mot de passe :</label><br />
                <input class="form-input" type="password" id="id_conf_password" name="password_confirmation" value="" required /><br />
            </div>

            <input class="btn-primary btn-submit-form" type="submit" value="S'inscrire">
        </form>
    </div>
</main>

<?php include "footer.php"; ?>