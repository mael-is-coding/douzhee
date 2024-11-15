<?php
    require_once("../Utils/headerInit.php");
?>
        <link rel="stylesheet" href="../../assets/css/style_regles.css">
        <link rel="stylesheet" href="../../assets/css/styleheader.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
    </head>
<?php
    require_once("../Utils/headerBody.php");
?>  
         <div class="container">
            <div class="bulle" id="bulle">
                <p id="Texte">Première fois ici? Voulez-vous que je vous explique les règles?</p>
                <div class="Bouton">
                    <button type="button" id="Valider">Oui</button>
                    <button type="button" id="Refuser">Non</button>
                    <audio id="audio" src="audio/musique.mp3"></audio>
                    <img src="img/fleche.png" alt="fleche" id="flèche" width="60" height="30 ">
                </div>
            </div>
            <img src="img/mascotte1.png" alt="Personnage" id="FirstMascotte" width="200" height="300">
            <img src="img/mascotte2.png" alt="Personnage" id="SecondMascotte" width="200" height="300">  
        </div>
        <script src="script.js"></script>
    </body>
</html>