<?php
    require_once("../Utils/headerInit.php");
    require_once("../CRUD/CRUDJoueur.php");
    require_once("../CRUD/CRUDPartie.php");
    require_once("../CRUD/CRUDJouerPartie.php");
    require_once("../Utils/connectionSingleton.php");
?>
    <link rel="stylesheet" href="../../assets/CSS/game.css">   
</head>
<body>
    <?php
        // Nombre de joueurs requis pour commencer la partie
        $requiredPlayers = readPartieById($_SESSION['idPartie'])->getNbJoueurs();

        // Fonction pour vérifier le nombre de joueurs connectés
        // A METTRE DANS LE CRUDJouerPartie.php
        function readConnectedPlayers() {
            $pdo = ConnexionSingleton::getInstance();
            $query = $pdo->prepare("SELECT COUNT(*) FROM JouerPartie WHERE idPartieJouee  = :idPartie");
            $query->execute(['idPartie' => $_SESSION['idPartie']]);
            return $query->fetchColumn();
        }

        $connectedPlayers = readConnectedPlayers();
        //debugSession();
    ?>
    <div class="waiting-room">
        <h1>En attente des autres joueurs...</h1>
        <p>Nombre de joueurs connectés: <span id="connected-players"><?php echo $connectedPlayers; ?></span> / <?php echo $requiredPlayers; ?></p>
        <br>
        <h3>
            <p>Lien de la partie:</p> 
            <?php echo $_SESSION['lienPartie']; ?>
        </h2>
        <p>Veuillez patienter pendant que les autres joueurs rejoignent la partie.</p>
    </div>
    <div class="score">
        <table class="Upper">
            <thead>
                <tr>
                    <th class="head-score"></th>
                    <?PHP foreach (range(1, $requiredPlayers) as $value): ?>
                        <th class="head-joueur">J<?PHP echo $value ?></th>
                    <?PHP endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="col-score">
                        <div class="rect-score">
                            <img src="./img/de1.png" alt="icon">
                            <div class="tite-score">
                                <p class="score-dé">Un</p>
                                <p class="info-score">Somme des 1</p>
                            </div>
                        </div>
                    </td>
                    <?PHP foreach (range(1, $requiredPlayers) as $value): ?>
                        <td class="col-joueur"><input type="button" placeholder="" class="combinaison"></td>
                    <?PHP endforeach; ?>
                </tr>
                <tr>
                    <td class="col-score">
                        <div class="rect-score">
                            <img src="./img/de2.png" alt="icon">
                            <div class="tite-score">
                                <p class="score-dé">Deux</p>
                                <p class="info-score">Somme des 2</p>
                            </div>
                        </div>
                    </td>
                    <?PHP foreach (range(1, $requiredPlayers) as $value): ?>
                        <td class="col-joueur"><input type="button" placeholder="" class="combinaison"></td>
                    <?PHP endforeach; ?>
                </tr>
                <tr>
                    <td class="col-score">
                        <div class="rect-score">
                            <img src="./img/de3.png" alt="icon">
                            <div class="tite-score">
                                <p class="score-dé">Trois</p>
                                <p class="info-score">Somme des 3</p>
                            </div>
                        </div>
                    </td>
                    <?PHP foreach (range(1, $requiredPlayers) as $value): ?>
                        <td class="col-joueur"><input type="button" placeholder="" class="combinaison"></td>
                    <?PHP endforeach; ?>
                </tr>
                <tr>
                    <td class="col-score">
                        <div class="rect-score">
                            <img src="./img/de4.png" alt="icon">
                            <div class="tite-score">
                                <p class="score-dé">Quatre</p>
                                <p class="info-score">Somme des 4</p>
                            </div>
                        </div>
                    </td>
                    <?PHP foreach (range(1, $requiredPlayers) as $value): ?>
                        <td class="col-joueur"><input type="button" placeholder="" class="combinaison"></td>
                    <?PHP endforeach; ?>
                </tr>
                <tr>
                    <td class="col-score">
                        <div class="rect-score">
                            <img src="./img/de5.png" alt="icon">
                            <div class="tite-score">
                                <p class="score-dé">Cinq</p>
                                <p class="info-score">Somme des 5</p>
                            </div>
                        </div>
                    </td>
                    <?PHP foreach (range(1, $requiredPlayers) as $value): ?>
                        <td class="col-joueur"><input type="button" placeholder="" class="combinaison"></td>
                    <?PHP endforeach; ?>
                </tr>
                <tr>
                    <td class="col-score">
                        <div class="rect-score">
                            <img src="./img/de6.png" alt="icon">
                            <div class="tite-score">
                                <p class="score-dé">Six</p>
                                <p class="info-score">Somme des 6</p>
                            </div>
                        </div>
                    </td>
                    <?PHP foreach (range(1, $requiredPlayers) as $value): ?>
                        <td class="col-joueur"><input type="button" placeholder="" class="combinaison"></td>
                    <?PHP endforeach; ?>
                </tr>
                <tr>
                    <td class="col-score">
                        <div class="tite-score-spé">
                                <p class="score-dé">Bonus</p>
                                <p class="info-score">35 points si Upper</p>
                                <p class="info-score">supérieur à 62</p>
                        </div>
                    </td>
                    <?PHP foreach (range(1, $requiredPlayers) as $value): ?>
                        <td class="col-joueur"><input type="button" placeholder="" class="bonus"></td>
                    <?PHP endforeach; ?>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th class="foot-score"><p>UPPER</p></th>
                    <?PHP foreach (range(1, $requiredPlayers) as $value): ?>
                        <th class="foot-joueur"></th>
                    <?PHP endforeach; ?>
                </tr>
            </tfoot>
        </table>
        <table class="Lower">
            <thead>
                <tr>
                    <th class="head-score"></th>
                    <?PHP foreach (range(1, $requiredPlayers) as $value): ?>
                        <th class="head-joueur">J<?PHP echo $value+1 ?></th>
                    <?PHP endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="col-score">
                        <div class="rect-score">
                            <div clas="img-dé">
                                <img src="./img/de3X.png" alt="icon">
                            </div>
                            <div class="tite-score">
                                <p class="score-dé">Brelan</p>
                                <p class="info-score">Somme des dés</p>
                            </div>
                        </div>
                    </td>
                    <?PHP foreach (range(1, $requiredPlayers) as $value): ?>
                        <td class="col-joueur"><input type="button" placeholder="" class="combinaison"></td>
                    <?PHP endforeach; ?>
                </tr>
                <tr>
                    <td class="col-score">
                        <div class="rect-score">
                            <img src="./img/de4X.png" alt="icon">
                            <div class="tite-score">
                                <p class="score-dé">Carré</p>
                                <p class="info-score">Somme des dés</p>
                            </div>
                        </div>
                    </td>
                    <?PHP foreach (range(1, $requiredPlayers) as $value): ?>
                        <td class="col-joueur"><input type="button" placeholder="" class="combinaison"></td>
                    <?PHP endforeach; ?>
                </tr>
                <tr>
                    <td class="col-score">
                        <div class="rect-score">
                            <img src="./img/deFH.png" alt="icon">
                            <div class="tite-score">
                                <p class="score-dé">Full</p>
                                <p class="info-score">25 points</p>
                            </div>
                        </div>
                    </td>
                    <?PHP foreach (range(1, $requiredPlayers) as $value): ?>
                        <td class="col-joueur"><input type="button" placeholder="" class="combinaison"></td>
                    <?PHP endforeach; ?>
                </tr>
                <tr>
                    <td class="col-score">
                        <div class="rect-score">
                            <img src="./img/deSM.png" alt="icon">
                            <div class="tite-score">
                                <p class="score-dé" id="gt1">Petite suite</p>
                                <p class="info-score">30 points</p>
                            </div>
                        </div>
                    </td>
                    <?PHP foreach (range(1, $requiredPlayers) as $value): ?>
                        <td class="col-joueur"><input type="button" placeholder="" class="combinaison"></td>
                    <?PHP endforeach; ?>
                </tr>
                <tr>
                    <td class="col-score">
                        <div class="rect-score">
                            <img src="./img/deLG.png" alt="icon">
                            <div class="tite-score">
                                <p class="score-dé" id="gt2">Grande suite</p>
                                <p class="info-score">40 points</p>
                            </div>
                        </div>
                    </td>
                    <?PHP foreach (range(1, $requiredPlayers) as $value): ?>
                        <td class="col-joueur"><input type="button" placeholder="" class="combinaison"></td>
                    <?PHP endforeach; ?>
                </tr>
                <tr>
                    <td class="col-score">
                        <div class="rect-score">
                            <img src="./img/de5X.png" alt="icon">
                            <div class="tite-score">
                                <p class="score-dé">Douzhee</p>
                                <p class="info-score" id="gt3">50 points (25/extra)</p>
                            </div>
                        </div>
                    </td>
                    <?PHP foreach (range(1, $requiredPlayers) as $value): ?>
                        <td class="col-joueur"><input type="button" placeholder="" class="combinaison"></td>
                    <?PHP endforeach; ?>
                </tr>
                <tr>
                    <td class="col-score">
                        <div class="rect-score">
                            <img src="./img/deCH.png" alt="icon">
                            <div class="tite-score">
                                <p class="score-dé">Chance</p>
                                <p class="info-score">Somme des dés</p>
                            </div>
                        </div>
                    </td>
                    <?PHP foreach (range(1, $requiredPlayers) as $value): ?>
                        <td class="col-joueur"><input type="button" placeholder="" class="combinaison"></td>
                    <?PHP endforeach; ?>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th class="foot-score"><p>LOWER</p></th>
                    <?PHP foreach (range(1, $requiredPlayers) as $value): ?>
                        <th class="foot-joueur"></t>
                    <?PHP endforeach; ?>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="dé-table">
        <div class="table">
            <div class="des libre" id="dé1"></div>
            <div class="des libre" id="dé2"></div>
            <div class="des libre" id="dé3"></div>
            <div class="des libre" id="dé4"></div>
            <div class="des libre" id="dé5"></div>
        </div>
        <button id="roll"><p>Roll</p></button>
    </div>

    <div class="versus">
        <div class="ligne1">
            <div class="joueur-avatar">
            <div class="img-joueur"><img src="./img/pdp.png" alt="icon"></div>
                <p class="joueur-nom">Joueur 1</p>
            </div>
            <div class="joueur-avatar">
            <div class="img-joueur"><img src="./img/pdp.png" alt="icon"></div>
                <p class="joueur-nom">Joueur 2</p>
            </div>
        </div>

        <span class="ligne2">VS</span>

        <div class="ligne3">
            <div class="joueur-avatar">
                <div class="img-joueur"><img src="./img/pdp.png" alt="icon"></div>
                <p class="joueur-nom">Joueur 3</p>
            </div>
            <div class="joueur-avatar">
            <div class="img-joueur"><img src="./img/pdp.png" alt="icon"></div>
                <p class="joueur-nom">Joueur 4</p>
            </div>
        </div>
    </div>

    <div class="chat-container">
        <div class="chat-messages" id="chat-messages"></div>
        <div class="chat-input">
            <input type="text" id="chat-input" placeholder="Tapez votre message..." />
            <button onclick="sendMessage()">Envoyer</button>
        </div>
    </div>
    <button class="chat-toggle" onclick="toggleChat()">💬</button>
    
    <script src="https://cdn.socket.io/4.5.4/socket.io.min.js"></script>

    <script>

        var requiredPlayers = <?= $requiredPlayers; ?>;
        var connectedPlayers = <?= $connectedPlayers; ?>;

        // Fonction pour vérifier le nombre de joueurs connectés et afficher/masquer les éléments en conséquence
        function checkPlayers() {
            if (connectedPlayers < requiredPlayers) {
                document.querySelector('.waiting-room').style.display = 'flex';
                document.querySelector('.score').style.display = 'none';
                document.querySelector('.dé-table').style.display = 'none';
                document.querySelector('.versus').style.display = 'none';
                document.querySelector('.chat-container').style.display = 'none';
                document.querySelector('.chat-toggle').style.display = 'none';
            } else {
                document.querySelector('.waiting-room').style.display = 'none';
                document.querySelector('.score').style.display = 'flex';
                document.querySelector('.dé-table').style.display = 'flex';
                document.querySelector('.versus').style.display = 'flex';
                document.querySelector('.chat-container').style.display = 'flex';
                document.querySelector('.chat-toggle').style.display = 'flex';
            }
        }

        // Appeler la fonction au chargement de la page
        window.onload = checkPlayers;

        var socket = io('http://localhost:8080'); // Initialiser le socket client pour se connecter au serveur socket.io sur le même domaine 
        // var socket = io('https://douzhee.fr'); // Sur le VPS

        var gameid = <?= $_SESSION['idPartie']; ?>; // Récupérer l'ID de la partie
        // Rejoindre la salle de chat pour la partie spécifique
        socket.emit('player joined', gameid);

        socket.on('player joined', function(connectedPlayersCount) {
            console.log('Player joined game: ' + connectedPlayersCount);
            document.getElementById('connected-players').innerText = connectedPlayersCount;
            connectedPlayers = connectedPlayersCount;
            checkPlayers();
        });

        socket.on('player disconnected', function(connectedPlayersCount) {
            console.log('Player disconnected from game: ' + gameid);
            document.getElementById('connected-players').innerText = connectedPlayersCount;
            connectedPlayers = connectedPlayersCount;
            checkPlayers();
        });

        // Fonction pour envoyer un message
        function sendMessage() {
            var input = document.getElementById('chat-input'); // Récupérer l'input
            var message = input.value; // Récupérer la valeur de l'input
            input.value = ''; // Réinitialiser l'input
            socket.emit('chat message game', { gameid: gameid, message: message }); // Émettre le message
        }

        socket.on('chat message game', function(msg) {
            var messages = document.getElementById('chat-messages'); // Récupérer les messages
            var messageElement = document.createElement('p'); // Créer un élément div
            messageElement.textContent = msg; // Ajouter le message reçu à l'élément div
            messages.appendChild(messageElement); // Ajouter le message à la liste des messages
            messages.scrollTop = messages.scrollHeight; // Faire défiler vers le bas pour afficher le dernier message
        });

        function toggleChat() {
            var chatContainer = document.querySelector('.chat-container'); // Récupérer le conteneur du chat
            chatContainer.classList.toggle('active'); // Ajouter ou supprimer la classe active pour afficher ou masquer le chat
        }
    </script>
</body>
</html>