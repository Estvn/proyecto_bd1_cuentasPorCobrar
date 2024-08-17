<?php

//require_once "../connection.php";



class ArticuloXFacturaCompraModel {

    public static function create($tablaArticuloXFacturaCompra, $datos) {
        // Preparación de la consulta de inserción.
        $query = Connection::connect()->prepare(
            "INSERT INTO $tablaArticuloXFacturaCompra (facturaCompraID, articuloID) 
             VALUES (:facturaCompraID, :articuloID);"
        );

        // Definiendo las variables de la consulta
        $query->bindParam(':facturaCompraID', $datos['facturaCompraID'], PDO::PARAM_INT);
        $articulos = count( $datos['articulos'][0][0]);
        $count = 0;

        for ($count; $count < $articulos ; $count++) {                      
            $query->bindParam(':articuloID', $datos['articulos'][0][0][$count]['id'], PDO::PARAM_STR);            
           $query->execute(); 
        }        
      
        // Respuesta que se enviará al controlador que llamó a este método.
        if ($count == $articulos) {
            return "ok";
        } else {
            print_r(Connection::connect()->errorInfo());
            return "error";
        }

        $query->closeCursor();
        $query = null;
    }

    public static function readOne($tablaArticuloXFacturaCompra, $facturaCompraID, $articuloID) {
        
        // Preparación de la consulta de lectura.
        $query = Connection::connect()->prepare(
            "SELECT 
                FACTURACOMPRA.fechaCompra, FACTURACOMPRA.total as totalFactura, FACTURACOMPRA.pagado,
                CLIENTE.nIdentidad as idCliente, (CLIENTE.pNombre || ' ' || CLIENTE.pApellido) as nombreCliente,
                EMPLEADO.nIdentidad as idEmpleado, (EMPLEADO.pNombre || ' ' || EMPLEADO.pApellido) as nombreEmpleado,
                DEUDA.valorCuota, DEUDA.montoDeuda, DEUDA.pagado,
                PLAZO.tipoPlazo as plazoDeuda,
                ARTICULO.nombreArticulo, ARTICULO.valorArticulo, ARTICULO.cantidadArticulo,
                CATEGORIAARTICULO.categoria, SUCURSAL.nombreSucursal,
                $tablaArticuloXFacturaCompra.total as totalArticuloXfactura
            FROM $tablaArticuloXFacturaCompra
                INNER JOIN FACTURACOMPRA ON $tablaArticuloXFacturaCompra.facturaCompraID = FACTURACOMPRA.facturaCompraID
                INNER JOIN CLIENTE ON FACTURACOMPRA.clienteID = CLIENTE.clienteID
                INNER JOIN EMPLEADO ON FACTURACOMPRA.empleadoID = EMPLEADO.empleadoID
                INNER JOIN DEUDA ON FACTURACOMPRA.deudaID = DEUDA.deudaID
                INNER JOIN PLAZO ON DEUDA.plazoID = PLAZO.plazoID 
                INNER JOIN ARTICULO ON $tablaArticuloXFacturaCompra.articuloID = ARTICULO.articuloID
                INNER JOIN CATEGORIAARTICULO ON ARTICULO.categoriaArticuloID = CATEGORIAARTICULO.categoriaArticuloID
                INNER JOIN SUCURSAL ON ARTICULO.sucursalID = SUCURSAL.sucursalID
            WHERE ArticuloXFacturaCompra.facturaCompraID = :facturaCompraID
                AND ArticuloXFacturaCompra.articuloID = :articuloID;
            "
        );

        // Definiendo las variables de la consulta
        $query->bindParam(':facturaCompraID', $facturaCompraID, PDO::PARAM_INT);
        $query->bindParam(':articuloID', $articuloID, PDO::PARAM_INT);

        // Ejecución de la consulta.
        $query->execute();

        // Capturando los datos pedidos por la consulta.
        $result = $query->fetchAll(PDO::FETCH_CLASS);

        // Finalizando la variable de consulta, y retornando los datos solicitados.
        $query->closeCursor();
        $query = null;
        return $result;
    }

    public static function readAll($tablaArticuloXFacturaCompra) {
        // Preparación de la consulta de lectura.
        $query = Connection::connect()->prepare(
            "SELECT 
                FACTURACOMPRA.fechaCompra, FACTURACOMPRA.total as totalFactura, FACTURACOMPRA.pagado,
                CLIENTE.nIdentidad as idCliente, (CLIENTE.pNombre || ' ' || CLIENTE.pApellido) as nombreCliente,
                EMPLEADO.nIdentidad as idEmpleado, (EMPLEADO.pNombre || ' ' || EMPLEADO.pApellido) as nombreEmpleado,
                DEUDA.valorCuota, DEUDA.montoDeuda, DEUDA.pagado,
                PLAZO.tipoPlazo as plazoDeuda,
                ARTICULO.nombreArticulo, ARTICULO.valorArticulo, ARTICULO.cantidadArticulo,
                CATEGORIAARTICULO.categoria, SUCURSAL.nombreSucursal,
                $tablaArticuloXFacturaCompra.total as totalArticuloXfactura
            FROM $tablaArticuloXFacturaCompra
                INNER JOIN FACTURACOMPRA ON $tablaArticuloXFacturaCompra.facturaCompraID = FACTURACOMPRA.facturaCompraID
                INNER JOIN CLIENTE ON FACTURACOMPRA.clienteID = CLIENTE.clienteID
                INNER JOIN EMPLEADO ON FACTURACOMPRA.empleadoID = EMPLEADO.empleadoID
                INNER JOIN DEUDA ON FACTURACOMPRA.deudaID = DEUDA.deudaID
                INNER JOIN PLAZO ON DEUDA.plazoID = PLAZO.plazoID 
                INNER JOIN ARTICULO ON $tablaArticuloXFacturaCompra.articuloID = ARTICULO.articuloID
                INNER JOIN CATEGORIAARTICULO ON ARTICULO.categoriaArticuloID = CATEGORIAARTICULO.categoriaArticuloID
                INNER JOIN SUCURSAL ON ARTICULO.sucursalID = SUCURSAL.sucursalID;
            "
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

    public static function update($tablaArticuloXFacturaCompra, $datos) {
        // Preparado la consulta para alterar una tabla.
        $query = Connection::connect()->prepare(
            "UPDATE $tablaArticuloXFacturaCompra 
             SET total = :total 
             WHERE facturaCompraID = :facturaCompraID
             AND articuloID = :articuloID"
        );

        // Definiendo las variables de la consulta
        $query->bindParam(':facturaCompraID', $datos['facturaCompraID'], PDO::PARAM_INT);
        $query->bindParam(':articuloID', $datos['articuloID'], PDO::PARAM_INT);
        $query->bindParam(':total', $datos['total'], PDO::PARAM_STR);

        // Respuesta que se enviará al controlador que usó este método.
        if ($query->execute()) {
            return "ok";
        } else {
            print_r(Connection::connect()->errorInfo());
            return "error";
        }

        // Finalizando la variable de consulta.
        $query->closeCursor();
        $query = null;
    }

    public static function delete($tablaArticuloXFacturaCompra, $facturaCompraID, $articuloID) {
        // Preparando consulta de eliminación de datos de una tabla.
        $query = Connection::connect()->prepare(
            "DELETE FROM $tablaArticuloXFacturaCompra 
             WHERE facturaCompraID = :facturaCompraID
             AND articuloID = :articuloID"
        );

        // Definiendo las variables de la consulta.
        $query->bindParam(':facturaCompraID', $facturaCompraID, PDO::PARAM_INT);
        $query->bindParam(':articuloID', $articuloID, PDO::PARAM_INT);

        // Respuesta que se envía al controlador que utilizó este método.
        if ($query->execute()) {
            return "ok";
        } else {
            print_r(Connection::connect()->errorInfo());
            return "error";
        }

        // Finalizando variable de consulta.
        $query->closeCursor();
        $query = null;
    }
}
