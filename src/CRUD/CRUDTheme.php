<?php
    require_once "../Classes/Theme.php";
    require_once "../Utils/connectionSingleton.php";
    
    /**
     * @author Mael
     * @brief retourne tout les thèmes, null sinon
     * @return array|null
     */
    function readAllThemes(): ?array {
        $connexion = ConnexionSingleton::getInstance();
    
        $query = "SELECT * FROM Theme";
    
        $statement = $connexion->prepare($query);
    
        $statement->execute();
    
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    
        if(gettype($results) != "boolean") {
            return $results;
        }
        return null;
    }

    /**
     * @brief retourne le prix d'un thème, null sinon
     * @param int $id
     * @return int|null
     */
    function readThemePrice(int $id): ?int {
        $connexion = ConnexionSingleton::getInstance();
        $query = "SELECT prix FROM Theme WHERE idTheme = :id";
        $statement = $connexion->prepare($query);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if ($result !== false) {
            return (int)$result['prix'];
        }
        return null;
    }

    /**
     * @brief retourne un thème, null sinon
     * @param int $id
     * @return Theme|null
     */
    function readTheme(int $id) :?Theme {
        $connexion = ConnexionSingleton::getInstance();
    
        $query = "SELECT * FROM Theme WHERE idTheme = :id";
    
        $statement = $connexion->prepare($query);
    
        $statement->bindParam(':id', $id);
    
        $statement->execute();
    
        $results = $statement->fetch(PDO::FETCH_ASSOC);
    
        if(gettype($results) != "boolean") {
            return new Theme($results['idTheme'], $results['nomTheme'], $results['prix'], $results['imgChemin']);
        }
        return null;
    }
?>