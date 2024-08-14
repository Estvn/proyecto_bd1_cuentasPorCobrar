<?php

//require_once "../connection.php";

class ArticuloModel{

    public static function create($tablaArticulo, $datos){

        // Preparación de la consulta de inserción.
        $query = Connection::connect()->prepare(

            " INSERT INTO $tablaArticulo 
            (categoriaArticuloID, sucursalID, nombreArticulo, valorArticulo, cantidadArticulo)
            VALUES
            (:categoriaArticuloID, :sucursalID, :nombreArticulo, :valorArticulo, :cantidadArticulo);
            "
        );

        // Definiendo las variables de la consulta
        $query -> bindParam(":categoriaArticuloID", $datos["categoriaArticuloID"], PDO::PARAM_INT);
        $query -> bindParam(":sucursalID", $datos["sucursalID"], PDO::PARAM_INT);
        $query -> bindParam(":nombreArticulo", $datos["nombreArticulo"], PDO::PARAM_STR);
        $query -> bindParam(":valorArticulo", $datos["valorArticulo"], PDO::PARAM_STR);
        $query -> bindParam(":cantidadArticulo", $datos["cantidadArticulo"], PDO::PARAM_STR);

        // Respuesta que se enviará al controlador que llamo a este método.
        if($query -> execute()){
            return "ok";
        }else{
            print_r(Connection::connect()->errorInfo());
        }

        $query -> closeCursor();
        $query = null;
    }

    public static function readByCategory($tablaArticulo, $categoriaID){

        // Preparación de la consulta de lectura.
        $query = Connection::connect() -> prepare(

            "SELECT 
            CATEGORIAARTICULO.categoria, 
            SUCURSAL.nombreSucursal, 
            DIRECCION.departamento, DIRECCION.municipio,
            $tablaArticulo.articuloID, $tablaArticulo.nombreArticulo, $tablaArticulo.valorArticulo, $tablaArticulo.cantidadArticulo
            FROM $tablaArticulo
            INNER JOIN CATEGORIAARTICULO ON $tablaArticulo.categoriaArticuloID = CATEGORIAARTICULO.categoriaArticuloID
            INNER JOIN SUCURSAL ON $tablaArticulo.sucursalID = SUCURSAL.sucursalID
            INNER JOIN DIRECCION ON SUCURSAL.direccionID = DIRECCION.direccionID
            WHERE $tablaArticulo.categoriaArticuloID = :categoriaID
            ORDER BY $tablaArticulo.nombreArticulo ASC;
            "
        );

        $query -> bindParam(":categoriaID", $categoriaID, PDO::PARAM_INT);

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
    public static function readOne($tablaArticulo, $datos){

        // Preparación de la consulta de lectura.
        $query = Connection::connect() -> prepare(

            "SELECT 
            CATEGORIAARTICULO.categoria, 
            SUCURSAL.nombreSucursal, 
            DIRECCION.departamento, DIRECCION.municipio,
            $tablaArticulo.nombreArticulo, $tablaArticulo.valorArticulo, $tablaArticulo.cantidadArticulo
            FROM $tablaArticulo
            INNER JOIN CATEGORIAARTICULO ON $tablaArticulo.categoriaArticuloID = CATEGORIAARTICULO.categoriaArticuloID
            INNER JOIN SUCURSAL ON $tablaArticulo.sucursalID = SUCURSAL.sucursalID
            INNER JOIN DIRECCION ON SUCURSAL.direccionID = DIRECCION.direccionID
            WHERE articuloID = :articuloID;
            "
        );

        $query -> bindParam(":articuloID", $datos["articuloID"], PDO::PARAM_INT);

        // Ejecución de la consulta.
        $query->execute();

        // Capturando los datos pedidos por la consulta.
        $result = $query->fetchAll(PDO::FETCH_CLASS);

        // Finalizando la variable de consulta, y retornando los datos solicitados.
        $query->closeCursor();
        $query=null;
        return $result;
    }

    public static function readAll($tablaArticulo){

        // Preparación de la consulta de lectura.
        $query = Connection::connect() -> prepare(

            "SELECT 
            CATEGORIAARTICULO.categoria, 
            SUCURSAL.nombreSucursal, 
            DIRECCION.departamento, DIRECCION.municipio,
            $tablaArticulo.nombreArticulo, $tablaArticulo.valorArticulo, $tablaArticulo.cantidadArticulo
            FROM $tablaArticulo
            INNER JOIN CATEGORIAARTICULO ON $tablaArticulo.categoriaArticuloID = CATEGORIAARTICULO.categoriaArticuloID
            INNER JOIN DIRECCION ON SUCURSAL.direccionID = DIRECCION.direccionID
            INNER JOIN DIRECCION ON SUCURSAL.direccionID = DIRECCION.direccionI;
            "
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

    public static function update($tablaArticulo, $datos){

        // Preparado la consulta para alterar una tabla.
        $query = Connection::connect()->prepare(

            " UPDATE $tablaArticulo SET
                categoriaArticuloID = :categoriaArticuloID,
                sucursalID = :sucursalID,
                nombreArticulo = :nombreArticulo,
                valorArticulo = :valorArticulo,
                cantidadArticulo = :cantidadArticulo
                WHERE articuloID = :articuloID;
             "
        );

        // Definiendo las variables de la consulta.
        $query -> bindParam(":categoriaArticuloID", $datos["categoriaArticuloID"], PDO::PARAM_INT);
        $query -> bindParam(":sucursalID", $datos["sucursalID"], PDO::PARAM_INT);
        $query -> bindParam(":nombreArticulo", $datos["nombreArticulo"], PDO::PARAM_STR);
        $query -> bindParam(":valorArticulo", $datos["valorArticulo"], PDO::PARAM_STR);
        $query -> bindParam(":cantidadArticulo", $datos["cantidadArticulo"], PDO::PARAM_STR);
        $query -> bindParam(":articuloID", $datos["articuloID"], PDO::PARAM_INT);

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

    public static function delete($tablaArticulo, $articuloID){

        // Preparando consulta de eliminación de datos de una tabla.
        $query = Connection::connect()->prepare(

            " DELETE FROM $tablaArticulo WHERE articuloID = :articuloID;"
        );

        // Definiendo las variables de la consulta.
        $query -> bindParam(":articuloID", $articuloID, PDO::PARAM_INT);

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