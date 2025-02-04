function checkPlayers() {
    if (connectedPlayers == requiredPlayers) {
        window.location.href = './game.php';

        var formData = new FormData();
        formData.append('gameId', gameId);
        formData.append('testdesecurité', true);
        fetch('../Utils/launchGame.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
    }
}

// Rejoindre la salle de chat pour la partie spécifique
socket.emit('player joined', gameId);

socket.on('player joined', function(connectedPlayersCount) {
    document.getElementById('connected-players').innerText = connectedPlayersCount;
    connectedPlayers = connectedPlayersCount;
    checkPlayers();
});
