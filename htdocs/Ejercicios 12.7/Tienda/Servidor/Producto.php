<?php 
require_once 'TiendaDB.php';
class Producto {

    private $codigo;
    private $nombre;
    private $precio;
    private $stock;
    private $imagen;

    //Constructor
    function __construct($codigo=0, $nombre="", $precio=0, $stock=0, $imagen="") {
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->stock = $stock;
        $this->imagen = $imagen;
    }
     //BUSCAR POR ID
     public static function getProductoById($id) {
        $conexion = TiendaDB::connectDB();
        $seleccion = "SELECT codigo, nombre, precio, stock, imagen FROM productos WHERE codigo=\"".$id."\"";
        $consulta = $conexion->query($seleccion);
        $registro = $consulta->fetchObject();
        $producto = new Producto($registro->codigo, $registro->nombre, $registro->precio, $registro->stock, $registro->imagen);
        return $producto;
    }

    //BUSCAR POR NOMBRE
    public static function getProductoByNombre($nombre){
        $conexion = TiendaDB::connectDB();
        $seleccion = "SELECT codigo, nombre, precio, stock, imagen FROM productos WHERE nombre LIKE '%$nombre%'";
        $consulta = $conexion->query($seleccion);
        $registro = $consulta->fetchObject();
        $producto = new Producto($registro->codigo, $registro->nombre, $registro->precio, $registro->stock, $registro->imagen);
        return $producto;
    }
    
    //BUSCAR PRODUCTOS POR RANGO DE PRECIO
    public static function getProductosByRangoPrecio($min, $max){
        $conexion = TiendaDB::connectDB();
        // Consulta SQL con un rango de precio
        $seleccion = "SELECT codigo, nombre, precio, stock, imagen FROM productos WHERE precio >= ".$min." AND precio <=".$max;
        $consulta = $conexion->query($seleccion);
        $productos = [];
        while ($registro = $consulta->fetchObject()) {
            $productos[] = new Producto($registro->codigo, $registro->nombre, $registro->precio, $registro->stock, $registro->imagen);
        }
        return $productos;
    }
    
    //GETTERS Y SETTERS
    public function getCodigo()
    {
        return $this->codigo;
    }
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }
    public function getPrecio()
    {
        return $this->precio;
    }
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }
    public function getImagen()
    {
        return $this->imagen;
    }
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }
    public function getStock()
    {
        return $this->stock;
    }



   
}