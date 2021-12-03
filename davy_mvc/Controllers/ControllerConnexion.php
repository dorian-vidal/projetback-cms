<?php
class ControllerConnexion {
    private $connexion_manager;
    private $view;

    public function __construct($url) {
        if (isset($url) && count($url) > 1) {
            throw new Exeption('Page introuvable');
        }
        else {
            $this->connexion();
        }   
    }
    private function connexion() {
        require_once('Models/ConnexionManager.php');
        require_once('Views/view-connexion.php');
    }
}
?>