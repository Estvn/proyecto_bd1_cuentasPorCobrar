<?php

class GeneroController{

    /*
    public function create($tipoGenero){

        // Validar si el arreglos de datos viene con todos los datos necesarios.
        if(isset($tipoGenero)){

            $generos = GeneroModel::readAll("genero");

            foreach($generos as $genero){

                // Verificar si el dato que se quiere registrar no está en la tabla.
                if($genero->tipoGenero == $tipoGenero){

                    $json=array(
                        "status"=>404,
                        "detalle"=>"El tipo de genero ya existe."
                    );

                    echo json_encode($json, true);
                    return;
                }
            }

            // Realizando el llamado del método para la inserción de los datos.
            $create = GeneroModel::create("genero", $tipoGenero);

            // Esto se ejecutará si la inserción fué correcta.
            if($create == "ok"){

                $json=array(
                    "status"=>200,
                    "detalle"=>"El tipo de genero se registró exitosamente."
                );

                echo json_encode($json, true);
                return;
            }

        }else{
            $json=array(
                "status"=>404,
                "detalle"=>"No se ha enviado ningun tipo de genero para registrar."
            );

            echo json_encode($json, true);
            return;
        }
    }
    */

    public function readAll() {

        // Llamando método para hacer la lectura en la tabla de genero
        $generos = Utf8Convert::utf8_convert(GeneroModel::readAll("genero"));

        if(empty($generos)) {
            $json = array(
                "status" => 404,
                "detalle" => "No hay deudas almacenadas en la base de datos."
            );

            echo json_encode($json, true);
            return;
        } else {
            $json = array(
                "status" => 200,
                "detalle" => $generos
            );

            echo json_encode($json, true);
            return;
        }
    }

    /*
    public function delete($generoID){

        $delete = GeneroModel::delete("Genero", $generoID);

        if($delete=="ok"){

            $json=array(
                "status"=>200,
                "detalle"=>"El tipo de Genero se eliminó correctamente"
            );

            echo json_encode($json, true);
            return;

        }else{
            $json=array(
                "status"=>404,
                "detalle"=>"No está autorizado para eliminar los tipos de Genero."
            );

            echo json_encode($json, true);
            return;
        }

        
    }
    */
}