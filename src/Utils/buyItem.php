<?php 
    require_once("../CRUD/CRUDMusique.php");
    require_once("../CRUD/CRUDTheme.php");
    require_once("../CRUD/CRUDJoueur.php");
    require_once("../CRUD/CRUDAcheterMusique.php");
    require_once("../CRUD/CRUDAcheterTheme.php");
    session_start();

    header('Content-Type: application/json');

    if(isset($_POST['id']) && isset($_POST['testdesecurité'])) {
        $idItem = intval($_POST['id']);
        $cost = intval($_POST['cost']);
        $userId = $_SESSION['userId'];
        $userMoney = readDouzCoin($userId); 
        if ($userMoney >= $cost) {
            $newMoney = $userMoney - $cost;
            updateDouzCoin($userId, $newMoney);
            if ($_POST['type'] === 'Theme') {
                creatAcheterTheme($userId, $idItem);
            } else {
                creatAcheterMusique($userId, $idItem);
            }
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'unsuccess', 'error' => 'Fonds insuffisants.']);
        }
    } else {
        echo "tu t'es cru ou toi, hein?";
    }
?>