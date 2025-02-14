<?php

$codEstado=200;
$metodo = "OK";

if(isset($_REQUEST['cantidad'])){

    if($_REQUEST['cantidad'] < 1 || $_REQUEST['cantidad']> 40){
        $codEstado = 400;
        $mensaje = "El número debe ser mayor a 1 o menor que 40";
    }else{
        $palos = ["bastos", "oro", "copas", "espadas"];
        $cantidad = $_REQUEST['cantidad'];
        $devolver['cartas'] =[]; //array que se muestra
        $cartasGeneradas = []; // Para asegurarnos de no repetir cartas

        for ($i=0; $i<$cantidad; $i++){
            $numero = rand(1,12);
            $palo = $palos[rand(0,3)];

              // Verificar si ya existe esta carta (mismo número y palo)
              while (in_array(['numero' => $numero, 'palo' => $palo], $cartasGeneradas)) {
                $numero = rand(1, 12); // Generar un nuevo número
                $palo = $palos[rand(0,3)];//Generar un nuevo palo
            }

            // Añadir la carta a la lista de generadas
            $cartasGeneradas[] = ['numero' => $numero, 'palo' => $palo];

            // Añadir la carta al array de devolver
            $devolver['cartas'][] = ['numero'=>$numero, 'palo'=>$palo];

        }

        $mensaje = "BARAJA CREADA CON EXITO";
}


header("HTTP/1.1 $codEstado $mensaje");
header('Content-Type: application/json; charset=utf-8');
print json_encode($devolver);

}