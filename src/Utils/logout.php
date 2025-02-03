<?php
    require_once("headerInit.php");
    session_destroy();
    header("Location: /douzhee/src/Pages/index.php");
    exit();
?>