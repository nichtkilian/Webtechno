CREATE TABLE news (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO news (title, description, image, created_at) VALUES
('Neuer Wellness-Bereich eröffnet', 'Wir freuen uns, unseren neuen Wellness-Bereich zu präsentieren! Besuchen Sie uns und genießen Sie entspannende Massagen, eine Sauna und vieles mehr.', 'images/wellness.jpg', '2024-11-01 10:00:00'),
('Saisonales Herbst-Menü verfügbar', 'Unser Küchenchef hat ein besonderes Herbst-Menü für Sie zusammengestellt. Genießen Sie saisonale Spezialitäten mit Kürbis, Wild und mehr.', 'images/herbst-menu.jpg', '2024-11-10 15:30:00'),
('Familienangebote im Dezember', 'Planen Sie Ihre Weihnachtsferien bei uns! Im Dezember bieten wir spezielle Familienangebote mit Kinderaktivitäten und Festtagsmenüs.', 'images/familienangebote.jpg', '2024-11-20 08:00:00');


CREATE TABLE reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    checkin DATE NOT NULL,
    checkout DATE NOT NULL,
    breakfast BOOLEAN DEFAULT FALSE,
    parking BOOLEAN DEFAULT FALSE,
    pets VARCHAR(255),
    status ENUM('neu', 'bestätigt', 'storniert') DEFAULT 'neu',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role ENUM('admin', 'user') DEFAULT 'user',
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    salutation ENUM('Frau', 'Herr', 'Divers') NOT NULL,
    name VARCHAR(255) NOT NULL,
    surname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (role, username, password, salutation, name, surname, email) VALUES
('admin', 'admin', '$2y$10$pEvJ1jccrXxCX6ovuu7KKeeeYAoQikNvhKih1IRKDA6K1tk7tnl1C', 'Herr', 'Kamil', 'Bienias', 'wi23b117@technikum-wien.at');