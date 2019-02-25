<?php

class Opinion
{
    // Atributos
    private $id;
    private $usuario;
    private $fechahora;
    private $titulo;
    private $opinion;

    // constructor
    public function __construct($id, $usuario, $fechahora, $titulo, $opinion)
    {
        $this->id = $id;
        $this->usuario = $usuario;
        $this->fechahora = $fechahora;
        $this->titulo = $titulo;
        $this->opinion = $opinion;
    }


    // metodos getter
    public function getId()
    {
        return $this->id;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function getFechahora()
    {
        return $this->fechahora;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function getOpinion()
    {
        return $this->opinion;
    }

    // metodos setter
    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setUsuario($usuario): void
    {
        $this->usuario = $usuario;
    }

    public function setFechahora($fechahora): void
    {
        $this->fechahora = $fechahora;
    }

    public function setTitulo($titulo): void
    {
        $this->titulo = $titulo;
    }

    public function setOpinion($opinion): void
    {
        $this->opinion = $opinion;
    }
}
