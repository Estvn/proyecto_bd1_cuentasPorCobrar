
<?php
require_once("connection.php");

//$arrayRutas = explode("/",$_SERVER['REQUEST_URI']);

// Obtener la URI completa
$requestUri = $_SERVER['REQUEST_URI'];

// Separar la URI en su componente de ruta y query string
$parsedUrl = parse_url($requestUri);
$path = $parsedUrl['path'] ?? '';
$queryString = $parsedUrl['query'] ?? '';

// Obtener los segmentos de la ruta
$arrayRutas = explode('/', trim($path, '/'));

$queryParams = [];

//Obtener parámetros de consulta (si es necesario)
parse_str($queryString, $queryParams);

//echo "hola" . print_r($arrayRutas);
//echo "cantidad" . count(array_filter($arrayRutas));

//echo print_r($queryParams);

// Imprimir resultados
//echo "3" . print_r($arrayRutas);
//echo "4" . print_r($queryParams);

// Se imprime el arreglo
//echo explode("/",$_SERVER['REQUEST_URI'])[3] . "<br>"; //index.php

// Se imprime la URL
//echo $_SERVER['REQUEST_URI'] . "<br>";

//echo var_dump($arrayRutas);
//echo array_filter($arrayRutas)[3];
//echo count(array_filter($arrayRutas));

if(count(array_filter($arrayRutas)) >= 3){

    if(isset($_SERVER['REQUEST_METHOD'])){

        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $archiveRoute = array_filter($arrayRutas)[2];

        //echo $requestMethod;
        //echo $archiveRoute;

        switch ($archiveRoute){

            
            // ESTE SOLO ES PARA PROBAR LA CONEXIÓN.
            case 'index.php';

                $pruebaController = new PruebaController();

                $response = match($requestMethod){

                    'GET' => function() use ($pruebaController){

                        $pruebaController->metodoControllerPrueba();
                    },
                    default => function() {
                        
                        
                        /*
                        $json=array(
                            "status"=>404,
                            "detalle"=>"Página no encontrada."
                        );

                        echo json_encode($json, true);
                        return;
                        */
                    }, 
                };

                $response();
            break;
            

            case 'plazo.php':

                $plazoController = new PlazoController();

                $response = match($requestMethod){

                    'GET' => function() use ($plazoController){

                        $plazoController->readAll();

                    },
                    /*
                    'POST' => function() use ($plazoController){

                        $tipoPlazo = $_POST["tipoPlazo"];
                        $plazoController->create($tipoPlazo);

                    },
                    'PUT' => function() use ($plazoController, $queryParams){

                        if (!empty($queryParams)) {

                            $plazoController->update($queryParams);
                            
                        } else {
                            
                            $json=array(
                                "status"=>404,
                                "detalle"=>"Datos insuficientes."
                            );

                            echo json_encode($json, true);
                            return;
                        }

                    },
                    'DELETE' => function() use ($plazoController, $queryParams){

                        if(!empty($queryParams)){

                            $plazoID = $queryParams["plazoID"];
                            $plazoController->delete($plazoID);
                        }

                    },
                    */
                    default => function() {
                        
                        $json=array(
                            "status"=>404,
                            "detalle"=>"Página no encontrada."
                        );

                        echo json_encode($json, true);
                        return;
                    }, 
                };

                $response();

            break;

            case 'antiguedad.php':

                $antiguedadController = new AntiguedadController();

                $response = match($requestMethod){

                    'GET' => function() use ($antiguedadController){

                        $antiguedadController->readAll();

                    },
                    /*
                    'POST' => function() use ($antiguedadController){

                    },
                    'PUT' => function() use ($antiguedadController){

                    },
                    'DELETE' => function() use ($antiguedadController){

                    },
                    */
                    default => function() {
                        
                        $json=array(
                            "status"=>404,
                            "detalle"=>"Página no encontrada."
                        );

                        echo json_encode($json, true);
                        return;
                    }, 
                };

                $response();

            break;

            case 'genero.php':

                $generoController = new GeneroController();

                $response = match($requestMethod){

                    'GET' => function() use ($generoController){

                        $generoController->readAll();

                    },
                    /*
                    'POST' => function() use ($antiguedadController){

                    },
                    'PUT' => function() use ($antiguedadController){

                    },
                    'DELETE' => function() use ($antiguedadController){

                    },
                    */
                    default => function() {
                        
                        $json=array(
                            "status"=>404,
                            "detalle"=>"Página no encontrada."
                        );

                        echo json_encode($json, true);
                        return;
                    }, 
                };

                $response();

            break;

            case 'direccion.php':

                $direccionController = new DireccionController();

                $response = match($requestMethod){

                    'GET' => function() use ($direccionController){

                        $direccionController->readAll();

                    },
                    'POST' => function() use ($direccionController){
                        
                        if(isset($_POST['departamento']) && isset($_POST['municipio'])){

                            $datosDireccion = array(
                                "departamento"=>$_POST['departamento'],
                                "municipio"=>$_POST['municipio']
                            );
    
                            $direccionController->create($datosDireccion);         

                        }else{

                            $json = array(

                                "status" => 404,
                                "detalle" => "Datos incompletos"
                            );

                            echo json_encode($json, true);
                            return;
                        }

                    },
                    /*
                    'PUT' => function() use ($direccionController){

                    },
                    'DELETE' => function() use ($direccionController){

                    },
                    */
                    default => function() {
                        
                        $json=array(
                            "status"=>404,
                            "detalle"=>"Página no encontrada."
                        );

                        echo json_encode($json, true);
                        return;
                    }, 
                };

                $response();

            break;

            case 'categoriaArticulo.php':

                $categoriaArticuloController = new CategoriaArticuloController();

                $response = match($requestMethod){

                    'GET' => function() use ($categoriaArticuloController){

                        $categoriaArticuloController->readAll();

                    },
                    /*
                    'POST' => function() use ($categoriaArticuloController){

                        if(isset($_POST['categoria'])){

                            $categoria = $_POST["categoria"];
                            $categoriaArticuloController->create($categoria);

                        }else{

                            $json = array(

                                "status" => 404,
                                "detalle" => "No se envío información."
                            );

                            echo json_encode($json, true);
                            return;
                        }
                        
                    },
                    'PUT' => function() use ($categoriaArticuloController){

                    },
                    'DELETE' => function() use ($categoriaArticuloController){

                    },
                    */
                    default => function() {
                        
                        $json=array(
                            "status"=>404,
                            "detalle"=>"Página no encontrada."
                        );

                        echo json_encode($json, true);
                        return;
                    }, 
                };

                $response();

            break;

            case 'sucursal.php':

                $sucursalController = new SucursalController();

                $response = match($requestMethod){

                    'GET' => function() use ($sucursalController, $arrayRutas, $queryParams){

                        if(count(array_filter($arrayRutas)) == 4){

                            if (is_numeric(end($arrayRutas))) {

                                $sucursalID = end($arrayRutas);
                                $sucursalController->readOne($sucursalID);
                                
                            } else {
                                
                                $json=array(
                                    "status"=>404,
                                    "detalle"=>"Ha ocurrido un problema..."
                                );
    
                                echo json_encode($json, true);
                                return;
                            }

                        }elseif(count(array_filter($arrayRutas)) == 3){

                            if (!empty($queryParams)) {

                                if(isset($queryParams['empleadoID'])){

                                    $sucursalController->readByEmployee($queryParams['empleadoID']);
                                }else{

                                    $json = array(

                                        "status" => 404,
                                        "detalle" => "Datos de URL incorrectos."
                                    );
        
                                    echo json_encode($json, true);
                                    return;
                                }

                            } else {
                                
                                $sucursalController->readAll();
                            }
                        }else{

                            $json = array(

                                "status" => 404,
                                "detalle" => "Página no encontrada."
                            );

                            echo json_encode($json, true);
                            return;
                        }

                    },
                    'POST' => function() use ($sucursalController){

                        if(isset($_POST['direccionID']) && isset($_POST['nombreSucursal'])){

                            $datosSucursal = array(
                                
                                "direccionID"=>$_POST['direccionID'],
                                "nombreSucursal"=>$_POST['nombreSucursal']
                            );

                            $sucursalController->create($datosSucursal);

                        }else{

                            $json = array(

                                "status" => 404,
                                "detalle" => "No se envío la información necesaria."
                            );

                            echo json_encode($json, true);
                            return;
                        }

                    },
                    /*
                    'PUT' => function() use ($sucursalController){

                    },
                    'DELETE' => function() use ($sucursalController){

                    },
                    */
                    default => function(){
                        
                        $json=array(
                            "status"=>404,
                            "detalle"=>"Página no encontrada."
                        );

                        echo json_encode($json, true);
                        return;
                    }, 
                };

                $response();

            break;

            case 'articulo.php':

                $articuloController = new ArticuloController();

                $response = match($requestMethod){

                    'GET' => function() use ($articuloController, $queryParams){

                        if(!empty($queryParams) && isset($queryParams['categoriaID'])){

                            $articuloController->readByCategory($queryParams['categoriaID']);

                        }else{

                            $json=array(
                                "status"=>404,
                                "detalle"=>"No se ha enviado el dato esperado..."
                            );
    
                            echo json_encode($json, true);
                            return;
                        }
                    },
                    'POST' => function() use ($articuloController){

                        if(
                            isset($_POST['categoriaArticuloID']) && isset($_POST['sucursalID']) &&
                            isset($_POST['nombreArticulo']) && isset($_POST['valorArticulo']) &&
                            isset($_POST['cantidadArticulo'])
                            ){

                            $datosSucursal = array(
                                
                                "categoriaArticuloID"=>$_POST['categoriaArticuloID'],
                                "sucursalID"=>$_POST['sucursalID'],
                                "nombreArticulo"=>$_POST['nombreArticulo'],
                                "valorArticulo"=>$_POST['valorArticulo'],
                                "cantidadArticulo"=>$_POST['cantidadArticulo']
                            );

                            $articuloController->create($datosSucursal);

                        }else{

                            $json = array(

                                "status" => 404,
                                "detalle" => "No se envío la información necesaria."
                            );

                            echo json_encode($json, true);
                            return;
                        }

                    },
                    /*
                    'PUT' => function() use ($articuloController){

                    },
                    'DELETE' => function() use ($articuloController){

                    },
                    */
                    default => function() {
                        
                        $json=array(
                            "status"=>404,
                            "detalle"=>"Página no encontrada."
                        );

                        echo json_encode($json, true);
                        return;
                    }, 
                };

                $response();

            break;

            case 'empleado.php':

                $empleadoController = new EmpleadoController();

                $response = match($requestMethod){

                    'GET' => function() use ($empleadoController, $arrayRutas){

                        if(count(array_filter($arrayRutas)) == 4 && is_numeric(end($arrayRutas))){

                            $empleadoController->readOne(end($arrayRutas));
                            
                        }elseif(count(array_filter($arrayRutas)) == 3){

                            $empleadoController->readAll();

                        } else {
                                
                            $json=array(
                                "status"=>404,
                                "detalle"=>"Página no encontrada"
                            );

                            echo json_encode($json, true);
                            return;
                        }
                    },
                    'POST' => function() use ($empleadoController, $arrayRutas){

                        if(count(array_filter($arrayRutas)) == 3){


                            if(
                                isset($_POST['direccionID']) && isset($_POST['generoID']) &&
                                isset($_POST['sucursalID']) && isset($_POST['pNombre']) &&
                                isset($_POST['sNombre']) && isset($_POST['pApellido']) &&
                                isset($_POST['sApellido']) && isset($_POST['fechaNacimiento']) &&
                                isset($_POST['nIdentidad'])

                                ){

                                $datosEmpleado = array(
                                    
                                    "direccionID"=>$_POST['direccionID'],
                                    "generoID"=>$_POST['generoID'],
                                    "sucursalID"=>$_POST['sucursalID'],
                                    "pNombre"=>$_POST['pNombre'],
                                    "sNombre"=>$_POST['sNombre'],
                                    "pApellido"=>$_POST['pApellido'],
                                    "sApellido"=>$_POST['sApellido'],
                                    "fechaNacimiento"=>$_POST['fechaNacimiento'],
                                    "nIdentidad"=>$_POST['nIdentidad']
                                );

                                $empleadoController->create($datosEmpleado);

                            }else{

                                $json = array(

                                    "status" => 404,
                                    "detalle" => "No se envío la información necesaria."
                                );

                                echo json_encode($json, true);
                                return;
                            }

                        }else{

                            $json = array(

                                "status" => 404,
                                "detalle" => "Página no encontrada."
                            );

                            echo json_encode($json, true);
                            return;

                        }

                    },
                    'PUT' => function() use ($empleadoController, $queryParams){

                        if(isset($queryParams['empleadoID']) && is_numeric($queryParams['empleadoID'])){

                            parse_str(file_get_contents("php://input"), $_PUT);

                            if(
                                isset($_PUT['direccionID']) && isset($_PUT['generoID']) &&
                                isset($_PUT['sucursalID']) && isset($_PUT['pNombre']) &&
                                isset($_PUT['sNombre']) && isset($_PUT['pApellido']) &&
                                isset($_PUT['sApellido']) && isset($_PUT['fechaNacimiento']) &&
                                isset($_PUT['nIdentidad'])

                            ){

                                $datosEmpleado = array(
                                    
                                    "direccionID"=>$_PUT['direccionID'],
                                    "generoID"=>$_PUT['generoID'],
                                    "sucursalID"=>$_PUT['sucursalID'],
                                    "pNombre"=>$_PUT['pNombre'],
                                    "sNombre"=>$_PUT['sNombre'],
                                    "pApellido"=>$_PUT['pApellido'],
                                    "sApellido"=>$_PUT['sApellido'],
                                    "fechaNacimiento"=>$_PUT['fechaNacimiento'],
                                    "nIdentidad"=>$_PUT['nIdentidad']
                                );

                                $empleadoController->update($datosEmpleado, $queryParams['empleadoID']);

                            }
                        }else{

                            $json = array(

                                "status" => 404,
                                "detalle" => "No se envío la información necesaria."
                            );

                            echo json_encode($json, true);
                            return;
                    
                        }

                    },
                    /*
                    'DELETE' => function() use ($empleadoController){

                    },
                    */
                    default => function() {
                        
                        $json=array(
                            "status"=>404,
                            "detalle"=>"Página no encontrada."
                        );

                        echo json_encode($json, true);
                        return;
                    }, 
                };

                $response();

            break;

            case 'cliente.php':

                $clienteController = new ClienteController();

                $response = match($requestMethod){

                    'GET' => function() use ($clienteController, $arrayRutas, $queryParams){

                        if(count(array_filter($arrayRutas)) == 4 && is_numeric(end($arrayRutas))){

                            $clienteController->readOne(end($arrayRutas));
                            
                        }elseif(count(array_filter($arrayRutas)) == 3){

                            if(isset($queryParams['estado']) && is_numeric($queryParams['estado'])){

                                $clienteController->readAllByState($queryParams['estado']);
                            }

                        } else {
                                
                            $json=array(
                                "status"=>404,
                                "detalle"=>"Página no encontrada"
                            );

                            echo json_encode($json, true);
                            return;
                        }
                    },
                    'POST' => function() use ($clienteController, $arrayRutas){

                        if(count(array_filter($arrayRutas)) == 3){


                            if(
                                isset($_POST['direccionID']) && isset($_POST['generoID']) &&
                                isset($_POST['antiguedadID']) && isset($_POST['pNombre']) &&
                                isset($_POST['sNombre']) && isset($_POST['pApellido']) &&
                                isset($_POST['sApellido']) && isset($_POST['fechaNacimiento']) &&
                                isset($_POST['nIdentidad']) && isset($_POST['creditoDisponible']) &&
                                isset($_POST['lineaDisponible']) && isset($_POST['nomEmpresa']) &&
                                isset($_POST['telEmpresa']) && isset($_POST['sueldo'])
                                ){

                                $datosCliente = array(
                                    
                                    "direccionID"=>$_POST['direccionID'],
                                    "generoID"=>$_POST['generoID'],
                                    "antiguedadID"=>$_POST['antiguedadID'],
                                    "pNombre"=>$_POST['pNombre'],
                                    "sNombre"=>$_POST['sNombre'],
                                    "pApellido"=>$_POST['pApellido'],
                                    "sApellido"=>$_POST['sApellido'],
                                    "fechaNacimiento"=>$_POST['fechaNacimiento'],
                                    "nIdentidad"=>$_POST['nIdentidad'],
                                    "creditoDisponible"=>$_POST['creditoDisponible'],
                                    "lineaDisponible"=>$_POST['lineaDisponible'],
                                    "nomEmpresa"=>$_POST['nomEmpresa'],
                                    "telEmpresa"=>$_POST['telEmpresa'],
                                    "sueldo"=>$_POST['sueldo']
                                );

                                $clienteController->create($datosCliente);

                            }else{

                                $json = array(

                                    "status" => 404,
                                    "detalle" => "No se envío la información necesaria."
                                );

                                echo json_encode($json, true);
                                return;
                            }

                        }else{

                            $json = array(

                                "status" => 404,
                                "detalle" => "Página no encontrada."
                            );

                            echo json_encode($json, true);
                            return;

                        }

                    },
                    'PUT' => function() use ($clienteController, $queryParams){

                        if(isset($queryParams['clienteID']) && is_numeric($queryParams['clienteID'])){

                            parse_str(file_get_contents("php://input"), $_PUT);

                            if(
                                isset($_PUT['direccionID']) && isset($_PUT['generoID']) &&
                                isset($_PUT['antiguedadID']) && isset($_PUT['pNombre']) &&
                                isset($_PUT['sNombre']) && isset($_PUT['pApellido']) &&
                                isset($_PUT['sApellido']) && isset($_PUT['fechaNacimiento']) &&
                                isset($_PUT['nIdentidad']) && isset($_PUT['creditoDisponible']) &&
                                isset($_PUT['lineaDisponible']) && isset($_PUT['nomEmpresa']) &&
                                isset($_PUT['telEmpresa']) && isset($_PUT['sueldo'])
                            ){

                                if(isset($_PUT['estado'])){

                                    if($_PUT['estado'] == 1){

                                        $clienteController->updateClientState($queryParams['clienteID']);
                                    
                                    }else{

                                        $clienteController->delete($queryParams['clienteID']);
                                    }
                                
                                }else{

                                    $datosCliente = array(
                                    
                                        "direccionID"=>$_PUT['direccionID'],
                                        "generoID"=>$_PUT['generoID'],
                                        "antiguedadID"=>$_PUT['antiguedadID'],
                                        "pNombre"=>$_PUT['pNombre'],
                                        "sNombre"=>$_PUT['sNombre'],
                                        "pApellido"=>$_PUT['pApellido'],
                                        "sApellido"=>$_PUT['sApellido'],
                                        "fechaNacimiento"=>$_PUT['fechaNacimiento'],
                                        "nIdentidad"=>$_PUT['nIdentidad'],
                                        "creditoDisponible"=>$_PUT['creditoDisponible'],
                                        "lineaDisponible"=>$_PUT['lineaDisponible'],
                                        "nomEmpresa"=>$_PUT['nomEmpresa'],
                                        "telEmpresa"=>$_PUT['telEmpresa'],
                                        "sueldo"=>$_PUT['sueldo']
                                    );
    
                                    $clienteController->update($datosCliente, $queryParams['clienteID']);
    
                                }
                            }
                        }else{

                            $json = array(

                                "status" => 404,
                                "detalle" => "No se envío la información necesaria."
                            );

                            echo json_encode($json, true);
                            return;
                    
                        }

                    },
                    /*
                    'DELETE' => function() use ($clienteController){

                    },
                    */
                    default => function() {
                        
                        $json=array(
                            "status"=>404,
                            "detalle"=>"Página no encontrada."
                        );

                        echo json_encode($json, true);
                        return;
                    }, 
                };

                $response();

            break;

            case 'facturaCompra.php':

                $facturaCompraController = new FacturaCompraController();

                $response = match($requestMethod){

                    'GET' => function() use ($facturaCompraController, $queryParams, $arrayRutas){

                        if(count(array_filter($arrayRutas)) == 4 && is_numeric(end($arrayRutas))){

                            $facturaCompraController->readOne(end($arrayRutas));

                        }elseif(count(array_filter($arrayRutas)) == 3 && isset($queryParams['clienteID']) &&
                            is_numeric($queryParams['clienteID'])){

                            $facturaCompraController->readAllByClient($queryParams['clienteID']);

                        }else{

                            $json=array(
                                "status"=>404,
                                "detalle"=>"Página no encontrada."
                            );
    
                            echo json_encode($json, true);
                            return;
                        }
                    },

                    'POST' => function() use ($facturaCompraController){

                        if(
                            isset($_POST['clienteID']) && isset($_POST['empleadoID']) &&
                            isset($_POST['plazoID']) && isset($_POST['total']) && isset($_POST['articulos'])
                            ){

                            $datosFactura = array(
                                
                                "clienteID"=>$_POST['clienteID'],
                                "empleadoID"=>$_POST['empleadoID'],
                                "plazoID"=>$_POST['plazoID'],
                                "total"=>$_POST['total'],
                                "articulos"=>[$_POST['articulos']]
                            );

                            $facturaCompraController->create($datosFactura);


                        }else{

                            $json = array(

                                "status" => 404,
                                "detalle" => "No se envió la información necesaria."
                            );
                           
                            echo json_encode($json, true);
                            return;
                        }

                    },
                    /*
                    'PUT' => function() use ($facturaCompraController){

                    },
                    'DELETE' => function() use ($facturaCompraController){

                    },
                    */
                    default => function() {
                        
                        $json=array(
                            "status"=>404,
                            "detalle"=>"Página no encontrada."
                        );

                        echo json_encode($json, true);
                        return;
                    }, 
                };

                $response();

            break;


            case 'deuda.php':

                $deudaController = new DeudaController();

                $response = match($requestMethod){

                    'GET' => function() use ($deudaController, $queryParams, $arrayRutas){

                        if(count(array_filter($arrayRutas)) == 4 && is_numeric(end($arrayRutas))){

                            $deudaController->readOne(end($arrayRutas));
                            
                        }elseif(count(array_filter($arrayRutas)) == 3){

                            if(
                            isset($queryParams['clienteID']) && isset($queryParams['pagado']) &&
                            is_numeric($queryParams['clienteID']) && is_numeric($queryParams['pagado'])
                            ){

                                $deudaController->readAllByClient($queryParams['clienteID'], $queryParams['pagado']);

                            }else{

                                $json=array(
                                    "status"=>404,
                                    "detalle"=>"No se enviaron los datos requeridos."
                                );
    
                                echo json_encode($json, true);
                                return;
                            }

                        } else {
                                
                            $json=array(
                                "status"=>404,
                                "detalle"=>"Página no encontrada"
                            );

                            echo json_encode($json, true);
                            return;
                        }

                    },
                    /*
                    'POST' => function() use ($deudaController){

                    },
                    'PUT' => function() use ($deudaController){

                    },
                    'DELETE' => function() use ($deudaController){

                    },
                    */
                    default => function() {
                        
                        $json=array(
                            "status"=>404,
                            "detalle"=>"Página no encontrada."
                        );

                        echo json_encode($json, true);
                        return;
                    }, 
                };

                $response();

            break;

            case 'detalleCuota.php':

                $detalleCuotaController = new DetalleCuotaController();

                $response = match($requestMethod){

                    'GET' => function() use ($detalleCuotaController){

                    },
                    /*
                    'POST' => function() use ($detalleCuotaController){

                    },
                    */
                    'PUT' => function() use ($detalleCuotaController){

                    },
                    /*
                    'DELETE' => function() use ($detalleCuotaController){

                    },
                    */
                    default => function() {
                        
                        $json=array(
                            "status"=>404,
                            "detalle"=>"Página no encontrada."
                        );

                        echo json_encode($json, true);
                        return;
                    }, 
                };

                $response();

            break;

            default:

                $json=array(
                    "status"=>404,
                    "detalle"=>"Página no encontrada."
                );
                
                echo json_encode($json, true);
                return;
            break;
        }
    }

}elseif(count(array_filter($arrayRutas)) < 3){

    if(count(array_filter($arrayRutas)) == 2){

        $json=array(
            "status"=>200,
            "detalle"=>"Diriga a la página principal"
        );

    }else{

        $json=array(
            "status"=>404,
            "detalle"=>"No encontrado"
        );

    }
    echo json_encode($json, true);
    return;
}

