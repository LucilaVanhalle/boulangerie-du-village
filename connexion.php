<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include "dbconfig.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST['email']) && !empty($_POST['password'])) {

        $email = $_POST['email'];
        $mdp_saisi = $_POST['password'];

        $stmt = $conn->prepare("SELECT * FROM utilisateur WHERE email = ?");
        $stmt->bind_param("s", $email);

        $stmt->execute();
        $result = $stmt->get_result();
        $utilisateur = $result->fetch_assoc();

        // On vérifie que le mot de passe saisi par l'utilisateur est bien celui inscrit dans la bdd
        if ($utilisateur && password_verify($mdp_saisi, $utilisateur['mot_de_passe'])) {
            $_SESSION['utilisateur_id'] = $utilisateur['id'];
            $_SESSION['prenom'] = $utilisateur['prenom'];
            $_SESSION['role'] = $utilisateur['role'];

            header("Location: index.php");
            exit();
        } else {
            $error = "Identifiants incorrects.";
        }
    }
}

include "header.php";
?>

<main class="page-formulaire">
    <div class="carte-formulaire">
        <h1 class="titre-formulaire">Connexion</h1>

        <?php if (isset($error)) {
            echo "<p style='color: red;'>" . $error . "</p>";
        } ?>

        <form class="formulaire-boulangerie" action="connexion.php" method="post">

            <div class="groupe-champ">
                <label class="form-label" for="id_email" class="form-label">Email :</label>
                <input class="form-input" type="email" id="id_email" name="email" required />
            </div>

            <div class="groupe-champ">
                <label class="form-label" for="id_password" class="form-label">Mot de passe :</label>
                <input class="form-input" type="password" id="id_password" name="password" required />
            </div>

            <input class="btn-primary btn-submit-form" type="submit" value="Se connecter" />
        </form>
    </div>
</main>

<?php
include "footer.php";
?>