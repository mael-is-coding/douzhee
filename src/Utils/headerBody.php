<?php
require_once("../CRUD/CRUDJoueur.php");
?>
<body>
    <header>
        <form method="POST" action="Index.php">
            <input id="Logo" type="submit" value=""> 
        </form>
        
        <?php if (isset($_SESSION['userId'])):
            // On vérifie si les variables de session sont définies
            if (!isset($_SESSION['douzeCoin'])){
                $_SESSION['douzeCoin'] = getMoneyById($_SESSION['userId']); // Pour éviter de faire des requêtes inutiles
            }
            if (!isset($_SESSION['pseudo'])){
                $_SESSION['pseudo'] = getPseudoById($_SESSION['userId']);
            }
        ?>
            <div class="selection_droite">
            <span id="money"><?php echo $_SESSION['douzeCoin']; ?></span>
                <img src="../../assets/Images/imgheader/coin_dollar_finance_icon_125510 1.png" alt="Money du Jeu" width="27" height="27" id="coin">
                <span id="pseudo"><?php echo $_SESSION['pseudo']; ?></span>
                <form action="Profil.php" method="GET">
                    <input id="profil" type="submit" value="">
                </form>
                <form method="POST" action="../Utils/logout.php">
                    <button type="submit">Déconnexion</button>
                </form>
            </div>
        <?php else: ?>
            <div class="selection_droite">
                <form method="POST" action="Connexion.php">
                    <button type="submit">Connexion</button>
                </form>
            </div>
        <?php endif; ?>
     </header>
     <script>
        const img = document.getElementById("profil")
        img.style.backgroundImage = 'url("<?php echo readAvatarById($_SESSION['userId']); ?>")'
        console.log("<?php echo readAvatarById($_SESSION['userId']); ?>")
    </script>
