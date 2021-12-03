<?php
class ControllerReinitialiser {
    private $reinitialiser_manager;
    private $view;

    public function __construct($url) {
        if (isset($url) && count($url) > 1) {
            throw new Exeption('Page introuvable');
        }
        else {
            $this->reinitialiser();
        }   
    }
    private function reinitialiser() {
        require_once('Models/ReinitialiserManager.php');
        require_once('Views/view-reinitialiser.php');
    }
}
?>