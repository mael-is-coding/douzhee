<?php

/**
 * @author Mael
 * @contributors Cédric, Milan
 * @brief Modélise un joueur
 */
class Joueur {

    private string $idJoueur;
    private string $pseudo;
    private string $mdp;
    private int $douzCoins;
    private string $email;
    private string|null $bio;
    private string $dateInscription;
    private string $avatarChemin;
    private int $idMusique;
    private int $idTheme;
    private int $nbPartieGagnees;
    private int $scoreMax;
    private int|null $tempsJeu;
    private float $ratioVictoire;
    private int $nbSucces;
    private int $nbPartiesJouees;
    private int $nbDouzhee;

    function __construct(string $idJoueur, string $pseudo, string $mdp, int $douzCoins, string $email, string|null $bio, string $dateInscription, string $avatarChemin, int $idMusique, int $idTheme, int $nbPartieGagnees, int $scoreMax, int|null $tempsJeu, float $ratioVictoire, int $nbSucces, int $nbPartiesJouees, int $nbDouzhee) {
        $this->idJoueur = $idJoueur;
        $this->pseudo = $pseudo;
        $this->mdp = $mdp;
        $this->douzCoins = $douzCoins;
        $this->email = $email;
        $this->bio = $bio;
        $this->dateInscription = $dateInscription;
        $this->avatarChemin = $avatarChemin;
        $this->idMusique = $idMusique;
        $this->idTheme = $idTheme;
        $this->nbPartieGagnees = $nbPartieGagnees;
        $this->scoreMax = $scoreMax;
        $this->tempsJeu = $tempsJeu;
        $this->ratioVictoire = $ratioVictoire;
        $this->nbSucces = $nbSucces;
        $this->nbPartiesJouees = $nbPartiesJouees;
        $this->nbDouzhee = $nbDouzhee;
    }

    function getIdJoueur(): string {
        return $this->idJoueur;
    }

    function getPseudo(): string {
        return $this->pseudo;
    }

    function getMdp(): string {
        return $this->mdp;
    }

    function getDouzCoins(): int {
        return $this->douzCoins;
    }

    function getEmail(): string {
        return $this->email;
    }

    function getBio(): string|null {
        return $this->bio;
    }

    function getDateInscription(): string {
        return $this->dateInscription;
    }

    function getAvatarChemin(): string {
        return $this->avatarChemin;
    }

    function getIdMuisque(): int {
        return $this->idMusique;
    }

    function getIdTheme(): int {
        return $this->idTheme;
    }

    function getNbPartieGagnees(): int {
        return $this->nbPartieGagnees;
    }

    function getScoreMax(): int {
        return $this->scoreMax;
    }

    function getTempsJeu(): int|null {
        return $this->tempsJeu;
    }

    function getRatioVictoire(): float {
        return $this->ratioVictoire;
    }

    function getNbSucces(): int {
        return $this->nbSucces;
    }

    function getNbPartiesJouees(): int {
        return $this->nbPartiesJouees;
    }

    function getNbDouzhee(): int {
        return $this->nbDouzhee;
    }

    public function toArray(): array {
        return [
            'idJoueur' => $this->idJoueur,
            'pseudo' => $this->pseudo,
            'mdp' => $this->mdp,
            'douzCoins' => $this->douzCoins,
            'email' => $this->email,
            'bio' => $this->bio,
            'dateInscription' => $this->dateInscription,
            'avatarChemin' => $this->avatarChemin,
            'idMusique' => $this->idMusique,
            'idTheme' => $this->idTheme,
            'nbPartieGagnees' => $this->nbPartieGagnees,
            'scoreMax' => $this->scoreMax,
            'tempsJeu' => $this->tempsJeu,
            'ratioVictoire' => $this->ratioVictoire,
            'nbSucces' => $this->nbSucces,
            'nbPartiesJouees' => $this->nbPartiesJouees,
            'nbDouzhee' => $this->nbDouzhee
        ];
    }
}
?>