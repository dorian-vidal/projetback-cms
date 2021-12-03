<?php
class Article {
    private $id_article;
    private $titre;
    private $contenu;
    private $date;

    public function __construct(array $data) {
        $this->hydrate($data);
    }
    public function hydrate(array $data) {
        foreach ($data as $key => $value) {
            $method = 'set_' . $key;
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    // SETTERS
    public function set_id_article($id_article) {
        $id_article = (int) $id_article;

        if ($id_article > 0) {
            $this->id_article = $id_article;
        }
    }
    public function set_titre($titre) {
        if (is_string($titre)) {
            $this->titre = $titre;
        }
    }
    public function set_contenu($contenu) {
        if (is_string($contenu)) {
            $this->contenu = $contenu;
        }
    }
    public function set_date($date) {
        if (is_string($date)) {
            $this->date = $date;
        }
    }

    // GETTERS
    public function id_article() {
        return $this->id_article;
    }
    public function titre() {
        return $this->titre;
    }
    public function contenu() {
        return $this->contenu;
    }
    public function date() {
        return $this->date;
    }
}
?>