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

require_once("header.php");
?>
  
        <!-- titre -->
        <div class="container mt-5">
            <div class="row">
                <div class="col text_center_davy">
                    <h1>Réinitialisation du mot de passe</h1>
                    <hr class="hr_davy block_center_davy animation_davy">
                    <p class="color_davy"><strong><?= $notification ?><?= $erreur ?></strong></p>
                </div>
            </div>
        </div>

        <!-- formulaire -->
        <div class="container mt-5">
            <div class="row">
                <div class="col">
                    <form method="post">
                        <!-- changer de mot de passe -->
                        <label for="email"><strong>Email</strong></label> <span class="color_davy"><strong><?= $erreur_email ?></strong></span><br>
                        <input type="email" id="email" name="email" placeholder="Saisir votre email" class="width_full_davy"><br><br>
                        <label for="mdp_ancien"><strong>Ancien mot de passe</strong></label><br>
                        <input type="password" id="mdp_ancien" name="mdp_ancien" placeholder="Saisir votre ancien mot de passe" class="width_full_davy"><br><br>
                        <label for="mdp"><strong>Nouveau mot de passe</strong></label> <span class="color_davy"><strong><?= $erreur_mdp ?></strong></span><br>
                        <input type="password" id="mdp" name="mdp" placeholder="Saisir votre mot de passe" class="width_full_davy"><br><br>
                        <label for="mdp_confirm"><strong>Confirmation du nouveau mot de passe</strong></label> <span class="color_davy"><strong><?= $erreur_mdp_confirm ?></strong></span><br>
                        <input type="password" id="mdp_confirm" name="mdp_confirm" placeholder="Confirmer votre mot de passe" class="width_full_davy"><br><br>
                        <div class="text_center_davy">
                            <!-- bouton_anim_davy -->
                            <a aria-label="Valider" class="bouton_anim_davy bouton_envoyer" data-text="Envoyer" title="Envoyer">
                                <span>V</span>
                                <span>a</span>
                                <span>l</span>
                                <span>i</span>
                                <span>d</span>
                                <span>e</span>
                                <span>r</span>
                                <input type="submit" id="envoyer" name="envoyer" value="Envoyer" class="bouton_submit">
                            </a>
                        </div><br>
                    </form>
                </div>
            </div>
        </div>
<?php
require_once("footer.php");
?>