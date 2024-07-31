<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<?php

require_once("conection.php");

// Se imprime el arreglo
//echo explode("/",$_SERVER['REQUEST_URI'])[5] . "<br>"; //index.php

// Se imprime la URL
//echo $_SERVER['REQUEST_URI'] . "<br>";

$arrayRutas = explode("/",$_SERVER['REQUEST_URI']);

//echo array_filter($arrayRutas)[3];
//echo count(array_filter($arrayRutas));

if(count(array_filter($arrayRutas)) >= 3){

    echo "hola";
    if(array_filter($arrayRutas)[4] == "index.php"){

        echo "hola";

        $pruebaController = new PruebaController();
        $pruebaController->mostrarPersona();
    }

}
