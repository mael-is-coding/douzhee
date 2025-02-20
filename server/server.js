const express = require('express'); // Importer le module Express.js
const http = require('http'); // Importer le module HTTP de Node.js
const socketIo = require('socket.io'); // Importer le module Socket.IO
const path = require('path'); // Importer le module Path de Node.js
const cors = require('cors'); // Importer le module CORS

const { GameDataManager } = require('../assets/JS/Classes/GameDataManager');

const app = express(); // Créer une application Express
const server = http.createServer(app); // Créer un serveur HTTP en utilisant l'application Express
const io = socketIo(server, {
    cors: {
        origin: "http://localhost", // Autoriser les requêtes depuis http://localhost
        methods: ["GET", "POST"]
    }
}); // Créer un serveur Socket.IO en utilisant le serveur HTTP
app.use(cors()); // Utiliser le middleware CORS

/* a changer sur le VPS :
const express = require('express'); // Importer le module Express.js
const https = require('https'); // Importer le module HTTPS de Node.js
const fs = require('fs'); // Importer le module File System de Node.js
const socketIo = require('socket.io'); // Importer le module Socket.IO
const path = require('path'); // Importer le module Path de Node.js
const cors = require('cors'); // Importer le module CORS

const app = express(); // Créer une application Express

// Charger les certificats SSL
const options = {
    key: fs.readFileSync('/path/to/your/privkey.pem'),
    cert: fs.readFileSync('/path/to/your/fullchain.pem')
};

const server = https.createServer(options, app); // Créer un serveur HTTPS en utilisant l'application Express
const io = socketIo(server, {
    cors: {
        origin: "https://douzhee.fr", // Autoriser les requêtes depuis https://douzhee.fr
        methods: ["GET", "POST"]
    }
}); // Créer un serveur Socket.IO en utilisant le serveur HTTPS */

app.use(express.static(path.join(__dirname))); // Servir les fichiers statiques dans le dossier public 

// Afficher le fichier index.html lorsqu'un client accède à la racine du serveur
app.get('/', (req, res) => {
    res.sendFile(__dirname + '/index.html');
});

// Afficher le fichier game.php lorsqu'un client accède à /game.php
app.get('/game.php', (req, res) => { 
    res.sendFile(__dirname + '../src/Pages/game.php'); // Envoi du fichier game.php
});

/*

FONCTIONS LIEES A REDIS !!!

const redis = require('redis');

const client = redis.createClient({
    url: 'redis://127.0.0.1:6379',
});
client.connect()
    .then(() => console.log('Connected to Redis'))
    .catch((err) => console.error('Redis connection error:', err));

app.post('/start-game', async (req, res) => {
    const { gameId, playerId, position } = req.body;

    // Vérification des données
    if (!gameId || !playerId) {
        return res.status(400).send('Données invalides.');
    }

    try {
        // Vérifie si le joueur est déjà dans la partie
        const playerKey = `game:${gameId}:player:${playerId}`;
        const playerExists = await client.exists(playerKey);

        if (playerExists) {
            return res.status(200).json({ message: `Joueur ${playerId} déjà enregistré dans la partie ${gameId}.` });
        }

        // Si ce n'est pas le cas, l'ajoute à la partie
        await client.hSet(playerKey, {
            listeDes: [],
            listeDesGardes: [],
            listePointsCombi: [],
            listePointsObt: [],
            scoreSecSup: 0,
            scoreSecInf: 0,
            scoreTot: 0,
            nbRoll: 0,
            nbDouzhee: 0,
            position: position
        });

        // Incrémenter le compteur des joueurs pour cette partie
        await client.incr(`game:${gameId}:playerCount`);

        // Confirme l'ajout au joueur
        res.status(200).json({ message: `Joueur ${playerId} ajouté à la partie ${gameId}.` });
    } catch (err) {
        console.error(err);
        res.status(500).send('Erreur lors de l’initialisation de la partie.');
    }
});

app.get('/get-player-data', (req, res) => {
    const { gameId, playerId } = req.query; // Exemple: ?gameId=123&playerId=1

    if(!gameId || !playerId){
        return res.status(400).send('ID de la partie et du joueur requis.');
    }

    const key = `game:${gameId}:player:${playerId}`;

    client.hGetAll(key, (err, data) => {
        if (err || !data) {
            return res.status(404).send('Données non trouvées.');
        }
        res.json(data);
    });
});

app.get('/get-player-info', async (req, res) => {
    console.log("Route /get-player-info atteinte avec les paramètres :", req.query);
    const { gameId, playerId, info } = req.query;

    if(!gameId || !playerId){
        return res.status(400).send('ID de la partie et du joueur requis.');
    }

    try{
        const infoRecherchee = await client.get(`gameId:${gameId}:player:${playerId}:${info}`);

        res.status(200).json({gameId, infoRecherchee: infoRecherchee});
    } catch(err){
        console.error(err);
        res.status(500).send('Erreur lors de la récupération des infos du joueur.');
    }
});

app.get('/game-player-count', async (req, res) => {
    const { gameId } = req.query;

    if (!gameId) {
        return res.status(400).send('ID de la partie requis.');
    }

    try {
        // Récupère le compteur des joueurs
        const playerCount = await client.get(`game:${gameId}:playerCount`);

        res.status(200).json({ gameId, playerCount: parseInt(playerCount || 0, 10) });
    } catch (err) {
        console.error(err);
        res.status(500).send('Erreur lors de la récupération du nombre de joueurs.');
    }
});

app.post('/update-player', async (req, res) => {
    const { gameId, playerId, action } = req.query; // Exemple: { gameId: 123, playerId: 1, action: { score: 10, position: { x: 1, y: 1 } } }
    const key = `game:${gameId}:player:${playerId}`;

    // Mettre à jour les données spécifiques
    if (action.scoreSecSup) {
        client.hIncrBy(key, 'scoreSecSup', action.scoreSecSup); // Incrémente le score de la section supérieure
        client.hIncrBy(key, 'scoreTot', action.scoreSecSup); // Incrémente le score total
    }

    if (action.scoreSecInf) {
        client.hIncrBy(key, 'scoreSecInf', action.scoreSecInf); // Incrémente le score de la section inférieure
        client.hIncrBy(key, 'scoreTot', action.scoreSecInf); // Incrémente le score total
    }

    if (action.setNbRoll) {
        client.hSet(key, 'nbRoll', action.setNbRoll); // met le nombre de roll du joueur à action.setNbRoll
    }

    if(action.decrementRoll){
        client.hIncrBy(key, 'nbRoll', -1); // Décrémente le nombre de roll du joueur
    }

    if(action.listeDesGardes){
        await client.hSet(key, 'listeDesGardes', action.listeDesGardes);
    }

    if(action.listeDes){
        const listeDesGardes = client.get(`game:${gameId}:player:${playerId}:listeDesGardes`);
        let listeDes = [...listeDesGardes];
            
        while (listeDes.length < 5) {
            const de = new Dice();
            listeDes.push(de.getFace());
        }
        client.hSet(key, 'listeDes', listeDes); //change la liste des dés du joueur
    }

    res.send('Données du joueur mises à jour !');
});

app.post('/end-game', (req, res) => {
    const { gameId } = req.body; // Exemple: { gameId: 123 }
    client.keys(`game:${gameId}:player:*`, (err, keys) => {
        if (err || !keys.length) {
            return res.status(404).send('Aucune donnée à supprimer.');
        }
        client.del(keys, () => {
            res.send('Données de la partie supprimées.');
        });
    });
});

*/

// Suivre les connexions des joueurs
const connectedPlayers = {};

// Événements Socket.IO
io.on('connection', (socket) => {
    // Gestion de la connexion d'un client
    console.log('a user connected');

    socket.on('test', (data) => {
        console.log('test event received');
        io.to(data.gameId).emit('test');
    });

    socket.on('inputValue', (data) => {
        io.to(data.gameId).emit('inputValue', data);
    });

    // Gestion de la déconnexion d'un client
    socket.on('disconnect', () => { 
        console.log('user disconnected to the server');

        // Retirer le joueur de la liste des joueurs connectés
        for (let gameId in connectedPlayers) {  // Parcourir toutes les salles de jeu
            let index = connectedPlayers[gameId].indexOf(socket.id);  // Trouver l'index du joueur dans la liste des joueurs connectés
            if (index !== -1) { // Si le joueur est trouvé
                console.log(`Removing socket.id: ${socket.id} from gameId: ${gameId}`);
                console.log('Before removal:', connectedPlayers[gameId]);
                connectedPlayers[gameId].splice(index, 1); // Retirer le joueur de la liste des joueurs connectés
                console.log('After removal:', connectedPlayers[gameId]);
                console.log(connectedPlayers[gameId].length);
                io.to(gameId).emit('player disconnected', connectedPlayers[gameId].length); // Notifier les autres clients dans la salle que le nombre de joueurs a changé
                break;
            }
        }
    });

    // Gestion des messages de chat pour index.html
    socket.on('chat message index', (msg) => {
        io.emit('chat message index', msg); // Diffuser le message à tous les clients pour index.html
    });

    socket.on('player joined', (gameId) => {
        socket.join(gameId);
        console.log(`User joined game: ${gameId}`);

        // Ajouter le joueur à la liste des joueurs connectés
        if (!connectedPlayers[gameId]) {
            connectedPlayers[gameId] = [];
        }
        connectedPlayers[gameId].push(socket.id); // Ajouter le joueur à la liste des joueurs connectés
        console.log(`Added socket.id: ${socket.id} to gameId: ${gameId}`);
        console.log(connectedPlayers[gameId]);

        // Notifier les autres clients dans la salle que le nombre de joueurs a changé
        io.to(gameId).emit('player joined', connectedPlayers[gameId].length);
    });

    // Gestion des messages de chat pour une partie spécifique
    socket.on('chat message game', (data) => {
        console.log(`Message received for game ${data.gameId} de ${data.userName}: ${data.message}`);
        io.to(data.gameId).emit('chat message game', data); // Diffuser le message à tous les clients dans la salle spécifique
    });

    //Permet d'envoyer les dés d'un joueur à tous les autres joueurs
    socket.on('afficheDes', (data) => {
        io.to(data.gameId).emit('afficheDes', data);
    });

    //Permet de calculer toutes les combinaisons d'un lancer de dés et d'envoyer le résultat à tous les joueurs
    socket.on('calculCombinaisons', (data) => {
        let pointsCombi = [];
        if(!data.reset){
            pointsCombi = GameDataManager.checkCombinaisons(data.listeDes);
        }

        const results = {
            pointsCombinaisons: pointsCombi,
            playerId: data.playerId,
            position: data.position,
            reset: data.reset
        }

        io.to(data.gameId).emit('affichePointsCombinaisons', results);
    });

    //Permet d'indiquer à tous les joueurs qu'un joueur à reload sa page (permet la récupération des données pour ce joueur)
    socket.on('reloadPage', (data) => {
        io.to(data.gameId).emit('reloadPage', data.playerId);
    });

    //Permet de transmettre ses combinaisons validées ou non à tous les joueurs
    socket.on('transmitionPoints', (data) => {
        io.to(data.gameId).emit('transmitionPoints', data);
    });

    //Permet de transmettre ses dés à tous les joueurs
    socket.on('transmitionDes', (data) => {
        io.to(data.gameId).emit('transmitionDes', data);
    });

    //Permet de transmettre son score de la section inférieure et supérieure
    socket.on('transmitionScore', (data) => {
        io.to(data.gameId).emit('transmitionScore', data);
    });

    //Permet de faire afficher ses scores pour tous les joueurs
    socket.on('affichageScore', (data) => {
        io.to(data.gameId).emit('affichageScore', data);
    });

    //Permet de mettre fin à son tour et de lancer le tour du joueur suivant
    socket.on('finDeTour', (data) => {
        let positionNvJoueur = data.position + 1;
        if(positionNvJoueur > data.nbJoueurs){
            positionNvJoueur = 1;
        }
        io.to(data.gameId).emit('debutNvTour', positionNvJoueur);
    });

    //Permet d'annoncer la fin de la partie à tous les joueurs
    socket.on('finDePartie', (data) => {
        io.to(data.gameId).emit('finDePartie');
    });

    //Permet de transmettre son score total à tous les joueurs
    socket.on('transmitionScoreTot', (data) => {
        io.to(data.gameId).emit('transmitionScoreTot', data);
    });
});

// Écouter sur le port 8080
server.listen(8080, () => {
    console.log('listening on *:8080');
});