<?php

class Connection {

static public function connect(){

    $dataBaseName = "cuentas";
    $hostName = "localhost";
    $port = 25000;
    $dataSourceName = "odbc:DRIVER={IBM DB2 ODBC DRIVER};DATABASE=$dataBaseName;HOSTNAME=$hostName;PORT=$port;PROTOCOL=TCPIP;";

    //$userName = "db2admin";
    //$password = "12345678";

    $userName = "db2admin";
    $password = "12345678";

    try {
        $link = new PDO($dataSourceName, $userName, $password);
        $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $link;

    } catch(PDOException $e) {
        echo "Error al conectarse al servicio DB2." . $e->getMessage();
        return null;
    }
}
}
