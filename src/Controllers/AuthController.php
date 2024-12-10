<?php


header("Access-Control-Allow-Origin: http://localhost");
header("Access-Control-Allow-Headers: application/json");

require_once $_SERVER ["DOCUMENT_ROOT"] . "douzhee/src/CRUD/CRUDAppartientA.php";
require_once $_SERVER ["DOCUMENT_ROOT"] . "douzhee/src/CRUD/CRUDClassement.php";
require_once $_SERVER ["DOCUMENT_ROOT"] . "douzhee/src/CRUD/CRUDConsulte.php";
require_once $_SERVER ["DOCUMENT_ROOT"] . "douzhee/src/CRUD/CRUDEffectueAchat.php";
require_once $_SERVER ["DOCUMENT_ROOT"] . "douzhee/src/CRUD/CRUDJouerPartie.php";
require_once $_SERVER ["DOCUMENT_ROOT"] . "douzhee/src/CRUD/CRUDJoueur.php";
require_once $_SERVER ["DOCUMENT_ROOT"] . "douzhee/src/CRUD/CRUDObtient.php";
require_once $_SERVER ["DOCUMENT_ROOT"] . "douzhee/src/CRUD/CRUDPartie.php";
require_once $_SERVER ["DOCUMENT_ROOT"] . "douzhee/src/CRUD/CRUDSkinAchete.php";
require_once $_SERVER ["DOCUMENT_ROOT"] . "douzhee/src/CRUD/CRUDSkinAchetable.php";
require_once $_SERVER ["DOCUMENT_ROOT"] . "douzhee/src/CRUD/CRUDStatistique.php";
require_once $_SERVER ["DOCUMENT_ROOT"] . "douzhee/src/CRUD/CRUDSucces.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // echo json_encode(file_get_contents("php://input"));

    $request = json_decode(file_get_contents("php://input"), true);



    exit();
}   


/**
 * une fonction qui 
 * @return void
 */
function findObjectThenExec(mixed $request): void {
    if ($request["object"] === "Joueur")  {
       if (getAction($request) === "CREATE") {
    
       } else if (getAction($request) === "UPDATE") {

       } else if (getAction($request) === "READ") {

       } else if (getAction($request) === "DELETE") {

       }
         else {
        echo json_encode(["ERROR" => "INVALID REQUEST -> NEITHER C, R, U or D"]);
        exit();
    }

    }
}

function getAction(mixed $request): string {
    if ($request["action"] === "CREATE") {
        return "CREATE";
    } else if ($request["action"] === "READ") {
        return "READ";
    } else if ($request["action"] === "UPDATE") {
        return "UPDATE";
    } else if ($request["action"] === "DELETE") {
        return "DELETE";
    } else {
        return "ERROR";
    }
}

function getObject(mixed $request): string {
    if ($request["object"] === "Joueur") {
        return "Joueur";
    } else if ($request["object"] === "") {
        
    }
}