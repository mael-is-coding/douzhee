<?php
    require_once("../CRUD/CRUDJoueurPartie.php");
    session_start();

    if(!empty($_POST['testdesecurité'])){
        deletePartieEnCour($_SESSION['userId']);
    } else {
        echo "tu t'es cru ou toi, hein?";
    }
?>