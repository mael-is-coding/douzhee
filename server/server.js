const express = require('express'); // Importer le module Express.js
const http = require('http'); // Importer le module HTTP de Node.js
const socketIo = require('socket.io'); // Importer le module Socket.IO
const path = require('path'); // Importer le module Path de Node.js

const app = express(); // Créer une application Express
const server = http.createServer(app); // Créer un serveur HTTP en utilisant l'application Express
const io = socketIo(server); // Créer un serveur Socket.IO en utilisant le serveur HTTP

app.use(express.static(path.join(__dirname))); // Servir les fichiers statiques dans le dossier public 

// Afficher le fichier index.html lorsqu'un client accède à la racine du serveur
app.get('/', (req, res) => {
    res.sendFile(__dirname + '/index.html');
});

// Afficher le fichier game.php lorsqu'un client accède à /game.php
app.get('/game.php', (req, res) => { 
    res.sendFile(__dirname + '/game.php'); // Envoi du fichier game.php
    res.send('game.php'); // Envoi du texte game.php
});

// Événements Socket.IO
io.on('connection', (socket) => {
    // Gestion de la connexion d'un client
    console.log('a user connected');

    // Gestion de la déconnexion d'un client
    socket.on('disconnect', () => { 
        console.log('user disconnected');
    });

    // Gestion des messages de chat pour index.html
    socket.on('chat message index', (msg) => {
        io.emit('chat message index', msg); // Diffuser le message à tous les clients pour index.html
    });

    // Rejoindre une salle spécifique pour une partie
    socket.on('join game', (gameId) => {
        socket.join(gameId);
        console.log(`User joined game: ${gameId}`);
    });

    // Gestion des messages de chat pour une partie spécifique
    socket.on('chat message game', (data) => {
        io.to(data.gameid).emit('chat message game', data.message); // Diffuser le message à tous les clients dans la salle spécifique
    });
});

// Écouter sur le port 8080
server.listen(8080, () => {
    console.log('listening on *:8080');
});