<?php
    require_once "../CRUD/CRUDPartie.php";

    if (!empty($_POST['testdesecurité'])){
        updateStatutPartie($_POST['gameId'], 1);
    }
    else{
        echo "tu t'est cru ou toi, hein?";
    }

?>