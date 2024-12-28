class AuthManager { 
    
    static instance = null;
    name = "";

    constructor(name) {
        this.name = name;
    }

    static getInstance() {
        if (AuthManager.instance === null) {
            AuthManager.instance = new AuthManager(name);
        } else {
            return AuthManager.instance;
        }
    }

    /**
     * @author Mael
     * @param {*} email email sous forme valide (util@domaine.tld)
     * @param {*} password un mot de passe HASHÉ, qui idéalement existe dans la BdD
     * Une fonction qui vérifie si un utilisateur existe dans la base de données. Si oui, le conencte.
     */
    connectExistingUser (email, pwdHash) {
        fetch("http://localhost/douzhee/src/Controllers/AuthController.php", {
            method : "POST",
            mode : "cors",
            headers: {
                "Content-Type" : "application/json"
            },
            body : JSON.stringify ({
                "for" : "connection",
                "action" : "READ",
                "object" : "Joueur",
                "params" : {email, pwdHash}
            })
        })
        // fera appel à un controlleur php. celui ci appellera les fonctions de création d'utilisateur, puis lis le 
        // nouveau record pour l'envoyer au front en JSON

        .then(rq => rq.text())
        
        .then(data => console.log(data)) // décode l'objet JSON et instancie un nouvel objet User JS. change les infos de l'instance statique de User

        .catch(error => console.error(error)) // en cas d'erreur, on créé une fenetre qui informe l'utilisateur
    }
}

Manager = new AuthManager(); // singleton pas encore respecté
Manager.connectExistingUser("test@gmail.com", "$2y$10$aDgMydsudCBz48nuAjslKu13sUj/cygPJ7LmQA5NGBW87d5kwWzuq");