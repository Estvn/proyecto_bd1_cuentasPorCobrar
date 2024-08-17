<?php

//require_once "../connection.php";

class DetalleCuotaModel {

    public static function create($tablaDetalleCuota, $datos) {
        // Preparación de la consulta de inserción.
        $query = Connection::connect()->prepare(
            "INSERT INTO detalleCuota (
    deudaID, 
    fechaVencimiento, 
    fechaPagado, 
    estado
) VALUES (
    :deudaID, 
    :fechaVencimiento, 
    :fechaPagado, 
    :estado
);
"
        );

        // Definiendo las variables de la consulta
        $query->bindParam(':deudaID', $datos['deudaID'], PDO::PARAM_INT);
        $query->bindParam(':fechaVencimiento', $datos['fechaVencimiento']);
        $query->bindParam(':fechaPagado', $datos['fechaPagado']);
        $query->bindParam(':estado', $datos['estado'], PDO::PARAM_STR);
       

        // Respuesta que se enviará al controlador que llamó a este método.
        if($query->execute()) {
            return "ok";
        } else {
            print_r(Connection::connect()->errorInfo());
            return "error";
        }

        $query->closeCursor();
        $query = null;
    }

    public static function readOne($tablaDetalleCuota, $detalleCuotaID) {
        // Preparación de la consulta de lectura.
        $query = Connection::connect()->prepare(
            "SELECT DEUDA.valorCuota as valorDeuda, DEUDA.montoDeuda, DEUDA.pagado,
            $tablaDetalleCuota.fechaVencimiento, $tablaDetalleCuota.fechaPagado, 
            $tablaDetalleCuota.estado, $tablaDetalleCuota.valorCuota, 
            FROM $tablaDetalleCuota
            INNER JOIN DEUDA ON $tablaDetalleCuota.deudaID = DEUDA.deudaID
            WHERE $tablaDetalleCuota.detalleCuotaID = :detalleCuotaID"
        );
    
        // Definiendo las variables de la consulta
        $query->bindParam(':detalleCuotaID', $detalleCuotaID, PDO::PARAM_INT);
    
        // Ejecución de la consulta.
        $query->execute();
    
        // Capturando los datos pedidos por la consulta.
        $result = $query->fetchAll(PDO::FETCH_CLASS);
    
        // Finalizando la variable de consulta, y retornando los datos solicitados.
        $query->closeCursor();
        $query = null;
        return $result;
    }

    public static function readAll($tablaDetalleCuota) {
        // Preparación de la consulta de lectura.
        $query = Connection::connect()->prepare(
            "SELECT DEUDA.valorCuota as valorDeuda, DEUDA.montoDeuda, DEUDA.pagado,
            $tablaDetalleCuota.fechaVencimiento, $tablaDetalleCuota.fechaPagado, 
            $tablaDetalleCuota.estado, $tablaDetalleCuota.valorCuota, 
            FROM $tablaDetalleCuota
            INNER JOIN DEUDA ON $tablaDetalleCuota.deudaID = DEUDA.deudaID;"
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
    
    public static function update($tablaDetalleCuota, $datos) {
        // Preparado la consulta para alterar una tabla.
        $query = Connection::connect()->prepare(
            "UPDATE $tablaDetalleCuota 
             SET deudaID = :deudaID,
            fechaVencimiento = :fechaVencimiento,
            fechaPagado = :fechaPagado,
            estado = :estado,
            valorCuota = :valorCuota 
             WHERE detalleCuotaID = :detalleCuotaID"
        );

        // Definiendo las variables de la consulta
        $query->bindParam(':deudaID', $datos['deudaID'], PDO::PARAM_INT);
        $query->bindParam(':fechaVencimiento', $datos['fechaVencimiento']);
        $query->bindParam(':fechaPagado', $datos['fechaPagado']);
        $query->bindParam(':estado', $datos['estado'], PDO::PARAM_STR);
        $query->bindParam(':valorCuota', $datos['valorCuota'], PDO::PARAM_STR);
        $query->bindParam(':detalleCuotaID', $datos['detalleCuotaID'], PDO::PARAM_INT);

        // Respuesta que se enviará al controlador que usó este método.
        if($query->execute()) {
            return "ok";
        } else {
            print_r(Connection::connect()->errorInfo());
            return "error";
        }

        // Finalizando la variable de consulta
        $query->closeCursor();
        $query = null;
    }

    public static function delete($tablaDetalleCuota, $detalleCuotaID) {
        // Preparando consulta de eliminación de datos de una tabla
        $query = Connection::connect()->prepare(
            "DELETE FROM $tablaDetalleCuota WHERE detalleCuotaID = :detalleCuotaID"
        );

        // Definiendo las variables de la consulta
        $query->bindParam(':detalleCuotaID', $detalleCuotaID, PDO::PARAM_INT);

        // Respuesta que se envía al controlador que utilizó este método
        if($query->execute()) {
            return "ok";
        } else {
            print_r(Connection::connect()->errorInfo());
            return "error";
        }

        // Finalizando variable de consulta
        $query->closeCursor();
        $query = null;
    }
}
