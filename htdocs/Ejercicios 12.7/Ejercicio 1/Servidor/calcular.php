<?php
  $codEstado=200;
  $metodo = $_SERVER['REQUEST_METHOD'];

  $conversion [] = [];

  if(isset($_REQUEST['moneda']) == "euros"){
    //pasar de euros a pesetas
    $cantidad = $_REQUEST['cantidad'];
    
    $resultado = $euros * 166.386;

    $moneda = "peseta";

    $moneda_inicial = $_REQUEST['euros'];

  }else if(isset($_REQUEST['moneda'] == "pesetas")) {
    //pasar de pesetas a euros

    $cantidad = $_REQUEST['cantidad'];

    $resultado = $pesetas / 166.386;
    
    $moneda_inicial = "peseta";
    $moneda = "euro";

  }else{
     
  }

  //header("HTTP/1.1 $codigo $mensaje");
  header('Content-Type: application/json; charset=utf-8');
  print json_encode(['resultado'=>$resultado, 'moneda'=>$moneda, 
  "cantidad_inicial"=>$cantidad, "moneda_inicial"=>$moneda_inicial]);



?>