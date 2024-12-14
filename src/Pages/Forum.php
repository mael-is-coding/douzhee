<?php
    require_once("../Utils/headerInit.php");
    require_once("../Utils/headerBody.php");
    require_once("../CRUD/CRUDArticle.php");
    $allArticles = readAllArticle();

?>
 <link rel="stylesheet" href="../../assets/css/styleHeader.css">
 <link rel="stylesheet" href="../../assets/css/styleGlobal.css"> 
</head>
<body>
    <div class="Forum">
        <h2>Bienvenue sur le forum</h2>
        <h2>Liste des Articles</h2>
        <?php
            foreach ($allarticles as $article){
                $idArticle = $article['id'];
                $titreArticle = $article['titre'];
                $contenuArticle = $article['contenu'];
                $nomArticle = $article['nom'];
                echo "<div class='Article'>
                    <h3>$titreArticle</h3>
                    <p>$contenuArticle</p>
                    <p>Publié par readCreatorbyArticle($idArticle)</p>
                </div>";
            }
        ?>
    </div>
</body>
</html>