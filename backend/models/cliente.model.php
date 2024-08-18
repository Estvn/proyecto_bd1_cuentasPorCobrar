<?php

//require_once "../connection.php";

class ClienteModel{

    public static function create($tablaCliente, $datos){

        // Preparación de la consulta de inserción.
        $query = Connection::connect()->prepare(

            " INSERT INTO $tablaCliente
            (direccionID, generoID, antiguedadID, pNombre, sNombre, pApellido, sApellido, fechaNacimiento, 
             nIdentidad, creditoDisponible, lineaDisponible, nomEmpresa, telEmpresa, sueldo, create_at, estado)
            VALUES
            (:direccionID, :generoID, :antiguedadID, :pNombre, :sNombre, :pApellido, :sApellido, :fechaNacimiento,
             :nIdentidad, :creditoDisponible, :lineaDisponible, :nomEmpresa, :telEmpresa, :sueldo, CURRENT DATE, 0)
            "
        );

        // Definiendo las variables de la consulta
        $query -> bindParam(":direccionID", $datos["direccionID"], PDO::PARAM_INT);
        $query -> bindParam(":generoID", $datos["generoID"], PDO::PARAM_INT);
        $query -> bindParam(":antiguedadID", $datos["antiguedadID"], PDO::PARAM_INT);
        $query -> bindParam(":pNombre", $datos["pNombre"], PDO::PARAM_STR);
        $query -> bindParam(":sNombre", $datos["sNombre"], PDO::PARAM_STR);
        $query -> bindParam(":pApellido", $datos["pApellido"], PDO::PARAM_STR);
        $query -> bindParam(":sApellido", $datos["sApellido"], PDO::PARAM_STR);
        $query -> bindParam(":fechaNacimiento", $datos["fechaNacimiento"], PDO::PARAM_STR);
        $query -> bindParam(":nIdentidad", $datos["nIdentidad"], PDO::PARAM_STR);
        $query -> bindParam(":creditoDisponible", $datos["creditoDisponible"], PDO::PARAM_STR);
        $query -> bindParam(":lineaDisponible", $datos["lineaDisponible"], PDO::PARAM_STR);
        $query -> bindParam(":nomEmpresa", $datos["nomEmpresa"], PDO::PARAM_STR);
        $query -> bindParam(":telEmpresa", $datos["telEmpresa"], PDO::PARAM_STR);
        $query -> bindParam(":sueldo", $datos["sueldo"], PDO::PARAM_STR);


        // Respuesta que se enviará al controlador que llamo a este método.
        if($query -> execute()){
            return "ok";
        }else{
            print_r(Connection::connect()->errorInfo());
        }

        $query -> closeCursor();
        $query = null;
    }

    public static function readOne($tablaCliente, $clienteID){

        // Preparación de la consulta de lectura.
        $query = Connection::connect() -> prepare(

            " SELECT DIRECCION.departamento, DIRECCION.municipio, 
            GENERO.tipoGenero, 
            ANTIGUEDAD.tipoAntiguedad, 
            $tablaCliente.pNombre, $tablaCliente.sNombre, $tablaCliente.pApellido,
            $tablaCliente.sApellido, $tablaCliente.fechaNacimiento, $tablaCliente.nIdentidad,
            $tablaCliente.creditoDisponible, $tablaCliente.lineaDisponible, $tablaCliente.nomEmpresa,
            $tablaCliente.telEmpresa, $tablaCliente.sueldo
            FROM $tablaCliente
            INNER JOIN DIRECCION ON $tablaCliente.direccionID = DIRECCION.direccionID
            INNER JOIN GENERO ON $tablaCliente.generoID = GENERO.generoID
            INNER JOIN ANTIGUEDAD ON $tablaCliente.antiguedadID = ANTIGUEDAD.antiguedadID
            where clienteID = :clienteID;
             "
        );

        // Definiendo las variables de la consulta
        $query -> bindParam(":clienteID", $clienteID, PDO::PARAM_INT);

        // Ejecución de la consulta.
        $query->execute();

        // Capturando los datos pedidos por la consulta.
        $result = $query->fetchAll(PDO::FETCH_CLASS);

        // Finalizando la variable de consulta, y retornando los datos solicitados.
        $query->closeCursor();
        $query=null;
        return $result;
    }

    public static function readAllByState($tablaCliente, $estado){

        // Preparación de la consulta de lectura.
        $query = Connection::connect() -> prepare(

            " SELECT DIRECCION.departamento, DIRECCION.municipio, 
            GENERO.tipoGenero, 
            ANTIGUEDAD.tipoAntiguedad, 
            $tablaCliente.clienteID, $tablaCliente.pNombre, $tablaCliente.sNombre, $tablaCliente.pApellido,
            $tablaCliente.sApellido, $tablaCliente.fechaNacimiento, $tablaCliente.nIdentidad,
            $tablaCliente.creditoDisponible, $tablaCliente.lineaDisponible, $tablaCliente.nomEmpresa,
            $tablaCliente.telEmpresa, $tablaCliente.sueldo
            FROM $tablaCliente
            INNER JOIN DIRECCION ON $tablaCliente.direccionID = DIRECCION.direccionID
            INNER JOIN GENERO ON $tablaCliente.generoID = GENERO.generoID
            INNER JOIN ANTIGUEDAD ON $tablaCliente.antiguedadID = ANTIGUEDAD.antiguedadID
            WHERE $tablaCliente.estado = :estado
            ORDER BY ($tablaCliente.pNombre || $tablaCliente.sNombre || $tablaCliente.pApellido || $tablaCliente.sApellido) ASC;
            "
        );

        $query -> bindParam(":estado", $estado, PDO::PARAM_STR);

        // Ejecución de la consulta.
        $query->execute();

        // Capturando los datos pedidos por la consulta.
        $result = $query->fetchAll(PDO::FETCH_CLASS);

        // Finalizando la variable de consulta, y retornando los datos solicitados.
        $query->closeCursor();
        $query=null;
        return $result;
    }

    public static function readAll($tablaCliente){

        // Preparación de la consulta de lectura.
        $query = Connection::connect() -> prepare(

            " SELECT DIRECCION.departamento, DIRECCION.municipio, 
            GENERO.tipoGenero, 
            ANTIGUEDAD.tipoAntiguedad, 
            $tablaCliente.clienteID, $tablaCliente.pNombre, $tablaCliente.sNombre, $tablaCliente.pApellido,
            $tablaCliente.sApellido, $tablaCliente.fechaNacimiento, $tablaCliente.nIdentidad,
            $tablaCliente.creditoDisponible, $tablaCliente.lineaDisponible, $tablaCliente.nomEmpresa,
            $tablaCliente.telEmpresa, $tablaCliente.sueldo
            FROM $tablaCliente
            INNER JOIN DIRECCION ON $tablaCliente.direccionID = DIRECCION.direccionID
            INNER JOIN GENERO ON $tablaCliente.generoID = GENERO.generoID
            INNER JOIN ANTIGUEDAD ON $tablaCliente.antiguedadID = ANTIGUEDAD.antiguedadID
            ORDER BY ($tablaCliente.pNombre || $tablaCliente.sNombre || $tablaCliente.pApellido || $tablaCliente.sApellido) ASC;
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

    public static function update($tablaCliente, $datos, $clienteID){

        // Preparado la consulta para alterar una tabla.
        $query = Connection::connect()->prepare(

            " UPDATE $tablaCliente SET
                direccionID = :direccionID,
                generoID = :generoID,
                antiguedadID = :antiguedadID,
                pNombre = :pNombre,
                sNombre = :sNombre,
                pApellido = :pApellido,
                sApellido = :sApellido,
                fechaNacimiento = :fechaNacimiento,
                nIdentidad = :nIdentidad,
                creditoDisponible = :creditoDisponible,
                lineaDisponible = :lineaDisponible,
                nomEmpresa = :nomEmpresa,
                telEmpresa = :telEmpresa,
                sueldo = :sueldo
                WHERE clienteID = :clienteID;
            "
        );

        // Definiendo las variables de la consulta.
        $query -> bindParam(":direccionID", $datos["direccionID"], PDO::PARAM_INT);
        $query -> bindParam(":generoID", $datos["generoID"], PDO::PARAM_INT);
        $query -> bindParam(":antiguedadID", $datos["antiguedadID"], PDO::PARAM_INT);
        $query -> bindParam(":pNombre", $datos["pNombre"], PDO::PARAM_STR);
        $query -> bindParam(":sNombre", $datos["sNombre"], PDO::PARAM_STR);
        $query -> bindParam(":pApellido", $datos["pApellido"], PDO::PARAM_STR);
        $query -> bindParam(":sApellido", $datos["sApellido"], PDO::PARAM_STR);
        $query -> bindParam(":fechaNacimiento", $datos["fechaNacimiento"], PDO::PARAM_STR);
        $query -> bindParam(":nIdentidad", $datos["nIdentidad"], PDO::PARAM_STR);
        $query -> bindParam(":creditoDisponible", $datos["creditoDisponible"], PDO::PARAM_STR);
        $query -> bindParam(":lineaDisponible", $datos["lineaDisponible"], PDO::PARAM_STR);
        $query -> bindParam(":nomEmpresa", $datos["nomEmpresa"], PDO::PARAM_STR);
        $query -> bindParam(":telEmpresa", $datos["telEmpresa"], PDO::PARAM_STR);
        $query -> bindParam(":sueldo", $datos["sueldo"], PDO::PARAM_STR);
        $query -> bindParam(":clienteID", $clienteID, PDO::PARAM_INT);

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

    public static function updateClientState($tablaCliente, $clienteID){

        // Preparado la consulta para alterar una tabla.
        $query = Connection::connect()->prepare(

            " UPDATE $tablaCliente SET
                estado = 1
                WHERE clienteID = :clienteID;
            "
        );

        // Definiendo las variables de la consulta.
        $query -> bindParam(":clienteID", $clienteID, PDO::PARAM_INT);

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

    public static function updateCreditLineClient($tablaCliente, $clienteID, $lineaCredito){

        // Preparado la consulta para alterar una tabla.
        $query = Connection::connect()->prepare(

            " UPDATE $tablaCliente SET
                creditoDisponible = :lineaCredito
                WHERE clienteID = :clienteID;
            "
        );

        // Definiendo las variables de la consulta.
        $query -> bindParam(":clienteID", $clienteID, PDO::PARAM_INT);
        $query -> bindParam(":lineaCredito", $lineaCredito, PDO::PARAM_STR);


        // Respuesta que se enviará al controllador que usó este método.
        if($query -> execute()){
            return;
        }else{
            print_r(Connection::connect()->errorInfo());
        }

        // Finalizando la variable de consulta.
        $query -> closeCursor();
        $query = null;
    }



    public static function delete($tablaCliente, $clienteID){

        // Preparando consulta de eliminación de datos de una tabla.
        $query = Connection::connect()->prepare(

            " DELETE FROM $tablaCliente WHERE clienteID = :clienteID"
        );

        // Definiendo las variables de la consulta.
        $query -> bindParam(":clienteID", $clienteID, PDO::PARAM_INT);

        // Respuesta que se envía al controlador que utilizó este método.
        if($query->execute()){
          return "ok";
        }else{
            print_r(Connection::connect()->errorInfo());
        }

        // Finalizando variable de consulta.
        $query->closeCursor();
        $query = null;
    }//
    
}