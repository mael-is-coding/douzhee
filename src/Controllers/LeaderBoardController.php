<?php
    require_once("../CRUD/CRUDJoueur.php");
    if ($_SERVER ["REQUEST_METHOD"] === "POST") {

        $data = file_get_contents("php://input");
        $json_request = json_decode($data, true);

        if(gettype($data) == "boolean" || $json_request == "") {
            echo json_encode(["erreur" => "no request"]);

        } else if (isset($json_request["for"]) && $json_request["for"] == "LeaderBoard") { 
        switch ($json_request["mode"]){

            case "ACH": // Achievment
                $achievmentLeaderBoard = leaderBoard("ACH", $json_request["lines"]);
                echo json_encode($achievmentLeaderBoard);
                break;

            case "DZ": // nbDouzhee
                $douzheeLeaderBoard = leaderBoard("DZ", $json_request["lines"]);
                echo json_encode($douzheeLeaderBoard);
                break;

            case "VR": // Victoires
                $victoryLeaderBoard = leaderBoard("VR", $json_request["lines"]);
                echo json_encode($victoryLeaderBoard);
                break;

            case "RV": // Ratio Victoire 
                $ratioVictoireLD = leaderBoard("RV", $json_request["lines"]);
                echo json_encode($ratioVictoireLD);
                break;
                
            default:
                echo json_encode(["error" => "invalid table mode"]);
                break;
        }
        exit;
    } else {
        echo json_encode(["error" => "invalid reason, redefine 'for' clause"]);
        exit;
    }
}
?>