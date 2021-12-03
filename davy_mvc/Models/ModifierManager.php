<?php
require_once("init.php");
require_once("fonctions.php");

// Vérifie connexion
membre_connecte_davy(0);

// ID
if (!isset($_GET['id'])) {
    header("Location:" . URL . "/gestion.php");
}

// Notification
$notif = "";
if (isset($_GET['notif']) && $_GET['notif'] == "modifier") {
    $notif = 'Les informations sont modifiés';
}

// Premier colonne
$pdo_statement = $pdo_object->prepare("SELECT * FROM $bdd_table");
$pdo_statement->execute();
$col_count = $pdo_statement->columnCount();
$col_meta = $pdo_statement->getColumnMeta(0);
$col_meta_first = $col_meta['name'];

// Modifier
if (isset($_POST['modifier'])) {
    // Prepare
    $sql_id_name = "";
    $sql_col_name = "";
    for ($i = 0; $i < $col_count; $i++) {
        $col_meta = $pdo_statement->getColumnMeta($i);
        
        if ($i == 0) {
            $sql_id_name = $col_meta['name'] . " = :" . $col_meta['name'];
        }
        if ($i != 0) {
            $sql_col_name = $sql_col_name . $col_meta['name'] . " = :" . $col_meta['name'];
        }
        if ($i < $col_count - 1 && $i != 0) {
            $sql_col_name = $sql_col_name . ", ";
        }
    }
    $sql_update = "UPDATE " . $bdd_table . " SET " . $sql_col_name . " WHERE " . $sql_id_name;
    $pdo_statement_update = $pdo_object->prepare($sql_update);
    // BindValue
    $bind_value_id_name = "";
    $bind_value_col_name = "";
    for ($i = 0; $i < $col_count; $i++) {
        $col_meta = $pdo_statement->getColumnMeta($i);
        
        if ($i == 0) {
            $bind_value_id_name = ":" . $col_meta['name'];
            $pdo_statement_update->bindValue($bind_value_id_name, $_GET['id'], PDO::PARAM_INT);
        }
        if ($i != 0) {
            $bind_value_col_name = ":" . $col_meta['name'];
            $col_meta_name = $col_meta['name'];
            $pdo_statement_update->bindValue($bind_value_col_name, $_POST[$col_meta_name], PDO::PARAM_STR);
        }
    }
    $pdo_statement_update->execute();
    header("Location:" . URL . "/modifier.php?id=" . $_GET['id'] . "&table=" . $_GET['table'] . "&notif=modifier");
}

// Affiche
$sql_select = "SELECT * FROM " . $bdd_table . " WHERE " . $col_meta_first . " = :" . $col_meta_first;
$bind_value = ":" . $col_meta_first;
$pdo_statement = $pdo_object->prepare($sql_select);
$pdo_statement->bindValue($bind_value, $_GET['id'], PDO::PARAM_INT);
$pdo_statement->execute();
$data_array = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);

?>