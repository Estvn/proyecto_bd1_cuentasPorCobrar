<?php

class ClienteController{

    public function create($datosCliente){

        // Validar si el arreglos de datos viene con todos los datos necesarios.
        if(
        isset($datosCliente["direccionID"]) && isset($datosCliente["generoID"]) &&
        isset($datosCliente["antiguedadID"]) && isset($datosCliente["pNombre"]) &&
        isset($datosCliente["sNombre"]) && isset($datosCliente["pApellido"]) &&
        isset($datosCliente["sApellido"]) && isset($datosCliente["fechaNacimiento"]) &&
        isset($datosCliente["nIdentidad"]) && isset($datosCliente["creditoDisponible"]) &&
        isset($datosCliente["lineaDisponible"]) && isset($datosCliente["nomEmpresa"]) &&
        isset($datosCliente["telEmpresa"]) && isset($datosCliente["sueldo"])
        ){

            $clientes = Utf8Convert::utf8_convert(ClienteModel::readAll("cliente"));

            foreach($clientes as $cliente){

                // Verificar si el dato que se quiere registrar no está en la tabla.
                if($cliente->NIDENTIDAD == $datosCliente["nIdentidad"]){

                    $json=array(
                        "status"=>404,
                        "detalle"=>"El cliente ya está registrado."
                    );

                    echo json_encode($json, true);
                    return;
                }
            }

            // Realizando el llamado del método para la inserción de los datos.
            $create = ClienteModel::create("cliente", $datosCliente);

            // Esto se ejecutará si la inserción fué correcta.
            if($create == "ok"){

                $json=array(
                    "status"=>200,
                    "detalle"=>"El cliente se registró exitosamente."
                );

                echo json_encode($json, true);
                return;
            }

        }else{
            $json=array(
                "status"=>404,
                "detalle"=>"No se ha enviado la información requerida para registrar al cliente."
            );

            echo json_encode($json, true);
            return;
        }
    }

    public function readOne($clienteID){

        // Llamando método para hacer la lectura en la tabla de cliente
        $cliente = Utf8Convert::utf8_convert(ClienteModel::readOne("cliente", $clienteID));

        if(empty($cliente)){

            $json=array(
                "status"=>404,
                "detalle"=>"Este cliente no existe en la base de datos."
            );

            echo json_encode($json, true);
            return;
        }else{
            $json=array(
                "status"=>200,
                "detalle"=>$cliente
            );

            echo json_encode($json, true);
            return;
        }
    }

    // Se muestran los clientes habilitados si el estado es 1. Se muestran los clientes inhabilitados solo para el admininstrador (estado 0).
    public function readAllByState($estado){

        // Llamando método para hacer la lectura en la tabla de Cliente
        $clientes = Utf8Convert::utf8_convert(ClienteModel::readAllByState("cliente", $estado));

        if(empty($clientes)){

            $json=array(
                "status"=>404,
                "detalle"=>"No hay clientes almacenados en la base de datos."
            );

            echo json_encode($json, true);
            return;
        }else{
            $json=array(
                "status"=>200,
                "detalle"=>$clientes
            );

            echo json_encode($json, true);
            return;
        }
    }

    public function readAll(){

        // Llamando método para hacer la lectura en la tabla de Cliente
        $clientes = Utf8Convert::utf8_convert(ClienteModel::readAll("cliente"));

        if(empty($clientes)){

            $json=array(
                "status"=>404,
                "detalle"=>"No hay clientes almacenados en la base de datos."
            );

            echo json_encode($json, true);
            return;
        }else{
            $json=array(
                "status"=>200,
                "detalle"=>$clientes
            );

            echo json_encode($json, true);
            return;
        }
    }


    public function update($datosCliente, $clienteID){

        $update = ClienteModel::update("cliente", $datosCliente, $clienteID);

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
                "detalle"=>"No está autorizado para modificar los datos de los clientes"
            );

            echo json_encode($json, true);
            return;
        }
    }

    public function updateClientState($clienteID){

        $update = ClienteModel::updateClientState("cliente", $clienteID);

        if($update=="ok"){

            $json=array(
                "status"=>200,
                "detalle"=>"El cliente se ha habilitado correctamente."
            );

            echo json_encode($json, true);
            return;
        }else{
            $json=array(
                "status"=>404,
                "detalle"=>"No está autorizado para modificar los datos de los clientes"
            );

            echo json_encode($json, true);
            return;
        }
    }
    
    public function delete($clienteID){

        $delete = ClienteModel::delete("cliente", $clienteID);

        if($delete=="ok"){

            $json=array(
                "status"=>200,
                "detalle"=>"El cliente se eliminó correctamente."
            );

            echo json_encode($json, true);
            return;

        }else{
            $json=array(
                "status"=>404,
                "detalle"=>"No está autorizado para eliminar clientes."
            );

            echo json_encode($json, true);
            return;
        }

        
    }

}