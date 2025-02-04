<?php
    require_once("../CRUD/CRUDPartie.php");
    session_start();

    if(!empty($_POST['testdesecurité'])){
        updateStatutPartie($_POST['idPartie'], $_POST['statut']);
    } else {
        echo "tu t'es cru ou toi, hein?";
    }
?>