-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 14 mars 2018 à 11:45
-- Version du serveur :  5.7.19
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `perso_blog`
--

--
-- Déchargement des données de la table `status`
--

INSERT INTO `status` (`status_id`, `label`) VALUES
(1, 'En attente'),
(2, 'Validé'),
(3, 'Refusé');

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `permissionLevel`, `email`, `pseudo`, `password`, `creationDate`) VALUES
(1, 10, 'antho.cecc@gmail.com', 'Deediezi', 'Fezfezfez31', '2018-03-13 14:40:24'),
(2, 1, 'test@test.fr', 'Tester', 'TestTest', '2018-03-13 14:40:51');

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`post_id`, `creationDate`, `title`, `summary`, `content`, `picture`, `lastUpdate`, `user_id`) VALUES
(1, '2018-03-13 14:42:58', 'Mon jolie blog !', 'C\'est trop cool !', 'Il est pas beau mon article ?', NULL, NULL, 1),
(2, '2018-03-13 15:10:14', 'Un second articleuh', 'Un second résuméheu', 'Bonjoureuh', NULL, NULL, 1);

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`comment_id`, `content`, `creationDate`, `reason`, `user_id`, `post_id`, `status_id`) VALUES
(1, 'Ouaw le beau blog !', '2018-03-13 14:43:55', NULL, 2, 1, 2),
(2, 'AZOUEZFHIHFIYGEGREGEZ', '2018-03-13 14:44:28', NULL, 2, 1, 1);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
