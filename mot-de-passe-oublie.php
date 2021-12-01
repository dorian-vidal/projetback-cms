<?php 
require_once("init.php");
require_once("fonctions.php");

// Vérifie connexion
membre_deconnecte_davy();

// Mot de passe oublié
$notification = "";
$erreur = "";
$erreur_email = "";
$erreur_mdp = "";
$erreur_mdp_confirm = "";

// Supprimer vieux tokens
$pdo_statement = $pdo_object->prepare("DELETE FROM mdpoublier WHERE date != DATE(NOW())");
$pdo_statement->execute();

if(!isset($_GET['token'])) {
    // Envoyer mail pour mot de passe oublé
    if (isset($_POST['envoyer'])) {
        // Champs rempli
        if (!empty($_POST['email'])) {
            // Email format
            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                // Vérifie Email membre
                $pdo_statement = $pdo_object->prepare("SELECT * FROM membre WHERE email = :email");
                $pdo_statement->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
                $pdo_statement->execute();
                $membre_array = $pdo_statement->fetch(PDO::FETCH_ASSOC);
                if (!empty($membre_array)) {
                    // Créer token
                    $token = bin2hex(random_bytes(12));
                    // Vérifie Email mdpoublier
                    $pdo_statement = $pdo_object->prepare("SELECT * FROM mdpoublier WHERE email = :email");
                    $pdo_statement->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
                    $pdo_statement->execute();
                    $mdpoublier_array = $pdo_statement->fetch(PDO::FETCH_ASSOC);
                    if (empty($mdpoublier_array)) {
                        $pdo_statement = $pdo_object->prepare("INSERT INTO mdpoublier (email, token, date) VALUES (:email, :token, :date)");
                        $pdo_statement->bindValue(':email', htmlspecialchars($_POST['email']), PDO::PARAM_STR);
                        $pdo_statement->bindValue(':token', htmlspecialchars($token), PDO::PARAM_STR);
                        $pdo_statement->bindValue(':date', date("Y-m-d"), PDO::PARAM_STR);
                        $pdo_statement->execute();
                    }
                    else {
                        $pdo_statement = $pdo_object->prepare("UPDATE mdpoublier SET token = :token, date = :date WHERE email = :email");
                        $pdo_statement->bindValue(':email', htmlspecialchars($_POST['email']), PDO::PARAM_STR);
                        $pdo_statement->bindValue(':token', htmlspecialchars($token), PDO::PARAM_STR);
                        $pdo_statement->bindValue(':date', date("Y-m-d"), PDO::PARAM_STR);
                        $pdo_statement->execute();
                    }
                    // Envoie email
                    $destinataire = $_POST['email'];
                    $object = "[One Website] - Changer votre mot de passe";
                    $message = "Bonjour,\n\nVous trouverez ci-dessous le lien de changement de mot de passe valable jusqu'à minuit :\n" . URL . "/mot-de-passe-oublie?token=" . $token . "\n\nCordialement,\nL'équipe de One Website\nhttps://one-website.com";
                    $headers = "From: contact@one-website.com";
                    if (mail($destinataire, $object, $message, $headers)) {
                        $notification = "L'email de changement de mot de passe a été envoyé";
                    }
                    else {
                        $erreur = "Échec de l'envoi du message";
                    }
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
}
else {
    // Changer de mot de passe
    if (isset($_POST['envoyer'])) {
        $pdo_statement = $pdo_object->prepare("SELECT * FROM mdpoublier WHERE token = :token");
        $pdo_statement->bindValue(':token', $_GET['token'], PDO::PARAM_STR);
        $pdo_statement->execute();
        $mdpoublier_array = $pdo_statement->fetch(PDO::FETCH_ASSOC);
        if (!empty($mdpoublier_array)) {
            // verifie token
            if ($_GET['token'] === $mdpoublier_array['token']) {
                // Champs rempli
                if (!empty($_POST['mdp']) && !empty($_POST['mdp_confirm'])) {
                    // Mdp longueur + Majuscule + Minuscule + Chiffre + Caractère spécial
                    if (strlen($_POST['mdp']) >= 8 && strtolower($_POST['mdp']) != $_POST['mdp'] && strtoupper($_POST['mdp']) != $_POST['mdp'] && preg_match('!\d+!', $_POST['mdp']) && preg_replace('/[^0-9a-zA-Z]/', '', $_POST['mdp']) != $_POST['mdp']) {
                        // Mdp confirmation
                        if ($_POST['mdp'] === $_POST['mdp_confirm']) {
                            // Enregister
                            $pdo_statement = $pdo_object->prepare("UPDATE membre SET mdp = :mdp WHERE email = :email");
                            $pdo_statement->bindValue(':mdp', password_hash($_POST['mdp'], PASSWORD_DEFAULT), PDO::PARAM_STR);
                            $pdo_statement->bindValue(':email', htmlspecialchars($mdpoublier_array['email']), PDO::PARAM_STR);
                            $pdo_statement->execute();
                            // Supprimer token mdpoublier
                            $pdo_statement = $pdo_object->prepare("DELETE FROM mdpoublier WHERE token = :token");
                            $pdo_statement->bindValue(':token', $_GET['token'], PDO::PARAM_STR);
                            $pdo_statement->execute();
                            $notification = "Votre mot de passe a bien été modifié";
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
                    $erreur = "Veuillez remplir tous les champs";
                }
            }
            else {
                $erreur = "Le token n'est pas valable";
            }
        }
        else {
            $erreur = "Le token n'existe pas";
        }
    }
}

require_once("header.php");
?>
  
        <!-- titre -->
        <div class="container mt-5">
            <div class="row">
                <div class="col text_center_davy">
                    <h1>Mot de passe oublié</h1>
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
                        <!-- envoyer mail pour mot de passe oublé -->
                        <?php if(!isset($_GET['token'])) : ?>
                        <label for="email"><strong>Email</strong></label> <span class="color_davy"><strong><?= $erreur_email ?></strong></span>
                        <input type="email" id="email" name="email" placeholder="Saisir votre email" class="width_full_davy"><br><br>
                        <?php endif; ?>
                        <!-- changer de mot de passe -->
                        <?php if(isset($_GET['token'])) : ?>
                        <label for="mdp"><strong>Nouveau mot de passe</strong></label> <span class="color_davy"><strong><?= $erreur_mdp ?></strong></span><br>
                        <input type="password" id="mdp" name="mdp" placeholder="Saisir votre mot de passe" class="width_full_davy"><br><br>
                        <label for="mdp_confirm"><strong>Confirmation du nouveau mot de passe</strong></label> <span class="color_davy"><strong><?= $erreur_mdp_confirm ?></strong></span><br>
                        <input type="password" id="mdp_confirm" name="mdp_confirm" placeholder="Confirmer votre mot de passe" class="width_full_davy"><br><br>
                        <?php endif; ?>
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