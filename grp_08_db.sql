-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 15 Juin 2017 à 15:47
-- Version du serveur :  5.7.18-0ubuntu0.16.04.1
-- Version de PHP :  7.0.18-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `grp_08_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `abbinamento`
--

CREATE TABLE `abbinamento` (
  `cod_prom_abb` varchar(10) NOT NULL,
  `cod_prom` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `aziende`
--

CREATE TABLE `aziende` (
  `P_Iva` varchar(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `logo` varchar(15) DEFAULT NULL,
  `citta` varchar(30) NOT NULL,
  `indirizzo` varchar(50) NOT NULL,
  `descrizione` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `aziende`
--

INSERT INTO `aziende` (`P_Iva`, `nome`, `logo`, `citta`, `indirizzo`, `descrizione`) VALUES
('00000000000', 'Decathlon', 'decathlon.jpg', 'Ancona', 'Piazza Camillo Benso di Cavour, 29, ', 'Negozio di articoli sportivi'),
('00000000001', 'Coop', NULL, 'Milano', 'Piazza Lima', 'Supermercato di articoli alimentari.'),
('00000000002', 'H&M', 'HM.jpg', 'Roma', 'Via Cristoforo Colombo 714', 'Negozio di vestiti'),
('166', 'Niente', NULL, 'Niente2', '54,via niente', 'no lo so'),
('5', 'Pull&Bear', NULL, 'Torino', 'via palombare, 8', 'Azienda di vestiti');

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `catId` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `parId` int(11) NOT NULL,
  `desc` varchar(255) NOT NULL,
  `image` varchar(10) NOT NULL,
  `logo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `category`
--

INSERT INTO `category` (`catId`, `name`, `parId`, `desc`, `image`, `logo`) VALUES
(1, 'Cibo', 0, 'jeoizhb', 'page1.jpg', 'icon3.png'),
(2, 'Abbigliamento', 0, 'gzoirgh', 'page3.jpg', 'icon1.png'),
(3, 'Sport', 0, 'greah', 'page2.jpg', 'icon2.png'),
(4, '3 x 2', 1, '3 x 2', '', ''),
(5, '2 x 1', 1, '2 x 1', '', ''),
(6, ' - 50 %', 1, '50%', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `coupon`
--

CREATE TABLE `coupon` (
  `cod_promozione` int(10) NOT NULL,
  `ID_utente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `coupon`
--

INSERT INTO `coupon` (`cod_promozione`, `ID_utente`) VALUES
(6, 1);

-- --------------------------------------------------------

--
-- Structure de la table `coupon abbinati`
--

CREATE TABLE `coupon abbinati` (
  `ID_utente` int(11) NOT NULL,
  `cod_prom_abb` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `faq`
--

CREATE TABLE `faq` (
  `id_faq` int(11) NOT NULL,
  `domanda` text NOT NULL,
  `risposta` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `faq`
--

INSERT INTO `faq` (`id_faq`, `domanda`, `risposta`) VALUES
(1, 'Come posso cambiare i miei dati?', 'viuabji'),
(2, 'Come ottengo i coupon?', 'Puoi ottenere i coupon solo se sei un utente registrato, dopodichÃ¨ basta selezionare l\'offerta desiderata e cliccare sul bottone "stampa coupon"'),
(3, 'Come utilizzare il mio coupon?', 'Una volta scaricato il coupon basterà stamparlo ed esibirlo presso la sede dell\'azienda\r\n    '),
(4, 'Quali sono le aziende convenzionate?', 'Per vedere l\'elenco delle aziende convenzionate <a href="<?= $this->url(array(\r\n                        \'controller\' => \'user\',\r\n                        \'action\'     => \'aziende\',\r\n                        ), \r\n                        \'default\', true\r\n                    ); \r\n                 ?>">clicca qui</a>'),
(6, 'Quando scade il mio coupon?', 'Il coupon emesso è valido per tutta la durata della promozione'),
(7, 'Come contattarci', 'nella sezione chi siamo, cliccare su "contattaci"');

-- --------------------------------------------------------

--
-- Structure de la table `permessi`
--

CREATE TABLE `permessi` (
  `ID_utente` int(11) NOT NULL,
  `P_Iva` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `prodId` int(11) NOT NULL,
  `name` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `catId` int(15) NOT NULL,
  `descShort` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `descLong` varchar(2500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `price` float NOT NULL,
  `discountPerc` int(11) NOT NULL,
  `discounted` tinyint(4) NOT NULL DEFAULT '0',
  `image` text CHARACTER SET utf8 COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `product`
--

INSERT INTO `product` (`prodId`, `name`, `catId`, `descShort`, `descLong`, `price`, `discountPerc`, `discounted`, `image`) VALUES
(2, 'Pallone', 5, 'Buongiorno', '<p>Sed lacus. Donec lectus. Nullam pretium nibh ut turpis. Nam bibendum. In nulla tortor, elementum vel, tempor at, varius non, purus. Mauris vitae nisl nec metus placerat consectetuer. Donec ipsum. Proin imperdiet est. Phasellus dapibus semper urna. Pellentesque ornare, orci in consectetuer hendrerit, urna elit eleifend nunc, ut consectetuer nisl felis ac diam. Etiam non felis. Donec ut ante. In id eros. Suspendisse lacus turpis, cursus egestas at sem. Phasellus pellentesque. Mauris quam enim, molestie in, rhoncus ut, lobortis a, est. </p><p>Sed lacus. Donec lectus. Nullam pretium nibh ut turpis. Nam bibendum. In nulla tortor, elementum vel, tempor at, varius non, purus. Mauris vitae nisl nec metus placerat consectetuer. Donec ipsum. Proin imperdiet est. Phasellus dapibus semper urna. Pellentesque ornare, orci in consectetuer hendrerit, urna elit eleifend nunc, ut consectetuer nisl felis ac diam. Etiam non felis. Donec ut ante. In id eros. Suspendisse lacus turpis, cursus egestas at sem. Phasellus pellentesque. Mauris quam enim, molestie in, rhoncus ut, lobortis a, est.</p>', 34.5, 12, 0, ''),
(3, 'HardDisk Modello2', 6, 'Caratteristiche HardDisk2', '<p>Sed lacus. Donec lectus. Nullam pretium nibh ut turpis. Nam bibendum. In nulla tortor, elementum vel, tempor at, varius non, purus. Mauris vitae nisl nec metus placerat consectetuer. Donec ipsum. Proin imperdiet est. Phasellus dapibus semper urna. Pellentesque ornare, orci in consectetuer hendrerit, urna elit eleifend nunc, ut consectetuer nisl felis ac diam. Etiam non felis. Donec ut ante. In id eros. Suspendisse lacus turpis, cursus egestas at sem. Phasellus pellentesque. Mauris quam enim, molestie in, rhoncus ut, lobortis a, est. </p><p>Sed lacus. Donec lectus. Nullam pretium nibh ut turpis. Nam bibendum. In nulla tortor, elementum vel, tempor at, varius non, purus. Mauris vitae nisl nec metus placerat consectetuer. Donec ipsum. Proin imperdiet est. Phasellus dapibus semper urna. Pellentesque ornare, orci in consectetuer hendrerit, urna elit eleifend nunc, ut consectetuer nisl felis ac diam. Etiam non felis. Donec ut ante. In id eros. Suspendisse lacus turpis, cursus egestas at sem. Phasellus pellentesque. Mauris quam enim, molestie in, rhoncus ut, lobortis a, est.</p>', 86.37, 15, 1, 'Italy.gif'),
(4, 'Desktop Modello1', 3, 'Caratteristiche Desktop1', '<p>Sed lacus. Donec lectus. Nullam pretium nibh ut turpis. Nam bibendum. In nulla tortor, elementum vel, tempor at, varius non, purus. Mauris vitae nisl nec metus placerat consectetuer. Donec ipsum. Proin imperdiet est. Phasellus dapibus semper urna. Pellentesque ornare, orci in consectetuer hendrerit, urna elit eleifend nunc, ut consectetuer nisl felis ac diam. Etiam non felis. Donec ut ante. In id eros. Suspendisse lacus turpis, cursus egestas at sem. Phasellus pellentesque. Mauris quam enim, molestie in, rhoncus ut, lobortis a, est. </p><p>Sed lacus. Donec lectus. Nullam pretium nibh ut turpis. Nam bibendum. In nulla tortor, elementum vel, tempor at, varius non, purus. Mauris vitae nisl nec metus placerat consectetuer. Donec ipsum. Proin imperdiet est. Phasellus dapibus semper urna. Pellentesque ornare, orci in consectetuer hendrerit, urna elit eleifend nunc, ut consectetuer nisl felis ac diam. Etiam non felis. Donec ut ante. In id eros. Suspendisse lacus turpis, cursus egestas at sem. Phasellus pellentesque. Mauris quam enim, molestie in, rhoncus ut, lobortis a, est.</p>', 1230.49, 25, 1, 'Brazil.gif'),
(5, 'Laptop Modello1', 4, 'Caratteristiche Laptop1', '<p>Sed lacus. Donec lectus. Nullam pretium nibh ut turpis. Nam bibendum. In nulla tortor, elementum vel, tempor at, varius non, purus. Mauris vitae nisl nec metus placerat consectetuer. Donec ipsum. Proin imperdiet est. Phasellus dapibus semper urna. Pellentesque ornare, orci in consectetuer hendrerit, urna elit eleifend nunc, ut consectetuer nisl felis ac diam. Etiam non felis. Donec ut ante. In id eros. Suspendisse lacus turpis, cursus egestas at sem. Phasellus pellentesque. Mauris quam enim, molestie in, rhoncus ut, lobortis a, est. </p><p>Sed lacus. Donec lectus. Nullam pretium nibh ut turpis. Nam bibendum. In nulla tortor, elementum vel, tempor at, varius non, purus. Mauris vitae nisl nec metus placerat consectetuer. Donec ipsum. Proin imperdiet est. Phasellus dapibus semper urna. Pellentesque ornare, orci in consectetuer hendrerit, urna elit eleifend nunc, ut consectetuer nisl felis ac diam. Etiam non felis. Donec ut ante. In id eros. Suspendisse lacus turpis, cursus egestas at sem. Phasellus pellentesque. Mauris quam enim, molestie in, rhoncus ut, lobortis a, est.</p>', 455.37, 17, 1, ''),
(10, 'Laptop Modello2', 4, 'Caratteristiche Laptop2', '<p>Sed lacus. Donec lectus. Nullam pretium nibh ut turpis. Nam bibendum. In nulla tortor, elementum vel, tempor at, varius non, purus. Mauris vitae nisl nec metus placerat consectetuer. Donec ipsum. Proin imperdiet est. Phasellus dapibus semper urna. Pellentesque ornare, orci in consectetuer hendrerit, urna elit eleifend nunc, ut consectetuer nisl felis ac diam. Etiam non felis. Donec ut ante. In id eros. Suspendisse lacus turpis, cursus egestas at sem. Phasellus pellentesque. Mauris quam enim, molestie in, rhoncus ut, lobortis a, est. </p><p>Sed lacus. Donec lectus. Nullam pretium nibh ut turpis. Nam bibendum. In nulla tortor, elementum vel, tempor at, varius non, purus. Mauris vitae nisl nec metus placerat consectetuer. Donec ipsum. Proin imperdiet est. Phasellus dapibus semper urna. Pellentesque ornare, orci in consectetuer hendrerit, urna elit eleifend nunc, ut consectetuer nisl felis ac diam. Etiam non felis. Donec ut ante. In id eros. Suspendisse lacus turpis, cursus egestas at sem. Phasellus pellentesque. Mauris quam enim, molestie in, rhoncus ut, lobortis a, est.</p>', 1889.67, 15, 1, 'Argentina.gif'),
(16, 'NetBook Modello3', 5, 'Caratteristiche NetBook3', '<p>Sed lacus. Donec lectus. Nullam pretium nibh ut turpis. Nam bibendum. In nulla tortor, elementum vel, tempor at, varius non, purus. Mauris vitae nisl nec metus placerat consectetuer. Donec ipsum. Proin imperdiet est. Phasellus dapibus semper urna. Pellentesque ornare, orci in consectetuer hendrerit, urna elit eleifend nunc, ut consectetuer nisl felis ac diam. Etiam non felis. Donec ut ante. In id eros. Suspendisse lacus turpis, cursus egestas at sem. Phasellus pellentesque. Mauris quam enim, molestie in, rhoncus ut, lobortis a, est. </p><p>Sed lacus. Donec lectus. Nullam pretium nibh ut turpis. Nam bibendum. In nulla tortor, elementum vel, tempor at, varius non, purus. Mauris vitae nisl nec metus placerat consectetuer. Donec ipsum. Proin imperdiet est. Phasellus dapibus semper urna. Pellentesque ornare, orci in consectetuer hendrerit, urna elit eleifend nunc, ut consectetuer nisl felis ac diam. Etiam non felis. Donec ut ante. In id eros. Suspendisse lacus turpis, cursus egestas at sem. Phasellus pellentesque. Mauris quam enim, molestie in, rhoncus ut, lobortis a, est.</p>', 259.99, 17, 0, 'Red Apple.gif'),
(18, 'Laptop Modello3', 4, 'Caratteristiche Laptop3', '<p>Sed lacus. Donec lectus. Nullam pretium nibh ut turpis. Nam bibendum. In nulla tortor, elementum vel, tempor at, varius non, purus. Mauris vitae nisl nec metus placerat consectetuer. Donec ipsum. Proin imperdiet est. Phasellus dapibus semper urna. Pellentesque ornare, orci in consectetuer hendrerit, urna elit eleifend nunc, ut consectetuer nisl felis ac diam. Etiam non felis. Donec ut ante. In id eros. Suspendisse lacus turpis, cursus egestas at sem. Phasellus pellentesque. Mauris quam enim, molestie in, rhoncus ut, lobortis a, est. </p><p>Sed lacus. Donec lectus. Nullam pretium nibh ut turpis. Nam bibendum. In nulla tortor, elementum vel, tempor at, varius non, purus. Mauris vitae nisl nec metus placerat consectetuer. Donec ipsum. Proin imperdiet est. Phasellus dapibus semper urna. Pellentesque ornare, orci in consectetuer hendrerit, urna elit eleifend nunc, ut consectetuer nisl felis ac diam. Etiam non felis. Donec ut ante. In id eros. Suspendisse lacus turpis, cursus egestas at sem. Phasellus pellentesque. Mauris quam enim, molestie in, rhoncus ut, lobortis a, est.</p>', 998.99, 23, 1, 'UK.gif'),
(21, 'HardDisk Modello1', 6, 'Caratteristiche HardDisk1', '<p>Sed lacus. Donec lectus. Nullam pretium nibh ut turpis. Nam bibendum. In nulla tortor, elementum vel, tempor at, varius non, purus. Mauris vitae nisl nec metus placerat consectetuer. Donec ipsum. Proin imperdiet est. Phasellus dapibus semper urna. Pellentesque ornare, orci in consectetuer hendrerit, urna elit eleifend nunc, ut consectetuer nisl felis ac diam. Etiam non felis. Donec ut ante. In id eros. Suspendisse lacus turpis, cursus egestas at sem. Phasellus pellentesque. Mauris quam enim, molestie in, rhoncus ut, lobortis a, est. </p><p>Sed lacus. Donec lectus. Nullam pretium nibh ut turpis. Nam bibendum. In nulla tortor, elementum vel, tempor at, varius non, purus. Mauris vitae nisl nec metus placerat consectetuer. Donec ipsum. Proin imperdiet est. Phasellus dapibus semper urna. Pellentesque ornare, orci in consectetuer hendrerit, urna elit eleifend nunc, ut consectetuer nisl felis ac diam. Etiam non felis. Donec ut ante. In id eros. Suspendisse lacus turpis, cursus egestas at sem. Phasellus pellentesque. Mauris quam enim, molestie in, rhoncus ut, lobortis a, est.</p>', 88.93, 5, 0, 'USA.gif'),
(22, 'HardDisk Modello4', 6, 'Caratteristiche Modello4', '<p>Sed lacus. Donec lectus. Nullam pretium nibh ut turpis. Nam bibendum. In nulla tortor, elementum vel, tempor at, varius non, purus. Mauris vitae nisl nec metus placerat consectetuer. Donec ipsum. Proin imperdiet est. Phasellus dapibus semper urna. Pellentesque ornare, orci in consectetuer hendrerit, urna elit eleifend nunc, ut consectetuer nisl felis ac diam. Etiam non felis. Donec ut ante. In id eros. Suspendisse lacus turpis, cursus egestas at sem. Phasellus pellentesque. Mauris quam enim, molestie in, rhoncus ut, lobortis a, est. </p><p>Sed lacus. Donec lectus. Nullam pretium nibh ut turpis. Nam bibendum. In nulla tortor, elementum vel, tempor at, varius non, purus. Mauris vitae nisl nec metus placerat consectetuer. Donec ipsum. Proin imperdiet est. Phasellus dapibus semper urna. Pellentesque ornare, orci in consectetuer hendrerit, urna elit eleifend nunc, ut consectetuer nisl felis ac diam. Etiam non felis. Donec ut ante. In id eros. Suspendisse lacus turpis, cursus egestas at sem. Phasellus pellentesque. Mauris quam enim, molestie in, rhoncus ut, lobortis a, est.</p>', 78.66, 7, 1, 'Ukraine.gif');

-- --------------------------------------------------------

--
-- Structure de la table `promozione`
--

CREATE TABLE `promozione` (
  `cod_promozione` int(11) NOT NULL,
  `tipo_prom` varchar(50) NOT NULL,
  `data_inizio` date NOT NULL,
  `data_fine` date NOT NULL,
  `prodotto` varchar(30) NOT NULL,
  `catId` int(11) NOT NULL,
  `descrizione_prom` text NOT NULL,
  `immagine` varchar(40) DEFAULT NULL,
  `P_Iva` varchar(11) NOT NULL,
  `prezzo_unitario_prod` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `promozione`
--

INSERT INTO `promozione` (`cod_promozione`, `tipo_prom`, `data_inizio`, `data_fine`, `prodotto`, `catId`, `descrizione_prom`, `immagine`, `P_Iva`, `prezzo_unitario_prod`) VALUES
(2, '2', '2017-07-15', '2017-07-30', 'Tshirt', 5, 'maglietta a maniche corte', NULL, '00000000002', 17),
(3, '1', '2017-05-19', '2017-07-14', 'macarons', 4, 'dolcetti francesi', 'bbig7.jpg', '00000000001', 16),
(4, '1', '2017-05-26', '2017-11-08', 'prodotto 4', 2, 'fhjeiozhgm', 'page2_img1.jpg', '00000000001', 12),
(5, '3', '2017-05-10', '2017-07-08', 'prodotto 5', 1, 'higoezhag', 'page2_img3.jpg', '00000000001', 43),
(6, '1', '2017-05-19', '2017-07-14', 'prodotto 3', 5, 'ghreha', 'page1_img6.jpg', '00000000000', 67),
(7, '2', '2017-06-08', '2017-07-01', 'ciaone', 5, 'allora non so che scrivere', 'cover.jpg', '00000000000', 10),
(10, '1', '2017-07-15', '2017-07-30', 'Andrea', 4, 'Andrea', NULL, '00000000001', 1.48),
(15, '1', '1994-08-17', '1995-08-18', 'Patate', 4, 'patate novelle', NULL, '00000000001', 16),
(16, '3', '2017-06-15', '2017-06-22', 'alex', 5, 'alex', 'bbig4.jpg', '00000000000', 9),
(17, '3', '2017-07-09', '2017-07-19', 'Racchetta', 6, 'racchetta', NULL, '00000000000', 5.2),
(18, '3', '2013-05-21', '3017-12-23', 'pallone di calcio', 6, 'per giocare al calcio', NULL, '00000000000', 5),
(19, '1', '2013-05-21', '2019-05-04', 'niente', 4, 'hieao', NULL, '00000000001', 5),
(20, '3', '2017-03-06', '2017-06-05', 'prodotto', 6, 'prodotto che dovete comprare ! ', NULL, '00000000002', 45),
(21, '2', '2017-01-12', '2017-05-13', 'Orolofio', 6, 'orologio per vedere l\'ora', 'vintageowl3.jpg', '00000000002', 34);

-- --------------------------------------------------------

--
-- Structure de la table `promozioni abbinate`
--

CREATE TABLE `promozioni abbinate` (
  `cod_prom_abb` varchar(10) NOT NULL,
  `ult_sconto` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `utente`
--

CREATE TABLE `utente` (
  `ID_utente` int(11) NOT NULL,
  `nome_utente` varchar(15) NOT NULL,
  `cognome` varchar(15) NOT NULL,
  `sesso` char(1) NOT NULL,
  `data_nascita` date NOT NULL,
  `telefono` int(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `role` varchar(15) NOT NULL,
  `citta` varchar(40) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `utente`
--

INSERT INTO `utente` (`ID_utente`, `nome_utente`, `cognome`, `sesso`, `data_nascita`, `telefono`, `email`, `role`, `citta`, `username`, `password`) VALUES
(1, 'utente1', 'utente1', 'm', '1995-08-15', 333221133, 'user@gmail.com', 'user', 'ancona', 'user', 'pass'),
(3, 'Mario', 'Rossi', 'm', '1995-08-15', 333221133, 'mariorossi@gmail.com', 'staff', 'ancona', 'staff', 'staff'),
(4, 'admin', 'admin', 'f', '1987-08-12', 333221133, 'admin@gmail.com', 'admin', 'ancona', 'admin', 'adminpass');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `abbinamento`
--
ALTER TABLE `abbinamento`
  ADD PRIMARY KEY (`cod_prom_abb`,`cod_prom`),
  ADD KEY `cod_prom` (`cod_prom`);

--
-- Index pour la table `aziende`
--
ALTER TABLE `aziende`
  ADD PRIMARY KEY (`P_Iva`);

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`catId`);

--
-- Index pour la table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`cod_promozione`,`ID_utente`),
  ADD KEY `ID_utente` (`ID_utente`);

--
-- Index pour la table `coupon abbinati`
--
ALTER TABLE `coupon abbinati`
  ADD PRIMARY KEY (`ID_utente`,`cod_prom_abb`),
  ADD KEY `cod_prom_abb` (`cod_prom_abb`);

--
-- Index pour la table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id_faq`);

--
-- Index pour la table `permessi`
--
ALTER TABLE `permessi`
  ADD PRIMARY KEY (`ID_utente`,`P_Iva`),
  ADD KEY `P_Iva` (`P_Iva`);

--
-- Index pour la table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`prodId`);

--
-- Index pour la table `promozione`
--
ALTER TABLE `promozione`
  ADD PRIMARY KEY (`cod_promozione`),
  ADD KEY `P_Iva` (`P_Iva`);

--
-- Index pour la table `promozioni abbinate`
--
ALTER TABLE `promozioni abbinate`
  ADD PRIMARY KEY (`cod_prom_abb`);

--
-- Index pour la table `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`ID_utente`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `faq`
--
ALTER TABLE `faq`
  MODIFY `id_faq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `prodId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT pour la table `promozione`
--
ALTER TABLE `promozione`
  MODIFY `cod_promozione` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT pour la table `utente`
--
ALTER TABLE `utente`
  MODIFY `ID_utente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `abbinamento`
--
ALTER TABLE `abbinamento`
  ADD CONSTRAINT `abbinamento_ibfk_1` FOREIGN KEY (`cod_prom_abb`) REFERENCES `promozioni abbinate` (`cod_prom_abb`),
  ADD CONSTRAINT `abbinamento_ibfk_2` FOREIGN KEY (`cod_prom`) REFERENCES `promozione` (`cod_promozione`);

--
-- Contraintes pour la table `coupon`
--
ALTER TABLE `coupon`
  ADD CONSTRAINT `coupon_ibfk_1` FOREIGN KEY (`ID_utente`) REFERENCES `utente` (`ID_utente`),
  ADD CONSTRAINT `coupon_ibfk_2` FOREIGN KEY (`cod_promozione`) REFERENCES `promozione` (`cod_promozione`);

--
-- Contraintes pour la table `coupon abbinati`
--
ALTER TABLE `coupon abbinati`
  ADD CONSTRAINT `coupon abbinati_ibfk_1` FOREIGN KEY (`ID_utente`) REFERENCES `utente` (`ID_utente`),
  ADD CONSTRAINT `coupon abbinati_ibfk_2` FOREIGN KEY (`cod_prom_abb`) REFERENCES `promozioni abbinate` (`cod_prom_abb`);

--
-- Contraintes pour la table `promozione`
--
ALTER TABLE `promozione`
  ADD CONSTRAINT `P_Iva` FOREIGN KEY (`P_Iva`) REFERENCES `aziende` (`P_Iva`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
