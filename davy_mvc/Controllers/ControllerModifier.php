<?php
class ControllerModifier {
    private $modifier_manager;
    private $view;

    public function __construct($url) {
        if (isset($url) && count($url) > 3) {
            throw new Exeption('Page introuvable');
        }
        else {
            $this->modifier();
        }   
    }
    private function modifier() {
        require_once('Models/ModifierManager.php');
        require_once('Views/view-modifier.php');
    }
}
?>