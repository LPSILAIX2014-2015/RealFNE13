-- phpMyAdmin SQL Dump
-- version 4.1.9
-- http://www.phpmyadmin.net
--
-- Client :  mysql51-84.pro
-- Généré le :  Mar 17 Mars 2015 à 10:42
-- Version du serveur :  5.1.73-2+squeeze+build1+1-log
-- Version de PHP :  5.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `fnekxazadev`
--

-- --------------------------------------------------------

--
-- Structure de la table `ASSOCIATION`
--

CREATE TABLE IF NOT EXISTS `ASSOCIATION` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(100) DEFAULT NULL,
  `TERRITORY_ID` int(11) NOT NULL,
  `THEME_ID` int(11) NOT NULL,
  `IMAGEPATH` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_ASSO_TERRID` (`TERRITORY_ID`),
  KEY `FK_ASSO_THEMEID` (`THEME_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=53 ;

--
-- Contenu de la table `ASSOCIATION`
--

INSERT INTO `ASSOCIATION` (`ID`, `NAME`, `TERRITORY_ID`, `THEME_ID`, `IMAGEPATH`) VALUES
(1, 'FNE13', 1, 1, NULL),
(52, 'asso a supprimer', 5, 3, 'Img/LogoAsso/94a1-taisez.jpg'),
(48, 'FRANCK', 5, 3, 'Img/LogoAsso/braum_by_decompositions-d7gghvk.png'),
(15, 'Agir pour la Crau', 4, 1, '../Img/LogoAsso/photo_20T1.png'),
(16, 'Arles Camargues Nature Environnement', 2, 2, '../Img/LogoAsso/photo_13T1.gif'),
(17, 'Association de D&eacute;fense de l''environnement de la basse Vall&eacute;e de l''Huveaune', 3, 3, '../Img/LogoAsso/photo_12T1.jpg'),
(18, 'Association de D&eacute;fense du Site du R&eacute;altor (A.D.S.R.)', 4, 4, '../Img/LogoAsso/photo_4T1.png'),
(19, 'Association de Protection des collines Peypinoises', 3, 5, '../Img/LogoAsso/photo_23T1.jpg'),
(20, 'Association Nature Environnement Cadre de Vie', 1, 6, '../Img/LogoAsso/photo_10T1.png'),
(21, 'Association Pont de Beraud Torse - RICM', 2, 7, '../Img/LogoAsso/photo_28T1.jpg'),
(22, 'Association pour la sauvegarde du patrimoine Roussetain', 3, 8, '../Img/LogoAsso/aucuneimage.jpg'),
(23, 'Association S&eacute;nassaise de D&eacute;fense de l''Environnement', 4, 1, '../Img/LogoAsso/photo_6T1.png'),
(24, 'Atelier Marseillais d''Initiative en Ecologie Urbaine', 5, 2, '../Img/LogoAsso/photo_1T1.jpg'),
(25, 'CIQ Val de Sibourg', 1, 3, '../Img/LogoAsso/photo_11T1.jpg'),
(26, 'Colineo', 2, 4, '../Img/LogoAsso/photo_2T1.jpg'),
(27, 'Convergence Ecologique du Pays de Gardanne', 3, 5, '../Img/LogoAsso/photo_21T1.gif'),
(28, 'D&eacute;fense du cadre de vie et de l''environnement au sud de Luynes', 4, 6, '../Img/LogoAsso/aucuneimage.jpg'),
(29, 'Eco-Relais', 5, 7, '../Img/LogoAsso/photo_18T1.jpg'),
(30, 'Environnement Lan&ccedil;onnais', 1, 8, '../Img/LogoAsso/aucuneimage.jpg'),
(31, 'Expertise Ecologique, Education &agrave; l''Environnement', 2, 1, '../Img/LogoAsso/photo_22T1.png'),
(32, 'La Bourine', 3, 2, '../Img/LogoAsso/photo_9T1.jpg'),
(33, 'Le collectif v&eacute;los en ville', 4, 3, '../Img/LogoAsso/photo_27T1.jpg'),
(34, 'Le Loubatas', 5, 4, '../Img/LogoAsso/photo_25T1.jpg'),
(35, 'Les amis du Montaiguet et du Pont de l''Arc', 1, 5, '../Img/LogoAsso/photo_26T1.gif'),
(36, 'Ligue de D&eacute;fense des Alpilles', 2, 6, '../Img/LogoAsso/photo_8T1.jpg'),
(37, 'Nacicca', 3, 7, '../Img/LogoAsso/photo_19T1.jpg'),
(38, 'Nature Environnement Allauch', 4, 8, '../Img/LogoAsso/photo_17T1.png'),
(39, 'Pays d''Aix Ecologie', 5, 1, '../Img/LogoAsso/photo_32T1.jpg'),
(40, 'R&eacute;seau vert', 1, 2, '../Img/LogoAsso/aucuneimage.jpg'),
(41, 'Sauvegarde des Terres du Patrimoine et des Paysages', 2, 3, '../Img/LogoAsso/photo_31T1.png'),
(42, 'SOS NATURE SUD', 3, 4, '../Img/LogoAsso/photo_14T1.png'),
(43, 'Union Calanques Littoral', 4, 5, '../Img/LogoAsso/photo_5T1.jpg'),
(44, 'Ventabren Demain', 5, 6, '../Img/LogoAsso/photo_16T1.png'),
(45, 'Vivre &agrave; Gemenos', 1, 7, '../Img/LogoAsso/photo_3T1.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `CLOUD`
--

CREATE TABLE IF NOT EXISTS `CLOUD` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `USER_ID` int(11) NOT NULL,
  `PATH_FILE` varchar(255) DEFAULT NULL,
  `SIZE` int(11) DEFAULT NULL,
  `CDATE` date NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_CLOUD_USER_ID` (`USER_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `CLOUD`
--

INSERT INTO `CLOUD` (`ID`, `USER_ID`, `PATH_FILE`, `SIZE`, `CDATE`) VALUES
(4, 8, '94a1-taisez.jpg', 3784, '2015-03-12'),
(3, 8, '5234-kids.jpg', 9611, '2015-03-12'),
(5, 1, '19cc-sueur.gif', 14340, '2015-03-12'),
(6, 14, 'affe-braum_by_decompositions-d7gghvk.png', 50557, '2015-03-12');

-- --------------------------------------------------------

--
-- Structure de la table `COMMENTAIRE`
--

CREATE TABLE IF NOT EXISTS `COMMENTAIRE` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `WRITER_ID` int(11) NOT NULL,
  `POST_ID` int(11) NOT NULL,
  `CONTENT` text NOT NULL,
  `COM_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `COMMENTAIRE`
--

INSERT INTO `COMMENTAIRE` (`ID`, `WRITER_ID`, `POST_ID`, `CONTENT`, `COM_DATE`) VALUES
(1, 17, 43, 'TestCommentaire', '2015-02-25 14:25:52'),
(2, 17, 44, 'Super article, continuez comme ça !', '2015-02-25 14:27:00'),
(3, 17, 50, 'Amazing !', '2015-02-25 14:27:30'),
(4, 17, 47, 'First !', '2015-02-25 14:28:48'),
(5, 12, 53, 'test', '2015-02-25 14:39:18'),
(6, 18, 53, 'retst', '2015-02-26 10:06:58'),
(7, 1, 47, 'Second !', '2015-02-26 10:21:10'),
(8, 8, 56, 'Lool', '2015-03-11 12:54:47'),
(9, 16, 56, 'Pas mal comme évènement ça !', '2015-03-11 13:17:26'),
(10, 16, 56, '</div>', '2015-03-11 13:17:33'),
(11, 1, 56, 'Ouiiiii', '2015-03-11 13:26:19'),
(12, 8, 58, 'l''oeil vif, la muselière soyeuse', '2015-03-11 13:42:06'),
(13, 8, 58, 'l''oeil vif, la muselière soyeuse', '2015-03-11 13:42:06'),
(14, 13, 66, 'salut', '2015-03-12 09:45:49'),
(15, 1, 71, 'ok', '2015-03-13 10:00:44');

-- --------------------------------------------------------

--
-- Structure de la table `LOGINFAIL`
--

CREATE TABLE IF NOT EXISTS `LOGINFAIL` (
  `ID_USER` int(11) NOT NULL,
  `IP` varchar(50) DEFAULT NULL,
  `EXPIRE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ATTEMPTS` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`ID_USER`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `MESCAT`
--

CREATE TABLE IF NOT EXISTS `MESCAT` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `MESCAT`
--

INSERT INTO `MESCAT` (`ID`, `NAME`) VALUES
(1, 'Contact'),
(2, 'Positionnement'),
(3, 'Agenda'),
(4, 'Ev&egrave;nement');

-- --------------------------------------------------------

--
-- Structure de la table `MESSAGE`
--

CREATE TABLE IF NOT EXISTS `MESSAGE` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SENDER_ID` int(11) NOT NULL,
  `RECEIVER_ID` int(11) NOT NULL,
  `CAT_ID` int(11) NOT NULL,
  `THEME_ID` int(11) NOT NULL,
  `ISREAD` int(11) DEFAULT '0',
  `ISARCHIVE` int(11) DEFAULT '0',
  `SENDDATE` date DEFAULT NULL,
  `TITLE` varchar(150) NOT NULL,
  `CONTENT` text NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_MESSAGE_CATID` (`CAT_ID`),
  KEY `FK_MESSAGE_THEMEID` (`THEME_ID`),
  KEY `FK_MESSAGE_SENDER` (`SENDER_ID`),
  KEY `FK_MESSAGE_RECEIVER` (`RECEIVER_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Contenu de la table `MESSAGE`
--

INSERT INTO `MESSAGE` (`ID`, `SENDER_ID`, `RECEIVER_ID`, `CAT_ID`, `THEME_ID`, `ISREAD`, `ISARCHIVE`, `SENDDATE`, `TITLE`, `CONTENT`) VALUES
(6, 1, 1, 1, 1, 1, 0, '2015-02-25', 'A', 'B'),
(7, 1, 1, 1, 4, 1, 0, '2015-02-25', 'D', 'BC'),
(5, 1, 2, 0, 0, 0, 0, '2015-02-23', 'sqdqsd', 'qsdqsd'),
(8, 13, 14, 1, 3, 1, 1, '2015-02-25', 'test.franck', 'test de consultation'),
(15, 9, 13, 1, 5, 1, 0, '2015-03-11', 'faire du taisez', 'sauvons la planète, tuons tous les edécibels'),
(11, 12, 9, 1, 3, 1, 0, '2015-02-25', 'test by franck', 'test le voici'),
(23, 16, 8, 1, 4, 1, 0, '2015-03-11', 'Sauve les arbres !', 'Mange un castor !'),
(18, 9, 12, 2, 1, 1, 0, '2015-03-11', 'le silence au delà des mots', 'le silence au delà des mots'),
(19, 13, 9, 1, 4, 1, 0, '2015-03-11', 'Pourquoi ?', 'Pourquoi vouloir tuer les décibels ? ^^'),
(20, 9, 8, 2, 4, 1, 0, '2015-03-11', 'trouvailles de valeurs', 'Sauvez un russe juif, collectionnez les trouvailles de valeurr'),
(21, 1, 8, 2, 2, 1, 0, '2015-03-11', 'retour', 'taiez or not taisez'),
(22, 16, 8, 1, 2, 1, 0, '2015-03-11', 'S''il te plaît...', 'FERME TA PUTAIN DE GUEULE PLEINE DE MERDE !!!!!!!!!!! Enculé !'),
(25, 16, 18, 1, 3, 1, 0, '2015-03-11', 'Proposition de changement de MDP', 'Bonjour, nous vous proposons aujourd''hui un évènement concerné un champs d''éolienne dans les bouches du rhônes, cela pourrait vous intéresser.\n\nRendez-vous dans la partie "Articles" si c''est le cas.'),
(26, 16, 18, 2, 1, 1, 0, '2015-03-11', 'Repositionnement de nos idées', 'Bonjour, d''après une étude les bus de la ville d''aix-en-provence consommeraient trop de carburant. Nous appelons donc à partir d''aujourd''hui à demander une action afin que ce problème puisse être réglé.'),
(30, 9, 12, 2, 1, 1, 0, '2015-03-11', 'car la parole est d''argent, le silence est d''or!!!!', 'et pourquoi pas???'),
(31, 1, 1, 1, 2, 1, 0, '2015-03-11', 'Test', 'Test message long fg s445d sd5 g gzg zg4z g6z zg1 zgz1g 65he1s6th1 56 1e eh e5h1  1 51e5q61 56q1ehq 51q56 1h 1q5e1h 5qe1h1qtj65q1thqerthl;q  qe;hlr;hq ;  qelrh;qergkqerjgug qg ergjn ngqrng l nrg');

-- --------------------------------------------------------

--
-- Structure de la table `NEWSLETTER`
--

CREATE TABLE IF NOT EXISTS `NEWSLETTER` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NLDATE` date NOT NULL,
  `CONTENT` longtext,
  `PATH` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `NOTIFICATION`
--

CREATE TABLE IF NOT EXISTS `NOTIFICATION` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `RECEIVER_ID` int(11) DEFAULT NULL,
  `CONTENT` text NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_NOTIFICATION_RECEIVER` (`RECEIVER_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `POST`
--

CREATE TABLE IF NOT EXISTS `POST` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `WRITER_ID` int(11) NOT NULL,
  `TITLE` varchar(150) NOT NULL,
  `PTYPE` varchar(50) DEFAULT NULL,
  `PDATE` date NOT NULL,
  `INSCRIPTION` tinyint(1) DEFAULT NULL,
  `PLACE` varchar(100) DEFAULT NULL,
  `DATE_BEGIN` date DEFAULT NULL,
  `THEME_ID` int(11) NOT NULL,
  `DURATION` int(11) DEFAULT NULL,
  `CONTENT` longtext NOT NULL,
  `STATUS` int(11) DEFAULT NULL,
  `IMAGEPATH` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_POSTWRITER` (`WRITER_ID`),
  KEY `FK_POSTTHEME` (`THEME_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=72 ;

--
-- Contenu de la table `POST`
--

INSERT INTO `POST` (`ID`, `WRITER_ID`, `TITLE`, `PTYPE`, `PDATE`, `INSCRIPTION`, `PLACE`, `DATE_BEGIN`, `THEME_ID`, `DURATION`, `CONTENT`, `STATUS`, `IMAGEPATH`) VALUES
(60, 19, 'charly', 'ARTICLE', '2015-03-12', 0, '', '0000-00-00', 2, 0, '&#60;p&#62;CharlyCharlyCharlyCharlyCharlyCharlyCharlyCharlyCharlyCharlyCharlyCharlyCharlyCharlyCharlyCharlyCharlyCharlyCharlyCharlyCharlyCharlyCharlyCharlyCharlyCharlyCharlyCharlyCharlyCharlyCharlyCharlyCharlyCharly&#60;/p&#62;', 1, 'Img/ImgArticle/images.jpg'),
(62, 8, 'silence, mécréants', 'ARTICLE', '2015-03-12', 0, '', '0000-00-00', 2, 0, '&#60;p&#62;taisez voustaisez voustaisez voustaisez voustaisez voustaisez voustaisez voustaisez voustaisez voustaisez voustaisez voustaisez voustaisez voustaisez voustaisez voustaisez voustaisez voustaisez voustaisez voustaisez voustaisez voustaisez voustaisez voustaisez voustaisez voustaisez voustaisez voustaisez voustaisez voustaisez voustaisez voustaisez voustaisez voustaisez voustaisez voustaisez voustaisez voustaisez voustaisez voustaisez voustaisez voustaisez voustaisez voustaisez vous&#60;/p&#62;', 1, 'Img/ImgArticle/muselez.jpg'),
(63, 8, 'taisez vous', 'ARTICLE', '2015-03-12', NULL, '', '0000-00-00', 3, 0, '&#60;p&#62;La, parole est d&#39;argent, le silence est d&#39;or!!&#60;br&#62;La, parole est d&#39;argent, le silence est d&#39;or!!&#60;br&#62;La, parole est d&#39;argent, le silence est d&#39;or!!&#60;br&#62;La, parole est d&#39;argent, le silence est d&#39;or!!&#60;br&#62;La, parole est d&#39;argent, le silence est d&#39;or!!&#60;br&#62;La, parole est d&#39;argent, le silence est d&#39;or!!&#60;br&#62;La, parole est d&#39;argent, le silence est d&#39;or!!&#60;br&#62;La, parole est d&#39;argent, le silence est d&#39;or!!&#60;br&#62;La, parole est d&#39;argent, le silence est d&#39;or!!&#60;br&#62;La, parole est d&#39;argent, le silence est d&#39;or!!&#60;br&#62;La, parole est d&#39;argent, le silence est d&#39;or!!&#60;br&#62;La, parole est d&#39;argent, le silence est d&#39;or!!&#60;br&#62;La, parole est d&#39;argent, le silence est d&#39;or!!&#60;br&#62;La, parole est d&#39;argent, le silence est d&#39;or!!&#60;br&#62;La, parole est d&#39;argent, le silence est d&#39;or!!&#60;/p&#62;', 1, 'Img/ImgArticle/taisez.jpg'),
(50, 1, 'There isn''t alternative', 'ARTICLE', '2014-11-12', NULL, NULL, NULL, 4, 10, '"However, the solution to this problem submitted to me can take the form of a choice between two alternatives.\n    "Either we know every variety of creature populating our planet, or we do not.', 1, 'Img/ImgArticle/no_al.png'),
(51, 2, 'We find the habitat of the specimen find the last week', 'ARTICLE', '2014-11-22', NULL, NULL, NULL, 3, 2, '"If we do not know every one of them, if nature still keeps ichthyological secrets from us, nothing is more admissible than to accept the \n    existence of fish or cetaceans of new species or even new genera, animals with a basically ''cast-iron'' constitution that inhabit strata \n    beyond the reach of our soundings, and which some development or other, an urge or a whim if you prefer, can bring to the upper level of \n    the ocean for long intervals.', 0, 'Img/ImgArticle/habitat.jpg'),
(52, 3, 'Presentation of specimen in the world', 'ARTICLE', '2014-12-26', NULL, NULL, NULL, 4, 3, '"In essence, the narwhale is armed with a sort of ivory sword, or lance, as certain naturalists have expressed it. It''s a king-sized tooth as \r\n    hard as steel. Some of these teeth have been found buried in the bodies of baleen whales, which the narwhale attacks with invariable success. \r\n    Others have been wrenched, not without difficulty, from the undersides of vessels that narwhales have pierced clean through, as a gimlet pierces \r\n    a wine barrel. The museum at the Faculty of Medicine in Paris owns one of these tusks with a length of 2.25 meters and a width at its base of \r\n    forty-eight centimeters!', 1, 'Img/ImgArticle/presentation.jpg'),
(66, 14, 'Test.Franck', 'ARTICLE', '2015-03-12', 0, 'Avignon', '2015-03-28', 3, 3, '&#60;p&#62;&#60;span class=&#34;gros&#34;&#62;&#60;b&#62;&#60;i class=&#34;txtIta&#34;&#62;Test de d&#39;un article lié à un événem&#60;/i&#62;ent&#60;/b&#62;&#60;/span&#62;&#60;br&#62;&#60;br&#62;Quid enim tam absurdum quam delectari multis inanimis rebus, ut honore, ut gloria, ut aedificio, ut vestitu cultuque corporis, animante virtute praedito, eo qui vel amare vel, ut ita dicam, redamare possit,  Nihil est enim remuneratione benevolentiae, nihil vicissitudine studiorum officiorumque iucundius.&#60;br&#62;&#60;br&#62;&#60;b&#62;Franck :&#60;/b&#62;&#60;div class=&#34;txtIta&#34;&#62;&#34;test d&#39; une citation&#34;&#60;/div&#62;&#60;/p&#62;', 1, 'Img/ImgArticle/braum_by_decompositions-d7gghvk.png'),
(47, 1, 'The complications with a police', 'ARTICLE', '2015-02-07', NULL, NULL, NULL, 4, 7, 'I complied. Since I could no longer hold my tongue, I let it wag. I discussed the question in its every aspect, both political and scientific, \r\n    and this is an excerpt from the well-padded article I published in the issue of April 30.', 1, 'Img/ImgArticle/police.jpg'),
(48, 2, 'What''s this?', 'ARTICLE', '2014-11-17', NULL, NULL, NULL, 5, 2, '"Therefore," I wrote, "after examining these different hypotheses one by one, we are forced, every other supposition having been refuted, \r\n    to accept the existence of an extremely powerful marine animal.', 1, 'Img/ImgArticle/specimen.jpg'),
(49, 3, 'New specimen marine', 'ARTICLE', '2014-10-15', NULL, NULL, NULL, 7, 1, '"The deepest parts of the ocean are totally unknown to us. No soundings have been able to reach them. What goes on in those distant depths? \r\n    What creatures inhabit, or could inhabit, those regions twelve or fifteen miles beneath the surface of the water? What is the constitution of \r\n    these animals? It''s almost beyond conjecture.', 0, 'Img/ImgArticle/specimen1.jpg'),
(45, 2, 'The best countries', 'ARTICLE', '2015-01-18', NULL, NULL, NULL, 6, 4, 'So, after inquiries conducted in England, France, Russia, Prussia, Spain, Italy, America, and even Turkey, \r\n    the hypothesis of an underwater Monitor was ultimately rejected.', 0, 'Img/ImgArticle/pays.jpg'),
(46, 3, 'My first travel', 'ARTICLE', '2015-01-14', NULL, NULL, NULL, 2, 5, 'After I arrived in New York, several people did me the honor of consulting me on the phenomenon in question. In France I had published a \r\n    two-volume work, in quarto, entitled The Mysteries of the Great Ocean Depths. Well received in scholarly circles, this book had established \r\n    me as a specialist in this pretty obscure field of natural history. My views were in demand. As long as I could deny the reality of the business, \r\n    I confined myself to a flat "no comment." But soon, pinned to the wall, I had to explain myself straight out. And in this vein, \r\n    "the honorable Pierre Aronnax, Professor at the Paris Museum," was summoned by The New York Herald to formulate his views no matter what.', 1, 'Img/ImgArticle/travel.jpg'),
(68, 9, 'TITRE', 'ARTICLE', '2015-03-12', NULL, '', '0000-00-00', 1, 0, '&#60;p&#62;dhigIPDGHÙgihÎHGÔHgÔBVÔBVÔUBDdhigIPDGHÙgihÎHGÔHgÔBVÔBVÔUBDdhigIPDGHÙgihÎHGÔHgÔBVÔBVÔUBDdhigIPDGHÙgihÎHGÔHgÔBVÔBVÔUBDdhigIPDGHÙgihÎHGÔHgÔBVÔBVÔUBDdhigIPDGHÙgihÎHGÔHgÔBVÔBVÔUBDdhigIPDGHÙgihÎHGÔHgÔBVÔBVÔUBDdhigIPDGHÙgihÎHGÔHgÔBVÔBVÔUBDdhigIPDGHÙgihÎHGÔHgÔBVÔBVÔUBDdhigIPDGHÙgihÎHGÔHgÔBVÔBVÔUBDdhigIPDGHÙgihÎHGÔHgÔBVÔBVÔUBDdhigIPDGHÙgihÎHGÔHgÔBVÔBVÔUBDdhigIPDGHÙgihÎHGÔHgÔBVÔBVÔUBDdhigIPDGHÙgihÎHGÔHgÔBVÔBVÔUBDdhigIPDGHÙgihÎHGÔHgÔBVÔBVÔUBDdhigIPDGHÙgihÎHGÔHgÔBVÔBVÔUBDdhigIPDGHÙgihÎHGÔHgÔBVÔBVÔUBDdhigIPDGHÙgihÎHGÔHgÔBVÔBVÔUBDdhigIPDGHÙgihÎHGÔHgÔBVÔBVÔUBD&#60;/p&#62;', 1, NULL),
(65, 1, 'fsdfgsdfsd', 'ARTICLE', '2015-03-12', NULL, 'fjkfk', '0000-00-00', 1, 1, '&#60;p&#62;oooooooooooooo&#60;br&#62;lllllllllllllllllllllllllllllllll&#60;br&#62;mmmmmmmmmmmmmm&#60;br&#62;kkkkkkkkkkkkkkkk&#60;br&#62;&#60;/p&#62;', 1, NULL),
(58, 8, 'fête du taisez', 'ARTICLE', '2015-03-12', 0, 'strasbourg', '0000-00-00', 3, 2, '&#60;p&#62;économisons la planète!! fermez là!!!&#60;/p&#62;', 1, 'Img/ImgArticle/taisez.jpg'),
(59, 1, 'ce soir y&#39;a le fiesta', 'ARTICLE', '2015-03-11', 0, 'Strasbourg', '0000-00-00', 3, 5, '&#60;p&#62;Ceci est un article bidon qui ne veut rien de rien de chez rien dire mais bon fallait bien ecrire quelques chose qui depasse 50 caractéres !! &#60;br&#62;&#60;/p&#62;', 0, NULL),
(67, 1, 'vive les saucisses', 'ARTICLE', '2015-03-12', NULL, 'fête de la saucisse francomptoise', '2015-12-03', 1, 2, '&#60;p&#62;vive les belles saucisses.&#60;b&#62;vive les belles saucisses&#60;/b&#62;&#60;br&#62;vive les belles saucisses.&#60;b&#62;vive les belles saucisses&#60;/b&#62;&#60;br&#62;vive les belles saucisses.&#60;b&#62;vive les belles saucisses&#60;/b&#62;vive les belles saucisses.&#60;b&#62;vive les belles saucisses&#60;/b&#62;&#60;br&#62;vive les belles saucisses.&#60;b&#62;vive les belles saucisses&#60;/b&#62;&#60;br&#62;vive les belles saucisses.&#60;b&#62;vive les belles saucisses&#60;/b&#62;&#60;br&#62;vive les belles saucisses.&#60;b&#62;vive les belles saucisses&#60;/b&#62;&#60;br&#62;vive les belles saucisses.&#60;b&#62;vive les belles saucisses&#60;/b&#62;&#60;br&#62;vive les belles saucisses.&#60;b&#62;vive les belles saucisses&#60;/b&#62;vive les belles saucisses.&#60;b&#62;vive les belles saucisses&#60;/b&#62;&#60;/p&#62;', 1, 'Img/ImgArticle/saucisse.jpg'),
(69, 1, 'jeudi12', 'ARTICLE', '2015-03-12', NULL, 'aix en provence', '0000-00-00', 3, 1, '&#60;p&#62;ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article &#60;/p&#62;', 1, NULL),
(70, 1, 'articleevenement', 'ARTICLE', '2015-03-12', 0, 'aix en provence', '0000-00-00', 1, 2, '&#60;p&#62;ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article ceci est un article &#60;/p&#62;', 1, NULL),
(71, 1, 'TestJ', 'ARTICLE', '2015-03-13', NULL, '', '0000-00-00', 1, 0, '&#60;p&#62;okokokoko&#60;br&#62;okokokokokok&#60;br&#62;mpmpmpmpm&#60;br&#62;bkfihbnhfghfg&#60;br&#62;FIN&#60;/p&#62;', 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `REPORT`
--

CREATE TABLE IF NOT EXISTS `REPORT` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `RDATE` date NOT NULL,
  `TYPE` varchar(50) DEFAULT NULL,
  `CONTENT` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

--
-- Contenu de la table `REPORT`
--

INSERT INTO `REPORT` (`ID`, `RDATE`, `TYPE`, `CONTENT`) VALUES
(1, '2014-12-20', 'PROFIL', 'HUGUETTE A CHANGE SON PROFIL -> CHAMP DESCRIPTION'),
(2, '2014-11-20', 'ARTICLE', 'HUGUETTE A VALIDE L ARTICLE BLABLA'),
(3, '2014-10-20', 'MESSAGE', 'HUGUETTE A CONTACTE FRANCIS'),
(4, '2015-02-22', 'MESSAGE', 'Damien Nicolas a contact&eacute; Damien Nicolas. '),
(5, '2015-02-22', 'MESSAGE', 'Damien Nicolas a contact&eacute; Damien Nicolas. '),
(6, '2015-02-23', 'MESSAGE', 'Damien Nicolas a contact&eacute; Damien Nicolas. '),
(7, '2015-02-23', 'MESSAGE', 'Damien Nicolas a contact&eacute; DupontA HuguetteA. '),
(8, '2015-02-25', 'MESSAGE', 'Damien Nicolas a contact&eacute; Damien Nicolas. '),
(9, '2015-02-25', 'MESSAGE', 'Damien Nicolas a contact&eacute; Damien Nicolas. '),
(10, '2015-02-25', 'MESSAGE', 'ADMIN FRANCK a contact&eacute; MEMBRE FRANCK. '),
(11, '2015-02-25', 'MESSAGE', 'ADMIN FRANCK a contact&eacute; ADMIN FRANCK. '),
(12, '2015-02-25', 'MESSAGE', 'MEMBRE FRANCK a contact&eacute; SADMIN ARNAUD. '),
(13, '2015-02-25', 'MESSAGE', 'SADMIN FRANCK a contact&eacute; ADMIN VINCENT. '),
(14, '2015-02-25', 'ALERTE', 'SADMIN VINCENT a échoué 3 fois à se connecter (IP : 147.94.134.31).'),
(15, '2015-03-11', 'ALERTE', 'MEMBRE VINCENT a échoué 3 fois à se connecter (IP : 147.94.134.31).'),
(16, '2015-03-11', 'ALERTE', 'MEMBRE VINCENT a échoué 5 fois à se connecter, son compte a été bloqué (IP : 147.94.134.31).'),
(17, '2015-03-11', 'MESSAGE', 'MEMBRE VINCENT a contact&eacute; SADMIN ARNAUD. '),
(18, '2015-03-11', 'MESSAGE', 'MEMBRE VINCENT a contact&eacute; SADMIN ARNAUD. '),
(19, '2015-03-11', 'MESSAGE', 'MEMBRE VINCENT a contact&eacute; SADMIN ARNAUD. '),
(20, '2015-03-11', 'MESSAGE', 'ADMIN VINCENT a contact&eacute; ADMIN FRANCK. '),
(21, '2015-03-11', 'MESSAGE', 'ADMIN VINCENT a contact&eacute; SADMIN ARNAUD. '),
(22, '2015-03-11', 'MESSAGE', 'ADMIN VINCENT a contact&eacute; SADMIN VINCENT. '),
(23, '2015-03-11', 'MESSAGE', 'ADMIN VINCENT a contact&eacute; SADMIN FRANCK. '),
(24, '2015-03-11', 'MESSAGE', 'ADMIN FRANCK a contact&eacute; ADMIN VINCENT. '),
(25, '2015-03-11', 'MESSAGE', 'ADMIN VINCENT a contact&eacute; SADMIN VINCENT. '),
(26, '2015-03-11', 'MESSAGE', 'Damien Nicolas a contact&eacute; SADMIN VINCENT. '),
(27, '2015-03-11', 'MESSAGE', 'SADMIN ARNAUD a contact&eacute; SADMIN VINCENT. '),
(28, '2015-03-11', 'MESSAGE', 'SADMIN ARNAUD a contact&eacute; SADMIN VINCENT. '),
(29, '2015-03-11', 'MESSAGE', 'Damien Nicolas a contact&eacute; SADMIN ARNAUD. '),
(30, '2015-03-11', 'MESSAGE', 'SADMIN ARNAUD a contact&eacute; MEMBRE ARNAUD. '),
(31, '2015-03-11', 'MESSAGE', 'SADMIN ARNAUD a contact&eacute; MEMBRE ARNAUD. '),
(32, '2015-03-11', 'ALERTE', 'Damien Nicolas a échoué 3 fois à se connecter (IP : 147.94.134.30).'),
(33, '2015-03-11', 'MESSAGE', 'Damien Nicolas a contact&eacute; SADMIN ARNAUD. '),
(34, '2015-03-11', 'MESSAGE', 'Damien Nicolas a contact&eacute; SADMIN ARNAUD. '),
(35, '2015-03-11', 'MESSAGE', 'Damien Nicolas a contact&eacute; SADMIN ARNAUD. '),
(36, '2015-03-11', 'MESSAGE', 'ADMIN VINCENT a contact&eacute; SADMIN FRANCK. '),
(37, '2015-03-11', 'MESSAGE', 'Damien Nicolas a contact&eacute; Damien Nicolas. ');

-- --------------------------------------------------------

--
-- Structure de la table `TERRITORY`
--

CREATE TABLE IF NOT EXISTS `TERRITORY` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `TERRITORY`
--

INSERT INTO `TERRITORY` (`ID`, `NAME`) VALUES
(1, 'Vall&eacute;e du Rh&ocirc;ne'),
(2, 'Vall&eacute;e de l''Huveaune'),
(3, 'Les Alpilles'),
(4, 'Etang de Berre, Fos-sur-Mer'),
(5, 'M&eacute;tropole Marseille');

-- --------------------------------------------------------

--
-- Structure de la table `THEME`
--

CREATE TABLE IF NOT EXISTS `THEME` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(100) NOT NULL,
  `IMAGEPATH` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `THEME`
--

INSERT INTO `THEME` (`ID`, `NAME`, `IMAGEPATH`) VALUES
(1, 'Transports', 'transport-mobilite-durable.png'),
(2, 'Mission Juridique', 'mission-juridique.png'),
(3, 'Climat, Air, Energie', 'climat-air-energie.png'),
(4, 'Sant&eacute; Environnement', 'sante-et-environnement.png'),
(5, 'Am&eacute;nagement durable du territoire', 'amenagement-durable-urbanisme.png'),
(6, 'Industrie', 'industrie.png'),
(7, 'Eau et milieux naturels', 'eau-milieu-naturel.png'),
(8, 'Agriculture', 'agriculture.png');

-- --------------------------------------------------------

--
-- Structure de la table `USER`
--

CREATE TABLE IF NOT EXISTS `USER` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- Contenu de la table `USER`
--

INSERT INTO `USER` (`ID`, `LOGIN`, `PASSWORD`, `RESET`, `ASSOCIATION_ID`, `THEME_ID`, `THEME_INTEREST_ID`, `THEME_DETAILS`, `ROLE`, `NAME`, `SURNAME`, `MAIL`, `ADRESS`, `CP`, `PROFESSION`, `PROFESSION2`, `PRESENTATION`, `PHOTOPATH`) VALUES
(1, 'nicolas.damien', '81dc9bdb52d04dc20036dbd8313ed055', NULL, 1, NULL, NULL, NULL, 'SADMIN', 'Nicolas', 'Damien', 'nicolas.damien@truc.fr', '33 Somewhere over the rainbow', 13000, 'Directeur', NULL, 0x426f6e6a6f75722021, 'Photos/muselez.jpg'),
(38, '', '', NULL, 52, 1, 1, NULL, 'ADMIN', 'lhomme a abattre', 'terminator', 'vins.fisch@gmail.com', '', 0, '', NULL, NULL, NULL),
(36, '', '', NULL, 15, NULL, NULL, NULL, 'MEMBRE', 'dilan', 'bob', 'tag@ueuk.woodstock.com', '', 0, '', NULL, NULL, NULL),
(37, '', '', NULL, 1, NULL, NULL, NULL, 'MEMBRE', 'ARNAUD', 'SADMIN', 'sm@bondage.Com', '', 69666, 'videur de ballons gonflables', 'marchand de vent', 0x7072656d6965722064c3a973c3a97175696c696272c3a9206d656e74616c20666f6e6374696f6e6e656c20, '../Photos/'),
(34, 'Fletsh', '098f6bcd4621d373cade4e832627b4f6', '', 1, 1, 8, '', 'MEMBRE', 'test15', 'test15', 'f549524@trbvm.com', 'rue du test', 13150, 'Testeur', '', 0x74657374, NULL),
(8, 'vincent.sadmin', 'aa36dc6e81e2ac7ad03e12fedcb6a2c0', '3c73e715f3818d37ddea36e60fc9c398', 1, 1, 2, 'Super Maître', 'SADMIN', 'VINCENT', 'SADMIN', 'vins.fisch@gmail.com', 'SOMEWHERE', 13000, 'TesteurSA', 'Esclave', 0x414243, 'Photos/8626DSC_0041.JPG'),
(9, 'vincent.admin', 'aa36dc6e81e2ac7ad03e12fedcb6a2c0', '3c73e715f3818d37ddea36e60fc9c398', 15, 1, 2, 'Super Maître', 'ADMIN', 'VINCENT', 'ADMIN', 'vins.fisch@gmail.com', 'SOMEWHERE', 13000, 'TesteurA', 'Esclave', 0x414243, 'Photos/kids.jpg'),
(10, 'vincent.membre', 'aa36dc6e81e2ac7ad03e12fedcb6a2c0', '3c73e715f3818d37ddea36e60fc9c398', 1, 1, 2, 'Super Maître', 'MEMBRE', 'VINCENT', 'MEMBRE', 'vins.fisch@gmail.com', 'SOMEWHERE', 13000, 'TesteurM', 'Esclave', 0x414243, '../Photos/nicdam.png'),
(11, 'vincent.validator', 'aa36dc6e81e2ac7ad03e12fedcb6a2c0', '3c73e715f3818d37ddea36e60fc9c398', 1, 1, 2, 'Super Maître', 'VALIDATOR', 'VINCENT', 'VALIDATOR', 'vins.fisch@gmail.com', 'SOMEWHERE', 13000, 'TesteurV', 'Esclave', 0x414243, '../Photos/nicdam.png'),
(12, 'franck.sadmin', 'aa36dc6e81e2ac7ad03e12fedcb6a2c0', '14a1131031ff70fb34ec1128b288efa3', 1, 1, 2, 'Super Maître', 'SADMIN', 'FRANCK', 'SADMIN', 'franck.amofa@gmail.com', 'SOMEWHERE', 13000, 'TesteurSA', 'Esclave', 0x414243, '../Photos/nicdam.png'),
(13, 'franck.admin', 'aa36dc6e81e2ac7ad03e12fedcb6a2c0', '14a1131031ff70fb34ec1128b288efa3', 1, 1, 2, 'Super Maître', 'ADMIN', 'FRANCK', 'ADMIN', 'franck.amofa@gmail.com', 'SOMEWHERE', 13000, 'TesteurA', 'Esclave', 0x414243, '../Photos/nicdam.png'),
(14, 'franck.membre', 'aa36dc6e81e2ac7ad03e12fedcb6a2c0', '14a1131031ff70fb34ec1128b288efa3', 1, 1, 2, 'Super Maître', 'MEMBRE', 'FRANCK', 'MEMBRE', 'franck.amofa@gmail.com', 'SOMEWHERE', 13000, 'TesteurM', 'Esclave', 0x414243, '../Photos/nicdam.png'),
(15, 'franck.validator', 'aa36dc6e81e2ac7ad03e12fedcb6a2c0', '14a1131031ff70fb34ec1128b288efa3', 1, 1, 2, 'Super Maître', 'VALIDATOR', 'FRANCK', 'VALIDATOR', 'franck.amofa@gmail.com', 'SOMEWHERE', 13000, 'TesteurV', 'Esclave', 0x414243, '../Photos/nicdam.png'),
(16, 'arnaud.sadmin', '098f6bcd4621d373cade4e832627b4f6', NULL, 1, 1, 2, 'Super Maître', 'SADMIN', 'ARNAUD', 'SADMIN', 'arnaud.chiffe@gmail.com', 'SOMEWHERE', 13000, 'TesteurSA', 'Esclave', 0x414243, 'Photos/icone_compte.png'),
(17, 'arnaud.admin', 'aa36dc6e81e2ac7ad03e12fedcb6a2c0', NULL, 1, 1, 2, 'Super Maître', 'ADMIN', 'ARNAUD', 'ADMIN', 'arnaud.chiffe@gmail.com', 'SOMEWHERE', 13000, 'TesteurA', 'Esclave', 0x414243, 'Photos/muselez.jpg'),
(18, 'arnaud.membre', 'aa36dc6e81e2ac7ad03e12fedcb6a2c0', NULL, 1, 1, 2, 'Super Maître', 'MEMBRE', 'ARNAUD', 'MEMBRE', 'arnaud.chiffe@gmail.com', 'SOMEWHERE', 13000, 'TesteurM', 'Esclave', 0x414243, 'Photos/taisez.jpg'),
(19, 'arnaud.validator', 'aa36dc6e81e2ac7ad03e12fedcb6a2c0', NULL, 1, NULL, NULL, NULL, 'VALIDATOR', 'ARNAUDi', 'VALIDATORi', 'arnaud.chiffe@gmail.com', 'SOMEWHERE', 30650, 'TesteurV', 'Distributeur de sourires', '', '../Photos/'),
(33, '', '', '14a1131031ff70fb34ec1128b288efa3', 48, NULL, NULL, NULL, 'ADMIN', 'FRANCK', 'AMOFA', 'franck.amofa@gmail.com', '', 84000, 'Directeur', '', '', '../Photos/'),
(35, '', '', NULL, 15, NULL, NULL, NULL, 'MEMBER', 'denver', 'barnabe', 'enjoy@chiale.com', '', 69666, 'congeleur d"enfants ', 'mangeur d''enfant', 0x7369206f6e20766f75732064656d616e64652c20766f757320656e20736176657a207269656e, '../Photos/');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
