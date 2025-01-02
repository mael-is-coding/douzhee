class Joueur {

    static connectedUser = null;

    pseudo = null
    mdp = null;
    douzCoin = null;
    email = null;
    bio = null;
    dateInsc = null;
    idPartieEnCours = null;

    constructor(pseudo = null, mdp = null, douzCoin = null, email = null, bio = null, dateInsc = null, idPartie = null, defaultU = true) {
        if (!defaultU) {
            this.pseudo = pseudo;
            this.mdp = mdp;
            this.douzCoin = douzCoin;
            this.email = email;
            this.bio = bio;
            this.dateInsc = dateInsc;
            this.idPartieEnCours = idPartie;

        } else {
            this.pseudo = "GUEST";
            this.mdp = "";
            this.douzCoin = 0;
            this.email = "GUEST@douzhee.com";
            this.bio = "Je suis une zikette parceque j'ai pas de compte";
            this.dateInsc = "aujourd'hui";
            this.idPartieEnCours = -1;
        }
    }

    /**
     * @author Mael
     * @brief instancie un nouvel object User et le met dans la variable statique connectedUser
     * @param {JSON} JSONObj un objet JSON envoyé par le côté serveur. doit modéliser un Joueur.php.
     */
    connect(JSONObj) {
        
    }
}