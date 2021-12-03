<?php
require_once("view-header-admin.php");
?>

        <div class="block_admin_davy container">
            <div class="row">
                <div class="col text_center_davy">
                    <h1>Ajouter : <?php if ($bdd_table) {echo $bdd_table;} ?></h1>
                    <hr class="hr_davy block_center_davy animation_davy">
                    <!-- bouton_anim_davy -->
                    <a href="<?= URL ?>/gestion.php?table=<?= $bdd_table ?>" aria-label="Table" class="bouton_anim_davy bouton_envoyer" data-text="Retour" title="Retour">
                        <span>T</span>
                        <span>a</span>
                        <span>b</span>
                        <span>l</span>
                        <span>e</span>
                    </a>
                </div>
            </div>
        </div>
        <br>
        <div class="block_admin_davy container">
            <div class="color_davy text_center_davy"><strong><?= $notif ?></strong></div><br>
            <form method="post" enctype="multipart/form-data">
<?php
$i = 1;
for ($j = 1; $j < $col_count; $j++) :
    $col_meta = $pdo_statement->getColumnMeta($i);
    $col_meta_name = $col_meta['name'];
    $i++;
?>
                <div class="row width_full_davy">
                    <div class="col-md">
                        <label for="<?= $col_meta_name ?>"><strong><?= $col_meta_name ?></strong></label><br>
                        <textarea id="<?= $col_meta_name ?>" tabindex="5" rows="9" name="<?= $col_meta_name ?>" placeholder="<?= $col_meta_name ?>" class="width_full_davy"></textarea><br><br>
                    </div>
<?php
    $j++;
    if ($j < $col_count) :
        $col_meta = $pdo_statement->getColumnMeta($i);
        $col_meta_name = $col_meta['name'];
        $i++;
?>
                    <div class="col-md">
                        <label for="<?= $col_meta_name ?>"><strong><?= $col_meta_name ?></strong></label><br>
                        <textarea id="<?= $col_meta_name ?>" tabindex="5" rows="9" name="<?= $col_meta_name ?>" placeholder="<?= $col_meta_name ?>" class="width_full_davy"></textarea><br><br>
                    </div>
<?php
    endif;
?>
                </div>
<?php
endfor;
?>
                <div class="row width_full_davy">
                    <div class="col text_center_davy">
                        <!-- bouton_anim_davy -->
                        <a aria-label="éléments" class="bouton_anim_davy bouton_envoyer" data-text="Ajouter" title="Ajouter">
                            <span>é</span>
                            <span>l</span>
                            <span>é</span>
                            <span>m</span>
                            <span>e</span>
                            <span>n</span>
                            <span>t</span>
                            <span>s</span>
                            <input type="submit" id="ajouter" name="ajouter" value="Ajouter" class="bouton_submit">
                        </a>
                    </div>
                </div>
            </form>
        </div>
<?php
require_once("view-footer-admin.php");
?>