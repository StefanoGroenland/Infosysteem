-- phpMyAdmin SQL Dump
-- version 4.2.8.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 24, 2014 at 02:25 PM
-- Server version: 5.5.38-MariaDB
-- PHP Version: 5.5.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `armand_it_service`
--

-- --------------------------------------------------------

--
-- Table structure for table `beschikbaarheid`
--

CREATE TABLE IF NOT EXISTS `beschikbaarheid` (
`id` int(11) NOT NULL,
  `gebruiker_id` int(11) NOT NULL,
  `weeknummer` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `beschikbaarheid`
--

INSERT INTO `beschikbaarheid` (`id`, `gebruiker_id`, `weeknummer`) VALUES
(76, 1, 46),
(77, 14, 47);

-- --------------------------------------------------------

--
-- Table structure for table `escalaties`
--

CREATE TABLE IF NOT EXISTS `escalaties` (
`id` int(11) NOT NULL,
  `e_datum_aangemaakt` date NOT NULL,
  `e_a_datum_aangemaakt` date NOT NULL,
  `e_tijd_aangemaakt` time NOT NULL,
  `e_a_tijd_aangemaakt` time NOT NULL,
  `e_log` text NOT NULL,
  `e_a_log` text NOT NULL,
  `ticket_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `location` varchar(255) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `all_day` tinyint(1) NOT NULL DEFAULT '1',
  `is_recurring` tinyint(1) NOT NULL DEFAULT '0',
  `recurring_id` int(11) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created` date DEFAULT NULL,
  `modified` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `user_id`, `name`, `description`, `location`, `start`, `end`, `all_day`, `is_recurring`, `recurring_id`, `active`, `created`, `modified`) VALUES
(12, 2, 'Afspraak Adrie van Huuksloot', 'Ticketnummer: 41 Ticketopmerking: Verjaardag Naam: Adrie van Huuksloot Adresgegevens: Woelse Donk 57 postcode, woonplaats: 4207XC GORINCHEM', '', '2014-10-21 12:00:00', '2014-10-21 14:30:00', 0, 0, NULL, 0, '2014-10-20', '2014-10-20'),
(13, 6, 'Afspraak Peter  Griffin', 'Ticketnummer: 42 Ticketopmerking: Rukken Naam: Peter  Griffin Adresgegevens: 105th street 37 postcode, woonplaats: 2020rk Quahog', '', '2014-10-21 13:00:00', '2014-10-21 14:00:00', 0, 0, NULL, 0, '2014-10-20', NULL),
(14, 6, 'Afspraak Peter  Griffin', 'Ticketnummer: 43 Ticketopmerking: Rukken Naam: Peter  Griffin Adresgegevens: 105th street 37 postcode, woonplaats: 2020rk Quahog', '', '2014-10-21 13:00:00', '2014-10-21 14:00:00', 0, 0, NULL, 0, '2014-10-20', NULL),
(15, 6, 'Afspraak Peter  Griffin', 'Ticketnummer: 44 Ticketopmerking: Rukken Naam: Peter  Griffin Adresgegevens: 105th street 37 postcode, woonplaats: 2020rk Quahog', '', '2014-10-21 13:00:00', '2014-10-21 14:00:00', 0, 0, NULL, 0, '2014-10-20', '2014-10-20'),
(16, 3, 'Afspraak Adrie van Huuksloot', 'Ticketnummer: 45 Ticketopmerking: wifi aansluiten Naam: Adrie van Huuksloot Adresgegevens: Woelse Donk 57 postcode, woonplaats: 4207XC GORINCHEM', '', '2014-10-21 15:10:00', '1970-01-01 01:00:00', 0, 0, NULL, 0, '2014-10-20', '2014-10-20'),
(17, 6, 'Afspraak Adrie van Huuksloot', 'Ticketnummer: 46 Ticketopmerking: Hoi Naam: Adrie van Huuksloot Adresgegevens: Woelse Donk 57 postcode, woonplaats: 4207XC GORINCHEM', '', '2014-10-24 15:15:00', '2014-10-24 16:16:00', 0, 0, NULL, 0, '2014-10-24', NULL),
(18, 2, 'Afspraak Adrie van Huuksloot', 'Ticketnummer: 47 Ticketopmerking:  Naam: Adrie van Huuksloot Adresgegevens: Woelse Donk 57 postcode, woonplaats: 4207XC GORINCHEM', '', '1970-01-01 16:20:00', '1970-01-01 00:00:00', 0, 0, NULL, 0, '2014-10-27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `events_users`
--

CREATE TABLE IF NOT EXISTS `events_users` (
`id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events_users`
--

INSERT INTO `events_users` (`id`, `event_id`, `user_id`, `status_id`) VALUES
(20, 12, 2, 2),
(21, 15, 6, 2),
(22, 16, 3, 2),
(23, 16, 2, 1),
(24, 17, 6, 2),
(25, 18, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `facturen`
--

CREATE TABLE IF NOT EXISTS `facturen` (
`id` int(11) NOT NULL,
  `datum` date NOT NULL,
  `pdf` varchar(50) NOT NULL,
  `soort` enum('offerte','factuur') NOT NULL,
  `klant_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'niet verzonden'
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `facturen`
--

INSERT INTO `facturen` (`id`, `datum`, `pdf`, `soort`, `klant_id`, `status`) VALUES
(1, '2014-10-06', 'pdf/Factuur-5432f0a144f70.pdf', 'factuur', 1, 'verzonden'),
(2, '2014-10-07', 'pdf/Factuur-5433b33ebf70c.pdf', 'factuur', 1, 'verzonden'),
(3, '2014-10-07', 'pdf/Factuur-5433b34876327.pdf', 'factuur', 1, 'niet verzonden'),
(4, '2014-10-07', 'pdf/Factuur-5433cc578cf6f.pdf', 'factuur', 1, 'verzonden'),
(5, '2014-10-07', 'pdf/Factuur-5433cc62db16a.pdf', 'factuur', 1, 'niet verzonden'),
(6, '2014-10-07', 'pdf/Factuur-5433cd0a12ebd.pdf', 'factuur', 1, 'verzonden'),
(7, '2014-10-07', 'pdf/Factuur-5433f01279108.pdf', 'factuur', 1, 'verzonden'),
(8, '2014-10-07', 'pdf/Factuur-5433f029a773e.pdf', 'factuur', 1, 'niet verzonden'),
(9, '2014-10-07', 'pdf/Factuur-5433f6db19ecd.pdf', 'factuur', 1, 'niet verzonden'),
(10, '2014-10-07', 'pdf/Factuur-5433f7205968f.pdf', 'factuur', 1, 'niet verzonden'),
(11, '2014-10-09', 'pdf/Factuur-54364b14d1c3b.pdf', 'factuur', 1, 'niet verzonden'),
(12, '2014-10-11', 'pdf/Factuur-54394f5a9dd3a.pdf', 'factuur', 1, 'verzonden'),
(13, '2014-10-15', 'pdf/Factuur-543e3fe89ab16.pdf', 'factuur', 19, 'verzonden'),
(14, '2014-10-15', 'pdf/Factuur-543e408a2586c.pdf', 'factuur', 19, 'niet verzonden'),
(15, '2014-10-15', 'pdf/Factuur-543e40da51231.pdf', 'factuur', 19, 'niet verzonden'),
(16, '2014-10-15', 'pdf/Factuur-543e416f97f35.pdf', 'factuur', 19, 'niet verzonden'),
(17, '2014-10-15', 'pdf/Factuur-543e41ac81fc5.pdf', 'factuur', 19, 'niet verzonden'),
(18, '2014-10-15', 'pdf/Factuur-543e420830cee.pdf', 'factuur', 19, 'niet verzonden'),
(19, '2014-10-15', 'pdf/Factuur-543e420c66851.pdf', 'factuur', 19, 'niet verzonden'),
(20, '2014-10-15', 'pdf/Factuur-543e421ea8703.pdf', 'factuur', 19, 'niet verzonden'),
(21, '2014-10-15', 'pdf/Factuur-543e42fb7a142.pdf', 'factuur', 1, 'verzonden'),
(22, '2014-10-15', 'pdf/Factuur-543e43f14dc5e.pdf', 'factuur', 1, 'verzonden'),
(23, '2014-10-15', 'pdf/Factuur-543e441b330a1.pdf', 'factuur', 1, 'verzonden'),
(24, '2014-10-15', 'pdf/Factuur-543e458924874.pdf', 'factuur', 1, 'verzonden'),
(25, '2014-10-15', 'pdf/Factuur-543e45e35431d.pdf', 'factuur', 1, 'verzonden'),
(26, '2014-10-15', 'pdf/Factuur-543e4605dcec0.pdf', 'factuur', 1, 'verzonden'),
(27, '2014-10-15', 'pdf/Factuur-543e461fa7365.pdf', 'factuur', 1, 'verzonden'),
(28, '2014-10-15', 'pdf/Factuur-543e4642d329f.pdf', 'factuur', 1, 'verzonden'),
(29, '2014-10-15', 'pdf/Factuur-543e467fd8182.pdf', 'factuur', 1, 'verzonden'),
(30, '2014-10-15', 'pdf/Factuur-543e46aec6feb.pdf', 'factuur', 1, 'verzonden'),
(31, '2014-10-15', 'pdf/Factuur-543e46cf784b4.pdf', 'factuur', 1, 'verzonden'),
(32, '2014-10-15', 'pdf/Factuur-543e46d8e3b72.pdf', 'factuur', 1, 'verzonden'),
(33, '2014-10-15', 'pdf/Factuur-543e46dfdc644.pdf', 'factuur', 1, 'verzonden'),
(34, '2014-10-15', 'pdf/Factuur-543e4813d7e64.pdf', 'factuur', 1, 'verzonden'),
(35, '2014-10-15', 'pdf/Factuur-543e488a5684c.pdf', 'factuur', 1, 'verzonden'),
(36, '2014-10-15', 'pdf/Factuur-543e4aa4a69c6.pdf', 'factuur', 1, 'verzonden'),
(37, '2014-10-15', 'pdf/Factuur-543e6dbea298d.pdf', 'factuur', 1, 'verzonden'),
(38, '2014-10-15', 'pdf/Factuur-543e6e14ec2d7.pdf', 'factuur', 1, 'verzonden'),
(39, '2014-10-15', 'pdf/Factuur-543e6e1c2dbf5.pdf', 'factuur', 1, 'verzonden'),
(40, '2014-10-15', 'pdf/Factuur-543e6ec40e076.pdf', 'factuur', 1, 'verzonden'),
(41, '2014-10-15', 'pdf/Factuur-543e70e2206e7.pdf', 'factuur', 1, 'verzonden'),
(42, '2014-10-15', 'pdf/Factuur-543e8539c52f5.pdf', 'factuur', 1, 'verzonden'),
(43, '2014-10-16', 'pdf/Factuur-543fd206700fa.pdf', 'factuur', 1, 'verzonden'),
(44, '2014-10-16', 'pdf/Factuur-543fd2231d161.pdf', 'factuur', 6, 'verzonden'),
(45, '2014-10-16', 'pdf/Factuur-543fd230e7ab2.pdf', 'factuur', 19, 'verzonden'),
(46, '2014-10-16', 'pdf/Factuur-543fd2b3cf45b.pdf', 'factuur', 1, 'verzonden'),
(47, '2014-10-20', 'pdf/Factuur-544518c812bd7.pdf', 'factuur', 1, 'verzonden'),
(48, '2014-10-24', 'pdf/Factuur-544a2f13f1bd4.pdf', 'factuur', 1, 'verzonden'),
(49, '2014-10-27', 'pdf/Factuur-544e150688f72.pdf', 'factuur', 1, 'niet verzonden'),
(50, '2014-10-27', 'pdf/Factuur-544e458223f5d.pdf', 'factuur', 1, 'niet verzonden'),
(51, '2014-10-31', 'pdf/Factuur-5453a636430a5.pdf', 'factuur', 1, 'niet verzonden');

-- --------------------------------------------------------

--
-- Table structure for table `gebruikers`
--

CREATE TABLE IF NOT EXISTS `gebruikers` (
`id` int(11) NOT NULL,
  `last_login` varchar(255) NOT NULL DEFAULT '0',
  `time_last_login` time NOT NULL,
  `date_last_login` date NOT NULL,
  `voornaam` varchar(20) NOT NULL,
  `tussenvoegsel` varchar(30) NOT NULL,
  `achternaam` varchar(20) NOT NULL,
  `foto` varchar(255) NOT NULL DEFAULT 'noImg.png',
  `gebruikersnaam` varchar(20) NOT NULL,
  `wachtwoord` varchar(200) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `gebruikerstype` enum('admin','stage','klant') NOT NULL,
  `klant_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gebruikers`
--

INSERT INTO `gebruikers` (`id`, `last_login`, `time_last_login`, `date_last_login`, `voornaam`, `tussenvoegsel`, `achternaam`, `foto`, `gebruikersnaam`, `wachtwoord`, `mail`, `gebruikerstype`, `klant_id`) VALUES
(1, '94.208.116.208', '12:59:00', '2014-11-24', 'Necati', '', 'Unal', 'Koala.jpg', 'Necati', 'ŠÂ’Ù0ð‡#/ÄyTsŠ', 'necati@live.nl', 'admin', NULL),
(7, '83.160.137.31', '14:35:26', '2014-10-05', 'Armand', '', 'Dharamsingh', 'noImg.png', 'Armand', 'øAÛÿÍÓ-à>ß•­', 'info@armand-it-services.nl', 'admin', NULL),
(8, '91.221.151.149', '16:44:47', '2014-11-06', 'Shaif', '', 'Moesai', '', 'Shaif', '¬óèÐè¸æùÃ$+', 'shaif@armand-it-services.nl', 'admin', NULL),
(9, '94.208.116.208', '12:15:30', '2014-10-02', 'tester', '', 'klant', 'noImg.png', 'klant', '&R•Ý^	PÃ¸Êäã”', 'n.unal@mondriaanict.nl', 'klant', 8),
(13, '0', '00:00:00', '0000-00-00', 'stage', '', 'Stagair A', 'noImg.png', 'stage', 'HØØ°	[+D³yhR#', 'test@necati.nl', 'stage', NULL),
(14, '94.208.116.208', '09:02:52', '2014-11-24', 'Stefano', '', 'Groenland', 'volkswagen-golf-7-gtd-tuned-to-210-hp-by-abt-60125_1.jpg', 'stefano', 'ŠÂ’Ù0ð‡#/ÄyTsŠ', 'stefano.groenland@gmail.com                ', 'admin', NULL),
(19, '', '00:00:00', '0000-00-00', 'dsadsa', '', 'dsdaew', 'noImg.png', 'stages', 'wºl\ní;©+ dÉ’×', 'stage@stage.nl', 'klant', 13),
(24, '0', '00:00:00', '0000-00-00', 'tester', '', 'Groenland', '', 'finaltest', '8BìðÊ“ÆÜÖ	^$ÔM¨', 'test@test.nl', 'stage', NULL),
(25, '0', '00:00:00', '0000-00-00', 'TestFactuurZenden', '', 'sadsad', 'noImg.png', 'StagairTest', '5S*=ÎÉl‘ËÃ©TÑ¿;', 'stefano.groenland@gmail.com', 'klant', 19);

-- --------------------------------------------------------

--
-- Table structure for table `kalender`
--

CREATE TABLE IF NOT EXISTS `kalender` (
`id` int(6) NOT NULL,
  `naam` varchar(150) NOT NULL,
  `datum` varchar(15) NOT NULL,
  `van` varchar(15) NOT NULL,
  `tot` varchar(15) NOT NULL,
  `omschrijving` varchar(250) NOT NULL,
  `bijzonderheden` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kalender`
--

INSERT INTO `kalender` (`id`, `naam`, `datum`, `van`, `tot`, `omschrijving`, `bijzonderheden`) VALUES
(3, 'test', '2014-07-31', '1400', '22:00', 'test', ''),
(4, 'test4', '0001-01-12', '1111', '12:00', 'test4', 'test4'),
(5, 'test4 ', '101009-10-10', '1010', '10:10', 'test4 ', 'test4 '),
(6, 'test4 ', '101009-10-10', '1010', '10:10', 'test4 ', 'test4 '),
(7, 'test5', '0555-05-05', '0555', '05:55', 'test5', 'test5 '),
(8, 'test5', '0555-05-05', '0555', '05:55', 'test5', 'test5 '),
(9, 'test6', '6666-06-06', '0606', '06:59', 'test6', 'test6'),
(20, 'naam', '2014-07-11', '0900', '10:00', 'omschrijving', ''),
(22, 'uitslapen', '2014-07-14', '0630', '00:00', 'eerste vakantie dag', 'uitslapen, heerlijk'),
(26, 'test frame 2', '2014-07-04', '1200', '13:00', 'test frame 2', 'test frame 2'),
(27, 'test frame 3', '2014-07-04', '1200', '13:00', 'test frame 3', 'test frame 3'),
(28, 'test frame 4', '2014-07-04', '1500', '15:00', 'test frame 4', 'test frame 4'),
(29, 'test frame', '2014-07-04', '0000', '00:00', 'test ', 'test'),
(30, '', '', '', '', '', ''),
(40, 'test', '2014-07-01', '', '', '', ''),
(41, 'test ', '2014-07-11', '1233', '13:27', 'Hello world!', ''),
(44, 'test', '2014-07-11', '1359', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `klanten`
--

CREATE TABLE IF NOT EXISTS `klanten` (
`id` int(11) NOT NULL,
  `voornaam` varchar(20) NOT NULL,
  `tussenvoegsel` varchar(20) NOT NULL,
  `achternaam` varchar(20) NOT NULL,
  `straatnaam` varchar(50) NOT NULL,
  `huisnummer` varchar(10) NOT NULL,
  `postcode` varchar(6) NOT NULL,
  `woonplaats` varchar(50) NOT NULL,
  `bedrijf` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `telefoon` varchar(20) NOT NULL,
  `mobiel` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `klanten`
--

INSERT INTO `klanten` (`id`, `voornaam`, `tussenvoegsel`, `achternaam`, `straatnaam`, `huisnummer`, `postcode`, `woonplaats`, `bedrijf`, `email`, `telefoon`, `mobiel`) VALUES
(1, 'Adrie', 'van', 'Huuksloot', 'Woelse Donk', '57', '4207XC', 'GORINCHEM', 'AVHProjectmanagement', 'x.stef@live.nl', '0183699120', '0653202501'),
(2, 'Leendert', '', 'Buijs', 'Nieuwe Parklaan', '86', '2587BV', 'DEN HAAG', 'Buijs Schilders B.V.', 'x.stef@live.nl', '', '0653177163'),
(3, 'Joop', '', 'Zuur', 'Steenvoordelaan', '288', '2284EG', 'RIJSWIJK', 'Apple', 'x.stef@live.nl', '0702130696', '0610400710'),
(6, 'Ben', '', 'Siebelink', 'Diamanthorst', '187', '2592GD', 'DEN HAAG', 'Kerkelijk Bureau PGDH', 'x.stef@live.nl', '0703858707', ''),
(7, 'Leonore ', '', 'Brons', 'Daal en Bergselaan', '50a', '2565AE', 'DEN HAAG', 'Bergkerk', 'x.stef@live.nl', '', '068146757'),
(8, 'test7', 'test', 'TestKlant', 'Mijnstraat', '148', '1111pk', 'Den haag', 'Audi Dealer', 'x.stef@live.nl', '01529302011', '0628909122'),
(13, 'Peter ', '', 'Griffin', '105th street', '37', '2020rk', 'Quahog', 'Pawtucket', 'x.stef@live.nl', '123456789', '123456'),
(14, 'Stefano', ' ', 'Groenland           ', 'Spooner Street', '31', '1337XD', 'Quahog', '', 'x.stef@live.nl', '', ''),
(15, 'Stefano', 'dsa', 'das', 'dsa', 'asd', '2615XD', 'sad', 'sad', 'x.stef@live.nl', '0628909215', '0628909215'),
(16, 'Stefano', 'dsa', 'das', 'dsa', 'asd', '2615XD', 'sad', 'sad', 'x.stef@live.nl', '0628909215', '0628909215'),
(17, 'TestKlant', '', 'beta', 'betaplein', '9', '1337LT', 'AISHQ', 'ArmandITServices', 'x.stef@live.nl', '07012356241', '0628909546'),
(18, 'Test', '', 'Klant', 'Mijnstraat', '12', '1234ab', 'den haag', 'test bedrijf', 'x.stef@live.nl', '01529302011', '0628909122'),
(19, 'Testmailsturen', '', 'Klant', 'Mijnstraat', '12', '1234ab', 'den haag', 'test bedrijf', 'x.stef@live.nl', '01529302011', '0628909122'),
(20, 'fds', 'fdsa', 'fasdf', 'fasdfsda', '12', '1234ab', 'Den haag', 'Audi Dealer', 'x.stef@live.nl', '01529302011', '0628909122'),
(21, 'finaltest', 'legit', 'Tester', 'sdada', '182', '1818KA', 'Delft', 'AIS-ServerHackers', 'x.stef@live.nl', '0628909214', '0628909214');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
`id` int(11) NOT NULL,
  `tijd_log` time NOT NULL,
  `ip_adres` varchar(255) NOT NULL,
  `log` varchar(255) NOT NULL,
  `status` enum('Gelukt','Mislukt') NOT NULL,
  `datum_log` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=629 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `tijd_log`, `ip_adres`, `log`, `status`, `datum_log`) VALUES
(18, '14:37:35', '94.208.116.208', 'Storing verwijderen', 'Gelukt', '2014-10-09'),
(19, '14:37:45', '94.208.116.208', 'Storing wijzigen', 'Gelukt', '2014-10-09'),
(20, '15:10:07', '94.208.116.208', 'Escalatie toevoegen', 'Gelukt', '2014-10-09'),
(21, '15:13:27', '94.208.116.208', 'Escalatie antwoord toevoegen', 'Gelukt', '2014-10-09'),
(22, '15:21:09', '94.208.116.208', 'Escalatie antwoord toevoegen', 'Gelukt', '2014-10-09'),
(23, '15:23:52', '94.208.116.208', 'Escalatie antwoord toevoegen', 'Gelukt', '2014-10-09'),
(24, '15:24:09', '94.208.116.208', 'Escalatie toevoegen', 'Gelukt', '2014-10-09'),
(25, '16:12:16', '94.208.116.208', 'Voorraad wijzigen', 'Gelukt', '2014-10-09'),
(26, '16:12:19', '94.208.116.208', 'Voorraad wijzigen', 'Gelukt', '2014-10-09'),
(27, '16:12:21', '94.208.116.208', 'Voorraad wijzigen', 'Gelukt', '2014-10-09'),
(28, '16:12:24', '94.208.116.208', 'Voorraad wijzigen', 'Gelukt', '2014-10-09'),
(29, '13:59:48', '94.208.116.208', 'Eigen gegevens wijzigen', 'Gelukt', '2014-10-10'),
(30, '17:40:10', '84.85.150.41', 'Factuur verzenden', 'Gelukt', '2014-10-11'),
(31, '15:43:10', '94.208.116.208', 'Eigen gegevens wijzigen', 'Gelukt', '2014-10-13'),
(32, '11:21:30', '94.208.116.208', 'Klant toevoegen', 'Gelukt', '2014-10-15'),
(33, '11:22:34', '94.208.116.208', 'Ticket toevoegen', 'Gelukt', '2014-10-15'),
(34, '11:23:19', '94.208.116.208', 'Gebruiker verwijderen', 'Gelukt', '2014-10-15'),
(35, '11:23:44', '94.208.116.208', 'Gebruiker toevoegen', 'Gelukt', '2014-10-15'),
(36, '11:25:21', '94.208.116.208', 'Klang gebruiker aanmaken', 'Gelukt', '2014-10-15'),
(37, '11:34:03', '94.208.116.208', 'Gebruiker gewijzigd', 'Gelukt', '2014-10-15'),
(38, '11:35:24', '94.208.116.208', 'Klant wijzigen', 'Gelukt', '2014-10-15'),
(39, '11:35:36', '94.208.116.208', 'Factuur verzenden', 'Gelukt', '2014-10-15'),
(40, '11:35:39', '94.208.116.208', 'Mail verzenden', 'Gelukt', '2014-10-15'),
(41, '11:38:18', '94.208.116.208', 'Factuur verzenden', 'Gelukt', '2014-10-15'),
(42, '11:43:08', '94.208.116.208', 'Factuur verzenden', 'Gelukt', '2014-10-15'),
(43, '11:53:31', '94.208.116.208', 'Factuur verzenden', 'Gelukt', '2014-10-15'),
(44, '12:02:07', '94.208.116.208', 'Factuur verzenden', 'Gelukt', '2014-10-15'),
(45, '12:02:43', '94.208.116.208', 'Factuur verzenden', 'Gelukt', '2014-10-15'),
(46, '12:03:44', '94.208.116.208', 'Factuur verzenden', 'Gelukt', '2014-10-15'),
(47, '12:04:30', '94.208.116.208', 'Factuur verzenden', 'Gelukt', '2014-10-15'),
(48, '12:05:03', '94.208.116.208', 'Factuur verzenden', 'Gelukt', '2014-10-15'),
(49, '12:05:12', '94.208.116.208', 'Factuur verzenden', 'Gelukt', '2014-10-15'),
(50, '12:05:19', '94.208.116.208', 'Factuur verzenden', 'Gelukt', '2014-10-15'),
(51, '12:10:27', '94.208.116.208', 'Factuur maken', 'Gelukt', '2014-10-15'),
(52, '12:12:26', '94.208.116.208', 'Factuur maken', 'Gelukt', '2014-10-15'),
(53, '12:21:24', '94.208.116.208', 'Factuur maken', 'Gelukt', '2014-10-15'),
(54, '12:21:59', '94.208.116.208', 'Mail verzenden', 'Gelukt', '2014-10-15'),
(55, '12:22:17', '94.208.116.208', 'Mail verzenden', 'Gelukt', '2014-10-15'),
(56, '12:22:20', '94.208.116.208', 'Mail verzenden', 'Gelukt', '2014-10-15'),
(57, '12:22:22', '94.208.116.208', 'Mail verzenden', 'Gelukt', '2014-10-15'),
(58, '12:22:24', '94.208.116.208', 'Mail verzenden', 'Gelukt', '2014-10-15'),
(59, '12:22:26', '94.208.116.208', 'Mail verzenden', 'Gelukt', '2014-10-15'),
(60, '12:22:29', '94.208.116.208', 'Mail verzenden', 'Gelukt', '2014-10-15'),
(61, '12:22:31', '94.208.116.208', 'Mail verzenden', 'Gelukt', '2014-10-15'),
(62, '12:22:33', '94.208.116.208', 'Mail verzenden', 'Gelukt', '2014-10-15'),
(63, '12:22:35', '94.208.116.208', 'Mail verzenden', 'Gelukt', '2014-10-15'),
(64, '12:22:37', '94.208.116.208', 'Mail verzenden', 'Gelukt', '2014-10-15'),
(65, '12:25:36', '94.208.116.208', 'Mail verzenden', 'Gelukt', '2014-10-15'),
(66, '12:28:42', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-15'),
(67, '12:28:42', '94.208.116.208', 'Mail verzenden', 'Gelukt', '2014-10-15'),
(68, '12:29:24', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-15'),
(69, '12:31:38', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-15'),
(70, '14:51:10', '94.208.116.208', 'Factuur maken', 'Gelukt', '2014-10-15'),
(71, '14:51:15', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-15'),
(72, '14:52:37', '94.208.116.208', 'Factuur maken', 'Gelukt', '2014-10-15'),
(73, '14:52:39', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-15'),
(74, '14:52:44', '94.208.116.208', 'Factuur maken', 'Gelukt', '2014-10-15'),
(75, '14:53:07', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-15'),
(76, '14:53:13', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-15'),
(77, '14:53:19', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-15'),
(78, '14:55:32', '94.208.116.208', 'Factuur maken', 'Gelukt', '2014-10-15'),
(79, '14:55:34', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-15'),
(80, '15:04:34', '94.208.116.208', 'Factuur maken', 'Gelukt', '2014-10-15'),
(81, '15:04:36', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-15'),
(82, '15:51:22', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-15'),
(83, '15:51:58', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-15'),
(84, '15:59:13', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-15'),
(85, '15:59:56', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-15'),
(86, '16:00:46', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-15'),
(87, '16:07:11', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-15'),
(88, '16:07:31', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-15'),
(89, '16:08:02', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-15'),
(90, '16:08:20', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-15'),
(91, '16:31:21', '94.208.116.208', 'Factuur maken', 'Gelukt', '2014-10-15'),
(92, '16:31:23', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-15'),
(93, '16:31:25', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-15'),
(94, '16:31:26', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-15'),
(95, '16:31:30', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-15'),
(96, '16:31:33', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-15'),
(97, '16:31:33', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-15'),
(98, '16:31:33', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-15'),
(99, '16:31:34', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-15'),
(100, '16:31:34', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-15'),
(101, '16:31:34', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-15'),
(102, '16:31:34', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-15'),
(103, '16:31:34', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-15'),
(104, '16:31:34', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-15'),
(105, '16:31:35', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-15'),
(106, '16:31:35', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-15'),
(107, '16:31:40', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-15'),
(108, '16:31:41', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-15'),
(109, '16:31:48', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-15'),
(110, '16:31:49', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-15'),
(111, '16:31:50', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-15'),
(112, '16:31:51', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-15'),
(113, '16:31:52', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-15'),
(114, '16:31:53', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-15'),
(115, '16:31:54', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-15'),
(116, '16:31:55', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-15'),
(117, '16:31:56', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-15'),
(118, '16:31:58', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-15'),
(119, '16:31:59', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-15'),
(120, '16:32:01', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-15'),
(121, '16:32:02', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-15'),
(122, '09:48:29', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-16'),
(123, '09:49:17', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-16'),
(124, '09:49:23', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-16'),
(125, '16:11:18', '94.208.116.208', 'Factuur maken', 'Gelukt', '2014-10-16'),
(126, '16:11:23', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-16'),
(127, '16:11:47', '94.208.116.208', 'Factuur maken', 'Gelukt', '2014-10-16'),
(128, '16:11:49', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-16'),
(129, '16:12:01', '94.208.116.208', 'Factuur maken', 'Gelukt', '2014-10-16'),
(130, '16:12:03', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-16'),
(131, '16:14:11', '94.208.116.208', 'Factuur maken', 'Gelukt', '2014-10-16'),
(132, '16:14:14', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-16'),
(133, '16:14:19', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-16'),
(134, '16:15:16', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-16'),
(135, '16:15:36', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-16'),
(136, '16:15:41', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-16'),
(137, '16:18:21', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-10-16'),
(138, '10:53:13', '94.208.116.208', 'Ticket toevoegen', 'Gelukt', '2014-10-17'),
(139, '10:54:59', '94.208.116.208', 'Ticket toevoegen', 'Gelukt', '2014-10-17'),
(140, '10:55:40', '94.208.116.208', 'Ticket toevoegen', 'Gelukt', '2014-10-17'),
(141, '10:56:04', '94.208.116.208', 'Ticket toevoegen', 'Gelukt', '2014-10-17'),
(142, '10:56:19', '94.208.116.208', 'Ticket toevoegen', 'Gelukt', '2014-10-17'),
(143, '10:56:38', '94.208.116.208', 'Ticket toevoegen', 'Gelukt', '2014-10-17'),
(144, '10:57:07', '94.208.116.208', 'Ticket toevoegen', 'Gelukt', '2014-10-17'),
(145, '10:58:04', '94.208.116.208', 'Ticket toevoegen', 'Gelukt', '2014-10-17'),
(146, '14:01:13', '192.168.178.30', 'Ticket toevoegen', 'Gelukt', '2014-10-20'),
(147, '14:02:06', '192.168.178.30', 'Ticket verwijderen', 'Gelukt', '2014-10-20'),
(148, '14:02:10', '192.168.178.30', 'Ticket verwijderen', 'Gelukt', '2014-10-20'),
(149, '14:02:12', '192.168.178.30', 'Ticket verwijderen', 'Gelukt', '2014-10-20'),
(150, '14:02:16', '192.168.178.30', 'Ticket verwijderen', 'Gelukt', '2014-10-20'),
(151, '14:02:18', '192.168.178.30', 'Ticket verwijderen', 'Gelukt', '2014-10-20'),
(152, '14:02:21', '192.168.178.30', 'Ticket verwijderen', 'Gelukt', '2014-10-20'),
(153, '14:02:24', '192.168.178.30', 'Ticket verwijderen', 'Gelukt', '2014-10-20'),
(154, '14:02:28', '192.168.178.30', 'Ticket verwijderen', 'Gelukt', '2014-10-20'),
(155, '14:02:31', '192.168.178.30', 'Ticket verwijderen', 'Gelukt', '2014-10-20'),
(156, '14:02:34', '192.168.178.30', 'Ticket verwijderen', 'Gelukt', '2014-10-20'),
(157, '14:03:19', '192.168.178.30', 'Ticket verwijderen', 'Gelukt', '2014-10-20'),
(158, '14:13:33', '192.168.178.30', 'Ticket toevoegen', 'Gelukt', '2014-10-20'),
(159, '14:26:17', '192.168.178.30', 'Ticket toevoegen', 'Gelukt', '2014-10-20'),
(160, '14:26:23', '192.168.178.30', 'Ticket verwijderen', 'Gelukt', '2014-10-20'),
(161, '15:18:11', '192.168.178.37', 'Ticket toevoegen', 'Gelukt', '2014-10-20'),
(162, '16:14:32', '192.168.178.29', 'Factuur maken', 'Gelukt', '2014-10-20'),
(163, '16:14:35', '192.168.178.29', 'Mail verzenden', 'Mislukt', '2014-10-20'),
(164, '12:09:02', '192.168.178.30', 'Ticket verwijderen', 'Gelukt', '2014-10-21'),
(165, '12:51:00', '84.106.20.119', 'Factuur maken', 'Gelukt', '2014-10-24'),
(166, '13:41:11', '94.208.116.208', 'Ticket toevoegen', 'Gelukt', '2014-10-24'),
(167, '10:27:28', '192.168.178.30', 'Ticket toevoegen', 'Gelukt', '2014-10-27'),
(168, '10:27:42', '192.168.178.30', 'Ticket verwijderen', 'Gelukt', '2014-10-27'),
(169, '10:48:54', '94.208.116.208', 'Factuur maken', 'Gelukt', '2014-10-27'),
(170, '13:31:44', '192.168.178.30', 'Ticket verwijderen', 'Gelukt', '2014-10-27'),
(171, '14:15:46', '94.208.116.208', 'Factuur maken', 'Gelukt', '2014-10-27'),
(172, '15:03:14', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-10-30'),
(173, '15:03:44', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-10-30'),
(174, '15:14:22', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-10-30'),
(175, '15:14:24', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-10-30'),
(176, '15:14:58', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-10-30'),
(177, '15:16:48', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-10-30'),
(178, '15:17:03', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-10-30'),
(179, '15:17:49', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-10-30'),
(180, '15:18:55', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-10-30'),
(181, '15:20:39', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-10-30'),
(182, '15:20:56', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-10-30'),
(183, '15:21:21', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-10-30'),
(184, '15:21:47', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-10-30'),
(185, '15:23:09', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-10-30'),
(186, '15:23:50', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-10-30'),
(187, '15:25:11', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-10-30'),
(188, '10:16:49', '94.208.116.208', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-10-31'),
(189, '10:20:56', '94.208.116.208', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(190, '10:25:48', '94.208.116.208', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(191, '10:25:57', '94.208.116.208', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(192, '10:26:03', '94.208.116.208', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(193, '10:26:26', '94.208.116.208', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(194, '10:28:28', '94.208.116.208', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(195, '10:29:49', '192.168.178.30', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(196, '10:30:01', '94.208.116.208', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(197, '10:30:10', '192.168.178.30', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(198, '10:30:13', '94.208.116.208', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(199, '10:30:56', '192.168.178.30', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(200, '10:31:10', '192.168.178.30', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(201, '10:31:37', '192.168.178.30', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(202, '10:31:39', '192.168.178.30', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(203, '10:31:41', '192.168.178.30', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(204, '10:31:42', '192.168.178.30', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(205, '10:31:43', '192.168.178.30', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(206, '10:31:44', '192.168.178.30', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(207, '10:42:12', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-10-31'),
(208, '10:43:53', '192.168.178.30', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(209, '10:44:17', '192.168.178.30', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(210, '10:48:14', '94.208.116.208', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-10-31'),
(211, '11:34:37', '192.168.178.30', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(212, '11:43:20', '192.168.178.30', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(213, '11:43:58', '94.208.116.208', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(214, '11:44:13', '94.208.116.208', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(215, '11:45:07', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-10-31'),
(216, '11:45:17', '94.208.116.208', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-10-31'),
(217, '11:45:20', '192.168.178.30', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(218, '11:45:27', '192.168.178.30', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(219, '11:46:44', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-10-31'),
(220, '11:48:07', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-10-31'),
(221, '11:49:34', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-10-31'),
(222, '11:52:20', '192.168.178.30', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(223, '11:53:07', '192.168.178.30', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(224, '11:53:21', '192.168.178.30', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(225, '11:53:52', '192.168.178.30', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(226, '11:54:20', '192.168.178.30', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(227, '11:54:33', '192.168.178.30', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(228, '11:54:51', '192.168.178.30', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(229, '11:55:15', '192.168.178.30', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(230, '11:55:17', '94.208.116.208', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(231, '11:55:47', '192.168.178.30', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(232, '11:55:50', '94.208.116.208', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(233, '11:58:40', '192.168.178.30', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(234, '11:58:48', '192.168.178.30', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(235, '11:59:22', '192.168.178.30', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(236, '11:59:33', '192.168.178.30', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(237, '12:00:24', '192.168.178.30', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(238, '12:01:17', '192.168.178.30', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(239, '12:01:28', '192.168.178.30', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(240, '12:02:27', '192.168.178.30', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(241, '12:02:54', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-10-31'),
(242, '12:03:18', '192.168.178.30', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(243, '12:03:23', '192.168.178.30', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(244, '12:04:02', '192.168.178.30', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(245, '12:04:06', '192.168.178.30', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(246, '12:04:12', '192.168.178.30', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(247, '12:04:29', '192.168.178.30', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(248, '12:04:38', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-10-31'),
(249, '12:04:46', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-10-31'),
(250, '12:05:50', '192.168.178.30', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(251, '12:06:20', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-10-31'),
(252, '12:06:40', '94.208.116.208', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(253, '12:07:24', '192.168.178.30', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(254, '12:08:08', '94.208.116.208', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(255, '12:09:06', '94.208.116.208', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-10-31'),
(256, '12:11:07', '94.208.116.208', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-10-31'),
(257, '13:20:34', '94.208.116.208', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(258, '13:26:56', '94.208.116.208', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(259, '13:27:25', '94.208.116.208', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(260, '13:33:34', '94.208.116.208', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-10-31'),
(261, '13:35:49', '94.208.116.208', 'Beschikbaarheid bijgewerkt', 'Gelukt', '2014-10-31'),
(262, '13:40:37', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-10-31'),
(263, '16:09:42', '94.208.116.208', 'Factuur maken', 'Gelukt', '2014-10-31'),
(264, '15:55:11', '94.208.116.208', 'Ticket verwijderen', 'Gelukt', '2014-11-06'),
(265, '15:55:41', '94.208.116.208', 'Mail verzenden', 'Mislukt', '2014-11-06'),
(266, '15:58:13', '94.208.116.208', 'Storing wijzigen', 'Gelukt', '2014-11-06'),
(267, '12:08:00', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(268, '12:20:39', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(269, '12:20:58', '94.208.116.208', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(270, '12:21:01', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(271, '12:21:25', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(272, '12:21:37', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(273, '12:21:51', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(274, '12:22:06', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(275, '12:22:10', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(276, '12:22:19', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(277, '12:22:49', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(278, '12:23:00', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(279, '12:23:14', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(280, '12:23:28', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(281, '12:23:40', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(282, '12:24:07', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(283, '12:26:24', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(284, '12:26:59', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(285, '12:27:13', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(286, '12:27:39', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(287, '12:28:18', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(288, '12:28:24', '94.208.116.208', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(289, '12:29:57', '94.208.116.208', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(290, '12:30:16', '94.208.116.208', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(291, '12:37:39', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(292, '12:38:17', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(293, '12:39:17', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(294, '12:39:24', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(295, '15:05:19', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(296, '15:05:30', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(297, '15:05:45', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(298, '15:07:09', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(299, '15:08:54', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(300, '15:09:06', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(301, '15:10:17', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(302, '15:18:23', '94.208.116.208', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(303, '15:20:39', '94.208.116.208', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(304, '15:22:41', '94.208.116.208', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(305, '15:23:57', '94.208.116.208', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(306, '15:37:02', '94.208.116.208', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(307, '15:40:09', '94.208.116.208', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(308, '15:41:23', '94.208.116.208', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(309, '15:41:59', '94.208.116.208', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(310, '15:42:22', '94.208.116.208', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(311, '15:42:45', '94.208.116.208', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(312, '15:44:05', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(313, '15:44:17', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(314, '15:45:01', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(315, '15:45:08', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(316, '15:45:18', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(317, '15:45:27', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(318, '15:45:31', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(319, '15:45:38', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(320, '15:45:42', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(321, '15:45:51', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(322, '15:46:53', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(323, '15:48:10', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(324, '15:50:10', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(325, '15:50:30', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(326, '15:51:12', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(327, '15:56:37', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(328, '16:01:26', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(329, '16:04:29', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(330, '16:05:15', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(331, '16:06:22', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(332, '16:07:13', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(333, '16:08:47', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(334, '16:08:56', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(335, '16:09:02', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(336, '16:09:12', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(337, '16:09:18', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(338, '16:10:55', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(339, '16:11:53', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(340, '16:13:05', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(341, '16:13:36', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(342, '16:13:56', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(343, '16:14:32', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(344, '16:14:49', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(345, '16:15:01', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(346, '16:15:32', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(347, '16:15:44', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(348, '16:16:16', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(349, '16:16:29', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(350, '16:16:50', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(351, '16:17:10', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(352, '16:17:51', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(353, '16:20:23', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(354, '16:20:43', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(355, '16:20:52', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(356, '16:21:02', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(357, '16:23:10', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(358, '16:23:27', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(359, '16:25:52', '94.208.116.208', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-07'),
(360, '12:22:26', '94.208.116.208', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-10'),
(361, '12:25:43', '94.208.116.208', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(362, '14:07:30', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-10'),
(363, '14:08:14', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-10'),
(364, '14:09:05', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(365, '14:11:31', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(366, '14:11:41', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(367, '14:12:29', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(368, '14:16:47', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-10'),
(369, '14:17:19', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(370, '14:18:01', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(371, '14:18:36', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(372, '14:19:35', '94.208.116.208', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-10'),
(373, '14:19:50', '94.208.116.208', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(374, '14:20:10', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(375, '14:20:19', '94.208.116.208', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(376, '14:20:30', '94.208.116.208', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(377, '14:21:19', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(378, '14:21:33', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(379, '14:21:47', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(380, '14:22:29', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(381, '14:23:51', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(382, '14:25:58', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-10'),
(383, '14:26:24', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(384, '14:27:20', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(385, '14:28:57', '94.208.116.208', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-10'),
(386, '14:29:27', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(387, '14:30:21', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-10'),
(388, '14:30:31', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(389, '14:32:27', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(390, '14:32:44', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(391, '14:32:50', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(392, '14:32:56', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(393, '14:33:00', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(394, '14:33:06', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(395, '14:33:16', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(396, '14:33:51', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(397, '14:33:53', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(398, '14:34:05', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(399, '14:35:01', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(400, '14:35:20', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(401, '14:36:06', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(402, '14:41:12', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(403, '14:41:20', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(404, '14:42:01', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(405, '14:42:47', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(406, '14:42:55', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(407, '14:46:42', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(408, '14:46:54', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(409, '14:47:05', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(410, '14:47:24', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(411, '14:47:42', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(412, '14:48:30', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(413, '14:48:42', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(414, '14:48:52', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(415, '14:49:27', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-10'),
(416, '14:49:33', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(417, '14:49:59', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(418, '14:52:12', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(419, '14:52:53', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(420, '14:53:11', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(421, '14:54:19', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(422, '14:54:35', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(423, '14:54:59', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(424, '14:55:34', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-10'),
(425, '14:56:16', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(426, '14:57:42', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(427, '14:58:16', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-10'),
(428, '14:58:26', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(429, '15:02:39', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(430, '15:02:56', '94.208.116.208', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-10'),
(431, '15:03:02', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(432, '15:03:09', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(433, '15:03:18', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(434, '15:03:34', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(435, '15:03:52', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(436, '15:03:52', '94.208.116.208', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(437, '15:05:14', '94.208.116.208', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(438, '15:05:25', '94.208.116.208', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(439, '15:09:31', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(440, '15:09:43', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(441, '15:09:49', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(442, '15:10:04', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(443, '15:10:24', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(444, '15:11:08', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(445, '15:12:01', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(446, '15:16:28', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(447, '15:16:40', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(448, '15:16:55', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(449, '15:17:41', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(450, '15:18:51', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(451, '15:18:51', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(452, '15:18:51', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(453, '15:18:51', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(454, '15:18:51', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(455, '15:18:51', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(456, '15:18:51', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(457, '15:18:51', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(458, '15:18:51', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(459, '15:18:51', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(460, '15:18:51', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(461, '15:18:51', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(462, '15:18:51', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(463, '15:18:51', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(464, '15:18:51', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(465, '15:18:51', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(466, '15:18:51', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(467, '15:18:51', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(468, '15:18:51', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(469, '15:18:51', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(470, '15:18:51', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(471, '15:18:51', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(472, '15:18:51', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(473, '15:18:51', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(474, '15:18:52', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(475, '15:18:52', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(476, '15:18:52', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(477, '15:18:52', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(478, '15:18:52', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(479, '15:18:52', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(480, '15:18:52', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(481, '15:18:52', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(482, '15:18:52', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(483, '15:18:52', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(484, '15:18:52', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(485, '15:18:52', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(486, '15:18:52', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(487, '15:18:52', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(488, '15:18:52', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(489, '15:18:52', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(490, '15:18:52', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(491, '15:18:52', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(492, '15:18:52', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(493, '15:18:52', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(494, '15:18:52', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(495, '15:18:52', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(496, '15:18:52', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(497, '15:18:52', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(498, '15:18:52', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(499, '15:18:52', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(500, '15:18:52', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(501, '15:18:52', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(502, '15:18:52', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(503, '15:18:52', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(504, '15:18:52', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(505, '15:18:52', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(506, '15:18:52', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(507, '15:18:52', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(508, '15:18:52', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(509, '15:18:52', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(510, '15:18:53', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(511, '15:18:53', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(512, '15:18:53', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(513, '15:18:53', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(514, '15:18:53', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(515, '15:18:53', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(516, '15:18:53', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(517, '15:18:53', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(518, '15:18:53', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(519, '15:18:53', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(520, '15:18:53', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(521, '15:18:53', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(522, '15:18:53', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(523, '15:18:53', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(524, '15:18:53', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(525, '15:18:53', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(526, '15:18:53', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(527, '15:18:53', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(528, '15:18:53', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(529, '15:18:53', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(530, '15:18:53', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(531, '15:18:53', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(532, '15:18:53', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(533, '15:18:53', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(534, '15:18:53', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(535, '15:18:53', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(536, '15:18:53', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(537, '15:18:54', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(538, '15:18:54', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(539, '15:18:54', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(540, '15:18:54', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(541, '15:18:54', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(542, '15:18:54', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(543, '15:18:54', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(544, '15:18:54', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(545, '15:18:54', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(546, '15:18:54', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(547, '15:18:54', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(548, '15:18:54', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(549, '15:18:54', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(550, '15:18:54', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(551, '15:18:54', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(552, '15:18:54', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(553, '15:18:54', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(554, '15:18:54', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(555, '15:18:54', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(556, '15:18:54', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(557, '15:18:54', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(558, '15:18:54', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(559, '15:18:54', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(560, '15:18:54', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(561, '15:18:54', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(562, '15:18:54', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(563, '15:18:54', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(564, '15:18:54', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(565, '15:18:54', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(566, '15:18:54', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(567, '15:18:54', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(568, '15:18:54', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(569, '15:18:54', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(570, '15:18:54', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(571, '15:18:54', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(572, '15:18:54', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(573, '15:18:54', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(574, '15:18:54', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(575, '15:18:54', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(576, '15:18:54', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(577, '15:18:54', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(578, '15:18:54', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(579, '15:18:54', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(580, '15:18:54', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(581, '15:18:55', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(582, '15:18:55', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(583, '15:18:55', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(584, '15:18:55', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(585, '15:18:55', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(586, '15:18:55', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(587, '15:18:55', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(588, '15:18:55', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(589, '15:18:55', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(590, '15:18:55', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(591, '15:18:55', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(592, '15:18:55', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(593, '15:18:55', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(594, '15:18:55', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(595, '15:18:55', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(596, '15:18:55', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(597, '15:18:55', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(598, '15:18:55', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(599, '15:18:55', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(600, '15:18:55', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10');
INSERT INTO `logs` (`id`, `tijd_log`, `ip_adres`, `log`, `status`, `datum_log`) VALUES
(601, '15:18:55', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(602, '15:19:14', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(603, '15:20:17', '94.208.116.208', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-10'),
(604, '15:20:29', '94.208.116.208', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(605, '15:20:39', '94.208.116.208', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(606, '15:20:56', '94.208.116.208', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(607, '15:21:19', '94.208.116.208', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-10'),
(608, '15:21:28', '94.208.116.208', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(609, '15:21:37', '94.208.116.208', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(610, '15:22:17', '94.208.116.208', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(611, '15:23:26', '94.208.116.208', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-10'),
(612, '15:23:47', '94.208.116.208', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(613, '15:24:07', '94.208.116.208', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(614, '15:42:55', '94.208.116.208', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-10'),
(615, '15:43:02', '94.208.116.208', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(616, '15:43:13', '94.208.116.208', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(617, '15:43:27', '94.208.116.208', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(618, '15:45:04', '94.208.116.208', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-10'),
(619, '15:45:21', '94.208.116.208', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(620, '15:45:27', '94.208.116.208', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(621, '15:46:13', '94.208.116.208', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(622, '15:46:18', '94.208.116.208', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(623, '15:46:26', '94.208.116.208', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-10'),
(624, '11:19:31', '192.168.178.30', 'Beschikbaarheid toevoegen', 'Gelukt', '2014-11-11'),
(625, '11:20:58', '192.168.178.30', 'Beschikbaarheid gewijzigd', 'Gelukt', '2014-11-11'),
(626, '11:44:37', '94.208.116.208', 'Gebruiker toevoegen', 'Gelukt', '2014-11-19'),
(627, '11:46:49', '94.208.116.208', 'Gebruiker verwijderen', 'Gelukt', '2014-11-20'),
(628, '11:47:00', '94.208.116.208', 'Gebruiker gewijzigd', 'Gelukt', '2014-11-20');

-- --------------------------------------------------------

--
-- Table structure for table `log_gebruiker`
--

CREATE TABLE IF NOT EXISTS `log_gebruiker` (
`id` int(11) NOT NULL,
  `gebruiker_id` int(11) NOT NULL,
  `log_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=613 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `log_gebruiker`
--

INSERT INTO `log_gebruiker` (`id`, `gebruiker_id`, `log_id`) VALUES
(2, 1, 18),
(3, 14, 19),
(4, 14, 20),
(5, 14, 21),
(6, 14, 22),
(7, 14, 23),
(8, 14, 24),
(9, 14, 25),
(10, 14, 26),
(11, 14, 27),
(12, 14, 28),
(13, 1, 29),
(14, 8, 30),
(15, 1, 31),
(16, 14, 32),
(17, 14, 33),
(18, 14, 34),
(19, 14, 35),
(20, 14, 36),
(21, 14, 37),
(22, 14, 38),
(23, 14, 39),
(24, 14, 40),
(25, 14, 41),
(26, 14, 42),
(27, 1, 43),
(28, 1, 44),
(29, 1, 45),
(30, 1, 46),
(31, 1, 47),
(32, 1, 48),
(33, 1, 49),
(34, 1, 50),
(35, 1, 51),
(36, 1, 52),
(37, 1, 53),
(38, 1, 54),
(39, 1, 55),
(40, 1, 56),
(41, 1, 57),
(42, 1, 58),
(43, 1, 59),
(44, 1, 60),
(45, 1, 61),
(46, 1, 62),
(47, 1, 63),
(48, 1, 64),
(49, 1, 65),
(50, 1, 66),
(51, 1, 67),
(52, 1, 68),
(53, 1, 69),
(54, 14, 70),
(55, 14, 71),
(56, 14, 72),
(57, 14, 73),
(58, 14, 74),
(59, 14, 75),
(60, 14, 76),
(61, 14, 77),
(62, 14, 78),
(63, 14, 79),
(64, 1, 80),
(65, 1, 81),
(66, 1, 82),
(67, 1, 83),
(68, 1, 84),
(69, 1, 85),
(70, 1, 86),
(71, 1, 87),
(72, 1, 88),
(73, 1, 89),
(74, 1, 90),
(75, 14, 91),
(76, 14, 92),
(77, 14, 93),
(78, 14, 94),
(79, 14, 95),
(80, 1, 96),
(81, 14, 97),
(82, 14, 98),
(83, 1, 99),
(84, 1, 100),
(85, 14, 101),
(86, 1, 102),
(87, 1, 103),
(88, 1, 104),
(89, 1, 105),
(90, 14, 106),
(91, 14, 107),
(92, 1, 108),
(93, 1, 109),
(94, 1, 110),
(95, 14, 111),
(96, 1, 112),
(97, 1, 113),
(98, 1, 114),
(99, 1, 115),
(100, 1, 116),
(101, 1, 117),
(102, 1, 118),
(103, 1, 119),
(104, 1, 120),
(105, 1, 121),
(106, 14, 122),
(107, 1, 123),
(108, 1, 124),
(109, 14, 125),
(110, 14, 126),
(111, 14, 127),
(112, 14, 128),
(113, 14, 129),
(114, 14, 130),
(115, 14, 131),
(116, 14, 132),
(117, 14, 133),
(118, 14, 134),
(119, 14, 135),
(120, 14, 136),
(121, 14, 137),
(122, 8, 138),
(123, 8, 139),
(124, 8, 140),
(125, 8, 141),
(126, 8, 142),
(127, 8, 143),
(128, 8, 144),
(129, 8, 145),
(130, 1, 146),
(131, 1, 147),
(132, 1, 148),
(133, 1, 149),
(134, 1, 150),
(135, 1, 151),
(136, 1, 152),
(137, 1, 153),
(138, 1, 154),
(139, 1, 155),
(140, 1, 156),
(141, 1, 157),
(142, 1, 158),
(143, 1, 159),
(144, 1, 160),
(145, 8, 161),
(146, 14, 162),
(147, 14, 163),
(148, 1, 164),
(149, 8, 165),
(150, 14, 166),
(151, 1, 167),
(152, 1, 168),
(153, 14, 169),
(154, 1, 170),
(155, 14, 171),
(156, 1, 172),
(157, 1, 173),
(158, 1, 174),
(159, 1, 175),
(160, 1, 176),
(161, 1, 177),
(162, 1, 178),
(163, 1, 179),
(164, 1, 180),
(165, 1, 181),
(166, 1, 182),
(167, 1, 183),
(168, 1, 184),
(169, 1, 185),
(170, 1, 186),
(171, 1, 187),
(172, 14, 188),
(173, 14, 189),
(174, 14, 190),
(175, 14, 191),
(176, 14, 192),
(177, 14, 193),
(178, 14, 194),
(179, 1, 195),
(180, 14, 196),
(181, 1, 197),
(182, 14, 198),
(183, 1, 199),
(184, 1, 200),
(185, 1, 201),
(186, 1, 202),
(187, 1, 203),
(188, 1, 204),
(189, 1, 205),
(190, 1, 206),
(191, 1, 207),
(192, 1, 208),
(193, 1, 209),
(194, 14, 210),
(195, 1, 211),
(196, 1, 212),
(197, 14, 213),
(198, 14, 214),
(199, 1, 215),
(200, 14, 216),
(201, 1, 217),
(202, 1, 218),
(203, 1, 219),
(204, 1, 220),
(205, 1, 221),
(206, 1, 222),
(207, 1, 223),
(208, 1, 224),
(209, 1, 225),
(210, 1, 226),
(211, 1, 227),
(212, 1, 228),
(213, 1, 229),
(214, 14, 230),
(215, 1, 231),
(216, 14, 232),
(217, 1, 233),
(218, 1, 234),
(219, 1, 235),
(220, 1, 236),
(221, 1, 237),
(222, 1, 238),
(223, 1, 239),
(224, 1, 240),
(225, 1, 241),
(226, 1, 242),
(227, 1, 243),
(228, 1, 244),
(229, 1, 245),
(230, 1, 246),
(231, 1, 247),
(232, 1, 248),
(233, 1, 249),
(234, 1, 250),
(235, 1, 251),
(236, 14, 252),
(237, 1, 253),
(238, 14, 254),
(239, 14, 255),
(240, 14, 256),
(241, 14, 257),
(242, 14, 258),
(243, 14, 259),
(244, 14, 260),
(245, 14, 261),
(246, 1, 262),
(247, 8, 263),
(248, 14, 264),
(249, 14, 265),
(250, 14, 266),
(251, 1, 267),
(252, 1, 268),
(253, 14, 269),
(254, 1, 270),
(255, 1, 271),
(256, 1, 272),
(257, 1, 273),
(258, 1, 274),
(259, 1, 275),
(260, 1, 276),
(261, 1, 277),
(262, 1, 278),
(263, 1, 279),
(264, 1, 280),
(265, 1, 281),
(266, 1, 282),
(267, 1, 283),
(268, 1, 284),
(269, 1, 285),
(270, 1, 286),
(271, 1, 287),
(272, 14, 288),
(273, 14, 289),
(274, 14, 290),
(275, 1, 291),
(276, 1, 292),
(277, 1, 293),
(278, 1, 294),
(279, 1, 295),
(280, 1, 296),
(281, 1, 297),
(282, 1, 298),
(283, 1, 299),
(284, 1, 300),
(285, 1, 301),
(286, 14, 302),
(287, 14, 303),
(288, 14, 304),
(289, 14, 305),
(290, 14, 306),
(291, 14, 307),
(292, 14, 308),
(293, 14, 309),
(294, 14, 310),
(295, 14, 311),
(296, 1, 312),
(297, 1, 313),
(298, 1, 314),
(299, 1, 315),
(300, 1, 316),
(301, 1, 317),
(302, 1, 318),
(303, 1, 319),
(304, 1, 320),
(305, 1, 321),
(306, 1, 322),
(307, 1, 323),
(308, 1, 324),
(309, 1, 325),
(310, 1, 326),
(311, 1, 327),
(312, 1, 328),
(313, 1, 329),
(314, 1, 330),
(315, 1, 331),
(316, 1, 332),
(317, 1, 333),
(318, 1, 334),
(319, 1, 335),
(320, 1, 336),
(321, 1, 337),
(322, 1, 338),
(323, 1, 339),
(324, 1, 340),
(325, 1, 341),
(326, 1, 342),
(327, 1, 343),
(328, 1, 344),
(329, 1, 345),
(330, 1, 346),
(331, 1, 347),
(332, 1, 348),
(333, 1, 349),
(334, 1, 350),
(335, 1, 351),
(336, 1, 352),
(337, 1, 353),
(338, 1, 354),
(339, 1, 355),
(340, 1, 356),
(341, 1, 357),
(342, 1, 358),
(343, 14, 359),
(344, 14, 360),
(345, 14, 361),
(346, 1, 362),
(347, 1, 363),
(348, 1, 364),
(349, 1, 365),
(350, 1, 366),
(351, 1, 367),
(352, 1, 368),
(353, 1, 369),
(354, 1, 370),
(355, 1, 371),
(356, 14, 372),
(357, 14, 373),
(358, 1, 374),
(359, 14, 375),
(360, 14, 376),
(361, 1, 377),
(362, 1, 378),
(363, 1, 379),
(364, 1, 380),
(365, 1, 381),
(366, 1, 382),
(367, 1, 383),
(368, 1, 384),
(369, 14, 385),
(370, 1, 386),
(371, 1, 387),
(372, 1, 388),
(373, 1, 389),
(374, 1, 390),
(375, 1, 391),
(376, 1, 392),
(377, 1, 393),
(378, 1, 394),
(379, 1, 395),
(380, 1, 396),
(381, 1, 397),
(382, 1, 398),
(383, 1, 399),
(384, 1, 400),
(385, 1, 401),
(386, 1, 402),
(387, 1, 403),
(388, 1, 404),
(389, 1, 405),
(390, 1, 406),
(391, 1, 407),
(392, 1, 408),
(393, 1, 409),
(394, 1, 410),
(395, 1, 411),
(396, 1, 412),
(397, 1, 413),
(398, 1, 414),
(399, 1, 415),
(400, 1, 416),
(401, 1, 417),
(402, 1, 418),
(403, 1, 419),
(404, 1, 420),
(405, 1, 421),
(406, 1, 422),
(407, 1, 423),
(408, 1, 424),
(409, 1, 425),
(410, 1, 426),
(411, 1, 427),
(412, 1, 428),
(413, 1, 429),
(414, 14, 430),
(415, 1, 431),
(416, 1, 432),
(417, 1, 433),
(418, 1, 434),
(419, 1, 435),
(420, 14, 436),
(421, 14, 437),
(422, 14, 438),
(423, 1, 439),
(424, 1, 440),
(425, 1, 441),
(426, 1, 442),
(427, 1, 443),
(428, 1, 444),
(429, 1, 445),
(430, 1, 446),
(431, 1, 447),
(432, 1, 448),
(433, 1, 449),
(434, 1, 450),
(435, 1, 451),
(436, 1, 452),
(437, 1, 453),
(438, 1, 454),
(439, 1, 455),
(440, 1, 456),
(441, 1, 457),
(442, 1, 458),
(443, 1, 459),
(444, 1, 460),
(445, 1, 461),
(446, 1, 462),
(447, 1, 463),
(448, 1, 464),
(449, 1, 465),
(450, 1, 466),
(451, 1, 467),
(452, 1, 468),
(453, 1, 469),
(454, 1, 470),
(455, 1, 471),
(456, 1, 472),
(457, 1, 473),
(458, 1, 474),
(459, 1, 475),
(460, 1, 476),
(461, 1, 477),
(462, 1, 478),
(463, 1, 479),
(464, 1, 480),
(465, 1, 481),
(466, 1, 482),
(467, 1, 483),
(468, 1, 484),
(469, 1, 485),
(470, 1, 486),
(471, 1, 487),
(472, 1, 488),
(473, 1, 489),
(474, 1, 490),
(475, 1, 491),
(476, 1, 492),
(477, 1, 493),
(478, 1, 494),
(479, 1, 495),
(480, 1, 496),
(481, 1, 497),
(482, 1, 498),
(483, 1, 499),
(484, 1, 500),
(485, 1, 501),
(486, 1, 502),
(487, 1, 503),
(488, 1, 504),
(489, 1, 505),
(490, 1, 506),
(491, 1, 507),
(492, 1, 508),
(493, 1, 509),
(494, 1, 510),
(495, 1, 511),
(496, 1, 512),
(497, 1, 513),
(498, 1, 514),
(499, 1, 515),
(500, 1, 516),
(501, 1, 517),
(502, 1, 518),
(503, 1, 519),
(504, 1, 520),
(505, 1, 521),
(506, 1, 522),
(507, 1, 523),
(508, 1, 524),
(509, 1, 525),
(510, 1, 526),
(511, 1, 527),
(512, 1, 528),
(513, 1, 529),
(514, 1, 530),
(515, 1, 531),
(516, 1, 532),
(517, 1, 533),
(518, 1, 534),
(519, 1, 535),
(520, 1, 536),
(521, 1, 537),
(522, 1, 538),
(523, 1, 539),
(524, 1, 540),
(525, 1, 541),
(526, 1, 542),
(527, 1, 543),
(528, 1, 544),
(529, 1, 545),
(530, 1, 546),
(531, 1, 547),
(532, 1, 548),
(533, 1, 549),
(534, 1, 550),
(535, 1, 551),
(536, 1, 552),
(537, 1, 553),
(538, 1, 554),
(539, 1, 555),
(540, 1, 556),
(541, 1, 557),
(542, 1, 558),
(543, 1, 559),
(544, 1, 560),
(545, 1, 561),
(546, 1, 562),
(547, 1, 563),
(548, 1, 564),
(549, 1, 565),
(550, 1, 566),
(551, 1, 567),
(552, 1, 568),
(553, 1, 569),
(554, 1, 570),
(555, 1, 571),
(556, 1, 572),
(557, 1, 573),
(558, 1, 574),
(559, 1, 575),
(560, 1, 576),
(561, 1, 577),
(562, 1, 578),
(563, 1, 579),
(564, 1, 580),
(565, 1, 581),
(566, 1, 582),
(567, 1, 583),
(568, 1, 584),
(569, 1, 585),
(570, 1, 586),
(571, 1, 587),
(572, 1, 588),
(573, 1, 589),
(574, 1, 590),
(575, 1, 591),
(576, 1, 592),
(577, 1, 593),
(578, 1, 594),
(579, 1, 595),
(580, 1, 596),
(581, 1, 597),
(582, 1, 598),
(583, 1, 599),
(584, 1, 600),
(585, 1, 601),
(586, 1, 602),
(587, 14, 603),
(588, 14, 604),
(589, 14, 605),
(590, 14, 606),
(591, 14, 607),
(592, 14, 608),
(593, 14, 609),
(594, 14, 610),
(595, 14, 611),
(596, 14, 612),
(597, 14, 613),
(598, 14, 614),
(599, 14, 615),
(600, 14, 616),
(601, 14, 617),
(602, 14, 618),
(603, 14, 619),
(604, 14, 620),
(605, 14, 621),
(606, 14, 622),
(607, 14, 623),
(608, 1, 624),
(609, 1, 625),
(610, 14, 626),
(611, 14, 627),
(612, 14, 628);

-- --------------------------------------------------------

--
-- Table structure for table `mails`
--

CREATE TABLE IF NOT EXISTS `mails` (
`id` int(11) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `klant_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mails`
--

INSERT INTO `mails` (`id`, `mail`, `klant_id`) VALUES
(14, 'shaif@armand-it-services.nl', 2),
(15, 'Klantadres@', 14),
(18, '123@23', 8),
(19, 'mail@test.nl', 1),
(20, 'mail@123.nl', 1),
(21, 'fhxfj@gds.nl', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
`id` int(11) NOT NULL,
  `storing_id` int(11) NOT NULL,
  `beschrijving` enum('Storing is toegevoegd') NOT NULL,
  `active` enum('active','non-active') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `storing_id`, `beschrijving`, `active`) VALUES
(1, 3, 'Storing is toegevoegd', 'non-active');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE IF NOT EXISTS `options` (
`id` int(11) NOT NULL,
  `name` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `value` longtext CHARACTER SET utf8,
  `logo` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `logo_dir` varchar(255) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `name`, `value`, `logo`, `logo_dir`) VALUES
(1, 'title', '', NULL, NULL),
(2, 'rows', '15', NULL, NULL),
(3, 'email', 'admin@zhen-calendar.com', NULL, NULL),
(4, 'email_title', 'Zhen-Calendar', NULL, NULL),
(5, 'currency', '$', NULL, NULL),
(6, 'show_copyright', '0', NULL, NULL),
(7, 'copyright', 'Copyright &copy; ', 'logonieuw.png', ''),
(8, 'max_recurrence_days', '90', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `producten`
--

CREATE TABLE IF NOT EXISTS `producten` (
`id` int(11) NOT NULL,
  `naam` varchar(50) NOT NULL,
  `beschrijving` text NOT NULL,
  `prijs` int(11) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `voorraad` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `producten`
--

INSERT INTO `producten` (`id`, `naam`, `beschrijving`, `prijs`, `foto`, `voorraad`) VALUES
(2, 'test', 'een test product', 10, '', 39),
(3, 'Windows 7 ', '- Installeren van Windows 7 - Updaten van Windows 7', 70, '', 46),
(4, 'test2', 'lijn1 \r\nlijn 2', 20, '', 48),
(5, 'windows 8', 'OS', 50, 'windows 8.jpg', 49),
(6, 'Antivirus', 'Antivirus installeren.\r\n\r\n', 20, '', 49),
(7, 'Volkswagen Golf GTD ', '2.0 Motor\r\n TDI 184 PK DSG Xenon-Plu\r\n48.789 km Bouwjaar 07-2013\r\nAPK geldig tot30-07-2016\r\nBrandstof Diesel\r\nVerbruik 21,3 km per liter\r\nCarrosserievorm Hatchback\r\nAantal deuren 5 \r\nTransmissie Automaat\r\nUitvoering : ABT.\r\nKortom gewoon een goeie sportieve bak \r\n', 39800, 'Volkswagen Golf GTD .jpg', 50);

-- --------------------------------------------------------

--
-- Table structure for table `recurrings`
--

CREATE TABLE IF NOT EXISTS `recurrings` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  `starts_on` datetime NOT NULL,
  `ends_on` datetime NOT NULL,
  `repeat_type` varchar(255) NOT NULL,
  `repeat_frequency` int(11) NOT NULL,
  `repeat_on` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
`id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Regular');

-- --------------------------------------------------------

--
-- Table structure for table `servers`
--

CREATE TABLE IF NOT EXISTS `servers` (
`id` int(11) NOT NULL,
  `naam` varchar(30) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `inlognaam` varchar(50) NOT NULL,
  `wachtwoord` varchar(50) NOT NULL,
  `klant_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `servers`
--

INSERT INTO `servers` (`id`, `naam`, `ip`, `inlognaam`, `wachtwoord`, `klant_id`) VALUES
(1, 'printer', '1.65.5.1', 'gn', 'ww', 8),
(2, 'printer', '165165.562156.1256', 'dfad', 'sfsfg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
`id` int(11) NOT NULL,
  `standaardwachtwoord` varchar(200) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `standaardwachtwoord`) VALUES
(1, 'HØØ°	[+D³yhR#');

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE IF NOT EXISTS `statuses` (
`id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `name`) VALUES
(1, 'Invited'),
(2, 'Accepted'),
(3, 'Declined'),
(4, 'Tentative');

-- --------------------------------------------------------

--
-- Table structure for table `storingen`
--

CREATE TABLE IF NOT EXISTS `storingen` (
`id` int(11) NOT NULL,
  `titel` varchar(255) NOT NULL,
  `omschrijving` text NOT NULL,
  `start_datum` date NOT NULL,
  `eind_datum` date NOT NULL,
  `status` enum('Lopend','Opgelost') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `storingen`
--

INSERT INTO `storingen` (`id`, `titel`, `omschrijving`, `start_datum`, `eind_datum`, `status`) VALUES
(3, 'Storing webserver', 'testtesttttt ', '2014-09-19', '2014-09-20', 'Opgelost'),
(4, 'test', 'test1123 ', '2014-09-10', '2014-09-19', 'Opgelost'),
(5, 'Data center Failure', 'onze datacenter heeft een backup failure deze wordt naar verwachting morgen gerepareerd \r\nOns excuses voor deze hindering..\r\n\r\n\r\n~Het Armand IT Thuisfront ', '2014-09-18', '2014-09-19', 'Opgelost'),
(11, 'Dsasas', ' dsa', '2014-10-04', '2014-10-06', 'Opgelost');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE IF NOT EXISTS `tickets` (
`id` int(11) NOT NULL,
  `aankomst` varchar(5) NOT NULL,
  `vertrek` varchar(5) NOT NULL,
  `klant_id` int(11) NOT NULL,
  `gebruiker_id` int(11) NOT NULL,
  `aangemaakt_gebruiker_id` int(11) NOT NULL,
  `opmerking` text NOT NULL,
  `aanmaak_datum` date NOT NULL,
  `afspraak_datum` date NOT NULL,
  `bezoek_datum` date DEFAULT NULL,
  `sluit_datum` date DEFAULT NULL,
  `status` enum('open','gesloten') NOT NULL,
  `rapport` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `aankomst`, `vertrek`, `klant_id`, `gebruiker_id`, `aangemaakt_gebruiker_id`, `opmerking`, `aanmaak_datum`, `afspraak_datum`, `bezoek_datum`, `sluit_datum`, `status`, `rapport`) VALUES
(41, '12:00', '14:00', 1, 1, 1, 'Verjaardag', '1970-01-01', '2014-10-21', '2014-10-21', NULL, 'open', ''),
(44, '13:00', '14:00', 13, 14, 1, 'Test123123123', '1970-01-01', '2014-10-21', '2014-10-21', NULL, 'open', ''),
(45, '15:10', '16:00', 1, 8, 8, 'wifi aansluiten', '1970-01-01', '2014-10-21', '2014-10-21', NULL, 'open', ''),
(46, '15:15', '16:16', 1, 14, 14, 'Hoi', '1970-01-01', '2014-10-24', '2014-10-25', NULL, 'open', ''),
(48, '16:20', '16:50', 1, 0, 1, 'test', '1970-01-01', '2014-10-27', '2014-10-27', NULL, 'open', ''),
(49, '16:20', '16:50', 1, 0, 1, 'test', '1970-01-01', '2014-10-27', '2014-10-27', NULL, 'open', ''),
(50, '16:20', '16:50', 1, 0, 1, 'test', '1970-01-01', '2014-10-27', '2014-10-27', NULL, 'open', ''),
(52, '16:30', '17:30', 1, 0, 1, 'Test aanmaakdatum', '2014-10-27', '2014-10-27', '2014-10-27', NULL, 'open', ''),
(53, '16:30', '17:30', 1, 0, 1, 'Test aanmaakdatum', '2014-10-27', '2014-10-27', '2014-10-27', NULL, 'open', ''),
(54, '16:30', '17:30', 1, 0, 1, 'Test aanmaakdatum', '2014-10-27', '2014-10-27', '2014-10-27', NULL, 'open', ''),
(55, '16:30', '17:30', 1, 0, 1, 'Test aanmaakdatum', '2014-10-27', '2014-10-27', '2014-10-27', NULL, 'open', ''),
(57, '16:30', '17:30', 1, 0, 1, 'Test aanmaakdatum', '2014-10-27', '2014-10-27', '2014-10-27', NULL, 'open', ''),
(58, '16:30', '17:30', 1, 0, 1, 'Test aanmaakdatum', '2014-10-27', '2014-10-27', '2014-10-27', NULL, 'open', ''),
(59, '16:30', '17:30', 1, 0, 1, 'Test aanmaakdatum', '2014-10-27', '2014-10-27', '2014-10-27', NULL, 'open', '');

-- --------------------------------------------------------

--
-- Table structure for table `uren`
--

CREATE TABLE IF NOT EXISTS `uren` (
`id` int(11) NOT NULL,
  `beschikbaarheid_id` int(11) NOT NULL,
  `uurVan` time DEFAULT NULL,
  `uurTot` time DEFAULT NULL,
  `status` enum('Beschikbaar','Niet beschikbaar') NOT NULL,
  `datum` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=294 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `uren`
--

INSERT INTO `uren` (`id`, `beschikbaarheid_id`, `uurVan`, `uurTot`, `status`, `datum`) VALUES
(279, 76, '14:32:19', '21:48:41', 'Beschikbaar', '2014-11-10'),
(280, 76, NULL, NULL, 'Niet beschikbaar', '2014-11-11'),
(281, 76, '05:14:18', '14:43:30', 'Beschikbaar', '2014-11-12'),
(282, 76, NULL, NULL, 'Niet beschikbaar', '2014-11-13'),
(283, 76, NULL, NULL, 'Niet beschikbaar', '2014-11-14'),
(284, 76, NULL, NULL, 'Niet beschikbaar', '2014-11-15'),
(285, 76, NULL, NULL, 'Niet beschikbaar', '2014-11-16'),
(286, 77, '08:00:00', '16:30:00', 'Beschikbaar', '2014-11-17'),
(287, 77, NULL, NULL, 'Niet beschikbaar', '2014-11-18'),
(288, 77, NULL, NULL, 'Niet beschikbaar', '2014-11-19'),
(289, 77, NULL, NULL, 'Niet beschikbaar', '2014-11-20'),
(290, 77, NULL, NULL, 'Niet beschikbaar', '2014-11-21'),
(291, 77, NULL, NULL, 'Niet beschikbaar', '2014-11-22'),
(292, 77, NULL, NULL, 'Niet beschikbaar', '2014-11-23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `password` char(50) CHARACTER SET utf8 NOT NULL,
  `first_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `last_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo_dir` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `phone` text CHARACTER SET utf8,
  `color` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `token` char(50) CHARACTER SET utf8 DEFAULT NULL,
  `active` tinyint(1) DEFAULT '0',
  `is_resource` tinyint(1) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `username`, `password`, `first_name`, `last_name`, `photo`, `photo_dir`, `email`, `phone`, `color`, `token`, `active`, `is_resource`, `created`, `modified`) VALUES
(1, 1, 'admin', 'b4e0e278d602c6d194d04a97e21b435128684e84', 'Admin', 'AIS', 'volkswagen-golf-7-gtd-tuned-to-210-hp-by-abt-60125_1.jpg', '1', 'info@armand-it-services.nl', NULL, '800080', NULL, 1, 0, '2014-01-23 10:30:12', '2014-10-17 10:46:05'),
(2, 1, 'Necati', 'c23a78e2981c436c1a5ddc7787990b6a90fbbfbd', 'Necati', 'Unal', 'Penguins.jpg', '2', 'Necati@armand-it-services.nl', NULL, '0095ff', '8cc749f0a06d0c15a960a7889abefded3157f16a', 1, 0, '2014-10-08 12:19:25', '2014-10-20 12:30:16'),
(3, 1, 'Shaif', 'c3fb3a61e916fed09e58b1de1296deeb599c0c01', 'Shaif', 'Moesai', 'Lighthouse.jpg', '3', 'Shaif@armand-it-services.nl', NULL, '00d619', NULL, 1, 0, '2014-10-08 12:20:36', '2014-10-08 12:35:36'),
(4, 1, 'Armand', '6b77d4a6ba798578a1c57ea7d816d7437e682a48', 'Armand', 'Dharamsigh', 'Penguins.jpg', '4', 'Armand@armand-it-services.nl', NULL, 'ffb300', NULL, 1, 0, '2014-10-08 12:22:32', '2014-10-08 12:22:32'),
(6, 1, 'Stefano', 'dab1f9ec91d8e5158028bc667dff312d7133716c', 'Stefano', 'Groenland', 'volkswagen-golf-7-gtd-tuned-to-210-hp-by-abt-60125_1.jpg', '6', 'stefano@armand-it-services.nl', NULL, 'ff0037', NULL, 1, 0, '2014-10-08 12:44:49', '2014-10-08 14:16:25'),
(7, 0, NULL, '2d55aba0fc075869f5df16836c1b54c7d0798722', 'test', '', NULL, '', NULL, NULL, 'ff0000', NULL, 0, 1, '2014-10-17 10:36:15', '2014-10-17 13:43:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `beschikbaarheid`
--
ALTER TABLE `beschikbaarheid`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `escalaties`
--
ALTER TABLE `escalaties`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events_users`
--
ALTER TABLE `events_users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `facturen`
--
ALTER TABLE `facturen`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gebruikers`
--
ALTER TABLE `gebruikers`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `gebruikersnaam` (`gebruikersnaam`), ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `kalender`
--
ALTER TABLE `kalender`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `klanten`
--
ALTER TABLE `klanten`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_gebruiker`
--
ALTER TABLE `log_gebruiker`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mails`
--
ALTER TABLE `mails`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `storing_id` (`storing_id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `producten`
--
ALTER TABLE `producten`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recurrings`
--
ALTER TABLE `recurrings`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `servers`
--
ALTER TABLE `servers`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `storingen`
--
ALTER TABLE `storingen`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uren`
--
ALTER TABLE `uren`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `beschikbaarheid`
--
ALTER TABLE `beschikbaarheid`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=79;
--
-- AUTO_INCREMENT for table `escalaties`
--
ALTER TABLE `escalaties`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `events_users`
--
ALTER TABLE `events_users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `facturen`
--
ALTER TABLE `facturen`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `gebruikers`
--
ALTER TABLE `gebruikers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `kalender`
--
ALTER TABLE `kalender`
MODIFY `id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `klanten`
--
ALTER TABLE `klanten`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=629;
--
-- AUTO_INCREMENT for table `log_gebruiker`
--
ALTER TABLE `log_gebruiker`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=613;
--
-- AUTO_INCREMENT for table `mails`
--
ALTER TABLE `mails`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `producten`
--
ALTER TABLE `producten`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `recurrings`
--
ALTER TABLE `recurrings`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `servers`
--
ALTER TABLE `servers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `storingen`
--
ALTER TABLE `storingen`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `uren`
--
ALTER TABLE `uren`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=294;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
