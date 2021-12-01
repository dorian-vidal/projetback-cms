<?php 
require_once("init.php");
require_once("fonctions.php");

// Vérifie connexion
membre_deconnecte_davy();

// Connexion
$notification = "";
$erreur = "";
$erreur_email = "";

// Validation email
if(isset($_SESSION['inscription']) && $_SESSION['inscription'] == "enregistre") {
    $notification = "Vous êtes bien inscrit. Vous pouvez vous connecter";
    unset($_SESSION["inscription"]);
}

// Limit connexion
$pdo_statement = $pdo_object->prepare("SELECT * FROM membre");
$pdo_statement->execute();
$membre_array = $pdo_statement->fetch(PDO::FETCH_ASSOC);
if (!empty($membre_array)) {
    $pdo_statement_2 = $pdo_object->prepare("UPDATE membre SET limit_connexion = :limit_connexion WHERE limit_date != DATE(NOW())");
    $pdo_statement_2->bindValue(':limit_connexion', 0, PDO::PARAM_INT);
    $pdo_statement_2->execute();
}

if (isset($_POST['connexion'])) {
    // Champs rempli
    if (!empty($_POST['email']) && !empty($_POST['mdp'])) {
        // Email format
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            // Vérifie Email
            $pdo_statement = $pdo_object->prepare("SELECT * FROM membre WHERE email = :email");
            $pdo_statement->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
            $pdo_statement->execute();
            $membre_array = $pdo_statement->fetch(PDO::FETCH_ASSOC);
            if (!empty($membre_array)) {
                // Vérifie Mdp
                if (password_verify($_POST['mdp'], $membre_array['mdp']) && $membre_array['limit_connexion'] < 10) {
                    // Enregister
                    $_SESSION['membre']['id_membre'] = $membre_array['id_membre'];
                    $_SESSION['membre']['nom'] = $membre_array['nom'];
                    $_SESSION['membre']['prenom'] = $membre_array['prenom'];
                    $_SESSION['membre']['email'] = $membre_array['email'];
                    $_SESSION['membre']['statut'] = $membre_array['statut'];
                    // Redirection
                    if($_SESSION['membre']['statut'] == 0) {
                        header("Location:" . URL . "/gestion-davy-crud.php");
                    }
                    if($_SESSION['membre']['statut'] == 1) {
                        header("Location:" . URL . "/index.php");
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
                    <h1>Connexion</h1>
                    <hr class="hr_davy block_center_davy animation_davy">
                    <p class="color_davy"><strong><?= $notification ?><?= $erreur ?></strong></p>
                </div>
            </div>
        </div>
            
        <!-- formulaire -->
        <div class="container mt-5">
            <div class="row">
                <div class="col">
                    <!-- connexion e-mail -->
                    <form method="post">
                        <label for="email"><strong>Email</strong></label> <span class="color_davy"><strong><?= $erreur_email ?></strong></span>
                        <input type="email" id="email" name="email" placeholder="Saisir votre email" class="width_full_davy"><br><br>
                        <label for="mdp"><strong>Mot de passe</strong></label>
                        <!-- mot de passe oublié -->
                        <?php if(isset($_POST['connexion'])) : ?>
                        <a href="<?= URL ?>/mot-de-passe-oublie" title="Mot de passe oublié" class="color_davy"> <strong>Oublié ?</strong></a>
                        <?php endif; ?>
                        <input type="password" id="mdp" name="mdp" placeholder="Saisir votre mot de passe" class="width_full_davy"><br><br>
                        <div class="text_center_davy">
                            <!-- bouton_anim_davy -->
                            <a aria-label="Valider" class="bouton_anim_davy bouton_envoyer" data-text="Connexion" title="Connexion">
                                <span>V</span>
                                <span>a</span>
                                <span>l</span>
                                <span>i</span>
                                <span>d</span>
                                <span>e</span>
                                <span>r</span>
                                <input type="submit" id="connexion" name="connexion" value="Connexion" class="bouton_submit">
                            </a>
                        </div><br>
                    </form>
                    <!-- inscription -->
                    <div class="text_center_davy">
                        <a class="color_davy" href="<?= URL ?>/inscription" title="Inscription"><strong>Inscrivez-vous ici</strong></a>
                    </div>
                </div>
            </div>
        </div>
<?php
require_once("footer.php");
?>