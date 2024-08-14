<?php

//require_once "../connection.php";

class SucursalModel{

    public static function create($tablaSucursal, $datos){

        // Preparación de la consulta de inserción.
        $query = Connection::connect()->prepare(

            " INSERT INTO $tablaSucursal (direccionID, nombreSucursal) VALUES (:direccionID, :nombreSucursal);"
        );

        // Definiendo las variables de la consulta
        $query -> bindParam(":direccionID", $datos["direccionID"], PDO::PARAM_INT);
        $query -> bindParam(":nombreSucursal", $datos["nombreSucursal"], PDO::PARAM_STR);

        // Respuesta que se enviará al controlador que llamo a este método.
        if($query -> execute()){
            return "ok";
        }else{
            print_r(Connection::connect()->errorInfo());
        }

        $query -> closeCursor();
        $query = null;
    }

    public static function readOne($tablaSucursal, $sucursalID){

        // Preparación de la consulta de lectura.
        $query = Connection::connect() -> prepare(

            " SELECT DIRECCION.direccionID, DIRECCION.municipio, DIRECCION.departamento, $tablaSucursal.nombreSucursal
            FROM $tablaSucursal
            INNER JOIN DIRECCION ON $tablaSucursal.direccionID = DIRECCION.direccionID
            WHERE $tablaSucursal.sucursalID = :sucursalID;
            "
        );

        $query -> bindParam(":sucursalID", $sucursalID, PDO::PARAM_INT);

        // Ejecución de la consulta.
        $query->execute();

        // Capturando los datos pedidos por la consulta.
        $result = $query->fetchAll(PDO::FETCH_CLASS);

        // Finalizando la variable de consulta, y retornando los datos solicitados.
        $query->closeCursor();
        $query=null;
        return $result;
    }

    public static function readByEmployee($tablaEmpleado, $empleadoID){

        // Preparación de la consulta de lectura.
        $query = Connection::connect() -> prepare(

            " SELECT 
                SUCURSAL.sucursalID, SUCURSAL.nombreSucursal, 
                DIRECCION.municipio, DIRECCION.departamento
            FROM $tablaEmpleado
                INNER JOIN SUCURSAL ON $tablaEmpleado.sucursalID = SUCURSAL.sucursalID
                INNER JOIN DIRECCION ON SUCURSAL.direccionID = DIRECCION.direccionID
            WHERE $tablaEmpleado.empleadoID = :empleadoID;
            "
        );

        $query -> bindParam(":empleadoID", $empleadoID, PDO::PARAM_INT);

        // Ejecución de la consulta.
        $query->execute();

        // Capturando los datos pedidos por la consulta.
        $result = $query->fetchAll(PDO::FETCH_CLASS);

        // Finalizando la variable de consulta, y retornando los datos solicitados.
        $query->closeCursor();
        $query=null;
        return $result;
    }

    public static function readAll($tablaSucursal){

        // Preparación de la consulta de lectura.
        $query = Connection::connect() -> prepare(

            " SELECT 
                $tablaSucursal.sucursalID, $tablaSucursal.nombreSucursal,
                DIRECCION.direccionID, DIRECCION.municipio, DIRECCION.departamento
            FROM $tablaSucursal
                INNER JOIN DIRECCION ON $tablaSucursal.direccionID = DIRECCION.direccionID
                ORDER BY DIRECCION.departamento ASC, DIRECCION.municipio ASC;
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

    /*
    public static function update($tablaSucursal, $datos){

        // Preparado la consulta para alterar una tabla.
        $query = Connection::connect()->prepare(

            " UPDATE $tablaSucursal SET
                direccionID = :direccionID,
                nombreSucursal = :nombreSucursal    
                WHERE sucursalID = :sucursalID;
             "
        );

        // Definiendo las variables de la consulta.
        $query -> bindParam(":direccionID", $datos["direccionID"], PDO::PARAM_INT);
        $query -> bindParam(":nombreSucursal", $datos["nombreSucursal"], PDO::PARAM_STR);
        $query -> bindParam(":sucursalID", $datos["sucursalID"], PDO::PARAM_INT);

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

    public static function delete($tablaSucursal, $sucursalID){

        // Preparando consulta de eliminación de datos de una tabla.
        $query = Connection::connect()->prepare(

            " DELETE FROM $tablaSucursal WHERE sucursalID = :sucursalID;"
        );

        // Definiendo las variables de la consulta.
        $query -> bindParam(":sucursalID", $sucursalID, PDO::PARAM_INT);

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