<?php

class ArticuloController{

    public function create($datosArticulo){

        // Validar si el arreglos de datos viene con todos los datos necesarios.
        if(
        isset($datosArticulo["categoriaArticuloID"]) && isset($datosArticulo["sucursalID"]) &&
        isset($datosArticulo["nombreArticulo"]) && isset($datosArticulo["valorArticulo"]) &&
        isset($datosArticulo["cantidadArticulo"])
         ){

            /*
            // Preperando un arreglo con los datos que se quieren registrar.
            $datos = array(
                "categoriaArticuloID"=>$datosArticulo["categoriaArticuloID"],
                "sucursalID"=>$datosArticulo["sucursalID"],
                "nombreArticulo"=>$datosArticulo["nombreArticulo"],
                "valorArticulo"=>$datosArticulo["valorArticulo"],
                "cantidadArticulo"=>$datosArticulo["cantidadArticulo"]
            );
            */

            // Realizando el llamado del método para la inserción de los datos.
            $create = ArticuloModel::create("articulo", $datosArticulo);

            // Esto se ejecutará si la inserción fué correcta.
            if($create == "ok"){

                $json=array(
                    "status"=>200,
                    "detalle"=>"El articulo se registró exitosamente."
                );

                echo json_encode($json, true);
                return;
            }

        }else{
            $json=array(
                "status"=>404,
                "detalle"=>"No se ha enviado ningun tipo de Articulo para registrar."
            );

            echo json_encode($json, true);
            return;
        }
    }

    public function readByCategory($categoriaID){

        // Llamando método para hacer la lectura en la tabla de Articulo
        $articulos = Utf8Convert::utf8_convert(ArticuloModel::readByCategory("articulo", $categoriaID));

        if(empty($articulos)){

            $json=array(
                "status"=>404,
                "detalle"=>"Este artículo no existe en la base de datos."
            );

            echo json_encode($json, true);
            return;
        }else{
            $json=array(
                "status"=>200,
                "detalle"=>$articulos
            );

            echo json_encode($json, true);
            return;
        }
    }

    /*
    public function readOne($articuloID){

        // Llamando método para hacer la lectura en la tabla de Articulo
        $articulo = Utf8Convert::utf8_convert(ArticuloModel::readOne("articulo", $articuloID));

        if(empty($articulo)){

            $json=array(
                "status"=>404,
                "detalle"=>"Este artículo no existe en la base de datos."
            );

            echo json_encode($json, true);
            return;
        }else{
            $json=array(
                "status"=>200,
                "detalle"=>$articulo
            );

            echo json_encode($json, true);
            return;
        }
    }//

    public function readAll(){

        // Llamando método para hacer la lectura en la tabla de Articulo
        $articulos = Utf8Convert::utf8_convert(ArticuloModel::readAll("articulo"));

        if(empty($articulos)){

            $json=array(
                "status"=>404,
                "detalle"=>"No hay articulos almacenados."
            );

            echo json_encode($json, true);
            return;
        }else{
            $json=array(
                "status"=>200,
                "detalle"=>$articulos
            );

            echo json_encode($json, true);
            return;
        }
    }

    public function update($datosArticulo){

        $datos = array(
            "articuloID"=>$datosArticulo["articuloID"],
            "categoriaArticuloID"=>$datosArticulo["categoriaArticuloID"],
            "sucursalID"=>$datosArticulo["sucursalID"],
            "nombreArticulo"=>$datosArticulo["nombreArticulo"],
            "valorArticulo"=>$datosArticulo["valorArticulo"],
            "cantidadArticulo"=>$datosArticulo["cantidadArticulo"]
        );

        $update = ArticuloModel::update("articulo", $datos);

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
                "detalle"=>"No está autorizado para modificar los articulos"
            );

            echo json_encode($json, true);
            return;
        }
    }

    public function delete($articuloID){

        $delete = ArticuloModel::delete("articulo", $articuloID);

        if($delete=="ok"){

            $json=array(
                "status"=>200,
                "detalle"=>"El articulo se eliminó correctamente"
            );

            echo json_encode($json, true);
            return;

        }else{
            $json=array(
                "status"=>404,
                "detalle"=>"No está autorizado para eliminar los articulos."
            );

            echo json_encode($json, true);
            return;
        }

        
    }
        */


}