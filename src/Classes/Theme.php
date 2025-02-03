<?php
    class Theme {
        private int $idTheme;
        private string $nomTheme;
        private int $prix;
        private string $imgChemin;

        function __construct(int $idTheme, string $nomTheme, int $prix, string $imgChemin) {
            $this->idTheme = $idTheme;
            $this->nomTheme = $nomTheme;
            $this->prix = $prix;
            $this->imgChemin = $imgChemin;
        }

        // Getters
        function getIdTheme(): int {
            return $this->idTheme;
        }

        function getNomTheme(): string {
            return $this->nomTheme;
        }

        function getPrix(): int {
            return $this->prix;
        }

        function getImgChemin(): string {
            return $this->imgChemin;
        }
    }
?>