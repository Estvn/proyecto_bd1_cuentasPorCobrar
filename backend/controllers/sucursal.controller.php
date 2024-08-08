<?php

class SucursalController{

    public function create($datosSucursal){

        // Validar si el arreglos de datos viene con todos los datos necesarios.
        if(isset($datosSucursal["direccionID"]) && isset($datosSucursal["nombreSucursal"])){

            $sucursales = SucursalModel::read("sucursal", null);

            foreach($sucursales as $sucursal){

                // Verificar si el dato que se quiere registrar no está en la tabla.
                if(
                    $sucursal->direccionID == $datosSucursal["direccionID"] &&
                    $sucursal->nombreSucursal == $datosSucursal["nombreSucursal"]
                ){

                    $json=array(
                        "status"=>404,
                        "detalle"=>"La sucursal ya existe."
                    );

                    echo json_encode($json, true);
                    return;
                }
            }

            // Preperando un arreglo con los datos que se quieren registrar.
            $datos = array(
                "direccionID"=>$datosSucursal["direccionID"],
                "nombreSucursal"=>$datosSucursal["nombreSucursal"]
            );

            // Realizando el llamado del método para la inserción de los datos.
            $create = SucursalModel::create("sucursal", $datos);

            // Esto se ejecutará si la inserción fué correcta.
            if($create == "ok"){

                $json=array(
                    "status"=>200,
                    "detalle"=>"La sucursal se registró exitosamente."
                );

                echo json_encode($json, true);
                return;
            }

        }else{
            $json=array(
                "status"=>404,
                "detalle"=>"No se ha enviado ningun tipo de Sucursal para registrar."
            );

            echo json_encode($json, true);
            return;
        }
    }

    public function readAll($nSucursal){

        // Llamando método para hacer la lectura en la tabla de Sucursal
        $sucursales = SucursalModel::read("sucursal", null);

        if(empty($sucursales)){

            $json=array(
                "status"=>404,
                "detalle"=>"No hay tipos de Sucursales registradas."
            );

            echo json_encode($json, true);
            return;
        }else{
            $json=array(
                "status"=>200,
                "detalle"=>$sucursales
            );

            echo json_encode($json, true);
            return;
        }
    }

    public function update($datosSucursal){

        $datos = array(
            "sucursalID"=>$datosSucursal["sucursalID"],
            "direccionID"=>$datosSucursal["direccionID"],
            "nombreSucursal"=>$datosSucursal["nombreSucursal"]
        );

        $update = SucursalModel::update("sucursal", $datos);

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
                "detalle"=>"No está autorizado para modificar infromación de sucursales."
            );

            echo json_encode($json, true);
            return;
        }
    }

    public function delete($SucursalID){

        $delete = SucursalModel::delete("sucursal", $SucursalID);

        if($delete=="ok"){

            $json=array(
                "status"=>200,
                "detalle"=>"La sucursal se eliminó correctamente"
            );

            echo json_encode($json, true);
            return;

        }else{
            $json=array(
                "status"=>404,
                "detalle"=>"No está autorizado para eliminar sucursales."
            );

            echo json_encode($json, true);
            return;
        }

        
    }


}