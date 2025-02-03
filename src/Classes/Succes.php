<?PHP
    /**
     * @author Nathan
     */
    class Succes {
        private int $idSucces;
        private string $nomSucces;
        private string $conditionSucces;
        private string $typeSucces;
    
        function __construct(int $idSucces, string $nomSucces, string $conditionSucces, string $typeSucces) {
            $this->idSucces = $idSucces;
            $this->nomSucces = $nomSucces;
            $this->conditionSucces = $conditionSucces;
            $this->typeSucces = $typeSucces;
        }
    
        // Getters
        function getIdSucces(): int {
            return $this->idSucces;
        }
    
        function getNomSucces(): string {
            return $this->nomSucces;
        }
    
        function getConditionSucces(): string {
            return $this->conditionSucces;
        }
    
        function getTypeSucces(): string {
            return $this->typeSucces;
        }
    }
?>