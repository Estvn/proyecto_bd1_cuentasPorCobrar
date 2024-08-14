<?php

class DeudaController {

    public function createFromFactura($datosDeuda) {

        // Validar si el arreglo de datos viene con todos los datos necesarios.
        if(
            isset($datosDeuda["clienteID"]) && isset($datosDeuda["plazoID"]) &&
            isset($datosDeuda["facturaCompraID"]) &&
            isset($datosDeuda["valorCuota"]) && isset($datosDeuda["montoDeuda"])
        ) {

            // Preparando un arreglo con los datos que se quieren registrar.
            $datos = array(
                "clienteID" => $datosDeuda["clienteID"],
                "plazoID" => $datosDeuda["plazoID"],
                "valorCuota" => $datosDeuda["valorCuota"],
                "montoDeuda" => $datosDeuda["montoDeuda"],
                "pagado" => $datosDeuda["pagado"]
            );

            // Realizando el llamado del método para la inserción de los datos.
            $create = DeudaModel::createFromFactura("deuda", $datos);

            // Esto se ejecutará si la inserción fue correcta.
            if($create == "ok") {
                $json = array(
                    "status" => 200,
                    "detalle" => "La deuda se registró exitosamente."
                );

                echo json_encode($json, true);
                return;
            }

        } else {
            $json = array(
                "status" => 404,
                "detalle" => "No se ha enviado la información requerida para registrar la deuda."
            );

            echo json_encode($json, true);
            return;
        }
    }

    public function readOne($deudaID) {

        // Llamando método para hacer la lectura en la tabla de Deuda
        $deuda = Utf8Convert::utf8_convert(DeudaModel::readOne("deuda", $deudaID));

        if(empty($deuda)) {
            $json = array(
                "status" => 404,
                "detalle" => "Esta deuda no existe en la base de datos."
            );

            echo json_encode($json, true);
            return;
        } else {
            $json = array(
                "status" => 200,
                "detalle" => $deuda
            );

            echo json_encode($json, true);
            return;
        }
    }

    public function readAllByClient($clienteID, $pagado) {

        // Llamando método para hacer la lectura en la tabla de Deuda
        $deudas = Utf8Convert::utf8_convert(DeudaModel::readAllByClient("deuda", $clienteID, $pagado));

        if(empty($deudas)) {
            $json = array(
                "status" => 404,
                "detalle" => "No hay deudas almacenadas en la base de datos."
            );

            echo json_encode($json, true);
            return;
        } else {
            $json = array(
                "status" => 200,
                "detalle" => $deudas
            );

            echo json_encode($json, true);
            return;
        }
    }

    public function updateStateToPayed($datosDeuda) {

        // Validar si el arreglo de datos viene con todos los datos necesarios.
        if(
            isset($datosDeuda["deudaID"]) && isset($datosDeuda["clienteID"]) &&
            isset($datosDeuda["plazoID"]) && isset($datosDeuda["valorCuota"]) &&
            isset($datosDeuda["montoDeuda"]) && isset($datosDeuda["pagado"])
        ) {

            $datos = array(
                "deudaID" => $datosDeuda["deudaID"],
                "clienteID" => $datosDeuda["clienteID"],
                "plazoID" => $datosDeuda["plazoID"],
                "valorCuota" => $datosDeuda["valorCuota"],
                "montoDeuda" => $datosDeuda["montoDeuda"],
                "pagado" => $datosDeuda["pagado"]
            );

            $update = DeudaModel::updateStateToPayed("deuda", $datos);

            if($update == "ok") {
                $json = array(
                    "status" => 200,
                    "detalle" => "La actualización se realizó correctamente."
                );

                echo json_encode($json, true);
                return;
            } else {
                $json = array(
                    "status" => 404,
                    "detalle" => "No está autorizado para modificar las deudas."
                );

                echo json_encode($json, true);
                return;
            }

        } else {
            $json = array(
                "status" => 404,
                "detalle" => "No se ha enviado la información completa para actualizar la deuda."
            );

            echo json_encode($json, true);
            return;
        }
    }

    /*
    public function delete($deudaID) {

        // Validar si el ID de la deuda está presente.
        if(isset($deudaID)) {

            $delete = DeudaModel::delete("deuda", $deudaID);

            if($delete == "ok") {
                $json = array(
                    "status" => 200,
                    "detalle" => "La deuda se eliminó correctamente."
                );

                echo json_encode($json, true);
                return;

            } else {
                $json = array(
                    "status" => 404,
                    "detalle" => "No está autorizado para eliminar deudas."
                );

                echo json_encode($json, true);
                return;
            }

        } else {
            $json = array(
                "status" => 404,
                "detalle" => "No se ha enviado el ID de la deuda para eliminar."
            );

            echo json_encode($json, true);
            return;
        }
    }
        */
}
