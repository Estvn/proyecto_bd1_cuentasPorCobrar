<?php

//require_once "../connection.php";

class AntiguedadModel{

    /*
    public static function create($tablaAntiguedad, $tipoAntiguedad){

        // Preparación de la consulta de inserción.
        $query = Connection::connect()->prepare(

            "INSERT INTO $tablaAntiguedad (tipoAntiguedad) VALUES (:tipoAntiguedad);"
        );

        // Definiendo las variables de la consulta
        $query -> bindParam(":tipoAntiguedad", $tipoAntiguedad, PDO::PARAM_STR);

        // Respuesta que se enviará al controlador que llamo a este método.
        if($query -> execute()){
            return "ok";
        }else{
            print_r(Connection::connect()->errorInfo());
        }

        $query -> closeCursor();
        $query = null;
    }
    */

    public static function readAll($tablaAntiguedad){

        // Preparación de la consulta de lectura.
        $query = Connection::connect() -> prepare(

            " SELECT * FROM $tablaAntiguedad;"
        );

        // Ejecución de la consulta.
        $query->execute();

        // Capturando los datos pedidos por la consulta.
        $result = $query->fetchAll(PDO::FETCH_CLASS);

        // Finalizando la variable de consulta, y retornando los datos solicitados.
        $query->closeCursor();
        $query=null;
        return $result;
    }

    /*
    public static function update($tablaAntiguedad, $datos){

        // Preparado la consulta para alterar una tabla.
        $query = Connection::connect()->prepare(

            " UPDATE $tablaAntiguedad SET tipoAntiguedad = :tipoAntiguedad WHERE antiguedadID = :antiguedadID;"
        );

        // Definiendo las variables de la consulta.
        $query -> bindParam(":tipoAntiguedad", $datos["tipoAntiguedad"], PDO::PARAM_STR);
        $query -> bindParam(":antiguedadID", $datos["antiguedadID"], PDO::PARAM_INT);

        // Respuesta que se enviará al controllador que usó este método.
        if($query -> execute()){
            return "ok";
        }else{
            print_r(Connection::connect()->errorInfo());
        }

        // Finalizando la variable de consulta.
        $query -> closeCursor();
        $query = null;
    }

    public static function delete($tablaAntiguedad, $antiguedadID){

        // Preparando consulta de eliminación de datos de una tabla.
        $query = Connection::connect()->prepare(

            " DELETE FROM $tablaAntiguedad WHERE antiguedadID = :antiguedadID;"
        );

        // Definiendo las variables de la consulta.
        $query -> bindParam(":antiguedadID", $antiguedadID, PDO::PARAM_INT);

        // Respuesta que se envía al controlador que utilizó este método.
        if($query->execute()){
            return "ok";
        }else{
            print_r(Connection::connect()->errorInfo());
        }

        // Finalizando variable de consulta.
        $query->closeCursor();
        $query = null;
    }
    */
    
}