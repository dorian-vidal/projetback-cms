<?php
require_once("init.php");
require_once("fonctions.php");

// Inscription
$notification = "";
$erreur = "";
$erreur_email = "";
$erreur_mdp = "";
$erreur_mdp_confirm = "";

if (isset($_POST['inscription'])) {
    // Champs rempli
    if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['mdp']) && !empty($_POST['mdp_confirm'])) {
        // Email format
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            // Email double
            $pdo_statement = $pdo_object->prepare("SELECT * FROM membre WHERE email = :email");
            $pdo_statement->bindValue(':email', htmlspecialchars($_POST['email']), PDO::PARAM_STR);
            $pdo_statement->execute();
            $membre_array = $pdo_statement->fetch(PDO::FETCH_ASSOC);
            if (empty($membre_array)) {
                // Mdp longueur + Majuscule + Minuscule + Chiffre + Caractère spécial
                if (strlen($_POST['mdp']) >= 8 && strtolower($_POST['mdp']) != $_POST['mdp'] && strtoupper($_POST['mdp']) != $_POST['mdp'] && preg_match('!\d+!', $_POST['mdp']) && preg_replace('/[^0-9a-zA-Z]/', '', $_POST['mdp']) != $_POST['mdp']) {
                    // Mdp confirmation
                    if ($_POST['mdp'] === $_POST['mdp_confirm']) {
                        // Enregister
                        $pdo_statement = $pdo_object->prepare("INSERT INTO membre (nom, prenom, email, mdp, statut, limit_connexion, limit_date) VALUES (:nom, :prenom, :email, :mdp, :statut, :limit_connexion, :limit_date)");
                        $pdo_statement->bindValue(':nom', htmlspecialchars($_POST['nom']), PDO::PARAM_STR);
                        $pdo_statement->bindValue(':prenom', htmlspecialchars($_POST['prenom']), PDO::PARAM_STR);
                        $pdo_statement->bindValue(':email', htmlspecialchars($_POST['email']), PDO::PARAM_STR);
                        $pdo_statement->bindValue(':mdp', password_hash($_POST['mdp'], PASSWORD_DEFAULT), PDO::PARAM_STR);
                        $pdo_statement->bindValue(':statut', 1, PDO::PARAM_INT);
                        $pdo_statement->bindValue(':limit_connexion', 0, PDO::PARAM_INT);
                        $pdo_statement->bindValue(':limit_date', date("Y-m-d"), PDO::PARAM_STR);
                        $pdo_statement->execute();
                        // Redirection
                        unset($_SESSION["inscription"]);
                        $_SESSION['inscription'] = "enregistre";
                        header("Location:" . URL . "/connexion");
                    }
                    else {
                        $erreur_mdp_confirm = "Les mots de passe saisis ne sont pas identiques";
                    }
                }
                else {
                    $erreur_mdp = "Le mot de passe doit comporter au minimum 8 caractères, 1 majuscule, 1 minuscule, 1 chiffre, 1 caractère spécial";
                }
            }
            else {
                $erreur_email = "L'adresse email a déjà été utilisé";
            }
        }
        else {
            $erreur_email = "Mettre une adresse email valable";
        }
    }
    else {
        $erreur = "Veuillez remplir tous les champs";
    }
}

?>