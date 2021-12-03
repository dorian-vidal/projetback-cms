<?php
require_once("view-header.php");
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
require_once("view-footer.php");
?>