<h1>La Boulangerie du Village</h1>

Salut ! Moi c'est Lucila, étudiante en DSP Assistant Intégrateur Web au CNAM. Ce repo, c'est mon tout premier "vrai" projet de développement web. On nous a demandé de digitaliser une boulangerie artisanale et je ne pensais pas que j'allais autant m'amuser (et passer autant de nuits blanches sur du PHP).

<h2>Mes montagnes russes avec le PHP</h2>

Si on m'avait dit au début de l'année que je kifferais le PHP, je ne l'aurais pas cru. Pourtant, c'est devenu mon langage préféré. J'ai adoré comprendre l'envers du décor : comment on passe d'une page statique à un site vivant où un client peut vraiment commander son pain.

<ul><h3>Ce que j'ai réussi à faire :</h3>

**<li>Le Catalogue :** Tout est rangé par catégories (pains, viennoiseries, pâtisseries) avec des requêtes SQL dynamiques.</li>
**<li>Le Panier :** Un vrai moteur de calcul avec les $\_SESSION. On peut ajouter, modifier les quantités et supprimer ses articles.</li>
**<li>Le Dashboard Admin :** Ma petite fierté. Le boulanger peut voir ses commandes en temps réel et changer leur statut (Prête, Livrée).</li></ul>

<h2>Mes fails (et comment je m'en suis sortie)</h2>

C'est là que j'ai le plus appris, même si sur le moment, j'ai failli arracher mes cheveux :

**<li>Le bug du "header" fantôme :** Au début, mes redirections et mes sessions plantaient tout le temps avec des messages d'erreurs bizarres. J'ai fini par comprendre (après de longues recherches...) qu'en PHP, il ne faut absolument rien envoyer au navigateur (pas même un petit espace HTML) avant d'appeler session_start() ou header(). Une fois que j'ai déplacé mon code PHP tout en haut, miracle : ça marchait !

**<li>L'admin qui ne pouvait pas ajouter de photos :** J'avais configuré ma base de données pour que l'image d'un produit soit obligatoire (NOT NULL). Résultat : dès que je voulais tester l'ajout d'un produit rapidement sans photo, tout bloquait. J'ai dû faire mon premier ALTER TABLE pour enlever cette contrainte et rendre l'interface plus souple pour le boulanger.

**<li>Le pop-up de l'enfer au rafraîchissement :** À chaque fois que je cliquais sur "Actualiser" après une inscription, ça renvoyait le formulaire et créait un deuxième utilisateur. C'est là que j'ai découvert l'importance des redirections après un POST pour vider la mémoire du navigateur.

<h2>Côté sécurité</h2>

Même si je débute, je voulais que mon site soit propre :

**<li>Mots de passe :** Toujours hachés avec password_hash(), impossible de les lire en clair.</li>
**<li>Requêtes préparées :** Mon bouclier contre les injections SQL.</li>
**<li>Sanitisation côté affichage :** Un petit coup de htmlspecialchars() sur tout ce qui s'affiche.</li></ul>

<ol><h2>Guide d'installation</h2>

<li>Lancer Docker : docker-compose up -d.</li>
<li>Importer boulangerie.sql dans phpMyAdmin (localhost:8081).</li>
<li>Aller sur localhost:8080/boulangerie/index.php.</li></ol>

Pour tester le Dashboard Admin :
**<li>Login :** admin@boulangerie.com</li>
**<li>MDP :** admin</li>

_Fait avec :heart: (et pas mal de sueur) par Lucila VANHALLE._
