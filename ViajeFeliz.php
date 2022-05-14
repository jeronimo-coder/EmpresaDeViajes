<?php

class Viaje{
    private $codigoViaje;
    private $destinoViaje;
    private $importe;
    private $viajeDe;
    private $cantidadMaxPasajeros;
    private $pasajeros = [];
    private $responsable;

    public function __construct($codigo, $destino, $importe/* $viajeDe */ ,$maxPasajeros, $responsable){
        $this->codigoViaje = $codigo;
        $this->destinoViaje = $destino;
        $this->importe = $importe;
        /* $this->viajeDe = $viajeDe; */
        $this->cantidadMaxPasajeros = $maxPasajeros;
        $this->responsable = $responsable;
    }

    public function getCodigo(){
        return $this->codigoViaje;
    }

    public function getDestino(){
        return $this->destinoViaje;
    }

    public function getMaxPasajeros(){
        return $this->cantidadMaxPasajeros;
    }

    public function getImporte(){
        return $this->importe;
    }

    public function setImporte($importe){
        $this->importe = $importe;
    }

    public function getViajeDe(){
        return $this->viajeDe;
    }

    public function setViajeDe($viajeDe){
        $this->viajeDe = $viajeDe;
    }

    public function getPasajeros(){
        return $this->pasajeros;
    }

    public function setCodigo($cod){
        $this->codigoViaje = $cod;
    }

    public function setDestino($destino){
        $this->destinoViaje = $destino;
    }

    public function setMaxPasajeros($max){
        $this->cantidadMaxPasajeros = $max;
    }

    public function setPasajeros($pasajero){
        $this->pasajeros = $pasajero;
    }

    public function getResponsable(){
        return $this->responsable;
    }

    public function setResponsable($responsable){
        $this->responsable = $responsable;
    }

    /** METODO PARA AGREGAR PASAJERO
     * @param object $pasajeroNuevo
     * @return bool
     */
    public function agregarPasajero($pasajeroNuevo){
        $array = $this->getPasajeros();
        $n = count($array);
        $bolean = true;
        if($n == 0){
            $bolean = true;
        }else{
            for($i = 0; $i < $n; $i++){
                if($pasajeroNuevo->getNumDocumento() == $array[$i]->getNumDocumento()){
                $bolean = false;
                }
            }
        }
        
        if($bolean == true){
            array_push($array, $pasajeroNuevo);
            $this->setPasajeros($array);
        }
        return $bolean;
    }


    /** QUITAR PASAJERO DEL VIAJE
     * @param array @pasajero
     * @return bool
     */

    public function quitarPasajero($dniPasajero){
        $arrayNuevo = $this->getPasajeros();
        $n = count($arrayNuevo);
        $bolean = false;
        if($n == 0){
            $bolean = false;
        }else{
            for($i = 0; $i < $n; $i++){
                if($dniPasajero == $arrayNuevo[$i]->getNumDocumento()){
                    $num = $i;
                    $bolean = true;
                }
            }
        } 
        if($bolean == true){
            array_splice($arrayNuevo, $num, 1);
            $this->setPasajeros($arrayNuevo);
        } 
         return $bolean;
    }

    /** MODIFICAR DATOS DE UN PASAJERO
     * @param string $pasajero1
     * @return bool
     */

    public function modificarPasajero($pasajero1){
        $array = $this->getPasajeros();
        $n = count($array);
        $bolean = false;
        if($n == 0){
            $bolean = false;
        }else{
            for($i = 0; $i < $n; $i++){
                if($pasajero1 == $array[$i]->getNumDocumento()){
                    echo "Ingrese los nuevo datos: \n";
                    $nuevosDatos = obtenerDatos("pasajero");
                    $clave = array_search($array[$i], $array);
                    $array[$clave] = $nuevosDatos;
                    $this->setPasajeros($array);
                    $bolean = true;
                }
            }           
        }       
        return $bolean;
    }

    public function mostrarInfoPasajeros(){
        $datos = "";
        foreach($this->getPasajeros() as $key => $value){
            $nombre = $value->getNombre();
            $apellido = $value->getApellido();
            $dni = $value->getNumDocumento();
            $telefono = $value->getTelefono();
            $datos .= "
            Nombre: $nombre.\n
            Apellido: $apellido.\n
            DNI: $dni.\n
            Telefono: $telefono.\n
            ";
        }
        return $datos;
    }


    /** We see if there is a place available on the trip to sell a ticket
     * @return bool
     */

    public function hayPasajesDisponibles(){
        $bolean = false;
        if((count($this->getPasajeros())) < $this->getMaxPasajeros()){
            $bolean = true;
        }
        return $bolean;
    }

    /**  Ticket for sale
     * @param object $pasajero
     * @return int
     */
    public function venderPasaje($pasajero){
        $precioVenta = 0;
        $pasajerosActuales = $this->getPasajeros();
        $n = count($pasajerosActuales);
        if($this->hayPasajesDisponibles()){
            $pasajerosActuales[$n] = $pasajero;
            $this->setPasajeros($pasajerosActuales);
            $precioVenta = $this->getImporte();
        }
        return $precioVenta;
    }
    
    public function __toString(){
        $pasajeros = $this->mostrarInfoPasajeros();
        /* $pasajeros = $this->getPasajeros(); */
        $responsable = $this->getResponsable();
        $array = $this->getPasajeros();
        $cantidadPasajero = count($array);
        $informacion = "
        El viaje será a: {$this->getDestino()}.\n
        el codigo es: {$this->getCodigo()}.\n
        el max de pasajeros es: {$this->getMaxPasajeros()}.\n
        la cantidad actual es: $cantidadPasajero.\n
        Datos de pasajeros: $pasajeros.\n
        Datos del responsable: \n $responsable
        ";
        return $informacion;
    }   


}
