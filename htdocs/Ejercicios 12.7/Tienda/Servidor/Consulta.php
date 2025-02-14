<?php 
require_once 'Producto.php';
$codEstado=200;
$metodo = $_SERVER['REQUEST_METHOD'];
$mensaje = "OK";


//Comprobar metodo
if ($metodo == 'GET') {
    if(isset($_REQUEST['codigo'])){
        //Mete el producto en productos
        $producto = Producto::getProductoById($_REQUEST['codigo']);

        $devolver['producto'] = ["nombre"=>$producto->getNombre(), "precio"=>$producto->getPrecio(), "stock"=>$producto->getStock()];

    }

    if(isset($_REQUEST['nombre'])){

        $producto = Producto::getProductoByNombre($_REQUEST['nombre']);

        $devolver['producto'] = ["nombre"=>$producto->getNombre(),"precio"=>$producto->getPrecio(), "stock"=>$producto->getStock(), "imagen"=>$producto->getImagen()];
    }

    if (isset($_REQUEST['min']) && isset($_REQUEST['max'])) {
        $productos = Producto::getProductosByRangoPrecio($_REQUEST['min'], $_REQUEST['max']);

        foreach ($productos as $producto) {
            $devolver[] = ['nombre'=>$producto->getNombre(),'precio'=>$producto->getPrecio(),
             'stock'=>$producto->getStock(), 'imagen'=>$producto->getImagen()];
            }

    }

    setCabecera($codEstado,$mensaje); 
    echo json_encode($devolver); //Solo se imprime el json encode de la respuesta

}


    
function setCabecera($codEstado, $mensaje) {  
//Si usamos la funcion setCabecera y establecemos en header un codigo distinto de 200 (status OK) provocará un error en el cliente, 
//por eso es mejor tratar el error en la respuesta devuelta en el array $devolver y el cliente pueda analizar el mensaje
header("HTTP/1.1 $codEstado $mensaje");  
header("Content-Type: application/json;charset=utf-8");  
}
