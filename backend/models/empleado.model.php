<?php

require_once "../connection.php";

class EmpleadoModel{

    public function create($tablaEmpleado, $datos){

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

    public function read($tablaEmpleado, $datos){

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

    public function update($tablaEmpleado, $datos){

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

    public function delete($tablaEmpleado, $datos){

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