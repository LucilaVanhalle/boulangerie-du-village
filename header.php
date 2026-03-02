<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$nb_articles = 0;

// Si le panier existe, compter le nombre d'articles dans le panier
if (isset($_SESSION["panier"])) {
    $nb_articles = count($_SESSION["panier"]);
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav class="navbar">

        <div class="logo"><img src="img/logo.webp" alt="">La Boulangerie du Village</div>

        <ul class="nav-links">
            <li class="nav-item"><a href="index.php">Accueil</a></li>
            <li class="nav-item"><a href="catalogue.php">Catalogue</a></li>
            <li class="nav-item"><a href="infos_pratiques.php">Infos pratiques</a></li>
        </ul>

        <?php
        // On vérifie si c'est l'admin grâce à son rôle
        if (isset($_SESSION['utilisateur_id'])) {
            if (isset($_SESSION['role']) && $_SESSION['role'] == "1") { ?>
                <a href="admin.php">Mon Dashboard de boulanger</a>
            <?php } ?>
            <a href="panier.php">Mon Panier (<?php echo $nb_articles; ?>)</a>
            <a href="deconnexion.php">Se déconnecter</a>
        <?php } else { ?>
            <ul class="navbar">
                <li class="nav-item"><a href="connexion.php">Se connecter</a></li>
                <li class="nav-item"><a href="inscription.php">S'inscrire</a></li>
            </ul>
        <?php } ?>
        <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>