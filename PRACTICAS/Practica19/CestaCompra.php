<?php
include_once "Producto.php";

class CestaCompra
{
    // ATRIBUTOS
    private $listaProductos = [];

    // CONSTRUCTOR
    public function __construct()
    {
        $this->listaProductos = array();
    }

    // METODOS GET
    public function getListaProductos()
    {
        return $this->listaProductos;
    }

    // METODOS SET
    public function setListaProducto($listaProducto)
    {
        $this->listaProductos = $listaProducto;
    }

    // METODOS AÑADIDOS
    /* Recibe como parametro un objeto de la clase producto
     * Añade el producto al final de la lista de productos
     */
    public function insertarProducto($producto)
    {
        array_push($this->listaProductos, $producto);
    }

    /* Recibe como parametro un objeto de la clase producto
     * Elimina el producto pasado por parametro de la lista de productos
     */
    public function eliminarProducto($producto)
    {
        $this->listaProductos = array_diff($this->listaProductos, array($producto));
    }

    /* Recibe como parametro un objeto de la clase producto
 * Elimina el producto pasado por parametro de la lista de productos
 */
    public function eliminarProductoPorIndice($indice)
    {
        array_splice($this->listaProductos, $indice, 1);
    }

    /*
     * Devuelve un entero con el numero productos en la cesta
     */
    public function getNumeroProductos()
    {
        return is_array($this->listaProductos) ? count($this->listaProductos) : 0;
    }

    /*
     * Vacia la cesta
     */
    public function vaciarCesta()
    {
        unset($this->listaProductos);
        if (isset($_SESSION['lista_productos'])) {
            unset($_SESSION['lista_productos']);
        }
    }

    public function estaVacia()
    {
        return $this->getNumeroProductos() == 0 ? true : false;
    }

    public function muestraProductosCesta()
    {
        foreach ($this->listaProductos as $productoActual) {
            $productoActual->mostrarProducto();
        }
    }


    public function calcularPrecioTotal()
    {
        $total = 0;
        foreach ($this->listaProductos as $producto) {
            $total += $producto->getPVP();
        }
        return $total;
    }

    public function getProducto($indice){
        return $this->listaProductos[$indice]->mostrarProducto();
    }
}
