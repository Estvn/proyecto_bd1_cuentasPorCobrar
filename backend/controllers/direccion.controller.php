<?php

class DireccionController{

    public function create($datosDireccion){

        // Validar si el arreglos de datos viene con todos los datos necesarios.
        if(
        isset($datosDireccion["municipio"]) && isset($datosDireccion["departamento"])
        ){

            $direcciones = Utf8Convert::utf8_convert(DireccionModel::readAll("direccion"));

            foreach($direcciones as $direccion){

                // Verificar si el dato que se quiere registrar no está en la tabla.
                if(
                    $direccion->DEPARTAMENTO == $datosDireccion["departamento"] &&
                    $direccion->MUNICIPIO == $datosDireccion["municipio"]
                ){

                    $json=array(
                        "status"=>404,
                        "detalle"=>"La dirección ya está registrada."
                    );

                    echo json_encode($json, true);
                    return;
                }
            }

            // Realizando el llamado del método para la inserción de los datos.
            $create = DireccionModel::create("direccion", $datosDireccion);

            // Esto se ejecutará si la inserción fué correcta.
            if($create == "ok"){

                $json=array(
                    "status"=>200,
                    "detalle"=>"La dirección se registró exitosamente."
                );

                echo json_encode($json, true);
                return;
            }

        }else{
            $json=array(
                "status"=>404,
                "detalle"=>"No se ha enviado la información requerida para registrar la dirección."
            );

            echo json_encode($json, true);
            return;
        }
    }

    /*
    public function readOne($direccionID){

        // Llamando método para hacer la lectura en la tabla de Direccion
        $direccion = Utf8Convert::utf8_convert(DireccionModel::readOne("direccion", $direccionID));

        if(empty($direccion)){

            $json=array(
                "status"=>404,
                "detalle"=>"Esta dirección no existe en la base de datos."
            );

            echo json_encode($json, true);
            return;
        }else{
            $json=array(
                "status"=>200,
                "detalle"=>$direccion
            );

            echo json_encode($json, true);
            return;
        }
    }
    */

    public function readAll(){

        // Llamando método para hacer la lectura en la tabla de Direccion
        $direcciones = Utf8Convert::utf8_convert(DireccionModel::readAll("direccion"));

        if(empty($direcciones)){

            $json=array(
                "status"=>404,
                "detalle"=>"No hay direcciones almacenadas en la base de datos."
            );

            echo json_encode($json, true);
            return;
        }else{
            $json=array(
                "status"=>200,
                "detalle"=>$direcciones
            );

            echo json_encode($json, true);
            return;
        }
    }

    /*
    public function update($datosDireccion){

        $datos = array(
            "direccionID"=>$datosDireccion["direccionID"],
            "municipio"=>$datosDireccion["municipio"],
            "departamento"=>$datosDireccion["departamento"]
        );

        $update = DireccionModel::update("direccion", $datos);

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
                "detalle"=>"No está autorizado para modificar las direcciones."
            );

            echo json_encode($json, true);
            return;
        }
    }

    public function delete($direccionID){

        $delete = DireccionModel::delete("direccion", $direccionID);

        if($delete=="ok"){

            $json=array(
                "status"=>200,
                "detalle"=>"La dirección se eliminó correctamente."
            );

            echo json_encode($json, true);
            return;

        }else{
            $json=array(
                "status"=>404,
                "detalle"=>"No está autorizado para eliminar direcciones."
            );

            echo json_encode($json, true);
            return;
        }

        
    }
    */

}