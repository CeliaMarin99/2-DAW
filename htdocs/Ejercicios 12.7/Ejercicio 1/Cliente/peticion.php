<?php
//Realiza la peticion al servidor

 $url = "http://localhost/PHP/Ejercicios%2012.7/Ejercicio%201/Servidor/calcular.php";

 if(isset($_REQUEST['pesetas'])){
    //Recogemos la cantidad que se quiere pasar a pesetas
    $parametros = "?cantidad=". $_REQUEST['cantidad']."&moneda=".$_REQUEST['pesetas'];
    $data = @file_get_contents ($url . $parametros);
    mostrarDatos($url, $parametros);

 }else if(isset($_REQUEST['euros'])){
    $parametros = "?pesetas=" . $_REQUEST['cantidad']."&moneda=".$_REQUEST['euros'];
    $data = file_get_contents( $url . $parametros);
    mostrarDatos($url, $parametros);
 }


function mostrarEstado($codEstado, $mensaje){
    echo "STATUS: ".$codEstado;
    echo "<br>".$mensaje;
}
function mostrarDatos($url, $parametros){

    $data = @file_get_contents($url . $parametros);
    $respuesta = json_decode($data);

    $codEstado=substr($http_response_header[0],9,3);
    $mensaje=substr($http_response_header[0],13);

    if ($http_response_header[0]=="HTTP/1.1 200 OK") {
       
      


    }else {
        mostrarEstado($codEstado, $mensaje);
        echo $http_response_header[0];
    }

    ?>
     <a href="index.php"><h3>Volver a la página principal</h3></a> 
    <?php

    function pideServicio($url, $datos, $metodo){
        $opciones = [
           "http"=> [
            "header"=> "Content-type: application/x-www-form-urlencoded\r\n",
            "method"=> $metodo,
            "content"=> http_build_query($datos)
            ],
        ];

        $contexto = stream_context_create($opciones);
        @file_get_contents($url, false, $contexto);
        $codEstado=substr($http_response_header[0],9,3);
        $mensaje=substr($http_response_header[0],13);
        mostrarEstado($codEstado, $mensaje);
    }
}
