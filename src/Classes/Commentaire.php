<?php
class Commentaire{
    private int $id;
    private int $idArticle;
    private int $nbAime;
    private String $contenu;
    
    function __construct(int $id, int $idArticle, int $nbAime, String $contenu) {
        $this->id = $id;
        $this->idArticle = $idArticle;
        $this->nbAime = $nbAime;
        $this->contenu = $contenu;
    
}

    function getId() : int {
        return $this->id;
    }
    
    function getIdArticle() : int {
        return $this->idArticle;
    }
    
    function getNbAime() : int {
        return $this->nbAime;
    }
    
    function getContenu() : String {
        return $this->contenu;
    }
}
?>