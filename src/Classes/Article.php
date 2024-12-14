<?php
class Article{
    private int $id;
    private String $nom;
    private String $contenu;

    private String $title;
    function __construct(int $id, String $nom, String $contenu, String $title) {
        $this->id = $id;
        $this->nom = $nom;
        $this->contenu = $contenu;
        $this->title = $title;
    }
    function getId() : int {
        return $this->id;
    }
    function getNom() : String {
        return $this->nom;
    }
    function getContenu() : String {
        return $this->contenu;
    }
    function getTitle() : String {
        return $this->title;
    }
}
?>