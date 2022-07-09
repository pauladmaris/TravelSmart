-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1:3306
-- Timp de generare: iun. 05, 2022 la 03:46 PM
-- Versiune server: 5.7.31
-- Versiune PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `travelsmart`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `cities`
--

DROP TABLE IF EXISTS `cities`;
CREATE TABLE IF NOT EXISTS `cities` (
  `id_city` int(10) NOT NULL AUTO_INCREMENT,
  `location` varchar(255) NOT NULL,
  `link` text NOT NULL,
  `food` varchar(255) NOT NULL,
  `image_food` varchar(255) NOT NULL,
  `weather` text NOT NULL,
  `attraction1` varchar(255) NOT NULL,
  `image_attraction1` varchar(255) NOT NULL,
  `attraction2` varchar(255) NOT NULL,
  `image_attraction2` varchar(255) NOT NULL,
  `link_food` text NOT NULL,
  `link_attraction1` text NOT NULL,
  `link_attraction2` text NOT NULL,
  PRIMARY KEY (`id_city`),
  UNIQUE KEY `id_city` (`id_city`),
  UNIQUE KEY `name` (`location`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

--
-- Eliminarea datelor din tabel `cities`
--

INSERT INTO `cities` (`id_city`, `location`, `link`, `food`, `image_food`, `weather`, `attraction1`, `image_attraction1`, `attraction2`, `image_attraction2`, `link_food`, `link_attraction1`, `link_attraction2`) VALUES
(3, 'London', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d317715.7119479623!2d-0.3817876852262071!3d51.528735194467!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47d8a00baf21de75%3A0x52963a5addd52a99!2sLondra%2C%20Regatul%20Unit!5e0!3m2!1sro!2sus!4v1637761557256!5m2!1sro!2sus', 'Shepherd\'s Pie', '1833916298sheperdspie.jpg', 'https://forecast7.com/en/51d51n0d13/london/', 'Sky Garden', '1672307691Rhubarb-at-Sky-Garden-Web-Sized80-e1579531588784.jpg', 'The Shard', '869696228the-view-from-the-28144456.jpg', 'https://foursquare.com/v/the-ivy-restaurant/4b5344aef964a5200c9527e3', 'https://skygarden.london/', 'https://www.the-shard.com/'),
(9, 'Paris', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d83998.76457390038!2d2.2769946350180423!3d48.85894658162367!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e1f06e2b70f%3A0x40b82c3688c9460!2zUGFyaXMsIEZyYW7Fo2E!5e0!3m2!1sro!2sus!4v1637762381533!5m2!1sro!2sus', 'Onion Soup', '555770524soupe_a_loignon.jpg', 'https://forecast7.com/en/48d862d35/paris/', 'Tour Eiffel', '960070015fdb_1468495187_franta.jpg', 'Disneyland', '1059496725PARIS.jpg', 'https://brasserieflottes.fr/en', 'https://www.toureiffel.paris/en', 'https://www.disneylandparis.com/en-us/'),
(12, 'Istanbul', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d385395.55901679577!2d28.731982563206422!3d41.00550051760836!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14caa7040068086b%3A0xe1ccfe98bc01b0d0!2sIstanbul%2C%20Provincia%20Istanbul%2C%20Turcia!5e0!3m2!1sro!2sus!4v1637764528250!5m2!1sro!2sus', 'Balik Ekmek', '289245388image.jpg', 'https://forecast7.com/en/41d0128d98/istanbul/', 'Topkapi Palace', '137907127181812a1d-970f-4a58-a7a8-08d3f65f9999-istock-641112990.jpg', 'Grand Bazaar', '641036299istockphoto-545274714-1024x1024.jpg', 'https://www.tripadvisor.com/Restaurant_Review-g293974-d8018368-Reviews-Emin_Usta_Balicisi-Istanbul.html', 'https://www.topkapipalace-tickets.com/about-topkapi-palace-istanbul/', 'https://www.planetware.com/turkey/istanbul-grand-bazaar-things-to-buy-shopping-tips-tr-1-27.htm'),
(15, 'Tel Aviv', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d108169.74093037478!2d34.72720498250352!3d32.08805767600378!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151d4ca6193b7c1f%3A0xc1fb72a2c0963f90!2sTel%20Aviv%2C%20Israel!5e0!3m2!1sro!2sus!4v1637796202837!5m2!1sro!2sus', 'Shakshuka', '1003838574shakshouka-1200x1200-1.jpg', 'https://forecast7.com/en/32d0934d78/tel-aviv-yafo/', 'Haifa', '1504863831unnamed (1).jpg', 'Jaffa', '93926265old-city-jaffa-tel-aviv-israel_87533-14.jpg', 'https://foursquare.com/v/shakshukia-%D7%A9%D7%A7%D7%A9%D7%95%D7%A7%D7%99%D7%94/50d9e03a183f6f41dd77ad8d', 'https://www.touristisrael.com/haifa/33404/', 'https://www.touristisrael.com/jaffa-yafo-tel-aviv/360/'),
(22, 'Hurghada', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d454251.2275826222!2d33.501506955308976!3d27.19283691413061!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x145287b2cd3dbbb3%3A0x2db807f98bd3c360!2sHurghada%2C%20Guvernoratul%20Al%20Bahr%20al%20Ahmar%2C%20Egipt!5e0!3m2!1sro!2sro!4v1638029802539!5m2!1sro!2sro', 'Bamia', '1670532967bamia.jpg', 'https://forecast7.com/en/27d2633d81/hurghada/', 'Sindbad Submarine', '1025867890egypt-hurghada-red-sea-coral-life.jpg', 'Valley of the Kings', '886869789egypt-valley-of-the-king-entrance-walkway.jpg', 'https://www.tripadvisor.co.uk/Restaurant_Review-g297549-d2731619-Reviews-El_Dar_Darak_Restaurant-Hurghada_Red_Sea_and_Sinai.html', 'https://www.getyourguide.com/hurghada-l403/sindbad-submarine-hurghada-t35034/?partner=true', 'https://www.getyourguide.com/hurghada-l403/valley-of-the-kings-luxor-day-trip-from-hurghada-t22357/'),
(23, 'Cluj-Napoca', '', '', '', '', '', '', '', '', '', '', ''),
(30, 'Cappadocia', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1601548.3199929052!2d33.94559346849623!3d38.371564793053956!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14d6025c679e1679%3A0xf9178b7341dc5e49!2sCappadocia%2C%20Turcia!5e0!3m2!1sro!2sro!4v1641220964107!5m2!1sro!2sro', 'Pottery Kebab', '8923011865722187265202673e05db148ce02358a.jpg', 'https://forecast7.com/en/38d6434d83/goreme/', 'Horse riding', '1370422251cappadocia-horse-riding-tour-1.jpg', 'Cavusin village', '1531612258unnamed (2).jpg', 'https://www.willflyforfood.net/pottery-kebab-a-must-try-dish-in-cappadocia-turkey/', 'https://excursionmania.com/excursions/cappadocia-horse-riding/', 'http://www.freelancetravelturkey.com/tr/turkiye/11/cappadocia/cavusin-village----old-greek-town-.html'),
(35, 'Malmo', '', '', '', '', '', '', '', '', '', '', ''),
(50, 'Bhutan', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `favposts`
--

DROP TABLE IF EXISTS `favposts`;
CREATE TABLE IF NOT EXISTS `favposts` (
  `id_fav` int(10) NOT NULL AUTO_INCREMENT,
  `unique_id` int(255) NOT NULL,
  `id_post` int(10) NOT NULL,
  PRIMARY KEY (`id_fav`),
  UNIQUE KEY `id_fav` (`id_fav`),
  UNIQUE KEY `unique_id` (`unique_id`,`id_post`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8;

--
-- Eliminarea datelor din tabel `favposts`
--

INSERT INTO `favposts` (`id_fav`, `unique_id`, `id_post`) VALUES
(48, 131835417, 131),
(99, 518523683, 129),
(100, 518523683, 161),
(97, 518523683, 177),
(53, 576803379, 125),
(40, 613226174, 109),
(43, 613226174, 110),
(41, 613226174, 115),
(50, 732422158, 131),
(54, 758585654, 125),
(76, 992869442, 123),
(51, 992869442, 126),
(86, 992869442, 129),
(81, 992869442, 131),
(80, 992869442, 152),
(77, 992869442, 160),
(78, 992869442, 161),
(44, 1088531562, 118),
(93, 1318639352, 152),
(95, 1318639352, 179);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `group_messages`
--

DROP TABLE IF EXISTS `group_messages`;
CREATE TABLE IF NOT EXISTS `group_messages` (
  `id_group_msg` int(10) NOT NULL AUTO_INCREMENT,
  `location` varchar(255) NOT NULL,
  `unique_id_msg` int(255) NOT NULL,
  `msg` varchar(1000) NOT NULL,
  PRIMARY KEY (`id_group_msg`),
  KEY `unique_id_msg` (`unique_id_msg`),
  KEY `location` (`location`)
) ENGINE=MyISAM AUTO_INCREMENT=110 DEFAULT CHARSET=utf8;

--
-- Eliminarea datelor din tabel `group_messages`
--

INSERT INTO `group_messages` (`id_group_msg`, `location`, `unique_id_msg`, `msg`) VALUES
(86, 'Paris', 758585654, 'Bonjour Paris lovers'),
(93, 'Hurghada', 758585654, 'Welcoome, what do you love the most about Hurghada?'),
(94, 'Hurghada', 992869442, 'EVERYTHING!!'),
(95, 'Paris', 992869442, 'Bonjour!!'),
(96, 'Hurghada', 830133148, 'Hello girls :D'),
(97, 'Cappadocia', 393674638, 'Let\'s chat about Cappadocia'),
(98, 'Hurghada', 393674638, 'hei hei'),
(99, 'Hurghada', 393674638, 'eu sunt Monica si am fost in Hurghada'),
(109, 'London', 518523683, ';)'),
(108, 'London', 992869442, 'God Save the Queen'),
(107, 'Hurghada', 992869442, 'eu nu :(');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `incoming_msg_id` int(255) NOT NULL,
  `outgoing_msg_id` int(255) NOT NULL,
  `msg` varchar(1000) NOT NULL,
  PRIMARY KEY (`msg_id`),
  UNIQUE KEY `msg_id` (`msg_id`),
  KEY `incoming_msg_id` (`incoming_msg_id`),
  KEY `outgoing_msg_id` (`outgoing_msg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=149 DEFAULT CHARSET=utf8;

--
-- Eliminarea datelor din tabel `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`) VALUES
(1, 1342155369, 404514531, 'hei'),
(2, 1342155369, 404514531, 'cf'),
(3, 1342155369, 404514531, 'yo'),
(4, 555167603, 404514531, 'cf'),
(5, 555167603, 404514531, 'je suis sana'),
(6, 555167603, 404514531, 'toi?'),
(7, 786795895, 341331807, 'cf'),
(8, 786795895, 341331807, 'hello'),
(9, 341331807, 786795895, 'bonjour'),
(10, 341331807, 786795895, 'hola'),
(11, 786795895, 341331807, 'YAAAAAAAS MERGE'),
(12, 404514531, 341331807, 'holaaaaaaa'),
(36, 786795895, 1088531562, 'heeeeeiiiiii cfff'),
(37, 786795895, 1088531562, 'deeeeeeeeeeeeeeeeeeeeeeeeeeeef'),
(38, 1088531562, 555167603, 'hei girl'),
(39, 1088531562, 555167603, 'commo estas?'),
(53, 404514531, 1088531562, 'heeeeeeeeeeei'),
(54, 786795895, 1088531562, 'hei'),
(65, 404514531, 555167603, 'bien'),
(66, 404514531, 555167603, 'tres bien'),
(70, 1088531562, 555167603, 'hei'),
(71, 786795895, 341331807, 'uhu'),
(72, 404514531, 341331807, 'uu'),
(73, 341331807, 1088531562, 'HEEI'),
(77, 1088531562, 341331807, 'HEEEEIII MAVI'),
(78, 341331807, 1088531562, 'hei si tie'),
(84, 404514531, 1088531562, 'hei'),
(85, 341331807, 1088531562, 'send'),
(86, 341331807, 705510127, 'first message'),
(87, 705510127, 705510127, 'erfgv'),
(88, 705510127, 1088531562, 'firsrttttt'),
(89, 341331807, 1342155369, 'WHAT?'),
(90, 404514531, 341331807, 'guh'),
(97, 705510127, 453248373, 'hello'),
(98, 341331807, 453248373, 'this is anda'),
(99, 705510127, 453248373, 'again'),
(100, 1088531562, 453248373, 'hei Mavi'),
(101, 1088531562, 453248373, 'hg'),
(102, 404514531, 341331807, 'hi'),
(103, 705510127, 1088531562, 'hei'),
(104, 453248373, 1088531562, 'uhu'),
(105, 453248373, 1088531562, 'merge'),
(106, 453248373, 1088531562, 'aleluia'),
(107, 1088531562, 186275179, 'hey'),
(108, 1088531562, 186275179, 'n'),
(109, 186275179, 1088531562, 'm nl'),
(110, 453248373, 1088531562, 'bgvjbk'),
(111, 453248373, 1088531562, 'hei'),
(112, 1088531562, 613226174, 'Buna'),
(113, 186275179, 613226174, 'Hei Ana'),
(114, 1088531562, 613226174, 'hei again'),
(118, 453248373, 613226174, 'hei'),
(119, 186275179, 613226174, 'Pa Ana'),
(120, 453248373, 613226174, 'paa'),
(125, 844862693, 758585654, 'hola'),
(126, 844862693, 1058797620, 'hei'),
(127, 992869442, 1329968458, 'Hei Mavi!!!!'),
(128, 1329968458, 992869442, 'vbg'),
(129, 992869442, 758585654, 'Ce faci?'),
(130, 1318639352, 992869442, 'Buna seara'),
(131, 1318639352, 992869442, '13 dec'),
(132, 1318639352, 992869442, '22 dec'),
(133, 1318639352, 576803379, 'It\'s 03/01/2022'),
(134, 407116841, 992869442, 'Hey you'),
(135, 1318639352, 992869442, '16 febr'),
(136, 1016847720, 830133148, 'I love traveling'),
(137, 1318639352, 992869442, '17 febr'),
(138, 992869442, 830133148, 'it\'s 20 febr'),
(139, 393674638, 758585654, 'bonjour'),
(140, 758585654, 393674638, 'Hola'),
(141, 992869442, 393674638, 'Buna'),
(142, 758585654, 992869442, 'Bine'),
(143, 393674638, 992869442, 'Hei'),
(144, 393674638, 992869442, 'este 9 mai'),
(145, 576803379, 1318639352, 'now it\'s 25/05/2022'),
(146, 992869442, 1318639352, 'hei'),
(147, 393674638, 518523683, 'hei, eu sunt Lara'),
(148, 830133148, 518523683, 'hi Raul!');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id_post` int(10) NOT NULL AUTO_INCREMENT,
  `comment` longtext NOT NULL,
  `location` varchar(255) NOT NULL,
  `photo_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `tag` enum('transport','food','hotel','attraction') NOT NULL,
  `person_type` enum('traveler','local') NOT NULL,
  `unique_id` int(255) NOT NULL,
  PRIMARY KEY (`id_post`),
  KEY `unique_id` (`unique_id`)
) ENGINE=InnoDB AUTO_INCREMENT=191 DEFAULT CHARSET=utf8;

--
-- Eliminarea datelor din tabel `posts`
--

INSERT INTO `posts` (`id_post`, `comment`, `location`, `photo_name`, `username`, `date`, `tag`, `person_type`, `unique_id`) VALUES
(129, 'The Paris Visite travel card allows unlimited use of the transport system in Paris: Metro, Bus, RER, Tramway, Orlyval, Montmartrobus, Noctilien and Montmartre funicular. It\'s worth purchasing if youâ€™re staying in Paris only for a couple of days, going to Disneyland, or if you would like to get to the airport by public transport.   ', 'Paris', '1451563829p18llble3u6r0bqedns102110mg6.jpg', 'ana', '07 Nov, 2021', 'transport', 'traveler', 1318639352),
(130, 'Perfect way to move from one side to another of the ever increasing Istanbul!\r\nAs this time we stayed on the Asian side to be with friends, the Ferry is the easiest and cheaper way to move from and to Sultanahmet or BeyoÄŸlu and enjoy the marvels of Istanbul. Also the view that you get is amazing!     ', 'Istanbul', '18300931116baa5cc-bccf-4e67-9483-c50d9f18380e-2060x1471.jpeg', 'mavi', '07 Nov, 2021', 'transport', 'local', 992869442),
(131, 'London is very nicee!            ', 'London', '462178839london-aerial-cityscape-river-thames_1.jpg', 'alisia', '07 Nov, 2021', 'attraction', 'traveler', 758585654),
(149, 'We had a fabulous weekend at the Savoy Hotel Sea Side. I would give it 10 stars!    ', 'Tel Aviv', '741502749Tel-Aviv-a-cidade-mais-dog-friendly-capa.jpg', 'mavi', '24 Nov, 2021', 'hotel', 'traveler', 992869442),
(150, 'Karpaten Agency is the best if you want to visit Hurghada!     ', 'Hurghada', '2120933944unnamed.jpg', 'mavi', '28 Nov, 2021', 'transport', 'local', 992869442),
(152, 'Wonderland Cluj Resort is the only place in Romania where you can find Hot Air Balloon.   ', 'Cluj-Napoca', '5215438942-819x1024.jpg', 'alisia', '28 Nov, 2021', 'transport', 'local', 758585654),
(159, 'The Yunak Evleri hotel is located in Urgup, a beautiful town not too far from other sights. People are really nice, polite, a lot of restaurants nearby. I\'d like to come back soon.   ', 'Cappadocia', '53153084764508ed29b390daae5f5546a7980c7b4.jpg', 'mona', '03 Jan, 2022', 'hotel', 'traveler', 393674638),
(160, 'Ibis London Wembley: great location! It\'s just around the corner from the arena and the stadium a short walk. Perfect for an overnight stay.     ', 'London', '206935016058871154.jpg', 'alisia', '21 Feb, 2022', 'hotel', 'local', 758585654),
(161, 'This is a bubblewrap from Street Food in Chinatown.\r\nIt\'s a MUST!!!           ', 'London', '1828974034bubblewrap3.jpg', 'raul', '21 Feb, 2022', 'food', 'traveler', 830133148),
(190, 'The mountains of Bhutan are some of the most prominent natural geographic features of the kingdom. Located on the southern end of the Eastern Himalaya, Bhutan has one of the most rugged mountain terrains in the world, whose elevations range from 160 metres to more than 7,000 metres above sea level. ', 'Thimphu', '2054114167c05fa283-4e5b-40db-b92b-34ddc71fce5a-Bhutan_large.jpg', 'mavi', '05 Jun, 2022', 'attraction', 'traveler', 992869442);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `unique_id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `user_type` int(1) NOT NULL,
  `confirmation` varchar(255) NOT NULL,
  PRIMARY KEY (`unique_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Eliminarea datelor din tabel `users`
--

INSERT INTO `users` (`unique_id`, `username`, `password`, `email`, `firstname`, `user_type`, `confirmation`) VALUES
(131835417, 'maya13', '202cb962ac59075b964b07152d234b70', 'maya@gmail.com', 'Maya', 0, 'true'),
(393674638, 'mona', '202cb962ac59075b964b07152d234b70', 'moni.paula@yahoo.com', 'Mona', 0, 'true'),
(407116841, 'sizi', '202cb962ac59075b964b07152d234b70', 'sizi@yahoo.com', 'Sizi', 0, 'true'),
(518523683, 'lara', '202cb962ac59075b964b07152d234b70', 'lara@yahoo.com', 'lara', 0, 'true'),
(576803379, 'liana99', '202cb962ac59075b964b07152d234b70', 'liana123@yahoo.com', 'Liana', 0, 'true'),
(603453658, 'admin_deniz', '202cb962ac59075b964b07152d234b70', 'pauladmaris@gmail.com', 'Denisa', 1, 'true'),
(732422158, 'maya', '202cb962ac59075b964b07152d234b70', 'maya@yahoo.com', 'Maya', 0, 'true'),
(758585654, 'alisia', '202cb962ac59075b964b07152d234b70', 'alisia@yahoo.com', 'Alisia', 0, 'true'),
(830133148, 'raul', '202cb962ac59075b964b07152d234b70', 'raulcraciun26@gmail.com', 'Raul', 0, 'true'),
(992869442, 'mavi', '202cb962ac59075b964b07152d234b70', 'mavi@yahoo.com', 'Mavi', 0, 'true'),
(1016847720, 'sara', '202cb962ac59075b964b07152d234b70', 'sara@yahoo.com', 'Sara', 0, 'true'),
(1318639352, 'ana', '202cb962ac59075b964b07152d234b70', 'ana@yahoo.com', 'Anna', 0, 'true');

--
-- Constrângeri pentru tabele eliminate
--

--
-- Constrângeri pentru tabele `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`unique_id`) REFERENCES `users` (`unique_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
