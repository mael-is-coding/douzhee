import { changeTheme } from './scriptTheme.js';

document.addEventListener('DOMContentLoaded', function() {
    var themeSelected;
    var musicSelected;

    var pseudo = document.querySelector('#pseudoInput');
    var description = document.querySelector('#descriptionInput');

    var formData = new FormData();
    formData.append('testdesecurité', true);
    fetch('../Utils/getThemeAndMusic.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            themeSelected = document.querySelector(`#themeContainer [id='${data.theme}']`);
            if (themeSelected) {
                themeSelected.classList.add('selected');
            }

            musicSelected = document.querySelector(`#musiqueContainer [id='${data.music}']`);
            if (musicSelected) {
                musicSelected.classList.add('selected');
            }
        }
    });

    var themes = document.querySelectorAll('.themeItem');
    var musics = document.querySelectorAll('.musicItem');

    themes.forEach(function(theme) {
        theme.addEventListener('click', function() {
            if (themeSelected != undefined) {
                themeSelected.classList.remove('selected');
            }
            themeSelected = theme;
            themeSelected.classList.add('selected');
            changeTheme(themeSelected.id + '');
        });
    });


    musics.forEach(function(music) {
        music.addEventListener('click', function() {
            if (musicSelected != undefined) {
                musicSelected.classList.remove('selected');
            }
            musicSelected = music;
            musicSelected.classList.add('selected');
        });
    });

    var saveButton = document.querySelector('#valider');
    saveButton.addEventListener('click', function() {

        var formData = new FormData();
        formData.append('theme', themeSelected.id);
        formData.append('music', musicSelected.id);
        formData.append('pseudo', pseudo.value);
        formData.append('description', description.value);
        formData.append('testdesecurité', true);
        fetch('../Utils/savePersonnalisation.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                window.location.href = '../Pages/Profil.php';
            } else {
                console.error("Erreur : " + data.message);
            }
        })

    });
});