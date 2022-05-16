<?php

class Aereos extends Viaje
{
    private $numVuelo;
    private $categoriaAsiento;
    private $nombreAerolinea;
    private $cantidadEscalas;

    public function __construct($codigoDestino, $destinoViaje, $importe, /* $viajeDe, */ $cantMaxPas, $responsable, $numVuelo,/*  $categoriaAsiento */ $nombreAerolinea, $cantidadEscalas)
    {
        parent::__construct($codigoDestino, $destinoViaje, $importe, /* $viajeDe,  */ $cantMaxPas, $responsable);
        $this->numVuelo = $numVuelo;
        /*         $this->categoriaAsiento = $categoriaAsiento; */
        $this->nombreAerolinea = $nombreAerolinea;
        $this->cantidadEscalas = $cantidadEscalas;
    }


    public function getNumVuelo()
    {
        return $this->numVuelo;
    }

    public function setNumVuelo($numVuelo)
    {
        $this->numVuelo = $numVuelo;
    }

    public function getCategoriaAsiento()
    {
        return $this->categoriaAsiento;
    }

    public function setCategoriaAsiento($categoriaAsiento)
    {
        $this->categoriaAsiento = $categoriaAsiento;
    }

    public function getNombreAerolinea()
    {
        return $this->nombreAerolinea;
    }

    public function setNombreAerolinea($nombreAerolinea)
    {
        $this->nombreAerolinea = $nombreAerolinea;
    }

    public function getCantidadEscalas()
    {
        return $this->cantidadEscalas;
    }

    public function setCantidadEscalas($cantidadEscalas)
    {
        $this->cantidadEscalas = $cantidadEscalas;
    }

    public function __toString()
    {
        $info = parent::__toString();
        $info .= "Número vuelo: {$this->getNumVuelo()}\n" .
            "Categoria de asiento: {$this->getCategoriaAsiento()}\n" .
            "Nombre aerolinea: {$this->getNombreAerolinea()}\n" .
            "Cantidad de escalas: {$this->getCantidadEscalas()}\n";
        return $info;
    }

    /**  Ticket for sale
     * @param object $pasajero
     * @return bool
     */

    public function venderPasaje($pasajero)
    {
        $asiento = $this->getCategoriaAsiento();
        $escalas = $this->getCantidadEscalas();
        $precioFinal = parent::getImporte();
        $venta = parent::venderPasaje($pasajero);
        if ($venta > 0) {
            if ($asiento == "primera clase" && $escalas == 0) {
                $aumento = $precioFinal * 0.40;
                $precioFinal += $aumento;
            } elseif ($asiento == "primera clase" && $escalas > 0) {
                $aumento = $precioFinal * 0.60;
                $precioFinal += $aumento;
            }
            if (parent::getViajeDe() == "ida y vuelta") {
                $aumento = $precioFinal * 0.50;
                $precioFinal += $aumento;
            }
        }
        return $precioFinal;
    }
}
