<?php

class ResponsableV
{
    private $numEmpleado;
    private $numLicencia;
    private $nombre;
    private $apellido;

    public function __construct($numEmp, $numLic, $name, $surname)
    {
        $this->numEmpleado = $numEmp;
        $this->numLicencia = $numLic;
        $this->nombre = $name;
        $this->apellido = $surname;
    }



    public function getNumEmpleado()
    {
        return $this->numEmpleado;
    }

    public function setNumEmpleado($numEmpleado)
    {
        $this->numEmpleado = $numEmpleado;
    }

    public function getNumLicencia()
    {
        return $this->numLicencia;
    }

    public function setNumLicencia($numLicencia)
    {
        $this->numLicencia = $numLicencia;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    public function __toString()
    {
        $info =
            "Número empleado: {$this->getNumEmpleado()} \n" .
            "Número licencia: {$this->getNumLicencia()} \n" .
            "Nombre: {$this->getNombre()} \n" .
            "Apellido: {$this->getApellido()} \n";
        return $info;
    }
}
