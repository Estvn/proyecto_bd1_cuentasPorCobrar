<?php

class EmpleadoController{

    public function create($datosEmpleado){

        // Validar si el arreglos de datos viene con todos los datos necesarios.
        if(
        isset($datosEmpleado["direccionID"]) && isset($datosEmpleado["generoID"]) &&
        isset($datosEmpleado["sucursalID"]) && isset($datosEmpleado["pNombre"]) &&
        isset($datosEmpleado["sNombre"]) && isset($datosEmpleado["pApellido"]) &&
        isset($datosEmpleado["sApellido"]) && isset($datosEmpleado["fechaNacimiento"]) &&
        isset($datosEmpleado["nIdentidad"])
        ){

            $empleados = Utf8Convert::utf8_convert(EmpleadoModel::readAll("empleado"));

            foreach($empleados as $empleado){

                // Verificar si el dato que se quiere registrar no está en la tabla.
                if($empleado->NIDENTIDAD == $datosEmpleado["nIdentidad"]){

                    $json=array(
                        "status"=>404,
                        "detalle"=>"El empleado ya está registrado."
                    );

                    echo json_encode($json, true);
                    return;
                }
            }

            // Realizando el llamado del método para la inserción de los datos.
            $create = EmpleadoModel::create("empleado", $datosEmpleado);

            // Esto se ejecutará si la inserción fué correcta.
            if($create == "ok"){

                $json=array(
                    "status"=>200,
                    "detalle"=>"El empleado se registró exitosamente."
                );

                echo json_encode($json, true);
                return;
            }

        }else{
            $json=array(
                "status"=>404,
                "detalle"=>"No se ha enviado la información requerida para registrar al empleado."
            );

            echo json_encode($json, true);
            return;
        }
    }

    public function readOne($empleadoID){

        // Llamando método para hacer la lectura en la tabla de Empleado
        $empleado = Utf8Convert::utf8_convert(empleadoModel::readOne("empleado", $empleadoID));

        if(empty($empleado)){

            $json=array(
                "status"=>404,
                "detalle"=>"Este empleado no existe en la base de datos."
            );

            echo json_encode($json, true);
            return;
        }else{
            $json=array(
                "status"=>200,
                "detalle"=>$empleado
            );

            echo json_encode($json, true);
            return;
        }//
    }

    public function readAll(){

        // Llamando método para hacer la lectura en la tabla de Empleado
        $empleados = Utf8Convert::utf8_convert(EmpleadoModel::readAll("empleado"));

        if(empty($empleados)){

            $json=array(
                "status"=>404,
                "detalle"=>"No hay empleados almacenados en la base de datos."
            );

            echo json_encode($json, true);
            return;
        }else{
            $json=array(
                "status"=>200,
                "detalle"=>$empleados
            );

            echo json_encode($json, true);
            return;
        }
    }

    public function update($datosEmpleado, $empleadoID){

        $update = EmpleadoModel::update("empleado", $datosEmpleado, $empleadoID);

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
                "detalle"=>"No está autorizado para modificar los datos de los empleados"
            );

            echo json_encode($json, true);
            return;
        }
    }

    /*
    public function delete($EmpleadoID){

        $delete = EmpleadoModel::delete("empleado", $EmpleadoID);

        if($delete=="ok"){

            $json=array(
                "status"=>200,
                "detalle"=>"El empleado se eliminó correctamente"
            );

            echo json_encode($json, true);
            return;

        }else{
            $json=array(
                "status"=>404,
                "detalle"=>"No está autorizado para eliminar empleados."
            );

            echo json_encode($json, true);
            return;
        }

        
    }
    */

}