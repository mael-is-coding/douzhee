<?php
    require_once("../Utils/headerInit.php");
    ?>
    
   
    <link rel="stylesheet" href="../../assets/css/styleCIRV.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
    <div class="PCIR">
        <h2>Inscription</h2>
        <form id="signupForm" method="POST">
            <input id="signupEmail" type="email" placeholder="E-mail" required  title="L'email doit etre de ce format : exemple@domaine.com">
            <input id="signupPseudo" type="text" placeholder="Username" required maxlength="20" 
             title="Longueur maximale 20 caractère!">
            <input id="signupPassword" type="password" placeholder="Password" required minlength="8" maxlength="25" title="Le mot de passe doit contenir au moins une majuscule, une minuscule, un chiffre et un caractère spécial.Longeur minimale 8 caractère.Longueur maximale 25 caractère!">
            <i id="eye-icon" class=" fa-solid fa-eye-slash"></i>
            <button type="submit">Inscription</button>
        </form>
    </div>
    <script type="module" src="../../assets/js/auth.js"></script>
</body>
</html>
