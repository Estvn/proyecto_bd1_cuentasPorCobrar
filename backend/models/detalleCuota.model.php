<?php

//require_once "../connection.php";

class DetalleCuotaModel {

    public static function create($tablaDetalleCuota, $datos) {
        // Preparación de la consulta de inserción.
        $pdo = Connection::connect();
        // Definiendo las variables de la consulta
        $deudaID = $datos['deudaID'];  // Asegúrate de sanitizar $datos['deudaID'] para evitar inyecciones SQL
        $numeroDeRegistros = $datos['tipoPlazo']; // Número de registros a insertar
        
        // Obtén la última fecha de vencimiento
        $sql = "SELECT CURRENT DATE AS fechaVencimiento FROM SYSIBM.SYSDUMMY1;
 
                   ";
        $stmt = $pdo->query($sql);
        $ultimaFecha = $stmt->fetchColumn();
        
        $fechaVencimiento = new DateTime($ultimaFecha);
        
        // Insertar los registros
        for ($i = 0; $i < $numeroDeRegistros; $i++) {
            $fechaVencimiento->modify('+1 month');
            $fecha = $fechaVencimiento->format('Y-m-d');
        
            $sql = "INSERT INTO detalleCuota (deudaID, fechaVencimiento, estado) VALUES (:deudaID, :fechaVencimiento, '0')";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':deudaID' => $deudaID,
                ':fechaVencimiento' => $fecha,
            ]);
        }

       

        // Respuesta que se enviará al controlador que llamó a este método.
        if($i == $numeroDeRegistros ) {
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
            $tablaDetalleCuota.estado, $tablaDetalleCuota.valorCuota, $tablaDetalleCuota.deudaID
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

    public static function readAllByDeuda($tablaDetalleCuota, $deudaID) {
        // Preparación de la consulta de lectura.
        $query = Connection::connect()->prepare(
            "SELECT DEUDA.valorCuota as valorDeuda, DEUDA.montoDeuda, DEUDA.pagado,
            $tablaDetalleCuota.fechaVencimiento, $tablaDetalleCuota.fechaPagado, 
            $tablaDetalleCuota.estado, $tablaDetalleCuota.valorCuota
            FROM $tablaDetalleCuota
            INNER JOIN DEUDA ON $tablaDetalleCuota.deudaID = DEUDA.deudaID
            where $tablaDetalleCuota.deudaID = :deudaID
            ;"
        );

        $query->bindParam(':deudaID', $deudaID, PDO::PARAM_INT);
    
        // Ejecución de la consulta.
        $query->execute();
    
        // Capturando los datos pedidos por la consulta.
        $result = $query->fetchAll(PDO::FETCH_CLASS);
    
        // Finalizando la variable de consulta, y retornando los datos solicitados.
        $query->closeCursor();
        $query = null;
        return $result;
    }
    
    public static function update($tablaDetalleCuota, $detalleCuotaID) {
        // Preparado la consulta para alterar una tabla.
        $query = Connection::connect()->prepare(
            "UPDATE $tablaDetalleCuota 
            SET estado = '1',
            WHERE detalleCuotaID = :detalleCuotaID"
        );

        // Definiendo las variables de la consulta
        $query->bindParam(':detalleCuotaID', $detalleCuotaID, PDO::PARAM_INT);

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

    /*
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
        */
}
