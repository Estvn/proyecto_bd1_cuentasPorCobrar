<?php

class FacturaCompraController {

    public function create($datosFacturaCompra) {
        // Validar si el arreglo de datos viene con todos los datos necesarios.
        if (
            isset($datosFacturaCompra["clienteID"]) && isset($datosFacturaCompra["empleadoID"]) &&
            isset($datosFacturaCompra["deudaID"]) && isset($datosFacturaCompra["fechaCompra"]) &&
            isset($datosFacturaCompra["total"]) && isset($datosFacturaCompra["pagado"])
        ) {

            /*
            // Preparando un arreglo con los datos que se quieren registrar.
            $datos = array(
                "clienteID" => $datosFacturaCompra["clienteID"],
                "empleadoID" => $datosFacturaCompra["empleadoID"],
                "deudaID" => $datosFacturaCompra["deudaID"],
                "fechaCompra" => $datosFacturaCompra["fechaCompra"],
                "total" => $datosFacturaCompra["total"],
                "pagado" => $datosFacturaCompra["pagado"]
            );

            */
            // Realizando el llamado del método para la inserción de los datos.
            $create = FacturaCompraModel::create("facturaCompra", $datos);

            // Esto se ejecutará si la inserción fue correcta.
            if ($create == "ok") {
                $json = array(
                    "status" => 200,
                    "detalle" => "La factura de la compra se registró exitosamente."
                );

                echo json_encode($json, true);
                return;
            }
        } else {
            $json = array(
                "status" => 404,
                "detalle" => "No se ha enviado la información requerida para registrar la factura de la compra."
            );

            echo json_encode($json, true);
            return;
        }
    }

    public function readOne($facturaCompraID) {
        // Llamando método para hacer la lectura en la tabla de FacturaCompra
        $facturaCompra = Utf8Convert::utf8_convert(FacturaCompraModel::readOne("facturaCompra", $facturaCompraID));

        if (empty($facturaCompra)) {
            $json = array(
                "status" => 404,
                "detalle" => "Esta factura de compra no existe en la base de datos."
            );

            echo json_encode($json, true);
            return;
        } else {
            $json = array(
                "status" => 200,
                "detalle" => $facturaCompra
            );

            echo json_encode($json, true);
            return;
        }
    }

    public function readAllByClient($clienteID) {
        // Llamando método para hacer la lectura en la tabla de FacturaCompra
        $facturaCompras = Utf8Convert::utf8_convert(FacturaCompraModel::readAllByClient("facturaCompra", $clienteID));

        if (empty($facturaCompras)) {
            $json = array(
                "status" => 404,
                "detalle" => "No hay facturas de compra para este cliente almacenadas en la base de datos."
            );

            echo json_encode($json, true);
            return;
        } else {
            $json = array(
                "status" => 200,
                "detalle" => $facturaCompras
            );

            echo json_encode($json, true);
            return;
        }
    }

    /*
    public function update($datosFacturaCompra) {
        if (
            isset($datosFacturaCompra["facturaCompraID"]) && isset($datosFacturaCompra["clienteID"]) &&
            isset($datosFacturaCompra["empleadoID"]) && isset($datosFacturaCompra["deudaID"]) &&
            isset($datosFacturaCompra["fechaCompra"]) && isset($datosFacturaCompra["total"]) &&
            isset($datosFacturaCompra["pagado"])
        ) {
            $datos = array(
                "facturaCompraID" => $datosFacturaCompra["facturaCompraID"],
                "clienteID" => $datosFacturaCompra["clienteID"],
                "empleadoID" => $datosFacturaCompra["empleadoID"],
                "deudaID" => $datosFacturaCompra["deudaID"],
                "fechaCompra" => $datosFacturaCompra["fechaCompra"],
                "total" => $datosFacturaCompra["total"],
                "pagado" => $datosFacturaCompra["pagado"]
            );

            $update = FacturaCompraModel::update("facturaCompra", $datos);

            if ($update == "ok") {
                $json = array(
                    "status" => 200,
                    "detalle" => "La actualización se realizó correctamente."
                );

                echo json_encode($json, true);
                return;
            } else {
                $json = array(
                    "status" => 404,
                    "detalle" => "No está autorizado para modificar facturas de compras."
                );

                echo json_encode($json, true);
                return;
            }
        } else {
            $json = array(
                "status" => 404,
                "detalle" => "No se ha enviado la información requerida para actualizar la factura de compra."
            );

            echo json_encode($json, true);
            return;
        }
    }

    public function delete($facturaCompraID) {
        $delete = FacturaCompraModel::delete("facturaCompra", $facturaCompraID);

        if ($delete == "ok") {
            $json = array(
                "status" => 200,
                "detalle" => "La factura de compra se eliminó correctamente."
            );

            echo json_encode($json, true);
            return;
        } else {
            $json = array(
                "status" => 404,
                "detalle" => "No está autorizado para eliminar facturas de compras."
            );

            echo json_encode($json, true);
            return;
        }
    }
        */
}
