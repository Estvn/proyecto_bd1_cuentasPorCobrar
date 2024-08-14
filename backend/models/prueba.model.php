<?php

class PruebaModel{

    static public function mostrarPrueba(){

        $script = Connection::connect()->prepare("SELECT * FROM plazo;");
        $script->execute();
        $result = $script->fetchAll(PDO::FETCH_CLASS);
        $script->closeCursor();
        $script = null;
        return $result;
    }
}