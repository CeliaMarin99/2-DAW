<?php
require_once 'Producto.php';
$codEstado=200;
$metodo = $_SERVER['REQUEST_METHOD'];
$mensaje = "OK";
//Comprobar metodo para saber que hay que hacer
if ($metodo == 'GET') {
  //GET => recuperar información
  if (isset($_REQUEST['min']) && isset($_REQUEST['max'])) {
    $productos = Producto::getProductosFiltroPrecio($_REQUEST['min'], $_REQUEST['max']);
  } else if (isset($_REQUEST['nombre'])) {
    $productos = Producto::getProductosFiltroNombre($_REQUEST['nombre']);
  }
  if (count($productos) == 0) {
    $mensaje = "PRODUCTO NO ENCONTRADO";
    $codEstado = 404;
  } else {
    foreach ($productos as $producto) {
      //Crea en el índice productos un array asociativo 
      $devolver['productos'][] = ['nombre' => $producto->getNombre(), 'precio' => $producto->getPrecio(), 'stock' => $producto->getStock(), 'imagen' =>$producto->getImagen()];
    }
    $mensaje = "PRODUCTO ENCONTRADO";
    $codEstado = 200;
  }
} else if ($metodo == 'POST') {
  //POST => para insertar fila nueva
    $producto = Producto::getProductoByNombre($_REQUEST['nombre']);
    //Si el producto ya existe no puede insertarlo
    if ($producto) {
      $mensaje = "CONFLICTO, PRODUCTO CON MISMO NOMBRE";
      $codEstado = 409;
    }else{
      $producto = new Producto(null, $_REQUEST['nombre'], $_REQUEST['precio'], $_REQUEST['stock'], $_REQUEST['imagen']);
      $producto->insert();
      $mensaje = "PRODUCTO INSERTADO CORRECTAMENTE";
      $codEstado = 200;
    }
}else if ($metodo == 'DELETE') {
  //DELETE => borrar información
  //Para los métodos GET y POST existe $_REQUEST, pero para PUT y DELETE no, así que tenemos que parsear el php://input
    parse_str(file_get_contents("php://input"),$parametros);//Siempre es "php://input"
    $producto = Producto::getProductoByNombre($parametros['nombre']);
    if ($producto) {
      $producto->delete();
      $mensaje = "PRODUCTO BORRADO CORRECTAMENTE";
      $codEstado=200;
    }else {
      $mensaje = "PRODUCTO NO ENCONTRADO";
      $codEstado=404;
    }
}else if ($metodo == 'PUT') {
  //PUT => modificar información
  //Para los métodos GET y POST existe $_REQUEST, pero para PUT y DELETE no, así que tenemos que parsear el php://input
    parse_str(file_get_contents("php://input"),$parametros);
    $producto = Producto::getProductoByNombre($parametros['nombre']);
    if ($producto) {
      $producto->añade($parametros['cantidad']);
      $mensaje = "STOCK AÑADIDO CORRECTAMENTE";
      $codEstado=200;
    }else {
      $mensaje = "PRODUCTO NO ENCONTRADO";
      $codEstado=404;
    }
  }
  
  setCabecera($codEstado,$mensaje); 
  echo json_encode($devolver); //Solo se imprime el json encode de la respuesta
  
function setCabecera($codEstado, $mensaje) {  
  //Si usamos la funcion setCabecera y establecemos en header un codigo distinto de 200 (status OK) provocará un error en el cliente, 
  //por eso es mejor tratar el error en la respuesta devuelta en el array $devolver y el cliente pueda analizar el mensaje
  header("HTTP/1.1 $codEstado $mensaje");  
  header("Content-Type: application/json;charset=utf-8");  
}  