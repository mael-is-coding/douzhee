import { getPartieEnCours, setPartieEnCours } from "./scriptIdPartieEnCours.js";

document.addEventListener('DOMContentLoaded', () => {
    const decoButton = document.querySelector("#decoButton");

    if(decoButton !== null){
        decoButton.addEventListener('click', async (event) => {
            const idPartie = await getPartieEnCours();
            let deconnexionValid = false;
            if(idPartie){
                if(window.confirm('Souhaitez-vous vraiment abandonner votre partie en cours ?')){
                    localStorage.removeItem('donneesJoueur');
                    setPartieEnCours();
                    deconnexionValid = true;
                } else{
                    event.preventDefault();
                }
            }
            if(deconnexionValid || !idPartie){
                let formData = new FormData();
                formData.append('testdesecurité', true);
                await fetch('../Utils/logout.php', {
                    method: 'POST',
                    body: formData
                });
                window.location.href = '../../src/Pages/index.php';
            }
        });
    }
});