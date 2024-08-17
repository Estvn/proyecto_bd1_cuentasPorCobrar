<?php

class FacturaCompraController {

    public function create($datosFacturaCompra) {
        // Validar si el arreglo de datos viene con todos los datos necesarios.
        if (
            isset($datosFacturaCompra["clienteID"]) && isset($datosFacturaCompra["empleadoID"]) &&
            isset($datosFacturaCompra["plazoID"]) && isset($datosFacturaCompra["total"])&& 
            isset($datosFacturaCompra["articulos"])
        ) {

            /*
            // Preparando un arreglo con los datos que se quieren registrar.
            $datos = array(
                "clienteID" => $datosFacturaCompra["clienteID"],
                "empleadoID" => $datosFacturaCompra["empleadoID"],
                "deudaID" => $datosFacturaCompra["deudaID"],
                "fechaCompra" => $datosFacturaCompra["fechaCompra"],
                "total" => $datosFacturaCompra["total"],
                "pagado" => $datosFacturaCompra["pagado"]
            );

            */
            // Realizando el llamado del método para la inserción de los datos.
            $create = FacturaCompraModel::create("facturaCompra", $datosFacturaCompra);

            // Esto se ejecutará si la inserción fue correcta.
            if ($create == "ok") {

            
                $result = FacturaCompraModel::readIdOld('facturaCompra');                     
              $datosArticuloXFactura = array(
                    'articulos'=> [$datosFacturaCompra['articulos']],
                    'tipoPlazo'=> $result[0]->TIPOPLAZO,
                    'facturaCompraID'=> $result[0]->FACTURACOMPRAID,
                    
                    'total'=> $datosFacturaCompra['total']
              );
               $createArticuloXFactura = ArticuloXFacturaCompraModel::create('articuloXfacturaCompra',$datosArticuloXFactura);
               if($createArticuloXFactura == "ok"){

                $datosDeuda = array(                    
                    'tipoPlazo'=> $result[0]->TIPOPLAZO,
                    'facturaCompraID'=> $result[0]->FACTURACOMPRAID,
                    'clienteID'=>$datosFacturaCompra['clienteID'],
                    'total'=> $datosFacturaCompra['total']
              );

                   // creamos el registo en la deuda
                        $createDeuda = DeudaModel::createFromFactura('deuda',$datosDeuda);
                        if($createDeuda == "ok"){
                            
                            $deudaID = DeudaModel::readIdOld('deuda')[0]->DEUDAID;
                            $datosDetalleDeuda = array(                    
                                'tipoPlazo'=> $result[0]->TIPOPLAZO,
                                'deudaID'=> $deudaID
                          );
                            // creamos el registro de detalleCuota

                            $createDetalleCuota = DetalleCuotaModel::create('deuda',$datosDetalleDeuda);
                            if($createDetalleCuota == "ok"){
                                $json = array( 
                                    "status" => 200,
                                    "detalle" => "Se ha Creado la Factura, el Registro en la Transacional ArticuloXfacturaCompra, la Deuda y los detalles de las deudas."
                                );
                                
                                echo json_encode($json, true);
                                return;
    
                            }
                 
                        }

               

               }
            }
        } else {
            $json = array(
                "status" => 404,
                "detalle" => "No se ha enviado la información requerida para registrar la factura de la compra."
            );

            echo json_encode($json, true);
            return;
        }
    }

    public function readOne($facturaCompraID) {
        // Llamando método para hacer la lectura en la tabla de FacturaCompra
        $facturaCompra = Utf8Convert::utf8_convert(FacturaCompraModel::readOne("facturaCompra", $facturaCompraID));

        if (empty($facturaCompra)) {
            $json = array(
                "status" => 404,
                "detalle" => "Esta factura de compra no existe en la base de datos."
            );

            echo json_encode($json, true);
            return;
        } else {
            $json = array(
                "status" => 200,
                "detalle" => $facturaCompra
            );

            echo json_encode($json, true);
            return;
        }
    }

    public function readAllByClient($clienteID) {
        // Llamando método para hacer la lectura en la tabla de FacturaCompra
        $facturaCompras = Utf8Convert::utf8_convert(FacturaCompraModel::readAllByClient("facturaCompra", $clienteID));

        if (empty($facturaCompras)) {
            $json = array(
                "status" => 404,
                "detalle" => "No hay facturas de compra para este cliente almacenadas en la base de datos."
            );

            echo json_encode($json, true);
            return;
        } else {
            $json = array(
                "status" => 200,
                "detalle" => $facturaCompras
            );

            echo json_encode($json, true);
            return;
        }
    }

    /*
    public function update($datosFacturaCompra) {
        if (
            isset($datosFacturaCompra["facturaCompraID"]) && isset($datosFacturaCompra["clienteID"]) &&
            isset($datosFacturaCompra["empleadoID"]) && isset($datosFacturaCompra["deudaID"]) &&
            isset($datosFacturaCompra["fechaCompra"]) && isset($datosFacturaCompra["total"]) &&
            isset($datosFacturaCompra["pagado"])
        ) {
            $datos = array(
                "facturaCompraID" => $datosFacturaCompra["facturaCompraID"],
                "clienteID" => $datosFacturaCompra["clienteID"],
                "empleadoID" => $datosFacturaCompra["empleadoID"],
                "deudaID" => $datosFacturaCompra["deudaID"],
                "fechaCompra" => $datosFacturaCompra["fechaCompra"],
                "total" => $datosFacturaCompra["total"],
                "pagado" => $datosFacturaCompra["pagado"]
            );

            $update = FacturaCompraModel::update("facturaCompra", $datos);

            if ($update == "ok") {
                $json = array(
                    "status" => 200,
                    "detalle" => "La actualización se realizó correctamente."
                );

                echo json_encode($json, true);
                return;
            } else {
                $json = array(
                    "status" => 404,
                    "detalle" => "No está autorizado para modificar facturas de compras."
                );

                echo json_encode($json, true);
                return;
            }
        } else {
            $json = array(
                "status" => 404,
                "detalle" => "No se ha enviado la información requerida para actualizar la factura de compra."
            );

            echo json_encode($json, true);
            return;
        }
    }

    public function delete($facturaCompraID) {
        $delete = FacturaCompraModel::delete("facturaCompra", $facturaCompraID);

        if ($delete == "ok") {
            $json = array(
                "status" => 200,
                "detalle" => "La factura de compra se eliminó correctamente."
            );

            echo json_encode($json, true);
            return;
        } else {
            $json = array(
                "status" => 404,
                "detalle" => "No está autorizado para eliminar facturas de compras."
            );

            echo json_encode($json, true);
            return;
        }
    }
        */
}
