<?php

class SucursalController{

    public function create($datosSucursal){

        // Validar si el arreglos de datos viene con todos los datos necesarios.
        if(isset($datosSucursal["direccionID"]) && isset($datosSucursal["nombreSucursal"])){

            $sucursales = Utf8Convert::utf8_convert(SucursalModel::readAll("sucursal"));

            foreach($sucursales as $sucursal){

                // Verificar si el dato que se quiere registrar no está en la tabla.
                if(
                    $sucursal->DIRECCIONID == $datosSucursal["direccionID"] &&
                    $sucursal->NOMBRESUCURSAL == $datosSucursal["nombreSucursal"]
                ){

                    $json=array(
                        "status"=>404,
                        "detalle"=>"La sucursal ya existe."
                    );

                    echo json_encode($json, true);
                    return;
                }
            }

            // Realizando el llamado del método para la inserción de los datos.
            $create = SucursalModel::create("sucursal", $datosSucursal);

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

    public function readOne($sucursalID){

        // Llamando método para hacer la lectura en la tabla de sucursal
        $sucursal = Utf8Convert::utf8_convert(SucursalModel::readOne("sucursal", $sucursalID));

        if(empty($sucursal)){

            $json=array(
                "status"=>404,
                "detalle"=>"Esta sucursal no existe en la base de datos."
            );

            echo json_encode($json, true);
            return;
        }else{
            $json=array(
                "status"=>200,
                "detalle"=>$sucursal
            );

            echo json_encode($json, true);
            return;
        }
    }

    public function readByEmployee($empleadoID){

        // Llamando método para hacer la lectura en la tabla de sucursal
        $sucursal = Utf8Convert::utf8_convert(SucursalModel::readByEmployee("empleado", $empleadoID));

        if(empty($sucursal)){

            $json=array(
                "status"=>404,
                "detalle"=>"Esta sucursal no existe en la base de datos."
            );

            echo json_encode($json, true);
            return;
        }else{
            $json=array(
                "status"=>200,
                "detalle"=>$sucursal
            );

            echo json_encode($json, true);
            return;
        }
    }

    public function readAll(){

        // Llamando método para hacer la lectura en la tabla de sucursal
        $sucursals = Utf8Convert::utf8_convert(SucursalModel::readAll("sucursal"));

        if(empty($sucursals)){

            $json=array(
                "status"=>404,
                "detalle"=>"No hay sucursales almacenadas en la base de datos."
            );

            echo json_encode($json, true);
            return;
        }else{
            $json=array(
                "status"=>200,
                "detalle"=>$sucursals
            );

            echo json_encode($json, true);
            return;
        }
    }

    /*
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
    */

}