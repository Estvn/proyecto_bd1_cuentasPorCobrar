<?php

class ArticuloXFacturaCompraController {

    public function create($datosArticuloXFacturaCompra) {
        // Validar si el arreglo de datos viene con todos los datos necesarios.
        if (
            isset($datosArticuloXFacturaCompra["facturaCompraID"]) && 
            isset($datosArticuloXFacturaCompra["articuloID"]) &&
            isset($datosArticuloXFacturaCompra["total"])
        ) {

            $articulosFacturas = ArticuloXFacturaCompraModel::readAll("articuloXfacturaCompra");

            foreach($articulosFacturas as $articuloFactura){

                 // Verificar si el dato que se quiere registrar no está en la tabla.
                 if($articuloFactura->facturaCompraID == $datosArticuloXFacturaCompra["facturaCompraID"] &&
                    $articuloFactura->articuloID == $datosArticuloXFacturaCompra["articuloID"]
                 ){

                    $json=array(
                        "status"=>404,
                        "detalle"=>"El tipo de genero ya existe."
                    );

                    echo json_encode($json, true);
                    return;
                }
            }

            // Preparando un arreglo con los datos que se quieren registrar.
            $datos = array(
                "facturaCompraID" => $datosArticuloXFacturaCompra["facturaCompraID"],
                "articuloID" => $datosArticuloXFacturaCompra["articuloID"],
                "total" => $datosArticuloXFacturaCompra["total"]
            );

            // Realizando el llamado del método para la inserción de los datos.
            $create = ArticuloXFacturaCompraModel::create("articuloXfacturaCompra", $datos);

            // Esto se ejecutará si la inserción fue correcta.
            if ($create == "ok") {
                $json = array(
                    "status" => 200,
                    "detalle" => "El artículo se agregó a la factura de compra exitosamente."
                );

                echo json_encode($json, true);
                return;
            }
        } else {
            $json = array(
                "status" => 404,
                "detalle" => "No se ha enviado la información requerida para agregar el artículo a la factura de compra."
            );

            echo json_encode($json, true);
            return;
        }
    }

    public function readOne($facturaCompraID, $articuloID) {
        // Llamando método para hacer la lectura en la tabla de ArticuloXFacturaCompra
        $articuloXFacturaCompra = Utf8Convert::utf8_convert(ArticuloXFacturaCompraModel::readOne("articuloXfacturaCompra", $facturaCompraID, $articuloID));

        if (empty($articuloXFacturaCompra)) {
            $json = array(
                "status" => 404,
                "detalle" => "Este artículo no está asociado a la factura de compra en la base de datos."
            );

            echo json_encode($json, true);
            return;
        } else {
            $json = array(
                "status" => 200,
                "detalle" => $articuloXFacturaCompra
            );

            echo json_encode($json, true);
            return;
        }
    }

    public function readAll() {
        // Llamando método para hacer la lectura en la tabla de ArticuloXFacturaCompra
        $articulosXFacturaCompra = Utf8Convert::utf8_convert(ArticuloXFacturaCompraModel::readAll("articuloXfacturaCompra"));

        if (empty($articulosXFacturaCompra)) {
            $json = array(
                "status" => 404,
                "detalle" => "No hay artículos asociados a facturas de compra en la base de datos."
            );

            echo json_encode($json, true);
            return;
        } else {
            $json = array(
                "status" => 200,
                "detalle" => $articulosXFacturaCompra
            );

            echo json_encode($json, true);
            return;
        }
    }

    public function update($datosArticuloXFacturaCompra) {
        if (
            isset($datosArticuloXFacturaCompra["facturaCompraID"]) &&
            isset($datosArticuloXFacturaCompra["articuloID"]) &&
            isset($datosArticuloXFacturaCompra["total"])
        ) {
            $datos = array(
                "facturaCompraID" => $datosArticuloXFacturaCompra["facturaCompraID"],
                "articuloID" => $datosArticuloXFacturaCompra["articuloID"],
                "total" => $datosArticuloXFacturaCompra["total"]
            );

            $update = ArticuloXFacturaCompraModel::update("articuloXfacturaCompra", $datos);

            if ($update == "ok") {
                $json = array(
                    "status" => 200,
                    "detalle" => "La actualización del artículo en la factura de compra se realizó correctamente."
                );

                echo json_encode($json, true);
                return;
            } else {
                $json = array(
                    "status" => 404,
                    "detalle" => "No está autorizado para modificar artículos en la factura de compra."
                );

                echo json_encode($json, true);
                return;
            }
        } else {
            $json = array(
                "status" => 404,
                "detalle" => "No se ha enviado la información requerida para actualizar el artículo en la factura de compra."
            );

            echo json_encode($json, true);
            return;
        }
    }

    public function delete($facturaCompraID, $articuloID) {
        $delete = ArticuloXFacturaCompraModel::delete("articuloXfacturaCompra", $facturaCompraID, $articuloID);

        if ($delete == "ok") {
            $json = array(
                "status" => 200,
                "detalle" => "El artículo se eliminó de la factura de compra correctamente."
            );

            echo json_encode($json, true);
            return;
        } else {
            $json = array(
                "status" => 404,
                "detalle" => "No está autorizado para eliminar artículos de la factura de compra."
            );

            echo json_encode($json, true);
            return;
        }
    }
}
