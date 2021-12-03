<?php
class ControllerVoir {
    private $voir_manager;
    private $view;

    public function __construct($url) {
        if (isset($url) && count($url) > 3) {
            throw new Exeption('Page introuvable');
        }
        else {
            $this->voir();
        }   
    }
    private function voir() {
        require_once('Models/VoirManager.php');
        require_once('Views/view-voir.php');
    }
}
?>