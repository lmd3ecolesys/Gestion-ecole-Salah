-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2024 at 05:21 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `madrassati`
--

-- --------------------------------------------------------

--
-- Table structure for table `absence`
--

CREATE TABLE `absence` (
  `id_absence` int(11) NOT NULL,
  `debut` datetime NOT NULL,
  `fin` datetime NOT NULL,
  `status` varchar(20) NOT NULL,
  `student` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `absence`
--

INSERT INTO `absence` (`id_absence`, `debut`, `fin`, `status`, `student`, `description`, `admin`) VALUES
(2, '2024-05-06 00:41:00', '2024-05-08 00:41:00', 'active', 5, '', 6),
(3, '2024-05-11 17:52:00', '2024-05-31 17:52:00', 'active', 5, '', 6);

-- --------------------------------------------------------

--
-- Table structure for table `devoir`
--

CREATE TABLE `devoir` (
  `id_devoir` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `niveau` varchar(15) NOT NULL,
  `groupe` varchar(10) NOT NULL,
  `trimestre` varchar(15) NOT NULL,
  `annee` varchar(20) NOT NULL,
  `matiere` varchar(30) NOT NULL,
  `ens` int(11) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL DEFAULT 'valide',
  `admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `devoir`
--

INSERT INTO `devoir` (`id_devoir`, `date`, `niveau`, `groupe`, `trimestre`, `annee`, `matiere`, `ens`, `added_at`, `status`, `admin`) VALUES
(17, '2024-05-07 12:00:00', '1ere Année', '1AM1', '1er trimestre', '2023-2024', 'Langue Arabe', 7, '2024-05-28 11:07:32', 'invalide', 7);

-- --------------------------------------------------------

--
-- Table structure for table `emplois`
--

CREATE TABLE `emplois` (
  `id` int(11) NOT NULL,
  `niveau` varchar(20) NOT NULL,
  `groupe` varchar(20) NOT NULL,
  `trimestre` varchar(20) NOT NULL,
  `annee` varchar(20) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL DEFAULT 'valide',
  `admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `emplois`
--

INSERT INTO `emplois` (`id`, `niveau`, `groupe`, `trimestre`, `annee`, `filename`, `added_at`, `status`, `admin`) VALUES
(1, '1ere Année', '1AM1', '1er trimestre', '2023-2024', '406278630_320412844256281_7746595632619250988_n.jpg', '2024-05-07 10:29:57', 'invalide', 6),
(2, '1ere Année', '1AM1', '1er trimestre', '2023-2024', 'houria.pdf', '2024-05-24 17:09:17', 'valide', 6),
(3, '1ere Année', '1AM1', '1er trimestre', '2023-2024', 'ACFrOgDLXMNb1Qj24ny6bXofT4OSs7DEh2B4DlrrXwqb8UXLJlWQXrP-X2YljMe5q-b1RHcVVXO9Q-5SPp6-YHRKToyo_tbuSjLg3RbpGfG5FZMKn38uPXysd_m8My80YG2mRPDYH545tJTsrMrkySGexwm1oFUNoeTEm6IoLA==.pdf', '2024-05-24 23:32:47', 'valide', 6),
(4, '1ere Année', '1AM1', '1er trimestre', '2023-2024', 'ACFrOgCDdyTXUWCqNme-PcI8wEmmTBid04DHP0WA0r1lY4z-_HFy2YlA7DB_9OpcchRCevZpakZmm5yhQKBHOfMOEmiOg-st3A8aUQnS41fK4iVqCeGRe78w9AxsBXMKJGDomnyDtMT85P6ty8wM5dktTE1gt1Sz8cfFzIKoMA==.pdf', '2024-05-28 11:25:37', 'valide', 6);

-- --------------------------------------------------------

--
-- Table structure for table `examen`
--

CREATE TABLE `examen` (
  `id_examen` int(11) NOT NULL,
  `niveau` varchar(20) NOT NULL,
  `trimestre` varchar(20) NOT NULL,
  `annee` varchar(20) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL DEFAULT 'active',
  `admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `examen`
--

INSERT INTO `examen` (`id_examen`, `niveau`, `trimestre`, `annee`, `filename`, `added_at`, `status`, `admin`) VALUES
(4, '1ere Année', '1er trimestre', '2023-2024', 'me.pdf', '2024-05-24 16:50:27', 'active', 6);

-- --------------------------------------------------------

--
-- Table structure for table `observation`
--

CREATE TABLE `observation` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'notre élève',
  `student` int(11) NOT NULL,
  `admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `observation`
--

INSERT INTO `observation` (`id`, `date`, `description`, `status`, `student`, `admin`) VALUES
(3, '2019-07-09 21:55:00', 'rapport dans la séance de math à 09:00AM de Mr Bouslah  Ayoub ', 'non justifée', 5, 6);

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `type` varchar(30) NOT NULL,
  `jour` varchar(30) NOT NULL,
  `debut` varchar(10) NOT NULL,
  `fin` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'valide',
  `admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `type`, `jour`, `debut`, `fin`, `status`, `admin`) VALUES
(4, 'cantine', 'Dimanche', '09:00 AM', '12:00 PM', 'valide', 6),
(5, 'bibliothèque', 'Dimanche', '09:00 AM', '12:00 PM', 'invalide', 6),
(6, 'transport', 'Dimanche', '09:00 AM', '12:00 PM', 'valide', 6);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `naissance` date NOT NULL,
  `niveau` varchar(30) NOT NULL,
  `user` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'étudié',
  `groupe` varchar(10) NOT NULL,
  `date` timestamp NULL DEFAULT current_timestamp(),
  `admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `nom`, `prenom`, `naissance`, `niveau`, `user`, `status`, `groupe`, `date`, `admin`) VALUES
(5, 'Aidi', 'Nouar', '2007-01-28', '1ere Année', 2, 'étudié', '1AM1', '2024-05-07 11:55:19', 6),
(6, 'HM', 'HABIBA', '2024-05-12', '1ere Année', 2, 'non étudié', '1AM1', '2024-05-28 11:26:14', 6);

-- --------------------------------------------------------

--
-- Table structure for table `user`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `username`, `password`, `tel`, `status`, `type`, `email`) VALUES
(2, 'Aidi', 'Nouar', 'nouar.ai', '1234', '067-576-1221', 'Parent', 'parent', 'aidinouar@gmail.com'),
(3, 'Benmouldi', 'Brahim', 'brahim.bn', '1234', '063-556-1571', 'active', 'parent', 'benmouldibrahim23@gmail.com'),
(4, 'Makhlouf', 'Mohamed', 'mohamed.mkh', '1234', '067-567-1201', 'valide', 'parent', 'makhloufmohamed67@gmail.com'),
(5, 'hammadi', 'habiba', 'habiba.hm', '123', '0699380864', 'active', 'admin', 'hammadihabiba620@gmail.com'),
(6, 'chekhab', 'houria', 'houria.ch', '123', '0790723428', 'active', 'admin', 'chekhabhouria1@gmail.com'),
(7, 'Bouslah', 'Ayoub', 'ayoub.bs', '1234', '054-474-8888', 'active', 'enseignant', 'bouslahayoub@gmail.com'),
(8, 'Taleb', 'Noura', 'noura.tl', '1234', '066-236-9968', 'notre enseignan', 'enseignant', 'talebnoura@gmail.com'),
(9, 'Hammadi', 'Mohamed', 'mohamed.hm', '1234', '066-236-9968', 'notre enseignan', 'enseignant', 'hammadimohamed@gmail.com'),
(10, 'Nouar', 'Rachid', 'rachid.nw', '1234', '078-657-0975', 'Parent', 'parent', 'nouarrachid12@gmail.com'),
(11, 'Bouadis', 'Hocine', 'hocine.bou', '1234', '063-556-1571', 'active', 'parent', 'bouadishocine09@gmail.com'),
(12, 'Maghlaoui', 'Azedinne', 'azedinne.mgh', '1234', '067-576-1221', 'active', 'parent', 'maghlaouiazedinne@gmail.com'),
(13, 'Bendib', 'Tayeb', 'tayeb.bn', '1234', '078-657-0975', 'active', 'parent', 'bendibtayeb@gmail.com'),
(14, 'Madkour', 'Khaled', 'khaled.md', '1234', '078-657-0975', 'active', 'parent', 'madkourkhaled@gmail.com'),
(15, 'Manem', 'Ahmed', 'ahmed.mn', '1234', '078-657-0975', 'active', 'parent', 'manemahmed@gmail.com'),
(16, 'Hmaidie', 'Abdebaki', 'abdbaki.hm', '1234', '078-657-0975', 'active', 'parent', 'hmaidieabdebaki@gmail.com'),
(17, 'Rouibhia', 'Amine', 'amine.rb', '1234', '078-657-0975', 'active', 'parent', 'rouibhiaamine@gmail.com'),
(18, 'Kafef', 'Wassim', 'wassim.kf', '1234', '078-657-0975', 'active', 'parent', 'kafefwassim@gmail.com'),
(19, 'Boulakoud', 'Abdou', 'abdou.bl', '1234', '078-657-0975', 'active', 'parent', 'boulakoudabdou@gmail.com'),
(20, 'Bekouch', 'Heithem', 'heithem.bk', '1234', '078-657-0975', 'active', 'parent', 'bekouchheithem@gmail.com'),
(21, 'Madkour', 'Halim', 'halim.md', '1234', '078-657-0975', 'active', 'parent', 'madkourhalim@gmail.com'),
(22, 'Zrari', 'Boubaker', 'boubaker.zr', '1234', '078-657-0975', 'active', 'parent', 'wrariboubaker@gmail.com'),
(23, 'Ayachi', 'Yacine', 'yacine.ay', '1234', '078-657-0975', 'active', 'parent', 'ayachiyacine@gmail.com'),
(24, 'Bousaha', 'Karim', 'karim.bs', '1234', '078-657-0975', 'active', 'parent', 'bousahakarime@gmail.com'),
(25, 'Ben achour', 'Walid', 'walid.bch', '1234', '078-657-0975', 'active', 'parent', 'benachourwalid@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absence`
--
ALTER TABLE `absence`
  ADD PRIMARY KEY (`id_absence`),
  ADD KEY `avoir eu` (`student`),
  ADD KEY `admin` (`admin`);

--
-- Indexes for table `devoir`
--
ALTER TABLE `devoir`
  ADD PRIMARY KEY (`id_devoir`),
  ADD KEY `ajouter` (`ens`),
  ADD KEY `admin` (`admin`);

--
-- Indexes for table `emplois`
--
ALTER TABLE `emplois`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin` (`admin`);

--
-- Indexes for table `examen`
--
ALTER TABLE `examen`
  ADD PRIMARY KEY (`id_examen`),
  ADD KEY `admin` (`admin`);

--
-- Indexes for table `observation`
--
ALTER TABLE `observation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prendre` (`student`),
  ADD KEY `admin` (`admin`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin` (`admin`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `avoir` (`user`),
  ADD KEY `have` (`admin`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absence`
--
ALTER TABLE `absence`
  MODIFY `id_absence` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `devoir`
--
ALTER TABLE `devoir`
  MODIFY `id_devoir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `emplois`
--
ALTER TABLE `emplois`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `examen`
--
ALTER TABLE `examen`
  MODIFY `id_examen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `observation`
--
ALTER TABLE `observation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absence`
--
ALTER TABLE `absence`
  ADD CONSTRAINT `absence_ibfk_1` FOREIGN KEY (`admin`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `absence_ibfk_2` FOREIGN KEY (`student`) REFERENCES `student` (`id`);

--
-- Constraints for table `devoir`
--
ALTER TABLE `devoir`
  ADD CONSTRAINT `ajouter` FOREIGN KEY (`ens`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `devoir_ibfk_1` FOREIGN KEY (`admin`) REFERENCES `user` (`id`);

--
-- Constraints for table `emplois`
--
ALTER TABLE `emplois`
  ADD CONSTRAINT `emplois_ibfk_1` FOREIGN KEY (`admin`) REFERENCES `user` (`id`);

--
-- Constraints for table `examen`
--
ALTER TABLE `examen`
  ADD CONSTRAINT `examen_ibfk_1` FOREIGN KEY (`admin`) REFERENCES `user` (`id`);

--
-- Constraints for table `observation`
--
ALTER TABLE `observation`
  ADD CONSTRAINT `observation_ibfk_1` FOREIGN KEY (`admin`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `prendre` FOREIGN KEY (`student`) REFERENCES `student` (`id`);

--
-- Constraints for table `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `service_ibfk_1` FOREIGN KEY (`admin`) REFERENCES `user` (`id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `avoir` FOREIGN KEY (`user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `have` FOREIGN KEY (`admin`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
