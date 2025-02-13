<?php
require_once "../CRUD/CRUDJoueurPartie.php";
require_once "../CRUD/CRUDJoueur.php";
session_start();

if (!empty($_POST['testdesecurité'])){
    if (!empty($_POST['idJoueur'])) {
        $historique = readHistorique($_POST['idJoueur']);
        $infoJoueur = readJoueur($_POST['idJoueur']);
        $allJoueurs = readAllJoueur();
        echo json_encode(['status' => 'success', 'historique' => $historique, 'infoJoueur' => $infoJoueur->toArray(), 'allJoueurs' => $allJoueurs]);
    } else if (isset($_SESSION['userId'])) {
        $historique = readHistorique($_SESSION['userId']);
        $infoJoueur = readJoueur($_SESSION['userId']);
        $allJoueurs = readAllJoueur();
        echo json_encode(['status' => 'success', 'historique' => $historique, 'infoJoueur' => $infoJoueur->toArray(), 'allJoueurs' => $allJoueurs]);
    } else {
        echo json_encode(['status' => 'errodr', 'message' => 'User not logged in']);
    }
} else {
    echo json_encode(['status' => 'erwror', 'message' => 'Invalid request']);
}
?>