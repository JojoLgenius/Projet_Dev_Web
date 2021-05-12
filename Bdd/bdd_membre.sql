-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 12 mai 2021 à 18:52
-- Version du serveur :  10.3.27-MariaDB-0+deb10u1
-- Version de PHP : 7.3.27-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bdd_membre`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `titre` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contenu` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_article` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `titre`, `contenu`, `date_article`) VALUES
(1, 'BONJOUR A TOUS', 'Premier article du blog!', '2021-05-12 00:01:38'),
(2, 'Projet rendu !', 'Le projet est enfin rendu non sans mal', '2021-05-12 18:27:31');

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id` int(11) NOT NULL,
  `nomAuteur` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idArticle` int(11) DEFAULT NULL,
  `contenu` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `nomAuteur`, `idArticle`, `contenu`) VALUES
(1, 'jojo', 1, 'L\'artcicle est incroyable'),
(2, 'syl42', 1, 'Ca c\'est bien vrai');

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE `membres` (
  `id` int(11) NOT NULL,
  `classe` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nom` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passe` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `membres`
--

INSERT INTO `membres` (`id`, `classe`, `nom`, `passe`) VALUES
(1, 'admin', 'jojo', '$2y$10$3Pn.3aUcX1ETqpZMGXNJo.JvdKQvJF9JNSBG10YIj7..jf1rQNlbC'),
(2, 'admin', 'syl42', '$2y$10$YwWbc3cFZaTDUtDeyhPWuenk/AqU1FvmKtAyk.D5J/OR293STeXgi');

-- --------------------------------------------------------

--
-- Structure de la table `pilotes`
--

CREATE TABLE `pilotes` (
  `id` int(11) NOT NULL,
  `pilote` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pays` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `constructeur` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pointsTotal` int(11) DEFAULT NULL,
  `pointsSaison` int(11) DEFAULT NULL,
  `podiumsSaison` int(11) DEFAULT NULL,
  `victoiresSaison` int(11) DEFAULT NULL,
  `GP` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pilotes`
--

INSERT INTO `pilotes` (`id`, `pilote`, `pays`, `constructeur`, `pointsTotal`, `pointsSaison`, `podiumsSaison`, `victoiresSaison`, `GP`) VALUES
(1, 'Lewis Hamilton', 'Royaume-Uni', 'Mercedes', 3847, 94, 4, 3, 270),
(2, 'Sebastian Vettel', 'Allemagne', 'Aston Martin', 3018, 0, 0, 0, 261),
(3, 'Fernando Alonso', 'Espagne', 'Alpine', 1904, 5, 0, 0, 316),
(4, 'Kimi Räikkönen', 'Finlande', 'Alfa Romeo', 1863, 0, 0, 0, 334),
(5, 'Valtteri Bottas', 'Finlande', 'Mercedes', 1544, 47, 3, 0, 160),
(6, 'Max Verstappen', 'Pays-Bas', 'Red Bull', 1223, 80, 4, 1, 124),
(7, 'Daniel Ricciardo', 'Australie', 'McLaren', 1175, 24, 0, 0, 192),
(8, 'Sergio Pérez', 'Mexique', 'Red Bull', 728, 32, 0, 0, 195),
(9, 'Charles Leclerc', 'Monaco', 'Ferrari', 429, 40, 0, 0, 63),
(10, 'Carlos Sainz Jr.', 'Espagne', 'Ferrari', 386, 20, 0, 0, 122),
(11, 'Pierre Gasly', 'France', 'AlphaTauri', 206, 8, 0, 0, 68),
(12, 'Esteban Ocon', 'France', 'Alpine', 206, 10, 0, 0, 71),
(13, 'Lando Norris', 'Royaume-Uni', 'McLaren', 183, 41, 1, 0, 42),
(14, 'Lance Stroll', 'Canada', 'AstonMartin', 147, 5, 0, 0, 82);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `membres`
--
ALTER TABLE `membres`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pilotes`
--
ALTER TABLE `pilotes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `membres`
--
ALTER TABLE `membres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `pilotes`
--
ALTER TABLE `pilotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
