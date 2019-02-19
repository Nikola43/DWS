<?php
class Vivienda {

    // ATRIBUTOS
    private $id;
    private $tipo;
    private $zona;
    private $direccion;
    private $numero_dormitorios;
    private $precio;
    private $tamanio;
    private $extras;
    private $foto;
    private $observaciones;

    // CONSTRUCTOR
    public function __construct($id, $tipo, $zona, $direccion, $numero_dormitorios, $precio, $tamanio, $extras, $foto, $observaciones)
    {
        $this->id = $id;
        $this->tipo = $tipo;
        $this->zona = $zona;
        $this->direccion = $direccion;
        $this->numero_dormitorios = $numero_dormitorios;
        $this->precio = $precio;
        $this->tamanio = $tamanio;
        $this->extras = $extras;
        $this->foto = $foto;
        $this->observaciones = $observaciones;
    }

    //GETTERS
    public function getId()
    {
        return $this->id;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function getZona()
    {
        return $this->zona;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function getNumeroDormitorios()
    {
        return $this->numero_dormitorios;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function getTamanio()
    {
        return $this->tamanio;
    }

    public function getExtras()
    {
        return $this->extras;
    }

    public function getFoto()
    {
        return $this->foto;
    }

    public function getObservaciones()
    {
        return $this->observaciones;
    }

    // SETTERS
    public function setTipo($tipo): void
    {
        $this->tipo = $tipo;
    }

    public function setZona($zona): void
    {
        $this->zona = $zona;
    }

    public function setDireccion($direccion): void
    {
        $this->direccion = $direccion;
    }

    public function setNumeroDormitorios($numero_dormitorios): void
    {
        $this->numero_dormitorios = $numero_dormitorios;
    }

    public function setPrecio($precio): void
    {
        $this->precio = $precio;
    }

    public function setTamanio($tamanio): void
    {
        $this->tamanio = $tamanio;
    }

    public function setExtras($extras): void
    {
        $this->extras = $extras;
    }

    public function setFoto($foto): void
    {
        $this->foto = $foto;
    }

    public function setObservaciones($observaciones): void
    {
        $this->observaciones = $observaciones;
    }
}
