document.addEventListener('DOMContentLoaded', function () {
    const userSelect = document.getElementById('userSelect');
    const userName = document.getElementById('userName');
    const userAvatar = document.getElementById('userAvatar');
    const containerHistorique = document.getElementById('containerHistorique');

    let formData = new FormData();
    formData.append('testdesecurité', true);
    fetch('../Utils/getHistorique.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status == 'success') {
            data.allJoueurs.forEach(joueur => {
                let option = document.createElement('option');
                option.value = joueur.idJoueur;
                option.text = joueur.pseudo;
                userSelect.appendChild(option);
            });
            userName.textContent = data.infoJoueur.pseudo;
            userAvatar.src = data.infoJoueur.avatarChemin;

            data.historique.forEach(partie => {
                let formData = new FormData();
                formData.append('idPartie', partie.idPartie);
                formData.append('idJoueur', data.infoJoueur.idJoueur);
                formData.append('testdesecurité', true);
                fetch('../Utils/getInfoAdversaires.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data2 => {
                    if (data2.status == 'success') {
                        let div = document.createElement('div');
                        div.classList.add('historiquePartie');

                        if (partie.estGagnant == 1) {
                            div.classList.add('victoire');
                        } else {
                            div.classList.add('defaite');
                        }

                        let divJoueur = document.createElement('div');
                        divJoueur.classList.add('joueur');

                        let imgAvatar = document.createElement('img');
                        imgAvatar.classList.add('imgAvatar');
                        imgAvatar.src = data.infoJoueur.avatarChemin;
                        divJoueur.appendChild(imgAvatar);

                        let spanName = document.createElement('span');
                        spanName.classList.add('spanName');
                        spanName.textContent = data.infoJoueur.pseudo;
                        divJoueur.appendChild(spanName);

                        let spanScore = document.createElement('span');
                        spanScore.classList.add('spanScore');
                        spanScore.textContent = partie.score;
                        divJoueur.appendChild(spanScore);

                        div.appendChild(divJoueur);

                        data2.infoAdversaires.forEach(adversaire => {
                            let spanVersus = document.createElement('span');
                            spanVersus.classList.add('spanVersus');
                            spanVersus.textContent = 'VS';
                            div.appendChild(spanVersus);

                            let divAdversaire = document.createElement('div');
                            divAdversaire.classList.add('joueur');

                            let imgAvatar = document.createElement('img');
                            imgAvatar.classList.add('imgAvatar');
                            imgAvatar.src = adversaire.avatarChemin;
                            divAdversaire.appendChild(imgAvatar);

                            let spanName = document.createElement('span');
                            spanName.classList.add('spanName');
                            spanName.textContent = adversaire.pseudo;
                            divAdversaire.appendChild(spanName);

                            let spanScore = document.createElement('span');
                            spanScore.classList.add('spanScore');
                            spanScore.textContent = adversaire.score;
                            divAdversaire.appendChild(spanScore);

                            div.appendChild(divAdversaire);
                        });

                        let styleHistoriquesGrid = "grid-template-columns: 1fr";

                        for (let i = 0; i < div.querySelectorAll('.joueur').length - 1; i++) {
                            styleHistoriquesGrid += " auto 1fr";
                        }

                        div.style = styleHistoriquesGrid;

                        containerHistorique.appendChild(div);
                    }
                })
            });
        }
    })

    userSelect.addEventListener('change', function () {
        let formData = new FormData();
        formData.append('idJoueur', userSelect.value);
        formData.append('testdesecurité', true);
        fetch('../Utils/getHistorique.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status == 'success') {
                userName.textContent = data.infoJoueur.pseudo;
                userAvatar.src = data.infoJoueur.avatarChemin;

                while (containerHistorique.firstChild) {
                    containerHistorique.removeChild(containerHistorique.firstChild);
                }

                data.historique.forEach(partie => {
                    console.log(partie);

                    let formData = new FormData();
                    formData.append('idPartie', partie.idPartie);
                    formData.append('idJoueur', data.infoJoueur.idJoueur);
                    formData.append('testdesecurité', true);
                    fetch('../Utils/getInfoAdversaires.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data2 => {
                        if (data2.status == 'success') {
                            let div = document.createElement('div');
                            div.classList.add('historiquePartie');
    
                            if (partie.estGagnant == 1) {
                                div.classList.add('victoire');
                            } else {
                                div.classList.add('defaite');
                            }
    
                            let divJoueur = document.createElement('div');
                            divJoueur.classList.add('joueur');
    
                            let spanName = document.createElement('span');
                            spanName.classList.add('spanName');
                            spanName.textContent = data.infoJoueur.pseudo;
                            divJoueur.appendChild(spanName);
    
                            let divAvatar = document.createElement('img');
                            divAvatar.classList.add('imgAvatar');
                            divAvatar.src = data.infoJoueur.avatarChemin;
                            divJoueur.appendChild(divAvatar);
    
                            div.appendChild(divJoueur);
    
                            data2.infoAdversaires.forEach(adversaire => {
                                let spanVersus = document.createElement('span');
                                spanVersus.classList.add('spanVersus');
                                spanVersus.textContent = 'VS';
                                div.appendChild(spanVersus);
    
                                let divAdversaire = document.createElement('div');
                                divAdversaire.classList.add('joueur');
    
                                let spanName = document.createElement('span');
                                spanName.classList.add('spanName');
                                spanName.textContent = adversaire.pseudo;
                                divAdversaire.appendChild(spanName);
    
                                let divAvatar = document.createElement('img');
                                divAvatar.classList.add('imgAvatar');
                                divAvatar.src = adversaire.avatarChemin;
                                divAdversaire.appendChild(divAvatar);
    
                                div.appendChild(divAdversaire);
                            });
    
                            let styleHistoriquesGrid = "grid-template-columns: 1fr";
    
                            for (let i = 0; i < div.querySelectorAll('.joueur').length - 1; i++) {
                                styleHistoriquesGrid += " auto 1fr";
                            }
    
                            div.style = styleHistoriquesGrid;
    
                            containerHistorique.appendChild(div);
                        }
                    })
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});