<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . "/douzhee/src/Classes/Creer.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/douzhee/src/Utils/connectionSingleton.php";

    function createCreer($idJoueur, $idArticle){
        $connection = ConnexionSingleton::getInstance();
        $insertQuery = "INSERT INTO creer (idJoueur, idArticle) VALUES (:idJoueur, :idArticle)";
        $statement = $connection->prepare($insertQuery);
        $statement->bindParam(":idJoueur", $idJoueur);
        $statement->bindParam(":idArticle", $idArticle);
        return $statement->execute();
    }
    function readCreatorbyArticle($idArticle){
        $connection = ConnexionSingleton::getInstance();
        $readQuery = "SELECT j.pseudonyme FROM creer c join joueur j on j.id = c.idJoueur WHERE idArticle = :idArticle";
        $statement = $connection->prepare($readQuery);
        $statement->bindParam(":idArticle", $idArticle);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC)['pseudonyme'];
    }

?>