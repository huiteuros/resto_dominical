CREATE TABLE type (
    id_type INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL
);

CREATE TABLE lieu (
    id_lieu INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    adresse VARCHAR(255),
    id_type INT,
    FOREIGN KEY (id_type) REFERENCES type(id_type)
);

CREATE TABLE avis (
    id_avis INT AUTO_INCREMENT PRIMARY KEY,
    id_copain INT NOT NULL,
    id_lieu INT NOT NULL,
    avis TEXT,
    note_general DECIMAL(3,1),
    reco BOOLEAN,
    FOREIGN KEY (id_copain) REFERENCES copain(id_copain),
    FOREIGN KEY (id_lieu) REFERENCES lieu(id_lieu)
);
