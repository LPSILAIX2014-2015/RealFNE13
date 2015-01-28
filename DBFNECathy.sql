
CREATE DATABASE FNESITE;

USE FNESITE;

--
-- Base de données :  `fnesite`
--

-- --------------------------------------------------------

--
-- Structure de la table `association`
--

CREATE TABLE IF NOT EXISTS `association` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(100) DEFAULT NULL,
  `TERRITORY_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_ASSOTERRITORY` (`TERRITORY_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `association`
--

INSERT INTO `association` (`ID`, `NAME`, `TERRITORY_ID`) VALUES
(1, 'FNE13', 1),
(2, 'TrucAsso', 2),
(3, 'MachinAsso', 3),
(4, 'BiduleAsso', 4);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SENDER_ID` int(11) NOT NULL,
  `RECEIVER_ID` int(11) NOT NULL,
  `TITLE` varchar(150) NOT NULL,
  `CONTENT` blob NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_MESSAGE_SENDER` (`SENDER_ID`),
  KEY `FK_MESSAGE_RECEIVER` (`RECEIVER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `newsletter`
--

CREATE TABLE IF NOT EXISTS `newsletter` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NLDATE` date NOT NULL,
  `CONTENT` longtext,
  `PATH` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `WRITER_ID` int(11) NOT NULL,
  `TITLE` varchar(150) COLLATE utf8_bin NOT NULL,
  `DESCRIPTION` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `PDATE` date NOT NULL,
  `DURATION` int(11) DEFAULT NULL,
  `CONTENT` longtext COLLATE utf8_bin,
  `STATUS` int(11) DEFAULT NULL,
  `IMAGEPATH` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_POSTWRITER` (`WRITER_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Contenu de la table `post`
--

INSERT INTO `post` (`ID`, `WRITER_ID`, `TITLE`, `DESCRIPTION`, `PDATE`, `DURATION`, `CONTENT`, `STATUS`, `IMAGEPATH`) VALUES
(1, 1, 'FNE 13 EST MAINTENANT SUR TWITTER!', 'FNE Bouches du Rhône a créé aujourd''hui son compte Twitter!\r\n\r\n\r\nN''hésitez pas à nous rejoindre pour y découvrir toutes les actualités du département!', '2014-12-11', 5, 'FNE Bouches du Rhône a créé aujourd''hui son compte Twitter!\r\n\r\n\r\nN''hésitez pas à nous rejoindre pour y découvrir toutes les actualités du département!', NULL, 'Img/actu_145T3.jpg'),
(2, 2, 'SOIRÉE ZÉRO DÉCHET', 'Vendredi 28 novembre, FNE 13 organisait sa première Soirée Zéro Déchet dans le cadre de la Semaine Européenne de la Réduction des Déchets. Une trentaine de personne ont participé à la soirée...', '2014-12-21', 5, 'Vendredi 28 novembre, FNE 13 organisait sa première Soirée Zéro Déchet dans le cadre de la Semaine Européenne de la Réduction des Déchets. Une trentaine de personne ont participé à la soirée qui était placée sous le signe de la convivialité, avec au programme : apéritif zéro déchet, projection du film "Super Trash" de Martin Esposito et retour d''expérience.\r\n\r\nA l''apéritif, les participants ont pu déguster des cakes aux olives et tomates séchées, de la tapenade, des légumes croquants, des fruits à coques (sans coques !), etc. Tout ceci a été agrémenté de différents jus de fruits et sirops bio servis dans des verres réutilisables. Lors de cet apéritif, un jeu sur l''alimentation a également été proposé.\r\n\r\nAprès la projection du film de Martin Esposito, l''opération foyers témoins et ses premiers résultats ont été présentés. S''en est suivi une discussion sur la problématique des déchets.\r\n\r\nMais à l''issu de cette soirée, une question se pose ! Y''a-t-il eu des déchets ?\r\n\r\nEt bien, les seuls déchets résiduels qui ont été produits, l''ont été lors de la préparation de l''apéritif. Il s''agit des épluchures d''ail, qu''il n''est pas conseillé de mettre au compost...\r\n\r\nA part ça, tous les autres "déchets" ont pu être triés pour valorisation (réutilisation, recyclage, compostage) : bocaux en verre et couvercles, bouteilles en verre, paquet de farine en papier, fanes de légumes, coquille d''oeufs, serviettes et assiettes compostables.\r\n\r\nLe bilan est plus que positif. On peut dire que le challenge a été relevé !', NULL, 'Img/actu_147T3.jpg'),
(3, 5, 'test', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus eget felis sapien. Etiam efficitur suscipit odio, sed ultrices ipsum imperdiet a. Curabitur lectus diam, euismod ut dolor eget metus.', '2014-12-18', 5, '\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non ante et massa iaculis pretium. Morbi auctor arcu vitae luctus fermentum. Cras tristique accumsan nulla, vel mattis sem ultricies at. Aenean sed tellus turpis. Quisque interdum, elit in scelerisque maximus, ante neque suscipit odio, et mollis tortor sapien a dui. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Pellentesque suscipit, magna ac tristique maximus, risus ex fermentum nibh, at pulvinar turpis nisi id justo. Duis sit amet ultricies risus, sit amet dapibus risus. Etiam vestibulum metus a mi interdum, at venenatis libero semper. Nullam et leo risus. Vivamus lacinia nisi felis, nec sagittis lorem varius auctor. Sed sed libero sit amet est congue tristique. Nullam lacinia nunc ac fringilla pellentesque.\r\n\r\nCurabitur porta sed nisl a rutrum. Quisque erat quam, pulvinar nec tempor nec, laoreet ac est. Duis vel lacus lorem. Mauris diam tortor, egestas eget placerat sit amet, pretium eu mi. Donec non fermentum lorem. Aliquam a viverra ante. Mauris a metus mollis, blandit erat quis, aliquet enim. Donec ac tristique mauris, sed malesuada velit. Aliquam convallis ligula dapibus blandit ullamcorper. Sed placerat nisl eu sollicitudin vehicula. Morbi ultrices est in ligula ultricies rutrum. Praesent libero eros, interdum ac urna vel, interdum ornare diam. Fusce imperdiet pharetra justo sed aliquet. Fusce nisl lorem, tempus et imperdiet id, gravida a mi. In hac habitasse platea dictumst.\r\n\r\nMorbi ultricies ullamcorper lorem nec mattis. Aenean laoreet semper risus, pellentesque gravida lorem lacinia a. Sed lobortis ullamcorper interdum. In hac habitasse platea dictumst. Duis vestibulum augue ut sapien sodales, quis consequat lorem pulvinar. Quisque pulvinar metus quis accumsan laoreet. Quisque cursus ante a sem lacinia varius. Ut vulputate, urna sit amet pharetra convallis, neque lorem ultricies est, et iaculis sem risus vel odio. Suspendisse fringilla odio vel sapien tincidunt porta. Duis porta viverra sapien sit amet maximus. Sed est augue, fringilla eget lacus in, eleifend porttitor magna. Phasellus tincidunt turpis est, eu rutrum risus vestibulum non.\r\n\r\nQuisque sollicitudin massa ut nunc lobortis, nec congue purus vehicula. Curabitur quis odio consequat, pellentesque risus non, ultricies eros. Praesent consequat non eros sit amet rhoncus. Donec pharetra, nisl vitae sollicitudin auctor, orci nunc efficitur ligula, at fringilla magna justo scelerisque justo. Sed et ornare odio. Vestibulum eu libero eu lacus viverra gravida a sit amet lectus. Nullam placerat at velit eget feugiat. Nam fermentum sed augue non vulputate. Nam tincidunt volutpat sem, sit amet pellentesque erat euismod porta. Nunc id massa turpis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ullamcorper augue cursus, tempor sapien et, accumsan nisi. Nulla dolor ipsum, eleifend at dictum mollis, cursus ac tortor. Morbi malesuada suscipit neque in eleifend.\r\n\r\nInteger pellentesque hendrerit commodo. Phasellus porta enim ac diam placerat posuere. Maecenas dolor mauris, malesuada in risus eget, sagittis interdum est. Nulla pharetra sem nec placerat auctor. Donec lobortis dui sed laoreet sagittis. Suspendisse et aliquet purus, sit amet viverra dui. Aliquam semper eget velit in sagittis. Morbi porta placerat tempor. Sed vehicula pretium dui, at viverra massa congue id. Nunc tristique odio maximus sem consequat interdum. Integer vulputate mollis nulla. Phasellus libero lectus, pharetra id lorem ut, mattis feugiat neque. Sed egestas vulputate orci eget scelerisque. Fusce iaculis, ante ac mollis placerat, nisi erat ultrices eros, eget lacinia sapien massa eget urna. In hac habitasse platea dictumst. ', NULL, 'Img/collection_sons_de_la_nature.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `report`
--

CREATE TABLE IF NOT EXISTS `report` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `RDATE` date NOT NULL,
  `TYPE` int(11) DEFAULT NULL,
  `CONTENT` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `territory`
--

CREATE TABLE IF NOT EXISTS `territory` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `territory`
--

INSERT INTO `territory` (`ID`, `NAME`) VALUES
(1, 'Vall?®e du Rh??ne'),
(2, 'Vall?®e de l''Huveaune'),
(3, 'Les Alpilles'),
(4, 'Etang de Berre, Fos-sur-Mer'),
(5, 'M?®tropole Marseille');

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

CREATE TABLE IF NOT EXISTS `theme` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `theme`
--

INSERT INTO `theme` (`ID`, `NAME`) VALUES
(1, 'Transports'),
(2, 'Mission Juridique'),
(3, 'Climat, Air, Energie'),
(4, 'Sant?® Environnement'),
(5, 'Am?®nagement durable du territoire'),
(6, 'Industrie'),
(7, 'Eau et milieux naturels'),
(8, 'Agriculture');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `LOGIN` varchar(50) NOT NULL,
  `PASSWORD` varchar(100) NOT NULL,
  `RESET` varchar(100) DEFAULT NULL,
  `ASSOCIATION_ID` int(11) NOT NULL,
  `THEME_ID` int(11) DEFAULT NULL,
  `THEME_INTEREST_ID` int(11) DEFAULT NULL,
  `THEME_DETAILS` varchar(250) DEFAULT NULL,
  `ROLE` varchar(50) NOT NULL,
  `NAME` varchar(100) NOT NULL,
  `SURNAME` varchar(100) NOT NULL,
  `MAIL` varchar(100) NOT NULL,
  `ADRESS` varchar(250) NOT NULL,
  `CP` int(11) NOT NULL,
  `PROFESSION` varchar(100) NOT NULL,
  `PROFESSION2` varchar(100) DEFAULT NULL,
  `PRESENTATION` blob,
  `PHOTOPATH` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_USER_THEME` (`THEME_ID`),
  KEY `FK_USER_THEMEINT` (`THEME_INTEREST_ID`),
  KEY `FK_USER_ASSOCID` (`ASSOCIATION_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`ID`, `LOGIN`, `PASSWORD`, `RESET`, `ASSOCIATION_ID`, `THEME_ID`, `THEME_INTEREST_ID`, `THEME_DETAILS`, `ROLE`, `NAME`, `SURNAME`, `MAIL`, `ADRESS`, `CP`, `PROFESSION`, `PROFESSION2`, `PRESENTATION`, `PHOTOPATH`) VALUES
(1, 'nicolas.damien', 'mdp', NULL, 1, NULL, NULL, NULL, 'SADMIN', 'Damien', 'Nicolas', 'nicolas.damien@truc.fr', '33 Somewhere over the rainbow', 69696, 'Chef Supr?¬me', NULL, 0x436f75636f752021205475207665757820766f6972206d6120464e45203f, '../Photos/nicdam.png'),
(2, 'huguette1', 'mdp', NULL, 2, 4, 8, 'Infirmerie', 'MEMBRE', 'Lavieille1', 'Huguette1', 'huguette1@machin.com', '11 Highway to hell', 16666, 'Gogo-danseuse', 'Retrait?®e', 0x426f6e6a6f757220746f7574206c65206d6f6e64652e205369676ec3a9203a20487567756574746531, '../Photos/huguette1.png'),
(3, 'huguette2', 'mdp', NULL, 3, NULL, 1, NULL, 'MEMBRE', 'Lavieille2', 'Huguette2', 'huguette2@machin.com', '22 Highway to hell', 26666, 'Pole-danseuse', 'Retrait?®e', 0x426f6e6a6f757220746f7574206c65206d6f6e64652e205369676ec3a9203a20487567756574746532, '../Photos/huguette2.png'),
(4, 'huguette3', 'mdp', NULL, 4, NULL, 6, NULL, 'VALIDATOR', 'Lavieille3', 'Huguette3', 'huguette3@machin.com', '33 Highway to hell', 36666, 'Strip-teaseuse', 'Retrait?®e', 0x426f6e6a6f757220746f7574206c65206d6f6e64652e205369676ec3a9203a20487567756574746533, '../Photos/huguette3.png'),
(5, 'francis1', 'mdp', NULL, 2, 7, 4, 'Barrages hydroliques', 'ADMIN', 'Lotre1', 'Francis1', 'francis1@truc.fr', '01 Quelque part', 19000, 'Ing?®nieur Eau', NULL, 0x2e2e2e31, '../Photos/francis1.png'),
(6, 'francis2', 'mdp', NULL, 3, 8, 1, 'Plantations', 'ADMIN', 'Lotre2', 'Francis2', 'francis2@truc.fr', '02 Quelque part', 29000, 'Ing?®nieur Terre', NULL, 0x2e2e2e32, '../Photos/francis2.png'),
(7, 'francis3', 'mdp', NULL, 4, NULL, 4, NULL, 'ADMIN', 'Lotre3', 'Francis3', 'francis3@truc.fr', '03 Quelque part', 39000, 'Ing?®nieur Air', NULL, 0x2e2e2e33, '../Photos/francis3.png');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `association`
--
ALTER TABLE `association`
  ADD CONSTRAINT `FK_ASSOTERRITORY` FOREIGN KEY (`TERRITORY_ID`) REFERENCES `territory` (`ID`);

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `FK_MESSAGE_RECEIVER` FOREIGN KEY (`RECEIVER_ID`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `FK_MESSAGE_SENDER` FOREIGN KEY (`SENDER_ID`) REFERENCES `user` (`ID`);

--
-- Contraintes pour la table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `FK_POSTWRITER` FOREIGN KEY (`WRITER_ID`) REFERENCES `user` (`ID`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_USER_ASSOCID` FOREIGN KEY (`ASSOCIATION_ID`) REFERENCES `association` (`ID`),
  ADD CONSTRAINT `FK_USER_THEME` FOREIGN KEY (`THEME_ID`) REFERENCES `theme` (`ID`),
  ADD CONSTRAINT `FK_USER_THEMEINT` FOREIGN KEY (`THEME_INTEREST_ID`) REFERENCES `theme` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
