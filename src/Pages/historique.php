<?php
    require_once("../Utils/headerInit.php");

    if (!isset($_SESSION['userId'])) {
        require_once("../Utils/redirection.php");
    }
?>
<link rel="stylesheet" href="../../assets/CSS/Theme.css">
<link rel="stylesheet" href="../../assets/CSS/styleHistorique.css">
<link rel="stylesheet" href="../../assets/CSS/styleHeader.css">
</head>

<body>
    <?php require_once("../Utils/headerBody.php"); ?>
    <div id="container">
        <div id="containerInfo">
            <select id="userSelect"></select>

            <h1 id="userName"></h1>

            <img id="userAvatar" src="" alt="imgProfil">
        </div>
        <div id="containerHistorique">

        </div>
    </div>
    <script src="../../assets/JS/scriptHistorique.js"></script>
</body>
</html>