<?php

class GeneroController{

    public function create($datosGenero){

        // Validar si el arreglos de datos viene con todos los datos necesarios.
        if(isset($datosGenero["tipoGenero"])){

            $generos = GeneroModel::read("genero", null);

            foreach($generos as $genero){

                // Verificar si el dato que se quiere registrar no está en la tabla.
                if($genero->tipoGenero == $datosGenero["tipoGenero"]){

                    $json=array(
                        "status"=>404,
                        "detalle"=>"El tipo de genero ya existe."
                    );

                    echo json_encode($json, true);
                    return;
                }
            }

            // Preperando un arreglo con los datos que se quieren registrar.
            $datos = array(
                "tipoGenero"=>$datosGenero["tipoGenero"]
            );

            // Realizando el llamado del método para la inserción de los datos.
            $create = GeneroModel::create("genero", $datos);

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

    public function readAll($nGenero){

        // Llamando método para hacer la lectura en la tabla de Genero
        $generos = GeneroModel::read("genero", null);

        if(empty($generos)){

            $json=array(
                "status"=>404,
                "detalle"=>"No hay tipos de generos registradas."
            );

            echo json_encode($json, true);
            return;
        }else{
            $json=array(
                "status"=>200,
                "detalle"=>$generos
            );

            echo json_encode($json, true);
            return;
        }
    }

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


}