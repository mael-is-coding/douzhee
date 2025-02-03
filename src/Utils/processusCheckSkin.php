<?php
require_once("../CRUD/CRUDJoueur.php");
require_once("../CRUD/CRUDSucces.php");

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = file_get_contents("php://input");
    $data = json_decode($input, true);

    if (isset($data['Id']) && is_numeric($data['Id'])) {
        $idSucces = (int) $data['Id'];
        $succes = readSucces($idSucces);
        if ($succes !== null) {
            $response = [
                'nom' => $succes->getNomSucces(),
                'condition' => $succes->getConditionSucces(),
            ];
            echo json_encode($response);
        } else {
            echo json_encode(['error' => 'Succès non trouvé ou données invalides.']);
        }
    } else {
        echo json_encode(['error' => 'ID du succès non défini']);
    }
} else {
    echo json_encode(['error' => 'Méthode non autorisée']);
}
