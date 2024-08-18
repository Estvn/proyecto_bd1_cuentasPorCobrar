<?php

//require_once "../models/detalleCuota.model.php";

class DetalleCuotaController {

    public function create($datosDetalleCuota) {
        // Validar si el arreglo de datos viene con todos los datos necesarios.
        if (
            isset($datosDetalleCuota["deudaID"]) && isset($datosDetalleCuota["fechaVencimiento"]) &&
            isset($datosDetalleCuota["fechaPagado"]) && isset($datosDetalleCuota["estado"]) &&
            isset($datosDetalleCuota["valorCuota"])
        ) {
            // Preparando un arreglo con los datos que se quieren registrar.
            $datos = array(
                "deudaID" => $datosDetalleCuota["deudaID"],
                "fechaVencimiento" => $datosDetalleCuota["fechaVencimiento"],
                "fechaPagado" => $datosDetalleCuota["fechaPagado"],
                "estado" => $datosDetalleCuota["estado"],
                "valorCuota" => $datosDetalleCuota["valorCuota"]
            );

            // Realizando el llamado del método para la inserción de los datos.
            $create = DetalleCuotaModel::create("detalleCuota", $datos);

            // Esto se ejecutará si la inserción fue correcta.
            if ($create == "ok") {
                $json = array(
                    "status" => 200,
                    "detalle" => "La cuota se registró exitosamente."
                );
                echo json_encode($json, true);
                return;
            } else {
                $json = array(
                    "status" => 500,
                    "detalle" => "Error al registrar la cuota."
                );
                echo json_encode($json, true);
                return;
            }
        } else {
            $json = array(
                "status" => 400,
                "detalle" => "No se ha enviado la información requerida para registrar la cuota."
            );
            echo json_encode($json, true);
            return;
        }
    }

    public function readOne($detalleCuotaID) {
        // Llamando método para hacer la lectura en la tabla de DetalleCuota
        $detalleCuota = Utf8Convert::utf8_convert(DetalleCuotaModel::readOne("detalleCuota", $detalleCuotaID));

        if (empty($detalleCuota)) {
            $json = array(
                "status" => 404,
                "detalle" => "Esta cuota no existe en la base de datos."
            );
            echo json_encode($json, true);
            return;
        } else {
            $json = array(
                "status" => 200,
                "detalle" => $detalleCuota
            );
            echo json_encode($json, true);
            return;
        }
    }

    public function readAllByDeuda($deudaID) {
        // Llamando método para hacer la lectura en la tabla de DetalleCuota
        $detalleCuotas = Utf8Convert::utf8_convert(DetalleCuotaModel::readAllByDeuda("detalleCuota", $deudaID));

        if (empty($detalleCuotas)) {
            $json = array(
                "status" => 404,
                "detalle" => "No hay cuotas almacenadas en la base de datos."
            );
            echo json_encode($json, true);
            return;
        } else {
            $json = array(
                "status" => 200,
                "detalle" => $detalleCuotas
            );
            echo json_encode($json, true);
            return;
        }
    }

    public function update($detalleCuotaID) {
        // Validar si el arreglo de datos viene con todos los datos necesarios.
        
        $update = DetalleCuotaModel::update("detalleCuota", $detalleCuotaID);

        if ($update == "ok") {

            $deudaID = (DetalleCuotaModel::readOne("detalleCuota", $detalleCuotaID))[0]->DEUDAID;
            $detalleCuotas = DetalleCuotaModel::readAllByDeuda("detalleCuota", $deudaID);

            $todosEstanPagados = true;

            foreach($detalleCuotas as $detalleCuota) {
                if($detalleCuota->ESTADO != 1) {
                    $todosEstanPagados = false;
                    break; // Si encuentras un estado que no es 1, sales del ciclo
                }
            }

            if ($todosEstanPagados) {
                DeudaController::updateStateToPayed($deudaID);
            }

            $json = array(
                "status" => 200,
                "detalle" => "La actualización se realizó correctamente."
            );
            echo json_encode($json, true);
            return;
        } else {
            $json = array(
                "status" => 500,
                "detalle" => "Error al actualizar la cuota."
            );
            echo json_encode($json, true);
            return;
        }
    
    }

    /*
    public function delete($detalleCuotaID) {
        // Validar si el ID del detalle de cuota está presente.
        if (isset($detalleCuotaID)) {
            $delete = DetalleCuotaModel::delete("detalleCuota", $detalleCuotaID);

            if ($delete == "ok") {
                $json = array(
                    "status" => 200,
                    "detalle" => "La cuota se eliminó correctamente."
                );
                echo json_encode($json, true);
                return;
            } else {
                $json = array(
                    "status" => 500,
                    "detalle" => "Error al eliminar la cuota."
                );
                echo json_encode($json, true);
                return;
            }
        } else {
            $json = array(
                "status" => 400,
                "detalle" => "No se ha enviado el ID del detalle de cuota para eliminar."
            );
            echo json_encode($json, true);
            return;
        }
    }
        */
}
