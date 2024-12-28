<?php

header("Access-Control-Allow-Origin: http://localhost");
header("Access-Control-Allow-Headers: application/json");

require_once $_SERVER ["DOCUMENT_ROOT"] . "/douzhee/src/CRUD/CRUDAppartientA.php";
require_once $_SERVER ["DOCUMENT_ROOT"] . "/douzhee/src/CRUD/CRUDClassement.php";
require_once $_SERVER ["DOCUMENT_ROOT"] . "/douzhee/src/CRUD/CRUDConsulte.php";
require_once $_SERVER ["DOCUMENT_ROOT"] . "/douzhee/src/CRUD/CRUDEffectueAchat.php";
require_once $_SERVER ["DOCUMENT_ROOT"] . "/douzhee/src/CRUD/CRUDJouerPartie.php";
require_once $_SERVER ["DOCUMENT_ROOT"] . "/douzhee/src/CRUD/CRUDJoueur.php";
require_once $_SERVER ["DOCUMENT_ROOT"] . "/douzhee/src/CRUD/CRUDObtient.php";
require_once $_SERVER ["DOCUMENT_ROOT"] . "/douzhee/src/CRUD/CRUDPartie.php";
require_once $_SERVER ["DOCUMENT_ROOT"] . "/douzhee/src/CRUD/CRUDSkinAchete.php";
require_once $_SERVER ["DOCUMENT_ROOT"] . "/douzhee/src/CRUD/CRUDSkinAchetable.php";
require_once $_SERVER ["DOCUMENT_ROOT"] . "/douzhee/src/CRUD/CRUDStatistiques.php";
require_once $_SERVER ["DOCUMENT_ROOT"] . "/douzhee/src/CRUD/CRUDSucces.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // echo json_encode(file_get_contents("php://input"));

    $request = json_decode(file_get_contents("php://input"), true);

    findObjectThenExec($request);
}   


/**
 * une fonction qui 
 * @return void
 */
function findObjectThenExec(mixed $request): void {
    if ($request["object"] === "Joueur")  {
    // POUR LA CONNECTION 
       if (getAction($request) === "READ") {
        echo json_encode(["SUCCESS" => "IS A USER AND FOR CONNECTION"]);
        $email = $request["params"]["email"];
        $pwd = $request["params"]["pwdHash"];

        $returnedJoueur = readJoueurByEmail($email);

        if($returnedJoueur != null) {
            echo json_encode(["returnedJoueur" => "is not null"]);
            if ($returnedJoueur->getMdp() == $pwd) {
                echo json_encode(["SUCCESS" => "Un utilisateur a ete trouve, le mot de passe est juste"]);
                exit();
            } else {
                echo json_encode(["PWD ERROR" => "Un utilisateur a ete trouve, mais le mdp est errone    "]);
                echo json_encode(["BD PWD" => $returnedJoueur->getMDP() . "      "]);
                echo json_encode(["GIVEN PWD" => $request["params"]["pwdHash"]]);
                exit();
            }
        } else {
            echo json_encode(["EMAIL ERROR" => "EMAIL SEEMS TO BE INVALID OR NOT REGISTERED"]);
            exit();
        }
    // POUR LA CREATION D'UTILISATEUR PUIS CONNECTION
       } else if (getAction($request) == "CREATE") {
        $email = $request["params"]["email"];
        $pwd = $request["params"]["pwd"];
        $username = $request["params"]["username"];

        $shouldBeNull = readJoueurByEmail($email);

        if ($shouldBeNull != null) {
            echo json_encode(["ERROR" => "L'email est deja dans la base de donnees, l'utilisateur existe deja"]);
            exit();
        } else {
            $creationSuccess = createJoueur($username, $pwd, $email);
            if ($creationSuccess) {
                $newUser = readJoueurByEmail($email);
                echo json_encode(["newUser" => $newUser->getEmail()]);
                exit();
            } else {
                echo json_encode(["DATABASE ERROR" => "La BD s'est chiée dessus"]);
                exit();
            }
        }
       } else {
            echo json_encode(["ERROR" => "NOT A USER AND | OR NOT FOR READING"]);
            exit();
       }
    }  else {
        echo json_encode(["ERROR" => "INVALID REQUEST"]);
        exit();
    }
}

function getAction(mixed $request): string {
    if ($request["action"] === "CREATE") {
        return "CREATE";
    } else if ($request["action"] == "READ") {
        return "READ";
    } else if ($request["action"] == "UPDATE") {
        return "UPDATE";
    } else if ($request["action"] == "DELETE") {
        return "DELETE";
    } else {
        return "ERROR";
    }
}

function isUser(mixed $request): int {
    return strcasecmp($request["for"], "connection");
}