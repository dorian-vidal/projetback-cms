<?php 
require_once("init.php");
require_once("fonctions.php");

// Vérifie connexion
membre_deconnecte_davy();

// Inscription
$notification = "";
$erreur = "";
$erreur_email = "";
$erreur_mdp = "";
$erreur_mdp_confirm = "";

// Recaptcha
define("RECAPTCHA_KEY_SITE", "6LfaLD8dAAAAAG9tk0XOIi-tT6bnFrxYmvgWthbU");
define("RECAPTCHA_KEY_SECRET", "6LfaLD8dAAAAAHcHvT7y53Y58kA9JbNTGrQ6XE1t");
if (isset($_POST['g-recaptcha-response'])) {
    $secret = RECAPTCHA_KEY_SECRET;
    $response = htmlspecialchars($_POST['g-recaptcha-response']);
    $remoteip = $_SERVER['REMOTE_ADDR'];
    $request = "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteop=$remoteip";
    $get = file_get_contents($request);
    $decode = json_decode($get, true);
    if ($decode['success']) {
        // Evite de réécrire
        $_SESSION['inscription']['nom'] = $_POST['nom'];
        $_SESSION['inscription']['prenom'] = $_POST['prenom'];
        $_SESSION['inscription']['email'] = $_POST['email'];
        // Champs rempli
        if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['mdp']) && !empty($_POST['mdp_confirm'])) {
            // Email format
            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                // Email double
                $pdo_statement = $pdo_object->prepare("SELECT * FROM membre WHERE email = :email");
                $pdo_statement->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
                $pdo_statement->execute();
                $membre_array = $pdo_statement->fetch(PDO::FETCH_ASSOC);
                if (empty($membre_array)) {
                    // Mdp longueur + Majuscule + Minuscule + Chiffre + Caractère spécial
                    if (strlen($_POST['mdp']) >= 8 && strtolower($_POST['mdp']) != $_POST['mdp'] && strtoupper($_POST['mdp']) != $_POST['mdp'] && preg_match('!\d+!', $_POST['mdp']) && preg_replace('/[^0-9a-zA-Z]/', '', $_POST['mdp']) != $_POST['mdp']) {
                        // Mdp confirmation
                        if ($_POST['mdp'] === $_POST['mdp_confirm']) {
                            // Créer token
                            $token = bin2hex(random_bytes(12));
                            // Enregister
                            $pdo_statement = $pdo_object->prepare("INSERT INTO membre (nom, prenom, email, mdp, statut, email_validation, limit_connexion, limit_date) VALUES (:nom, :prenom, :email, :mdp, :statut, :email_validation, :limit_connexion, :limit_date)");
                            $pdo_statement->bindValue(':nom', htmlspecialchars($_POST['nom']), PDO::PARAM_STR);
                            $pdo_statement->bindValue(':prenom', htmlspecialchars($_POST['prenom']), PDO::PARAM_STR);
                            $pdo_statement->bindValue(':email', htmlspecialchars($_POST['email']), PDO::PARAM_STR);
                            $pdo_statement->bindValue(':mdp', password_hash($_POST['mdp'], PASSWORD_DEFAULT), PDO::PARAM_STR);
                            $pdo_statement->bindValue(':statut', 1, PDO::PARAM_INT);
                            $pdo_statement->bindValue(':email_validation', htmlspecialchars($token), PDO::PARAM_STR);
                            $pdo_statement->bindValue(':limit_connexion', 0, PDO::PARAM_INT);
                            $pdo_statement->bindValue(':limit_date', date("Y-m-d"), PDO::PARAM_STR);
                            $pdo_statement->execute();
                            // Envoie email
                            $destinataire = $_POST['email'];
                            $object = "[One Website] - Validation de l'adresse email";
                            $message = "Bonjour,\n\nVous trouverez ci-dessous le lien pour valider votre adresse email :\n" . URL . "/connexion?token=" . $token . "\n\nCordialement,\nL'équipe de One Website\nhttps://one-website.com";
                            $headers = "From: contact@one-website.com";
                            if (mail($destinataire, $object, $message, $headers)) {
                                $erreur = "";
                            }
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
}

require_once("header.php");
?>

        <!-- titre -->
        <div class="container mt-5">
            <div class="row">
                <div class="col text_center_davy">
                    <h1>Inscription</h1>
                    <hr class="hr_davy block_center_davy animation_davy">
                    <p class="color_davy"><strong><?= $notification ?><?= $erreur ?></strong></p>
                </div>
            </div>
        </div>
        <!-- formulaire -->
        <div class="container mt-5">
            <div class="row">
                <div class="col">
                    <!-- inscription -->
                    <form id="form_inscription" action="inscription.php" method="post">
                        <div class="row">
                            <div class="col-md p-0 pe-md-2">
                                <label for="nom"><strong>Nom</strong></label><br>
                                <input type="text" id="nom" name="nom" placeholder="Saisir votre nom" class="width_full_davy" value="<?php if (isset($_SESSION['inscription']['nom'])) {echo $_SESSION['inscription']['nom'];} ?>"><br><br>
                            </div>
                            <div class="col-md p-0 ps-md-2">
                                <label for="prenom"><strong>Prénom</strong></label><br>
                                <input type="text" id="prenom" name="prenom" placeholder="Saisir votre prenom" class="width_full_davy" value="<?php if (isset($_SESSION['inscription']['prenom'])) {echo $_SESSION['inscription']['prenom'];} ?>"><br><br>
                            </div>
                        </div>
                        <label for="email"><strong>Email</strong></label> <span class="color_davy"><strong><?= $erreur_email ?></strong></span><br>
                        <input type="email" id="email" name="email" placeholder="Saisir votre email" class="width_full_davy" value="<?php if (isset($_SESSION['inscription']['email'])) {echo $_SESSION['inscription']['email'];} ?>"><br><br>
                        <label for="mdp"><strong>Mot de passe</strong></label> <span class="color_davy"><strong><?= $erreur_mdp ?></strong></span><br>
                        <input type="password" id="mdp" name="mdp" placeholder="Saisir votre mot de passe" class="width_full_davy"><br><br>
                        <label for="mdp_confirm"><strong>Confirmation du mot de passe</strong></label> <span class="color_davy"><strong><?= $erreur_mdp_confirm ?></strong></span><br>
                        <input type="password" id="mdp_confirm" name="mdp_confirm" placeholder="Confirmer votre mot de passe" class="width_full_davy"><br><br>
                        <div class="text_center_davy">
                            <!-- bouton_anim_davy -->
                            <a aria-label="Valider" class="bouton_anim_davy bouton_envoyer" data-text="Inscription" title="Inscription">
                                <span>V</span>
                                <span>a</span>
                                <span>l</span>
                                <span>i</span>
                                <span>d</span>
                                <span>e</span>
                                <span>r</span>
                                <input type="submit" id="inscription" name="inscription" value="Inscription" class="bouton_submit g-recaptcha" data-sitekey="<?= RECAPTCHA_KEY_SITE ?>" data-callback="onSubmit" data-action="submit">
                            </a>
                        </div><br>
                    </form>
                </div>
            </div>
        </div>
        <script src="https://www.google.com/recaptcha/api.js"></script>
        <script>
            function onSubmit(token) {
                document.getElementById("form_inscription").submit();
            }
        </script>
<?php
require_once("footer.php");
?>