-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2025 at 04:44 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cinemax`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `rooms_id` int(11) DEFAULT NULL,
  `movie_id` int(11) DEFAULT NULL,
  `seat_id` int(11) DEFAULT NULL,
  `showtime_id` int(11) DEFAULT NULL,
  `booking_time` datetime DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `user_id`, `rooms_id`, `movie_id`, `seat_id`, `showtime_id`, `booking_time`, `status`) VALUES
(12, 4, 23, 35, 9, 13, '2025-01-17 15:25:39', 2),
(13, 4, 13, 13, 10, 13, '2025-01-17 17:46:23', 2),
(14, 4, 13, 22, 11, 13, '2025-01-17 20:36:21', 1),
(15, 4, 13, 22, 12, 13, '2025-01-17 20:36:21', 1),
(16, 4, 13, 22, 13, 13, '2025-01-17 20:36:22', 1),
(18, 4, 18, 18, 14, 13, '2025-01-27 17:37:38', 2);

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `movie_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `movie_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movie_id`, `title`, `description`, `image_path`, `movie_price`) VALUES
(12, 'Gracie si Pedro: Drumul spre casa', 'În timpul mutării într-o nouă casă, animăluțele de companie Gracie și Pedro sunt separate de stăpâni. Călătoria lor va fi plină de provocări și vor întâlni personaje ciudate până când își vor găsi calea spre casă, lângă Sophie și Gavin.', '../../imagini/filme/pedro.jpg', 35.00),
(13, 'Marcello meu ', 'Chiara este actrita si este fiica lui Marcello Mastroianni si a lui Catherine Deneuve. Intr-o vara, decide sa traiasca la fel ca tatal ei. Se imbraca, vorbeste si respira ca el cu atata convingere incat ceilalti incep sa-i spuna \"Marcello\".', '../../imagini/filme/marcello.jpg', 15.00),
(14, 'Cum as putea trai fara tine?', 'Ce leaga trecutul de prezent? Dragostea, desigur. Si muzica. Dar numai daca este cu adevarat buna... Lili este o fata tipica timpurilor noastre: este singura si incearca sa se convinga ca acest lucru este bine pentru ea. Dar, intr-o zi, gaseste un pachet de scrisori vechi in apartamentul parintilor sai, pe care mama ei se pare ca nu a vrut sa i le arate deloc. Desigur, nu ezita prea mult, incepe sa citeasca, iar trecutul prinde viata......o vara de neuitat la inceputul anilor \'90, cand trei prietene bune petrec vacanta la lacul Balaton si doar Eszter (Franciska Torocsik) vrea sa ramana fidela iubitului ei care a ramas acasa. Dar planurile ei, pe care de obicei le face si urmeaza cu precizie, devin putin confuze cand intalneste un tip (Mark Ember), care este relaxat, amuzant si are o alta calitate foarte buna: canta intr-o trupa seara de seara pe plaja din Szigliget cu prietenii lui. Ce poate sa devina din asta? Confuzie? Dragoste? Gelozie? Cateva saruturi? Cateva palme? Mai multe saruturi? Asta e minimul. Vara de la lacul Balaton schimba vietile unor tineri - ba chiar si cale opiilor lor...', '../../imagini/filme/6694S2R1.jpg', 35.00),
(15, 'Favoarea', 'Sotii Gallardo impreuna cu cei trei copii, Teresa, Benja si Aura, isi petrec verile la luxoasa lor ferma ingrijita cu atentie de Amparito, cea care a fost mai mult decat o bona pentru copii. Cand primesc vestea trista a mortii ei, cei trei frati revin la ferma pentru a-si lua ramas bun si a-l consola pe Tomas, singurul fiu al bonei. Doar ca aici au parte de o mare surpriza: ultima dorinta a lui Amparito este de a fi ingropata in mausoleul familiei. Dupa ce Los Gallardos refuza sa indeplineasca aceasta favoare, intra in posesia mostenirii lui Amparito: scrisori personalizate pentru cei trei frati. Adevaruri dureroase sunt pe cale sa explodeze', '../../imagini/filme/favoarea.jpg', 35.00),
(16, 'Fratia Hotilor 2: Pantera', 'Butler revine in rolul lui Big Nick, de data asta la vanatoare in Europa, pe urmele lui Donnie, care este implicat in lumea subterana a hotilor de diamante si a infamei mafii \"Pantera\", care planuiesc un jaf masiv la cel mai mare schimb de diamante din lume.', '../../imagini/filme/6980S2R.jpg', 35.00),
(17, 'Substanta ', 'O vedeta la final de cariera decide sa foloseasca un medicament de pe piata neagra, o substanta de replicare celulara care creeaza temporar o versiune mai tanara si mai buna a sa.', '../../imagini/filme/6701S2R.jpg', 35.00),
(18, 'Super Elfii salveaza orasul', 'Lumea lui Elfie e data peste cap atunci cand descopera existenta unei bande Elfkin avansate din punct de vedere tehnic care, in contrast cu clanul lui Elfie, e mereu in cautare de distractie si aventuri. Poate prietenia lui Helvi cu Bo, cel mai tanar membru al bandei, sa reconcilieze cele doua clanuri Elfkin dupa mai bine de 250 de ani?', '../../imagini/filme/6952D2R.jpg', 15.00),
(19, 'Babygirl ', 'Nicole Kidman revine pe marile ecrane intr-o drama erotica exploziva: aflata la varful unei companii in pozitia de CEO, o femeie de afaceri extrem de influenta isi risca viata de familie si cariera atunci cand incepe o aventura plina de senzualitate cu un intern mult mai tanar decat ea.', '../../imagini/filme/6926S2R.jpg', 20.00),
(20, 'Duel in trei', 'Anii 1920, Romania. Dupa ce a trait cativa ani in strainatate, tanarul Mihail (Florin Aioane) se intoarce in satul natal pentru a cere mana Elenei, recent ramasa vaduva. Situatia se complica atunci cand in sat apare un alt pretendent.', '../../imagini/filme/6994O2R.jpg', 30.00),
(21, 'Nosferatu', 'O poveste gotica despre obsesia dintre o tanara chinuita si un vampir terifiant indragostit de ea, care aduce dupa sine consecinte infioratoare.', '../../imagini/filme/6643S2R.jpg', 30.00),
(22, 'Better Man : Robbie Williams', 'Bazat pe povestea adevarata a ascensiunii fulgeratoare, a caderii dramatice si a reinventarii remarcabile a superstarului pop britanic Robbie Williams, biopic-ul „Better Man: Robbie Williams” este un musical live-action fascinant care va atrage publicul intr-o incursiune prin viata controversata a artistului si cele mai mari hituri ale sale. Sub regia vizionara a lui Michael Gracey (“Omul Spectacol / The Greatest Showman”), care a contribuit si la scrierea scenariului, filmul este relatat din perspectiva unica a lui Williams, captand spiritul sau inconfundabil. Filmul urmareste evolutia lui Williams din copilarie, la a fi cel mai tanar membru al trupei fenomen Take That, pana la realizarile sale inegalabile ca artist solo, confruntandu-se totodata cu dificultatile pe care faima gigantica si succesul le pot produce.', '../../imagini/filme/6880S2R.jpg', 15.00),
(23, 'Sonic the hedgehog 3', 'Actiune, Aventura, Animatie, Comedie, Familie, Fantastic, Fictiune', '../../imagini/filme/6785S2R.jpg', 35.00),
(24, 'Contele de Monte-Cristo', 'Edmond Dantes devine tinta unui complot sinistru si este arestat in ziua nuntii sale pentru o crima pe care nu a comis-o. Dupa 14 ani petrecuti in inchisoarea de pe insula Chateau d\'If, reuseste o evadare indrazneata. Acum mai bogat decat visase vreodata, Dantes isi asuma identitatea de conte de Monte-Cristo si se razbuna pe cei care l-au tradat.', '../../imagini/filme/6464S2R.jpg', 20.00),
(25, 'Ecaterina', '\"Ecaterina\" este un film emotionant si plin de suspans, care exploreaza curajul si puterea de neinfrant a unei fetite ce se confrunta cu circumstante cutremuratoare. Povestea incepe cu Ecaterina, o fetita curajoasa care isi pierde mama din cauza cancerului. Ramasa fara familie, ea este dusa la un orfelinat de catre vecinul sau, un politist devotat. Desi acesta tine foarte mult la Ecaterina, programul sau incarcat si statutul sau de barbat neinsurat il impiedica sa aiba grija de ea. Viata la orfelinat ia o turnura dramatica pentru Ecaterina. Ea descopera treptat ca directorul institutiei este implicat intr-o conspiratie terifianta, alaturi de seful politiei, in care copiii sunt pregatiti pentru traficul de organe. Educatia dura si metodele brutale de corectie sunt menite sa-i faca pe copii ascultatori, creand o atmosfera de frica constanta si opresiune. In ciuda initialei sale neputinte, Ecaterina gaseste in sine curajul necesar pentru a supravietui si a se impotrivi. Planul de salvare este pus la punct de vecinul ei politist si de o profesoara nou-angajata la orfelinat, intre care se dezvolta o poveste de apartenenta si dragoste. Impreuna, ei reusesc sa conceapa un plan ingenios pentru a demasca si a infrunta reteaua criminala. Eforturile lor comune duc la desfiintarea retelei si salvarea multor copii, aducand in cele din urma infractorii in fata justitiei. \"Ecaterina\" nu este doar un film de suspans, ci si o poveste despre curaj, prietenie si lupta neobosita pentru dreptate. Evidentiaza puterea incredibila pe care o poate avea un copil atunci cand decide sa lupte pentru ceea ce este corect, chiar si in fata celor mai cumplite temeri.', '../../imagini/filme/6993O2R.jpg', 30.00),
(26, 'Maria', 'Angelina Jolie intra in rolul Mariei Callas, una dintre cele mai emblematice interprete de opera ale secolului al XX-lea. Filmul o urmareste pe soprana in ultima perioada a vietii ei, in care se retrage la Paris, dupa o viata tumultoasa si plina de farmec.', '../../imagini/filme/6881S2R.jpg', 20.00),
(27, 'Mufasa: Regele leu', 'Mufasa: The Lion King ni-l prezinta pe Simba, devenit rege, care a decis ca puiul sau sa-i urmeze pasii. In acelasi timp, animatia exploreaza originile raposatului tata al lui Simba, Mufasa.', '../../imagini/filme/6546S2R.jpg', 30.00),
(28, 'Kraven Vanatorul', 'Relatia complexa a lui Kraven cu nemilosul sau tata, Nikolai Kravinoff, il indreapta pe calea razbunarii cu consecinte teribile, motivandu-l sa devina nu doar cel mai abil vanator din lume, ci si unul dintre cei mai temuti.', '../../imagini/filme/5879S2R.jpg', 15.00),
(29, 'Captain America: Curoajoasa lume noua', 'Dupa intalnirea presedintelui proaspat ales al Statelor Unite Thaddeus Ross, Sam se trezeste in mijlocul unui incident international si trebuie sa afle motivele din spatele unui complot global inainte ca intreaga lume sa fie invaluita in rosu.', '../../imagini/filme/6681S2R.jpg', 15.00),
(30, 'SuperMosul ', 'Dorinta lui Mos Craciun devine realitate cand acesta se loveste la cap si incepe sa creada ca este SuperKlaus. Cu ajutorul lui Billie si al lui Leo, elful sau asistent, SuperKlaus va trebuie sa infrunte un om de afaceri obsedat de jucarii pentru a salva Craciunul.', '../../imagini/filme/6882D2R.jpg', 30.00),
(31, 'Casatoria', 'Casatoria spune povestea a trei prieteni - Paguba, Arsenie si Conasu - care pornesc intr-o extraordinara aventura in cautarea victimelor perfecte care sa le intretina cu multi bani dependenta de jocuri de noroc. Cand totul pare a merge conform planului, lucrurile o iau razna. Din cauza datoriilor colosale si sevrajului continuu, incoltit fiind de camatari, cei trei elaboreaza un plan uluitor de complex. Acesta consta in casatoria din pur interes cu fiica disfunctionala a unui miliardar parvenit. Povestea dezvaluie personaje excentrice, dialoguri efervescente, intr-un scenariu plin de actiune si situatii comice. Vor reusi cei trei sa scape de trecutul lor si sa isi croiasca o viata paradisiaca si plina de lux? Sau, dimpotriva, dezastrul absolut se va dezlanțui?\"', '../../imagini/filme/6887O2R.jpg', 20.00),
(32, 'Transilvanian Ninja', 'Ninel si Violin sunt doi prieteni trecuti de prima tinerete din Gura Raului. Vietile lor se invart in jurul problemelor cotidiene ce le coloreaza viata, de altfel banala. Totul se schimba cand Ninel o invita pe Ramona la concertul din sat, iar cei doi intra in conflict cu gasca lui Florin, cei mai temuti oameni din sat. In urma acestui incident, Ninel si Violin sunt sfatuiti de seful de post sa urmeze antrenamentul de ninja oferit de Brusli din satul Naparliți. Acesta din urma ii refuza, dar una dintre fetele lui, Diana, accepta pana la urma sa-i antreneze. Pe masura ce Ninel si Violin avanseaza cu antrenamentele, primii ninja romani iau nastere. Acesti noi supereroi locali decid sa repare problemele provocate de gasca lui Florin in Gura Raului, dar pica in mijlocul unui jaf organizat de Florin. Cine o sa iasa victorios?', '../../imagini/filme/6884O2R.jpg', 20.00),
(33, 'Eretic: Labirintul mortii', 'Doua tinere misionare (Sophie Thatcher si Chloe East) care merg din usa in usa pentru a raspandi cuvantul lui Dumnezeu, ajung fata in fata cu domnul Reed (Hugh Grant), un barbat aparent inofensiv. Dupa ce sunt invitate in casa domnului Reed, tinerele primesc o lectie sinistra despre pericolele credintei si despre consecintele naivitatii.', '../../imagini/filme/6868S2R.jpg', 15.00),
(34, 'Tandari', 'Cand doua comune primesc de la Guvern doar jumatate din bugetul anual de care au nevoie, iar primarii rivali mizeaza totul pe un meci de fotbal, creste presiunea: cine invinge ia toti banii si isi face treaba. Asa ca, fireste, fiecare va face tot ce e romaneste posibil sa castige, intr-o comedie „laser, frate!” despre bani, fotbal si fete de maritat.', '../../imagini/filme/6973O2R.jpg', 35.00),
(35, 'Batman', 'Dupa doi ani de supraveghere a strazilor orasului ca Batman, aducand frica in inimile criminalilor, cel mai cunoscut personaj al universului DC este infatisat intr-o poveste complet diferita, care scoate la iveala secretele ascunse ale familiilor fondatoare ale orasului Gotham. Cu doar doi aliati de incredere - Alfred Pennyworth si Lt. James Gordon - printre reteaua corupta a oficialilor si personalitatilor de profil a orasului, Batman se impune ca intruchiparea razbunarii. Cand un criminal pe nume Riddler vizeaza elita orasului cu o serie de intrigi sadice, indiciile il trimit pe Bruce Wayne intr-o investigatie in lumea interlopa, unde intalneste personaje precum Catwoman, Pinguinul/Oswald Cobblepot, Edward Nashton si Carmine Falcone. Pe masura ce dovezile incep sa se apropie de casa si planurile rau-facatorului devin clare, Batman trebuie sa creeze noi relatii pentru a-l demasca pe vinovat, devenind simbolul sperantei in orasul Gotham.', '../../imagini/filme/4776S3R.jpg', 30.00);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `rooms_id` int(11) NOT NULL,
  `RoomName` varchar(255) NOT NULL,
  `movie_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`rooms_id`, `RoomName`, `movie_id`) VALUES
(13, 'Sala A', 13),
(14, 'Sala A', 14),
(15, 'Sala A', 15),
(16, 'Sala A', 16),
(17, 'Sala A', 17),
(18, 'Sala A', 18),
(19, 'Sala A', 19),
(20, 'Sala A', 20),
(21, 'Sala A', 21),
(22, 'Sala A', 22),
(23, 'Sala B', 23),
(24, 'Sala B', 24),
(25, 'Sala B', 25),
(26, 'Sala B', 26),
(27, 'Sala B', 27),
(28, 'Sala B', 28),
(29, 'Sala B', 29),
(30, 'Sala B', 30),
(31, 'Sala B', 31),
(32, 'Sala B', 32),
(33, 'Sala A', 33),
(34, 'Sala B', 34),
(35, 'Sala B', 35);

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `seat_id` int(11) NOT NULL,
  `room_id` int(11) DEFAULT NULL,
  `seat_number` varchar(10) NOT NULL,
  `status` enum('available','booked') DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`seat_id`, `room_id`, `seat_number`, `status`) VALUES
(9, 23, 'scaun 8', 'available'),
(10, 13, 'scaun 8', 'available'),
(11, 13, 'scaun 1', 'available'),
(12, 13, 'scaun 2', 'available'),
(13, 13, 'scaun 3', 'available'),
(14, 18, 'scaun 4', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `showtimes`
--

CREATE TABLE `showtimes` (
  `showtime_id` int(11) NOT NULL,
  `movie_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `showtime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `showtimes`
--

INSERT INTO `showtimes` (`showtime_id`, `movie_id`, `room_id`, `showtime`) VALUES
(13, 13, 13, '2025-06-06 13:00:00'),
(14, 14, 14, '2025-06-06 13:00:00'),
(15, 15, 15, '2025-06-06 13:00:00'),
(16, 16, 16, '2025-06-06 13:00:00'),
(17, 17, 17, '2025-06-06 13:00:00'),
(18, 18, 18, '2025-06-06 13:00:00'),
(19, 19, 19, '2025-06-06 13:00:00'),
(20, 20, 20, '2025-06-06 13:00:00'),
(21, 21, 21, '2025-06-06 13:00:00'),
(22, 22, 22, '2025-06-06 13:00:00'),
(23, 23, 23, '2025-06-06 13:00:00'),
(24, 24, 24, '2025-06-06 13:00:00'),
(25, 25, 25, '2025-06-06 13:00:00'),
(26, 26, 26, '2025-06-06 13:00:00'),
(27, 27, 27, '2025-06-06 13:00:00'),
(28, 28, 28, '2025-06-06 13:00:00'),
(29, 29, 29, '2025-06-06 13:00:00'),
(30, 30, 30, '2025-06-06 13:00:00'),
(31, 31, 31, '2025-06-06 13:00:00'),
(32, 32, 32, '2025-06-06 13:00:00'),
(33, 33, 33, '2025-06-06 13:00:00'),
(34, 34, 34, '2025-06-06 13:00:00'),
(35, 35, 35, '2025-06-06 13:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `ticket_id` int(11) NOT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_lname` varchar(255) DEFAULT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `customer_phone` varchar(20) DEFAULT NULL,
  `customer_address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`ticket_id`, `booking_id`, `customer_name`, `customer_lname`, `customer_email`, `customer_phone`, `customer_address`) VALUES
(10, 12, 'Elisei', 'Manole', 'elisei.manole20@yahoo.com', '0755752954', 'Aleea pravat nr 1'),
(11, 13, 'Elisei', 'Manole', 'elisei.manole755@gmail.com', '0755752954', 'Aleea pravat nr 1'),
(12, 18, 'Elisei', 'Manole', 'elisei.manole755@gmail.com', '0755752954', 'Aleea pravat nr 1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `role` enum('user','worker','admin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `reg_date`, `role`) VALUES
(2, 'Elisei', 'Manole', 'elisei.manole20@yahoo.com', '$2y$10$XWFY4s5/mUY7e2ClUErqB.rvRSUHh1agGLnaKctJVnlmERPve/ube', '2024-11-18 19:20:50', 'admin'),
(3, 'Elena', 'Veronica', 'elena.veronica98@yahoo.com', '$2y$10$yM8aNTPZvQXfAoaoYxxu.uTld17mX96bfEDqeHNY.SKgk09wHbpte', '2024-11-21 09:52:38', 'worker'),
(4, 'Elisei', 'Manole', 'elisei.manole755@gmail.com', '$2y$10$CriKOTURHxbE57gksU4djOdjxjDIp9./rmzvn9Ye86FYcUIVKf4MK', '2024-12-03 12:40:59', 'user'),
(5, 'Alan', 'Andrei', 'alan.andrei@gmail.com', '$2y$10$KCxrFIQTU380ceVwBbLnkej80Z9idRurJ4iZqvIc8uqxfMvx3dXj6', '2025-01-10 20:01:15', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `workers`
--

CREATE TABLE `workers` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workers`
--

INSERT INTO `workers` (`id`, `firstname`, `lastname`, `email`, `password`, `reg_date`) VALUES
(3, 'Emanuel', 'Daniel', 'emanueldaniel@gmail.com', '$2y$10$MPzxVEEogC7Bt5LRAUs4HOcG7zEZfaIg1HPYW5QK8NplTWUrWGOsO', '2025-01-12 12:04:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD UNIQUE KEY `seat_id` (`seat_id`,`showtime_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `movie_id` (`movie_id`),
  ADD KEY `rooms_id` (`rooms_id`),
  ADD KEY `showtime_id` (`showtime_id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movie_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`rooms_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`seat_id`),
  ADD UNIQUE KEY `room_id` (`room_id`,`seat_number`);

--
-- Indexes for table `showtimes`
--
ALTER TABLE `showtimes`
  ADD PRIMARY KEY (`showtime_id`),
  ADD KEY `movie_id` (`movie_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `workers`
--
ALTER TABLE `workers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `movie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `rooms_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `seats`
--
ALTER TABLE `seats`
  MODIFY `seat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `showtimes`
--
ALTER TABLE `showtimes`
  MODIFY `showtime_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `workers`
--
ALTER TABLE `workers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`),
  ADD CONSTRAINT `bookings_ibfk_3` FOREIGN KEY (`rooms_id`) REFERENCES `rooms` (`rooms_id`),
  ADD CONSTRAINT `bookings_ibfk_4` FOREIGN KEY (`seat_id`) REFERENCES `seats` (`seat_id`),
  ADD CONSTRAINT `bookings_ibfk_5` FOREIGN KEY (`showtime_id`) REFERENCES `showtimes` (`showtime_id`);

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`);

--
-- Constraints for table `seats`
--
ALTER TABLE `seats`
  ADD CONSTRAINT `seats_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`rooms_id`);

--
-- Constraints for table `showtimes`
--
ALTER TABLE `showtimes`
  ADD CONSTRAINT `showtimes_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`),
  ADD CONSTRAINT `showtimes_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`rooms_id`);

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
