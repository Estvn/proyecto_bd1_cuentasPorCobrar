<?php

// Debe agregar la ruta de todos los controladores y modelos existentes del proyecto.
require_once "controllers/routes.controller.php";
require_once "controllers/prueba.controller.php";
require_once "models/prueba.model.php";

$routes = new RoutesController();
$routes->startRoutes();

