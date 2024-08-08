<?php

class DetalleCuotaController{

    public function create($datosDetalleCuota){

        // Validar si el arreglos de datos viene con todos los datos necesarios.
        if(
        isset($datosDetalleCuota["deudaID"]) && isset($datosDetalleCuota["fechaVencimiento"]) &&
        isset($datosDetalleCuota["fechaPagado"]) && isset($datosDetalleCuota["estado"]) &&
        isset($datosDetalleCuota["valorCuota"])
        ){

            // Preperando un arreglo con los datos que se quieren registrar.
            $datos = array(
                "deudaID"=>$datosDetalleCuota["deudaID"],
                "fechaVencimiento"=>$datosDetalleCuota["fechaVencimiento"],
                "fechaPagado"=>$datosDetalleCuota["fechaPagado"],
                "estado"=>$datosDetalleCuota["estado"],
                "valorCuota"=>$datosDetalleCuota["valorCuota"]
            );

            // Realizando el llamado del método para la inserción de los datos.
            $create = DetalleCuotaModel::create("detalleCuota", $datos);

            // Esto se ejecutará si la inserción fué correcta.
            if($create == "ok"){

                $json=array(
                    "status"=>200,
                    "detalle"=>"El detalle de la cuota se registró exitosamente."
                );

                echo json_encode($json, true);
                return;
            }

        }else{
            $json=array(
                "status"=>404,
                "detalle"=>"No se ha enviado la información requerida para registrar el detalle de la cuota."
            );

            echo json_encode($json, true);
            return;
        }
    }

    public function readOne($detalleCuotaID){

        // Llamando método para hacer la lectura en la tabla de DetalleCuota
        $detalleCuota = DetalleCuotaModel::read("detalleCuota", $detalleCuotaID);

        if(empty($detalleCuota)){

            $json=array(
                "status"=>404,
                "detalle"=>"Este detalle de cuota no existe en la base de datos."
            );

            echo json_encode($json, true);
            return;
        }else{
            $json=array(
                "status"=>200,
                "detalle"=>$detalleCuota
            );

            echo json_encode($json, true);
            return;
        }
    }

    public function readAll($nDetalleCuota){

        // Llamando método para hacer la lectura en la tabla de DetalleCuota
        $detalleCuotas = DetalleCuotaModel::read("detalleCuota", null);

        if(empty($detalleCuotas)){

            $json=array(
                "status"=>404,
                "detalle"=>"No hay cuotas almacenados en la base de datos."
            );

            echo json_encode($json, true);
            return;
        }else{
            $json=array(
                "status"=>200,
                "detalle"=>$detalleCuotas
            );

            echo json_encode($json, true);
            return;
        }
    }


    public function update($datosDetalleCuota){

        $datos = array(
            "detalleCuotaID"=>$datosDetalleCuota["detalleCuotaID"],
            "deudaID"=>$datosDetalleCuota["deudaID"],
            "fechaVencimiento"=>$datosDetalleCuota["fechaVencimiento"],
            "fechaPagado"=>$datosDetalleCuota["fechaPagado"],
            "estado"=>$datosDetalleCuota["estado"],
            "valorCuota"=>$datosDetalleCuota["valorCuota"]
        );

        $update = DetalleCuotaModel::update("detalleCuota", $datos);

        if($update=="ok"){

            $json=array(
                "status"=>200,
                "detalle"=>"La actualización se realizó correctamente."
            );

            echo json_encode($json, true);
            return;
        }else{
            $json=array(
                "status"=>404,
                "detalle"=>"No está autorizado para modificar los detalles de las cuotas."
            );

            echo json_encode($json, true);
            return;
        }
    }

    public function delete($detalleCuotaID){

        $delete = DetalleCuotaModel::delete("detalleCuota", $detalleCuotaID);

        if($delete=="ok"){

            $json=array(
                "status"=>200,
                "detalle"=>"Los detalles de la cuota se eliminaron correctamente"
            );

            echo json_encode($json, true);
            return;

        }else{
            $json=array(
                "status"=>404,
                "detalle"=>"No está autorizado para eliminar los detalles de las cuotas."
            );

            echo json_encode($json, true);
            return;
        }

        
    }


}