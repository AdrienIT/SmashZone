-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 15 juin 2020 à 16:01
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
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Structure de la table `clubs`
--

CREATE TABLE `clubs` (
  `club_id` int(11) NOT NULL,
  `nom_club` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `telephone` int(11) NOT NULL,
  `ville` text NOT NULL,
  `postal_code` int(6) NOT NULL,
  `adresse` text NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `confirme` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `detail_offre`
--

CREATE TABLE `detail_offre` (
  `offre_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `detail_tournoi`
--

CREATE TABLE `detail_tournoi` (
  `tournoi_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(255) NOT NULL,
  `message_sender` int(255) NOT NULL,
  `message_receiver` int(255) NOT NULL,
  `message_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `notif_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `vu` int(2) NOT NULL DEFAULT 0,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `description` text NOT NULL,
  `id_link` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `offres`
--

CREATE TABLE `offres` (
  `offre_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `description` text NOT NULL,
  `disponibilite` varchar(255) NOT NULL,
  `date_publication` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `relationships`
--

CREATE TABLE `relationships` (
  `request_id` int(255) NOT NULL,
  `send_id` int(255) NOT NULL,
  `receiver_id` int(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `receiver_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `reset_password`
--

CREATE TABLE `reset_password` (
  `email` text NOT NULL,
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `tournois`
--

CREATE TABLE `tournois` (
  `tournoi_id` int(255) NOT NULL,
  `club_id` int(255) NOT NULL,
  `nom_tournoi` text NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `age_min` int(255) NOT NULL,
  `age_max` int(255) NOT NULL,
  `vainqueur` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_id` int(255) NOT NULL,
  `pseudo` text NOT NULL,
  `password` text NOT NULL,
  `prenom` text NOT NULL,
  `nom` text NOT NULL,
  `email` text NOT NULL,
  `ville` text NOT NULL,
  `postal_code` int(255) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `telephone` int(255) NOT NULL,
  `date_naissance` date NOT NULL,
  `classement` float NOT NULL DEFAULT 40,
  `victoire` int(255) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `pseudo`, `password`, `prenom`, `nom`, `email`, `ville`, `postal_code`, `date_creation`, `telephone`, `date_naissance`, `classement`, `victoire`) VALUES
(1, 'test', '05a671c66aefea124cc08b76ea6d30bb', 'test', 'test', 'test@test.fr', 'test_ville', 33000, '2020-06-15 13:53:24', 2147483647, '2000-01-01', 40, 0),
(2, 'mnobbs1', '069a09fcccdd32ec12d39245ab83bd92', 'Miltie', 'Nobbs', 'mnobbs1@examiner.com', 'Bern', 73114, '2019-12-06 08:13:25', 2147483647, '2000-08-14', 15.4, 0),
(3, 'lsteventon2', 'd9edea04746a53d0c16883c532e4b5b4', 'Lief', 'Steventon', 'lsteventon2@nasa.gov', 'Safotulafai', 31472, '2020-03-06 04:51:31', 2026080420, '2000-07-27', 30.2, 0),
(4, 'ccastagno3', '2e67b901276de4bfcc4b34cef8d33694', 'Candra', 'Castagno', 'ccastagno3@clickbank.net', 'Garango', 92953, '2019-07-09 12:17:59', 2147483647, '2000-06-01', 3.6, 0),
(5, 'droper4', 'b1ac1f39b63bff7accbded37bb1eb6c9', 'Davine', 'Roper', 'droper4@webnode.com', 'Nizhniy Lomov', 12687, '2019-10-08 16:08:44', 2147483647, '2001-12-06', 30.3, 0),
(6, 'pklyn5', '19b7389504d74ad03a07d44587218f47', 'Philis', 'Klyn', 'pklyn5@ezinearticles.com', 'Gastoúni', 86913, '2019-09-19 03:24:41', 2147483647, '2002-01-05', 1.6, 0),
(7, 'plagrange6', '72f12cdb9fb897deff0b5a28960bceb8', 'Pryce', 'La Grange', 'plagrange6@chicagotribune.com', 'Pondokunyur', 95516, '2020-04-18 22:41:02', 2147483647, '2002-04-28', 2.6, 0),
(8, 'lmacvay7', '3274ea3e3524dd776f392944a22d2ae2', 'Lydie', 'MacVay', 'lmacvay7@loc.gov', 'Aliwal North', 63786, '2019-10-16 15:26:16', 1435765777, '2002-06-15', 2.6, 0),
(9, 'mreicharz8', 'aaab06350579fb817b5852313212158e', 'Mick', 'Reicharz', 'mreicharz8@skype.com', 'Velikiye Borki', 10782, '2020-01-06 15:57:17', 2147483647, '2003-05-16', 15.5, 0),
(10, 'warkil9', '710ec6d521985f78bc96faeca41d11df', 'Witty', 'Arkil', 'warkil9@livejournal.com', 'Pindamonhangaba', 6244, '2020-04-27 19:38:45', 2147483647, '2000-09-08', 0, 0),
(11, 'kmaywarda', 'ccfb6b057e93d9c82a32f7e8941b7907', 'Konstanze', 'Mayward', 'kmaywarda@icio.us', 'Smilavichy', 85730, '2019-09-29 08:09:58', 2147483647, '2002-03-18', 30.1, 0),
(12, 'stoplingb', '3b6727b7ae0f57894766e85e9652e6f2', 'Stanford', 'Topling', 'stoplingb@yahoo.co.jp', 'Castellon De La Plana/Castello De La Pla', 91629, '2019-07-02 12:00:19', 2147483647, '2003-05-19', 4.6, 0),
(13, 'llackintonc', '46ec2e417bd3fd7253d073ca2f24a9c3', 'Lacie', 'Lackinton', 'llackintonc@stumbleupon.com', 'Tangier', 16692, '2019-10-03 18:57:02', 2147483647, '2002-05-10', 15.5, 0),
(14, 'afruded', 'f236d68c8f9c8e48f9a6c94c40afe89c', 'Aigneis', 'Frude', 'afruded@tinyurl.com', 'Tempursari Wetan', 89676, '2020-01-15 21:07:45', 2147483647, '2003-02-25', 30.2, 0),
(15, 'vluetchforde', '13c5bd7ecab2ce9a9ceb67f44227ac5f', 'Vita', 'Luetchford', 'vluetchforde@reuters.com', 'Tekes', 57073, '2019-07-14 14:48:52', 2147483647, '2003-01-09', 5.6, 0),
(16, 'hspittlef', '122c5f082b1714b6a6df6095a8b2ce60', 'Honoria', 'Spittle', 'hspittlef@boston.com', 'Medveđa', 9056, '2019-06-16 21:20:24', 2147483647, '2002-08-08', 30.5, 0),
(17, 'glouderg', '1701e9db1cb6503dd7bbcc6be9d17967', 'Graehme', 'Louder', 'glouderg@arstechnica.com', 'Jansenville', 66789, '2019-08-17 03:10:19', 2147483647, '2001-12-02', 1.6, 0),
(18, 'mfitkinh', '8779127a2b9e6eaeaaddd1782fa86694', 'Mickie', 'Fitkin', 'mfitkinh@marketwatch.com', 'Conceição das Alagoas', 13059, '2019-09-24 19:04:23', 2147483647, '2001-05-13', 30.3, 0),
(19, 'nmckechniei', 'ef2eeb5348a760228ebb7e0870e2e2d3', 'Nertie', 'McKechnie', 'nmckechniei@creativecommons.org', 'Debe', 18932, '2020-04-06 00:44:00', 2147483647, '2003-04-16', 3.6, 0),
(20, 'dkennanj', 'f1f451da6d8dcddb6fd2704300cb2d6d', 'Dyanna', 'Kennan', 'dkennanj@barnesandnoble.com', 'Mojorembun', 59348, '2020-03-14 05:11:02', 2147483647, '2001-08-21', 30.5, 0),
(21, 'lturnockk', '67a961707e44635eefa53ae8a4fdb91c', 'Loria', 'Turnock', 'lturnockk@free.fr', 'Morong', 22793, '2020-01-31 02:03:25', 2147483647, '2001-05-20', 0, 0),
(22, 'evinaul', '310090d3f9162f6776e969ea315f6a72', 'Eleanore', 'Vinau', 'evinaul@tamu.edu', 'Bourail', 19440, '2019-07-11 08:40:05', 2147483647, '2002-02-05', 5.6, 0),
(23, 'askeetem', '6cb1ef5cc80c8aa1b3d19b5cd5866096', 'Adena', 'Skeete', 'askeetem@scientificamerican.com', 'Xia Zanggor', 86643, '2019-06-23 11:30:58', 2147483647, '2003-03-16', 5.6, 0),
(24, 'esalackn', '10a40f86d1b4881a2c9370beb2e02c50', 'Esther', 'Salack', 'esalackn@surveymonkey.com', 'Garmo', 30208, '2020-02-17 08:13:52', 2147483647, '2002-09-08', 30.1, 0),
(25, 'koryso', '568ec663ba27c6b1e0454a43b07c5c53', 'Kit', 'Orys', 'koryso@ning.com', 'Karlstad', 43833, '2020-04-21 08:06:54', 2147483647, '2001-10-12', 15, 0),
(26, 'cdeboyp', 'f32b355672c3624a2d7c28aa782d20bc', 'Chloris', 'Deboy', 'cdeboyp@umn.edu', 'Stavropol’', 62518, '2019-10-30 16:55:28', 1641692948, '2003-05-04', 30.4, 0),
(27, 'ralanbrookeq', 'be6bf1376c2707ae4fa88d247169bc89', 'Rutter', 'Alanbrooke', 'ralanbrookeq@lycos.com', 'Mascote', 23520, '2019-05-31 02:03:15', 2147483647, '2001-10-11', 15.5, 0),
(28, 'ckestler', '3fca1fd7a85377ee717a59ea2fc573a5', 'Corbett', 'Kestle', 'ckestler@purevolume.com', 'Golčův Jeníkov', 92638, '2019-08-17 01:06:48', 2147483647, '2001-02-25', 30.5, 0),
(29, 'fglackens', 'c05c3d7f13f56debf1070304a4e634db', 'Franny', 'Glacken', 'fglackens@telegraph.co.uk', 'Pukou', 68139, '2019-07-18 01:46:18', 2147483647, '2002-12-14', 15.3, 0),
(30, 'gdederickt', '3ca6bc4ee892de195dad1824d6a40eb6', 'Gweneth', 'Dederick', 'gdederickt@bloomberg.com', 'Tozkhurmato', 34245, '2019-09-29 17:18:59', 2147483647, '2001-09-26', 0, 0),
(31, 'atomasianu', '683f5da4d01dc9c26dc7bbc02da40d46', 'Arlana', 'Tomasian', 'atomasianu@tinypic.com', 'Dimayon', 21788, '2019-10-07 16:15:52', 2147483647, '2001-05-05', 15.4, 0),
(32, 'tmizenv', '79db9601e6d3e0e5dc8139ca960c84f6', 'Todd', 'Mizen', 'tmizenv@wix.com', 'Garango', 67568, '2019-05-29 05:04:40', 2051013336, '2002-08-18', 30.2, 0),
(33, 'mkettridgew', '7acb678a85e1ae7a6e3e193ac91b4176', 'Milo', 'Kettridge', 'mkettridgew@a8.net', 'Juan L. Lacaze', 75509, '2019-09-04 09:49:25', 2147483647, '2000-10-06', 30.3, 0),
(34, 'acastellsx', '01616f0408665286d03cfd79895fd015', 'Angel', 'Castells', 'acastellsx@businesswire.com', 'Kayangel', 92113, '2019-07-12 12:33:04', 2147483647, '2001-12-05', 30.2, 0),
(35, 'wdaylyy', '0d6b45684c0a7e4d439d0a7db24c42f8', 'Willette', 'Dayly', 'wdaylyy@sciencedirect.com', 'Stebnyk', 3814, '2019-06-26 09:33:10', 2147483647, '2000-12-09', 30.4, 0),
(36, 'rsweenyz', '4bc1aae9c64b5fa1fb7f08585f0df571', 'Rozella', 'Sweeny', 'rsweenyz@myspace.com', 'Pilot Butte', 44490, '2020-01-25 17:20:25', 2147483647, '2001-01-16', 15.4, 0),
(37, 'tgingles10', 'e5b9b7118de4df310c74b1f779a01ca5', 'Terza', 'Gingles', 'tgingles10@tinypic.com', 'Mtsensk', 11144, '2020-03-14 02:20:46', 2147483647, '2003-04-14', 30, 0),
(38, 'delphinston11', 'cd4a07d04889fad6447ff33890a966b1', 'Donelle', 'Elphinston', 'delphinston11@columbia.edu', 'Natonin', 29468, '2020-04-23 06:07:40', 2147483647, '2003-03-15', 2.6, 0),
(39, 'ccayle12', '81c21b3f208a1387a0020dcaae064af5', 'Carmencita', 'Cayle', 'ccayle12@nhs.uk', 'Banjar Taro Kelod', 98836, '2019-09-18 00:18:39', 2147483647, '2002-02-02', 15.1, 0),
(40, 'ageall13', '75e27e232c3b7bd06019d82bc5cc13ad', 'Andy', 'Geall', 'ageall13@webs.com', 'Ramat HaSharon', 75301, '2019-10-14 15:13:55', 2147483647, '2001-10-09', 3.6, 0),
(41, 'mshepland14', 'e6912e839a9f1dcafd4af8b4c40c2e75', 'Martainn', 'Shepland', 'mshepland14@facebook.com', 'Al Majāridah', 24084, '2019-11-27 02:00:34', 2147483647, '2002-04-07', 30.4, 0),
(42, 'dfeifer15', '81fc1758d13d2c9134bbcb7ad2f062b1', 'Deonne', 'Feifer', 'dfeifer15@jiathis.com', 'Shenglilu', 47059, '2019-06-17 07:06:47', 1667949053, '2002-10-28', 15.1, 0),
(43, 'bnewborn16', 'c3b9a2169dbffe04b7c184f530ea27ef', 'Benedetta', 'Newborn', 'bnewborn16@devhub.com', 'Valença', 75464, '2020-01-08 11:18:17', 2147483647, '2001-11-17', 30.2, 0),
(44, 'skarsh17', '3ca2aae417ba83fd805c1232c76e381c', 'Sam', 'Karsh', 'skarsh17@digg.com', 'Chamouny', 58473, '2019-07-15 03:32:55', 1586785013, '2002-12-21', 30.2, 0),
(45, 'cfeehely18', '8c7f4cc3e9d42c773f47521a65f1303a', 'Chrystel', 'Feehely', 'cfeehely18@cocolog-nifty.com', 'Montreuil', 31242, '2019-08-26 07:24:33', 2147483647, '2003-01-20', 30.5, 0),
(46, 'slusher19', '356507151763df60b966c770e4ec877f', 'Stu', 'Lusher', 'slusher19@mashable.com', 'Nentón', 75907, '2019-11-30 21:37:50', 2147483647, '2000-08-28', 30.1, 0),
(47, 'jshales1a', '997b18d05f042b2efbe650ed2b9abce4', 'Jule', 'Shales', 'jshales1a@google.cn', 'Bisert’', 25897, '2020-02-05 19:05:16', 2147483647, '2001-05-09', 2.6, 0),
(48, 'etreadgold1b', 'c3004103ff1fce7728e3a397eef772c8', 'Eliza', 'Treadgold', 'etreadgold1b@cpanel.net', 'Iquique', 28846, '2020-05-14 01:33:10', 1184631881, '2002-11-02', 30.1, 0),
(49, 'rwhitchurch1c', '19304955c22eb74391764fb064c987d9', 'Rubina', 'Whitchurch', 'rwhitchurch1c@wired.com', 'Kaset Wisai', 1003, '2020-03-17 18:23:38', 2147483647, '2000-08-08', 30.4, 0),
(50, 'lhave1d', 'a7807eabb15b4b892a62b13fde663163', 'Lanny', 'Have', 'lhave1d@chron.com', 'Bang Nam Priao', 89281, '2019-08-26 22:47:32', 2147483647, '2002-07-14', 15.1, 0),
(51, 'bbeloe1e', '0aed72e3410f62d8257a440354531d28', 'Bea', 'Beloe', 'bbeloe1e@yahoo.com', 'Yuhang', 1442, '2019-12-12 01:34:16', 2147483647, '2003-03-07', 15.1, 0),
(52, 'rjakoubec1f', 'f783711d4252c51473ca10e440cc6627', 'Rosemarie', 'Jakoubec', 'rjakoubec1f@yahoo.com', 'Ajung', 22321, '2019-08-16 03:14:36', 2147483647, '2001-02-19', 3.6, 0),
(53, 'tfollin1g', '4951855612e083a6d4391b70d1807f99', 'Terrill', 'Follin', 'tfollin1g@deviantart.com', 'Doong', 38791, '2019-08-14 22:21:41', 2147483647, '2000-10-23', 4.6, 0),
(54, 'cyelden1h', '5bfe1bce8e50d5d0dde212feb09adc53', 'Chris', 'Yelden', 'cyelden1h@elegantthemes.com', 'Luhanka', 87736, '2020-02-06 09:01:45', 2147483647, '2002-12-08', 30.2, 0),
(55, 'sgillison1i', '27208ed425137305c670cde7f0037940', 'Salli', 'Gillison', 'sgillison1i@wikipedia.org', 'Pujilí', 52908, '2020-02-02 23:59:43', 2147483647, '2001-09-03', 15.5, 0),
(56, 'dironside1j', '157cbee4fdd80f55e1316cdd0872c97a', 'Devan', 'Ironside', 'dironside1j@unicef.org', 'Baratan', 54945, '2020-01-08 01:52:58', 1018590348, '2000-11-19', 5.6, 0),
(57, 'hdaout1k', 'f33c260d87cc26b3ae944891646047fd', 'Honor', 'Daout', 'hdaout1k@sun.com', 'Sidaharja', 72629, '2020-03-27 17:04:21', 2147483647, '2001-03-28', 30.2, 0),
(58, 'mflucker1l', '612fcb16984df9708d3bfbc8b9d47d66', 'Matty', 'Flucker', 'mflucker1l@ocn.ne.jp', 'Newbiggin', 2063, '2019-10-03 12:56:04', 2147483647, '2001-06-26', 30.5, 0),
(59, 'egoodhay1m', 'be9ab03a1023ef89cfd23dad3c2d9684', 'Ebony', 'Goodhay', 'egoodhay1m@bbc.co.uk', 'Samayac', 24668, '2020-03-23 07:25:19', 2147483647, '2002-01-29', 30.3, 0),
(60, 'lbartram1n', '99ef4254fa54bb80c7606a6bf64832d3', 'Loydie', 'Bartram', 'lbartram1n@hhs.gov', 'Banjar Cemenggon', 43581, '2020-01-21 09:01:02', 2147483647, '2001-03-16', 30.2, 0),
(61, 'jguerre1o', '99cac8e2b2592d8d283a7871096e7785', 'Jolee', 'Guerre', 'jguerre1o@scientificamerican.com', 'Baitouli', 6973, '2019-09-12 20:33:46', 2147483647, '2001-07-05', 5.6, 0),
(62, 'vsellek1p', 'cf55a4b56c3be48b83309f82da4b5bae', 'Vale', 'Sellek', 'vsellek1p@digg.com', 'Bilajari', 26294, '2019-06-25 13:11:02', 2147483647, '2002-02-01', 30.2, 0),
(63, 'cthornbarrow1q', 'c74e794ce5e92aed88016eff0394f715', 'Cristabel', 'Thornbarrow', 'cthornbarrow1q@yellowpages.com', 'Guluoshan', 10367, '2020-01-31 04:51:07', 2147483647, '2002-11-20', 0, 0),
(64, 'zpawle1r', 'c14c6f02d14a52ef9c0624a8242e0a44', 'Zacharie', 'Pawle', 'zpawle1r@virginia.edu', 'Dukou', 44142, '2020-02-19 23:11:29', 2147483647, '2003-01-18', 40, 0),
(65, 'xcalbrathe1s', '0f8bfea7f3a83eb5fe6266a65bc4d77f', 'Xenos', 'Calbrathe', 'xcalbrathe1s@networksolutions.com', 'Yishan', 27818, '2019-11-10 01:34:10', 2147483647, '2000-12-24', 15.4, 0),
(66, 'iroostan1t', '54137a9abfb5bf56fc2a1f23ec7b86a2', 'Irv', 'Roostan', 'iroostan1t@feedburner.com', 'Zemun', 64858, '2019-11-08 16:56:12', 2147483647, '2001-12-19', 15, 0),
(67, 'gdrynan1u', '39326ab38d2f453db7fba2bd4ffd71a9', 'Goran', 'Drynan', 'gdrynan1u@mit.edu', 'Dunaivtsi', 36305, '2019-12-07 19:55:18', 2147483647, '2002-06-20', 30.3, 0),
(68, 'jniece1v', 'b204ae17e824f1c25867212e3f52ebf2', 'Joe', 'Niece', 'jniece1v@ca.gov', 'Mikulovice', 92997, '2019-06-12 23:00:00', 2147483647, '2000-10-13', 0, 0),
(69, 'emeasham1w', '1f9a0b26692f647c093dda60474c5c35', 'Etienne', 'Measham', 'emeasham1w@discuz.net', 'Yantal’', 73774, '2019-06-19 10:35:52', 2147483647, '2002-08-17', 30.5, 0),
(70, 'ksellack1x', '1345535ab5bc11ca62c7545c2402d954', 'Kippy', 'Sellack', 'ksellack1x@histats.com', 'Abomey', 67509, '2020-03-25 17:10:54', 1337437486, '2002-06-14', 15.4, 0),
(71, 'tmcrinn1y', '996a33708ff72dfcecc49c06edf54895', 'Tore', 'McRinn', 'tmcrinn1y@dot.gov', 'Jerusalem', 12415, '2019-10-31 20:41:07', 1486165765, '2003-04-25', 15.1, 0),
(72, 'shutt1z', 'ca23e664e2d0e27abb44f32ca1ebf38b', 'Seline', 'Hutt', 'shutt1z@t-online.de', 'Pindi Bhattiān', 41225, '2019-10-28 04:14:55', 2147483647, '2000-12-22', 30.2, 0),
(73, 'gvaughan20', '3b1341c9130fb04e3cb95cfb09e50147', 'Griselda', 'Vaughan', 'gvaughan20@hexun.com', 'Limboto', 52213, '2019-07-02 21:59:31', 2147483647, '2002-03-24', 30.1, 0),
(74, 'dshellum21', 'dbc6b9155d27cc01882aa5f750b30d3c', 'Darrel', 'Shellum', 'dshellum21@umich.edu', 'Banjar Pande', 36128, '2020-04-21 00:35:21', 2147483647, '2000-06-25', 30.3, 0),
(75, 'jsoeiro22', '91a9ecccd9c62a41e479bad062cf5fe3', 'Jobey', 'Soeiro', 'jsoeiro22@walmart.com', 'Marabahan', 73958, '2019-06-22 16:36:36', 2147483647, '2002-04-03', 30.3, 0),
(76, 'rseabridge23', '7b87040be2eee8ce2a0a102962ee1662', 'Ring', 'Seabridge', 'rseabridge23@sourceforge.net', 'Yélimané', 73186, '2019-09-27 14:24:32', 2147483647, '2000-07-04', 30.5, 0),
(77, 'rnolot24', '39201a45f4a2a06d00be387d42625d0a', 'Rita', 'Nolot', 'rnolot24@domainmarket.com', 'Cantilan', 97792, '2019-08-28 05:08:55', 2147483647, '2002-11-24', 15.5, 0);

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
  ADD KEY `foreign_user` (`user_id`),
  ADD KEY `foreign_offre` (`offre_id`);

--
-- Index pour la table `detail_tournoi`
--
ALTER TABLE `detail_tournoi`
  ADD KEY `user_id->user_id` (`user_id`),
  ADD KEY `tournoi_id->tournoi_id` (`tournoi_id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Index pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notif_id`);

--
-- Index pour la table `offres`
--
ALTER TABLE `offres`
  ADD PRIMARY KEY (`offre_id`);

--
-- Index pour la table `relationships`
--
ALTER TABLE `relationships`
  ADD PRIMARY KEY (`request_id`);

--
-- Index pour la table `tournois`
--
ALTER TABLE `tournois`
  ADD PRIMARY KEY (`tournoi_id`);

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
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `clubs`
--
ALTER TABLE `clubs`
  MODIFY `club_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notif_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `offres`
--
ALTER TABLE `offres`
  MODIFY `offre_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `relationships`
--
ALTER TABLE `relationships`
  MODIFY `request_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tournois`
--
ALTER TABLE `tournois`
  MODIFY `tournoi_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `detail_offre`
--
ALTER TABLE `detail_offre`
  ADD CONSTRAINT `foreign_offre` FOREIGN KEY (`offre_id`) REFERENCES `offres` (`offre_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foreign_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `detail_tournoi`
--
ALTER TABLE `detail_tournoi`
  ADD CONSTRAINT `tournoi_id->tournoi_id` FOREIGN KEY (`tournoi_id`) REFERENCES `tournois` (`tournoi_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id->user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
