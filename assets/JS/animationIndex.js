document.addEventListener('DOMContentLoaded', function() {
    var regles = document.querySelector('#regles');
    var spanRegles = document.querySelector('#regles span');
    var imgRegles = document.querySelector('#regles img');
    var boolRegle = true;

    var classement = document.querySelector('#classement');
    var spanClassement = document.querySelector('#classement span');
    var imgClassement = document.querySelector('#classement img');
    var boolClassement = true;

    /*
    var versusbot = document.querySelector('#versusrobot');
    var imageGaucheVersBot = document.querySelector('#versusrobot #imgProfile1');
    var imageDroiteVersBot = document.querySelector('#versusrobot #imgProfile2');
    var spanVersusBot = document.querySelector('#versusrobot span');
    var barVersusBot1 = document.querySelector('#versusrobot .trait1::before');
    var boolVersusBot = true;
    */

    var versushuman = document.querySelector('#versushuman');
    var imageGaucheVersHuman = document.querySelector('#versushuman #imgProfile1');
    var imageDroiteVersHuman = document.querySelector('#versushuman #imgProfile2');
    var spanVersusHuman = document.querySelector('#versushuman span');
    var boolVersusHuman = true;

    var boutique = document.querySelector('#boutique');
    var spanBoutique = document.querySelector('#boutique span');
    var imgBoutique = document.querySelector('#boutique img');
    var boolBoutique = true;

    var historique = document.querySelector('#historique');
    var spanhistorique = document.querySelector('#historique span');
    var boolhistorique = true;

    regles.addEventListener('mouseover', function() {
        if (boolRegle) {
            spanRegles.classList.add('animateLeft');
            imgRegles.classList.add('animateRight');
            boolRegle = false;
        }
    });

    regles.addEventListener('animationend', function() {
        spanRegles.classList.remove('animateLeft');
        imgRegles.classList.remove('animateRight');
    });

    regles.addEventListener('mouseleave', function() {
        boolRegle = true;
    });


    classement.addEventListener('mouseover', function() {
        if (boolClassement) {
            spanClassement.classList.add('animateLeft');
            imgClassement.classList.add('animateRight');
            boolClassement = false;
        }
    });

    classement.addEventListener('animationend', function() {
        spanClassement.classList.remove('animateLeft');
        imgClassement.classList.remove('animateRight');
    });

    classement.addEventListener('mouseleave', function() {
        boolClassement = true;
    });

    versushuman.addEventListener('mouseover', function() {
        if (boolVersusHuman) {
            imageGaucheVersHuman.classList.add('animateLeft');
            imageDroiteVersHuman.classList.add('animateRight');
            spanVersusHuman.classList.add('animateZoomIn');
            boolVersusHuman = false;
        }
    });

    versushuman.addEventListener('animationend', function() {
        imageGaucheVersHuman.classList.remove('animateLeft');
        imageDroiteVersHuman.classList.remove('animateRight');
        spanVersusHuman.classList.remove('animateZoomIn');
    });

    versushuman.addEventListener('mouseleave', function() {
        boolVersusHuman = true;
    });

    boutique.addEventListener('mouseover', function() {
        if (boolBoutique) {
            spanBoutique.classList.add('animateLeft');
            imgBoutique.classList.add('animateRotate3D');
            boolBoutique = false;
        }
    });

    boutique.addEventListener('animationend', function() {
        spanBoutique.classList.remove('animateLeft');
        imgBoutique.classList.remove('animateRotate3D');    
    });

    boutique.addEventListener('mouseleave', function() {
        boolBoutique = true;
    });


    historique.addEventListener('mouseover', function() {
        if (boolhistorique) {
            spanhistorique.classList.add('animateJackInTheBox');
            boolhistorique = false;
        }
    });

    historique.addEventListener('animationend', function() {
        spanhistorique.classList.remove('animateJackInTheBox');
    });

    historique.addEventListener('mouseleave', function() {
        boolhistorique = true;
    });
});