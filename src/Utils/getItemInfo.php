<?php
    require_once "../CRUD/CRUDTheme.php";
    require_once "../CRUD/CRUDMusique.php";
    header('Content-Type: application/json');

    session_start();

    if (!empty($_POST['testdesecurité']) && isset($_POST['id'])) {
        $id = intval($_POST['id']);
        $resultat = false;

        if ($_POST['type'] === 'Theme') {
            $resultat = readThemePrice($id);
            echo json_encode(['status' => 'success', 'resultat' => $resultat, 'chemin' => null]);
        } else {
            $resultat = readMusicPrice($id);
            $chemin = readCheminMusique($id);
            echo json_encode(['status' => 'success', 'resultat' => $resultat, 'chemin' => $chemin]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
    }
?>