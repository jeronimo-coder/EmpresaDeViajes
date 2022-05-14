<?php

class Terrestre extends Viaje{
    private $comodidadAsiento;

    public function __construct($codigoDestino, $destinoViaje, $importe/*  $viajeDe */, $cantMaxPas, $responsable)
    {
        parent::__construct($codigoDestino, $destinoViaje, $importe /* $viajeDe */, $cantMaxPas, $responsable);
    }

    public function getComodidadAsiento(){
        return $this->comodidadAsiento;
    }

    public function setComodidadAsiento($comodidadAsiento){
        $this->comodidadAsiento = $comodidadAsiento;
    }

    public function __toString()
    {   
        $info = parent::__toString();
        $info .= "Comodidad Asiento: {$this->getComodidadAsiento()}\n";
        return $info;
    }

     /**  Ticket for sale
     * @param object $pasajero
     * @return int
     */

    public function venderPasaje($pasajero){
        $venta = parent::venderPasaje($pasajero);
        $precioFinal = parent::getImporte();
        if($venta > 0){
            if($this->getComodidadAsiento() == "cama"){
                $aumento = $precioFinal * 0.25;
                $precioFinal += $aumento;
            }
            if(parent::getViajeDe() == "ida y vuelta"){
                $aumento = $precioFinal * 0.50;
                $precioFinal += $aumento;
            }
        }
        return $precioFinal;
    }
}