class AuthManager { 
    
    static instance = null;
    name = "";

    constructor(name) {
        this.name = name;
    }

    static getInstance(name) {
        if (this.instance === null) {
            instance = new AuthManager(name);
        } else {
            return this.instance;
        }
    }

    connectExistingUser (id) {
        fetch("https://localhost/[Git]Douzhee/douzhee/src/Controllers/AuthController.php", {
            method : "POST",
            mode : "cors",
            headers: {
                "Content-Type" : "application/json"
            },
            body : JSON.stringify ({
                "from" : this.name,
                "action" : "READ",
                "object" : "JOUEUR",
                "params" : {id}
            })
        })
        // fera appel à un controlleur php. celui ci appellera les fonctions de création d'utilisateur, puis lis le 
        // nouveau record pour l'envoyer au front en JSON

        .then(receivedData => console.log(receivedData.text())) // décode l'objet JSON et instancie un nouvel objet User JS. change les infos de l'instance statique de User

        .catch(error => console.error(error)) // en cas d'erreur, on créé une fenetre qui informe l'utilisateur
    }
}

Manager = new AuthManager("myManager");
Manager.connectExistingUser(12);