<?php
    require_once("../CRUD/CRUDJoueurPartie.php");
    session_start();

    if(!empty($_POST['testdesecurité'])){
        echo json_encode(['idPartieEnCours' => readPartieEnCours($_SESSION['userId'])]);
    } else {
        echo "tu t'es cru ou toi, hein?";
    }
?>