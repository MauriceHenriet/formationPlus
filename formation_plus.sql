-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 13 oct. 2021 à 03:14
-- Version du serveur : 10.4.19-MariaDB
-- Version de PHP : 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `formation_plus`
--

-- --------------------------------------------------------

--
-- Structure de la table `attestation`
--

CREATE TABLE `attestation` (
  `id` int(11) NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `etudiant_id` int(11) DEFAULT NULL,
  `convention_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `attestation`
--

INSERT INTO `attestation` (`id`, `message`, `etudiant_id`, `convention_id`) VALUES
(19, 'Bonjour Fabert Jean, \r\n\r\nVous avez suivi 15heures de formation chez FormationPlus.\r\n\r\nPourriez-vous nous retourner ce mail avec la pièce jointe signée.\r\n\r\nCordialement, FormationPlus', 4, 2);

-- --------------------------------------------------------

--
-- Structure de la table `convention`
--

CREATE TABLE `convention` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nb_heur` int(11) NOT NULL,
  `attestation_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `convention`
--

INSERT INTO `convention` (`id`, `nom`, `nb_heur`, `attestation_id`) VALUES
(1, 'Stage-Juventin', 45, NULL),
(2, 'stage-PSA', 15, NULL),
(3, 'stage-Avion', 25, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20211012132808', '2021-10-12 15:29:53', 429),
('DoctrineMigrations\\Version20211013004223', '2021-10-13 02:42:47', 550);

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `id` int(11) NOT NULL,
  `convention_id` int(11) DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attestation_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`id`, `convention_id`, `nom`, `prenom`, `mail`, `attestation_id`) VALUES
(1, 1, 'Dupont', 'Maxime', 'maxime@dupont.fr', NULL),
(2, 1, 'Chauveau', 'Alex', 'alex@chauveau.fr', NULL),
(3, 1, 'Veille', 'Nicolas', 'nico@veille.fr', NULL),
(4, 2, 'Fabert', 'Jean', 'jean@fabert.fr', NULL),
(5, 2, 'Leeroy', 'Pierre', 'pierre@leeroy.fr', NULL),
(6, 3, 'Guilbaud', 'Stan', 'stan@guilbaud.fr', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `attestation`
--
ALTER TABLE `attestation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_326EC63FDDEAB1A3` (`etudiant_id`);

--
-- Index pour la table `convention`
--
ALTER TABLE `convention`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8556657E7EDC5B38` (`attestation_id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_717E22E3A2ACEBCC` (`convention_id`),
  ADD KEY `IDX_717E22E37EDC5B38` (`attestation_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `attestation`
--
ALTER TABLE `attestation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `convention`
--
ALTER TABLE `convention`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `etudiant`
--
ALTER TABLE `etudiant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `attestation`
--
ALTER TABLE `attestation`
  ADD CONSTRAINT `FK_326EC63FDDEAB1A3` FOREIGN KEY (`etudiant_id`) REFERENCES `etudiant` (`id`);

--
-- Contraintes pour la table `convention`
--
ALTER TABLE `convention`
  ADD CONSTRAINT `FK_8556657E7EDC5B38` FOREIGN KEY (`attestation_id`) REFERENCES `attestation` (`id`);

--
-- Contraintes pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD CONSTRAINT `FK_717E22E37EDC5B38` FOREIGN KEY (`attestation_id`) REFERENCES `attestation` (`id`),
  ADD CONSTRAINT `FK_717E22E3A2ACEBCC` FOREIGN KEY (`convention_id`) REFERENCES `convention` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
