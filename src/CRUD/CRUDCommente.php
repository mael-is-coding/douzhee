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
?>