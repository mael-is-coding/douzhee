<?php
    require_once "../Classes/JoueurPartie.php";
    require_once "../Utils/connectionSingleton.php";

    function createJoueurPartie(string $idJoueur, string $idPartie, int $positionPartie): bool {
        $connexion = ConnexionSingleton::getInstance();

        $query = "INSERT INTO JoueurPartie (idJoueur, idPartie, positionPartie) VALUES (:idJoueur, :idPartie, :positionPartie)";

        $statement = $connexion->prepare($query);

        $statement->bindParam(':idJoueur', $idJoueur);
        $statement->bindParam(':idPartie', $idPartie);
        $statement->bindParam(':positionPartie', $positionPartie);    

        return $statement->execute();
    }

    function readJoueurPartie(string $idJoueur, string $idPartie): ?JoueurPartie {
        $connexion = ConnexionSingleton::getInstance();

        $query = "SELECT * FROM JoueurPartie WHERE idJoueur = :idJoueur AND idPartie = :idPartie";

        $statement = $connexion->prepare($query);

        $statement->bindParam(':idJoueur', $idJoueur);
        $statement->bindParam(':idPartie', $idPartie);

        $statement->execute();

        $results = $statement->fetch(PDO::FETCH_ASSOC);

        if(gettype($results) != "boolean") {
            return new JoueurPartie($results['idJoueur'], $results['idPartie'], $results['positionPartie'], $results['score'], $results['estGagant']);
        }
        return null;
    }

    function readIdPartieEnCours(string $idJoueur): bool {
        $connexion = ConnexionSingleton::getInstance();

        $query = "SELECT * FROM JoueurPartie WHERE idJoueur = :idJoueur AND estGagant = 0";

        $statement = $connexion->prepare($query);

        $statement->bindParam(':idJoueur', $idJoueur);

        $statement->execute();

        $results = $statement->fetch(PDO::FETCH_ASSOC);

        if ($results) {
            return true;
        }
        return false;
    }

    function readPartieEnCours(string $idJoueur): bool {
        $connexion = ConnexionSingleton::getInstance();

        $query = "SELECT * FROM JoueurPartie WHERE idJoueur = :idJoueur";

        $statement = $connexion->prepare($query);

        $statement->bindParam(':idJoueur', $idJoueur);

        $statement->execute();

        $results = $statement->fetch(PDO::FETCH_ASSOC);

        if ($results) {
            return true;
        }
        return false;
    }

    function readPositionIsUsed(string $idPartie, int $positionPartie): bool {
        $connexion = ConnexionSingleton::getInstance();

        $query = "SELECT * FROM JoueurPartie WHERE idPartie = :idPartie AND positionPartie = :positionPartie";

        $statement = $connexion->prepare($query);

        $statement->bindParam(':idPartie', $idPartie);
        $statement->bindParam(':positionPartie', $positionPartie);

        $statement->execute();

        $results = $statement->fetch(PDO::FETCH_ASSOC);

        if ($results) {
            return true;
        }
        return false;
    }
?>