<?php
$url = "http://localhost/Curso%20Actual/Ejercicios%20Adicionales/Tema12/EjemploLibro_RESTFUL/consultaProductos.php";
if (isset($_REQUEST['filtraPrecio'])) {
    $parametros = '?min=' . $_REQUEST['min'] . '&max=' . $_POST['max'];
    $data = file_get_contents ($url . $parametros);
    mostrarDatos(json_decode($data));
} else if (isset($_POST['filtraNombre'])) {
    $parametros = "?nombre=" . $_POST['nombre'];
    $data = file_get_contents( $url . $parametros);
    mostrarDatos(json_decode($data));        
} else if (isset($_POST['insertar'])) {

    //crear funcion para insertar
    $datos = ["nombre" =>  $_REQUEST['nombre'], "precio" =>  $_REQUEST['precio'], "stock" =>  $_REQUEST['stock']];
    $opciones = [
        "http" => [
            "header" => "Content-type: application/x-www-form-urlencoded\r\n",
            "method" => "POST",
            "content" => http_build_query($datos) # Agregar el contenido del formulario definido anteriormente en $datos
        ],
    ];
    $contexto = stream_context_create($opciones);
    $data = file_get_contents($url, false, $contexto);
    mostrarEstado(json_decode($data));
} else if (isset($_POST['borrar'])) {
    $datos = ["nombre" =>  $_REQUEST['nombre']];
    $opciones = [
        "http" => [
            "header" => "Content-type: application/x-www-form-urlencoded\r\n",
            "method" => "DELETE",
            "content" => http_build_query($datos), # Agregar el contenido del formulario definido anteriormente en $datos
        ],
    ];
    $contexto = stream_context_create($opciones);
    $data = file_get_contents($url, false, $contexto);
    mostrarEstado(json_decode($data));
} else if (isset($_POST['stock'])) {
    //Actualizar STOCK
    $datos = ["nombre" =>  $_REQUEST['nombre'], "cantidad" =>  $_REQUEST['cantidad']];
    $opciones = [
        "http" => [
            "header" => "Content-type: application/x-www-form-urlencoded\r\n",
            "method" => "PUT",
            "content" => http_build_query($datos), # Agregar el contenido del formulario definido anteriormente en $datos
        ],
    ];
    $contexto = stream_context_create($opciones);
    $data = file_get_contents($url, false, $contexto);
    mostrarEstado(json_decode($data));
}
function mostrarEstado($respuesta){
    echo "STATUS: ".$respuesta->codEstado;
    echo "<br>".$respuesta->mensaje;
}
function mostrarDatos($respuesta){
    if ($respuesta->codEstado==200) {
        echo "<table border='1'><tr><th>Nombre</th><th>Precio</th><th>stock</th></tr>";
        foreach ($respuesta->productos as $producto) {
            echo "<tr><td>".$producto->nombre."</td>";
            echo "<td>".$producto->precio."</td>";
            echo "<td>".$producto->stock."</td></tr>";
        }
        echo "</table>";
    }else {
        mostrarEstado($respuesta);
    }
    ?>
     <a href="index.php"><h3>VOLVER A LA PÁGINA DE CONSULTAS</h3></a> 
    <?php
}