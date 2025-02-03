CREATE TABLE Joueur (
   idJoueur VARCHAR(50) PRIMARY KEY,
   pseudo VARCHAR(25) NOT NULL,
   mdp VARCHAR(50) NOT NULL,
   email VARCHAR(50) NOT NULL,
   bio VARCHAR(50),
   douzCoins INT NOT NULL DEFAULT 0,
   dateInscription DATE NOT NULL,
   avatarChemin VARCHAR(50) NOT NULL,
   idMusique INT NOT NULL,
   idTheme INT NOT NULL,
   nbPartieGagnees SMALLINT DEFAULT 0,
   scoreMax SMALLINT DEFAULT 0,
   tempsJeu TIME,
   ratioVictoire FLOAT DEFAULT 0,
   nbSucces SMALLINT DEFAULT 0,
   nbPartiesJouees SMALLINT DEFAULT 0,
   nbDouzhee SMALLINT DEFAULT 0,
   FOREIGN KEY (idMusque) REFERENCES Musique(idMusique),
   FOREIGN KEY (idTheme) REFERENCES Theme(idTheme)
);

CREATE TABLE Partie (
   idPartie VARCHAR(50) PRIMARY KEY,
   datePartie DATE NOT NULL,
   statut VARCHAR(25) NOT NULL DEFAULT 'en cours',
   scoreTotalPartie SMALLINT DEFAULT 0,
   nbJoueur TINYINT NOT NULL,
   CHECK (nbJoueur BETWEEN 2 AND 4),
   CHECK (statut IN ('en cours', 'terminé', 'annulé'))
);

CREATE TABLE Succes (
   idSucces SMALLINT PRIMARY KEY,
   nomSucces VARCHAR(50) NOT NULL,
   conditionSucces VARCHAR(50) NOT NULL,
   typeSucces VARCHAR(50) NOT NULL
);

CREATE TABLE Theme (
   idTheme SMALLINT PRIMARY KEY,
   nomTheme VARCHAR(25) NOT NULL,
   prix SMALLINT NOT NULL
);

CREATE TABLE Musique (
   idMusique SMALLINT PRIMARY KEY,
   nomMusique VARCHAR(25) NOT NULL,
   cheminMusique VARCHAR(75),
   prix SMALLINT
);

CREATE TABLE JoueurPartie (
   idJoueur VARCHAR(50),
   idPartie VARCHAR(50),
   positionPartie TINYINT,
   score SMALLINT,
   estGagant BOOLEAN,
   PRIMARY KEY (idJoueur, idPartie),
   CHECK (positionPartie BETWEEN 2 AND 4),
   FOREIGN KEY (idJoueur) REFERENCES Joueur(idJoueur),
   FOREIGN KEY (idPartie) REFERENCES Partie(idPartie)
);

CREATE TABLE SuccesJoueur (
   idJoueur VARCHAR(50),
   idSucces SMALLINT,
   PRIMARY KEY (idJoueur, idSucces),
   FOREIGN KEY (idJoueur) REFERENCES Joueur(idJoueur),
   FOREIGN KEY (idSucces) REFERENCES Succes(idSucces)
);

CREATE TABLE AcheterTheme (
   idJoueur VARCHAR(50),
   idTheme SMALLINT,
   PRIMARY KEY (idJoueur, idTheme),
   FOREIGN KEY (idJoueur) REFERENCES Joueur(idJoueur),
   FOREIGN KEY (idTheme) REFERENCES Theme(idTheme)
);

CREATE TABLE AcheterMusique (
   idJoueur VARCHAR(50),
   idMusique SMALLINT,
   PRIMARY KEY (idJoueur, idMusique),
   FOREIGN KEY (idJoueur) REFERENCES Joueur(idJoueur),
   FOREIGN KEY (idMusique) REFERENCES Musique(idMusique)
);
