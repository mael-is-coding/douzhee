<?php
    require_once "../Classes/SuccesJoueur.php";
    require_once "../Utils/connectionSingleton.php";

    function createSuccessJoueur($idJoueur, $idSucces) :bool {
        $conn = ConnexionSingleton::getInstance();
        $stmt = $conn->prepare("INSERT INTO SuccesJoueur (idJoueur, idSucces) VALUES (?, ?)");
        $stmt->bindParam(1, $idJoueur);
        $stmt->bindParam(2, $idSucces);

        return $stmt->execute();
    }

    function readSuccessJoueur(string $idJoueur, int $idSucces): bool {
        $connection = ConnexionSingleton::getInstance();
        $stmt = $connection->prepare("SELECT COUNT(*) FROM SuccesJoueur WHERE idJoueur = ? AND idSucces = ?");
        
        $stmt->bindParam(1, $idJoueur, PDO::PARAM_STR);
        $stmt->bindParam(2, $idSucces, PDO::PARAM_INT);
        
        $stmt->execute();
        $count = $stmt->fetchColumn();
        
        return $count > 0;
    }

    function readAllSuccessJoueur(string $idJoueur): ?array {
        $connection = ConnexionSingleton::getInstance();
        $stmt = $connection->prepare("SELECT * FROM SuccesJoueur WHERE idJoueur = ?");
        
        $stmt->bindParam(1, $idJoueur, PDO::PARAM_STR);
        
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if(gettype($results) != "boolean") {
            return $results;
        }
        return null;
    }
    
?>