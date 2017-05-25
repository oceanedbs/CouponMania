-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 25, 2017 alle 16:00
-- Versione del server: 10.1.21-MariaDB
-- Versione PHP: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grp_08_db`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `abbinamento`
--

CREATE TABLE `abbinamento` (
  `cod_prom_abb` varchar(10) NOT NULL,
  `cod_prom` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `assegnazione staff`
--

CREATE TABLE `assegnazione staff` (
  `ID_utente` int(11) NOT NULL,
  `P_Iva` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `azienda`
--

CREATE TABLE `azienda` (
  `P_Iva` varchar(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `logo` varchar(15) NOT NULL,
  `citta` varchar(30) NOT NULL,
  `indirizzo` varchar(50) NOT NULL,
  `tipologia` varchar(10) NOT NULL,
  `descrizione` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `coupon`
--

CREATE TABLE `coupon` (
  `cod_promozione` varchar(10) NOT NULL,
  `ID_utente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `coupon abbinati`
--

CREATE TABLE `coupon abbinati` (
  `ID_utente` int(11) NOT NULL,
  `cod_prom_abb` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `promozione`
--

CREATE TABLE `promozione` (
  `cod_promozione` varchar(10) NOT NULL,
  `tipo_prom` varchar(50) NOT NULL,
  `data_inizio` date NOT NULL,
  `data_fine` date NOT NULL,
  `prodotto` varchar(30) NOT NULL,
  `categoria` varchar(30) NOT NULL,
  `descrizione` text NOT NULL,
  `parole chiave` text NOT NULL,
  `immagine` varchar(40) NOT NULL,
  `P_Iva` varchar(11) NOT NULL,
  `prezzo_unitario_prod` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `promozioni abbinate`
--

CREATE TABLE `promozioni abbinate` (
  `cod_prom_abb` varchar(10) NOT NULL,
  `ult_sconto` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `ID_utente` int(11) NOT NULL,
  `nome` varchar(15) NOT NULL,
  `cognome` varchar(15) NOT NULL,
  `sesso` char(1) NOT NULL,
  `data_nascita` date NOT NULL,
  `telefono` int(10) NOT NULL,
  `e-mail` varchar(50) NOT NULL,
  `ruolo` varchar(15) NOT NULL,
  `citta` varchar(40) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `abbinamento`
--
ALTER TABLE `abbinamento`
  ADD PRIMARY KEY (`cod_prom_abb`,`cod_prom`),
  ADD KEY `cod_prom` (`cod_prom`);

--
-- Indici per le tabelle `assegnazione staff`
--
ALTER TABLE `assegnazione staff`
  ADD PRIMARY KEY (`ID_utente`,`P_Iva`),
  ADD KEY `P_Iva` (`P_Iva`);

--
-- Indici per le tabelle `azienda`
--
ALTER TABLE `azienda`
  ADD PRIMARY KEY (`P_Iva`);

--
-- Indici per le tabelle `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`cod_promozione`,`ID_utente`),
  ADD KEY `ID_utente` (`ID_utente`);

--
-- Indici per le tabelle `coupon abbinati`
--
ALTER TABLE `coupon abbinati`
  ADD PRIMARY KEY (`ID_utente`,`cod_prom_abb`),
  ADD KEY `cod_prom_abb` (`cod_prom_abb`);

--
-- Indici per le tabelle `promozione`
--
ALTER TABLE `promozione`
  ADD PRIMARY KEY (`cod_promozione`),
  ADD KEY `P_Iva` (`P_Iva`);

--
-- Indici per le tabelle `promozioni abbinate`
--
ALTER TABLE `promozioni abbinate`
  ADD PRIMARY KEY (`cod_prom_abb`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`ID_utente`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `ID_utente` int(11) NOT NULL AUTO_INCREMENT;
--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `abbinamento`
--
ALTER TABLE `abbinamento`
  ADD CONSTRAINT `cod_prom` FOREIGN KEY (`cod_prom`) REFERENCES `promozione` (`cod_promozione`),
  ADD CONSTRAINT `cod_prom_abb` FOREIGN KEY (`cod_prom_abb`) REFERENCES `promozioni abbinate` (`cod_prom_abb`);

--
-- Limiti per la tabella `assegnazione staff`
--
ALTER TABLE `assegnazione staff`
  ADD CONSTRAINT `assegnazione staff_ibfk_1` FOREIGN KEY (`P_Iva`) REFERENCES `azienda` (`P_Iva`),
  ADD CONSTRAINT `assegnazione staff_ibfk_2` FOREIGN KEY (`ID_utente`) REFERENCES `utente` (`ID_utente`);

--
-- Limiti per la tabella `coupon`
--
ALTER TABLE `coupon`
  ADD CONSTRAINT `cod_promozione` FOREIGN KEY (`cod_promozione`) REFERENCES `promozione` (`cod_promozione`),
  ADD CONSTRAINT `coupon_ibfk_1` FOREIGN KEY (`ID_utente`) REFERENCES `utente` (`ID_utente`);

--
-- Limiti per la tabella `coupon abbinati`
--
ALTER TABLE `coupon abbinati`
  ADD CONSTRAINT `coupon abbinati_ibfk_1` FOREIGN KEY (`ID_utente`) REFERENCES `utente` (`ID_utente`),
  ADD CONSTRAINT `coupon abbinati_ibfk_2` FOREIGN KEY (`cod_prom_abb`) REFERENCES `promozioni abbinate` (`cod_prom_abb`);

--
-- Limiti per la tabella `promozione`
--
ALTER TABLE `promozione`
  ADD CONSTRAINT `P_Iva` FOREIGN KEY (`P_Iva`) REFERENCES `azienda` (`P_Iva`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
