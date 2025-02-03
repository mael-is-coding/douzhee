<?php
    require_once("../CRUD/CRUDSuccesJoueur.php");
    session_start();

    if (!empty($_POST['testdesecurité'])) {
        echo json_encode(['status' => 'success', 'AllSucces' => readAllSuccessJoueur($_SESSION['userId'])]);
    } else {
        echo "tu t'es cru ou toi, hein?";
    }
?>