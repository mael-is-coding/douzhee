<?php
    class AcheterMusique {
        private string $idJoueur;
        private int $idMusique;
    
        function __construct(string $idJoueur, int $idMusique) {
            $this->idJoueur = $idJoueur;
            $this->idMusique = $idMusique;
        }
    
        // Getters
        function getIdJoueur(): string {
            return $this->idJoueur;
        }
    
        function getIdMusique(): int {
            return $this->idMusique;
        }
    }
?>