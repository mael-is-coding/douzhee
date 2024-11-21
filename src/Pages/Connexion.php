<?php
    require_once("../CRUD/CRUDJoueur.php");
    require_once("../Utils/headerInit.php");
?>

    <link rel="stylesheet" href="../../assets/css/styleCIRV.css"> 
</head>
<body>
    <div class="PCIR">
        <h2>Connexion</h2>
        <form action = "Connexion.php" method="POST">
            <input name="E-mail" type="email" placeholder="E-mail" required value="<?php echo $_SESSION['cacheE-mail'] ?? '';?>">
            <input name = "Password" type="password" placeholder="Password" required value="<?php echo $_SESSION['cachePassword'] ?? '';?>">
            <div class="checkbox">
            <input type ="checkbox" id="check" name="checkbox">
            <label for="check">Se souvenir de moi</label>
            </div>
            <button type="submit">Connexion</button>
        </form>
        <a href="Reinitialisation.php">Mot de passe oublié ?</a>
        <div class = "link">Nouveau ici ? <a href="Inscription.php">Inscrivez vous</a>
        </div>
    </div>
</body>
</html>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (!empty($_POST['E-mail']) && !empty($_POST['Password'])){
        $email = $_POST['E-mail'];
        $mdp = $_POST['Password'];
        if (!empty($_POST['checkbox'])){
            $_SESSION['cacheE-mail'] = $email;
            $_SESSION['cachePassword'] = $mdp;
        }else{
            unset($_SESSION['cacheE-mail'], $_SESSION['cachePassword']);
        }
        $trouve = verifUser($_POST['E-mail']);
        if ($trouve){
            $_SESSION['userId'] = getIdUser($_POST['E-mail']);
            header('Location: Index.php');
            exit;
        } else {
            echo '<script 
                        type="text/javascript"> window.onload = function () { alert("Mauvais mot de passe ou email"); }
                        </script>';
        }
    }
}
?>