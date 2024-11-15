<?php
    require_once("../Utils/headerInit.php");
?>
    <link rel="stylesheet" href="../../assets/CSS/game.css">   
</head>
<body>
    <div class="lienPartie">
        <span class="lien">Lien:</span>
        <button class="copyLien"></button>
    </div>
    <div class="score">
        <table class="Upper">
            <thead>
                <tr>
                    <th class="head-score"></th>
                    <th class="head-joueur">J1</th>
                    <th class="head-joueur">J2</th>
                    <th class="head-joueur">J3</th>
                    <th class="head-joueur">J4</th>
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
                    <td class="col-joueur"><div class="case-score">55</div></td>
                    <td class="col-joueur"><div class="case-score"></div></td>
                    <td class="col-joueur"><div class="case-score"></div></td>
                    <td class="col-joueur"><div class="case-score"></div></td>
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
                    <td class="col-joueur"><div class="case-score"></div></td>
                    <td class="col-joueur"><div class="case-score"></div></td>
                    <td class="col-joueur"><div class="case-score"></div></td>
                    <td class="col-joueur"><div class="case-score"></div></td>
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
                    <td class="col-joueur"><div class="case-score"></div></td>
                    <td class="col-joueur"><div class="case-score"></div></td>
                    <td class="col-joueur"><div class="case-score"></div></td>
                    <td class="col-joueur"><div class="case-score"></div></td>
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
                    <td class="col-joueur"><div class="case-score"></div></td>
                    <td class="col-joueur"><div class="case-score"></div></td>
                    <td class="col-joueur"><div class="case-score"></div></td>
                    <td class="col-joueur"><div class="case-score"></div></td>
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
                    <td class="col-joueur"><div class="case-score"></div></td>
                    <td class="col-joueur"><div class="case-score"></div></td>
                    <td class="col-joueur"><div class="case-score"></div></td>
                    <td class="col-joueur"><div class="case-score"></div></td>
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
                    <td class="col-joueur"><div class="case-score"></div></td>
                    <td class="col-joueur"><div class="case-score"></div></td>
                    <td class="col-joueur"><div class="case-score"></div></td>
                    <td class="col-joueur"><div class="case-score"></div></td>
                </tr>
                <tr>
                    <td class="col-score">
                        <div class="tite-score-spé">
                                <p class="score-dé">Bonus</p>
                                <p class="info-score">35 points si Upper</p>
                                <p class="info-score">supérieur à 62</p>
                        </div>
                    </td>
                    <td class="col-joueur"><div class="case-score"></div></td>
                    <td class="col-joueur"><div class="case-score"></div></td>
                    <td class="col-joueur"><div class="case-score"></div></td>
                    <td class="col-joueur"><div class="case-score"></div></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th class="foot-score"><p>UPPER</p></th>
                    <th class="foot-joueur"></th>
                    <th class="foot-joueur"></th>
                    <th class="foot-joueur"></th>
                    <th class="foot-joueur"></th>
                </tr>
            </tfoot>
        </table>
        <table class="Lower">
            <thead>
                <tr>
                    <th class="head-score"></th>
                    <th class="head-joueur">J1</th>
                    <th class="head-joueur">J2</th>
                    <th class="head-joueur">J3</th>
                    <th class="head-joueur">J4</th>
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
                    <td class="col-joueur"><div class="case-score"></div></td>
                    <td class="col-joueur"><div class="case-score"></div></td>
                    <td class="col-joueur"><div class="case-score"></div></td>
                    <td class="col-joueur"><div class="case-score"></div></td>
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
                    <td class="col-joueur"><div class="case-score"></div></td>
                    <td class="col-joueur"><div class="case-score"></div></td>
                    <td class="col-joueur"><div class="case-score"></div></td>
                    <td class="col-joueur"><div class="case-score"></div></td>
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
                    <td class="col-joueur"><div class="case-score"></div></td>
                    <td class="col-joueur"><div class="case-score"></div></td>
                    <td class="col-joueur"><div class="case-score"></div></td>
                    <td class="col-joueur"><div class="case-score"></div></td>
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
                    <td class="col-joueur"><div class="case-score"></div></td>
                    <td class="col-joueur"><div class="case-score"></div></td>
                    <td class="col-joueur"><div class="case-score"></div></td>
                    <td class="col-joueur"><div class="case-score"></div></td>
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
                    <td class="col-joueur"><div class="case-score"></div></td>
                    <td class="col-joueur"><div class="case-score"></div></td>
                    <td class="col-joueur"><div class="case-score"></div></td>
                    <td class="col-joueur"><div class="case-score"></div></td>
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
                    <td class="col-joueur"><div class="case-score"></div></td>
                    <td class="col-joueur"><div class="case-score"></div></td>
                    <td class="col-joueur"><div class="case-score"></div></td>
                    <td class="col-joueur"><div class="case-score"></div></td>
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
                    <td class="col-joueur"><div class="case-score"></div></td>
                    <td class="col-joueur"><div class="case-score"></div></td>
                    <td class="col-joueur"><div class="case-score"></div></td>
                    <td class="col-joueur"><div class="case-score"></div></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th class="foot-score"><p>LOWER</p></th>
                    <th class="foot-joueur"></th>
                    <th class="foot-joueur"></th>
                    <th class="foot-joueur"></th>
                    <th class="foot-joueur"></th>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="dé-table">
        <div class="table">
            <div class="dé" id="dé1"></div>
            <div class="dé" id="dé2"></div>
            <div class="dé" id="dé3"></div>
            <div class="dé" id="dé4"></div>
            <div class="dé" id="dé5"></div>
        </div>
        <button class="roll"><p>Roll</p></button>
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
        var socket = io(); // Initialiser le socket client pour se connecter au serveur socket.io sur le même domaine 

        var gameid = prompt('Entrez l\'identifiant de la partie :'); // Demander à l'utilisateur de saisir l'identifiant de la partie

        // Rejoindre la salle de chat pour la partie spécifique
        socket.emit('join game', gameid);

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