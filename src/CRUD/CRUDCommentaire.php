<?php
        require_once $_SERVER['DOCUMENT_ROOT'] . "/douzhee/src/Classes/Commentaire.php";
        require_once $_SERVER['DOCUMENT_ROOT'] . "/douzhee/src/Utils/connectionSingleton.php";
        require_once $_SERVER['DOCUMENT_ROOT']. "/douzhee/src/CRUD/CRUDCommente.php";

        function createCommentaire($contenu, $idArticle,$nbAime,$idJoueur){
            $connection = ConnexionSingleton::getInstance();
            $InsertQuery = "INSERT INTO commentaire (contenu,idArticle,nbAime) VALUES (:contenu,:idArticle,:nbAime)";
            $statement = $connection->prepare($InsertQuery);
            $statement->bindParam(":contenu", $contenu);
            $statement->bindParam(":idArticle", $idArticle);
            $statement->bindParam(":nbAime", $nbAime);
            $idCommentaire = $connection->lastInsertId();
            createCommente($idJoueur,$idCommentaire);
        }
        function readAllComment($idArticle){
            $connection = ConnexionSingleton::getInstance();
            $readQuery = "SELECT * FROM commentaire WHERE idArticle = :idArticle";
            $statement = $connection->prepare($readQuery);
            $statement->bindParam(":idArticle", $idArticle);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
?>