-- Users
insert into users (name, password, email) values
("Admina","secret","admina@gmail.com"), 
('John Doe', "Johnny123", "johndoe@gmail.com"),
('Jane Smith', "00001234", "janesmith@gmail.com"),
('Emily Johnson', "JohnsonEm1", "emilyjohnson@gmail.com");



-- Halls
INSERT INTO halls (name, size) VALUES ('Main Hall', 50);
INSERT INTO halls (name, size) VALUES ('Lounge Lagoon', 12);
INSERT INTO halls (name, size) VALUES ('Harmony Hall', 30);


-- Bookings
INSERT INTO bookings (halls_id, users_id, bookedDate, bookedTime, event) VALUES 
(1, 1, '2024-12-16', '10:00:00',''),
(1, 2, '2024-12-16', '11:00:00','Bemutató'),
(1, 3, '2024-12-16', '15:00:00',''),
(2, 1, '2024-12-16', '14:00:00','XYZ konferenceia'),
(2, 2, '2024-12-16', '11:00:00',''),
(2, 3, '2024-12-16', '15:00:00',''),
(3, 3, '2024-12-16', '15:00:00','Bemutató'),

(3, 1, '2024-12-17', '10:00:00',''),
(3, 2, '2024-12-17', '11:00:00','Bemutató'),
(3, 3, '2024-12-17', '15:00:00',''),
(2, 1, '2024-12-17', '14:00:00',''),
(2, 2, '2024-12-17', '11:00:00',' ABC megbeszélés'),
(2, 3, '2024-12-17', '15:00:00',''),
(1, 3, '2024-12-17', '15:00:00',''),

(2, 1, '2024-12-18', '10:00:00',''),
(2, 2, '2024-12-18', '11:00:00',''),
(2, 3, '2024-12-18', '15:00:00','Bemutató'),
(1, 1, '2024-12-18', '14:00:00',''),
(1, 2, '2024-12-18', '11:00:00',''),
(1, 3, '2024-12-18', '15:00:00','Bemutató'),
(3, 3, '2024-12-18', '15:00:00','');