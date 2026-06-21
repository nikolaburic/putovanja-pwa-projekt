-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 21, 2026 at 03:01 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `putovanja`
--

-- --------------------------------------------------------

--
-- Table structure for table `destinacije`
--

CREATE TABLE `destinacije` (
  `id` int(11) NOT NULL,
  `datum` date NOT NULL,
  `naslov` varchar(100) NOT NULL,
  `sazetak` text NOT NULL,
  `tekst` text NOT NULL,
  `slika` varchar(100) NOT NULL,
  `kategorija` varchar(50) NOT NULL,
  `arhiva` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `destinacije`
--

INSERT INTO `destinacije` (`id`, `datum`, `naslov`, `sazetak`, `tekst`, `slika`, `kategorija`, `arhiva`) VALUES
(1, '2026-06-15', 'Paris', 'Paris, grad zaljubljenih', 'Pariz (fra. Paris [paʁi]) je glavni i najveći grad Francuske. Smješten je na obalama rijeke Seine u sjevernoj Francuskoj, u središtu pokrajine Île-de-France, također poznate kao \"Pariška regija\" (fra. Région parisienne). Stanovništvo grada Pariza, u svojim od 1860. uvelike nepromijenjenim granicama, procjenjuje se na 2 102 650 (2023.), ali metropolitansko područje (aire urbaine) naseljava više od 11 milijuna stanovnika,[3] kao najnaseljenije metropolitansko područje u Eurozoni.', 'europa.jpeg', 'Europa', 0),
(2, '2026-06-16', 'Thailand', 'Glavni grad - Bangkok', 'Tajland ili Taj,[2][3] rjeđe Tajska, službeno Kraljevina Tajland (staro ime ove države je bilo Sijam) je država u jugoistočnoj Aziji. Na jugu izlazi na Tajlandski zaljev, dio Južnog kineskog mora. Graniči na zapadu s Mjanmarom, na sjeveru i istoku s Laosom, na istoku s Kambodžom i na jugu s Malezijom.', 'thailand.jpeg', 'Azija', 0),
(3, '2026-06-18', 'Zagreb', 'Zagreb prekrasni Europski Grad u Hrvatskoj', 'Zagreb je glavni grad Republike Hrvatske i najveći grad u Hrvatskoj po broju stanovnika. Grad Zagreb je kao glavni grad Hrvatske posebna teritorijalna, upravna i samoupravna jedinica. Šire područje grada okuplja više od milijun stanovnika. Povijesno gledajući, grad Zagreb izrastao je iz dvaju naselja na susjednim brežuljcima, Gradeca i Kaptola, koji čine jezgru današnjega grada, njegovo povijesno središte (Gornji i dio Donjega Grada). Nalazi se na jugozapadnomu rubu Panonske nizine na prosječnoj nadmorskoj visini od 122 m, podno južnih padina Medvednice, na lijevoj i desnoj obali rijeke Save. Položaj grada Zagreba, koji je na mjestu spajanja alpskog, dinarskog, jadranskog i panonskog područja, omogućio je Zagrebu postati most između srednjoeuropskoga i jadranskoga područja.', 'zagreb2.jpg', 'Europa', 0),
(4, '2026-06-21', 'San Francisco', 'Grad u Americi', 'San Francisco je četvrti po veličini grad u Kaliforniji i dvanaesti u SAD-u. Prema procjeni iz 2009. godine ima 845.559 stanovnika.[1] Drugi je veći grad SAD-a po gustoći naseljenosti, odmah iza New Yorka.[2]\r\n\r\nŠpanjolci su bili prvi europski doseljenici 1776. godine. Pronalaskom rezervi zlata 1848. i srebra 1859. godine, grad doživljava razdoblje ubrzanog širenja. Nakon što je u potpunosti bio uništen u požaru i potresu 1906. godine, brzo je obnovljen i danas je jedan od najprepoznatljivijih gradova SAD-a.\r\n\r\nU hrvatskim izvorima iz 19. stoljeća zabilježeno je da se u našim krajevima ovaj grad nazivalo i imenom Sveti Franjo.[3]', 'sanfrancisko.jpeg', 'Amerika', 0);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(11) NOT NULL,
  `ime` varchar(32) NOT NULL,
  `prezime` varchar(32) NOT NULL,
  `korisnicko_ime` varchar(255) NOT NULL,
  `lozinka` varchar(255) NOT NULL,
  `razina` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `ime`, `prezime`, `korisnicko_ime`, `lozinka`, `razina`) VALUES
(1, 'Nikola', 'Buric', 'nburic', '$2y$10$Ye2pPNZ5yeizuT.Canq.n.OZ.o.xMk1wt.HrAb6AKkO23gpIvhNCq', 2),
(2, 'Ivan', 'Zec', 'izec', '$2y$10$ieS9KmN/01CnpgbFBEmHfO40xd5RTkbdt27vQ4W5jb.F018YSZUPe', 1),
(3, 'Marko', 'Marulic', 'mmarulic', '$2y$10$Rjh8HFuDHaqZXdpXk4x5TOiW4INgkqbHrYEal/q/Cf4TygAdhQl1K', 0),
(4, 'Marko', 'buric', '123', '$2y$10$qQScQFAwY05fPK5dUwhstupd3Y2/A.6F.vaYxjD/.02.9x9xD8D1C', 0),
(5, 'Marko', 'buric', '1234', '$2y$10$ckh9IlKOQBmND2.t5D2LDewBjH389z5gYHG1IMbUww/lzgN.sScpK', 0),
(6, 'nnikola', 'bbb', 'nburic123', '$2y$10$fi.oVtWhQJ8dbdu.IWW6fOdurQwElNA6LPOSzzhh2MuIdiAWdTZxe', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `destinacije`
--
ALTER TABLE `destinacije`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `destinacije`
--
ALTER TABLE `destinacije`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
