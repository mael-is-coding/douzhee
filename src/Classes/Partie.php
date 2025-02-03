<?PHP
    /**
     * @author Nathan
     */
    class Partie {
    private string $idPartie;
    private string $datePartie;
    private string $statut;
    private int $scoreTotalPartie;
    private int $nbJoueur;

    function __construct(string $idPartie, string $datePartie, string $statut, int $scoreTotalPartie, int $nbJoueur) {
        $this->idPartie = $idPartie;
        $this->datePartie = $datePartie;
        $this->statut = $statut;
        $this->scoreTotalPartie = $scoreTotalPartie;
        $this->nbJoueur = $nbJoueur;
    }

    // Getters
    function getIdPartie(): string {
        return $this->idPartie;
    }

    function getDatePartie(): string {
        return $this->datePartie;
    }

    function getStatut(): string {
        return $this->statut;
    }

    function getScoreTotalPartie(): int {
        return $this->scoreTotalPartie;
    }

    function getNbJoueur(): int {
        return $this->nbJoueur;
    }
}
?>