<?PHP 
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Douzhee/src/Classes/Statistiques.php";

    //FONCTIONS CREATE

    /**
     * @brief Initialise les statistiques du joueur
     * @author Nathan
     * @param int $idUser identifiant du joueur
     * @return void
     */
    function createStatistiques(int $idUser): void {
        $connection = connection();

        $nbPartiesGagnees = 0;
        $scoreMaximal = 0;
        $tempsJeu = 0;
        $ratioVictoire = 0;
        $nbSucces = 0;

        $insertStatsQuery = "INSERT INTO statistiques VALUES (nbPartiesGagnees, scoreMaximal, tempsJeu, ratioVictoire, nbSucces)";

        $statement = $connection->prepare($insertStatsQuery);
        $statement->bindParam("nbPartiesGagnees", $nbPartiesGagnees);
        $statement->bindParam("scoreMaximal", $scoreMaximal);
        $statement->bindParam("tempsJeu", $tempsJeu);
        $statement->bindParam("ratioVictoire", $ratioVictoire);
        $statement->bindParam("nbSucces", $nbSucces);
        $statement->execute();

        $idStats = $connection->lastInsertId();

        createConsulte($idStats, $idUser);
    }


    //FONCTIONS READ

    /**
     * @brief Récupère toutes les statistiques d'un utilisateur donné
     * @author Nathan
     * @param int $idUser
     * @return Statistiques
     */
    function readStatistiquesByIdUser(int $idUser): Statistiques {
        $connection = connection();

        $readStatsQuery = "SELECT * FROM statistiques WHERE id = (SELECT idStatistiques FROM consulte WHERE idJoueur = idUser)";
        
        $statement = $connection->prepare($readStatsQuery);
        $statement->bindParam("idUser", $idUser);
        $statement->execute();

        $data = $statement->fetch(PDO::FETCH_ASSOC);

        $statsUser = new Statistiques($data['id'], $data['nbPartiesGagnees'], $data['scoreMaximal'], $data['tempsJeu'], $data['ratioVictoire'], $data['nbSucces']);
        return $statsUser;
    }

    //FONCTIONS UPDATE

    /**
     * @brief Met à jour toutes les statistiques d'un joueur donné à la fin d'une partie donnée
     * @author Nathan
     * @param int $idUser
     * @param int $idGame
     * @return void
     */
    function updateEndOfGame(int $idUser, int $idGame): void{
        $connection = connection();
        $stats = readStatistiquesByIdUser($idUser);

        if(readVictory($connection, $idUser, $idGame)){ //Fonction qui devra etre codée dans CRUDJouerPartie.php
            $updateVictory = 'UPDATE statistiques SET nbPartiesGagnees = nbPartiesGagnees + 1 WHERE id = (SELECT idStatistiques FROM consulte WHERE idJoueur = idUser)';
            $statement = $connection->prepare($updateVictory);
            $statement->bindParam('idUser', $idUser);
            $statement->execute();
        }

        $updateRatio = 'UPDATE statistiques SET ratioVictoire = nbPartieGagnees / (SELECT COUNT(*) FROM participeA WHERE idJoueur = idUser)';
        $statement = $connection->prepare($updateRatio);
        $statement->bindParam('idUser', $idUser);
        $statement->execute();

        $partie = readPartieByIdUserAndIdGame($idUser, $idGame); //Fonction qui devra etre codée dans CRUDJouerPartie.php
        if($partie->getScoreJoueur() > $stats->getScoreMaximal()){
            $updateBestScore = 'UPDATE statistiques SET scoreMaximal = newScore WHERE id = (SELECT idStatistiques FROM consulte WHERE idJoueur = idUser)';
            $statement = $connection->prepare($updateBestScore);
            $statement->bindParam('newScore', $partie->getScoreJoueur());
            $statement->bindParam('idUser', $idUser);
            $statement->execute();
        }
    }