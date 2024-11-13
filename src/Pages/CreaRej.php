<?php
    include_once "Session.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Douzhee</title>
    <link rel="stylesheet" href="../../assets/CSS/CreaRej.css">
</head>
<body>
    <div class="section-haute">
        <button id="retour">
            <img src="../../assets/Images/arrow-back.svg" alt="retour">
            <p>Retour</p>
        </button>
    </div>
    <div class="section-basse">
        <div class="zone">
            <div class="rejoindre">
                <h1>Rejoindre une partie</h1>
                <form action="">
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
                <form action="">
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