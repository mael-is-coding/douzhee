<?php
    require_once("headerInit.php");
    unset($_SESSION['user_id']);
    header("Location: ../Pages/index.php");
    exit();
?>