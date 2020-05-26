	-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 26 mai 2020 à 17:35
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.5

	SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `smashzone`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `pseudo` int(255) NOT NULL,
  `mot_de_passe` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `clubs`
--

CREATE TABLE `clubs` (
  `club_id` int(11) NOT NULL,
  `nom_club` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  `date_creation` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `confirme` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `clubs`
--

INSERT INTO `clubs` (`club_id`, `nom_club`, `password`, `email`, `telephone`, `ville`, `postal_code`, `date_creation`, `confirme`) VALUES
(1, 'test_club', 'b18a0eefaccbbff039bc91621d1f54b6', 'test_club@test.com', '699999999', 'clubbed', '33290', '2020-05-26 14:44:36.268929', 0);

-- --------------------------------------------------------

--
-- Structure de la table `detail_offre`
--

CREATE TABLE `detail_offre` (
  `offre_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `detail_tournoi`
--

CREATE TABLE `detail_tournoi` (
  `tournoi_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `offres`
--

CREATE TABLE `offres` (
  `offre_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `disponibilite` varchar(255) NOT NULL,
  `date_publication` timestamp(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `reset_password`
--

CREATE TABLE `reset_password` (
  `email` text NOT NULL,
  `token` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `tournois`
--

CREATE TABLE `tournois` (
  `tournoi_id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `nom_tournoi` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `code_postal` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `categorie_age` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  `date_creation` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `telephone` varchar(255) DEFAULT NULL,
  `date_naissance` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `pseudo`, `password`, `prenom`, `nom`, `email`, `ville`, `postal_code`, `date_creation`, `telephone`, `date_naissance`) VALUES
(1, 'test_n1', 'cc03e747a6afbbcbf8be7668acfebee5', '', '', 'test@test.com', 'testlazone', '33290', '2020-05-20 15:06:21.285934', '695880167', '0000-00-00'),
(2, 'test2', 'cc03e747a6afbbcbf8be7668acfebee5', '', '', 'sltlol@test.com', 'lebinks', '52001', '2020-05-20 15:07:12.678565', '565351223', '1999-12-11'),
(3, 'test3', 'cc03e747a6afbbcbf8be7668acfebee5', 'leto', 'psothug', 'brigand@test.com', 'evry', '75008', '2020-05-20 15:09:05.754460', '658565452', '1999-01-28'),
(4, 'test_captcha', '55e4158978596ba9c2bdf95d3616348a', 'test_captcha', 'test_captcha', 'test_captcha@test.com', 'test_captcha', '33000', '2020-05-22 11:26:37.010002', '2255454565', '2000-01-01'),
(5, 'Adrien', 'cc03e747a6afbbcbf8be7668acfebee5', 'Adrien', 'Zi', 'darkfanta33@gmail.com', 'Blanquefort', '33290', '2020-05-26 11:19:11.137270', '0695880167', '2000-01-01');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Index pour la table `clubs`
--
ALTER TABLE `clubs`
  ADD PRIMARY KEY (`club_id`);

--
-- Index pour la table `detail_offre`
--
ALTER TABLE `detail_offre`
  ADD KEY `offre_id` (`offre_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `detail_tournoi`
--
ALTER TABLE `detail_tournoi`
  ADD KEY `tournoi_id` (`tournoi_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `offres`
--
ALTER TABLE `offres`
  ADD PRIMARY KEY (`offre_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `tournois`
--
ALTER TABLE `tournois`
  ADD PRIMARY KEY (`tournoi_id`),
  ADD KEY `club_id` (`club_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `clubs`
--
ALTER TABLE `clubs`
  MODIFY `club_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `offres`
--
ALTER TABLE `offres`
  MODIFY `offre_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tournois`
--
ALTER TABLE `tournois`
  MODIFY `tournoi_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `detail_offre`
--
ALTER TABLE `detail_offre`
  ADD CONSTRAINT `offre->offre` FOREIGN KEY (`offre_id`) REFERENCES `offres` (`offre_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user->user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `detail_tournoi`
--
ALTER TABLE `detail_tournoi`
  ADD CONSTRAINT `detail_user->user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tournoi->tournoi` FOREIGN KEY (`tournoi_id`) REFERENCES `tournois` (`tournoi_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `offres`
--
ALTER TABLE `offres`
  ADD CONSTRAINT `offre->user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `tournois`
--
ALTER TABLE `tournois`
  ADD CONSTRAINT `tournoi->club` FOREIGN KEY (`club_id`) REFERENCES `clubs` (`club_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
