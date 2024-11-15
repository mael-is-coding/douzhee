<?php
    require_once("../CRUD/CRUDJoueur.php");
    require_once("../Utils/headerInit.php");
?>
    <link rel="stylesheet" href="../../assets/css/styleProfil.css">
    <link rel="stylesheet" href="../../assets/css/styleheader.css"> 
</head>
<?php
    require_once("../Utils/headerBody.php");
?>
    <div class="PageProfil">
        <img src="imgheader/photodefault.jpg" alt="Avatar" width="100" height="100" id="avatar">
        <h2 id="Pseudo"><?php echo getPseudoById($_SESSION['user_id']); ?></h2>
        <p id="bio"><?php echo getBioById($_SESSION['user_id']); ?></p>
        <div class="buttons">
            <button onclick="location.href='states.php'">Statistiques</button>
            <button onclick="location.href='perso.php'">Personnalisation</button>
            <button onclick="location.href='succes.php'">Succès</button>
        </div>
    </div>
</body>
</html>