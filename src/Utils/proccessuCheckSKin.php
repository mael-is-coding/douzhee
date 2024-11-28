<?php
require_once("../CRUD/CRUDJoueur.php");
require_once("../CRUD/CRUDClassement.php");
require_once("../CRUD/CRUDSucces.php");
require_once("../CRUD/CRUDObtient.php");

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = file_get_contents("php://input");
    $data = json_decode($input, true);  

    if (isset($data['selectedId'])) {
        $idSucces = $data['selectedId'];

        
        $succes = readSuccesById($idSucces);

        if ($succes && is_array($succes) && !empty($succes)) {
          
            $response = [];
            foreach ($succes as $Succes) {
             
                if (isset($Succes['nomSucces']) && isset($Succes['Condition'])) {
                    $response[] = [
                        'nom' => $Succes['nomSucces'],
                        'condition' => $Succes['Condition']
                    ];
                }
            }

       
            if (empty($response)) {
                echo json_encode(['error' => 'Aucun succès valide trouvé pour cet ID.']);
            } else {
                echo json_encode($response);
            }
        } else {
   
            echo json_encode(['error' => 'Succès non trouvé ou données invalides.']);
        }
    } else {
        echo json_encode(['error' => 'ID du succès non défini']);
    }
} else {
    echo json_encode(['error' => 'Méthode non autorisée']);
}
?>
