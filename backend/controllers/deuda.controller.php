<?php

class DeudaController{

    public function create($datosDeuda){

        // Validar si el arreglos de datos viene con todos los datos necesarios.
        if(
        isset($datosDeuda["clienteID"]) && isset($datosDeuda["plazoID"]) &&
        isset($datosDeuda["valorCuota"]) && isset($datosDeuda["montoDeuda"]) &&
        isset($datosDeuda["pagado"])
        ){

            // Preperando un arreglo con los datos que se quieren registrar.
            $datos = array(
                "clienteID"=>$datosDeuda["clienteID"],
                "plazoID"=>$datosDeuda["plazoID"],
                "valorCuota"=>$datosDeuda["valorCuota"],
                "montoDeuda"=>$datosDeuda["montoDeuda"],
                "pagado"=>$datosDeuda["pagado"]
            );

            // Realizando el llamado del método para la inserción de los datos.
            $create = DeudaModel::create("deuda", $datos);

            // Esto se ejecutará si la inserción fué correcta.
            if($create == "ok"){

                $json=array(
                    "status"=>200,
                    "detalle"=>"La deuda se registró exitosamente."
                );

                echo json_encode($json, true);
                return;
            }

        }else{
            $json=array(
                "status"=>404,
                "detalle"=>"No se ha enviado la información requerida para registrar la deuda."
            );

            echo json_encode($json, true);
            return;
        }
    }

    public function readOne($deudaID){

        // Llamando método para hacer la lectura en la tabla de Deuda
        $deuda = DeudaModel::read("deuda", $deudaID);

        if(empty($deuda)){

            $json=array(
                "status"=>404,
                "detalle"=>"Esta deuda no existe en la base de datos."
            );

            echo json_encode($json, true);
            return;
        }else{
            $json=array(
                "status"=>200,
                "detalle"=>$deuda
            );

            echo json_encode($json, true);
            return;
        }
    }

    public function readAll($nDeuda){

        // Llamando método para hacer la lectura en la tabla de Deuda
        $deudas = DeudaModel::read("deuda", null);

        if(empty($deudas)){

            $json=array(
                "status"=>404,
                "detalle"=>"No hay deudas almacenadas en la base de datos."
            );

            echo json_encode($json, true);
            return;
        }else{
            $json=array(
                "status"=>200,
                "detalle"=>$deudas
            );

            echo json_encode($json, true);
            return;
        }
    }

    public function update($datosDeuda){

        $datos = array(
            "clienteID"=>$datosDeuda["clienteID"],
            "plazoID"=>$datosDeuda["plazoID"],
            "valorCuota"=>$datosDeuda["valorCuota"],
            "montoDeuda"=>$datosDeuda["montoDeuda"],
            "pagado"=>$datosDeuda["pagado"]
        );

        $update = DeudaModel::update("deuda", $datos);

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
                "detalle"=>"No está autorizado para modificar las deudas."
            );

            echo json_encode($json, true);
            return;
        }
    }

    public function delete($deudaID){

        $delete = DeudaModel::delete("deuda", $deudaID);

        if($delete=="ok"){

            $json=array(
                "status"=>200,
                "detalle"=>"La deuda se eliminó correctamente"
            );

            echo json_encode($json, true);
            return;

        }else{
            $json=array(
                "status"=>404,
                "detalle"=>"No está autorizado para eliminar deudas."
            );

            echo json_encode($json, true);
            return;
        }

        
    }


}