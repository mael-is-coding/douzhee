<?php
class Article{
    private int $id;
    private String $contenu;

    private String $title;
    function __construct(int $id, String $contenu, String $title) {
        $this->id = $id;
        $this->contenu = $contenu;
        $this->title = $title;
    }
    function getId() : int {
        return $this->id;
    }
    function getContenu() : String {
        return $this->contenu;
    }
    function getTitle() : String {
        return $this->title;
    }
}
?>