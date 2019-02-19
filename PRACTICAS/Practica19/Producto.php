<?php

class Producto
{
    // ATRIBUTOS DE LA CLASE
    private $cod;
    private $nombre;
    private $nombre_corto;
    private $descripcion;
    private $PVP;
    private $familia;

    // CONSTRUCTOR
    public function __construct($cod, $nombre_corto, $PVP)
    {
        $this->cod = $cod;
        $this->nombre = " ";
        $this->nombre_corto = $nombre_corto;
        $this->descripcion = " ";
        $this->PVP = $PVP;
        $this->familia = " ";
    }

    // METODOS GETTER
    public function getCod()
    {
        return $this->cod;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getNombreCorto()
    {
        return $this->nombre_corto;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getPVP()
    {
        return $this->PVP;
    }

    public function getFamilia()
    {
        return $this->familia;
    }

    // METODOS SETTER
    public function setCod($cod)
    {
        $this->cod = $cod;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setNombreCorto($nombre_corto)
    {
        $this->nombre_corto = $nombre_corto;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function setPVP($PVP)
    {
        $this->PVP = $PVP;
    }

    public function setFamilia($familia)
    {
        $this->familia = $familia;
    }

    public function mostrarProducto(){
        echo $this->getCod() . " " . $this->getNombre() . " " . $this->getNombreCorto() . " " . $this->getDescripcion() . " " . $this->getPVP() . " " . $this->getFamilia();
    }
}
