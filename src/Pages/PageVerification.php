<?php
    require_once("../CRUD/CRUDJoueur.php");
?>
    <link rel="stylesheet" href="../../assets/css/style_PCIR.css">
</head>
<body>
    <div class="PCIR">
        <h2>Saisir le code</h2>
        <form action = "PageVerification.php" method="POST">
            <input name="codeVerification" type="text" placeholder="Code de vérification" required>
            <button type="submit">Valider le code</button>
        </form>
    </div>
</body>
</html>
<?php
    if (!empty($_POST['codeVerification'])){
        if ($_POST['codeVerification'] == $_SESSION['codeVerification']){
            updatePassword($_SESSION['newPassword'],$_SESSION['E-mail']);
            header('Location: Page_Connexion.php');
        }else{
            echo '<script 
            type="text/javascript"> window.onload = function () { alert("Mauvais code de verification"); }
            </script>';
        }
    }
?>