<?php

class PlazoController{

    public function create($datosPlazo){

        // Validar si el arreglos de datos viene con todos los datos necesarios.
        if(isset($datosPlazo["tipoPlazo"])){

            $plazos = PlazoModel::read("plazo", null);

            foreach($plazos as $plazo){

                // Verificar si el dato que se quiere registrar no está en la tabla.
                if($plazo->tipoPlazo == $datosPlazo["tipoPlazo"]){

                    $json=array(
                        "status"=>404,
                        "detalle"=>"El tipo de Plazo ya existe."
                    );

                    echo json_encode($json, true);
                    return;
                }
            }

            // Preperando un arreglo con los datos que se quieren registrar.
            $datos = array(
                "tipoPlazo"=>$datosPlazo["tipoPlazo"]
            );

            // Realizando el llamado del método para la inserción de los datos.
            $create = PlazoModel::create("plazo", $datos);

            // Esto se ejecutará si la inserción fué correcta.
            if($create == "ok"){

                $json=array(
                    "status"=>200,
                    "detalle"=>"El tipo de Plazo se registró exitosamente."
                );

                echo json_encode($json, true);
                return;
            }

        }else{
            $json=array(
                "status"=>404,
                "detalle"=>"No se ha enviado ningun tipo de Plazo para registrar."
            );

            echo json_encode($json, true);
            return;
        }
    }

    public function readAll($nPlazo){

        // Llamando método para hacer la lectura en la tabla de Plazo
        $plazos = PlazoModel::read("plazo", null);

        if(empty($plazos)){

            $json=array(
                "status"=>404,
                "detalle"=>"No hay tipos de plazos registradas."
            );

            echo json_encode($json, true);
            return;
        }else{
            $json=array(
                "status"=>200,
                "detalle"=>$plazos
            );

            echo json_encode($json, true);
            return;
        }
    }


    public function update($datosPlazo){

        $datos=array(
            "PlazoID"=>$datosPlazo["PlazoID"],
            "tipoPlazo"=>$datosPlazo["tipoPlazo"]
        );

        $update = PlazoModel::update("plazo", $datos);

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
                "detalle"=>"No está autorizado para modificar los tipos de Plazo."
            );

            echo json_encode($json, true);
            return;
        }
    }

    public function delete($plazoID){

        $delete = PlazoModel::delete("plazo", $plazoID);

        if($delete=="ok"){

            $json=array(
                "status"=>200,
                "detalle"=>"El tipo de Plazo se eliminó correctamente"
            );

            echo json_encode($json, true);
            return;

        }else{
            $json=array(
                "status"=>404,
                "detalle"=>"No está autorizado para eliminar los tipos de Plazo."
            );

            echo json_encode($json, true);
            return;
        }

        
    }


}