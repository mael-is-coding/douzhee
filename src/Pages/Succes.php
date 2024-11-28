<?php
    require_once("../CRUD/CRUDJoueur.php");
    require_once("../Utils/headerInit.php");
    require_once("../CRUD/CRUDClassement.php");
    require_once("../CRUD/CRUDSucces.php");
    require_once("../CRUD/CRUDObtient.php");
?>
    <link rel="stylesheet" href="../../assets/css/styleHeader.css"> 
    <link rel="stylesheet" href="../../assets/css/styleSucces.css"> 
<?php
    require_once("../Utils/headerBody.php");
   
?>        
</head>
<body>
    <div class="Succes">
        <h2>Succès :</h2>
        <?php
            for ($i = 1; $i < 34; $i++) {
                echo '<img src="../../assets/images/imageSucces/Succes_verrouille.png" alt="Image du succès" id="'. $i .'" class="clickable">';
            }
        ?>

    </div>
    <div id="fenModal">
        <div class="content">
            <h2>Voici comment obtenir ce skin !</h2>
            <img src="" id="modalImage">
            <h2 id="nomSucces"></h2>
            <h2 id="conditionSucces"></h2>
        </div>
</body>
</html>
 <?php
    for ($i= 1; $i < 34; $i++) {
        $allsucces = readAllUserWinTheSuccesId($i);
        if (is_array($allsucces)) {
            foreach ($allsucces as $succes) {
                if ($_SESSION['userId'] == $succes['idJoueur']) {  
                    ?>
                    <script>
                        document.addEventListener('DOMContentLoaded', () => {
                            const img = document.getElementById('<?php echo $i; ?>');
                            img.src = '../../assets/images/imageSucces/<?php echo $i; ?>.png';
                        });
                    </script>
                    <?php
                    break;  


    }
}
    }
}
 ?>
<script>
     const inputs = document.querySelectorAll(".clickable");
     const modal = document.getElementById("fenModal");
     const modalImage = document.getElementById("modalImage");
     const nom = document.getElementById("nomSucces");
     const condition = document.getElementById("condtionSucces");

     var selectedSkin = null;
     var selectedId = null;
           
     inputs.forEach(input => {
        input.addEventListener('click', () =>{
            console.log("SKin cliqué");
            selectedSkin = input.src;
            selectedId = input.id;
            fetch("../Utils/proccessuCheckSKin.php", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({selectedId : selectedId})
            })
            .then(response => response.json())  // On attend une réponse JSON
            .then(data => {
         
            if (data) {
            modalImage.src = selectedSkin;
            modal.style.display = "block";
            condition.textContent = data[0].condition;
            nom.textContent = data[0].nom;
            }
        });
     });
    });
     window.onclick = (event) =>{
            if (event.target === modal){
                modal.style.display = "none";
            }
        };
</script>
