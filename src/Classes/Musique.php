<?php
    class Musique {
        private int $idMusique;
        private string $nomMusique;
        private string|null $cheminMusique;
        private int $prix;
        private string $imgChemin;
    
        function __construct(int $idMusique, string $nomMusique, string|null $cheminMusique, int $prix, string $imgChemin) {
            $this->idMusique = $idMusique;
            $this->nomMusique = $nomMusique;
            $this->cheminMusique = $cheminMusique;
            $this->prix = $prix;
            $this->imgChemin = $imgChemin;
        }
    
        // Getters
        function getIdMusique(): int {
            return $this->idMusique;
        }
    
        function getNomMusique(): string {
            return $this->nomMusique;
        }
    
        function getCheminMusique(): string|null {
            return $this->cheminMusique;
        }
    
        function getPrix(): int {
            return $this->prix;
        }

        function getImgChemin(): string {
            return $this->imgChemin;
        }
    }
?>