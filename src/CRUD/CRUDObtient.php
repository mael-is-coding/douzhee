<?PHP 
    require_once $_SERVER['DOCUMENT_ROOT'] . "/SAE/Douzhee/src/Classes/Obtient.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/SAE/Douzhee/src/Utils/connectionSingleton.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/SAE/Douzhee/src/CRUD/CRUDStatistiques.php";

    //FONCTIONS CREATE

    /**
     * @brief Crée un lien entre un succès et un joueur pour indiquer qu'il a validé le succès
     * @author Nathan
     * @param int $idUser identifiant du joueur
     * @param int $idSucces identifiant du succès obtenu
     * @return void
     */
    function createObtient(int $idUser, int $idSucces){
        $connection = ConnexionSingleton::getInstance();

        $insertObtient = 'INSERT INTO obtient VALUES (:idUser, :idSucces)';

        $statement = $connection->prepare($insertObtient);
        $statement->bindValue('idUser', $idUser, PDO::PARAM_INT);
        $statement->bindValue('idSucces', $idSucces, PDO::PARAM_INT);
        $statement->execute();

        updateNbSucces($idUser);
    }


    //FONCTIONS READ

    /**
     * @brief Récupère la liaison entre un joueur et ses succès
     * @author Nathan
     * @param int $idUser identifiant du joueur
     * @return array
     */
    function readAllSuccesOfAnUser(int $idUser): array{
        $connection = ConnexionSingleton::getInstance();

        $readAllSucces = 'SELECT * FROM obtient WHERE idJoueur = idUser';

        $statement = $connection->prepare($readAllSucces);
        $statement->bindValue('idUser', $idUser, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @brief Récupère la liaison entre un succès et les joueurs qui l'ont obtenu
     * @author Nathan
     * @param int $idSucces identifiant du succès
     * @return array
     */
    function readAllUserWinTheSuccesId(int $idSucces): array{
        $connection = ConnexionSingleton::getInstance();

        $readAllUserSucces = 'SELECT * FROM obtient WHERE idSucces = idSucces';
        $statement = $connection->prepare($readAllUserSucces);
        $statement->bindValue('idSucces', $idSucces, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }