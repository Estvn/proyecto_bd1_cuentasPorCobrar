<?php

class CategoriaArticuloController{

    public function create($datosCategoriaArticulo){

        // Validar si el arreglos de datos viene con todos los datos necesarios.
        if(isset($datosCategoriaArticulo["categoria"])){

            $CategoriaArticulos = CategoriaArticuloModel::read("categoriaArticulo", null);

            foreach($CategoriaArticulos as $categoriaArticulo){

                // Verificar si el dato que se quiere registrar no está en la tabla.
                if($categoriaArticulo->categoria == $datosCategoriaArticulo["categoria"]){

                    $json=array(
                        "status"=>404,
                        "detalle"=>"La categoría de artículo ya existe."
                    );

                    echo json_encode($json, true);
                    return;
                }
            }

            // Preperando un arreglo con los datos que se quieren registrar.
            $datos = array(
                "categoria"=>$datosCategoriaArticulo["categoria"]
            );

            // Realizando el llamado del método para la inserción de los datos.
            $create = CategoriaArticuloModel::create("categoriaArticulo", $datos);

            // Esto se ejecutará si la inserción fué correcta.
            if($create == "ok"){

                $json=array(
                    "status"=>200,
                    "detalle"=>"La categoría de artículo se registró exitosamente."
                );

                echo json_encode($json, true);
                return;
            }

        }else{
            $json=array(
                "status"=>404,
                "detalle"=>"No se ha enviado ninguna categoría de artículo para registrar."
            );

            echo json_encode($json, true);
            return;
        }
    }

    public function read($nCategoriaArticulo){

        // Llamando método para hacer la lectura en la tabla de categoriaArticulo
        $categoriaArticulo = CategoriaArticuloModel::read("categoriaArticulo", null);

        if(empty($categoriaArticulo)){

            $json=array(
                "status"=>404,
                "detalle"=>"No hay categorías de artículo registradas."
            );

            echo json_encode($json, true);
            return;
        }else{
            $json=array(
                "status"=>200,
                "detalle"=>$categoriaArticulo
            );

            echo json_encode($json, true);
            return;
        }
    }


    public function update($datosCategoriaArticulo){

        $datos=array(
            "categoriaArticuloID"=>$datosCategoriaArticulo["categoriaArticuloID"],
            "categoria"=>$datosCategoriaArticulo["categoria"]
        );

        $update = CategoriaArticuloModel::update("categoriaArticulo", $datos);

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
                "detalle"=>"No está autorizado para modificar las categorías de los artículos."
            );

            echo json_encode($json, true);
            return;
        }
    }

    public function delete($categoriaArticuloID){

        $delete = CategoriaArticuloModel::delete("categoriaArticulo", $categoriaArticuloID);

        if($delete=="ok"){

            $json=array(
                "status"=>200,
                "detalle"=>"La categoría de artículo se eliminó correctamente"
            );

            echo json_encode($json, true);
            return;

        }else{
            $json=array(
                "status"=>404,
                "detalle"=>"No está autorizado para eliminar las categorías de artículo."
            );

            echo json_encode($json, true);
            return;
        }

        
    }


}