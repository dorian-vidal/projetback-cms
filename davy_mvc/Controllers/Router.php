<?php
class Router {
    private $controller;
    private $view;

    public function route_request() {
        try {
            spl_autoload_register(function($class) {
                require_once('Models/' . $class . '.php');
            });

            $url = array();

            if (isset($_GET['url'])) {
                $url = explode('/', filter_var($_GET['url'], FILTER_SANITIZE_URL));
                $controller_url = ucfirst(strtolower($url[0]));
                $controller_class = "Controller" . $controller_url;
                $controller_file = "Controllers/" . $controller_class . ".php";

                if (file_exists($controller_file)) {
                    require_once($controller_file);
                    $this->controller = new $controller_class($url);
                }
                else {
                    throw new Exception('Page introuvable');
                }
            }
            else {
                require_once('Controllers/ControllerAccueil.php');
                $this->controller = new ControllerAccueil($url);
            }
        }
        catch(Exception $e) {
            $erreur_message = $e->getMessage();
            require_once('Views/view-erreur.php');
        }
    }
}
?>