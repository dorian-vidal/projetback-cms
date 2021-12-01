<?php
require_once("init.php");
require_once("fonctions.php");

// Vérifie connexion
membre_connecte_davy(0);

// ID
if (!isset($_GET['id'])) {
    header("Location:" . URL . "/gestion-davy-crud.php");
}

// Premier colonne
$pdo_statement = $pdo_object->prepare("SELECT * FROM $bdd_table");
$pdo_statement->execute();
$col_count = $pdo_statement->columnCount();
$col_meta = $pdo_statement->getColumnMeta(0);
$col_meta_first = $col_meta['name'];

// Affiche
$sql_select = "SELECT * FROM " . $bdd_table . " WHERE " . $col_meta_first . " = :" . $col_meta_first;
$bind_value = ":" . $col_meta_first;
$pdo_statement = $pdo_object->prepare($sql_select);
$pdo_statement->bindValue($bind_value, $_GET['id'], PDO::PARAM_INT);
$pdo_statement->execute();
$data_array = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);

require_once("header-davy-crud.php");
?>

        <div class="block_admin_davy container">
            <div class="row">
                <div class="col text_center_davy">
                    <h1>Voir : <?php if ($bdd_table) {echo $bdd_table;} ?></h1>
                    <hr class="hr_davy block_center_davy animation_davy">
                    <!-- bouton_anim_davy -->
                    <a href="<?= URL ?>/gestion-davy-crud.php?table=<?= $bdd_table ?>" aria-label="Table" class="bouton_anim_davy bouton_envoyer" data-text="Retour" title="Retour">
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
            <form method="post" enctype="multipart/form-data">
<?php
if ($pdo_statement->rowCount() > 0) :
    $i = 1;
    for ($j = 1; $j < $col_count; $j++) :
        $col_meta = $pdo_statement->getColumnMeta($i);
        $col_meta_name = $col_meta['name'];
        $i++;
?>
                <div class="row">
                    <div class="col-md">
                        <label for="<?= $col_meta_name ?>"><strong><?= $col_meta_name ?></strong></label><br>
                        <textarea id="<?= $col_meta_name ?>" tabindex="5" rows="9" name="<?= $col_meta_name ?>" placeholder="<?= $col_meta_name ?>" class="width_full_davy"><?= htmlspecialchars($data_array[0][$col_meta_name]) ?></textarea><br><br>
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
                        <textarea id="<?= $col_meta_name ?>" tabindex="5" rows="9" name="<?= $col_meta_name ?>" placeholder="<?= $col_meta_name ?>" class="width_full_davy"><?= htmlspecialchars($data_array[0][$col_meta_name]) ?></textarea><br><br>
                    </div>
<?php
        endif;
?>
                </div>
<?php
    endfor;
endif;
?>
            </form>
        </div>
<?php
require_once("footer-davy-crud.php");
?>