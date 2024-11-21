<?php
    require_once("../CRUD/CRUDJoueur.php");
    require_once("../Utils/headerInit.php");
    $stats = readStatistiquesByIdUser($_SESSION['userID']);
?>
    <link rel="stylesheet" href="../../assets/css/style_PCIR.css">
</head>
<body>
    <div class="PCIR">
        <h2>Inscription</h2>
        <form action = "Inscription.php" method="POST">
            <input name="E-mail" type="email" placeholder="E-mail" required>
            <input name="Pseudo" type="text" placeholder="Username" required maxlength="30" title="Longueur maximale 30 caractère!">
            <input name = "Password" type="password" placeholder="Password" required maxlength="25" title="Longueur maximale 25 caractère!">
            <button type="submit">Inscription</button>
        </form>
    </div>
</body>
</html>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (!empty($_POST['E-mail']) && !empty($_POST['Pseudo']) && !empty($_POST['Password'])){
            $dejaExistant = verifEmail($_POST['E-mail']);
            if ($dejaExistant){
                echo '<script 
                type="text/javascript"> window.onload = function () { alert("Utilisateur déja existant pour cette adresse mail!"); }
                </script>';
            }
            else{
                $_SESSION['userId'] = getIdUser($_POST['E-mail']);
                insertUser($_POST['E-mail'],$_POST['Password'],$_POST['Pseudo']);
                createStatistiques($_SESSION['userId']);
                header('Location: Index.php');
             }
        }
    }
?>