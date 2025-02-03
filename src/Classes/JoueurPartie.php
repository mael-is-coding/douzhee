<?php
    class JoueurPartie {
        private string $idJoueur;
        private string $idPartie;
        private int $positionPartie;
        private int $score;
        private bool $estGagant;
    
        function __construct(string $idJoueur, string $idPartie, int $positionPartie, int $score, bool $estGagant) {
            $this->idJoueur = $idJoueur;
            $this->idPartie = $idPartie;
            $this->positionPartie = $positionPartie;
            $this->score = $score;
            $this->estGagant = $estGagant;
        }
    
        // Getters
        function getIdJoueur(): string {
            return $this->idJoueur;
        }
    
        function getIdPartie(): string {
            return $this->idPartie;
        }
    
        function getPositionPartie(): int {
            return $this->positionPartie;
        }
    
        function getScore(): int {
            return $this->score;
        }
    
        function getEstGagant(): bool {
            return $this->estGagant;
        }
    }
?>