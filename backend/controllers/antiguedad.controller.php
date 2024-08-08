<?php

class AntiguedadController{

    public function create($datosAntiguedad){

        // Validar si el arreglos de datos viene con todos los datos necesarios.
        if(isset($datosAntiguedad["tipoAntiguedad"])){

            $antiguedades = AntiguedadModel::read("antiguedad", null);

            foreach($antiguedades as $antiguedad){

                // Verificar si el dato que se quiere registrar no está en la tabla.
                if($antiguedad->tipoAntiguedad == $datosAntiguedad["tipoAntiguedad"]){

                    $json=array(
                        "status"=>404,
                        "detalle"=>"El tipo de antiguedad ya existe."
                    );

                    echo json_encode($json, true);
                    return;
                }
            }

            // Preperando un arreglo con los datos que se quieren registrar.
            $datos = array(
                "tipoAntiguedad"=>$datosAntiguedad["tipoAntiguedad"]
            );

            // Realizando el llamado del método para la inserción de los datos.
            $create = AntiguedadModel::create("antiguedad", $datos);

            // Esto se ejecutará si la inserción fué correcta.
            if($create == "ok"){

                $json=array(
                    "status"=>200,
                    "detalle"=>"El tipo de antiguedad se registró exitosamente."
                );

                echo json_encode($json, true);
                return;
            }

        }else{
            $json=array(
                "status"=>404,
                "detalle"=>"No se ha enviado ningun tipo de antiguedad para registrar."
            );

            echo json_encode($json, true);
            return;
        }
    }

    public function readAll($nAntiguedad){

        // Llamando método para hacer la lectura en la tabla de antiguedad
        $antiguedades = AntiguedadModel::read("antiguedad", null);

        if(empty($antiguedades)){

            $json=array(
                "status"=>404,
                "detalle"=>"No hay tipos de antiguedades registradas."
            );

            echo json_encode($json, true);
            return;
        }else{
            $json=array(
                "status"=>200,
                "detalle"=>$antiguedades
            );

            echo json_encode($json, true);
            return;
        }
    }


    public function update($datosAntiguedad){

        $datos=array(
            "antiguedadID"=>$datosAntiguedad["antiguedadID"],
            "tipoAntiguedad"=>$datosAntiguedad["tipoAntiguedad"]
        );

        $update = AntiguedadModel::update("antiguedad", $datos);

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
                "detalle"=>"No está autorizado para modificar los tipos de antiguedad."
            );

            echo json_encode($json, true);
            return;
        }
    }

    public function delete($antiguedadID){

        $delete = AntiguedadModel::delete("antiguedad", $antiguedadID);

        if($delete=="ok"){

            $json=array(
                "status"=>200,
                "detalle"=>"El tipo de antiguedad se eliminó correctamente"
            );

            echo json_encode($json, true);
            return;

        }else{
            $json=array(
                "status"=>404,
                "detalle"=>"No está autorizado para eliminar los tipos de antiguedad."
            );

            echo json_encode($json, true);
            return;
        }

        
    }


}