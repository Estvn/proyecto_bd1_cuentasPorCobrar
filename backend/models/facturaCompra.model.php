<?php

//require_once "../connection.php";

class FacturaCompraModel {

    public static function create($tablaFacturaCompra, $datos) {
        // Preparación de la consulta de inserción.
        $query = Connection::connect()->prepare(
            "INSERT INTO facturaCompra (
    clienteID, 
    empleadoID, 
    plazoID, 
    fechaCompra, 
    total
) VALUES (
    :clienteID,
    :empleadoID,
    :plazoID,
    CURRENT TIMESTAMP,
    :total
);"
        );

        // Definiendo las variables de la consulta
        $query->bindParam(':clienteID', $datos['clienteID'], PDO::PARAM_INT);
        $query->bindParam(':empleadoID', $datos['empleadoID'], PDO::PARAM_INT);
        $query->bindParam(':plazoID', $datos['plazoID'], PDO::PARAM_INT);    
        $query->bindParam(':total', $datos['total'], PDO::PARAM_STR);    

        // Respuesta que se enviará al controlador que llamó a este método.
        if ($query->execute()) {
            return "ok";
        } else {
            print_r(Connection::connect()->errorInfo());
            return "error";
        }

        $query->closeCursor();
        $query = null;
    }

    public static function readOne($tablaFacturaCompra, $facturaCompraID) {
        // Preparación de la consulta de lectura.
        $query = Connection::connect()->prepare(
            "SELECT CLIENTE.nIdentidad, (CLIENTE.pNombre || ' ' || CLIENTE.pApellido) as nombreCliente,
                    EMPLEADO.nIdentidad, (EMPLEADO.pNombre || ' ' || EMPLEADO.pApellido) as nombreEmpleado,
                    PLAZO.tipoPlazo,
                    DEUDA.valorCuota, DEUDA.pagado,
                    $tablaFacturaCompra.fechaCompra, $tablaFacturaCompra.total
             FROM $tablaFacturaCompra
                INNER JOIN CLIENTE ON $tablaFacturaCompra.clienteID = CLIENTE.clienteID
                INNER JOIN EMPLEADO ON $tablaFacturaCompra.empleadoID = EMPLEADO.empleadoID
                INNER JOIN PLAZO ON $tablaFacturaCompra.plazoID = PLAZO.plazoID
                INNER JOIN DEUDA ON $tablaFacturaCompra.facturaCompraID = DEUDA.facturaCompraID
             WHERE $tablaFacturaCompra.facturaCompraID = :facturaCompraID;"
        );

        // Definiendo las variables de la consulta
        $query->bindParam(':facturaCompraID', $facturaCompraID, PDO::PARAM_INT);

        // Ejecución de la consulta.
        $query->execute();

        // Capturando los datos pedidos por la consulta.
        $result = $query->fetchAll(PDO::FETCH_CLASS);

        // Finalizando la variable de consulta, y retornando los datos solicitados.
        $query->closeCursor();
        $query = null;
        return $result;
    }

    public static function readAllByClient($tablaFacturaCompra, $clienteID) {
        // Preparación de la consulta de lectura.
        $query = Connection::connect()->prepare(
            "SELECT CLIENTE.nIdentidad, (CLIENTE.pNombre || ' ' || CLIENTE.pApellido) as nombreCliente,
                    EMPLEADO.nIdentidad, (EMPLEADO.pNombre || ' ' || EMPLEADO.pApellido) as nombreEmpleado,
                    PLAZO.tipoPlazo,
                    DEUDA.valorCuota, DEUDA.pagado,
                    $tablaFacturaCompra.fechaCompra, $tablaFacturaCompra.total
             FROM $tablaFacturaCompra
                INNER JOIN CLIENTE ON $tablaFacturaCompra.clienteID = CLIENTE.clienteID
                INNER JOIN EMPLEADO ON $tablaFacturaCompra.empleadoID = EMPLEADO.empleadoID
                INNER JOIN PLAZO ON $tablaFacturaCompra.plazoID = PLAZO.plazoID
                INNER JOIN DEUDA ON $tablaFacturaCompra.facturaCompraID = DEUDA.facturaCompraID
             WHERE $tablaFacturaCompra.clienteID = :clienteID"
        );

         // Definiendo las variables de la consulta
         $query->bindParam(':clienteID', $clienteID, PDO::PARAM_INT);

        // Ejecución de la consulta.
        $query->execute();

        // Capturando los datos pedidos por la consulta.
        $result = $query->fetchAll(PDO::FETCH_CLASS);

        // Finalizando la variable de consulta, y retornando los datos solicitados.
        $query->closeCursor();
        $query = null;
        return $result;
    }
    public static function readIdOld($tablaFacturaCompra) {
        // Preparación de la consulta de lectura.
        $query = Connection::connect()->prepare(
            "
SELECT $tablaFacturaCompra.facturaCompraID, PLAZO.tipoPlazo 
FROM $tablaFacturaCompra
inner join PLAZO ON $tablaFacturaCompra.plazoID = PLAZO.plazoID
ORDER BY $tablaFacturaCompra.facturaCompraID DESC 
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


    /*
    public static function update($tablaFacturaCompra, $datos) {
        // Preparado la consulta para alterar una tabla.
        $query = Connection::connect()->prepare(
            "UPDATE $tablaFacturaCompra 
             SET clienteID = :clienteID,
                 empleadoID = :empleadoID,
                 deudaID = :deudaID,
                 fechaCompra = :fechaCompra,
                 total = :total,
                 pagado = :pagado 
             WHERE facturaCompraID = :facturaCompraID"
        );

        // Definiendo las variables de la consulta
        $query->bindParam(':clienteID', $datos['clienteID'], PDO::PARAM_INT);
        $query->bindParam(':empleadoID', $datos['empleadoID'], PDO::PARAM_INT);
        $query->bindParam(':deudaID', $datos['deudaID'], PDO::PARAM_INT);
        $query->bindParam(':fechaCompra', $datos['fechaCompra']);
        $query->bindParam(':total', $datos['total'], PDO::PARAM_STR);
        $query->bindParam(':pagado', $datos['pagado'], PDO::PARAM_STR);
        $query->bindParam(':facturaCompraID', $datos['facturaCompraID'], PDO::PARAM_INT);

        // Respuesta que se enviará al controlador que usó este método.
        if ($query->execute()) {
            return "ok";
        } else {
            print_r(Connection::connect()->errorInfo());
            return "error";
        }

        // Finalizando la variable de consulta
        $query->closeCursor();
        $query = null;
    }

    public static function delete($tablaFacturaCompra, $facturaCompraID) {
        // Preparando consulta de eliminación de datos de una tabla
        $query = Connection::connect()->prepare(
            "DELETE FROM $tablaFacturaCompra WHERE facturaCompraID = :facturaCompraID;"
        );

        // Definiendo las variables de la consulta
        $query->bindParam(':facturaCompraID', $facturaCompraID, PDO::PARAM_INT);

        // Respuesta que se envía al controlador que utilizó este método
        if ($query->execute()) {
            return "ok";
        } else {
            print_r(Connection::connect()->errorInfo());
            return "error";
        }

        // Finalizando variable de consulta
        $query->closeCursor();
        $query = null;
    }
        */
}
