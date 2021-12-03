<?php
require_once("init.php");
require_once("fonctions.php");

// Vérifie connexion
membre_connecte_davy(0);

// Notification
$notif = "";
if (isset($_GET['notif']) && $_GET['notif'] == "ajouter") {
    $notif = 'Les informations ont été ajouté';
}

// Premier colonne
$pdo_statement = $pdo_object->prepare("SELECT * FROM $bdd_table");
$pdo_statement->execute();
$col_count = $pdo_statement->columnCount();

// Ajouter
if (isset($_POST['ajouter'])) {
    // Prepare
    $sql_col_name = " (";
    for ($i = 0; $i < $col_count; $i++) {
        $col_meta = $pdo_statement->getColumnMeta($i);
        
        if ($i != 0) {
            $sql_col_name = $sql_col_name . $col_meta['name'];
        }
        if ($i < $col_count - 1 && $i != 0) {
            $sql_col_name = $sql_col_name . ", ";
        }
    }
    $sql_col_name = $sql_col_name . ") VALUES (";
    for ($i = 0; $i < $col_count; $i++) {
        $col_meta = $pdo_statement->getColumnMeta($i);
        
        if ($i != 0) {
            $sql_col_name = $sql_col_name . ":" . $col_meta['name'];
        }
        if ($i < $col_count - 1 && $i != 0) {
            $sql_col_name = $sql_col_name . ", ";
        }
    }
    $sql_col_name = $sql_col_name . ")";
    $sql_add = "INSERT INTO " . $bdd_table . $sql_col_name;
    $pdo_statement_add = $pdo_object->prepare($sql_add);
    // BindValue
    $bind_value_col_name = "";
    for ($i = 0; $i < $col_count; $i++) {
        $col_meta = $pdo_statement->getColumnMeta($i);
        
        if ($i != 0) {
            $bind_value_col_name = ":" . $col_meta['name'];
            $col_meta_name = $col_meta['name'];
            $pdo_statement_add->bindValue($bind_value_col_name, $_POST[$col_meta_name], PDO::PARAM_STR);
        }
    }
    $pdo_statement_add->execute();
    header("Location:" . URL . "/ajouter.php?table=" . $_GET['table'] . "&notif=ajouter");
}
?>