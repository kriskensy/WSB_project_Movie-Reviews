-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sty 31, 2025 at 07:34 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movie_reviews_db`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `directors`
--

CREATE TABLE `directors` (
  `IdDirector` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `directors`
--

INSERT INTO `directors` (`IdDirector`, `Name`) VALUES
(1, 'Christopher Nolan'),
(2, 'Steven Spielberg'),
(3, 'Quentin Tarantino'),
(4, 'Ridley Scott'),
(5, 'James Cameron'),
(6, 'Martin Scorsese'),
(7, 'Peter Jackson'),
(8, 'Denis Villeneuve');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `genres`
--

CREATE TABLE `genres` (
  `IdGenre` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`IdGenre`, `Name`) VALUES
(1, 'Action'),
(2, 'Comedy'),
(3, 'Drama'),
(4, 'Science Fiction'),
(5, 'Horror'),
(6, 'Thriller'),
(7, 'Romance');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `movies`
--

CREATE TABLE `movies` (
  `IdMovie` int(11) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `IdDirector` int(11) NOT NULL,
  `IdGenre` int(11) NOT NULL,
  `ReleaseYear` date NOT NULL,
  `Description` varchar(2000) NOT NULL,
  `AverageRating` decimal(3,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`IdMovie`, `Title`, `IdDirector`, `IdGenre`, `ReleaseYear`, `Description`, `AverageRating`) VALUES
(1, 'Inception', 1, 4, '2010-07-16', 'A thief, Dom Cobb, who steals secrets from within the subconscious during the dream state, is given the reverse task of planting an idea into the mind of a CEO. The high-stakes mission takes Cobb and his team deep into dream layers, each with its own dangers and unpredictable consequences. As they navigate the complexities of shared dreams, Cobb confronts his own inner demons, particularly the haunting memories of his late wife. Inception challenges perceptions of reality and blurs the line between what is real and what is imagined.', 5.00),
(2, 'The Dark Knight', 1, 1, '2008-07-18', 'In Gotham City, chaos reigns as the Joker, a criminal mastermind with no clear motive beyond destruction, wreaks havoc. Batman, along with Commissioner Gordon and District Attorney Harvey Dent, tries to bring order to the city. The Joker\'s antics test Batman\'s resolve, forcing him to confront his own moral boundaries. Meanwhile, Dent\'s transformation into Two-Face adds layers of tragedy to the story. With intense action, psychological depth, and moral dilemmas, The Dark Knight redefines superhero storytelling.', 5.00),
(3, 'Jurassic Park', 2, 4, '1993-06-11', 'When John Hammond creates a revolutionary theme park populated by genetically engineered dinosaurs, he invites a small group of experts for a sneak preview. But what starts as a dream quickly turns into a nightmare when the park\'s security systems fail, unleashing the dinosaurs on the visitors. Chaos ensues as the guests fight for survival in a landscape dominated by creatures from the past. Jurassic Park is both a cautionary tale about playing God and a thrilling adventure showcasing groundbreaking visual effects.', 2.00),
(4, 'Pulp Fiction', 3, 3, '1994-10-14', 'A series of interconnected stories unfold in the seedy underbelly of Los Angeles. From two hitmen debating the meaning of life, to a boxer on the run, to a gangster\'s wife having a dangerous night out, Pulp Fiction weaves these narratives together in a nonlinear style. The film\'s sharp dialogue, dark humor, and iconic moments make it a cinematic classic. Each character faces moral dilemmas and unpredictable twists, creating a tapestry of crime and redemption.', 5.00),
(5, 'Alien', 4, 5, '1979-05-25', 'In the depths of space, the crew of the Nostromo investigates a distress signal from a remote planet, only to discover a deadly alien organism. As the creature begins to hunt them one by one, the crew must use their wits to survive. Ripley, the resourceful protagonist, emerges as a powerful figure in the face of overwhelming terror. Alien combines science fiction and horror in a groundbreaking way, with suspenseful storytelling and unforgettable visuals.', 5.00),
(6, 'Avatar', 5, 4, '2009-12-18', 'Jake Sully, a paraplegic Marine, is sent to the distant planet of Pandora as part of a mission to mine valuable resources. Through an avatar body, he befriends the Na\'vi, the planet\'s indigenous people, and falls in love with their way of life. Torn between his loyalty to the military and his newfound connection to Pandora, Jake must make a choice that could determine the fate of an entire world. Avatar is a visually stunning epic that explores themes of environmentalism, colonialism, and identity.', 5.00),
(7, 'The Wolf of Wall Street', 6, 3, '2013-12-25', 'Based on the true story of Jordan Belfort, this film chronicles his meteoric rise as a stockbroker and his equally spectacular downfall. From raucous parties to fraudulent schemes, Belfort\'s world is one of excess and debauchery. As he amasses wealth and power, his life spirals out of control, affecting those closest to him. The Wolf of Wall Street is both a darkly comedic take on capitalism and a cautionary tale about the corrupting influence of greed.', 5.00),
(8, 'The Lord of the Rings: The Fellowship of the Ring', 7, 4, '2001-12-19', 'In the land of Middle-earth, Frodo Baggins, a young hobbit, is entrusted with a dangerous mission: to destroy the One Ring, an artifact of immense power that could bring darkness to the world. Alongside a fellowship of allies, Frodo embarks on a perilous journey through treacherous landscapes, encountering orcs, wizards, and ancient evils. This epic tale of friendship, courage, and sacrifice is the beginning of an unforgettable saga.', 4.00),
(9, 'Interstellar', 1, 4, '2014-11-07', 'As Earth faces a dire environmental crisis, a group of explorers led by Cooper, a former pilot, travels through a wormhole in search of a new habitable planet. The mission tests their endurance, relationships, and understanding of time and space. With stunning visuals and a thought-provoking narrative, Interstellar explores humanity\'s resilience and the lengths we go to secure our future. It is both a personal story of love and a grand exploration of the universe.', 3.00),
(10, 'Blade Runner 2049', 8, 4, '2017-10-06', 'In a dystopian future, K, a young Blade Runner, uncovers a secret that threatens to destabilize what remains of society. As he searches for answers, he encounters Rick Deckard, a former Blade Runner who has been in hiding for decades. Together, they confront questions of identity, humanity, and what it means to be alive. Blade Runner 2049 is a visually breathtaking sequel that builds on the legacy of the original film while exploring new philosophical depths.', 4.00),
(11, 'The Matrix', 1, 4, '1999-03-31', 'Neo, a computer hacker, discovers the shocking truth: the reality he knows is a simulated construct created by intelligent machines to enslave humanity. Guided by Morpheus and Trinity, Neo joins the resistance to fight against the machines and uncover his destiny as \"The One.\" As he learns to bend the rules of the Matrix, Neo faces life-altering choices and harrowing battles that blur the line between the virtual and real worlds. The Matrix is a groundbreaking sci-fi masterpiece that redefined action and storytelling.', 5.00),
(12, 'Gladiator', 4, 1, '2000-05-05', 'Maximus Decimus Meridius, a betrayed Roman general, is forced into slavery after the murder of his family by the corrupt Emperor Commodus. As a gladiator, Maximus rises through the ranks, winning the hearts of the people in the Colosseum. Driven by vengeance and justice, he seeks to challenge the emperor and restore Rome to its former glory. Gladiator is an epic tale of honor, resilience, and redemption set against the backdrop of Ancient Rome.', 5.00),
(13, 'Schindler\'s List', 2, 3, '1993-11-30', 'Oskar Schindler, a German businessman, witnesses the horrors of the Holocaust and takes extraordinary risks to save the lives of over a thousand Jewish refugees by employing them in his factories. Through his efforts, Schindler transforms from a profiteer to a hero, demonstrating the power of compassion in the face of unimaginable evil. Schindler\'s List is a haunting and deeply moving portrayal of one man\'s courage and the triumph of humanity.', 4.67),
(14, 'Goodfellas', 6, 3, '1990-09-19', 'Henry Hill rises through the ranks of the American Mafia, enjoying a life of crime, luxury, and camaraderie. However, his world begins to crumble as greed, paranoia, and betrayal take their toll on the mob hierarchy. Based on a true story, Goodfellas offers an unflinching look at the allure and consequences of organized crime, with unforgettable characters and razor-sharp storytelling that cemented its place as a crime genre classic.', 4.67),
(15, 'Titanic', 5, 7, '1997-12-19', 'On the ill-fated maiden voyage of the RMS Titanic, a young aristocrat, Rose, falls in love with Jack, a penniless artist. Their romance transcends social barriers, but their love is tested as the ship meets its tragic end. As chaos unfolds, Rose must choose between her privileged life and the man who has changed her forever. Titanic is a sweeping romantic tragedy that captures the grandeur and heartbreak of one of history\'s greatest maritime disasters.', 1.67),
(16, 'The Hobbit: An Unexpected Journey', 7, 4, '2012-12-14', 'Bilbo Baggins, a reluctant hobbit, is swept into an epic quest to reclaim the lost kingdom of Erebor from the fearsome dragon Smaug. Accompanied by a company of dwarves and the mysterious Gandalf, Bilbo faces trolls, goblins, and other perils as he discovers courage he never knew he had. Along the way, he encounters the creature Gollum and a fateful ring that will shape Middle-earth\'s destiny. This adventure marks the beginning of a legendary journey.', 3.00),
(17, 'Django Unchained', 3, 3, '2012-12-25', 'Django, a freed slave, teams up with Dr. King Schultz, a German bounty hunter, to rescue his wife from a brutal plantation owner, Calvin Candie. As the unlikely duo navigates the dangerous landscape of the antebellum South, Django hones his skills as a gunslinger and confronts the horrors of slavery. Filled with sharp dialogue, intense action, and moments of dark humor, Django Unchained is a bold reimagining of the Western genre.', 5.00),
(18, 'E.T. the Extra-Terrestrial', 2, 4, '1982-06-11', 'When a gentle alien is stranded on Earth, he forms a deep bond with a young boy named Elliott. Together, they embark on an adventure to reunite E.T. with his home planet, all while evading government agents determined to capture the extraterrestrial. This heartwarming story of friendship, love, and wonder captures the magic of childhood and remains a timeless classic. E.T. reminds audiences of the power of connection across worlds.', 3.50),
(19, 'The Shining', 4, 5, '1980-05-23', 'Jack Torrance, a struggling writer, becomes the winter caretaker of the isolated Overlook Hotel, bringing along his wife Wendy and son Danny. As the hotel\'s dark secrets begin to surface, Jack descends into madness, putting his family in grave danger. Danny, who possesses psychic abilities, discovers the horrific history of the hotel and fights to survive. The Shining is a chilling exploration of isolation, madness, and the supernatural, solidifying its place as a horror classic.', 3.50),
(20, 'The Irishman', 6, 3, '2019-11-01', 'Frank Sheeran, an aging hitman, reflects on his life in the mob, recounting his role in pivotal events, including the disappearance of labor leader Jimmy Hoffa. Through decades of betrayal, loyalty, and violence, Frank grapples with the choices that defined his life. The Irishman is a poignant exploration of mortality, regret, and the heavy toll of a life lived in the shadows. It is a masterful epic that spans generations.', 4.50);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `reviews`
--

CREATE TABLE `reviews` (
  `IdReview` int(11) NOT NULL,
  `IdUser` int(11) NOT NULL,
  `IdMovie` int(11) NOT NULL,
  `Rating` tinyint(4) NOT NULL,
  `Content` varchar(4000) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`IdReview`, `IdUser`, `IdMovie`, `Rating`, `Content`, `Date`) VALUES
(1, 2, 1, 5, 'An absolute masterpiece with stunning visuals and a complex story.', '2023-01-15'),
(2, 2, 2, 5, 'A brilliant portrayal of Gotham with incredible performances.', '2023-01-16'),
(3, 2, 4, 5, 'Tarantino at his finest, a must-watch classic.', '2023-01-17'),
(4, 2, 3, 2, 'A visually stunning film with a strong emotional core.', '2023-01-18'),
(5, 2, 9, 3, 'A gripping tale of survival and science, truly inspiring.', '2023-01-20'),
(6, 2, 8, 4, 'A breathtaking epic with incredible performances and storytelling.', '2023-01-23'),
(7, 2, 10, 4, 'A thought-provoking sci-fi classic that stands the test of time.', '2023-01-24'),
(8, 3, 6, 5, 'Incredible visuals and a touching story about belonging.', '2023-01-25'),
(9, 3, 7, 5, 'A wild ride through greed, excess, and chaos.', '2023-01-26'),
(10, 4, 5, 5, 'A suspenseful, terrifying masterpiece of sci-fi horror.', '2023-01-27'),
(12, 2, 12, 5, 'An epic tale of revenge and redemption, beautifully executed.', '2023-01-29'),
(13, 3, 13, 5, 'One of the most powerful and moving films ever made.', '2023-01-30'),
(14, 4, 14, 5, 'A gritty and unflinching look at the world of organized crime.', '2023-01-31'),
(15, 5, 15, 1, 'A timeless love story with incredible visuals and music.', '2023-02-01'),
(16, 2, 16, 3, 'A fun and adventurous journey through Middle-earth.', '2023-02-02'),
(17, 2, 17, 5, 'Tarantino delivers another thrilling and thought-provoking masterpiece.', '2023-02-03'),
(18, 3, 18, 3, 'A heartwarming and emotional story about friendship and love.', '2023-02-04'),
(19, 4, 19, 4, 'A haunting and suspenseful film with brilliant performances.', '2023-02-05'),
(20, 5, 20, 4, 'An epic crime saga with stellar acting and direction.', '2023-02-06'),
(21, 4, 11, 5, 'A visually stunning and intellectually engaging sci-fi classic.', '2023-02-07'),
(22, 2, 12, 5, 'Russell Crowe shines in this incredible historical epic.', '2023-02-08'),
(23, 3, 13, 5, 'Steven Spielberg at his very best. A must-watch.', '2023-02-09'),
(24, 4, 14, 4, 'A gripping and intense mob drama that keeps you hooked.', '2023-02-10'),
(25, 5, 15, 2, 'Heartbreaking and beautiful. A true masterpiece.', '2023-02-11'),
(26, 4, 16, 3, 'An entertaining fantasy film with a great cast and stunning visuals.', '2023-02-12'),
(27, 2, 17, 5, 'A powerful story with unforgettable characters and moments.', '2023-02-13'),
(28, 3, 18, 4, 'A touching and magical experience that stays with you.', '2023-02-14'),
(29, 4, 19, 3, 'Jack Nicholson delivers an unforgettable performance.', '2023-02-15'),
(30, 5, 20, 5, 'A compelling and introspective look at life in the mob.', '2023-02-16'),
(31, 2, 11, 5, 'The Matrix is a cinematic masterpiece that combines action and philosophy.', '2023-02-17'),
(32, 3, 12, 5, 'Gladiator is a powerful and emotional journey.', '2023-02-18'),
(33, 4, 13, 4, 'Schindler’s List is an unforgettable film that everyone should see.', '2023-02-19'),
(34, 5, 14, 5, 'Goodfellas is an incredible film with great storytelling.', '2023-02-20'),
(35, 4, 15, 2, 'Titanic is a visually stunning and emotional masterpiece.', '2023-02-21');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `roles`
--

CREATE TABLE `roles` (
  `IdRole` int(11) NOT NULL,
  `Rolename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`IdRole`, `Rolename`) VALUES
(1, 'User'),
(2, 'Admin');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `IdUser` int(11) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `IdRole` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`IdUser`, `Username`, `Password`, `Email`, `IdRole`) VALUES
(1, 'Szef', '$2y$10$uRog23BGFsV.c/IMPTlAJOBjBtBzYvZchqR/mt9kt7DoGRQ5606q2', 'szef@example.com', 2),
(2, 'Nikola', '$2y$10$uRog23BGFsV.c/IMPTlAJOBjBtBzYvZchqR/mt9kt7DoGRQ5606q2', 'nikola@example.com', 1),
(3, 'Kris', '$2y$10$uRog23BGFsV.c/IMPTlAJOBjBtBzYvZchqR/mt9kt7DoGRQ5606q2', 'kris@example.com', 1),
(4, 'Ania', '$2y$10$uRog23BGFsV.c/IMPTlAJOBjBtBzYvZchqR/mt9kt7DoGRQ5606q2', 'ania@example.com', 1),
(5, 'Kazik', '$2y$10$uRog23BGFsV.c/IMPTlAJOBjBtBzYvZchqR/mt9kt7DoGRQ5606q2', 'kazik@example.com', 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `directors`
--
ALTER TABLE `directors`
  ADD PRIMARY KEY (`IdDirector`);

--
-- Indeksy dla tabeli `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`IdGenre`);

--
-- Indeksy dla tabeli `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`IdMovie`),
  ADD KEY `IdDirector` (`IdDirector`),
  ADD KEY `IdGenre` (`IdGenre`);

--
-- Indeksy dla tabeli `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`IdReview`),
  ADD KEY `IdUser` (`IdUser`),
  ADD KEY `IdMovie` (`IdMovie`);

--
-- Indeksy dla tabeli `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`IdRole`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`IdUser`),
  ADD UNIQUE KEY `Username` (`Username`,`Email`),
  ADD KEY `IdRole` (`IdRole`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `directors`
--
ALTER TABLE `directors`
  MODIFY `IdDirector` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `IdGenre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `IdMovie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `IdReview` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `IdRole` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `IdUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `movies_ibfk_1` FOREIGN KEY (`IdDirector`) REFERENCES `directors` (`IdDirector`),
  ADD CONSTRAINT `movies_ibfk_2` FOREIGN KEY (`IdGenre`) REFERENCES `genres` (`IdGenre`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`IdUser`) REFERENCES `users` (`IdUser`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`IdMovie`) REFERENCES `movies` (`IdMovie`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`IdRole`) REFERENCES `roles` (`IdRole`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
