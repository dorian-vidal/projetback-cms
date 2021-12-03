<?php
class ControllerAjouter {
    private $ajouter_manager;
    private $view;

    public function __construct($url) {
        if (isset($url) && count($url) > 3) {
            throw new Exeption('Page introuvable');
        }
        else {
            $this->ajouter();
        }   
    }
    private function ajouter() {
        require_once('Models/AjouterManager.php');
        require_once('Views/view-ajouter.php');
    }
}
?>