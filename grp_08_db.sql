-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2017 at 06:10 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `grp_08_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `abbinamento`
--

CREATE TABLE `abbinamento` (
  `cod_prom_abb` varchar(10) NOT NULL,
  `cod_prom` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `aziende`
--

CREATE TABLE `aziende` (
  `P_Iva` varchar(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `logo` varchar(15) NOT NULL,
  `citta` varchar(30) NOT NULL,
  `indirizzo` varchar(50) NOT NULL,
  `tipologia` varchar(10) NOT NULL,
  `descrizione` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aziende`
--

INSERT INTO `aziende` (`P_Iva`, `nome`, `logo`, `citta`, `indirizzo`, `tipologia`, `descrizione`) VALUES
('00000000000', 'Decathlon', 'decathlon.jpg', 'Ancona', 'Piazza Camillo Benso di Cavour, 29, ', 'sport', 'Negozio di articoli sportivi'),
('00000000001', 'Coop', 'coop.jpg', 'Milano', 'Piazza Lima', 'cibo', 'Supermercato di articoli alimentari.'),
('00000000002', 'H&M', 'HM.jpg', 'Roma', 'Via Cristoforo Colombo 714', 'vestiti', 'Negozio di vestiti'),
('5', 'Pull&Bear', 'pullandbear.jpg', 'Torino', 'via palombare, 8', 'vestiti', 'ghrzjiohabriahgù');

-- --------------------------------------------------------

--
-- Table structure for table `category`
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
-- Dumping data for table `category`
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
-- Table structure for table `coupon`
--

CREATE TABLE `coupon` (
  `cod_promozione` int(10) NOT NULL,
  `ID_utente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `coupon abbinati`
--

CREATE TABLE `coupon abbinati` (
  `ID_utente` int(11) NOT NULL,
  `cod_prom_abb` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id_faq` int(11) NOT NULL,
  `domanda` text NOT NULL,
  `risposta` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id_faq`, `domanda`, `risposta`) VALUES
(1, 'Come posso cambiare i miei dati?', 'viuabji'),
(2, 'Come ottengo i coupon?', 'Puoi ottenere i coupon solo se sei un utente registrato, dopodichÃ¨ basta selezionare l\'offerta desiderata e cliccare sul bottone \"stampa coupon\"'),
(3, 'Come utilizzare il mio coupon?', 'Una volta scaricato il coupon basterà stamparlo ed esibirlo presso la sede dell\'azienda\r\n    '),
(4, 'Quali sono le aziende convenzionate?', 'Per vedere l\'elenco delle aziende convenzionate <a href=\"<?= $this->url(array(\r\n                        \'controller\' => \'user\',\r\n                        \'action\'     => \'aziende\',\r\n                        ), \r\n                        \'default\', true\r\n                    ); \r\n                 ?>\">clicca qui</a>'),
(6, 'Quando scade il mio coupon?', 'Il coupon emesso è valido per tutta la durata della promozione'),
(7, 'Come contattarci', 'nella sezione chi siamo, cliccare su \"contattaci\"');

-- --------------------------------------------------------

--
-- Table structure for table `permessi`
--

CREATE TABLE `permessi` (
  `ID_utente` int(11) NOT NULL,
  `P_Iva` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `permessi`
--

INSERT INTO `permessi` (`ID_utente`, `P_Iva`) VALUES
(3, '00000000000'),
(3, '00000000001'),
(5, '00000000002');

-- --------------------------------------------------------

--
-- Table structure for table `product`
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
-- Dumping data for table `product`
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
-- Table structure for table `promozione`
--

CREATE TABLE `promozione` (
  `cod_promozione` int(11) NOT NULL,
  `tipo_prom` varchar(50) NOT NULL,
  `data_inizio` date NOT NULL,
  `data_fine` date NOT NULL,
  `prodotto` varchar(30) NOT NULL,
  `catId` int(11) NOT NULL,
  `descrizione_prom` text NOT NULL,
  `parole chiave` text NOT NULL,
  `immagine` varchar(40) DEFAULT NULL,
  `P_Iva` varchar(11) NOT NULL,
  `prezzo_unitario_prod` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promozione`
--

INSERT INTO `promozione` (`cod_promozione`, `tipo_prom`, `data_inizio`, `data_fine`, `prodotto`, `catId`, `descrizione_prom`, `parole chiave`, `immagine`, `P_Iva`, `prezzo_unitario_prod`) VALUES
(2, '2', '2017-07-15', '2017-07-30', 'Tshirt', 6, 'maglietta a maniche corte', 'tshirt, T-shirt, maglia, maglietta, maniche', 'tshirt.jpg', '00000000002', 16),
(3, '1', '2017-05-19', '2017-07-14', 'macarons', 4, 'dolcetti francesi', 'ugez_ohoa', 'bbig7.jpg', '00000000001', 16),
(4, '1', '2017-05-26', '2017-11-08', 'prodotto 4', 2, 'fhjeiozhgm', 'grzjioh', 'page2_img1.jpg', '00000000001', 12),
(5, '3', '2017-05-10', '2017-07-08', 'prodotto 5', 1, 'higoezhag', 'ngjezabg', 'page2_img3.jpg', '00000000001', 43),
(6, '1', '2017-05-19', '2017-07-14', 'prodotto 3', 5, 'ghreha', 'ugez_ohoa', 'page1_img6.jpg', '00000000000', 67),
(7, '2', '2017-06-08', '2017-07-01', 'ciaone', 5, 'allora non so che scrivere', '', 'cover.jpg', '00000000000', 10),
(8, '2', '2017-06-08', '2017-08-08', 'promo333', 6, 'idhofhdÃ²sf', '', 'cover.jpg', '00000000001', 34),
(10, '1', '2017-07-15', '2017-07-30', 'Andrea', 4, 'Andrea', '', NULL, '00000000001', 1.48),
(15, '1', '1994-08-17', '1995-08-18', 'Patate', 4, 'patate novelle', '', NULL, '00000000001', 16),
(16, '3', '2017-06-15', '2017-06-22', 'alex', 5, 'alex', '', 'bbig4.jpg', '00000000000', 9),
(17, '3', '2017-07-09', '2017-07-19', 'Racchetta', 6, 'racchetta', '', NULL, '00000000000', 5.2);

-- --------------------------------------------------------

--
-- Table structure for table `promozioni abbinate`
--

CREATE TABLE `promozioni abbinate` (
  `cod_prom_abb` varchar(10) NOT NULL,
  `ult_sconto` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `utente`
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
-- Dumping data for table `utente`
--

INSERT INTO `utente` (`ID_utente`, `nome_utente`, `cognome`, `sesso`, `data_nascita`, `telefono`, `email`, `role`, `citta`, `username`, `password`) VALUES
(1, 'utente1', 'utente145', 'm', '1995-08-15', 333221133, 'user@gmail.com', 'user', 'ancona', 'user', 'pass'),
(3, 'Mario', 'Rossi', 'f', '1995-08-15', 333221133, 'mariorossi@gmail.com', 'staff', 'ancona', 'staff', 'staff'),
(4, 'admin', 'admin', 'f', '1987-08-12', 333221133, 'admin@gmail.com', 'admin', 'ancona', 'admin', 'adminpass'),
(5, 'valentina', 'amandonico', 'f', '1998-03-16', 33345323, 'staff@gmail.com', 'staff', 'ancona', 'valestaff', 'psss');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abbinamento`
--
ALTER TABLE `abbinamento`
  ADD PRIMARY KEY (`cod_prom_abb`,`cod_prom`),
  ADD KEY `cod_prom` (`cod_prom`);

--
-- Indexes for table `aziende`
--
ALTER TABLE `aziende`
  ADD PRIMARY KEY (`P_Iva`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`catId`);

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`cod_promozione`,`ID_utente`),
  ADD KEY `ID_utente` (`ID_utente`);

--
-- Indexes for table `coupon abbinati`
--
ALTER TABLE `coupon abbinati`
  ADD PRIMARY KEY (`ID_utente`,`cod_prom_abb`),
  ADD KEY `cod_prom_abb` (`cod_prom_abb`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id_faq`);

--
-- Indexes for table `permessi`
--
ALTER TABLE `permessi`
  ADD PRIMARY KEY (`ID_utente`,`P_Iva`),
  ADD KEY `P_Iva` (`P_Iva`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`prodId`);

--
-- Indexes for table `promozione`
--
ALTER TABLE `promozione`
  ADD PRIMARY KEY (`cod_promozione`),
  ADD KEY `P_Iva` (`P_Iva`);

--
-- Indexes for table `promozioni abbinate`
--
ALTER TABLE `promozioni abbinate`
  ADD PRIMARY KEY (`cod_prom_abb`);

--
-- Indexes for table `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`ID_utente`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id_faq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `prodId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `promozione`
--
ALTER TABLE `promozione`
  MODIFY `cod_promozione` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `utente`
--
ALTER TABLE `utente`
  MODIFY `ID_utente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `abbinamento`
--
ALTER TABLE `abbinamento`
  ADD CONSTRAINT `abbinamento_ibfk_1` FOREIGN KEY (`cod_prom_abb`) REFERENCES `promozioni abbinate` (`cod_prom_abb`),
  ADD CONSTRAINT `abbinamento_ibfk_2` FOREIGN KEY (`cod_prom`) REFERENCES `promozione` (`cod_promozione`);

--
-- Constraints for table `coupon`
--
ALTER TABLE `coupon`
  ADD CONSTRAINT `coupon_ibfk_1` FOREIGN KEY (`ID_utente`) REFERENCES `utente` (`ID_utente`),
  ADD CONSTRAINT `coupon_ibfk_2` FOREIGN KEY (`cod_promozione`) REFERENCES `promozione` (`cod_promozione`);

--
-- Constraints for table `coupon abbinati`
--
ALTER TABLE `coupon abbinati`
  ADD CONSTRAINT `coupon abbinati_ibfk_1` FOREIGN KEY (`ID_utente`) REFERENCES `utente` (`ID_utente`),
  ADD CONSTRAINT `coupon abbinati_ibfk_2` FOREIGN KEY (`cod_prom_abb`) REFERENCES `promozioni abbinate` (`cod_prom_abb`);

--
-- Constraints for table `promozione`
--
ALTER TABLE `promozione`
  ADD CONSTRAINT `P_Iva` FOREIGN KEY (`P_Iva`) REFERENCES `aziende` (`P_Iva`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
