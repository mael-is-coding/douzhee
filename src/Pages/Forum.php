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
        <h1>Bienvenue sur le forum</h1>
        <h2>Liste des Articles : </h2>
        <?php
            foreach ($allArticles as $article){
                $idArticle = $article['id'];
                $titreArticle = $article['titre'];
                $contenuArticle = $article['contenu'];
                echo "<div class='Article'>
                <h3><a href='VisualisationArticle.php?id=" . urlencode($idArticle) . "'>" . $titreArticle . "</a></h3>
                <p>Publié par " . readCreatorbyArticle($idArticle) . "</p>
                </div>";
            }
        ?>
        <h2>Formulaire pour ajouter un article:</h2>
        <form action="Forum.php"method="POST">
            <input type="text" name="titreArticle" placeholder="Inserer un titre">
            <textarea name="contenuArticle" placeholder="Inserer un contenu"></textarea>
            <button type="submit">Enregistrer l'article</button>
        </form>
    </div>
</body>
</html>
<?php
    if (!empty($_POST['titreArticle']) && !empty($_POST['contenu'])){
        createArticle($_POST['titreArticle'],$_POST['contenu'],$_SESSION['userId']);
        header('Location : index.php');
        exit();
    }
?>