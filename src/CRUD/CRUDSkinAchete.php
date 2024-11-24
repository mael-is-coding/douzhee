<?php

/**
 * @author Mael
 * @brief créé une instance d'un skin acheté dans la BdD
 * @param int $idSkin
 * @param int $idAchat
 * @param string $etatSkin
 * @param string $typeSkin
 * @param string $date
 * @return bool true si la requête fonctionne, false si elle échoue
 */
function createSkinAchete(int $idSkin, int $idAchat, string $etatSkin, string $typeSkin, string $date): bool {
    $connection = ConnexionSingleton::getInstance();

    $InsertQuery = "INSERT INTO SkinAchete (idSkin, idAchat, etatSkin, typeSkin, dateAchat) VALUES (:idSkin, :idAchat, :etatSkin, :typeSkin, :bio, :dateInsc)";

    $statement = $connection->prepare($InsertQuery);

    $statement->bindParam(":idSkin", $idSkin);
    $statement->bindParam(":idAchat", $idAchat);
    $statement->bindParam(":etatSkin", $etatSkin);
    $statement->bindParam(":typeSkin", $typeSkin);
    $statement->bindParam(":date", $date);

    return $statement->execute();
}



/**
 * @brief retourne une instance de classe SkinAchete depuis la BdD selon les paramètres.
 * @param int $idSkin
 * @param int $idAchat
 * @return SkinAchete|null une instance de SkinAchete, null si aucun enregistrement correspondant, ou échec du côté BdD
 */
function readSkinAchete(int $idSkin, int $idAchat): ?SkinAchete {
    $connexion = ConnexionSingleton::getInstance();

    $SelectQuery = "SELECT * FROM SkinAchete WHERE idSkin = :idSkin AND idAchat = :idAchat";

    $statement = $connexion->prepare($SelectQuery);
    $statement->bindParam(":idSkin", $idSkin);
    $statement->bindParam(":idAchat", $idAchat);

    $success = $statement->execute();

    if (gettype($success) == "boolean") {

            $results = $statement->fetch(PDO::FETCH_ASSOC);
        if(gettype($results) == "boolean") {
            $idAchat_ = $results ["idAchat"];
            $idSkin_ = $results ["idSkin"];
            $etatSkin = $results ["etatSkin"];
            $date = $results ["dateAchat"];
            $typeSkin = $results ["typeSkin"];
    
            return new SkinAchete($idAchat_, $idSkin_, $date, $etatSkin, $typeSkin);
        } else {
            return null;
        }
    } else {
        return null;
    }

}

/**
 * @author Milan
 * @brief retourne une collection associative des achats de l'utilisateur userId
 * @param int $userId
 * @return array
 */
function readAllAchatByUser(int $userId): array{
 
    $connection = ConnexionSingleton::getInstance();
    $selectedQuery = "Select sa.idSkin, sa.typeSkin, sa.etatSkin

                    from effectueachat eff 
                    join skinacheter sa on sa.id = eff.idAchat
                    join Skinachetable ska on ska.id = sa.id 
                    where idJoueur = :idUser";

    $statement = $connection->prepare($selectedQuery);
    $statement->bindParam(":idUser", $userId);
    $statement->execute();
    return  $statement->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * @author Milan
 * @param int $idSkin
 * @param int $etatSkin
 * @param int $idUser
 * @return void
 */
function updateEtatSkin(int $idSkin, int $etatSkin, int $idUser){
    $connection = ConnexionSingleton::getInstance();
    $selectedQuery = "Select idAchat from effectueachat where idJoueur = :idUser";
    $statement = $connection->prepare($selectedQuery);
    $statement->bindParam(":idUser", $idUser);
    $statement->execute();

    if ($statement->rowCount() > 0) {
        $idAchat = $statement->fetchColumn();
        $updateQuery = "UPDATE skinacheter SET etatSkin = :etat WHERE idSkin = :idSkin AND id = :idAchat";
        $statement = $connection->prepare($updateQuery);
        $statement->bindParam(":etat", $etatSkin);
        $statement->bindParam(":idSkin", $idSkin);
        $statement->bindParam(":idAchat", $idAchat);
        $statement->execute();

}
}

