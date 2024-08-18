<?php

//require_once "../connection.php";

class GeneroModel{

    /*
    public static function create($tablaGenero, $tipoGenero){

        // Preparación de la consulta de inserción.
        $query = Connection::connect()->prepare(

            "INSERT INTO $tablaGenero (tipoGenero) VALUES (:tipoGenero);"
        );

        // Definiendo las variables de la consulta
        $query -> bindParam(":tipoGenero", $tipoGenero, PDO::PARAM_STR);

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

    public static function readAll($tablaGenero){

        // Preparación de la consulta de lectura.
        $query = Connection::connect() -> prepare(

            " SELECT * FROM $tablaGenero;"
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
    public static function delete($tablaGenero, $generoID){

        // Preparando consulta de eliminación de datos de una tabla.
        $query = Connection::connect()->prepare(

            " DELETE FROM $tablaGenero WHERE generoID = :generoID;"
        );

        // Definiendo las variables de la consulta.
        $query -> bindParam(":generoID", $generoID, PDO::PARAM_INT);

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