<?php
class ArticleManager extends Model {
    public function get_articles() {
        $this->get_bdd();
        return $this->get_all('article', 'Article');
    }
}
?>