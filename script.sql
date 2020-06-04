-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8888
-- Généré le :  mar. 26 mai 2020 à 15:35
-- Version du serveur :  5.7.26
-- Version de PHP :  7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `SmashZone`
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
  `date_creation` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `clubs`
--

INSERT INTO `clubs` (`club_id`, `nom_club`, `password`, `email`, `telephone`, `ville`, `postal_code`, `date_creation`) VALUES
(1, 'SAM CLUB', 'eadd934e2cc978fc622fc1324878d8af', 'sam@sam.fr', '0500000000', 'Merignac', '33700', '2020-05-26 14:53:40.000000'),
(2, 'SAM CLUB', 'eadd934e2cc978fc622fc1324878d8af', 'sam@sam.fr', '0500000000', 'Merignac', '33700', '2020-05-26 14:53:44.000000');

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
  `date_publication` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `offres`
--

INSERT INTO `offres` (`offre_id`, `user_id`, `description`, `disponibilite`, `date_publication`) VALUES
(1, 1, 'Recherche d\'un partenaire sympa', 'sam_am-dim_am-sam_pm-dim_pm', '2020-04-09 14:43:28'),
(2, 1, 'Nouvelle offre t\'as capté', 'lun_am-jeu_am-ven_am-sam_am-mar_pm-mer_pm-jeu_pm-sam_pm', '2020-05-26 13:40:46'),
(3, 1, 'Je recherche Quelqu\'un svp de préférence MALGACHE et nègre', 'mer_am-sam_am-dim_am-lun_pm-mar_pm-mer_pm-jeu_pm-ven_pm-sam_pm-dim_pm', '2020-05-26 14:55:59');

-- --------------------------------------------------------

--
-- Structure de la table `tournois`
--

CREATE TABLE `tournois` (
  `tournoi_id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `nom_tournoi` varchar(255) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `age_min` int(11) NOT NULL,
  `age_max` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tournois`
--

INSERT INTO `tournois` (`tournoi_id`, `club_id`, `nom_tournoi`, `date_debut`, `date_fin`, `age_min`, `age_max`) VALUES
(1, 1, 'Tournoi cool', '2020-05-26', '2020-05-30', 18, 100);

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
  `date_creation` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `telephone` varchar(255) DEFAULT NULL,
  `date_naissance` date NOT NULL,
  `classement` float DEFAULT '40'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `pseudo`, `password`, `prenom`, `nom`, `email`, `ville`, `postal_code`, `date_creation`, `telephone`, `date_naissance`, `classement`) VALUES
(1, 'Astruum', '594f803b380a41396ed63dca39503542', 'Arthur', 'VELLA', 'arthurvella33@gmail.com', 'Merignac', '33700', '2020-05-20 17:43:56.000000', '0626351893', '2001-11-14', 30.2);

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
  MODIFY `club_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `offres`
--
ALTER TABLE `offres`
  MODIFY `offre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `tournois`
--
ALTER TABLE `tournois`
  MODIFY `tournoi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
