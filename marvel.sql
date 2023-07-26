-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 18 juil. 2023 à 16:42
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
-- Base de données : `marvel`
--

-- --------------------------------------------------------

--
-- Structure de la table `acteur`
--

CREATE TABLE `acteur` (
  `id_acteur` int(11) NOT NULL,
  `nom_acteur` varchar(100) DEFAULT NULL,
  `prenom_acteur` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `a_ete_vu`
--

CREATE TABLE `a_ete_vu` (
  `id_historique` int(11) NOT NULL,
  `id_film` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `a_visionne`
--

CREATE TABLE `a_visionne` (
  `id_utilisateur` int(11) NOT NULL,
  `id_historique` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `films`
--

CREATE TABLE `films` (
  `id_film` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `duree` int(11) DEFAULT NULL,
  `titre` varchar(100) DEFAULT NULL,
  `affiche` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `films`
--

INSERT INTO `films` (`id_film`, `date`, `duree`, `titre`, `affiche`) VALUES
(51, '2008-04-30', 126, 'Iron Man', 'https://media.senscritique.com/media/000006414750/300/iron_man.jpg'),
(55, '2008-07-23', 102, 'L\'Incroyable Hulk', 'https://media.senscritique.com/media/000007895449/300/l_incroyable_hulk.jpg'),
(56, '2010-04-28', 124, 'Iron Man 2', 'https://media.senscritique.com/media/000004737077/300/iron_man_2.jpg'),
(57, '2011-04-27', 115, 'Thor', 'https://media.senscritique.com/media/000006414863/300/thor.jpg'),
(58, '2011-08-17', 124, 'Captain America - First Avenger', 'https://media.senscritique.com/media/000005821362/300/captain_america_first_avenger.jpg'),
(59, '2012-04-25', 143, 'Avengers', 'https://media.senscritique.com/media/000005676799/300/avengers.jpg'),
(60, '2013-04-24', 130, 'Iron Man 3', 'https://media.senscritique.com/media/000006425182/300/iron_man_3.jpg'),
(61, '2013-10-30', 102, 'Thor - Le monde des tÃ©nÃ¨bres', 'https://media.senscritique.com/media/000016222794/300/thor_le_monde_des_tenebres.jpg'),
(62, '2014-03-26', 136, 'Captain America : Le soldat de l\'hiver', 'https://media.senscritique.com/media/000006535707/300/captain_america_le_soldat_de_l_hiver.jpg'),
(63, '2014-08-13', 122, 'Les gardiens de la galaxie', 'https://media.senscritique.com/media/000016933664/300/les_gardiens_de_la_galaxie.jpg'),
(64, '2015-04-22', 117, 'Avengers - L\'Ã¨re d\'Ultron', 'https://media.senscritique.com/media/000009596608/300/avengers_l_ere_d_ultron.jpg'),
(65, '2015-07-14', 127, 'Ant-man', 'https://media.senscritique.com/media/000009690356/300/ant_man.jpg'),
(66, '2016-04-27', 147, 'Captain America : Civil War', 'https://media.senscritique.com/media/000015137859/300/captain_america_civil_war.jpg'),
(67, '2016-10-26', 115, 'Doctor Strange', 'https://media.senscritique.com/media/000016434017/300/doctor_strange.jpg'),
(68, '2017-04-26', 137, 'Les gardiens de la galaxie Vol. 2', 'https://media.senscritique.com/media/000016933682/300/les_gardiens_de_la_galaxie_vol_2.jpg'),
(69, '2017-07-12', 133, 'Spider-man : Homecoming', 'https://media.senscritique.com/media/000018616762/300/spider_man_homecoming.jpg'),
(70, '2017-10-25', 130, 'Thor : Ragnarok', 'https://media.senscritique.com/media/000019125980/300/thor_ragnarok.jpg'),
(71, '2018-02-14', 144, 'Black Panther', 'https://media.senscritique.com/media/000017572797/300/black_panther.jpg'),
(72, '2018-04-25', 149, 'Avengers : Infinity War', 'https://media.senscritique.com/media/000017671962/300/avengers_infinity_war.jpg'),
(73, '2018-07-18', 118, 'Ant-man et la GuÃªpe', 'https://media.senscritique.com/media/000017848056/300/ant_man_et_la_guepe.jpg'),
(74, '2019-03-06', 124, 'Captain Marvel', 'https://media.senscritique.com/media/000018355538/300/captain_marvel.jpg'),
(75, '2019-04-24', 181, 'Avengers : Endgame', 'https://media.senscritique.com/media/000018476719/300/avengers_endgame.jpg'),
(76, '2019-07-03', 129, 'Spider-Man : Far From Home', 'https://media.senscritique.com/media/000018606707/300/spider_man_far_from_home.jpg'),
(77, '2021-07-07', 134, 'Black Widow', 'https://media.senscritique.com/media/000020125027/300/black_widow.jpg'),
(78, '2021-09-01', 132, 'Shang-Chi et la LÃ©gende des Dix Anneaux', 'https://media.senscritique.com/media/000020215846/300/shang_chi_et_la_legende_des_dix_anneaux.jpg'),
(79, '2021-11-03', 157, 'Les Eternels', 'https://media.senscritique.com/media/000020284694/300/les_eternels.png'),
(80, '2021-12-15', 148, 'Spider-man : No Way Home', 'https://media.senscritique.com/media/000020329432/300/spider_man_no_way_home.png'),
(81, '2022-05-04', 126, 'Doctor Strange in the Multiverse of Madness', 'https://media.senscritique.com/media/000020642694/300/doctor_strange_in_the_multiverse_of_madness.pn'),
(82, '2022-07-13', 119, 'Thor : Love and Thunder', 'https://media.senscritique.com/media/000020817335/300/thor_love_and_thunder.png'),
(83, '2022-11-09', 161, 'Black Panther : Wakanda Forever', 'https://media.senscritique.com/media/000020969194/300/black_panther_wakanda_forever.png'),
(84, '2023-02-15', 124, 'Ant-Man et la GuÃªpe - Quantumania', 'https://media.senscritique.com/media/000021132758/300/ant_man_et_la_guepe_quantumania.png'),
(85, '2023-05-03', 150, 'Les gardiens de la galaxie Vol.3', 'https://media.senscritique.com/media/000021344712/300/les_gardiens_de_la_galaxie_vol_3.png');

-- --------------------------------------------------------

--
-- Structure de la table `historique`
--

CREATE TABLE `historique` (
  `id_historique` int(11) NOT NULL,
  `vu` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `joue`
--

CREATE TABLE `joue` (
  `id_acteur` int(11) NOT NULL,
  `id_film` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `realisateur`
--

CREATE TABLE `realisateur` (
  `id_realisateur` int(11) NOT NULL,
  `nom_realisateur` varchar(100) DEFAULT NULL,
  `prenom_realisateur` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `realise`
--

CREATE TABLE `realise` (
  `id_film` int(11) NOT NULL,
  `id_realisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_utilisateur` int(11) NOT NULL,
  `pseudo` varchar(100) DEFAULT NULL,
  `motdepasse` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `acteur`
--
ALTER TABLE `acteur`
  ADD PRIMARY KEY (`id_acteur`);

--
-- Index pour la table `a_ete_vu`
--
ALTER TABLE `a_ete_vu`
  ADD PRIMARY KEY (`id_historique`,`id_film`),
  ADD KEY `FK_a_ete_vu_id_film` (`id_film`);

--
-- Index pour la table `a_visionne`
--
ALTER TABLE `a_visionne`
  ADD PRIMARY KEY (`id_utilisateur`,`id_historique`),
  ADD KEY `FK_a_visionne_id_historique` (`id_historique`);

--
-- Index pour la table `films`
--
ALTER TABLE `films`
  ADD PRIMARY KEY (`id_film`);

--
-- Index pour la table `historique`
--
ALTER TABLE `historique`
  ADD PRIMARY KEY (`id_historique`);

--
-- Index pour la table `joue`
--
ALTER TABLE `joue`
  ADD PRIMARY KEY (`id_acteur`,`id_film`),
  ADD KEY `FK_joue_id_film` (`id_film`);

--
-- Index pour la table `realisateur`
--
ALTER TABLE `realisateur`
  ADD PRIMARY KEY (`id_realisateur`);

--
-- Index pour la table `realise`
--
ALTER TABLE `realise`
  ADD PRIMARY KEY (`id_film`,`id_realisateur`),
  ADD KEY `FK_realise_id_realisateur` (`id_realisateur`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `acteur`
--
ALTER TABLE `acteur`
  MODIFY `id_acteur` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `a_ete_vu`
--
ALTER TABLE `a_ete_vu`
  MODIFY `id_historique` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `a_visionne`
--
ALTER TABLE `a_visionne`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `films`
--
ALTER TABLE `films`
  MODIFY `id_film` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT pour la table `historique`
--
ALTER TABLE `historique`
  MODIFY `id_historique` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `joue`
--
ALTER TABLE `joue`
  MODIFY `id_acteur` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `realisateur`
--
ALTER TABLE `realisateur`
  MODIFY `id_realisateur` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `realise`
--
ALTER TABLE `realise`
  MODIFY `id_film` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `a_ete_vu`
--
ALTER TABLE `a_ete_vu`
  ADD CONSTRAINT `FK_a_ete_vu_id_film` FOREIGN KEY (`id_film`) REFERENCES `films` (`id_film`),
  ADD CONSTRAINT `FK_a_ete_vu_id_historique` FOREIGN KEY (`id_historique`) REFERENCES `historique` (`id_historique`);

--
-- Contraintes pour la table `a_visionne`
--
ALTER TABLE `a_visionne`
  ADD CONSTRAINT `FK_a_visionne_id_historique` FOREIGN KEY (`id_historique`) REFERENCES `historique` (`id_historique`),
  ADD CONSTRAINT `FK_a_visionne_id_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`);

--
-- Contraintes pour la table `joue`
--
ALTER TABLE `joue`
  ADD CONSTRAINT `FK_joue_id_acteur` FOREIGN KEY (`id_acteur`) REFERENCES `acteur` (`id_acteur`),
  ADD CONSTRAINT `FK_joue_id_film` FOREIGN KEY (`id_film`) REFERENCES `films` (`id_film`);

--
-- Contraintes pour la table `realise`
--
ALTER TABLE `realise`
  ADD CONSTRAINT `FK_realise_id_film` FOREIGN KEY (`id_film`) REFERENCES `films` (`id_film`),
  ADD CONSTRAINT `FK_realise_id_realisateur` FOREIGN KEY (`id_realisateur`) REFERENCES `realisateur` (`id_realisateur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
