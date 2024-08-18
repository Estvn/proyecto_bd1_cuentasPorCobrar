<?php

//require_once "../connection.php";

class DeudaModel{

    public static function createFromFactura($tablaDeuda, $datos){

        // Preparación de la consulta de inserción.
        $query = Connection::connect()->prepare(

            " INSERT INTO $tablaDeuda
            (clienteID, facturaCompraID, valorCuota, pagado)
            VALUES
            (:clienteID,:facturaCompraID,:valorCuota,'0')
            "
        );
        $valorCuota = $datos["total"]/$datos["tipoPlazo"];
        // Definiendo las variables de la consulta
        $query -> bindParam(":clienteID", $datos["clienteID"], PDO::PARAM_INT);    
        $query -> bindParam(":facturaCompraID", $datos["facturaCompraID"], PDO::PARAM_INT);
        $query -> bindParam(":valorCuota",$valorCuota, PDO::PARAM_STR);        

        // Respuesta que se enviará al controlador que llamo a este método.
        if($query->execute()){
        
            return "ok";
        }else{
            print_r(Connection::connect()->errorInfo());
        }

        $query -> closeCursor();
        $query = null;
    }

    public static function readOne($tablaDeuda, $deudaID){

        // Preparación de la consulta de lectura.
        $query = Connection::connect() -> prepare(

            " SELECT CLIENTE.clienteID, CLIENTE.nIdentidad, (CLIENTE.pNombre || ' ' || CLIENTE.pApellido) as nombreCliente,
            $tablaDeuda.valorCuota, $tablaDeuda.pagado
            FACTURACOMPRA.total as total
            FROM $tablaDeuda
            INNER JOIN CLIENTE ON $tablaDeuda.clienteID = CLIENTE.clienteID
            INNER JOIN FACTURACOMPRA ON $tablaDeuda.facturaCompraID = FACTURACOMPRA.facturaCompraID
            WHERE deudaID = :deudaID;
            "
        );

        // Definiendo las variables de la consulta
        $query -> bindParam(":deudaID", $deudaID, PDO::PARAM_INT);

        // Ejecución de la consulta.
        $query->execute();

        // Capturando los datos pedidos por la consulta.
        $result = $query->fetchAll(PDO::FETCH_CLASS);

        // Finalizando la variable de consulta, y retornando los datos solicitados.
        $query->closeCursor();
        $query=null;
        return $result;
    }

    public static function readAllByClient($tablaDeuda, $clienteID, $pagado){

        // Preparación de la consulta de lectura.
        $query = Connection::connect() -> prepare(

            " SELECT CLIENTE.nIdentidad, (CLIENTE.pNombre || ' '  || CLIENTE.pApellido) as nombreCliente,
            $tablaDeuda.valorCuota, $tablaDeuda.pagado
            FROM $tablaDeuda
            INNER JOIN CLIENTE ON $tablaDeuda.clienteID = CLIENTE.clienteID
            where $tablaDeuda.clienteID = :clienteID and $tablaDeuda.pagado = :pagado
            "
        );

        $query -> bindParam(":clienteID", $clienteID, PDO::PARAM_INT);
        $query -> bindParam(":pagado", $pagado, PDO::PARAM_INT);

        // Ejecución de la consulta.
        $query->execute();

        // Capturando los datos pedidos por la consulta.
        $result = $query->fetchAll(PDO::FETCH_CLASS);

        // Finalizando la variable de consulta, y retornando los datos solicitados.
        $query->closeCursor();
        $query=null;
        return $result;
    }

    public static function readIdOld($tablaDeuda) {
        // Preparación de la consulta de lectura.
        $query = Connection::connect()->prepare(
            "
SELECT $tablaDeuda.deudaID 
FROM $tablaDeuda
ORDER BY $tablaDeuda.facturaCompraID DESC 
LIMIT 1;"
        );
        // Ejecución de la consulta.
        $query->execute();

        // Capturando los datos pedidos por la consulta.
        $result = $query->fetchAll(PDO::FETCH_CLASS);

        // Finalizando la variable de consulta, y retornando los datos solicitados.
        $query->closeCursor();
        $query = null;
        return $result;
    }

    public static function updateStateToPayed($tablaDeuda, $datos){

        // Preparado la consulta para alterar una tabla.
        $query = Connection::connect()->prepare(

            " UPDATE $tablaDeuda SET
                clienteID = :clienteID,
                plazoID = :plazoID,
                valorCuota = :valorCuota,
                montoDeuda = :montoDeuda,
                pagado = :pagado
                WHERE deudaID = :deudaID;
            "
        );

        // Definiendo las variables de la consulta.
        $query -> bindParam(":clienteID", $datos["clienteID"], PDO::PARAM_INT);
        $query -> bindParam(":plazoID", $datos["plazoID"], PDO::PARAM_INT);
        $query -> bindParam(":valorCuota", $datos["valorCuota"], PDO::PARAM_STR);
        $query -> bindParam(":montoDeuda", $datos["montoDeuda"], PDO::PARAM_STR);
        $query -> bindParam(":pagado", $datos["pagado"], PDO::PARAM_STR);
        $query -> bindParam(":deudaID", $datos["deudaID"], PDO::PARAM_INT);

        // Respuesta que se enviará al controlador que usó este método.
        if($query -> execute()){
            return "ok";
        }else{
            print_r(Connection::connect()->errorInfo());
        }

        // Finalizando la variable de consulta.
        $query -> closeCursor();
        $query = null;
    }

    public static function delete($tablaDeuda, $deudaID){

        // Preparando consulta de eliminación de datos de una tabla.
        $query = Connection::connect()->prepare(

            " DELETE FROM $tablaDeuda WHERE deudaID = :deudaID;"
        );

        // Definiendo las variables de la consulta.
        $query -> bindParam(":deudaID", $deudaID, PDO::PARAM_INT);

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
