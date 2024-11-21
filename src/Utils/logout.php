<?php
    require_once("headerInit.php");
    session_destroy();
    header("Location: Index.php");
    exit();
?>