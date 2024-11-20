<?php
    require_once("../Utils/headerInit.php");
    require_once("../CRUD/CRUDJoueur.php");
    require_once("../CRUD/CRUDPartie.php");
    require_once("../CRUD/CRUDJouerPartie.php");
    require_once("../CRUD/CRUDAppartientA.php");
    
    $_SESSION['user_id'] = 1;
    $joueurTemp = readJoueur($_SESSION['user_id']);

    if(isset($_POST['nombre_joueur'])) {
        $nombre_joueur = $_POST['nombre_joueur'];
        $idJoueur = $_SESSION['user_id'];
        $lienPartie = bin2hex(random_bytes(16));
        $idPartie = createPartie($nombre_joueur, "20d9d8dd72d31ba297889effa1aa3cd6");
        if ($idPartie == -1){
            echo '<script type="text/javascript"> window.onload = function () { alert("Lien déjà utilisé"); }</script>';
        }
        $idJouerPartie = createJouerPartie($idJoueur, $idPartie, 1);
        var_dump(readPositionIsUsed($idJoueur, $idPartie, 1));
    }
?>
    <link rel="stylesheet" href="../../assets/CSS/CreaRej.css">   
</head>
<body>
    <div class="section-haute">
        <a href="./index.php" id="retour">
            <img src="../../assets/Images/arrow-back.svg" alt="retour">
            <p>Retour</p>
        </a>
    </div>
    <div class="section-basse">
        <div class="zone">
            <div class="rejoindre">
                <h1>Rejoindre une partie</h1>
                <form action="Crearej.php" method="POST">
                    <div class="input-container">
                        <img src="../../assets/Images/icon-mail.png" class="input-icon" alt="icon">
                        <input type="text" placeholder="Code de la partie" required>
                    </div>
                    <button>Rejoindre</button>
                </form>
            </div>
        </div>
        <div class="separator-vertical">
            
        </div>
        <div class="zone">
            <div class="creer">
                <h1>Créer une partie</h1>
                <form action="CreaRej.php" method="POST">
                    <div class="radio-container">
                        <label>Nombre de joueur :</label>
                        <label for="joueur2"><input type="radio" id="joueur2" name="nombre_joueur" value="2" required> 2</label>
                        <label for="joueur3"><input type="radio" id="joueur3" name="nombre_joueur" value="3" required> 3</label>
                        <label for="joueur4"><input type="radio" id="joueur4" name="nombre_joueur" value="4" required> 4</label>
                    </div>
                    <div class="lien-container">
                        <img src="../../assets/Images/icon-mail.png" class="input-icon" alt="icon">
                        <p>Lien générer auto</p>
                    </div>
                    <button>Créer</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>