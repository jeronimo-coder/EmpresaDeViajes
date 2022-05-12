<?php

class Terrestre extends Viaje{
    private $comodidadAsiento;

    public function __construct($codigoDestino, $destinoViaje, $importe, $viajeDe, $cantMaxPas, $responsable, $comodidadAsiento)
    {
        parent::__construct($codigoDestino, $destinoViaje, $importe, $viajeDe, $cantMaxPas, $responsable);
        $this->comodidadAsiento = $comodidadAsiento;
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
     * @return bool
     */

    public function venderPasaje($pasajero){
        $venta = parent::venderPasaje($pasajero);
        if($venta < 0){
            if($this->getComodidadAsiento() == "cama"){
                $aumento = parent::getImporte() * 0.25;
                $precioFinal = parent::getImporte() + $aumento;
                parent::setImporte($precioFinal);
            }
            if(parent::getViajeDe() == "ida y vuelta"){
                $precioFinal = $precioFinal * 0.50;
                parent::setImporte($precioFinal);
            }
        }
        return $precioFinal;
    }
}