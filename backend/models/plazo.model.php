<?php

//require_once "../connection.php";

class PlazoModel{

    /*
    public static function create($tablaPlazo, $tipoPlazo){

        // Preparación de la consulta de inserción.
        $query = Connection::connect()->prepare(

            "INSERT INTO $tablaPlazo (tipoPlazo) VALUES (:tipoPlazo);"
        );

        // Definiendo las variables de la consulta
        $query -> bindParam(":tipoPlazo", $tipoPlazo, PDO::PARAM_STR);

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

    public static function readAll($tablaPlazo){

        // Preparación de la consulta de lectura.
        $query = Connection::connect() -> prepare(

            " SELECT * FROM $tablaPlazo;"
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
    public static function update($tablaPlazo, $datos){

        // Preparado la consulta para alterar una tabla.
        $query = Connection::connect()->prepare(

            " UPDATE $tablaPlazo SET tipoPlazo = :tipoPlazo WHERE plazoID = :plazoID;"
        );

        // Definiendo las variables de la consulta.
        $query -> bindParam(":tipoPlazo", $datos["tipoPlazo"], PDO::PARAM_STR);
        $query -> bindParam(":plazoID", $datos["plazoID"], PDO::PARAM_INT);

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

    public static function delete($tablaPlazo, $plazoID){

        // Preparando consulta de eliminación de datos de una tabla.
        $query = Connection::connect()->prepare(

            " DELETE FROM $tablaPlazo WHERE plazoID = :plazoID;"
        );

        // Definiendo las variables de la consulta.
        $query -> bindParam(":plazoID", $plazoID, PDO::PARAM_INT);

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