<?php
class ControllerGestion {
    private $gestion_manager;
    private $view;

    public function __construct($url) {
        if (isset($url) && count($url) > 3) {
            throw new Exeption('Page introuvable');
        }
        else {
            $this->gestion();
        }   
    }
    private function gestion() {
        require_once('Models/GestionManager.php');
        require_once('Views/view-gestion.php');
    }
}
?>