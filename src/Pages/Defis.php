<?php
require_once("../Utils/headerInit.php");
require_once("../Utils/headerBody.php");
require_once("../CRUD/CRUDDefis.php");
require_once("../CRUD/CRUDMaitrise.php");
$date = new DateTime('2024-12-16');
$defis = readDefisReussiByUser($_SESSION['userId']);
$allDefis = readAllDefis();
$idDefis = 0;
$idDefisMaitrise = 0;
?>
<link rel="stylesheet" href="../../assets/css/styleGlobal.css">
<link rel="stylesheet" href="../../assets/css/styleHeader.css">
</head>
<body>
    <div class="Defis">
        <h2>Voici les défis qui vous attendent :</h2>
        <h2>Date avant le renouvellement des défis : <?php echo $date->format('d/m/Y'); ?></h2>
        <?php
        foreach ($allDefis as $defi) {
            $idDefis = $defi['id'];
            $idDefisMaitrise = 0;
            foreach($defis as $def){
                if($def['id'] === $idDefis){   
                    $idDefisMaitrise = 1;
                    break;
                }
               
            }
            echo '<div class="defi">';
            echo '<h3>'."Nom : ". $defi['nom']. '</h3>';
            echo '<p>'."Condition : ". $defi['Description']. '</p>';
            echo '<p>'."gain : ". $defi['gain']. '</p>';
            echo '<label for="validation">Défis valider ? : </label>';
            echo '<input type="radio" ' . (($idDefisMaitrise == 1) ? 'checked' : '') . ' id="validation_' . $idDefis . '" name="valider_' . $idDefis . '" disabled>';
            echo '</div>';
                
        }
        ?>
        <form action="index.php" method="POST">
            <h2>Formulaire de création de Défis : </h2>
            <input type="text" name="nomDefis" placeholder="Insérer le nom du Défis" maxlength="50">
            <input type="text" name="descriptionDefis" placeholder="Insérer une description du Défis" maxlength="150">
            <input type="number" name="gainDefis" placeholder="Insérer le gain du Défis" maxlength="3">
            <button type="submit">Créer le défi</button>
        </form>
    </div>
</body>
</html>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (!empty($_POST['nomDefis']) &&!empty($_POST['descriptionDefis']) &&!empty($_POST['gainDefis'])) {
            createDefis($_POST['nomDefis'], $_POST['descriptionDefis'], $_POST['gainDefis']);
            exit();
        }
    }
?>
