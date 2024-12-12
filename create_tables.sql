CREATE TABLE news (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO news (title, description, image, created_at) VALUES
('Neuer Wellness-Bereich er&ouml;ffnet', 'Wir freuen uns, unseren neuen Wellness-Bereich zu pr&auml;sentieren! Besuchen Sie uns und genie&szlig;en Sie entspannende Massagen, eine Sauna und vieles mehr.', 'images/wellness.jpg', '2024-11-01 10:00:00'),
('Saisonales Herbst-Men&uuml; verf&uuml;gbar', 'Unser K&uuml;chenchef hat ein besonderes Herbst-Men&uuml; f&uuml;r Sie zusammengestellt. Genie&szlig;en Sie saisonale Spezialit&auml;ten mit K&uuml;rbis, Wild und mehr.', 'images/herbst-menu.jpg', '2024-11-10 15:30:00'),
('Familienangebote im Dezember', 'Planen Sie Ihre Weihnachtsferien bei uns! Im Dezember bieten wir spezielle Familienangebote mit Kinderaktivit&auml;ten und Festtagsmen&uuml;s.', 'images/familienangebote.jpg', '2024-11-20 08:00:00');


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
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);