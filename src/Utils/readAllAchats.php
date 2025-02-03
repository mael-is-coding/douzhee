<?php
    require_once("../CRUD/CRUDJoueur.php");
    require_once("../CRUD/CRUDAcheterTheme.php");
    require_once("../CRUD/CRUDAcheterMusique.php");
    session_start();

    if (!empty($_POST['testdesecurité'])) {
        if (isset($_SESSION['userId'])) {
            $allAchatsThemes = readAllAcheterTheme($_SESSION['userId']);
            $allAchatsMusiques = readAllAcheterMusique($_SESSION['userId']);
            if (is_array($allAchatsThemes) && is_array($allAchatsMusiques)) {
                echo json_encode(['status' => 'success', 'allAchatsThemes' => $allAchatsThemes, 'allAchatsMusiques' => $allAchatsMusiques]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'No achats found']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
    }
?>