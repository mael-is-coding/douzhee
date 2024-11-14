<?php
/**
 * Permet de se connecter à la base de données
 * @author Nathan
 * @return PDO|null
 */
function connection(){
    try{
        $connection = new PDO("mysql:host=douzhee.fr;dbname=BDDouzhee", "Douzhee", "Zikette");
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $connection;
    }catch(PDOException $e){
        echo $e->getMessage();
        return null;
    }
}