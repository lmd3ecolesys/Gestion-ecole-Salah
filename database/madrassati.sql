-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:8306
-- Généré le : mer. 20 mars 2024 à 05:50
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `madrassati`
--

-- --------------------------------------------------------

--
-- Structure de la table `absence`
--

CREATE TABLE `absence` (
  `id` int(11) NOT NULL,
  `debut` datetime NOT NULL,
  `fin` datetime NOT NULL,
  `status` varchar(20) NOT NULL,
  `student` int(11) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `absence`
--

INSERT INTO `absence` (`id`, `debut`, `fin`, `status`, `student`, `description`) VALUES
(1, '2024-03-10 11:00:00', '2024-03-11 12:00:00', 'justifiée', 2, ''),
(2, '2024-03-29 07:00:00', '2024-03-29 08:00:00', 'non justifiée', 2, ''),
(3, '2023-05-21 11:00:00', '2023-02-21 12:00:00', 'non justifiée', 2, ''),
(4, '2024-03-22 10:01:00', '2024-03-22 11:01:00', 'non justifiée', 2, '');

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

CREATE TABLE `cours` (
  `id` int(11) NOT NULL,
  `niveau` varchar(30) NOT NULL,
  `groupe` varchar(10) NOT NULL,
  `matiere` varchar(20) NOT NULL,
  `trimestre` varchar(20) NOT NULL,
  `année` varchar(20) NOT NULL,
  `ens` int(11) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `filename` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `devoir`
--

CREATE TABLE `devoir` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `niveau` varchar(15) NOT NULL,
  `groupe` varchar(10) NOT NULL,
  `trimestre` varchar(15) NOT NULL,
  `annee` varchar(20) NOT NULL,
  `matiere` varchar(30) NOT NULL,
  `ens` int(11) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL DEFAULT 'valide'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `devoir`
--

INSERT INTO `devoir` (`id`, `date`, `niveau`, `groupe`, `trimestre`, `annee`, `matiere`, `ens`, `added_at`, `status`) VALUES
(4, '2024-03-29 22:00:00', '2eme Année', '2AM1', '3eme trimestre', '2023-2024', 'Histoire et Géographie', 8, '2024-03-20 04:45:13', 'inactive');

-- --------------------------------------------------------

--
-- Structure de la table `emplois`
--

CREATE TABLE `emplois` (
  `id` int(11) NOT NULL,
  `niveau` varchar(20) NOT NULL,
  `groupe` varchar(20) NOT NULL,
  `trimestre` varchar(20) NOT NULL,
  `annee` varchar(20) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `emplois`
--

INSERT INTO `emplois` (`id`, `niveau`, `groupe`, `trimestre`, `annee`, `filename`, `added_at`, `status`) VALUES
(6, '2eme Année', '2AM3', '3eme trimestre', '2023-2022', 'keyboard.png', '2024-03-14 22:16:13', 'invalide'),
(7, '1ere Année', '1AM3', '2eme trimestre', '2023-2022', 'keyboard.png', '2024-03-14 23:22:02', 'valide'),
(8, '1ere Année', '1AM1', '1er trimestre', '2023-2024', 'keyboard.png', '2024-03-15 14:49:37', 'invalide'),
(9, '2eme Année', '2AM3', '2eme trimestre', '2023-2024', 'Profile pic.png', '2024-03-15 14:50:14', 'valide'),
(10, '2eme Année', '2AM3', '3eme trimestre', '2023-2024', 'tran.jpg', '2024-03-20 03:14:21', 'active');

-- --------------------------------------------------------

--
-- Structure de la table `examen`
--

CREATE TABLE `examen` (
  `id` int(11) NOT NULL,
  `niveau` varchar(20) NOT NULL,
  `trimestre` varchar(20) NOT NULL,
  `annee` varchar(20) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `examen`
--

INSERT INTO `examen` (`id`, `niveau`, `trimestre`, `annee`, `filename`, `added_at`, `status`) VALUES
(1, '2eme Année', '2eme trimestre', '2023-2024', 'CV_AISSOU_Monder.docx', '2024-03-17 12:00:24', 'inactive'),
(2, '2eme Année', '2eme trimestre', '2023-2024', 'enseigant homme.png', '2024-03-20 04:38:05', 'inactive');

-- --------------------------------------------------------

--
-- Structure de la table `observation`
--

CREATE TABLE `observation` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'notre élève',
  `student` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `observation`
--

INSERT INTO `observation` (`id`, `date`, `description`, `status`, `student`) VALUES
(1, '2024-03-28 17:00:00', 'L\'enseignant du matière islamya Mr Baadach a fait un rapport', 'consultée', 2),
(2, '2024-03-23 10:08:00', 'L\'enseignant du matière mathématique Mr Baadach a fait un rapport', 'non justifiée', 1);

-- --------------------------------------------------------

--
-- Structure de la table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `naissance` date NOT NULL,
  `niveau` varchar(30) NOT NULL,
  `user` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `groupe` varchar(10) NOT NULL,
  `date` timestamp NULL DEFAULT current_timestamp(),
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `student`
--

INSERT INTO `student` (`id`, `nom`, `prenom`, `naissance`, `niveau`, `user`, `status`, `groupe`, `date`, `type`) VALUES
(1, 'Hamadi', 'Hamadi', '2008-03-26', '1ere Année', 3, 'dsgaefsdfef', '1AM1', '2024-03-20 03:41:57', ''),
(2, 'Monder', 'aissou', '2007-10-27', '4eme Année', 2, 'notre étudiant', '4AM3', '2024-03-16 21:55:23', ''),
(3, 'Zahra', 'Fatima', '2008-05-05', '2eme Année', 4, 'notre étudiant', '2AM4', '2024-03-20 04:32:15', ''),
(4, 'dddd', 'aaefef', '2005-02-02', '4eme Année', 2, 'notre étudiant', '4AM2', '2024-03-20 04:32:59', '');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(20) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'active',
  `type` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `username`, `password`, `tel`, `status`, `type`, `email`) VALUES
(2, 'badi', 'badi', 'badi', '123456789', '0675761221', 'active', 'parent', 'qdfa@gmail.com'),
(3, 'aisso', 'monder', 'badi', '123456789', '067-576-1221', 'notre admin', 'parent', 'badi02@gmail.com'),
(4, 'AISSOU', 'Monder', 'm.aissou', '123456789', '067-567-1221', 'valide', 'parent', 'badiaissou02@gmail.com'),
(5, 'badi', 'monder', 'monder', '123456789', '067-576-1222', 'active', 'admin', 'monder@gmail.com'),
(6, 'hamadi', 'habiba', 'h.hamadi', '123456789', '066-125-7895', 'active', 'admin', 'habiba.hamadi@gmail.com'),
(7, 'fatima', 'zahra', 'f.zahra', '123456789', '054-474-8888', 'active', 'enseignant', 'fatima.z@gmail.com'),
(8, 'hamadi', 'akram', 'a.hamado', '123456789', '066-236-9968', 'notre enseignan', 'enseignant', 'a.hamadi23@gmail.com');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `absence`
--
ALTER TABLE `absence`
  ADD PRIMARY KEY (`id`),
  ADD KEY `avoir eu` (`student`);

--
-- Index pour la table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `add` (`ens`);

--
-- Index pour la table `devoir`
--
ALTER TABLE `devoir`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ajouter` (`ens`);

--
-- Index pour la table `emplois`
--
ALTER TABLE `emplois`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `examen`
--
ALTER TABLE `examen`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `observation`
--
ALTER TABLE `observation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prendre` (`student`);

--
-- Index pour la table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `avoir` (`user`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `absence`
--
ALTER TABLE `absence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `cours`
--
ALTER TABLE `cours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `devoir`
--
ALTER TABLE `devoir`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `emplois`
--
ALTER TABLE `emplois`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `examen`
--
ALTER TABLE `examen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `observation`
--
ALTER TABLE `observation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cours`
--
ALTER TABLE `cours`
  ADD CONSTRAINT `add` FOREIGN KEY (`ens`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `devoir`
--
ALTER TABLE `devoir`
  ADD CONSTRAINT `ajouter` FOREIGN KEY (`ens`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `observation`
--
ALTER TABLE `observation`
  ADD CONSTRAINT `prendre` FOREIGN KEY (`student`) REFERENCES `student` (`id`);

--
-- Contraintes pour la table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `avoir` FOREIGN KEY (`user`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
