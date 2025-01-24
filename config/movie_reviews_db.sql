CREATE DATABASE movie_reviews_db;

USE movie_reviews_db;

CREATE TABLE Roles (
  IdRole int NOT NULL IDENTITY(1,1) PRIMARY KEY,
  Rolename varchar(100) NOT NULL
);

CREATE TABLE Users (
  IdUser int NOT NULL IDENTITY(1,1) PRIMARY KEY,
  Username varchar(100) NOT NULL,
  Password varchar(100) NOT NULL,
  Email varchar(100) NOT NULL,
  IdRole int NOT NULL FOREIGN KEY REFERENCES Roles(IdRole),
  UNIQUE (username, email)
);

CREATE TABLE Genres (
  IdGenre int NOT NULL IDENTITY(1,1) PRIMARY KEY,
  Name varchar(100) NOT NULL
);

CREATE TABLE Directors (
  IdDirector int NOT NULL IDENTITY(1,1) PRIMARY KEY,
  Name varchar(100) NOT NULL
);

CREATE TABLE Movies (
  IdMovie int NOT NULL IDENTITY(1,1) PRIMARY KEY,
  Title varchar(100) NOT NULL,
  IdDirector int NOT NULL FOREIGN KEY REFERENCES Directors(IdDirector),
  IdGenre int NOT NULL FOREIGN KEY REFERENCES Genres(IdGenre),
  Year date NOT NULL,
  Description varchar(2000) NOT NULL
);

CREATE TABLE Reviews (
  IdReview int NOT NULL IDENTITY(1,1) PRIMARY KEY,
  IdUser int NOT NULL FOREIGN KEY REFERENCES Users(IdUser),
  IdMovie int NOT NULL FOREIGN KEY REFERENCES Movies(IdMovie),
  Rating tinyint NOT NULL,
  Content varchar(4000) NOT NULL,
  Date date NOT NULL
);


-- Wstawienie rekordów do tabeli Roles
INSERT INTO Roles (Rolename) VALUES
('User'),
('Admin');

-- Wstawienie rekordów do tabeli Users
INSERT INTO Users (Username, Password, Email, IdRole) VALUES
('Nikola', 'Nikola', 'nikola@example.com', 1), -- Zwykły użytkownik
('Kris', 'Kris', 'kris@example.com', 1), -- Zwykły użytkownik
('Boss', 'Boss', 'boss@example.com', 2); -- Administrator

-- Wstawienie rekordów do tabeli Genres
INSERT INTO Genres (Name) VALUES
('Action'),
('Comedy'),
('Drama'),
('Science Fiction');

-- Wstawienie rekordów do tabeli Directors
INSERT INTO Directors (Name) VALUES
('Christopher Nolan'),
('Steven Spielberg'),
('Quentin Tarantino'),
('Ridley Scott');

-- Wstawienie rekordów do tabeli Movies
INSERT INTO Movies (Title, IdDirector, IdGenre, Year, Description) VALUES
('Inception', 1, 1, '2010-07-16', 'A mind-bending thriller about dream invasion.'),
('The Dark Knight', 1, 1, '2008-07-18', 'A crime-fighting vigilante battles the Joker.'),
('Interstellar', 1, 4, '2014-11-07', 'A team of explorers travel through a wormhole in space.'),
('Jurassic Park', 2, 4, '1993-06-11', 'Scientists bring dinosaurs back to life.'),
('E.T. the Extra-Terrestrial', 2, 4, '1982-06-11', 'A young boy befriends an alien.'),
('Pulp Fiction', 3, 3, '1994-10-14', 'Interconnected stories of crime in Los Angeles.'),
('Kill Bill: Volume 1', 3, 1, '2003-10-10', 'A woman seeks revenge on her former team.'),
('Gladiator', 4, 1, '2000-05-05', 'A Roman general seeks revenge after being betrayed.'),
('The Martian', 4, 4, '2015-10-02', 'An astronaut becomes stranded on Mars.'),
('Blade Runner', 4, 4, '1982-06-25', 'A blade runner must hunt down rogue androids.');

-- Wstawienie rekordów do tabeli Reviews
INSERT INTO Reviews (IdUser, IdMovie, Rating, Content, Date) VALUES
(1, 1, 5, 'An absolute masterpiece with stunning visuals and a complex story.', '2023-01-15'),
(1, 2, 4, 'A brilliant portrayal of Gotham with incredible performances.', '2023-01-16'),
(1, 6, 5, 'Tarantino at his finest, a must-watch classic.', '2023-01-17'),
(2, 3, 4, 'A visually stunning film with a strong emotional core.', '2023-01-18'),
(2, 7, 3, 'The fight scenes were great, but the story felt lacking.', '2023-01-19'),
(2, 9, 5, 'A gripping tale of survival and science, truly inspiring.', '2023-01-20'),
(3, 4, 5, 'Spielberg creates magic with dinosaurs, still holds up today.', '2023-01-21'),
(3, 5, 4, 'A heartwarming tale of friendship with an alien twist.', '2023-01-22'),
(3, 8, 5, 'A breathtaking epic with incredible performances and storytelling.', '2023-01-23'),
(3, 10, 4, 'A thought-provoking sci-fi classic that stands the test of time.', '2023-01-24');
