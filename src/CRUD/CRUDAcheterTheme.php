<?php
    require_once "../Classes/AcheterTheme.php";
    require_once "../Utils/connectionSingleton.php";

    function creatAcheterTheme(string $idJoueur, int $idTheme): bool {
        $connexion = ConnexionSingleton::getInstance();

        $query = "INSERT INTO AcheterTheme (idJoueur, idTheme) VALUES (:idJoueur, :idTheme)";

        $statement = $connexion->prepare($query);

        $statement->bindParam(':idJoueur', $idJoueur);
        $statement->bindParam(':idTheme', $idTheme);

        return $statement->execute();
    }

    function readAllAcheterTheme(string $idJoueur): ?array {
        $connexion = ConnexionSingleton::getInstance();
    
        $query = "SELECT * FROM AcheterTheme WHERE idJoueur = :idJoueur";
    
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