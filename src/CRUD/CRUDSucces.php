<?php
    require_once "../Classes/Succes.php";
    require_once "../Utils/connectionSingleton.php";

    function createSucces(string $nomSucces, string $conditionSucces, string $typeSucces) :bool {
        $conn = ConnexionSingleton::getInstance();
        $stmt = $conn->prepare("INSERT INTO Succes (nomSucces, Condition, typeSucces) VALUES (?, ?, ?)");
        $stmt->bindParam(1, $nomSucces);
        $stmt->bindParam(2, $conditionSucces);
        $stmt->bindParam(3, $typeSucces);

        return $stmt->execute();
    }

    function readSucces(int $idSucces) : Succes | null {
        $connexion = ConnexionSingleton::getInstance();
        $query = "SELECT * FROM Succes WHERE idSucces = $idSucces";
    
        $statement = $connexion->prepare($query);
    
        $success = $statement->execute();
    
        if($success) {
            $results = $statement->fetch(PDO::FETCH_ASSOC);
            if ($results == false) {
                return null;
            } return new Succes($results['idSucces'], $results['nomSucces'], $results['Condition'], $results['typeSucces']);
        }
    }

    function readAllSucces() : ?array {
        $connexion = ConnexionSingleton::getInstance();
        $query = "SELECT * FROM Succes";
    
        $statement = $connexion->prepare($query);
    
        $success = $statement->execute();
    
        if($success) {
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            if ($results == false) {
                return null;
            } return $results;
        }
    }

?>