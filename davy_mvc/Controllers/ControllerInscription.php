<?php
class ControllerInscription {
    private $inscription_manager;
    private $view;

    public function __construct($url) {
        if (isset($url) && count($url) > 1) {
            throw new Exeption('Page introuvable');
        }
        else {
            $this->inscription();
        }   
    }
    private function inscription() {
        require_once('Models/InscriptionManager.php');
        require_once('Views/view-inscription.php');
    }
}
?>