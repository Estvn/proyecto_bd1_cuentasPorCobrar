<?php

require_once "../connection.php";

class AntiguedadModel{

    public function create($tablaAntiguedad, $datos){

        // Preparación de la consulta de inserción.
        $query = Connection::connect()->prepare(

            "  "
        );

        // Definiendo las variables de la consulta

        // Respuesta que se enviará al controlador que llamo a este método.
        if($query -> execute()){
            return "ok";
        }else{
            print_r(Connection::connect()->errorInfo());
        }

        $query -> closeCursor();
        $query = null;
    }

    public function read($tablaAntiguedad, $datos){

        // Preparación de la consulta de lectura.
        $query = Connection::connect() -> prepare(

            "  "
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

    public function update($tablaAntiguedad, $datos){

        // Preparado la consulta para alterar una tabla.
        $query = Connection::connect()->prepare(

            "  "
        );

        // Definiendo las variables de la consulta.

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

    public function delete($tablaAntiguedad, $datos){

        // Preparando consulta de eliminación de datos de una tabla.
        $query = Connection::connect()->prepare(

            "  "
        );

        // Definiendo las variables de la consulta.

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
    
}