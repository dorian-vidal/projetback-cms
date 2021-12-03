<?php
require_once("init.php");
require_once("fonctions.php");

// Vérifie connexion
membre_connecte_davy(0);

// ID
if (!isset($_GET['id'])) {
    header("Location:" . URL . "/gestion.php");
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

?>