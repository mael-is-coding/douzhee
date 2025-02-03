<?php
    require_once("../CRUD/CRUDJoueur.php");
    session_start();

    if (!empty($_POST['testdesecurité'])){
        if (isset($_SESSION['userId'])) {
            $musicPath = readCheminMusique($_SESSION['userId']);
            echo json_encode(['musicPath' => $musicPath]);
            exit();
        } else {
            http_response_code(403); 
            echo json_encode(['error' => 'Utilisateur non connecté']);
            exit();
        }
    }
    else{
        echo "tu t'est cru ou toi, hein?";
    }
?>
