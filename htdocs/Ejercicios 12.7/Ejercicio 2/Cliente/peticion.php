<?php 
$url ="http://localhost//PHP/Ejercicios%2012.7/Ejercicio%202/Servidor/CrearBaraja.php";
if(isset($_REQUEST['cantidad'])){
    $parametros = "?cantidad=".$_REQUEST['cantidad'];
    $data = @file_get_contents( $url . $parametros);
    $respuesta = json_decode($data);

     mostrarDatos($url, $parametros);
}

function mostrarEstado($respuesta){
    echo "STATUS: ".$respuesta->codEstado;
    echo "<br>".$respuesta->mensaje;
    }
    

function mostrarDatos($url, $parametros){
    $data = @file_get_contents($url . $parametros);

    $respuesta = json_decode($data);

    $codEstado = substr($http_response_header[0],9,3);
    $mensaje = substr($http_response_header[0],13);

    if ($codEstado==200) {
        echo "<table border='1'><tr><th>Numero</th><th>Palo</th></tr>";
        foreach ($respuesta->cartas as $carta) {
        echo "<tr><td>".$carta->numero."</td>";
        echo "<td>".$carta->palo."</td></tr>";
        }
        echo "</table>";
        }else {
        mostrarEstado($respuesta);
        }
        ?>
        <a href="index.php"><h3>VOLVER A LA PÁGINA DE CONSULTAS</h3></a>
        <?php
        
}

