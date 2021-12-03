<?php
require_once("init.php");
require_once("fonctions.php");

// Vérifie connexion
membre_connecte_davy(1);

// Réinitialisation du mot de passe
$notification = "";
$erreur = "";
$erreur_email = "";
$erreur_mdp = "";
$erreur_mdp_confirm = "";

// Changer de mot de passe
if (isset($_POST['envoyer'])) {
    // Champs rempli
    if (!empty($_POST['email']) && !empty($_POST['mdp_ancien']) && !empty($_POST['mdp']) && !empty($_POST['mdp_confirm'])) {
        // Email format
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && isset($_SESSION['membre']['email']) && $_SESSION['membre']['email'] == $_POST['email']) {
            // Vérifie Email
            $pdo_statement = $pdo_object->prepare("SELECT * FROM membre WHERE email = :email");
            $pdo_statement->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
            $pdo_statement->execute();
            $membre_array = $pdo_statement->fetch(PDO::FETCH_ASSOC);
            if (!empty($membre_array)) {
                // Vérifie Mdp
                if (password_verify($_POST['mdp_ancien'], $membre_array['mdp']) && $membre_array['limit_connexion'] < 10) {
                    // Mdp longueur + Majuscule + Minuscule + Chiffre + Caractère spécial
                    if (strlen($_POST['mdp']) >= 8 && strtolower($_POST['mdp']) != $_POST['mdp'] && strtoupper($_POST['mdp']) != $_POST['mdp'] && preg_match('!\d+!', $_POST['mdp']) && preg_replace('/[^0-9a-zA-Z]/', '', $_POST['mdp']) != $_POST['mdp']) {
                        // Mdp confirmation
                        if ($_POST['mdp'] === $_POST['mdp_confirm']) {
                            // Enregister
                            $pdo_statement = $pdo_object->prepare("UPDATE membre SET mdp = :mdp WHERE email = :email");
                            $pdo_statement->bindValue(':mdp', password_hash($_POST['mdp'], PASSWORD_DEFAULT), PDO::PARAM_STR);
                            $pdo_statement->bindValue(':email', htmlspecialchars($_POST['email']), PDO::PARAM_STR);
                            $pdo_statement->execute();
                            $notification = "Votre mot de passe a bien été modifié";
                            // Envoie email
                            $destinataire = $_POST['email'];
                            $object = "[One Website] - Votre mot de passe modifié";
                            $message = "Bonjour,\n\nVous avez changé votre mot de passe.\n\nCordialement,\nL'équipe de One Website\nhttps://one-website.com";
                            $headers = "From: contact@one-website.com";
                            if (mail($destinataire, $object, $message, $headers)) {
                                $erreur = "";
                            }
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
                    // Limit connexion
                    $pdo_statement_2 = $pdo_object->prepare("UPDATE membre SET limit_connexion = :limit_connexion, limit_date = :limit_date WHERE id_membre = :id_membre");
                    $pdo_statement_2->bindValue(':limit_connexion', $membre_array['limit_connexion'] + 1, PDO::PARAM_INT);
                    $pdo_statement_2->bindValue(':id_membre', $membre_array['id_membre'], PDO::PARAM_INT);
                    $pdo_statement_2->bindValue(':limit_date', date("Y-m-d"), PDO::PARAM_STR);
                    $pdo_statement_2->execute();
                    if ($membre_array['limit_connexion'] < 10) {
                        $tentative = 10 - $membre_array['limit_connexion'];
                        $erreur = "L'email ou le mot de passe n'est pas valable. Il vous reste " . $tentative . " tentatives";
                    }
                    else {
                        $erreur = "Le compte est bloqué jusqu'à minuit";
                    }
                }
            }
            else {
                $erreur = "L'email ou le mot de passe n'est pas valable";
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