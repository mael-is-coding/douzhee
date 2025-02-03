document.addEventListener('DOMContentLoaded', function() {
    var formData = new FormData();
    formData.append('testdesecurité', true);

    fetch('../Utils/readAllAchats.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            var allAchatsThemes = data.allAchatsThemes;
            var allAchatsMusiques = data.allAchatsMusiques;

            allAchatsThemes.forEach(achat => {
                const themeId = achat.idTheme;
                const themeDiv = document.querySelector('#Theme');
                const theme = themeDiv.querySelector('#Theme' + themeId);
                if (theme) { // Vérifiez si l'élément existe
                    const themeImg = theme.querySelector('img');
                    if (themeImg) { // Vérifiez si l'image existe
                        theme.classList.add('sold');
                    }
                }
            });

            allAchatsMusiques.forEach(achat => {
                const musicId = achat.idMusique;
                const musicDiv = document.querySelector('#Musique');
                const music = musicDiv.querySelector('#Musique' + musicId);
                if (music) { // Vérifiez si l'élément existe
                    const musicImg = music.querySelector('img');
                    if (musicImg) { // Vérifiez si l'image existe
                        music.classList.add('sold');
                    }
                }
            });
        } else {
            console.error('Error:', data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});