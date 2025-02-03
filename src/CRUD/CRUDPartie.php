<?php
    require_once "../Classes/Partie.php";
    require_once "../Utils/connectionSingleton.php";
    
    function createPartie(string $idPartie, string $datePartie, int $nbJoueur): bool {
        $connexion = ConnexionSingleton::getInstance();
        
        $query = "INSERT INTO Partie (idPartie, datePartie, nbJoueur) VALUES (:idPartie, :datePartie, :nbJoueur)";
        
        $statement = $connexion->prepare($query);
        
        $statement->bindParam(':idPartie', $idPartie);
        $statement->bindParam(':datePartie', $datePartie);
        $statement->bindParam(':nbJoueur', $nbJoueur);
        
        return $statement->execute();
    }

    function readPartie(string $idPartie): ?Partie {
        $connexion = ConnexionSingleton::getInstance();
        
        $query = "SELECT * FROM Partie WHERE idPartie = :idPartie";
        
        $statement = $connexion->prepare($query);
        
        $statement->bindParam(':idPartie', $idPartie);
        
        $statement->execute();
        
        $results = $statement->fetch(PDO::FETCH_ASSOC);
        
        if(gettype($results) != "boolean") {
            return new Partie($results['idPartie'], $results['datePartie'], $results['statut'], $results['scoreTotalPartie'], $results['nbJoueur']);
        }
        return null;
    }

    function readPartieByLien(string $lienPartie): ?Partie {
        $connexion = ConnexionSingleton::getInstance();
        
        $query = "SELECT * FROM Partie WHERE idPartie = :lienPartie";
        
        $statement = $connexion->prepare($query);
        
        $statement->bindParam(':lienPartie', $lienPartie);
        
        $statement->execute();
        
        $results = $statement->fetch(PDO::FETCH_ASSOC);
        
        if(gettype($results) != "boolean") {
            return new Partie($results['idPartie'], $results['datePartie'], $results['statut'], $results['scoreTotalPartie'], $results['nbJoueur']);
        }
        return null;
    }
?>