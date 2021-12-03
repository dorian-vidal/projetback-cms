<?php
abstract class Model {
    private static $bdd;

    private static function set_bdd() {
        self::$bdd = new PDO('mysql:host=localhost;dbname=davy_cms;charset=utf8', 'root', '');
        self::$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }
    protected function get_bdd() {
        if (self::$bdd == null) {
            $this->set_bdd();
        }
        return self::set_bdd();
    }
    protected function get_all($table, $obj) {
        $var = [];
        $request = self::$bdd->prepare('SELECT * FROM ' . $table . '');
        $request->execute();

        while ($data = $request->fetch(PDO::FETCH_ASSOC)) {
            $var[] = new $obj($data);
        }
        return $var;
        $request->closeCursor();
    }
}
?>