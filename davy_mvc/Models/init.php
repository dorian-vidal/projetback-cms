<?php
// Config
$bdd_name = "davy_cms";
$bdd_host = "localhost";
$bdd_user = "root";
$bdd_password = "";
$url_davy = 'http://localhost/davy_mvc';

// BDD
function connect_database_davy($bdd_name, $bdd_host, $bdd_user, $bdd_password) {
    $bdd_mysql = 'mysql:host=' . $bdd_host . ';dbname=' . $bdd_name . ';charset=utf8';
    $pdo_object = new PDO($bdd_mysql, $bdd_user, $bdd_password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    
    return $pdo_object;
}

// DEFINE
function define_url_davy($url) {
    if ($url != "") {
        define("URL", $url);
    }
    else {
        $url = 'https://' . $_SERVER['SERVER_NAME'] . '/';
        define("URL", $url);
    }
    
    return $url;
}

// Table
function bdd_table_davy($pdo_object, $bdd_name) {
    if (isset($_GET['table'])) {
        return $_GET['table'];
    }
    if ((isset($_GET['table']) && $_GET['table'] == "") || (!isset($_GET['table']))) {
        $pdo_statement_base = $pdo_object->prepare("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE='BASE TABLE' AND TABLE_SCHEMA='$bdd_name'");
        $pdo_statement_base->execute();
        if ($table_data_base = $pdo_statement_base->fetch(PDO::FETCH_ASSOC)) {
            return $table_data_base['TABLE_NAME'];
        }
    }
}

// URL
$URL = define_url_davy($url_davy);

// PDO
$pdo_object = connect_database_davy($bdd_name, $bdd_host, $bdd_user, $bdd_password);

// TABLE
$bdd_table = bdd_table_davy($pdo_object, $bdd_name);

// OUVERTURE SESSION
session_start();

// VOIR SESSION
// echo '<pre>'; print_r($_SESSION); echo '</pre>';
?>