-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 11, 2021 at 11:08 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Test1`
--

-- --------------------------------------------------------

--
-- Table structure for table `regulamin`
--

CREATE TABLE `regulamin` (
  `id` int(11) NOT NULL,
  `content` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `regulamin`
--

INSERT INTO `regulamin` (`id`, `content`) VALUES
(1, 'Zakazane jest tutaj publikowanie cudzych danych osobowych bez zgody ich wlasciciela.'),
(2, 'Nie wolno zostawiac tutaj zadnych ukrytych \"wiadomosci\", oraz pisac zadnych zdan.'),
(3, 'Imienia nie powinny zawierac wulgaryzmow.'),
(4, 'Wpisujac swoje imie oraz nazwisko do bazy danych, dajesz nam pozwolenie na udostepnianie go publicznie.'),
(5, 'Rejestrując się zezwalasz na wyświetlanie podanego przy rejestracji loginu publicznie.'),
(6, 'Zgłaszanie imion które są zgodne z regulaminem może zakończyć się usunięciem konta.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `regulamin`
--
ALTER TABLE `regulamin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `regulamin`
--
ALTER TABLE `regulamin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
