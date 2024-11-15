<?php
    require_once("headerInit.php");
    session_destroy();
    header("Location: ../Pages/index.php");
    exit();
?>