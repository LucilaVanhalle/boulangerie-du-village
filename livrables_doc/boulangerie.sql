-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le : ven. 27 fév. 2026 à 14:16
-- Version du serveur : 10.11.15-MariaDB-ubu2204
-- Version de PHP : 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `boulangerie`
--
CREATE DATABASE IF NOT EXISTS `boulangerie` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `boulangerie`;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`) VALUES
(1, 'pains'),
(2, 'viennoiseries'),
(3, 'pâtisseries');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `num_commande` varchar(100) NOT NULL,
  `date_commande` date NOT NULL,
  `statut` varchar(30) NOT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `num_commande`, `date_commande`, `statut`, `id_utilisateur`) VALUES
(1, 'CMD-86436', '2026-02-24', 'Livrée', 2),
(2, 'CMD-69668', '2026-02-25', 'Livrée', 2),
(3, 'CMD-21624', '2026-02-26', 'Prête à être livrée', 2),
(4, 'CMD-82391', '2026-02-26', 'En préparation', 2),
(5, 'CMD-41315', '2026-02-27', 'En préparation', 2),
(6, 'CMD-72778', '2026-02-27', 'En préparation', 3),
(7, 'CMD-78844', '2026-02-27', 'En préparation', 4);

-- --------------------------------------------------------

--
-- Structure de la table `details_commande`
--

CREATE TABLE `details_commande` (
  `id_commande` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `details_commande`
--

INSERT INTO `details_commande` (`id_commande`, `id_produit`, `quantite`) VALUES
(1, 1, 2),
(1, 11, 4),
(1, 12, 4),
(1, 20, 2),
(1, 22, 1),
(2, 1, 1),
(2, 9, 2),
(2, 15, 1),
(2, 20, 1),
(3, 1, 1),
(3, 14, 2),
(3, 18, 1),
(3, 28, 1),
(4, 9, 1),
(5, 3, 7),
(5, 6, 1),
(6, 8, 1),
(6, 13, 2),
(6, 14, 3),
(7, 1, 1),
(7, 17, 10);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prix` decimal(5,2) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `id_categorie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `nom`, `prix`, `description`, `image`, `id_categorie`) VALUES
(1, 'Baguette', 1.10, 'La star de nos fournées, à la croûte dorée et la mie alvéolée. Incontournable à chaque heure de la journée.', 'img/baguette.png', 1),
(2, 'Ficelle', 0.80, 'Pour les petits creux ou l\'apéritif, notre baguette fine et ultra-croustillante.', 'img/ficelle.png', 1),
(3, 'Bâtard', 1.20, 'Le pain de nos grands-pères. Une forme rustique et une mie dense, parfaite pour accompagner un bon plat en sauce ou un plateau de charcuterie.', 'img/batard.png', 1),
(4, 'Boulot', 1.50, 'Le classique des déjeuners de famille. Un pain généreux et tout rond, dont on aime rompre la croûte farinée à la main.', 'img/boulot.png', 1),
(5, 'Pain de campagne', 2.50, 'Un pain de caractère au levain naturel, avec une croûte épaisse qui garde toute sa fraîcheur.', 'img/pain_campagne.png', 1),
(6, 'Pain de mie', 2.00, 'La douceur absolue de la boulangerie. Une mie briochée, moelleuse à souhait, qui fera le bonheur de vos toasts et de vos enfants.', 'img/pain_mie.png', 1),
(7, 'Pain viennois', 1.30, 'Entre pain et brioche, sa texture fine et sa croûte dorée en font le compagnon idéal des goûters gourmands avec une barre de chocolat.', 'img/pain_viennois.png', 1),
(8, 'Pain complet', 2.20, 'La force du grain entier. Un pain authentique et rustique, riche en fibres, pour une dégustation saine qui a du goût.', 'img/pain_complet.png', 1),
(9, 'Pain aux céréales', 2.40, 'Un mélange savoureux de graines craquantes pour un pain riche en goût et en énergie.', 'img/pain_cereales.png', 1),
(10, 'Pain de seigle', 2.30, 'Le compagnon idéal de vos plateaux de fromages et de vos dégustations marines.', 'img/pain_seigle.png', 1),
(11, 'Croissant', 1.20, 'Le classique de notre artisan : un feuilletage pur beurre, croustillant à souhait et fondant à l\'intérieur.', 'img/croissant.png', 2),
(12, 'Pain au chocolat', 1.20, 'L\'incontournable du goûter, préparé avec notre pâte feuilletée levée et deux barres de chocolat noir intense.', 'img/pain_choco.png', 2),
(13, 'Pain suisse', 1.50, 'Une gourmandise généreuse alliant la douceur d\'une crème pâtissière maison et le croquant des pépites de chocolat.', 'img/pain_suisse.png', 2),
(14, 'Croissant aux amandes', 1.60, 'Une recette de tradition nappée d\'une crème d\'amandes onctueuse et parsemée d\'amandes effilées grillées.', 'img/croissant_amandes.png', 2),
(15, 'Chausson aux pommes', 1.40, 'Un feuilletage doré renfermant une compote de pommes fondante, doucement mijotée avec une pointe de cannelle.', 'img/chausson_pommes.png', 2),
(16, 'Pain aux raisins', 1.50, 'Aussi appelé Escargot, cette spirale gourmande est garnie d\'une crème vanillée et de raisins secs soigneusement sélectionnés.', 'img/pain_raisins.png', 2),
(17, 'Torsade', 1.50, 'Un ruban de pâte feuilletée pur beurre, tressé avec une crème pâtissière onctueuse et des pépites de chocolat noir.', 'img/torsade.png', 2),
(18, 'Chouquettes', 2.00, 'Douze petites bouchées de pâte à chou légères et aériennes, généreusement saupoudrées de gros grains de sucre.', 'img/chouquettes.png', 2),
(19, 'Brioche tressée', 4.50, 'La véritable brioche de notre enfance : une tresse dorée à la main, au bon goût de beurre frais et à la mie incroyablement aérée.', 'img/brioche_tressee.png', 2),
(20, 'Pain Brioché 3 Chocolats', 2.80, 'Une création gourmande à la mie ultra-moelleuse, généreusement truffée de pépites de chocolat noir, au lait et blanc.', 'img/brioche_3_chocos.png', 2),
(21, 'Saint-honoré', 3.50, 'Le roi des pâtisseries : un socle de pâte feuilletée craquant, des petits choux caramélisés et une crème onctueuse d\'une légèreté absolue.', 'img/saint_honore.png', 3),
(22, 'Opéra', 4.00, 'Une partition gourmande où s\'équilibrent la force du café et la douceur d\'une ganache au chocolat noir intense.', 'img/opera.png', 3),
(23, 'Mille-feuille', 3.50, 'Le chef-d\'œuvre de notre pâtissier : trois couches de feuilletage doré qui craquent sous la dent pour laisser place à une crème vanillée onctueuse.', 'img/mille_feuille.png', 3),
(24, 'Religieuse', 3.80, 'Un duo de choux généreux reliés par une dentelle de crème au beurre, pour les amoureux de tradition pâtissière.', 'img/religieuse.png', 3),
(25, 'Tarte Bourdaloue', 3.50, 'Le charme des poires pochées fondantes sur un lit de crème d\'amandes, le tout niché dans une pâte sablée pur beurre.', 'img/tarte_bourdaloue.png', 3),
(26, 'Financier', 2.00, 'Un petit lingot de gourmandise au beurre noisette et à l\'amande, parfait pour accompagner votre café au Village.', 'img/financier.png', 3),
(27, 'Macarons', 1.50, 'Un écrin de douceur avec une coque croquante et un cœur fondant, décliné selon les saveurs de saison.', 'img/macarons.png', 3),
(28, 'Paris-Brest', 4.50, 'Une couronne de pâte à choux parsemée d\'amandes, renfermant un trésor de crème mousseline au praliné maison.', 'img/paris_brest.png', 3),
(29, 'Moka', 3.80, 'L\'authenticité d\'une génoise aérienne mariée à une crème au beurre onctueuse, délicatement parfumée au café fraîchement moulu.', 'img/moka.png', 3);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `role` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `email`, `tel`, `adresse`, `mot_de_passe`, `role`) VALUES
(1, 'Administrateur', 'Boulangerie', 'admin@boulangerie.com', '0102030405', '123 Rue de la Farine, 91380 Chilly-Mazarin', '$2y$10$byihGgNkR7z2mAp3NSv61OVxBaInsQHNz/rXoG4P0maV3Q9a5znzu', 1),
(2, 'Doe', 'John', 'john.doe@test.com', '0103050709', '12 Avenue de la République', '$2y$10$xGWbLm1n4RxrRYXFeJnRueXBkzY2GMyIhvpIf0.eeif5Z.Pp84ZuG', 0),
(3, 'Dupond', 'Durand', 'dupond.durand@test.com', '0708091011', '4 Rue Emile Zola', '$2y$10$f6HFJbpwWVDSZiJ21bmLH.QBUc8ra7LZLfRt6D3XjKYZeIawV6Aem', 0),
(4, 'Polo', 'Marco', 'marco.polo@test.com', '0611255423', '14 Rue de Turenne', '$2y$10$yTHMW28r8XmOBHA2uQpQzu7buRW46eYxMBoIv7LomGPid5656/b7e', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `details_commande`
--
ALTER TABLE `details_commande`
  ADD PRIMARY KEY (`id_commande`,`id_produit`),
  ADD KEY `id_produit` (`id_produit`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categorie` (`id_categorie`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `details_commande`
--
ALTER TABLE `details_commande`
  ADD CONSTRAINT `details_commande_ibfk_1` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`id`),
  ADD CONSTRAINT `details_commande_ibfk_2` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
