<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . "/douzhee/src/Classes/Defis.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/douzhee/src/Utils/connectionSingleton.php";
    require_once("../CRUD/CRUDMaitrise.php");

    function createDefis(String $nom, String $description, int $gain){
    $connection = ConnexionSingleton::getInstance();
    $InsertQuery = "INSERT INTO defis (nom,Description,gain) VALUES (:nom,:description,:gain)";

    $statement = $connection->prepare($InsertQuery);

    $statement->bindParam(":nom", $nom);
    $statement->bindParam(":description", $description);
    $statement->bindParam("gain", $gain);
   

    return $statement->execute();
    }
    function readAllDefis(){
        $connection = ConnexionSingleton::getInstance();
        $SelectQuery = "SELECT id, nom,Description,gain FROM defis";
        $statement = $connection->prepare($SelectQuery);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
?>