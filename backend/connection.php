<?php

class Connection {

    static public function connect(){

        $dataBaseName = "cuentas";
        $hostName = "localhost";
        $port = 25000;
        //$dataSourceName = "ibm:DRIVER={IBM DB2 ODBC DRIVER};DATABASE=$dataBaseName;HOSTNAME=$hostName;PORT=$port;PROTOCOL=TCPIP;";
        $dataSourceName = "odbc:DRIVER={IBM DB2 ODBC DRIVER};DATABASE=$dataBaseName;HOSTNAME=$hostName;PORT=$port;PROTOCOL=TCPIP;";

        $userName = "db2admin";
        $password = "00101011";

        try{

            $link = new PDO($dataSourceName, $userName, $password);
            //$link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //$link->exec("set names utf8");
            echo "¡conexión exitosa!";
            return $link;

        }catch(PDOException $e){

            echo "Error al conectarse al servicio DB2." . $e->getMessage();
            return null;
        }
    }
    
    /*
    public static function odbcConnect() {
        $database = 'cuentas';          // Nombre de la base de datos
        $hostname = 'localhost';     // Nombre del host
        $user = 'db2admin';          // Usuario de la base de datos
        $password = '00101011';      // Contraseña de la base de datos
        $port = 25000;               // Puerto de conexión

        // Crear la cadena de conexión
        $driver = "DRIVER={IBM DB2 ODBC DRIVER};";
        $dsn = "DATABASE=$database; " .
               "HOSTNAME=$hostname;" .
               "PORT=$port; " .
               "PROTOCOL=TCPIP; " .
               "UID=$user;" .
               "PWD=$password;";
        
        $conn_string = $driver . $dsn;

        // Conectar a la base de datos
        $conn = odbc_connect($conn_string, '', '');

        if ($conn) {
            return $conn;
        } else {
            die("Error en la conexión: " . odbc_errormsg());
        }
    }

    public static function odbcDisconnect($conn) {
        odbc_close($conn);
    }
    */

    /*
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
    */

}