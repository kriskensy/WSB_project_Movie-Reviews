-- Utworzenie bazy danych
CREATE DATABASE movie_reviews_db;
GO

-- Użycie bazy danych
USE movie_reviews_db;
GO

-- Tabela Roles
CREATE TABLE Roles (
    IdRole INT IDENTITY(1,1) PRIMARY KEY,
    Rolename VARCHAR(100) NOT NULL
);
-- Tabela Users
CREATE TABLE Users (
    IdUser INT IDENTITY(1,1) PRIMARY KEY,
    Username VARCHAR(100) NOT NULL UNIQUE,
    Password VARCHAR(100) NOT NULL,
    Email VARCHAR(100) NOT NULL UNIQUE,
    IdRole INT NOT NULL,
    FOREIGN KEY (IdRole) REFERENCES Roles(IdRole)
);
-- Tabela Directors
CREATE TABLE Directors (
    IdDirector INT IDENTITY(1,1) PRIMARY KEY,
    Name VARCHAR(100) NOT NULL
);
-- Tabela Genres
CREATE TABLE Genres (
    IdGenre INT IDENTITY(1,1) PRIMARY KEY,
    Name VARCHAR(100) NOT NULL
);
-- Tabela Movies
CREATE TABLE Movies (
    IdMovie INT IDENTITY(1,1) PRIMARY KEY,
    Title VARCHAR(100) NOT NULL,
    IdDirector INT NOT NULL,
    IdGenre INT NOT NULL,
    ReleaseYear DATE NOT NULL,
    Description VARCHAR(2000) NOT NULL,
    AverageRating DECIMAL(3,2) NULL,
    FOREIGN KEY (IdDirector) REFERENCES Directors(IdDirector),
    FOREIGN KEY (IdGenre) REFERENCES Genres(IdGenre)
);
-- Tabela Reviews
CREATE TABLE Reviews (
    IdReview INT IDENTITY(1,1) PRIMARY KEY,
    IdUser INT NOT NULL,
    IdMovie INT NOT NULL,
    Rating TINYINT NOT NULL,
    Content VARCHAR(4000) NOT NULL,
    Date DATE NOT NULL,
    FOREIGN KEY (IdUser) REFERENCES Users(IdUser),
    FOREIGN KEY (IdMovie) REFERENCES Movies(IdMovie)
);

-- Wstawienie danych do tabeli Roles
INSERT INTO Roles (Rolename) VALUES ('User'), ('Admin');

-- Wstawienie danych do tabeli Users
INSERT INTO Users (Username, Password, Email, IdRole) VALUES
('Szef', '$2y$10$uRog23BGFsV.c/IMPTlAJOBjBtBzYvZchqR/mt9kt7DoGRQ5606q2', 'szef@example.com', 2),
('Nikola', '$2y$10$uRog23BGFsV.c/IMPTlAJOBjBtBzYvZchqR/mt9kt7DoGRQ5606q2', 'nikola@example.com', 1),
('Kris', '$2y$10$uRog23BGFsV.c/IMPTlAJOBjBtBzYvZchqR/mt9kt7DoGRQ5606q2', 'kris@example.com', 1),
('Ania', '$2y$10$uRog23BGFsV.c/IMPTlAJOBjBtBzYvZchqR/mt9kt7DoGRQ5606q2', 'ania@example.com', 1),
('Kazik', '$2y$10$uRog23BGFsV.c/IMPTlAJOBjBtBzYvZchqR/mt9kt7DoGRQ5606q2', 'kazik@example.com', 1);

-- Wstawienie danych do tabeli Directors
INSERT INTO Directors (Name) VALUES
('Christopher Nolan'), ('Steven Spielberg'), ('Quentin Tarantino'), ('Ridley Scott'),
('James Cameron'), ('Martin Scorsese'), ('Peter Jackson'), ('Denis Villeneuve');

-- Wstawienie danych do tabeli Genres
INSERT INTO Genres (Name) VALUES
('Action'), ('Comedy'), ('Drama'), ('Science Fiction'), ('Horror'), ('Thriller'), ('Romance');

-- Wstawienie danych do tabeli Movies
INSERT INTO Movies (Title, IdDirector, IdGenre, ReleaseYear, Description, AverageRating) VALUES
('Inception', 1, 4, '2010-07-16', 'A thief, Dom Cobb, who steals secrets from within the subconscious during the dream state, is given the reverse task of planting an idea into the mind of a CEO. The high-stakes mission takes Cobb and his team deep into dream layers, each with its own dangers and unpredictable consequences. As they navigate the complexities of shared dreams, Cobb confronts his own inner demons, particularly the haunting memories of his late wife. Inception challenges perceptions of reality and blurs the line between what is real and what is imagined.', NULL),
('The Dark Knight', 1, 1, '2008-07-18', 'In Gotham City, chaos reigns as the Joker, a criminal mastermind with no clear motive beyond destruction, wreaks havoc. Batman, along with Commissioner Gordon and District Attorney Harvey Dent, tries to bring order to the city. The Jokers antics test Batmans resolve, forcing him to confront his own moral boundaries. Meanwhile, Dents transformation into Two-Face adds layers of tragedy to the story. With intense action, psychological depth, and moral dilemmas, The Dark Knight redefines superhero storytelling.', NULL),
('Jurassic Park', 2, 4, '1993-06-11', 'When John Hammond creates a revolutionary theme park populated by genetically engineered dinosaurs, he invites a small group of experts for a sneak preview. But what starts as a dream quickly turns into a nightmare when the parks security systems fail, unleashing the dinosaurs on the visitors. Chaos ensues as the guests fight for survival in a landscape dominated by creatures from the past. Jurassic Park is both a cautionary tale about playing God and a thrilling adventure showcasing groundbreaking visual effects.', NULL),
('Pulp Fiction', 3, 3, '1994-10-14', 'A series of interconnected stories unfold in the seedy underbelly of Los Angeles. From two hitmen debating the meaning of life, to a boxer on the run, to a gangsters wife having a dangerous night out, Pulp Fiction weaves these narratives together in a nonlinear style. The films sharp dialogue, dark humor, and iconic moments make it a cinematic classic. Each character faces moral dilemmas and unpredictable twists, creating a tapestry of crime and redemption.', NULL),
('Alien', 4, 5, '1979-05-25', 'In the depths of space, the crew of the Nostromo investigates a distress signal from a remote planet, only to discover a deadly alien organism. As the creature begins to hunt them one by one, the crew must use their wits to survive. Ripley, the resourceful protagonist, emerges as a powerful figure in the face of overwhelming terror. Alien combines science fiction and horror in a groundbreaking way, with suspenseful storytelling and unforgettable visuals.', NULL),
('Avatar', 5, 4, '2009-12-18', 'Jake Sully, a paraplegic Marine, is sent to the distant planet of Pandora as part of a mission to mine valuable resources. Through an avatar body, he befriends the Navi, the planets indigenous people, and falls in love with their way of life. Torn between his loyalty to the military and his newfound connection to Pandora, Jake must make a choice that could determine the fate of an entire world. Avatar is a visually stunning epic that explores themes of environmentalism, colonialism, and identity.', NULL),
('The Wolf of Wall Street', 6, 3, '2013-12-25', 'Based on the true story of Jordan Belfort, this film chronicles his meteoric rise as a stockbroker and his equally spectacular downfall. From raucous parties to fraudulent schemes, Belforts world is one of excess and debauchery. As he amasses wealth and power, his life spirals out of control, affecting those closest to him. The Wolf of Wall Street is both a darkly comedic take on capitalism and a cautionary tale about the corrupting influence of greed.', NULL),
('The Lord of the Rings: The Fellowship of the Ring', 7, 4, '2001-12-19', 'In the land of Middle-earth, Frodo Baggins, a young hobbit, is entrusted with a dangerous mission: to destroy the One Ring, an artifact of immense power that could bring darkness to the world. Alongside a fellowship of allies, Frodo embarks on a perilous journey through treacherous landscapes, encountering orcs, wizards, and ancient evils. This epic tale of friendship, courage, and sacrifice is the beginning of an unforgettable saga.', NULL),
('Interstellar', 1, 4, '2014-11-07', 'As Earth faces a dire environmental crisis, a group of explorers led by Cooper, a former pilot, travels through a wormhole in search of a new habitable planet. The mission tests their endurance, relationships, and understanding of time and space. With stunning visuals and a thought-provoking narrative, Interstellar explores humanitys resilience and the lengths we go to secure our future. It is both a personal story of love and a grand exploration of the universe.', NULL),
('Blade Runner 2049', 8, 4, '2017-10-06', 'In a dystopian future, K, a young Blade Runner, uncovers a secret that threatens to destabilize what remains of society. As he searches for answers, he encounters Rick Deckard, a former Blade Runner who has been in hiding for decades. Together, they confront questions of identity, humanity, and what it means to be alive. Blade Runner 2049 is a visually breathtaking sequel that builds on the legacy of the original film while exploring new philosophical depths.', NULL),
('The Matrix', 1, 4, '1999-03-31', 'Neo, a computer hacker, discovers the shocking truth: the reality he knows is a simulated construct created by intelligent machines to enslave humanity. Guided by Morpheus and Trinity, Neo joins the resistance to fight against the machines and uncover his destiny as "The One." As he learns to bend the rules of the Matrix, Neo faces life-altering choices and harrowing battles that blur the line between the virtual and real worlds. The Matrix is a groundbreaking sci-fi masterpiece that redefined action and storytelling.', NULL),
('Gladiator', 4, 1, '2000-05-05', 'Maximus Decimus Meridius, a betrayed Roman general, is forced into slavery after the murder of his family by the corrupt Emperor Commodus. As a gladiator, Maximus rises through the ranks, winning the hearts of the people in the Colosseum. Driven by vengeance and justice, he seeks to challenge the emperor and restore Rome to its former glory. Gladiator is an epic tale of honor, resilience, and redemption set against the backdrop of Ancient Rome.', NULL),
('Schindlers List', 2, 3, '1993-11-30', 'Oskar Schindler, a German businessman, witnesses the horrors of the Holocaust and takes extraordinary risks to save the lives of over a thousand Jewish refugees by employing them in his factories. Through his efforts, Schindler transforms from a profiteer to a hero, demonstrating the power of compassion in the face of unimaginable evil. Schindlers List is a haunting and deeply moving portrayal of one mans courage and the triumph of humanity.', NULL),
('Goodfellas', 6, 3, '1990-09-19', 'Henry Hill rises through the ranks of the American Mafia, enjoying a life of crime, luxury, and camaraderie. However, his world begins to crumble as greed, paranoia, and betrayal take their toll on the mob hierarchy. Based on a true story, Goodfellas offers an unflinching look at the allure and consequences of organized crime, with unforgettable characters and razor-sharp storytelling that cemented its place as a crime genre classic.', NULL),
('Titanic', 5, 7, '1997-12-19', 'On the ill-fated maiden voyage of the RMS Titanic, a young aristocrat, Rose, falls in love with Jack, a penniless artist. Their romance transcends social barriers, but their love is tested as the ship meets its tragic end. As chaos unfolds, Rose must choose between her privileged life and the man who has changed her forever. Titanic is a sweeping romantic tragedy that captures the grandeur and heartbreak of one of historys greatest maritime disasters.', NULL),
('The Hobbit: An Unexpected Journey', 7, 4, '2012-12-14', 'Bilbo Baggins, a reluctant hobbit, is swept into an epic quest to reclaim the lost kingdom of Erebor from the fearsome dragon Smaug. Accompanied by a company of dwarves and the mysterious Gandalf, Bilbo faces trolls, goblins, and other perils as he discovers courage he never knew he had. Along the way, he encounters the creature Gollum and a fateful ring that will shape Middle-earths destiny. This adventure marks the beginning of a legendary journey.', NULL),
('Django Unchained', 3, 3, '2012-12-25', 'Django, a freed slave, teams up with Dr. King Schultz, a German bounty hunter, to rescue his wife from a brutal plantation owner, Calvin Candie. As the unlikely duo navigates the dangerous landscape of the antebellum South, Django hones his skills as a gunslinger and confronts the horrors of slavery. Filled with sharp dialogue, intense action, and moments of dark humor, Django Unchained is a bold reimagining of the Western genre.', NULL),
('E.T. the Extra-Terrestrial', 2, 4, '1982-06-11', 'When a gentle alien is stranded on Earth, he forms a deep bond with a young boy named Elliott. Together, they embark on an adventure to reunite E.T. with his home planet, all while evading government agents determined to capture the extraterrestrial. This heartwarming story of friendship, love, and wonder captures the magic of childhood and remains a timeless classic. E.T. reminds audiences of the power of connection across worlds.', NULL),
('The Shining', 4, 5, '1980-05-23', 'Jack Torrance, a struggling writer, becomes the winter caretaker of the isolated Overlook Hotel, bringing along his wife Wendy and son Danny. As the hotels dark secrets begin to surface, Jack descends into madness, putting his family in grave danger. Danny, who possesses psychic abilities, discovers the horrific history of the hotel and fights to survive. The Shining is a chilling exploration of isolation, madness, and the supernatural, solidifying its place as a horror classic.', NULL),
('The Irishman', 6, 3, '2019-11-01', 'Frank Sheeran, an aging hitman, reflects on his life in the mob, recounting his role in pivotal events, including the disappearance of labor leader Jimmy Hoffa. Through decades of betrayal, loyalty, and violence, Frank grapples with the choices that defined his life. The Irishman is a poignant exploration of mortality, regret, and the heavy toll of a life lived in the shadows. It is a masterful epic that spans generations.', NULL);

-- Wstawienie danych do tabeli Reviews
INSERT INTO Reviews (IdUser, IdMovie, Rating, Content, Date) VALUES
(1, 1, 0, 'An absolute masterpiece with stunning visuals and a complex story.', '2023-01-15'),
(1, 2, 0, 'A brilliant portrayal of Gotham with incredible performances.', '2023-01-16'),
(1, 4, 0, 'Tarantino at his finest, a must-watch classic.', '2023-01-17'),
(2, 3, 0, 'A visually stunning film with a strong emotional core.', '2023-01-18'),
(2, 9, 0, 'A gripping tale of survival and science, truly inspiring.', '2023-01-20'),
(2, 8, 0, 'A breathtaking epic with incredible performances and storytelling.', '2023-01-23'),
(2, 10, 0, 'A thought-provoking sci-fi classic that stands the test of time.', '2023-01-24'),
(3, 6, 0, 'Incredible visuals and a touching story about belonging.', '2023-01-25'),
(3, 7, 0, 'A wild ride through greed, excess, and chaos.', '2023-01-26'),
(4, 5, 0, 'A suspenseful, terrifying masterpiece of sci-fi horror.', '2023-01-27'),
(1, 11, 0, 'A groundbreaking sci-fi film that redefined the genre.', '2023-01-28'),
(2, 12, 0, 'An epic tale of revenge and redemption, beautifully executed.', '2023-01-29'),
(3, 13, 0, 'One of the most powerful and moving films ever made.', '2023-01-30'),
(4, 14, 0, 'A gritty and unflinching look at the world of organized crime.', '2023-01-31'),
(5, 15, 0, 'A timeless love story with incredible visuals and music.', '2023-02-01'),
(1, 16, 0, 'A fun and adventurous journey through Middle-earth.', '2023-02-02'),
(2, 17, 0, 'Tarantino delivers another thrilling and thought-provoking masterpiece.', '2023-02-03'),
(3, 18, 0, 'A heartwarming and emotional story about friendship and love.', '2023-02-04'),
(4, 19, 0, 'A haunting and suspenseful film with brilliant performances.', '2023-02-05'),
(5, 20, 0, 'An epic crime saga with stellar acting and direction.', '2023-02-06'),
(1, 11, 0, 'A visually stunning and intellectually engaging sci-fi classic.', '2023-02-07'),
(2, 12, 0, 'Russell Crowe shines in this incredible historical epic.', '2023-02-08'),
(3, 13, 0, 'Steven Spielberg at his very best. A must-watch.', '2023-02-09'),
(4, 14, 0, 'A gripping and intense mob drama that keeps you hooked.', '2023-02-10'),
(5, 15, 0, 'Heartbreaking and beautiful. A true masterpiece.', '2023-02-11'),
(1, 16, 0, 'An entertaining fantasy film with a great cast and stunning visuals.', '2023-02-12'),
(2, 17, 0, 'A powerful story with unforgettable characters and moments.', '2023-02-13'),
(3, 18, 0, 'A touching and magical experience that stays with you.', '2023-02-14'),
(4, 19, 0, 'Jack Nicholson delivers an unforgettable performance.', '2023-02-15'),
(5, 20, 0, 'A compelling and introspective look at life in the mob.', '2023-02-16'),
(2, 11, 0, 'The Matrix is a cinematic masterpiece that combines action and philosophy.', '2023-02-17'),
(3, 12, 0, 'Gladiator is a powerful and emotional journey.', '2023-02-18'),
(4, 13, 0, 'Schindler’s List is an unforgettable film that everyone should see.', '2023-02-19'),
(5, 14, 0, 'Goodfellas is an incredible film with great storytelling.', '2023-02-20'),
(1, 15, 0, 'Titanic is a visually stunning and emotional masterpiece.', '2023-02-21');