<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include "header.php"; ?>

<main class="page-infos">
    <h1 class="infos-titre-principal">Infos pratiques</h1>

    <div class="infos-carte">
        <h2 class="infos-nom-boutique">La Boulangerie du Village</h2>
        <p class="infos-texte">123 Rue de la Farine</p>
        <p class="infos-texte">95780 La Roche-Guyon</p>
        <p class="infos-texte">Téléphone : 01 02 03 04 05</p>

        <h3 class="infos-sous-titre">Horaires d'ouverture :</h3>
        <div class="infos-bloc-horaires">
            <p class="infos-horaire">Lundi : 7h00-20h00</p>
            <p class="infos-horaire">Mardi : 7h00-20h00</p>
            <p class="infos-horaire">Mercredi : 7h00-20h00</p>
            <p class="infos-horaire">Jeudi : 7h00-20h00</p>
            <p class="infos-horaire">Vendredi 7h00-20h00</p>
            <p class="infos-horaire">Samedi : 7h00-20h00</p>
            <p class="infos-horaire infos-dimanche"">Dimanche : 7h00-13h00</p>
        </div>

        <h3 class=" infos-sous-titre">Modalités de livraison :</h3>
            <ul class="infos-liste">
                <li>Livraison à domicile</li>
                <li>Retrait sur place</li>
            </ul>
        </div>
</main>

<?php include "footer.php"; ?>