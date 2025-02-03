<?php
    class AcheterTheme {
        private string $idJoueur;
        private int $idTheme;
    
        function __construct(string $idJoueur, int $idTheme) {
            $this->idJoueur = $idJoueur;
            $this->idTheme = $idTheme;
        }
    
        // Getters
        function getIdJoueur(): string {
            return $this->idJoueur;
        }
    
        function getIdTheme(): int {
            return $this->idTheme;
        }
    }
?>