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
    header("Location:" . URL . "/gestion.php?table=" . $bdd_table);
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

?>