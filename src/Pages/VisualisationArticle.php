<?php
    require_once("../Utils/headerInit.php");
    require_once("../Utils/headerBody.php");
    require_once("../CRUD/CRUDArticle.php");
    require_once("../CRUD/CRUDCommentaire.php");
    $article =  readArticleById($_GET['id']);
    $titre = $article->getTitle();
    $contenu = $article->getContenu();
    $auteur= readCreatorbyArticle($_GET['id']);
    $allComments = readAllCommentsById($_GET['id']);
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
    <div class="VisualisationCommentaire">
        <h2>Commentaires : </h2>
        <?php
            foreach ($allComments as $commentaire){
                $idCommentaire = $commentaire['id'];
                $contenuCommentaire = $commentaire['contenu'];
                $auteurCommentaire =  readAllCommentOfCreatorById($_SESSION['userId'],$_GET['id']);
                echo "<div class='Commentaire'>
                <h3>Commentaire de ". $auteurCommentaire. "</h3>
                <p>". $contenuCommentaire. "</p>
            </div>";
            }
       ?>

    
    <h2>Ajout d'un commentaire : </h2>
    <form action="VisualisationArticle.php?id='. $_GET['id']" method="POST">
        <input type="text" name="contenuCommentaire" placeholder="Ajouter un commentaire">
        <button type="submit">Envoyer le commentaire</button>
        </div>
</body>
</html>
<?php
    if (!empty($_POST['contenuCommentaire'])) {
        createCommentaire($_POST['contenuCommentaire'], $_GET['id'],0, $_SESSION['userId']);
        exit();
    }
?>