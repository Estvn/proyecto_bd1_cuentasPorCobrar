<?php

class CategoriaArticuloController{

    /*
    public function create($categoria){

        // Validar si el arreglos de datos viene con todos los datos necesarios.
        if(isset($categoria)){

            $CategoriaArticulos = CategoriaArticuloModel::readAll("categoriaArticulo");

            foreach($CategoriaArticulos as $categoriaArticulo){

                // Verificar si el dato que se quiere registrar no está en la tabla.
                if($categoriaArticulo->CATEGORIA == $categoria){

                    $json=array(
                        "status"=>404,
                        "detalle"=>"La categoría de artículo ya existe."
                    );

                    echo json_encode($json, true);
                    return;
                }
            }

            // Realizando el llamado del método para la inserción de los datos.
            $create = CategoriaArticuloModel::create("categoriaArticulo", $categoria);

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

    public function readOne($categoriaArticuloID){

        // Llamando método para hacer la lectura en la tabla de categoriaArticulo
        $categoriaArticulo = Utf8Convert::utf8_convert(CategoriaArticuloModel::readOne("categoriaArticulo", $categoriaArticuloID));

        if(empty($categoriaArticulo)){

            $json=array(
                "status"=>404,
                "detalle"=>"Esta categoría de artículo no existe en la base de datos."
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
    */

    public function readAll(){

        // Llamando método para hacer la lectura en la tabla de categoriaArticulo
        $categoriaArticulos = Utf8Convert::utf8_convert(CategoriaArticuloModel::readAll("categoriaArticulo"));

        if(empty($categoriaArticulos)){

            $json=array(
                "status"=>404,
                "detalle"=>"No hay categorías de artículos almacenadas en la base de datos."
            );

            echo json_encode($json, true);
            return;
        }else{
            $json=array(
                "status"=>200,
                "detalle"=>$categoriaArticulos
            );

            echo json_encode($json, true);
            return;
        }
    }

    /*
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
    */


}