<?php
    require_once("../CRUD/CRUDJoueur.php");
    require_once("../Utils/headerInit.php");
?>
    <link rel="stylesheet" href="../../assets/css/styleProfil.css">
    <link rel="stylesheet" href="../../assets/css/styleheader.css"> 
    <link rel="stylesheet" href="../../assets/css/stylePersonnalisation.css">
</head>
<?php
    require_once("../Utils/headerBody.php");
?>
        
<body>
    <div class="Profil">
        <form action="PagePersonnalisation.php" method="POST">
            <label for="Pseudo">Pseudo</label>
            <input type="text" id="Pseudo" name="pseudo" placeholder="<?php echo getPseudoById($_SESSION['user_id']) ?>" maxlength="50">

            <input type="file" name="avatar" id="avatar" accept="image/*">

            <label for="Bio">Bio</label>
            <input type="text" id="Bio" name="bio" placeholder="<?php echo getBioById($_SESSION['user_id'])?>" maxlength="500">

            <label for="Themes">Themes</label>
            <input type="radio" id="Themes_1" name="themes">
            <input type="radio" id="Themes_2" name="themes">
            <input type="radio" id="Themes_3" name="themes">

            <label for="Dés">Dés</label>
            <input type="radio" id="Des_1" name="des">
            <input type="radio" id="Des_2" name="des">
            <input type="radio" id="Des_3" name="des">

            <button type="submit">Enregistrer les informations</button>
    </div>
</body>
</html>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (!empty($_POST['pseudo'])){
            updateJoueur($_SESSION['user_id'], $_POST['pseudo']);

        }elseif(!empty($_POST['bio'])){
            updateJoueur($_SESSION['user_id'],null,null,null, $_POST['bio']);

        }elseif(isset($_FILES['avatar'])){
            $file = $_FILES['avatar'];
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $uploadDir = '../../assets/images/imageavatars/';
            $filename = uniqid() . '_' . basename($file['name']);
            $uploadFile = $uploadDir . $filename;
            if (in_array($file['type'], $allowedTypes) && $file['size'] <= 2000000) { 
                if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
                    $relativePath = $uploadDir . $filename; 
                  // addPatchFile($_SESSION['user_id'], $relativePath);
        
                    echo "Avatar mis à jour avec succès !";
                } else {
                    echo "Erreur lors du téléchargement de l'image.";
                }
            } else {
                echo "Le fichier doit être une image (JPEG, PNG, GIF) de moins de 2 Mo.";
            }

    }
}
?>