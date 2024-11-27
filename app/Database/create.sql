DROP TABLE IF EXISTS Commentaire;
DROP TABLE IF EXISTS Groupe;
DROP TABLE IF EXISTS Tache;
DROP TABLE IF EXISTS Projet;
DROP TABLE IF EXISTS Utilisateur;

-- Création de la table Utilisateur
CREATE TABLE Utilisateur (
	idUtil SERIAL PRIMARY KEY,
	mail VARCHAR(255) NOT NULL UNIQUE,
	nom VARCHAR(100) NOT NULL,
	prenom VARCHAR(100) NOT NULL,
	createAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	mdp VARCHAR(255) NOT NULL,
	resetToken VARCHAR(255),
	resetTokenExpiration TIMESTAMP
);

-- Création de la table Projet
CREATE TABLE Projet (
	idProjet SERIAL PRIMARY KEY,
	titreProjet VARCHAR(255) NOT NULL,
	descriptionProjet TEXT
);

-- Création de la table Tache
CREATE TABLE Tache (
	idTache SERIAL PRIMARY KEY,
	titre VARCHAR(255) NOT NULL,
	description TEXT,
	echeance DATE NOT NULL,
	priorite VARCHAR(50) CHECK (statut IN ('Faible', 'Moyenne', 'Forte')),
	statut VARCHAR(50) CHECK (statut IN ('En cours', 'Terminée', 'A Faire')),
	dateCreation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	idProjet INT REFERENCES Projet(idProjet) ON DELETE CASCADE -- Relation avec Projet
);

-- Création de la table Commentaire
CREATE TABLE Commentaire (
	idCom SERIAL PRIMARY KEY,
	contenu TEXT NOT NULL,
	dateCom TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	idUtil INT REFERENCES Utilisateur(idUtil) ON DELETE CASCADE, -- Relation avec Utilisateur
	idTache INT REFERENCES Tache(idTache) ON DELETE CASCADE -- Relation avec Tache
);

-- Création de la table Groupe (relation entre Utilisateur et Projet)
CREATE TABLE Groupe (
	idUtil INT REFERENCES Utilisateur(idUtil) ON DELETE CASCADE, -- Relation avec Utilisateur
	idProjet INT REFERENCES Projet(idProjet) ON DELETE CASCADE, -- Relation avec Projet
	PRIMARY KEY (idUtil, idProjet) -- Clé primaire composée
);
