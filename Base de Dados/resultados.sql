-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2021 at 10:02 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pap`
--

-- --------------------------------------------------------

--
-- Table structure for table `resultados`
--

CREATE TABLE `resultados` (
  `ID` int(3) NOT NULL,
  `Nome` varchar(45) NOT NULL,
  `Idade` int(3) NOT NULL,
  `Sexo` varchar(1) NOT NULL,
  `NIF` int(9) NOT NULL,
  `Localidade` varchar(50) NOT NULL,
  `Morada` varchar(50) NOT NULL,
  `Contacto` int(9) NOT NULL,
  `tempo_1_sts` int(3) NOT NULL,
  `tempo_2_sts` int(3) NOT NULL,
  `tempo_3_sts` int(3) NOT NULL,
  `tempo_4_sts` int(3) NOT NULL,
  `tempo_5_sts` int(4) NOT NULL,
  `tempo_1_tug` int(3) NOT NULL,
  `tempo_2_tug` int(3) NOT NULL,
  `tempo_3_tug` int(3) NOT NULL,
  `tempo_4_tug` int(3) NOT NULL,
  `peso_esq_ft` int(2) NOT NULL,
  `peso_dir_ft` int(2) NOT NULL,
  `peso_esq_ts` int(2) NOT NULL,
  `peso_dir_ts` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `resultados`
--

INSERT INTO `resultados` (`ID`, `Nome`, `Idade`, `Sexo`, `NIF`, `Localidade`, `Morada`, `Contacto`, `tempo_1_sts`, `tempo_2_sts`, `tempo_3_sts`, `tempo_4_sts`, `tempo_5_sts`, `tempo_1_tug`, `tempo_2_tug`, `tempo_3_tug`, `tempo_4_tug`, `peso_esq_ft`, `peso_dir_ft`, `peso_esq_ts`, `peso_dir_ts`) VALUES
(1, 'Utilizador', 17, 'M', 74566757, 'Vila Nova de Gaia, Portugal', 'R. Pádua Correia 166, 4430-999', 987654323, 1324, 2435, 3693, 5105, 6752, 2573, 5406, 10236, 10473, 24, 45, 28, 54);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `resultados`
--
ALTER TABLE `resultados`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `resultados`
--
ALTER TABLE `resultados`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
