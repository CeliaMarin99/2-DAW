<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    


<?php 
$url = "http://localhost//PHP/Ejercicios%2012.7/Tienda/Servidor/Consulta.php";

if(isset($_REQUEST['codigo'])){
    $parametros = "?codigo=".$_REQUEST['codigo'];
    mostrarDatos($url, $parametros);
}

if(isset($_REQUEST['nombre'])){
    $parametros = "?nombre=".$_REQUEST['nombre'];
    mostrarDatos($url, $parametros);
}

if (isset($_REQUEST['min']) && isset($_REQUEST['max'])) {
    $parametros ="?min=".$_REQUEST['min']."&max=".$_REQUEST['max'];
    mostrarDatos($url, $parametros);
}

function mostrarEstado($codEstado, $mensaje) {
    echo "STATUS: ".$codEstado;
    echo "<br>".$mensaje;
    }

    function mostrarDatos($url, $parametros) {
        $data = @file_get_contents($url . $parametros);
        $respuesta = json_decode($data);
        $codEstado=substr($http_response_header[0],9,3);
        $mensaje=substr($http_response_header[0],13);
        if ($codEstado==200) {

        echo "<table border='1'><tr><th>Nombre</th><th>Precio</th><th>stock</th><th>Imagen</th></tr>" ;   
            foreach ($respuesta as $producto) {
        ?>
            <tr>
                <td><?=$producto->nombre?></td>
                <td><?=$producto->precio?></td>
                <td><?=$producto->stock?></td>
                <td><img src="img/<?=$producto->imagen?>" alt=""></td>
            </tr>

        <?php
                
            }
        
        }else {
        mostrarEstado($codEstado, $mensaje);
        }
        echo "<a href='index.php'><h3>VOLVER A LA PÁGINA DE CONSULTAS</h3></a>";
    
    }
    ?>
    </body>
    </html>