<?php

class Conection{

    function db2Connect() {

        $database = 'PRUEBA';
        $user = 'db2inst1';
        $password = 'EKl676:(';
        $hostname = 'localhost';
        $port = '25000';
    
        // Cadena de conexión
        $conn_string = "DATABASE=$database;HOSTNAME=$hostname;PORT=$port;PROTOCOL=TCPIP;UID=$user;PWD=$password;";
    
        // Conectar a la base de datos
        $conn = db2_connect($conn_string, '', '');
    
        if ($conn) {
            return $conn;
        } else {
            die("Error en la conexión: " . db2_conn_errormsg());
        }
    }
    
    function db2Disconnect($conn) {

        db2_close($conn);
    }

    static public function conect(){

        $dataBaseName = "PRUEBA";
        $hostName = "localhost";
        $port = 25000;
        //$dataSourceName = "ibm:DRIVER={IBM DB2 ODBC DRIVER};DATABASE=$dataBaseName;HOSTNAME=$hostName;PORT=$port;PROTOCOL=TCPIP;";
        $dataSourceName = "odbc:DRIVER={IBM DB2 ODBC DRIVER};DATABASE=$dataBaseName;HOSTNAME=$hostName;PORT=$port;PROTOCOL=TCPIP;";

        $userName = "db2inst1";
        $password = "EKl676:(";

        try{

            $link = new PDO($dataSourceName, $userName, $password);
            //$link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $link->exec("set names utf8");
            echo "¡conexión exitosa!";
            return $link;

        }catch(PDOException $e){

            echo "Error al conectarse al servicio DB2." . $e->getMessage();
            return null;
        }
    }
}