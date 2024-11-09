<?PHP
    /**
     * @author Nathan
     */
    Class Consulte{
        private int $idStats;
        private int $idUser;
    
        /**
         * @param int $idStats
         * @param int $idUser
         */
        public function __construct(int $idStats, int $idUser) {
            $this->idStats = $idStats;
            $this->idUser = $idUser;
        }

        /**
         * @return int
         */
        public function getIdStats(): int {
            return $this->idStats;
        }
        
        /**
         * @param int $idStats 
         * @return self
         */
        public function setIdStats(int $idStats): self {
            $this->idStats = $idStats;
            return $this;
        }

        /**
         * @return int
         */
        public function getIdUser(): int {
            return $this->idUser;
        }
        
        /**
         * @param int $idUser 
         * @return self
         */
        public function setIdUser(int $idUser): self {
            $this->idUser = $idUser;
            return $this;
        }
}