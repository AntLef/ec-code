-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le :  jeu. 25 juin 2020 à 18:39
-- Version du serveur :  8.0.18
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `codflix`
--

-- --------------------------------------------------------

--
-- Structure de la table `favorite`
--

DROP TABLE IF EXISTS `favorite`;
CREATE TABLE IF NOT EXISTS `favorite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `media_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `favorite`
--

INSERT INTO `favorite` (`id`, `media_id`, `user_id`) VALUES
(14, 4, 1),
(15, 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

DROP TABLE IF EXISTS `genre`;
CREATE TABLE IF NOT EXISTS `genre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `genre`
--

INSERT INTO `genre` (`id`, `name`) VALUES
(1, 'Action'),
(2, 'Horreur'),
(3, 'Science-Fiction');

-- --------------------------------------------------------

--
-- Structure de la table `history`
--

DROP TABLE IF EXISTS `history`;
CREATE TABLE IF NOT EXISTS `history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `finish_date` datetime DEFAULT NULL,
  `watch_duration` int(11) NOT NULL DEFAULT '0' COMMENT 'in seconds',
  PRIMARY KEY (`id`),
  KEY `history_user_id_fk_media_id` (`user_id`),
  KEY `history_media_id_fk_media_id` (`media_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

DROP TABLE IF EXISTS `media`;
CREATE TABLE IF NOT EXISTS `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `genre_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `release_date` date NOT NULL,
  `summary` longtext NOT NULL,
  `duration` time NOT NULL,
  `trailer_url` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `media_genre_id_fk_genre_id` (`genre_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `media`
--

INSERT INTO `media` (`id`, `genre_id`, `title`, `type`, `status`, `release_date`, `summary`, `duration`, `trailer_url`) VALUES
(1, 1, 'Rambo 1 : First Blood', 'movie', 'released', '1983-03-02', 'Revenu du Viêtnam, abruti autant par les mauvais traitements que lui ont jadis infligés ses tortionnaires que par l\'indifférence de ses concitoyens, le soldat Rambo, un ancien des commandos d\'élite, traîne sa redoutable carcasse de ville en ville. Un shérif teigneux lui interdit l\'accès de sa bourgade. Rambo insiste. Il veut seulement manger. Le shérif le met sous les verrous et laisse son adjoint brutaliser ce divertissant clochard.', '00:10:00', 'https://www.youtube.com/embed/dOyoMoDC71c'),
(2, 1, 'Rambo 2 : La Mission', 'movie', 'released', '1985-05-22', 'Ex-combattant du Viêtnam, John Rambo purge une peine de cinq années de prison. Son ancien colonel lui offre une chance de se racheter : il devra retourner au Viêtnam et repérer les camps détenant des prisonniers américains depuis la fin de la guerre. Rambo prend sa tâche très au sérieux et ne tarde pas à découvrir quelques compatriotes gémissant sous le joug de tortionnaires communistes.', '00:10:00', 'https://www.youtube.com/embed/BK4dPcAlYfQ'),
(3, 1, 'Rambo 3\r\n', 'movie', 'released', '1988-05-25', 'John Rambo est de retour de sa dernière mission au Viêtnam. Discrètement retiré en Thaïlande, il vit tranquillement, en compagnie de moines bouddhistes. Il espère ainsi se tenir à l\'écart de l\'univers de violence qui a trop longtemps été le sien. Un jour, cependant, le héros fatigué reçoit la visite du colonel Trautman, son instructeur et père spirituel, qui lui demande de lui prêter main-forte une fois encore.\r\n', '00:10:00', 'https://www.youtube.com/embed/Ng1W_qu5aJM'),
(4, 3, 'Game of Thrones', 'series', 'released', '2011-04-17', 'Le Royaume des Sept Couronnes, dont la capitale est Port-Réal (500 000 habitants), est constitué de sept provinces régies par des « maisons »4 dont la plupart des chefs aspirent à monter sur le trône. La mort du roi aiguise les appétits. Ce royaume occupe tout le sud du continent de Westeros. À l’extrême-nord, un gigantesque mur de glace protège le royaume de plusieurs créatures potentiellement dangereuses, celui-ci est supervisé par la garde de nuit une organisation militaire officielle qui vise à protéger le mur et le royaume des menaces du grand nord. Au-delà du mur vivent des créatures « primitives », les Sauvageons qui tentent d’envahir le royaume pour fuir des créatures mythiques et très dangereuses que l\'on pensait disparues depuis plusieurs siècles. À l’est, au-delà d’un détroit, se trouve le continent d’Essos sur lequel une jeune princesse en exil prépare son retour.', '00:10:00', 'https://www.youtube.com/embed/Ng1W_qu5aJM');

-- --------------------------------------------------------

--
-- Structure de la table `series`
--

DROP TABLE IF EXISTS `series`;
CREATE TABLE IF NOT EXISTS `series` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `media_id` int(11) NOT NULL,
  `season_id` int(11) NOT NULL,
  `episode_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `release_date` date NOT NULL,
  `summary` longtext NOT NULL,
  `duration` time NOT NULL,
  `trailer_url` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `series_media_id_fk_media_id` (`media_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `series`
--

INSERT INTO `series` (`id`, `media_id`, `season_id`, `episode_id`, `title`, `release_date`, `summary`, `duration`, `trailer_url`) VALUES
(1, 4, 1, 1, 'Episode 1', '2012-04-06', 'Sur le continent de Westeros, le roi Robert Baratheon règne sur le Royaume des Sept Couronnes depuis qu\'il a mené à la victoire la rébellion contre le roi fou, Aerys II Targaryen, dix-sept ans plus tôt. Son guide et principal conseiller, Jon Arryn, venant de décéder, il part dans le nord du royaume demander à son vieil ami Eddard Stark, seigneur suzerain du Nord et de la maison Stark, de remplacer leur regretté mentor au poste de « Main du roi ». Eddard, peu désireux de quitter ses terres, accepte à contre-cœur de partir à la cour avec ses deux filles Arya et Sansa, alors que Jon Snow, son fils bâtard, se prépare à intégrer la fameuse Garde de nuit : la confrérie protégeant le royaume depuis des siècles, à son septentrion, de toute créature pouvant provenir d\'au-delà du Mur protecteur. Mais, juste avant le départ pour le Sud, Bran, fils Stark, fait une découverte en escaladant une tour de Winterfell dont découleront des conséquences inattendues…\r\n<br><br>\r\nDans le même temps, sur le continent Essos, Viserys Targaryen, héritier « légitime » en exil des Sept Couronnes et fils d\'Aerys II, projette de marier sa jeune sœur Daenerys au Khal Drogo, le chef d\'une puissante horde de cavaliers nomades afin de s\'en faire des alliés, en vue de la reconquête du royaume. Mais Viserys est presque aussi instable mentalement que son père.\r\n\r\n', '01:03:36', 'https://www.youtube.com/embed/aAF12LNAeNI'),
(2, 4, 1, 2, 'Episode 2', '2012-04-13', 'Après la mort du roi Robert Baratheon et d\'Eddard Stark, la légitimité du roi Joffrey est contestée par Stannis et Renly, frères de Robert, tandis que Sansa Stark est retenue comme otage à Port-Réal. Robb Stark poursuit sa rébellion pour venger son père et libérer sa sœur, bien que personne ne sache où se trouve Arya Stark. Mais son ami Théon, censé lui procurer plus de troupes de la part de son père, le trahit en prenant Winterfell afin de redorer l\'honneur de la maison Greyjoy. Lord Tywin Lannister, père de la Reine régente Cersei et grand-père du roi, qui détient sans le savoir Arya Stark, continue de son côté à lutter à la fois contre les Baratheon et contre les Nordiens de Robb Stark. Chaque camp cherche de nouveaux alliés, et la guerre se prolonge, ignorant la menace d\'au-delà du Mur. En effet, Lord Jeor Mormont continue de guider la Garde de nuit face aux Sauvageons, soutenu par Jon Snow, cherchant désespérément un moyen d\'arrêter la marche de leur immense armée vers le sud.\r\n<br><br>\r\nDe l\'autre côté du Détroit, après avoir perdu les Dothraki, Daenerys Targaryen emmène ses dragons jusqu\'à la cité de Qarth, où elle espère trouver un appui en vue de reconquérir les Sept-Couronnes.\r\n\r\n', '00:57:01', 'https://www.youtube.com/embed/Ng1W_qu5aJM'),
(11, 4, 2, 1, 'Episode 1', '2013-03-01', 'Après la mort du roi Robert Baratheon et d\'Eddard Stark, la légitimité du roi Joffrey est contestée par Stannis et Renly, frères de Robert, tandis que Sansa Stark est retenue comme otage à Port-Réal. Robb Stark poursuit sa rébellion pour venger son père et libérer sa sœur, bien que personne ne sache où se trouve Arya Stark. Balon Greyjoy lui profite du chaos ambiant pour prendre son autonomie en demandant à son fils Theon de trahir les Stark et de prendre Winterfell. Lord Tywin Lannister, père de la reine Cersei et grand-père du roi, qui détient Arya sans le savoir, continue de son côté à lutter à la fois contre les Baratheon et contre les Nordiens de Robb Stark. Chaque camp cherche de nouveaux alliés et la guerre des Cinq Rois se prolonge, ignorant la menace d\'au-delà du Mur. Au Nord, le Lord Commandant Jeor Mormont continue de guider la Garde de Nuit face aux Sauvageons, soutenu par Jon Snow, cherchant désespérément un moyen d\'arrêter la marche de leur immense armée vers le sud. Après quoi, le retour des Marcheurs blancs est officiellement acté.', '00:52:58', 'https://www.youtube.com/embed/SBELCQ4xPJU'),
(12, 4, 2, 2, 'Episode 2', '2013-03-08', 'Après la mort du roi Robert Baratheon et d\'Eddard Stark, la légitimité du roi Joffrey est contestée par Stannis et Renly, frères de Robert, tandis que Sansa Stark est retenue comme otage à Port-Réal. Robb Stark poursuit sa rébellion pour venger son père et libérer sa sœur, bien que personne ne sache où se trouve Arya Stark. Balon Greyjoy lui profite du chaos ambiant pour prendre son autonomie en demandant à son fils Theon de trahir les Stark et de prendre Winterfell. Lord Tywin Lannister, père de la reine Cersei et grand-père du roi, qui détient Arya sans le savoir, continue de son côté à lutter à la fois contre les Baratheon et contre les Nordiens de Robb Stark. Chaque camp cherche de nouveaux alliés et la guerre des Cinq Rois se prolonge, ignorant la menace d\'au-delà du Mur. Au Nord, le Lord Commandant Jeor Mormont continue de guider la Garde de Nuit face aux Sauvageons, soutenu par Jon Snow, cherchant désespérément un moyen d\'arrêter la marche de leur immense armée vers le sud. Après quoi, le retour des Marcheurs blancs est officiellement acté.', '00:54:13', 'https://www.youtube.com/embed/biqw1vDPhsU');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(254) NOT NULL,
  `password` varchar(80) NOT NULL,
  `verify` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `verify`) VALUES
(7, 'coding@gmail.com', '$2y$10$Eis1Yueg3TNO0WLIga9Ka.aLo6/uYQdIvinAs.Sgav8yL16bt346m', 0);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_media_id_fk_media_id` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `history_user_id_fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_genre_id_b1257088_fk_genre_id` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
