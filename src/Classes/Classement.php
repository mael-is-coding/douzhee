<?PHP
    /**
     * @author Nathan
     */
    Class Classement{
        private int $id;
        private int $placeClassement;
        private int $score;
        private String $pseudo;
    
        /**
         * @param int $id
         * @param int $placeClassement
         * @param int $score
         * @param string $pseudo
         */
        public function __construct(int $id, int $placeClassement, int $score, string $pseudo) {
            $this->id = $id;
            $this->placeClassement = $placeClassement;
            $this->score = $score;
            $this->pseudo = $pseudo;
        }

        /**
         * @return int
         */
        public function getId(): int {
            return $this->id;
        }
        
        /**
         * @param int $id 
         * @return self
         */
        public function setId(int $id): self {
            $this->id = $id;
            return $this;
        }

        /**
         * @return int
         */
        public function getPlaceClassement(): int {
            return $this->placeClassement;
        }
        
        /**
         * @param int $placeClassement 
         * @return self
         */
        public function setPlaceClassement(int $placeClassement): self {
            $this->placeClassement = $placeClassement;
            return $this;
        }

        /**
         * @return int
         */
        public function getScore(): int {
            return $this->score;
        }
        
        /**
         * @param int $score 
         * @return self
         */
        public function setScore(int $score): self {
            $this->score = $score;
            return $this;
        }

        /**
         * @return string
         */
        public function getPseudo(): string {
            return $this->pseudo;
        }
        
        /**
         * @param string $pseudo 
         * @return self
         */
        public function setPseudo(string $pseudo): self {
            $this->pseudo = $pseudo;
            return $this;
        }
}