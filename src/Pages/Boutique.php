<?php
    require_once("../Utils/headerInit.php");
    require_once("../Utils/headerBody.php");
    require_once("../CRUD/CRUDJoueur.php");
    require_once("../CRUD/CRUDSkinAchete.php");
    $allAchats = readAllAchatByUser($_SESSION['userId']);
?>
    <link rel="stylesheet" href="../../assets/CSS/styleBoutique.css">
    <link rel="stylesheet" href="../../assets/CSS/styleHeader.css">
</head>
<body>
    <div class="Boutique">
        <h2>Bienvenue sur notre boutique !</h2>
        <div class="Theme">
            <h2>Voici tous les thèmes disponibles : </h2>
            <img src="../../assets/images/imagePersonnalisation/Theme2.png"  class="clickable" id="2">
            <img src="../../assets/images/imagePersonnalisation/Theme3.png"  class="clickable" id="3">
        </div>
        <div class="Dés">
            <h2>Voici tous les skin de dés disponibles : </h2>
            <img src="../../assets/images/imagePersonnalisation/dés_1.png">
            <img src="../../assets/images/imagePersonnalisation/dés_2.png">
        </div>
    </div>
    <div id="fenModal">
        <div class="content">
            <h2>Voulez-vous acheter ce skin?</h2>
            <img src="" id="modalImage">
            <h2 id="price"> Cela vous coutera 350 douzcoin</h2>
            <button id="refuser">Refuser</button>
            <button id="valider">Valider</button>
        </div>
    </div>
</body>
</html>
<?php
    if (is_array($allAchats)){
        foreach($allAchats as $achats){
            $themeId = $achats['idSkin'];
        }
        ?>
        <script>
            document.addEventListener('DOMContentLoaded', () =>{
                const theme = document.getElementById("<?php echo $themeId; ?>");
                if (<?php echo $themeId; ?> === 2){
                    theme.src = "../../assets/images/imageBoutique/Theme2Acheter.png";
                }else if(<?php echo $themeId; ?> === 3){
                    theme.src = "../../assets/images/imageBoutique/Theme3Acheter.png";
                }
                

            });
        </script>
        <?php
    }
?>
<script>
        const modal = document.getElementById("fenModal");
        const inputs = document.querySelectorAll(".clickable")
        const valider = document.getElementById("valider");
        const refuser = document.getElementById("refuser");
        const modalImage = document.getElementById("modalImage");
        const price = document.getElementById("price");

        let selectedSkin = null;
        let idSkin = null;

           
     inputs.forEach(input => {
        input.addEventListener('click', () =>{
            selectedSkin = input.src;
            idSkin = input.id;
            modalImage.src = selectedSkin;
            modal.style.display = "block";
        });
     });
      
       refuser.onclick = () =>{
            modal.style.display = "none";
        };
        window.onclick = (event) =>{
            if (event.target === modal){
                modal.style.display = "none";
            }
        };

       valider.addEventListener('click', () =>{
        const userMoney = <?php echo getMoneyById($_SESSION['userId']); ?>
        if (userMoney >= 350){
            alert("Achat réussi !");
            modal.style.display = "none";
            <?php
            $newmoney = $userMoney - 350;
            updateDouzCoin($_SESSION['userId'], $newmoney);
            createSkinAchete($idSkin,$_SESSION['userId'],0,"Theme",date("Y/m/d"));
            ?>
        }else{
            alert("Vous êtes trop pauvres !");
            modal.style.display = "none";
        }
       });
    

 </script>