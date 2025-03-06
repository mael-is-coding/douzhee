<?php
    require_once "../Classes/Joueur.php";
    require_once "../Utils/connectionSingleton.php";
    require_once "../CRUD/CRUDJoueurPartie.php";
    require_once "../Classes/Classement.php";

    /**
     * @brief insère un nouveau joueur dans la table Joueur selon les paramètres spécifiés. tout les paramètres sont obligatoires.
     * @return bool false si la requête a échoué true sinon
     */
    function createJoueur(string $pseudo, string $mdp, string $email): bool {
        $connection = ConnexionSingleton::getInstance();
        $hashedPassword = password_hash($mdp, PASSWORD_DEFAULT);
    
        do {
            $idJoueur = bin2hex(random_bytes(rand(13, 25))); // Générer un idJoueur aléatoire
            $stmt = $connection->prepare("SELECT COUNT(*) FROM Joueur WHERE idJoueur = ?");
            $stmt->bindParam(1, $idJoueur);
            $stmt->execute();
            $count = $stmt->fetchColumn();
        } while ($count > 0);
    
        $dateInscription = date("Y-m-d H:i:s");
    
        $stmt = $connection->prepare("INSERT INTO Joueur (idJoueur, pseudo, mdp, email, dateInscription) VALUES (?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $idJoueur);
        $stmt->bindParam(2, $pseudo);
        $stmt->bindParam(3, $hashedPassword);
        $stmt->bindParam(4, $email);
        $stmt->bindParam(5, $dateInscription);
    
        return $stmt->execute();
    }

    function readAllJoueur(): array {
        $connection = ConnexionSingleton::getInstance();
        $stmt = $connection->prepare("SELECT * FROM Joueur");
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $joueurs = [];
    
        foreach ($results as $result) {
            $joueurs[] = [
                'idJoueur' => $result['idJoueur'],
                'pseudo' => $result['pseudo'],
                'mdp' => $result['mdp'],
                'douzCoins' => (int)$result['douzCoins'],
                'email' => $result['email'],
                'bio' => $result['bio'],
                'dateInscription' => $result['dateInscription'],
                'avatarChemin' => $result['avatarChemin'],
                'idMusique' => (int)$result['idMusique'],
                'idTheme' => (int)$result['idTheme'],
                'nbPartieGagnees' => (int)$result['nbPartieGagnees'],
                'scoreMax' => (int)$result['scoreMax'],
                'tempsJeu' => $result['tempsJeu'],
                'ratioVictoire' => (float)$result['ratioVictoire'],
                'nbSucces' => (int)$result['nbSucces'],
                'nbPartiesJouees' => (int)$result['nbPartiesJouees'],
                'nbDouzhee' => (int)$result['nbDouzhee']
            ];
        }
    
        return $joueurs;
    }

    /**
     * @brief retourne le joueur ayant l'id id ou null si aucun existe avec cet id
     * @param int $id id du joueur à obtenir
     * @return Joueur|null le joueur à l'id id
     */
    function readJoueur(string $idJoueur): ?Joueur {
        $connection = ConnexionSingleton::getInstance();
        $stmt = $connection->prepare("SELECT * FROM Joueur WHERE idJoueur = ?");
        $stmt->bindParam(1, $idJoueur);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($result) {
            return new Joueur(
                $result['idJoueur'],
                $result['pseudo'],
                $result['mdp'],
                (int)$result['douzCoins'],
                $result['email'],
                $result['bio'],
                $result['dateInscription'],
                $result['avatarChemin'],
                (int)$result['idMusique'],
                (int)$result['idTheme'],
                (int)$result['nbPartieGagnees'],
                (int)$result['scoreMax'],
                $result['tempsJeu'],
                (float)$result['ratioVictoire'],
                (int)$result['nbSucces'],
                (int)$result['nbPartiesJouees'],
                (int)$result['nbDouzhee']
            );
        } else {
            return null;
        }
    }

    function readDouzCoin(string $idJoueur) : int | null {
        return (readJoueur($idJoueur) != null) ? readJoueur($idJoueur)->getDouzCoins() : -1;
    }

    function readPseudo(string $idJoueur) : string | null {
        return (readJoueur($idJoueur) != null) ? readJoueur($idJoueur)->getPseudo() : null;
    }

    function readBio(string $idJoueur) : string | null {
        return (readJoueur($idJoueur) != null) ? readJoueur($idJoueur)->getBio() : null;
    }

    function readIdThemeJoueur(string $idJoueur) : int | null {
        return (readJoueur($idJoueur) != null) ? readJoueur($idJoueur)->getIdTheme() : null;
    }

    function readAvatar(string $idJoueur) : string | null {
        return (readJoueur($idJoueur) != null) ? readJoueur($idJoueur)->getAvatarChemin() : null;
    }

    function readIdMusiqueJoueur(string $idJoueur) : int | null {
        return (readJoueur($idJoueur) != null) ? readJoueur($idJoueur)->getIdMuisque() : null;
    }

    function readIdJoueur(string $email) : string | null {
        $connection = ConnexionSingleton::getInstance();
        $stmt = $connection->prepare("SELECT idJoueur FROM Joueur WHERE email = ?");
        $stmt->bindParam(1, $email);
        $stmt->execute();
        
        $results = $stmt->fetch(PDO::FETCH_ASSOC);

        if (gettype($results) != "boolean") {
            return $results['idJoueur'];
        } else {
            return null;
        }
    }

    function readJoueurByEmail(string $email): ?Joueur {
        $connection = ConnexionSingleton::getInstance();
        $stmt = $connection->prepare("SELECT * FROM Joueur WHERE email = ?");
        $stmt->bindParam(1, $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($result) {
            return new Joueur(
                $result['idJoueur'],
                $result['pseudo'],
                $result['mdp'],
                (int)$result['douzCoins'],
                $result['email'],
                $result['bio'],
                $result['dateInscription'],
                $result['avatarChemin'],
                (int)$result['idMusique'],
                (int)$result['idTheme'],
                (int)$result['nbPartieGagnees'],
                (int)$result['scoreMax'],
                $result['tempsJeu'],
                (float)$result['ratioVictoire'],
                (int)$result['nbSucces'],
                (int)$result['nbPartiesJouees'],
                (int)$result['nbDouzhee']
            );
        } else {
            return null;
        }
    }

    function updateTempsJeu(string $idJoueur, int $tempsJeu) : bool {
        $connection = ConnexionSingleton::getInstance();
        $stmt = $connection->prepare("UPDATE Joueur SET tempsJeu = tempsJeu + ? WHERE idJoueur = ?");

        $stmt->bindParam(1, $tempsJeu);
        $stmt->bindParam(2, $idJoueur);

        return $stmt->execute();
    }

    function cryptage($data,$key){
        $iv = random_bytes(16); //Génération d'une valeur aléatoire de 16 octets
        $chiffrement = openssl_encrypt($data,'aes-256-cbc',$key,0,$iv); //chiffrement de la donnée en utilisant l'algo de chiffrage AES, la clé et la valeur aléatoire 
        return base64_encode($iv.$chiffrement); //concaténation de la valeur aléatoire au chiffrement
    }

    function decryptage($data,$key){
        if ($data != null){
            $data = base64_decode($data); //décryptage des données pour séparer la valeur random et le texte chiffré
            $iv = substr($data,0,16); //Récupère la valeur aléatoire ( 16 premiers octets)
            $chiffre = substr($data,16); // Extraction du texte chiffré (le reste après la valeur aléatoire)
            return openssl_decrypt($chiffre,'aes-256-cbc',$key,0,$iv); //Déchiffrement des données en utilisant la clé et la valeur aléatoire
        }else{
            return null;
        }
    }

    function verifUser(string $email, string $mdp): bool {
        $connexion = ConnexionSingleton::getInstance();
        $sql = "SELECT mdp FROM Joueur WHERE email = ?";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(1, $email);
        $stmt->execute();
        $hash = $stmt->fetchColumn();
        return password_verify($mdp, $hash);
    }

    function verifEmail($email) : bool {
        $connexion = ConnexionSingleton::getInstance();
        $sql = "SELECT email FROM joueur WHERE email = ?";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(1,$email);
        $stmt->execute();
        $count = $stmt->rowCount();
        return $count > 0;
    }
    
    function updateDouzCoin(string $idJoueur, int $douzCoins) : bool {
        $connection = ConnexionSingleton::getInstance();
        $stmt = $connection->prepare("UPDATE Joueur SET douzCoins = ? WHERE idJoueur = ?");

        $stmt->bindParam(1, $douzCoins);
        $stmt->bindParam(2, $idJoueur);

        return $stmt->execute();
    }

    /**
     * @brief Met à jour le nombre de Douzhee d'un joueur
     * @author Nathan
     * @param int $idUser identifiant du joueur
     * @param int $nbDouzhee nombre de Douzhee a ajouter
     * @return void
     */
    function updateNbDouzhee(string $idUser, int $nbDouzhee): void{
        $connection = ConnexionSingleton::getInstance();

        $updateNbDouzhee = 'UPDATE Joueur SET nbDouzhee = nbDouzhee + :nbDouzhee WHERE id = :idUser';
        $statement = $connection->prepare($updateNbDouzhee);
        $statement->bindParam(':idUser', $idUser, PDO::PARAM_STR);
        $statement->bindParam(':nbDouzhee', $nbDouzhee, PDO::PARAM_INT);
        $statement->execute();
    }

    function updateEndOfGame(string $idUser, string $idGame): void {
        $connection = ConnexionSingleton::getInstance();
        $joueur = readJoueur($idUser);
    
        $updateNbParties = 'UPDATE Joueur SET nbPartiesJouees = nbPartiesJouees + 1 WHERE id = :idUser';
        $statement = $connection->prepare($updateNbParties);
        $statement->bindParam(':idUser', $idUser, PDO::PARAM_STR);
        $statement->execute();
    
        if (readEstGagnant($idUser, $idGame)) {
            $updateVictory = 'UPDATE Joueur SET nbPartiesGagnees = nbPartiesGagnees + 1 WHERE id = :idUser';
            $statement = $connection->prepare($updateVictory);
            $statement->bindParam(':idUser', $idUser, PDO::PARAM_STR);
            $statement->execute();
        }
    
        $updateRatio = 'UPDATE Joueur SET ratioVictoire = ROUND(nbPartiesGagnees / nbPartieJoues, 2) WHERE id = :idUser';
        $statement = $connection->prepare($updateRatio);
        $statement->bindParam(':idUser', $idUser, PDO::PARAM_STR);
        $statement->execute();
    
        $partie = readJoueurPartie($idUser, $idGame);
        if ($partie->getScore() > $joueur->getScoreMax()) {
            $updateBestScore = 'UPDATE Joueur SET scoreMax = :newScore WHERE id = :idUser';
            $statement = $connection->prepare($updateBestScore);
            $scoreJoueur = $partie->getScore();
            $statement->bindParam(':newScore', $scoreJoueur, PDO::PARAM_INT);
            $statement->bindParam(':idUser', $idUser, PDO::PARAM_STR);
            $statement->execute();
        }
    }

    /**
     * @brief Incrémente de 1 le nombre de succès d'un joueur donné
     * @author Nathan
     * @param int $idUser identifiant du joueur
     * @return void
     */
    function updateNbSucces(int $idUser): void{
        $connection = ConnexionSingleton::getInstance();

        $updateSucces = 'UPDATE Joueur SET nbSucces = nbSucces + 1 WHERE id = :idUser';
        $statement = $connection->prepare($updateSucces);
        $statement->bindParam(':idUser', $idUser, PDO::PARAM_STR);
        $statement->execute();
    }

    function updateBio(string $idJoueur, string $bio) : bool {
        $connection = ConnexionSingleton::getInstance();
        $stmt = $connection->prepare("UPDATE Joueur SET bio = ? WHERE idJoueur = ?");

        $stmt->bindParam(1, $bio);
        $stmt->bindParam(2, $idJoueur);

        return $stmt->execute();
    }

    function updateMusicPath(string $idJoueur, int $idMusique) : bool {
        $connection = ConnexionSingleton::getInstance();
        $stmt = $connection->prepare("UPDATE Joueur SET idMusique = ? WHERE idJoueur = ?");

        $stmt->bindParam(1, $idMusique);
        $stmt->bindParam(2, $idJoueur);

        return $stmt->execute();
    }

    function updateJoueurIdTheme(string $idJoueur, int $idTheme) : bool {
        $connection = ConnexionSingleton::getInstance();
        $stmt = $connection->prepare("UPDATE Joueur SET idTheme = ? WHERE idJoueur = ?");

        $stmt->bindParam(1, $idTheme);
        $stmt->bindParam(2, $idJoueur);

        return $stmt->execute();
    }

    function updatePseudoJoueur(string $idJoueur, string $pseudo) : bool {
        $connection = ConnexionSingleton::getInstance();
        $stmt = $connection->prepare("UPDATE Joueur SET pseudo = ? WHERE idJoueur = ?");

        $stmt->bindParam(1, $pseudo);
        $stmt->bindParam(2, $idJoueur);

        return $stmt->execute();
    }
    /**
     * Retourne un classement de joueurs basé sur le mode de classement (param $mode)
     * @author Mael
     * @param string $mode une chaîne de caractères qui représente sur quelle base le classement doit être fait
     * @param int $limit le nombre de lignes qui devrait apparaître dans le classement
     * @return mixed une collection d'objets Classement de taille limit
     */
    function leaderBoard(string $mode, int $limit): mixed {

        $modularQuery = "";

        switch ($mode) {
            case "DZ": // DouZhee
                $modularQuery = "SELECT pseudo, nbDouzhee as stat FROM Joueur ORDER BY nbDouzhee DESC LIMIT :limit";
                break;
            case "RV": // Ratio de Victoires
                $modularQuery = "SELECT pseudo, ratioVictoire as stat FROM Joueur ORDER BY ratioVictoire DESC LIMIT :limit";
                break;
            case "ACH": // ACHievment
                $modularQuery = "SELECT pseudo, nbSucces as stat FROM Joueur ORDER BY nbSucces DESC LIMIT :limit";
                break;
            case "VR": // VictoiRes
                $modularQuery = "SELECT pseudo, nbPartieGagnees as stat FROM Joueur ORDER BY nbPartieGagnees DESC LIMIT :limit";
                break;
            default:
                $modularQuery = "SELECT pseudo, nbDouzhee as stat FROM Joueur ORDER BY nbDouzhee DESC LIMIT :limit";
                break;
        }
        

        $connexion = ConnexionSingleton::getInstance();

        $statement = $connexion->prepare($modularQuery);
        $statement->bindParam("limit", $limit, PDO::PARAM_INT);

        $success = $statement->execute();
        $transcendant_results = null;

        if (gettype($success)) {
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            $returnedArray = [];
            for($i = 0; $i < sizeof($results); $i++ ) {
                $newRoom = new Classement($i, $results[$i]["pseudo"], $results[$i]["stat"]);
                array_push($returnedArray, $newRoom);
            }

            return $returnedArray;
        }

        return null;
    }
?>