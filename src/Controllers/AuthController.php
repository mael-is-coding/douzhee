<?php

header("Access-Control-Allow-Origin: https://localhost");
header("Access-Control-Allow-Headers: *");


if ($_SERVER("REQUEST_METHOD") === "GET") {
    echo json_encode (file_get_contents("php://input"));
    exit;
}