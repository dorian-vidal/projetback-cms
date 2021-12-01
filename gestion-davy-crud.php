<?php
require_once("init.php");
require_once("fonctions.php");

// Vérifie connexion
membre_connecte_davy(0);

// Supprimer
if (isset($_GET['supprimer']) && isset($_GET['table'])) {
    $bdd_table = $_GET['table'];
    $pdo_statement = $pdo_object->prepare("SELECT * FROM $bdd_table");
    $pdo_statement->execute();
    $col_meta = $pdo_statement->getColumnMeta(0);
    $col_meta_first = $col_meta['name'];
    $sql_select = "DELETE FROM " . $bdd_table . " WHERE " . $col_meta_first . " = :" . $col_meta_first;
    $bind_value = ":" . $col_meta_first;
    $pdo_statement = $pdo_object->prepare($sql_select);
    $pdo_statement->bindValue($bind_value, $_GET['supprimer'], PDO::PARAM_INT);
    $pdo_statement->execute();
    header("Location:" . URL . "/gestion-davy-crud.php?table=" . $bdd_table);
}

// Premier colonne
$pdo_statement = $pdo_object->prepare("SELECT * FROM $bdd_table");
$pdo_statement->execute();
$col_meta = $pdo_statement->getColumnMeta(0);
$col_meta_first = $col_meta['name'];

// Chercher
if (!isset($_SESSION['chercher']) || (isset($_SESSION['chercher']) && $_SESSION['chercher'] == "")) {
    $pdo_statement = $pdo_object->prepare("SELECT * FROM $bdd_table ORDER BY $col_meta_first DESC");
}
else {
    $pdo_statement = $pdo_object->prepare("SELECT * FROM $bdd_table");
    $pdo_statement->execute();
    $col_count = $pdo_statement->columnCount();
    $mot_chercher = "'%" . $_SESSION['chercher'] . "%'";
    $sql_col_name = "";
    for ($i = 0; $i < $col_count; $i++) {
        $col_meta = $pdo_statement->getColumnMeta($i);
        
        if ($i != 0) {
            $sql_col_name = $sql_col_name . $col_meta['name'] . " LIKE CONCAT('%', :chercher, '%')";
        }
        if ($i < $col_count - 1 && $i != 0) {
            $sql_col_name = $sql_col_name . " OR ";
        }
    }
    $pdo_statement = $pdo_object->prepare("SELECT * FROM $bdd_table WHERE $sql_col_name ORDER BY $col_meta_first DESC");
    $pdo_statement->bindValue(":chercher", htmlspecialchars($_SESSION['chercher']), PDO::PARAM_STR);
}

// Gestion
$pdo_statement->execute();
$col_count = $pdo_statement->columnCount();
$row_count = $pdo_statement->rowCount();
$table_data = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
$id_col = 0;

require_once("header-davy-crud.php");
?>

        <div class="block_admin_davy container">
            <div class="row">
                <div class="col text_center_davy">
                    <h1>Gestion Table : <?php if ($bdd_table) {echo $bdd_table;} ?></h1>
                    <hr class="hr_davy block_center_davy animation_davy">
                    <!-- bouton_anim_davy -->
                    <a href="<?= URL ?>/ajouter-davy-crud.php?&table=<?= $bdd_table ?>" aria-label="élément" class="bouton_anim_davy bouton_envoyer" data-text="Ajouter" title="Ajouter">
                        <span>é</span>
                        <span>l</span>
                        <span>é</span>
                        <span>m</span>
                        <span>e</span>
                        <span>n</span>
                        <span>t</span>
                    </a>
                </div>
            </div>
        </div>
        <br>
        <div class="block_admin_davy container">
            <div class="row">
                <div class="col text_center_davy">
                    <form method="post" enctype="multipart/form-data">
                        <input type="text" id="mot_chercher" name="mot_chercher" placeholder="Chercher" value="<?php if (isset($_SESSION['chercher'])) {echo $_SESSION['chercher'];} ?>">
                    </form>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col table_responsive_davy" id="container_davy">
                    <table>
                        <thead>
                            <tr>
<?php
for ($i = 0; $i < $col_count; $i++) :
    $col_meta = $pdo_statement->getColumnMeta($i);
?>
                                <th><?= $col_meta['name'] ?></th>
<?php
endfor;
?>
                                <th>Gestion</th>
                            </tr>
                        </thead>
                        <tbody>
<?php
for ($j = 0; $j < $row_count; $j++) :
?>
                            <tr>
<?php
    for ($i = 0; $i < $col_count; $i++) :
        $col_meta = $pdo_statement->getColumnMeta($i);
        $col_name = $col_meta['name'];
        if ($i == 0) :
            $id_col = $table_data[$j][$col_name];
?>
                                <td class="text_center_davy block_gestion_admin_davy"><?php echo substr(htmlspecialchars($table_data[$j][$col_name]), 0, 60); if (strlen($table_data[$j][$col_name]) > 60) {echo " ...";} ?><br><a href="<?= URL ?>/voir-davy-crud.php?id=<?= $id_col ?>&table=<?= $bdd_table ?>" title="Voir"><svg class="icon_gestion_admin_davy" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="-1 0 136 136.21852"><path fill="currentColor" d="M 93.148438 80.832031 C 109.5 57.742188 104.03125 25.769531 80.941406 9.421875 C 57.851562 -6.925781 25.878906 -1.460938 9.53125 21.632812 C -6.816406 44.722656 -1.351562 76.691406 21.742188 93.039062 C 38.222656 104.707031 60.011719 105.605469 77.394531 95.339844 L 115.164062 132.882812 C 119.242188 137.175781 126.027344 137.347656 130.320312 133.269531 C 134.613281 129.195312 134.785156 122.410156 130.710938 118.117188 C 130.582031 117.980469 130.457031 117.855469 130.320312 117.726562 Z M 51.308594 84.332031 C 33.0625 84.335938 18.269531 69.554688 18.257812 51.308594 C 18.253906 33.0625 33.035156 18.269531 51.285156 18.261719 C 69.507812 18.253906 84.292969 33.011719 84.328125 51.234375 C 84.359375 69.484375 69.585938 84.300781 51.332031 84.332031 C 51.324219 84.332031 51.320312 84.332031 51.308594 84.332031 Z M 51.308594 84.332031"/></svg></a><a href="<?= URL ?>/modifier-davy-crud.php?id=<?= $id_col ?>&table=<?= $bdd_table ?>" title="Modifier"><svg class="icon_gestion_admin_davy" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 489.663 489.663"><g><path fill="currentColor" d="M467.144,103.963l5.6-5.6c22.5-22.5,22.5-58.9,0-81.4c-22.4-22.6-58.9-22.6-81.3-0.1l-5.6,5.6L467.144,103.963z"/></g><g><path fill="currentColor" d="M324.944,297.763v124.5h-257.5v-257.5h124.5l67.4-67.4h-244.6c-8.1,0-14.7,6.6-14.7,14.7v362.9c0,8.1,6.6,14.7,14.7,14.7 h362.9c8.1,0,14.7-6.6,14.7-14.7v-244.6L324.944,297.763z"/></g><g><polygon fill="currentColor" points="360.644,47.663 132.244,276.063 114.044,375.663 213.644,357.463 442.044,129.063"/></g></svg></a><a href="<?= URL ?>/gestion-davy-crud.php?supprimer=<?= $id_col ?>&table=<?= $bdd_table ?>" onclick="return(confirm('Souhaitez-vous supprimer ?'))" title="Supprimer"><svg class="icon_gestion_admin_davy" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 448 512"><path fill="currentColor" d="M32 464a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V128H32zm272-256a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zM432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16z"></path></svg></a></td>
<?php
        else :
?>
                                <td><?php echo substr(htmlspecialchars($table_data[$j][$col_name]), 0, 60); if (strlen($table_data[$j][$col_name]) > 60) {echo " ...";} ?></td>
<?php
        endif;
    endfor;
?>
                                <td class="text_center_davy block_gestion_admin_davy"><a href="<?= URL ?>/voir-davy-crud.php?id=<?= $id_col ?>&table=<?= $bdd_table ?>" title="Voir"><svg class="icon_gestion_admin_davy" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="-1 0 136 136.21852"><path fill="currentColor" d="M 93.148438 80.832031 C 109.5 57.742188 104.03125 25.769531 80.941406 9.421875 C 57.851562 -6.925781 25.878906 -1.460938 9.53125 21.632812 C -6.816406 44.722656 -1.351562 76.691406 21.742188 93.039062 C 38.222656 104.707031 60.011719 105.605469 77.394531 95.339844 L 115.164062 132.882812 C 119.242188 137.175781 126.027344 137.347656 130.320312 133.269531 C 134.613281 129.195312 134.785156 122.410156 130.710938 118.117188 C 130.582031 117.980469 130.457031 117.855469 130.320312 117.726562 Z M 51.308594 84.332031 C 33.0625 84.335938 18.269531 69.554688 18.257812 51.308594 C 18.253906 33.0625 33.035156 18.269531 51.285156 18.261719 C 69.507812 18.253906 84.292969 33.011719 84.328125 51.234375 C 84.359375 69.484375 69.585938 84.300781 51.332031 84.332031 C 51.324219 84.332031 51.320312 84.332031 51.308594 84.332031 Z M 51.308594 84.332031"/></svg></a><a href="<?= URL ?>/modifier-davy-crud.php?id=<?= $id_col ?>&table=<?= $bdd_table ?>" title="Modifier"><svg class="icon_gestion_admin_davy" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 489.663 489.663"><g><path fill="currentColor" d="M467.144,103.963l5.6-5.6c22.5-22.5,22.5-58.9,0-81.4c-22.4-22.6-58.9-22.6-81.3-0.1l-5.6,5.6L467.144,103.963z"/></g><g><path fill="currentColor" d="M324.944,297.763v124.5h-257.5v-257.5h124.5l67.4-67.4h-244.6c-8.1,0-14.7,6.6-14.7,14.7v362.9c0,8.1,6.6,14.7,14.7,14.7 h362.9c8.1,0,14.7-6.6,14.7-14.7v-244.6L324.944,297.763z"/></g><g><polygon fill="currentColor" points="360.644,47.663 132.244,276.063 114.044,375.663 213.644,357.463 442.044,129.063"/></g></svg></a><a href="<?= URL ?>/gestion-davy-crud.php?supprimer=<?= $id_col ?>&table=<?= $bdd_table ?>" onclick="return(confirm('Souhaitez-vous supprimer ?'))" title="Supprimer"><svg class="icon_gestion_admin_davy" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 448 512"><path fill="currentColor" d="M32 464a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V128H32zm272-256a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zM432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16z"></path></svg></a></td>
                            </tr>
<?php
endfor;
if ($row_count < 1) :
?>
                            <tr>
                                <td colspan="<?= $col_count + 1 ?>" class="text_center_davy">Aucun résultat</td>
                            </tr>
<?php
endif;
?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <script src="<?= URL ?>/js/script_jquery.min.js"></script>
        <script>
        $(document).ready(function() {
            $("#mot_chercher").keyup(function() {
                let str_load = "<?= URL ?>/gestion-davy-crud-ajax.php?chercher=" + $("#mot_chercher").val() + "&table=<?= $bdd_table ?>";
                $("#container_davy").load(str_load);
            });
        });
        </script>
<?php
require_once("footer-davy-crud.php");
?>