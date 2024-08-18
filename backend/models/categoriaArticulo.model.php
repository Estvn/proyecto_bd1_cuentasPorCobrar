<?php

//require_once "../connection.php";

class CategoriaArticuloModel{

    /*
    public static function create($tablaCategoriaArticulo, $categoria){

        // Preparación de la consulta de inserción.
        $query = Connection::connect()->prepare(

            " INSERT INTO $tablaCategoriaArticulo (categoria) VALUES (:categoria);"
        );

        // Definiendo las variables de la consulta
        $query -> bindParam(":categoria", $categoria, PDO::PARAM_STR);

        // Respuesta que se enviará al controlador que llamo a este método.
        if($query -> execute()){
            return "ok";
        }else{
            print_r(Connection::connect()->errorInfo());
        }

        $query -> closeCursor();
        $query = null;
    }

    public static function readOne($tablaCategoriaArticulo, $categoriaArticuloID){

        // Preparación de la consulta de lectura.
        $query = Connection::connect() -> prepare(

            " SELECT * FROM $tablaCategoriaArticulo WHERE categoriaArticuloID = :categoriaArticuloID;"
        );

        $query -> bindParam(":categoriaArticuloID", $categoriaArticuloID, PDO::PARAM_INT);

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

    public static function readAll($tablaCategoriaArticulo){

        // Preparación de la consulta de lectura.
        $query = Connection::connect() -> prepare(

            " SELECT * FROM $tablaCategoriaArticulo ORDER BY categoria ASC;"
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
    public static function update($tablaCategoriaArticulo, $datos){

        // Preparado la consulta para alterar una tabla.
        $query = Connection::connect()->prepare(

            " UPDATE $tablaCategoriaArticulo SET
                categoria = :categoria WHERE categoriaArticuloID = :categoriaArticuloID;
            "
        );

        // Definiendo las variables de la consulta.
        $query -> bindParam(":categoria", $datos["categoria"], PDO::PARAM_STR);
        $query -> bindParam(":categoriaArticuloID", $datos["categoriaArticuloID"], PDO::PARAM_INT);

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

    public static function delete($tablaCategoriaArticulo, $categoriaArticuloID){

        // Preparando consulta de eliminación de datos de una tabla.
        $query = Connection::connect()->prepare(

            " DELETE FROM $tablaCategoriaArticulo WHERE categoriaArticuloID = :categoriaArticuloID;"
        );

        // Definiendo las variables de la consulta.
        $query -> bindParam(":categoriaArticuloID", $categoriaArticuloID, PDO::PARAM_INT);

        // Respuesta que se envía al controlador que utilizó este método.
        if($query->execute()){
            return "ok";
        }else{
            print_r(Connection::connect()->errorInfo());
        }

        // Finalizando variable de consulta.
        $query->closeCursor();
        $query = null;//
    }
    */
}