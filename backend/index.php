<?php

// Debe agregar la ruta de todos los controladores y modelos existentes del proyecto.

// Espacio para importar los controladores...
require_once "controllers/routes.controller.php";
require_once "controllers/prueba.controller.php";
require_once "controllers/antiguedad.controller.php";
require_once "controllers/articulo.controller.php";
require_once "controllers/categoriaArticulo.controller.php";
require_once "controllers/sucursal.controller.php";
require_once "controllers/cliente.controller.php";
require_once "controllers/detalleCuota.controller.php";
require_once "controllers/deuda.controller.php";
require_once "controllers/direccion.controller.php";
require_once "controllers/empleado.controller.php";
require_once "controllers/facturaCompra.controller.php";
require_once "controllers/genero.controller.php";
require_once "controllers/plazo.controller.php";
require_once "controllers/articuloXFacturaCompra.controller.php";


// Espacio para importar los modelos...
require_once "models/prueba.model.php";
require_once "models/antiguedad.model.php";
require_once "models/articulo.model.php";
require_once "models/categoriaArticulo.model.php";
require_once "models/sucursal.model.php";
require_once "models/cliente.model.php";
require_once "models/detalleCuota.model.php";
require_once "models/deuda.model.php";
require_once "models/direccion.model.php";
require_once "models/empleado.model.php";
require_once "models/facturaCompra.model.php";
require_once "models/genero.model.php";
require_once "models/plazo.model.php";
require_once "models/articuloXFacturaCompra.model.php";

require_once "./utf8_convert.php";

$routes = new RoutesController();
$routes->startRoutes();


