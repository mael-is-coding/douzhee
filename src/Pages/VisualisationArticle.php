<?php
    require_once("../Utils/headerInit.php");
    require_once("../Utils/headerBody.php");
    require_once("../CRUD/CRUDArticle.php");
    $article =  readArticleById($_GET['id']);
    $titre = $article->getTitle();
    $contenu = $article->getContenu();
    $auteur= readCreatorbyArticle($_GET['id'])
?>
 <link rel="stylesheet" href="../../assets/css/styleHeader.css">
 <link rel="stylesheet" href="../../assets/css/styleGlobal.css"> 
</head>
<body>
    <div class="VisualisationArticle">
        <h2>Titre : <?php echo $titre;?></h2>
        <p>Contenu : <?php echo $contenu;?></p>
        <p>Auteur : <?php echo $auteur?></p>
    </div>
</body>
</html>