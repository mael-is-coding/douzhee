<?php
class Creer{
    private int $idJoueur;
    private int $idArticle;

    function __construct(int $idJ, int $idA) {
        $this->idJoueur = $idJ;
        $this->idArticle = $idA;
    }
    function getIdJoueur() : int {
        return $this->idJoueur;
    }
    function getIdArticle() : int {
        return $this->idArticle;
    }

}
?>