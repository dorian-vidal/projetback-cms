<?php
// Connexion
function membre_connecte_davy($id_statut) {
    if (isset($_SESSION['membre']) && $_SESSION['membre']['statut'] == $id_statut) {
        return true;
    }
    else {
        header("Location:" . URL . "/connexion");
        return false;
    }
}
function membre_deconnecte_davy() {
    if (!isset($_SESSION['membre'])) {
        return true;
    }
    else {
        header("Location:" . URL);
        return false;
    }
}

// Déconnexion
function deconnexion_davy() {
    unset($_SESSION["membre"]);
    header("Location:" . URL . "/connexion");
}

class CRUD_Davy {
    // Davy CRUD
    public function add_data_base_davy($pdo_object, $bdd_table) {
        // Premier colonne
        $pdo_statement = $pdo_object->prepare("SELECT * FROM $bdd_table");
        $pdo_statement->execute();
        $col_count = $pdo_statement->columnCount();
        
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
    }
    function update_data_base_davy($pdo_object, $bdd_table, $id) {
        // Premier colonne
        $pdo_statement = $pdo_object->prepare("SELECT * FROM $bdd_table");
        $pdo_statement->execute();
        $col_count = $pdo_statement->columnCount();
        $col_meta = $pdo_statement->getColumnMeta(0);
        $col_meta_first = $col_meta['name'];
        
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
                $pdo_statement_update->bindValue($bind_value_id_name, $id, PDO::PARAM_INT);
            }
            if ($i != 0) {
                $bind_value_col_name = ":" . $col_meta['name'];
                $col_meta_name = $col_meta['name'];
                $pdo_statement_update->bindValue($bind_value_col_name, $_POST[$col_meta_name], PDO::PARAM_STR);
            }
        }
        $pdo_statement_update->execute();
    }
    function select_data_base_davy($pdo_object, $bdd_table, $id) {
        // Tous la table
        $pdo_statement = $pdo_object->prepare("SELECT * FROM $bdd_table");
        $pdo_statement->execute();

        // Une ligne
        if ($id != 0) {
            $col_meta = $pdo_statement->getColumnMeta(0);
            $col_meta_first = $col_meta['name'];
            $sql_select = "SELECT * FROM " . $bdd_table . " WHERE " . $col_meta_first . " = :" . $col_meta_first;
            $bind_value = ":" . $col_meta_first;
            $pdo_statement = $pdo_object->prepare($sql_select);
            $pdo_statement->bindValue($bind_value, $id, PDO::PARAM_INT);
            $pdo_statement->execute();
        }

        // Return
        return $pdo_statement;
    }
    function delete_data_base_davy($pdo_object, $bdd_table, $id) {
        // Premier colonne
        $pdo_statement = $pdo_object->prepare("SELECT * FROM $bdd_table");
        $pdo_statement->execute();
        $col_meta = $pdo_statement->getColumnMeta(0);
        $col_meta_first = $col_meta['name'];
        
        // Prepare
        $sql_select = "DELETE FROM " . $bdd_table . " WHERE " . $col_meta_first . " = :" . $col_meta_first;
        $pdo_statement = $pdo_object->prepare($sql_select);
        
        // BindValue
        $bind_value = ":" . $col_meta_first;
        $pdo_statement->bindValue($bind_value, $id, PDO::PARAM_INT);
        $pdo_statement->execute();
    }
}
?>