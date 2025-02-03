<?php
    require_once "../Classes/Musique.php";
    require_once "../Utils/connectionSingleton.php";

    function readAllMusics(): ?array {
      $connexion = ConnexionSingleton::getInstance();
   
      $query = "SELECT * FROM Musique";
   
      $statement = $connexion->prepare($query);
   
      $statement->execute();
   
      $results = $statement->fetchAll(PDO::FETCH_ASSOC);
   
      if(gettype($results) != "boolean") {
         return $results;
      }
      return null;
   }

   function readMusicPrice(int $id) :int {
      $connexion = ConnexionSingleton::getInstance();
   
      $query = "SELECT prix FROM Musique WHERE idMusique = :id";
   
      $statement = $connexion->prepare($query);
   
      $statement->bindParam(':id', $id);
   
      $statement->execute();
   
      $results = $statement->fetch(PDO::FETCH_ASSOC);
   
      if(gettype($results) != "boolean") {
         return (int)$results['prix'];
      }
      return 0;
   }

   function readMusic(int $id) :Musique {
      $connexion = ConnexionSingleton::getInstance();
   
      $query = "SELECT * FROM Musique WHERE idMusique = :id";
   
      $statement = $connexion->prepare($query);
   
      $statement->bindParam(':id', $id);
   
      $statement->execute();
   
      $results = $statement->fetch(PDO::FETCH_ASSOC);
   
      if(gettype($results) != "boolean") {
         return new Musique($results['idMusique'], $results['nomMusique'], $results['cheminMusique'], $results['prix'], $results['imgChemin'],);
      }
      return null;
   }

   function readCheminMusique(int $id): string | null {
      return (readMusic($id) != null) ? readMusic($id)->getCheminMusique() : null;
   }
?>