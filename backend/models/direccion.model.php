<?php

//require_once "../connection.php";

class DireccionModel{

    public static function create($tablaDireccion, $datos){

        // Preparación de la consulta de inserción.
        $query = Connection::connect()->prepare(

            " INSERT INTO $tablaDireccion (municipio, departamento) VALUES (:municipio, :departamento);"
        );

        // Definiendo las variables de la consulta
        $query -> bindParam(":municipio", $datos["municipio"], PDO::PARAM_STR);
        $query -> bindParam(":departamento", $datos["departamento"], PDO::PARAM_STR);

        // Respuesta que se enviará al controlador que llamo a este método.
        if($query -> execute()){
            return "ok";
        }else{
            print_r(Connection::connect()->errorInfo());
        }

        $query -> closeCursor();
        $query = null;
    }

    /*
    public static function readOne($tablaDireccion, $direccionID){

        // Preparación de la consulta de lectura.
        $query = Connection::connect() -> prepare(

            " SELECT * FROM $tablaDireccion WHERE direccionID = :direccionID;"
        );

        $query -> bindParam(":direccionID", $direccionID, PDO::PARAM_INT);

        // Ejecución de la consulta.
        $query->execute();

        // Capturando los datos pedidos por la consulta.
        $result = $query->fetchAll(PDO::FETCH_CLASS);

        // Finalizando la variable de consulta, y retornando los datos solicitados.
        $query->closeCursor();
        $query=null;
        return $result;
    }
    */

    public static function readAll($tablaDireccion){

        // Preparación de la consulta de lectura.
        $query = Connection::connect() -> prepare(

            " SELECT departamento, municipio FROM $tablaDireccion ORDER BY departamento ASC, municipio ASC;"
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
    public static function update($tablaDireccion, $datos){

        // Preparado la consulta para alterar una tabla.
        $query = Connection::connect()->prepare(

            " UPDATE $tablaDireccion SET
                municipio = :municipio,
                departamento = :departamento 
                WHERE direccionID = :direccionID;
            "
        );

        // Definiendo las variables de la consulta.
        $query -> bindParam(":municipio", $datos["municipio"], PDO::PARAM_STR);
        $query -> bindParam(":departamento", $datos["departamento"], PDO::PARAM_STR);
        $query -> bindParam(":direccionID", $datos["direccionID"], PDO::PARAM_INT);

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

    public static function delete($tablaDireccion, $direccionID){

        // Preparando consulta de eliminación de datos de una tabla.
        $query = Connection::connect()->prepare(

            " DELETE FROM $tablaDireccion WHERE direccionID = :direccionID;"
        );

        // Definiendo las variables de la consulta.
        $query -> bindParam(":direccionID", $direccionID, PDO::PARAM_INT);

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