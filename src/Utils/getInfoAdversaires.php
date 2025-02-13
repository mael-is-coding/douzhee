<?php
require_once "../CRUD/CRUDJoueurPartie.php";
session_start();

if (!empty($_POST['testdesecurité'])){
    $idPartie = $_POST['idPartie'];
    $idJoueur = $_POST['idJoueur'];

    $adversaires = readInfoAdversaires($idPartie, $idJoueur);
    
    echo json_encode(['status' => 'success', 'infoAdversaires' => $adversaires]);
} else {
    echo json_encode(['status' => 'erwror', 'message' => 'Invalid request']);
}
?>