<?php 
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
require_once("view-footer.php");
?>