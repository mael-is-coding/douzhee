<?php

    require_once $_SERVER['DOCUMENT_ROOT'] . "/douzhee/src/Classes/Article.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/douzhee/src/Utils/connectionSingleton.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/douzhee/src/CRUD/CRUDCreer.php";

    function createArticle(String $titre, String $contenu, int $idJoueur) {
        $connection = ConnexionSingleton::getInstance();
        $insertQuery = "INSERT INTO article (titre, contenu) VALUES (:titre, :contenu)";
        $statement = $connection->prepare($insertQuery);
        $statement->bindParam(":titre", $titre);
        $statement->bindParam(":contenu", $contenu);
        $statement->execute();
        $idArticle = $connection->lastInsertId();
        createCreer($idArticle, $idJoueur);
    }
    function readArticleById($idA){
        $connection = ConnexionSingleton::getInstance();
        $readQuery = "SELECT * FROM article WHERE id = :idA";
        $statement = $connection->prepare($readQuery);
        $statement->bindParam(":idA", $idA);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
    
        return new Article($result['id'], $result['contenu'], $result['titre']);
    }
    function readAllArticle(){
        $connection = ConnexionSingleton::getInstance();
        $readQuery = "SELECT * FROM article";
        $statement = $connection->prepare($readQuery);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    function getTitleById($idA){
        $connection = ConnexionSingleton::getInstance();
        $readQuery = "SELECT titre FROM article WHERE id = :idA";
        $statement = $connection->prepare($readQuery);
        $statement->bindParam(":idA", $idA);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
    function getContenuById($idA){
        $connection = ConnexionSingleton::getInstance();
        $readQuery = "SELECT contenu FROM article WHERE id = :idA";
        $statement = $connection->prepare($readQuery);
        $statement->bindParam(":idA", $idA);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
?>