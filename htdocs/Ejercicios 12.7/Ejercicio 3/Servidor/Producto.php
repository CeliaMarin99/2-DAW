<?php
require_once 'TiendaDB.php';
class Producto {
    private $codigo;
    private $nombre;
    private $precio;
    private $stock;
    private $imagen;

    function __construct($codigo=0, $nombre="", $precio=0, $stock=0, $imagen="") {
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->stock = $stock;
        $this->imagen = $imagen;
    }

    public function insert() {
        $conexion = TiendaDB::connectDB();
        $insercion = "INSERT INTO productos (nombre, precio, stock) VALUES (\"".$this->nombre."\", \"".$this->precio."\", \"".$this->stock."\")";
        $conexion->exec($insercion);
    }
    public function delete() {
        $conexion = TiendaDB::connectDB();
        $borrado = "DELETE FROM productos WHERE codigo=\"".$this->codigo."\"";
        $conexion->exec($borrado);
    }
    public function update() {
        $conexion = TiendaDB::connectDB();
        $actualiza = "UPDATE productos SET nombre=\"".$this->nombre."\", precio=\"".$this->precio."\", imagen=\"".$this->imagen."\" WHERE codigo=\"".$this->codigo."\"";
        $conexion->exec($actualiza);
    }
    public static function getProductos() {
        $conexion = TiendaDB::connectDB();
        $seleccion = "SELECT codigo, nombre, precio, stock, imagen FROM productos ORDER BY nombre";
        $consulta = $conexion->query($seleccion);
        $productos = [];
        while ($registro = $consulta->fetchObject()) {
            $productos[] = new Producto($registro->codigo, $registro->nombre, $registro->precio, $registro->stock, $registro->imagen);
        }
        return $productos;
    }

    public static function getProductosFiltroPrecio($min, $max) {
        $conexion = TiendaDB::connectDB();
        $seleccion = "SELECT codigo, nombre, precio, stock, imagen FROM productos WHERE precio >= ".$min." AND precio <=".$max;
        $consulta = $conexion->query($seleccion);
        $productos = [];
        while ($registro = $consulta->fetchObject()) {
            $productos[] = new Producto($registro->codigo, $registro->nombre, $registro->precio, $registro->stock, $registro->imagen);
        }
        return $productos;
    }

    public static function getProductosFiltroNombre($cad) {
        $conexion = TiendaDB::connectDB();
        $seleccion = "SELECT codigo, nombre, precio, stock, imagen FROM productos WHERE nombre LIKE '%$cad%'";
        $consulta = $conexion->query($seleccion);
        $productos = [];
        while ($registro = $consulta->fetchObject()) {
            $productos[] = new Producto($registro->codigo, $registro->nombre, $registro->precio, $registro->stock, $registro->imagen);
        }
        return $productos;
    }
    public static function getProductoById($id) {
        $conexion = TiendaDB::connectDB();
        $seleccion = "SELECT codigo, nombre, precio, stock, imagen FROM productos WHERE codigo=\"".$id."\"";
        $consulta = $conexion->query($seleccion);
        $registro = $consulta->fetchObject();
        $producto = new Producto($registro->codigo, $registro->nombre, $registro->precio, $registro->stock, $registro->imagen);
        return $producto;
    }
    public static function getProductoByNombre($nombre) {
        $conexion = TiendaDB::connectDB();
        $seleccion = "SELECT codigo, nombre, precio, stock, imagen FROM productos WHERE nombre LIKE \"".$nombre."\"";
        $consulta = $conexion->query($seleccion);
        if ($consulta->rowCount() > 0) {
            $registro = $consulta->fetchObject();
            $producto = new Producto($registro->codigo, $registro->nombre, $registro->precio, $registro->stock, $registro->imagen);
            return $producto;
        }else {
            return false;
        }
    }
    public function añade($cant) {
        $conexion = TiendaDB::connectDB();
        $cant+=$this->stock;
        $actualiza = "UPDATE productos SET stock='$cant' WHERE codigo='$this->codigo'";
        $conexion->exec($actualiza);
    }
    public function vender($cant){
        $conexion = TiendaDB::connectDB();
        $stock=Producto::getProductoById($this->codigo)->getStock();
        $diferencia=$stock-$cant;
        if ($diferencia>=0) {
            $actualiza = "UPDATE productos SET stock=\"".$diferencia."\" WHERE codigo=\"".$this->codigo."\"";
            $conexion->exec($actualiza);
        }
    }
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
