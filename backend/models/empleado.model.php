<?php

//require_once "../connection.php";

class EmpleadoModel{

    public static function create($tablaEmpleado, $datos){

        // Preparación de la consulta de inserción.
        $query = Connection::connect()->prepare(

            " INSERT INTO $tablaEmpleado 
            (direccionID, generoID, sucursalID, pNombre, sNombre, pApellido, sApellido, fechaNacimiento, nIdentidad, create_at)
            VALUES
            (:direccionID, :generoID, :sucursalID, :pNombre, :sNombre, :pApellido, :sApellido, :fechaNacimiento, :nIdentidad, CURRENT DATE)
            "
        );

        // Definiendo las variables de la consulta
        $query -> bindParam(":direccionID", $datos["direccionID"], PDO::PARAM_INT);
        $query -> bindParam(":generoID", $datos["generoID"], PDO::PARAM_INT);
        $query -> bindParam(":sucursalID", $datos["sucursalID"], PDO::PARAM_INT);
        $query -> bindParam(":pNombre", $datos["pNombre"], PDO::PARAM_STR);
        $query -> bindParam(":sNombre", $datos["sNombre"], PDO::PARAM_STR);
        $query -> bindParam(":pApellido", $datos["pApellido"], PDO::PARAM_STR);
        $query -> bindParam(":sApellido", $datos["sApellido"], PDO::PARAM_STR);
        $query -> bindParam(":fechaNacimiento", $datos["fechaNacimiento"], PDO::PARAM_STR);
        $query -> bindParam(":nIdentidad", $datos["nIdentidad"], PDO::PARAM_STR);

        // Respuesta que se enviará al controlador que llamo a este método.
        if($query -> execute()){
            return "ok";
        }else{
            print_r(Connection::connect()->errorInfo());
        }

        $query -> closeCursor();
        $query = null;
    }

    public static function readOne($tablaEmpleado, $empleadoID){

        // Preparación de la consulta de lectura.
        $query = Connection::connect() -> prepare(

            " SELECT DIRECCION.departamento, DIRECCION.municipio, 
            GENERO.tipoGenero, 
            SUCURSAL.nombreSucursal, 
            $tablaEmpleado.pNombre, $tablaEmpleado.sNombre, $tablaEmpleado.pApellido,
            $tablaEmpleado.sApellido, $tablaEmpleado.fechaNacimiento, $tablaEmpleado.nIdentidad
            FROM $tablaEmpleado
            INNER JOIN DIRECCION ON $tablaEmpleado.direccionID = DIRECCION.direccionID
            INNER JOIN GENERO ON $tablaEmpleado.generoID = GENERO.generoID
            INNER JOIN SUCURSAL ON $tablaEmpleado.sucursalID = SUCURSAL.sucursalID
            where empleadoID = :empleadoID;
             "
        );

        // Definiendo las variables de la consulta
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

    public static function readAll($tablaEmpleado){

        // Preparación de la consulta de lectura.
        $query = Connection::connect() -> prepare(

            " SELECT DIRECCION.departamento, DIRECCION.municipio,
            GENERO.tipoGenero, 
            SUCURSAL.nombreSucursal,
            $tablaEmpleado.empleadoID, $tablaEmpleado.pNombre, $tablaEmpleado.sNombre, $tablaEmpleado.pApellido,
            $tablaEmpleado.sApellido, $tablaEmpleado.fechaNacimiento, $tablaEmpleado.nIdentidad
            FROM $tablaEmpleado
            INNER JOIN DIRECCION ON $tablaEmpleado.direccionID = DIRECCION.direccionID
            INNER JOIN GENERO ON $tablaEmpleado.generoID = GENERO.generoID
            INNER JOIN SUCURSAL ON $tablaEmpleado.sucursalID = SUCURSAL.sucursalID
            ORDER BY ($tablaEmpleado.pNombre || $tablaEmpleado.sNombre || $tablaEmpleado.pApellido || $tablaEmpleado.sApellido) ASC;
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

    public static function update($tablaEmpleado, $datos, $empleadoID){

        // Preparado la consulta para alterar una tabla.
        $query = Connection::connect()->prepare(

            " UPDATE $tablaEmpleado SET
                direccionID = :direccionID,
                generoID = :generoID,
                sucursalID = :sucursalID,
                pNombre = :pNombre,
                sNombre = :sNombre,
                pApellido = :pApellido,
                sApellido = :sApellido,
                fechaNacimiento = :fechaNacimiento,
                nIdentidad = :nIdentidad
                WHERE empleadoID = :empleadoID;
            "
        );

        // Definiendo las variables de la consulta.
        $query -> bindParam(":direccionID", $datos["direccionID"], PDO::PARAM_INT);
        $query -> bindParam(":generoID", $datos["generoID"], PDO::PARAM_INT);
        $query -> bindParam(":sucursalID", $datos["sucursalID"], PDO::PARAM_INT);
        $query -> bindParam(":pNombre", $datos["pNombre"], PDO::PARAM_STR);
        $query -> bindParam(":sNombre", $datos["sNombre"], PDO::PARAM_STR);
        $query -> bindParam(":pApellido", $datos["pApellido"], PDO::PARAM_STR);
        $query -> bindParam(":sApellido", $datos["sApellido"], PDO::PARAM_STR);
        $query -> bindParam(":fechaNacimiento", $datos["fechaNacimiento"], PDO::PARAM_STR);
        $query -> bindParam(":nIdentidad", $datos["nIdentidad"], PDO::PARAM_STR);
        $query -> bindParam(":empleadoID", $empleadoID, PDO::PARAM_INT);

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

    /*
    public static function delete($tablaEmpleado, $empleadoID){

        // Preparando consulta de eliminación de datos de una tabla.
        $query = Connection::connect()->prepare(

            " DELETE FROM $tablaEmpleado WHERE empleadoID = :empleadoID"
        );

        // Definiendo las variables de la consulta.
        $query -> bindParam(":empleadoID", $empleadoID, PDO::PARAM_INT);


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