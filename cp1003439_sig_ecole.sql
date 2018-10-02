-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 20 Juillet 2018 à 21:01
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `sig_ecole`
--

-- --------------------------------------------------------

--
-- Structure de la table `besoin`
--

CREATE TABLE IF NOT EXISTS `besoin` (
  `id_besoin` int(11) NOT NULL AUTO_INCREMENT,
  `id_type_besoin` int(11) NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `id_session` int(11) NOT NULL,
  `id_etablissement` int(11) NOT NULL,
  PRIMARY KEY (`id_besoin`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `besoin`
--

INSERT INTO `besoin` (`id_besoin`, `id_type_besoin`, `description`, `id_session`, `id_etablissement`) VALUES
(1, 1, 'Manque des tables banc ', 1, 9);

-- --------------------------------------------------------

--
-- Structure de la table `circonscription`
--

CREATE TABLE IF NOT EXISTS `circonscription` (
  `id_circonscription` int(11) NOT NULL AUTO_INCREMENT,
  `nom_circonscription` varchar(100) CHARACTER SET utf8 NOT NULL,
  `responsable_circonscription` text CHARACTER SET utf8 NOT NULL,
  `matricule_responsable` varchar(80) CHARACTER SET utf8 NOT NULL,
  `contact_responsable` varchar(80) CHARACTER SET utf8 NOT NULL,
  `ville_circonscription` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id_circonscription`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Contenu de la table `circonscription`
--

INSERT INTO `circonscription` (`id_circonscription`, `nom_circonscription`, `responsable_circonscription`, `matricule_responsable`, `contact_responsable`, `ville_circonscription`) VALUES
(1, 'ESTUAIRE', 'BISSADI Sosthène', '104313/R', '01720432', ''),
(2, 'LIBREVILLE NORD', 'NDAVOURA GAMBISSA Julienne', '106660/R', '', ''),
(3, 'LIBREVILLE EST', 'MVE AKUE Antoine', '013659/T', '', ''),
(4, 'LIBREVILLE CENTRE', 'MOUSSAVOU MOUSSAVOU', '104347/C', '', ''),
(5, 'LIBREVILLE SUD', 'MOUGUENDI NZEINGUI Marie Claire', '111487/T', '', ''),
(6, 'HAUT OGOOUE NORD', 'MOUSSAGA GABRIEL (INTERIM)', '106568/A', '01693166', ''),
(7, 'HAUT OGOOUE CENTRE', 'POUPY Noel', '104229/M', '01677325', ''),
(8, 'HAUT OGOOUE SUD', 'KOUMESSIAMI Germain Nickez', '105853/A', '01677298', ''),
(9, 'MOYEN OGOOUE', 'KOUMBA ZOLA', '107710/W', '01581174', 'Lambaréné'),
(10, 'NGOUNIE NORD', 'ZENG EYA Jean François', '102 225 h', '01 86 12 26', 'Fougamou'),
(11, 'NGOUNIE CENTRE', 'BAKOUEVAGUI Joseph', '104 320 M', '01986123', 'Mouila'),
(12, 'NGOUNIE SUD', 'BOULINGUI Bruno', '105 325 T', '07968468', 'Mbigou'),
(13, 'NYANGA NORD', 'BOUKA BOUKA Jean Noel', '108 101 R', '01820150', 'Tchibanga'),
(14, 'NYANGA OUEST', 'NGOMA Victor', '106 676 B', '01855227', 'Mayumba'),
(15, 'OGOOUE INVINDO EST', 'EKIBA Philippe', '109 575 L', '07944438', 'Mekambo'),
(16, 'OGOOUE INVINDO CENTRE', 'MAKOUNDI Jean Benoit', '109 466 A', '01903041', 'Makokou'),
(17, 'OGOOUE INVINDO OUEST', 'MOUSSAYI Fernand', '109 575 L', '01930025', 'Booué'),
(18, 'OGOOUE LOLO NORD', 'MOUKAMABI Antoine', '102 258 M', '01640212', 'Lastoursville'),
(19, 'OGOOUE LOLO SUD', 'NZOUSTI Jaques', '105 511 K', '01655044', 'Koulamoutou'),
(20, 'OGOOUE MARITIME', 'ONGONE OBIANG Charly Clement', '108 850 T', '01522279', 'Port Gentil'),
(21, 'WOLEU NTEM NORD', 'BIDZANG Protais', '105 116 X', '01968052', 'Bitam'),
(22, 'WOLEU NTEM NORD-EST', 'MABIKA Alain ', '014855 Y', '07162850', 'Minvoul'),
(23, 'WOLEU NTEM CENTRE', 'MANGONGO Alphonse', '104 238 M', '01986123', 'Oyem'),
(24, 'WOLEU NTEM SUD', 'GNALAMINGANDOU Guillaume', '104 317 M', '07013271', 'Mitzic');

-- --------------------------------------------------------

--
-- Structure de la table `eleve`
--

CREATE TABLE IF NOT EXISTS `eleve` (
  `id_eleve` int(11) NOT NULL AUTO_INCREMENT,
  `place_dispo` varchar(10) CHARACTER SET utf8 NOT NULL,
  `effectif` varchar(10) CHARACTER SET utf8 NOT NULL,
  `admis` varchar(10) CHARACTER SET utf8 NOT NULL,
  `redoublant` varchar(10) CHARACTER SET utf8 NOT NULL,
  `obs` text CHARACTER SET utf8 NOT NULL,
  `id_session` int(11) NOT NULL,
  `id_etablissement` int(11) NOT NULL,
  PRIMARY KEY (`id_eleve`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `eleve`
--

INSERT INTO `eleve` (`id_eleve`, `place_dispo`, `effectif`, `admis`, `redoublant`, `obs`, `id_session`, `id_etablissement`) VALUES
(1, '200', '300', '175', '125', '', 1, 9),
(2, '199', '239', '214', '25', 'satisfaisant ', 4, 3),
(3, '230', '332', '235', '97', 'satisfaisant ', 5, 15);

-- --------------------------------------------------------

--
-- Structure de la table `enseignant`
--

CREATE TABLE IF NOT EXISTS `enseignant` (
  `id_enseignant` int(11) NOT NULL AUTO_INCREMENT,
  `discipline` varchar(100) CHARACTER SET utf8 NOT NULL,
  `homme` varchar(10) CHARACTER SET utf8 NOT NULL,
  `femme` varchar(10) CHARACTER SET utf8 NOT NULL,
  `type_enseignant` varchar(70) CHARACTER SET utf8 NOT NULL,
  `id_session` int(11) NOT NULL,
  `id_etablissement` int(11) NOT NULL,
  `total` varchar(10) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id_enseignant`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `enseignant`
--

INSERT INTO `enseignant` (`id_enseignant`, `discipline`, `homme`, `femme`, `type_enseignant`, `id_session`, `id_etablissement`, `total`) VALUES
(3, 'Mathématiques', '35', '12', 'Expatries', 1, 9, '47'),
(4, 'S.V.T', '50', '24', 'Expatries', 1, 9, '74'),
(5, 'Mathématiques', '12', '2', 'Nationaux', 1, 9, '14'),
(6, 'S.V.T', '10', '1', 'Nationaux', 1, 9, '11'),
(7, 'MAthématiquea', '6', '1', 'Nationaux', 4, 3, '7'),
(8, 'Français', '4', '3', 'Expatries', 4, 3, '7'),
(9, 'Français', '4', '4', 'Nationaux', 5, 15, '8'),
(10, 'Histoire/Géographie', '4', '2', 'Expatries', 5, 15, '6');

-- --------------------------------------------------------

--
-- Structure de la table `etablissement`
--

CREATE TABLE IF NOT EXISTS `etablissement` (
  `id_etablissement` int(11) NOT NULL AUTO_INCREMENT,
  `nom_etablissement` text CHARACTER SET utf8 NOT NULL,
  `type_etablissement` varchar(80) CHARACTER SET utf8 NOT NULL,
  `categorie_etablissement` varchar(80) CHARACTER SET utf8 NOT NULL,
  `dte_creation` varchar(15) CHARACTER SET utf8 NOT NULL,
  `responsable` varchar(80) CHARACTER SET utf8 NOT NULL,
  `num_responsable` varchar(30) CHARACTER SET utf8 NOT NULL,
  `id_circonscription` int(11) NOT NULL,
  `lat_etablissement` varchar(50) CHARACTER SET utf8 NOT NULL,
  `long_etablissement` varchar(50) CHARACTER SET utf8 NOT NULL,
  `id_province` int(11) NOT NULL,
  `ville` varchar(100) CHARACTER SET utf8 NOT NULL,
  `etat_etablissement` varchar(6) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id_etablissement`),
  KEY `fk_etablisseent_circonscription` (`id_circonscription`),
  KEY `fk_etablissement_province` (`id_province`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=86 ;

--
-- Contenu de la table `etablissement`
--

INSERT INTO `etablissement` (`id_etablissement`, `nom_etablissement`, `type_etablissement`, `categorie_etablissement`, `dte_creation`, `responsable`, `num_responsable`, `id_circonscription`, `lat_etablissement`, `long_etablissement`, `id_province`, `ville`, `etat_etablissement`) VALUES
(1, 'Collège BESSIEUX', 'Privés Catholiques', 'SECONDAIRE GENERAL', '', 'MASSALA Joseph', '04646858', 4, '0.4430496660312216', '9.452638549023504', 1, 'Libreville', '1'),
(2, 'Lycée  National  Léon Mba', 'Publics', 'SECONDAIRE GENERAL', '', 'OBORI Jean Baptiste', '', 2, '0.3936125087377196', '9.471177977734442', 1, 'Libreville', '1'),
(3, 'Lycée d’Application Nelson MANDELA', 'Publics', 'SECONDAIRE GENERAL', '', 'ILAGOU MBOUMBA', '01732367', 4, '-0.8805849843155719', '10.82941470312494', 1, 'Libreville', '1'),
(4, 'IMMACULEE  CONCEPTION', 'Privés Catholiques', 'SECONDAIRE GENERAL', '', 'ANGUILE Nadine', '01747678', 2, '-1.0892942614525263', '10.14276919531244', 1, 'Libreville', '1'),
(5, 'Lycée  P. EMANE EYEGHE', 'Publics', 'SECONDAIRE GENERAL', '', 'BOUCKALT Desire', '07818707', 4, '-1.9239591544973909', '13.36725649999994', 1, 'Libreville', '1'),
(6, 'Lycée  J. H. AUBAME EYEGHE', 'Publics', 'SECONDAIRE GENERAL', '', 'MOUGNEVI MBENMBO Odette epse Mbira', '07294407', 4, '-3.3396644565265423', '11.12055239843744', 1, 'libreville', '1'),
(7, 'Lycée BESSIEUX ', 'Privés Catholiques', 'SECONDAIRE GENERAL', '', 'NGUEMA OYANE Celestin', '01743026', 4, '-2.84600133421022', '10.42292056249994', 1, 'Libreville', '1'),
(8, 'Col. N. Dame de QUABEN ', 'Privés Catholiques', 'SECONDAIRE GENERAL', '', 'MEYE M''OBIANG François Xavier', '01444550', 2, '-2.308217698100603', '9.85712466406244', 1, 'Libreville', '1'),
(9, 'CALASANZ ', 'Privés Catholiques', 'SECONDAIRE GENERAL', '', 'Frère NIETO Martin', '01732143', 2, '-1.7812115774958792', '10.41193423437494', 1, 'Libreville', '1'),
(10, 'Lycée BAKOUKOU BA MOUIDY', 'Alliance Chrétienne', 'SECONDAIRE GENERAL', '', 'BAYIHA André G', '01707816', 5, '0.1081498135815897', '11.03266177343744', 1, 'Libreville', '1'),
(11, 'Collège d’AKEBE', 'Evangéliques', 'SECONDAIRE GENERAL', '', 'OYOUNE Paul Christian', '01728400', 4, '-0.02368605902214472', '11.90607485937494', 1, 'Libreville', '1'),
(12, 'Collège NANG ESSONO', 'Evangéliques', 'SECONDAIRE GENERAL', '', 'NGUEMA Francis', '01772215', 3, '-0.221439414669793', '12.05439028906244', 1, 'Libreville', '1'),
(13, 'L. Mohamed ARISSANI', 'Islamique', 'SECONDAIRE GENERAL', '', 'ILONGO ADAMOU landry', '07913791', 3, '-0.6498928266759089', '10.28009829687494', 1, 'Libreville', '1'),
(14, 'Lycée E. M. AMOGHO(FRANCEVILLE)', 'Publics', 'SECONDAIRE GENERAL', '', 'NDJOGHO COGNOT Christian', '01677208', 7, '-1.221103374644226', '10.60419497656244', 2, 'Franceville', '1'),
(15, 'Lycée d’EXCELLENCE(FRANCEVILLE)', 'Publics', 'SECONDAIRE GENERAL', '', 'ETELE Justin', '04146562', 7, '-1.836115849034627', '11.08210024999994', 2, 'Franceville', '1'),
(16, 'Lycée  R LANDJI(MOANDA)', 'Publics', 'SECONDAIRE GENERAL', '', 'ABISSAYE Jean prierre', '01661122', 6, '-2.4070109430699826', '11.34027896093744', 2, 'Moanda', '1'),
(17, 'Lycée  H. SYLVOZ(MOANDA)', 'Publics', 'SECONDAIRE GENERAL', '', 'DUMAIT eric', '01661112', 6, '-1.8690576056310546', '11.95002017187494', 2, 'Moanda', '1'),
(19, 'Lycée Luc OKENKALI', 'Publics', 'SECONDAIRE GENERAL', '', 'OTOULOUMOUNGOYE Patrick', '07779506', 6, '', '', 2, 'Okondja', '1'),
(20, 'lycée Toussaint PITTY', 'Publics', 'SECONDAIRE GENERAL', '', 'NENANGOYI Galbert', '01696085', 8, '', '', 2, 'Akieni', '1'),
(21, 'CES MAMADOU LEWO', 'Publics', 'SECONDAIRE GENERAL', '', 'LEKOIMBA Bernadette Epse ETELE', '01677175', 7, '', '', 2, 'Franceville', '1'),
(22, 'CES Lucien KOUNA', 'Publics', 'SECONDAIRE GENERAL', '', 'TSIENEMONI Gabin', '01606395', 17, '', '', 2, 'BONGOVILLE', '1'),
(23, 'CES KAKOGHO', 'Publics', 'SECONDAIRE GENERAL', '', 'NZENGUI Christian', '01969014', 8, '', '', 2, 'Leconi', '1'),
(24, 'CES Eugène MICKOTO', 'Publics', 'SECONDAIRE GENERAL', '', 'MVOU Jean Luc ', '06327238', 7, '', '', 2, 'Ngouoni', '1'),
(25, 'Lycée et collège ST Dominique', 'Privés Catholiques', 'SECONDAIRE GENERAL', '', 'MBOMA Martin', '06033816', 6, '', '', 2, 'Moanda', '1'),
(26, 'Collège Jean Jérome ADAM', 'Privés Catholiques', 'SECONDAIRE GENERAL', '', 'BIVIGOU Bruno', '06217849', 6, '', '', 2, 'Franceville', '1'),
(27, 'Lycée BAKOUKOU BA MOUIDY', 'Alliance Chrétienne', 'PRE-PRIMAIRE', '', 'BAYIHA André G', '07504081', 5, '', '', 1, 'Libreville', '1'),
(28, 'Lycée  Évangélique NANG  ESSONO', 'Evangéliques', 'PRE-PRIMAIRE', '', 'NGUEMA Francis', '01772215', 0, '', '', 0, 'Libreville', '1'),
(29, 'Lycée Évangélique d''AKEBE ', 'Evangéliques', 'SECONDAIRE GENERAL', '', 'OYOUNE Paul Christian', '0177728400', 4, '', '', 0, 'Libreville', '1'),
(30, 'Lycée MOHAMED ARISSANI', 'Islamique', 'SECONDAIRE GENERAL', '', 'ILONGO ADAMOU landry', '07913791', 4, '', '', 0, 'Libreville', '1'),
(31, 'Lycée DJOUE DABANY', 'Laïc', 'SECONDAIRE TECHNIQUE', '', 'NGUEMA ONDO Guy', '01744410', 3, '', '', 1, 'Libreville', '1'),
(32, 'Lycée MBELE', 'Laïc', 'SECONDAIRE GENERAL', '', 'MOUROM TSEVA Larissa MBELE', '04817479', 4, '', '', 1, 'Libreville', '1'),
(33, 'Col. NTCHORERE', 'Laïc', 'SECONDAIRE GENERAL', '', 'MAKAYA Hilaire', '03040596', 2, '', '', 1, 'Libreville', '1'),
(34, 'Lycée Rsoe MASSOMBO ', 'Alliance Chrétienne', 'SECONDAIRE GENERAL', '', 'MUNGALA MUSOSO Laurent Claude', '07312474', 6, '', '', 2, 'Moanda', '1'),
(35, 'Col. Evangélique  ', 'Alliance Chrétienne', 'SECONDAIRE GENERAL', '', 'AZIAGBE KOSSI Johnson', '04331033', 7, '', '', 0, 'Franceville', '1'),
(36, 'I . A . E . S', 'Laïc', 'SECONDAIRE GENERAL', '', 'TRAORE Theophile', '04331033', 7, '', '', 2, 'Franceville', '1'),
(37, 'lycée Charles MEFANE', 'Publics', 'SECONDAIRE GENERAL', '', 'MOUKETOU MOUKETOU Yves Landry', '07537732', 9, '', '', 3, 'Lambaréné', '1'),
(38, 'CES Aubin MOUDJEKOU', 'Publics', 'SECONDAIRE GENERAL', '', 'ELEGE Sophie Sylvie ', '07162335', 9, '', '', 3, 'Lambaréné', '1'),
(39, 'Col. ADIWA', 'Privés Catholiques', 'SECONDAIRE GENERAL', '', 'ENGOANGA OBAME Jean Philippe', '04183762', 9, '', '', 3, 'Lambaréné', '1'),
(40, 'Col. FANGUINOVENI', 'Evangéliques', 'SECONDAIRE GENERAL', '', 'NGUEMA CYr Landry', '07676609', 9, '', '', 3, 'Lambaréné', '1'),
(41, 'Lycée Paul Marie YEMBIT(NDENDE)', 'Publics', 'SECONDAIRE GENERAL', '', 'MBOUMBA', '07486515', 12, '', '', 4, 'Ndéndé', '1'),
(42, 'lycée Jean Jaques BOUCAVEL', 'Publics', 'SECONDAIRE GENERAL', '', 'DIKONGO Daniel', '01861802', 11, '', '', 4, 'Mouila', '1'),
(43, 'Lycée de L''EXCELLENCE', 'Publics', 'SECONDAIRE GENERAL', '', 'MAMADOU ', '01862262', 11, '', '', 4, 'Mouila', '1'),
(44, 'Lycée Didier ROGUET', 'Publics', 'SECONDAIRE GENERAL', '', 'NDINGA MAYOMBO Maurice Ulrich', '07613649', 10, '', '', 4, 'Fougamou', '1'),
(45, 'Lycée A. MOUNDOUNGOU MBARY', 'Publics', 'SECONDAIRE GENERAL', '', 'MBADINGA Jean Amour', '07532036', 12, '', '', 4, 'Mimongo', '1'),
(46, 'Col. St Gabriel', 'Privés Catholiques', 'SECONDAIRE GENERAL', '', 'NDOUNGA TSIENDI', '07293079', 11, '', '', 4, 'Mouila', '1'),
(47, 'Col. St Félicien', 'Privés Catholiques', 'SECONDAIRE GENERAL', '', 'MATSENGUE Anselme charles', '07527510', 12, '', '', 4, 'Dibwangui', '1'),
(48, 'Lycée All.Ch. Pal NDOBA', 'Evangéliques', 'SECONDAIRE GENERAL', '', 'MANGAKA Aristide Lié', '06926675', 12, '', '', 4, 'Lebamba', '1'),
(49, 'Col. la vision', 'Laïc', 'SECONDAIRE GENERAL', '', 'BOUSSOUGOU Herve', '04500431', 11, '', '', 4, 'Mbigou', '1'),
(50, 'Lycée G.N. BOULINGUI', 'Publics', 'SECONDAIRE GENERAL', '', 'DEMOUSSA Angèle', '01820016', 13, '', '', 7, 'Tchibanga', '1'),
(51, 'Lycée J.B. MOANDAT', 'Publics', 'PRIMAIRE', '', 'LAKISSI MAKOSSO Rene', '01835129', 14, '', '', 7, 'mayumba', '1'),
(52, 'Lycée E. MOSSOT ', 'Publics', 'SECONDAIRE GENERAL', '', 'NGUEMBI Jean Roger', '07796224', 13, '', '', 7, 'Moabi', '1'),
(53, 'Col. ESSIA NSOMORE ', 'Privés Catholiques', 'SECONDAIRE GENERAL', '', 'TSALOU MOUVIOSSI serge P', '01903272', 16, '', '', 8, 'Makokou', '1'),
(54, 'Col. HORIZON', 'Privés Catholiques', 'SECONDAIRE GENERAL', '', 'MBOUMBA KOUMBA Junoir', '04427385', 13, '', '', 7, 'Tchibanga', '1'),
(55, 'Col. Jean Paul MBADINGA', 'Alliance Chrétienne', 'SECONDAIRE GENERAL', '', 'MOUDOUMA KOUMBA', '06257554', 14, '', '', 7, 'Tchibanga', '1'),
(56, 'Lycée A. SAMBAT', 'Publics', 'SECONDAIRE GENERAL', '', 'IKOUAKANGOYE Jean de Dieu', '01903162', 16, '', '', 8, 'Makokou', '1'),
(57, 'Lycée Daniel KOSS', 'Publics', 'SECONDAIRE GENERAL', '', 'MOTOBOBE MAZONDE', '01930133', 15, '', '', 8, 'Booué', '1'),
(58, 'Col. N.D. des VICTOIRES', 'Publics', 'SECONDAIRE GENERAL', '', 'NZE BITA Gervais', '06768127', 16, '', '', 8, 'Makokou', '1'),
(59, 'Lycée Stanislas MIGOLET', 'Publics', 'SECONDAIRE GENERAL', '', 'MBADJI NGUIMIONY Thierry Mesmin', '07438916', 18, '', '', 9, 'Koulamoutou-', '1'),
(60, 'Lycée J.A BOUGUENZA ', 'Publics', 'SECONDAIRE GENERAL', '', 'BOUKALA Dieudonné', '01640037', 19, '', '', 9, 'lastoursville', '1'),
(61, 'Lycée C MOUKODOUM ITTHA', 'Publics', 'SECONDAIRE GENERAL', '', 'NDOUNGOU Florentin', '06065597', 19, '', '', 9, 'Pana', '1'),
(62, 'Col. S-Pierre BAMBORO', 'Privés Catholiques', 'SECONDAIRE GENERAL', '', 'MAPAGA Adrien', '017501077', 19, '', '', 9, 'lastoursville', '1'),
(63, 'Col. N.D SALETTE', 'Privés Catholiques', 'SECONDAIRE GENERAL', '', 'LENDAMBA Laurent', '07440105', 18, '', '', 9, 'Koulamoutou', '1'),
(64, 'Lycée All.Chr. DAVID MIKOMBO', 'Alliance Chrétienne', 'SECONDAIRE GENERAL', '', 'MUNGALA MUSOSU Laurent Claude', '06361116', 19, '', '', 9, 'Koulamoutou', '1'),
(65, 'Col. MOUTOUMANBOU', 'Laïc', 'SECONDAIRE TECHNIQUE', '', 'ITSOGA BANGUEBE Bienvenu', '07840470', 18, '', '', 9, 'Koulamoutou', '1'),
(66, 'Lycée SC. T. Paul KOUYA', 'Laïc', 'SECONDAIRE TECHNIQUE', '', 'Y SAVANE AMADOU', '07946383', 18, '', '', 9, '07946383', '1'),
(67, 'Lycée AMBOUROUET AVARO', 'Publics', 'SECONDAIRE GENERAL', '', 'ONANGA OSSOUNDA Pierre', '', 20, '', '', 10, 'Port-Gentil', '1'),
(68, 'Lycée T BATSANTSA', 'Publics', 'SECONDAIRE GENERAL', '', 'OSSAVU WEZER-OLAGOT Liv', '06212529', 20, '', '', 10, 'Port-Gentil', '1'),
(69, 'Lycée Roger GOUTEYRON', 'Publics', 'SECONDAIRE GENERAL', '', 'REKOUNGOUNA Charles', '07778051', 20, '', '', 10, 'Port-Gentil', '1'),
(70, 'CES BAC AVIATION ', 'Publics', 'SECONDAIRE GENERAL', '', 'MOUKAGA Maurice', '07399845', 20, '', '', 10, 'Port-Gentil', '1'),
(71, 'Col. RAPONDA WALKER ', 'Privés Catholiques', 'SECONDAIRE GENERAL', '', 'BOUSSOUGOU BOUASSA', '01553087', 20, '', '', 10, 'Port-Gentil', '1'),
(72, 'Col.DELTA', 'Laïc', 'SECONDAIRE GENERAL', '', 'METE BOBE', '07361968', 20, '', '', 10, 'Port-Gentil', '1'),
(73, 'Lycée Evangélique OGOULA MBEYE', 'Evangéliques', 'SECONDAIRE GENERAL', '', 'KEITA Thierno Hassane', '01531975', 20, '', '', 10, 'Port-Gentil', '1'),
(74, 'Lycée Richard NGUEMA BEKALE', 'Publics', 'SECONDAIRE GENERAL', '', 'ALONE EVINA omer', '01986288', 21, '', '', 11, 'Oyem', '1'),
(75, 'Lycée S. OYONO ABA''A', 'Publics', 'SECONDAIRE GENERAL', '', 'MEZUI AKUE Kisito', '07390918', 23, '', '', 11, 'Bitam', '1'),
(76, 'Lycée M. NKOGHE MVE ', 'Publics', 'SECONDAIRE GENERAL', '', 'NTSAME ETOUGHE Michelle Flore', '07338034', 22, '', '', 11, 'Mitzic', '1'),
(77, 'Lycée ASSOGHO EYEME ', 'Publics', 'SECONDAIRE GENERAL', '', 'NGOUA MBA Nestor', '07126124', 21, '', '', 11, 'Oyem', '1'),
(78, 'lycée A. OBAME NDONG', 'Publics', 'SECONDAIRE GENERAL', '', 'ABANE KASSA Alain Paul', '07334343', 24, '', '', 11, 'Medouneu', '1'),
(79, 'Lycée MGR François NDONG', 'Privés Catholiques', 'SECONDAIRE GENERAL', '', 'NTSAME MVE Brigitte', '07512100', 21, '', '', 11, 'Oyem', '1'),
(80, 'Col. St Joseph', 'Privés Catholiques', 'SECONDAIRE GENERAL', '', 'OBOU''OU EYENGA Paulin', '04731537', 22, '', '', 11, 'Mitzic', '1'),
(81, 'Col. St Jean', 'Privés Catholiques', 'SECONDAIRE GENERAL', '', 'MBA MOTO Jean Baptiste', '02866196', 24, '', '', 11, 'Minvoul', '1'),
(82, 'Col. Marie NKONE', 'Evangéliques', 'SECONDAIRE GENERAL', '', 'MVONE MBA Jean Faustin', '04448282', 21, '', '', 11, 'Oyem', '1'),
(83, 'Col. EDZANG NKULU', 'Evangéliques', 'SECONDAIRE GENERAL', '', 'MEGNE Luc Constant', '07057560', 23, '', '', 11, 'Bitam', '1'),
(84, 'Lycée All.Chr  Martin EFFA NDONG ', 'Alliance Chrétienne', 'SECONDAIRE GENERAL', '', 'MAYOSSA Mexan', '07539314', 21, '', '', 11, 'Oyem', '1'),
(85, 'Col. ONDO et Fils', 'Laïc', 'SECONDAIRE GENERAL', '', 'SIDIBE AMADOU Yaro', '07383091', 21, '', '', 11, 'Oyem', '1');

-- --------------------------------------------------------

--
-- Structure de la table `province`
--

CREATE TABLE IF NOT EXISTS `province` (
  `id_province` int(11) NOT NULL AUTO_INCREMENT,
  `code_province` varchar(15) CHARACTER SET utf8 NOT NULL,
  `nom_province` varchar(80) CHARACTER SET utf8 NOT NULL,
  `lat_province` varchar(30) CHARACTER SET utf8 NOT NULL,
  `long_province` varchar(30) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id_province`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `province`
--

INSERT INTO `province` (`id_province`, `code_province`, `nom_province`, `lat_province`, `long_province`) VALUES
(1, 'G1', 'ESTUAIRE', '0.3648778', '9.480259100000012'),
(2, 'G2', 'HAUT-OGOOUE', '-1.4762544', '13.914399000000003'),
(3, 'G3', 'MOYEN-OGOOUE', '-0.442784', '10.439656000000014'),
(4, 'G4', 'NGOUNIE', '-1.4930303', '10.980700299999967'),
(7, 'G5', 'NYANGA', '-2.8821033', '11.161735599999929'),
(8, 'G6', 'OGOOUE-IVINDO', '0.8818310999999999', '13.174034799999959'),
(9, 'G7', 'OGOOUE-LOLO', '-0.8844092999999998', '12.438058100000035'),
(10, 'G8', 'OGOOUE-MARITIME', '-1.3465975', '9.723267299999975'),
(11, 'G9', 'WOLEU-NTEM', '1.4892408', '11.70682940000006');

-- --------------------------------------------------------

--
-- Structure de la table `session`
--

CREATE TABLE IF NOT EXISTS `session` (
  `id_session` int(11) NOT NULL AUTO_INCREMENT,
  `annee_session` varchar(20) CHARACTER SET utf8 NOT NULL,
  `id_etablissement` int(11) NOT NULL,
  PRIMARY KEY (`id_session`),
  KEY `fk_session_etablissement` (`id_etablissement`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `session`
--

INSERT INTO `session` (`id_session`, `annee_session`, `id_etablissement`) VALUES
(1, '2018', 9),
(3, '2017', 9),
(4, '2016', 3),
(5, '2016', 15);

-- --------------------------------------------------------

--
-- Structure de la table `type_besoin`
--

CREATE TABLE IF NOT EXISTS `type_besoin` (
  `id_type_besoin` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id_type_besoin`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `type_besoin`
--

INSERT INTO `type_besoin` (`id_type_besoin`, `libelle`) VALUES
(1, 'Table banc'),
(2, 'Enseignant');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_users` int(11) NOT NULL AUTO_INCREMENT,
  `nom_users` varchar(200) CHARACTER SET utf8 NOT NULL,
  `prenom_users` varchar(200) CHARACTER SET utf8 NOT NULL,
  `profil` varchar(70) CHARACTER SET utf8 NOT NULL,
  `login` varchar(70) CHARACTER SET utf8 NOT NULL,
  `pwd` varchar(220) CHARACTER SET utf8 NOT NULL,
  `permission` varchar(80) CHARACTER SET utf8 NOT NULL,
  `etat_users` varchar(6) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id_users`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id_users`, `nom_users`, `prenom_users`, `profil`, `login`, `pwd`, `permission`, `etat_users`) VALUES
(1, 'POUTSI', 'Arsène', 'Administrateur', 'arsenepoutsi', 'f17cbe87beef7e360853efdd4e95106c', '5', '1'),
(2, 'MALEO MAYEKO', 'Regis Sidney', 'Statisticien', 'regis', 'fee5a5851188651cfd0aeef9a9b7f1a1', '5', '1'),
(3, 'NKOMBO', 'Mauricel Josel', 'Décideur', 'josel', '148a2aa5e4d62c3cc5fcceec824ba54b', '5', '1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
