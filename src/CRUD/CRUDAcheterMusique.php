<?php
    require_once "../Classes/AcheterMusique.php";
    require_once "../Utils/connectionSingleton.php";

    function creatAcheterMusique(string $idJoueur, int $idMusique): bool {
        $connexion = ConnexionSingleton::getInstance();

        $query = "INSERT INTO AcheterMusique (idJoueur, idMusique) VALUES (:idJoueur, :idMusique)";

        $statement = $connexion->prepare($query);

        $statement->bindParam(':idJoueur', $idJoueur);
        $statement->bindParam(':idMusique', $idMusique);

        try {
            return $statement->execute();
        } catch (PDOException $ex) {
            return false; // le champs existe probablement déjà avec ces clés primaires
        }
    }

    function readAllAcheterMusique(string $idJoueur): ?array {
        $connexion = ConnexionSingleton::getInstance();
    
        $query = "SELECT * FROM AcheterMusique WHERE idJoueur = :idJoueur";
    
        $statement = $connexion->prepare($query);
        $statement->bindParam(':idJoueur', $idJoueur, PDO::PARAM_STR);
    
        $statement->execute();
    
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    
        if ($results !== false) {
            return $results;
        }
        return null;
    }
?>