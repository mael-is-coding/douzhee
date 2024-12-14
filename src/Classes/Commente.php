<?php
class Commente{
    private int $idJoueur;
    private int $idCommentaire;
  
    function __construct(int $idJ, int $idC) {
        $this->idJoueur = $idJ;
        $this->idCommentaire = $idC;
    }
    
    function getIdJoueur() : int {
        return $this->idJoueur;
    }
    
    function getIdCommentaire() : int {
        return $this->idCommentaire;
    }
}
?>