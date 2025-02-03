<?php
    class SuccesJoueur {
        private string $idJoueur;
        private int $idSucces;
    
        function __construct(string $idJoueur, int $idSucces) {
            $this->idJoueur = $idJoueur;
            $this->idSucces = $idSucces;
        }
    
        // Getters
        function getIdJoueur(): string {
            return $this->idJoueur;
        }
    
        function getIdSucces(): int {
            return $this->idSucces;
        }
    }
?>