DELIMITER //

CREATE TRIGGER trg_after_insert_joueur
AFTER INSERT ON Joueur
FOR EACH ROW
BEGIN
    INSERT INTO AcheterTheme (idJoueur, idTheme)
    VALUES (NEW.idJoueur, 1);
    INSERT INTO AcheterMusique (idJoueur, idMusique)
    VALUES (NEW.idJoueur, 1);
END//

DELIMITER ;

DELIMITER //

CREATE TRIGGER trg_after_delete_joueur
AFTER DELETE ON Joueur
FOR EACH ROW
BEGIN
    DELETE FROM AcheterTheme
    WHERE idJoueur = OLD.idJoueur;

    DELETE FROM AcheterMusique
    WHERE idJoueur = OLD.idJoueur;

    DELETE FROM JoueurPartie
    WHERE idJoueur = OLD.idJoueur;
END//

DELIMITER ;