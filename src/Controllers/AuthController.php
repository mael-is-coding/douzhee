<?php

header("Access-Control-Allow-Origin: http://localhost");
header("Access-Control-Allow-Headers: application/json");

require_once("../CRUD/CRUDJoueur.php");
require_once("../CRUD/CRUDPartie.php");
require_once("../CRUD/CRUDJoueurPartie.php");
require_once("../CRUD/CRUDTheme.php");
require_once("../CRUD/CRUDMusique.php");
require_once("../CRUD/CRUDAcheterTheme.php");
require_once("../CRUD/CRUDAcheterMusique.php");
require_once("../CRUD/CRUDSucces.php");
require_once("../CRUD/CRUDSuccesJoueur.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $request = json_decode(file_get_contents("php://input"), true);
    routing($request);
}

/**
 * Routeur des requêtes d'authentification
 */
function routing(mixed $request): void {
    if (!isset($request["object"]) || $request["object"] !== "Joueur") {
        sendResponse(400, ["error" => "Requête invalide"]);
    }

    switch (getAction($request)) {
        case "READ":
            connectUser($request["params"]["email"], $request["params"]["pwdHash"]);
            break;
        case "CREATE":
            createUser($request["params"]["username"], $request["params"]["pwd"], $request["params"]["email"]);
            break;
        default:
            sendResponse(400, ["error" => "Action non valide"]);
    }
}

/**
 * Vérifie l'existence d'un utilisateur et connecte si les identifiants sont valides.
 */
function connectUser(string $email, string $pwdHash): void {
    $joueur = readJoueurByEmail($email);

    if (!$joueur) {
        sendResponse(404, ["error" => "Email non trouvé"]);
    }
    $storedHashedPwd = trim($joueur->getMdp());
    echo 'Mot de passe envoyé: ' . $pwdHash . PHP_EOL;
    echo 'Hachage stocké: ' . $storedHashedPwd . PHP_EOL;
    
    var_dump(password_verify(trim($pwdHash), trim($storedHashedPwd)));  // Devrait retourner true
    if (!password_verify($pwdHash, $storedHashedPwd)) {
        sendResponse(401, ["error" => "Mot de passe incorrect"]);
    }else{
        sendResponse(200, ["success" => "Utilisateur connecté"]);
    }

    
}

/**
 * Crée un nouvel utilisateur si l'email n'est pas déjà pris.
 */
function createUser(string $username, string $pwd, string $email): void {
    if (readJoueurByEmail($email)) {
        sendResponse(409, ["error" => "Email déjà utilisé"]);
    }

    $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT);

    if (createJoueur($username, $hashedPwd, $email)) {
        sendResponse(201, ["success" => "Utilisateur créé"]);
    } else {
        sendResponse(500, ["error" => "Erreur lors de la création"]);
    }
}

/**
 * Récupère l'action demandée.
 */
function getAction(mixed $request): string {
    return $request["action"] ?? "ERROR";
}

/**
 * Envoie une réponse JSON propre.
 */
function sendResponse(int $statusCode, array $response): void {
    http_response_code($statusCode);
    echo json_encode($response);
    exit();
}