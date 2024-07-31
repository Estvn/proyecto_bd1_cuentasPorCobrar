<?php

class PruebaController{

    public function mostrarPersona(){

        $prueba = PruebaModel::mostrarPrueba();

        if(empty($prueba)){

            $json=array(
                "status"=>404,
                "detalle"=>"Está vacío"
            );

            echo json_encode($json, true);
            return;
            
        }else{

            $json = array(
                "status"=>200,
                "detalle"=>$prueba
            );
    
            echo json_encode($json, true);
            return;
        }
    }
}