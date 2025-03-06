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
                $C_AT_Success = creatAcheterTheme($userId, $idItem);
                if (!$C_AT_Success) {
                    echo json_encode(["status" => "failure", "error" => "échec d'achat", "CAT" => $C_AT_Success, "idUser" => $userId, "idItem" => $idItem]);
                } else {
                    echo json_encode(['status' => 'success', 'cost' => $cost]);
                }
            } else {
                $C_AM_Success = creatAcheterMusique($userId, $idItem);
                echo json_encode(['status' => 'success', 'cost' => $cost, 'CAM' => $C_AM_Success, 'type' => $_POST['type']]);
            }
        } else {
            echo json_encode(['status' => 'failure', 'error' => 'Fonds insuffisants.']);
        }
    } else {
        echo "tu t'es cru ou toi, hein?";
    }
?>