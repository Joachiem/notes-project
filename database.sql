-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 07 apr 2020 om 07:58
-- Serverversie: 5.6.13
-- PHP-versie: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `notes`
--
CREATE DATABASE IF NOT EXISTS `notes` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `notes`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gebruikers`
--

CREATE TABLE IF NOT EXISTS `gebruikers` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `gebruikersnaam` varchar(50) NOT NULL,
  `wachtwoord` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Gegevens worden uitgevoerd voor tabel `gebruikers`
--

INSERT INTO `gebruikers` (`user_id`, `gebruikersnaam`, `wachtwoord`) VALUES
(9, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `notities`
--

CREATE TABLE IF NOT EXISTS `notities` (
  `note_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `titel` varchar(8000) CHARACTER SET utf8 NOT NULL,
  `inhoud` varchar(8000) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`note_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Gegevens worden uitgevoerd voor tabel `notities`
--

INSERT INTO `notities` (`note_id`, `user_id`, `titel`, `inhoud`) VALUES
(10, 9, 'Test 123 zas', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus elementum rutrum viverra. In elit diam, posuere vel tortor nec, posuere cursus orci. Maecenas dapibus ac nulla nec hendrerit. Donec nibh lacus, elementum id diam sed, fermentum condimentum lectus. Proin vel ex sit amet ipsum ornare dignissim. Sed imperdiet purus nec ipsum auctor ullamcorper. Nam suscipit nec ipsum quis efficitur. Sed posuere est ut tempus sodales. Vivamus blandit porttitor augue, vel lobortis neque imperdiet nec. Donec nunc neque, luctus et elit ut, elementum malesuada sem. Nullam id finibus massa, ac bibendum arcu.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus elementum rutrum viverra. In elit diam, posuere vel tortor nec, posuere cursus orci. Maecenas dapibus ac nulla nec hendrerit. Donec nibh lacus, elementum id diam sed, fermentum condimentum lectus. Proin vel ex sit amet ipsum ornare dignissim. Sed imperdiet purus nec ipsum auctor ullamcorper. Nam suscipit nec ipsum quis efficitur. Sed posuere est ut tempus sodales. Vivamus blandit porttitor augue, vel lobortis neque imperdiet nec. Donec nunc neque, luctus et elit ut, elementum malesuada sem. Nullam id finibus massa, ac bibendum arcu.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus elementum rutrum viverra. In elit diam, posuere vel tortor nec, posuere cursus orci. Maecenas dapibus ac nulla nec hendrerit. Donec nibh lacus, elementum id diam sed, fermentum condimentum lectus. Proin vel ex sit amet ipsum ornare dignissim. Sed imperdiet purus nec ipsum auctor ullamcorper. Nam suscipit nec ipsum quis efficitur. Sed posuere est ut tempus sodales. Vivamus blandit porttitor augue, vel lobortis neque imperdiet nec. Donec nunc neque, luctus et elit ut, elementum malesuada sem. Nullam id finibus massa, ac bibendum arcu.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus elementum rutrum viverra. In elit diam, posuere vel tortor nec, posuere cursus orci. Maecenas dapibus ac nulla nec hendrerit. Donec nibh lacus, elementum id diam sed, fermentum condimentum lectus. Proin vel ex sit amet ipsum ornare dignissim. Sed imperdiet purus nec ipsum auctor ullamcorper. Nam suscipit nec ipsum quis efficitur. Sed posuere est ut tempus sodales. Vivamus blandit porttitor augue, vel lobortis neque imperdiet nec. Donec nunc neque, luctus et elit ut, elementum malesuada sem. Nullam id finibus massa, ac bibendum arcu.');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
