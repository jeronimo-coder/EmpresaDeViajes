<?php

class Pasajero{
    private $nombre;
    private $apellido;
    private $numDocumento;
    private $telefono;

    public function __construct($name, $surname, $dni, $phone)
    {
        $this->nombre = $name;
        $this->apellido = $surname;
        $this->numDocumento = $dni;
        $this->telefono = $phone;
    }

    

    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function getApellido(){
        return $this->apellido;
    }

    public function setApellido($apellido){
        $this->apellido = $apellido;
    }

    public function getNumDocumento(){
        return $this->numDocumento;
    }

    public function setNumDocumento($numDocumento){
        $this->numDocumento = $numDocumento;
    }

    public function getTelefono(){
        return $this->telefono;
    }

    public function setTelefono($telefono){
        $this->telefono = $telefono;
    }

    public function __toString()
    {
        $info = "Nombre: {$this->getNombre()}".
        "Apellido: {$this->getApellido()}".
        "DNI: {$this->getNumDocumento()}".
        "Telefono: {$this->getTelefono()}";
        return $info;
    }
    
}
