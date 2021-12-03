<?php
class ControllerAccueil {
    private $article_manager;
    private $view;

    public function __construct($url) {
        if (isset($url) && count($url) > 1) {
            throw new Exeption('Page introuvable');
        }
        else {
            $this->articles();
        }   
    }
    private function articles() {
        $this->article_manager = new ArticleManager;
        $articles = $this->article_manager->get_articles();

        require_once('Views/view-accueil.php');
    }
}
?>