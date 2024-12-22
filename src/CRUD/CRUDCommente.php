<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . "/douzhee/src/Classes/Commente.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/douzhee/src/Utils/connectionSingleton.php";

    function createCommente(int $idJoueur, int $idCommentaire){
        $connection = ConnexionSingleton::getInstance();
        $insertQuery = "INSERT INTO commente (idCommentaire, idJoueur) VALUES (:idJoueur, :idCommentaire)";
        $statement = $connection->prepare($insertQuery);
        $statement->bindParam(":idJoueur", $idJoueur);
        $statement->bindParam(":idCommentaire", $idCommentaire);
        return $statement->execute();
    }
    function readAllCommentOfCreatorById($idJ,$idA){
        $connection = ConnexionSingleton::getInstance();
        $readQuery = "SELECT pseudonyme FROM joueur j 
        JOIN commente c ON c.idJoueur = j.id 
        JOIN commentaire co on co.id = c.idCommentaire
        where j.id = :idJ and co.idArticle = :idA";
        $statement = $connection->prepare($readQuery);
        $statement->bindParam(":idJ", $idJ);
        $statement->bindParam(":idA", $idA);
        $statement->execute();
        return $statement->fetchAll();
    }
?>