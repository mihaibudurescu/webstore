-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2017 at 03:42 PM
-- Server version: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `magazin`
--

-- --------------------------------------------------------

--
-- Table structure for table `comenzi`
--

CREATE TABLE `comenzi` (
  `ID_Comanda` int(11) UNSIGNED NOT NULL,
  `Nume` varchar(50) NOT NULL,
  `Adresa` varchar(200) NOT NULL,
  `Telefon` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comenzi`
--

INSERT INTO `comenzi` (`ID_Comanda`, `Nume`, `Adresa`, `Telefon`) VALUES
(211, 'ioana vasile', 'primaverii 20', 720165284),
(208, 'elena udrea', 'primaverii 20', 720165284);

-- --------------------------------------------------------

--
-- Table structure for table `comenzi_produse`
--

CREATE TABLE `comenzi_produse` (
  `ID_Comanda` int(11) NOT NULL,
  `ID_Produs` int(11) NOT NULL,
  `Cantitate` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comenzi_produse`
--

INSERT INTO `comenzi_produse` (`ID_Comanda`, `ID_Produs`, `Cantitate`) VALUES
(211, 4, 1),
(210, 3, 1),
(209, 23, 1),
(208, 23, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cos`
--

CREATE TABLE `cos` (
  `ID` int(11) NOT NULL,
  `cantitate` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mesaje`
--

CREATE TABLE `mesaje` (
  `ID` int(11) NOT NULL,
  `Nume` varchar(100) NOT NULL,
  `Contact` text NOT NULL,
  `Mesaj` varchar(300) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mesaje`
--

INSERT INTO `mesaje` (`ID`, `Nume`, `Contact`, `Mesaj`) VALUES
(2, 'le gigi', '0732020011', 'mai scadeti si voi preturile');

-- --------------------------------------------------------

--
-- Table structure for table `produse`
--

CREATE TABLE `produse` (
  `ID` int(4) NOT NULL,
  `Denumire` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Descriere` varchar(1000) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'Fara descriere',
  `Poza` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `Pret` decimal(4,0) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produse`
--

INSERT INTO `produse` (`ID`, `Denumire`, `Descriere`, `Poza`, `Pret`) VALUES
(23, 'Stilou', 'Stilou, PARKER Sonnet Stainless Steel GT  Gama emblematica a marcii PARKER, SONNET-ul este expresia rafinata a unui modernism elegant combinat cu traditionalismul britanic. Finisajele atent studiate, clipul distinctiv in forma de sageata, aurul pretios sau otelul inoxidabil al penitelor - toate acestea se contopesc intr-o gama de instrumente perfect echilibrate, clasice si moderne in acelasi timp.     SPECIFICATII  Accesorii: Accesoriile placate cu aur 23K Capac: Capac din otel inoxidabil fin sablat avand aspect satinat Corp: Corp din otel inoxidabil fin sablat avand aspect satinat Grip: Grip din ABS (acrylonitrile butadiene styrene) de culoare neagra Penita: Penita din otel inoxidabil placata cu aur 23K', 'media/stilou.jpg', '12'),
(2, 'Pix', 'Pix cu mecanism Schneider K15.Pix cu mecanism, clips si buton metalic, mina pix tip M, interschimbabila, cerneala rezistenta la apa, culoare albastra, rosu, negru', 'media/pix.jpg', '2'),
(3, 'Carioci', 'Seturi cu carioci pe baza de tus termo-sensibil ce se poate sterge cu ajutorul gumei din capatul gumat al acestor carioci.Setul de 6 carioci contine culorile: Pink, Red, Orange, Yellow, Soft Green, and Light BlueSetul de 12 carioci contine culorile: Black, Red, Blue, Green, Soft Green, Light Blue, Purple, Baby Pink, Orange, Yellow, Violet, Brown.', 'media/carioci.jpg', '7'),
(4, 'Creion', 'Creion ascutit, cu guma, corp verde, HB.', 'media/creion.jpg', '6');

-- --------------------------------------------------------

--
-- Table structure for table `useri`
--

CREATE TABLE `useri` (
  `ID` int(11) NOT NULL,
  `utilizator` varchar(50) NOT NULL,
  `parola` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `useri`
--

INSERT INTO `useri` (`ID`, `utilizator`, `parola`) VALUES
(1, 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comenzi`
--
ALTER TABLE `comenzi`
  ADD PRIMARY KEY (`ID_Comanda`);

--
-- Indexes for table `comenzi_produse`
--
ALTER TABLE `comenzi_produse`
  ADD PRIMARY KEY (`ID_Comanda`,`ID_Produs`);

--
-- Indexes for table `cos`
--
ALTER TABLE `cos`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `id` (`ID`);

--
-- Indexes for table `mesaje`
--
ALTER TABLE `mesaje`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `produse`
--
ALTER TABLE `produse`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Indexes for table `useri`
--
ALTER TABLE `useri`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comenzi`
--
ALTER TABLE `comenzi`
  MODIFY `ID_Comanda` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=212;
--
-- AUTO_INCREMENT for table `mesaje`
--
ALTER TABLE `mesaje`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `produse`
--
ALTER TABLE `produse`
  MODIFY `ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `useri`
--
ALTER TABLE `useri`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
