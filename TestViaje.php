<?php

include_once('ViajeFeliz.php');
include_once('pasajero.php');
include_once('responsable.php');
include_once('terrestre.php');
include_once('aereos.php');

echo "Sea bienvenido a Viaje Feliz! \n";
echo "Ingrese los datos correspondientes al viaje\n";
echo "El viaje será en micro o avion?: ";
$tipo = trim(fgets(STDIN));
echo "Ingrese el codigo del viaje: \n";
$codigoViaje = trim(fgets(STDIN));
echo "Ingrese el destino del viaje: \n";
$destinoViaje = trim(fgets(STDIN));
echo "Ingrese el importe del viaje \n";
$importe = trim(fgets(STDIN));
echo "Ingrese la cantidad max de pasajeros: \n";
$maxPasajerosViaje = trim(fgets(STDIN));
echo "Responsable del viaje: \n";
$responsable = obtenerDatos("responsable");

if ($tipo == "avion") {
    echo "Ingrese el número de vuelo: ";
    $numVuelo = trim(fgets(STDIN));
    /* echo "Ingrese la categoria del asiento: ";
    $categoriaAsiento = trim(fgets(STDIN)); */
    echo "Ingrese el nombre de la aerolinea: ";
    $nombreAerolinea = trim(fgets(STDIN));
    echo "La cantidad de escalas: ";
    $cantidadEscalas = trim(fgets(STDIN));
    $viaje1 = new Aereos(
        $codigoViaje,
        $destinoViaje,
        $importe, /*$viajeDe */
        $maxPasajerosViaje,
        $responsable,
        $numVuelo,/* $categoriaAsiento, */
        $nombreAerolinea,
        $cantidadEscalas
    );
} elseif ($tipo == "micro") {
    $viaje1 = new Terrestre($codigoViaje, $destinoViaje, $importe/* , $viajeDe  */, $maxPasajerosViaje, $responsable);
}

$inicializar = true;

do {
    echo menu();
    $opcion = trim(fgets(STDIN));
    switch ($opcion) {
        case '1':
            echo $viaje1;
            break;

        case '2':
            if ($viaje1->hayPasajesDisponibles()) {
                echo "Ingrese los datos del pasajero: \n";
                $pasajero = obtenerDatos("pasajero");
                if ($viaje1->agregarPasajero($pasajero)) {
                    echo "Agregado con exito!";
                } else {
                    echo "El pasajero ya se encuentra agendado.";
                }
            } else {
                echo "No queda más lugar.";
            }
            break;

        case '3':
            if (count($viaje1->getPasajeros()) == 0) {
                echo "No hay pasajeros que modificar";
            } else {
                echo "Ingrese el DNI del pasajero a modificar: \n";
                $pasajero = trim(fgets(STDIN));
                if ($viaje1->modificarPasajero($pasajero)) {
                    echo "Modificado con exito.";
                } else {
                    echo "Este pasajero no se encuentra agendado.";
                }
            }
            break;

        case '4':
            if (count($viaje1->getPasajeros()) == 0) {
                echo "No hay pasajeros que quitar";
            } else {
                echo "Ingrese el DNI del pasajero a quitar: \n";
                $pasajeroQuitar = trim(fgets(STDIN));
                if ($viaje1->quitarPasajero($pasajeroQuitar)) {
                    echo "Quitado del viaje con exito.";
                } else {
                    echo "Este pasajero no se encuentra agendado.";
                }
            }
            break;

        case '5':
            echo "Ingrese el nuevo destino: \n";
            $destinoNuevo = trim(fgets(STDIN));
            $viaje1->setDestino($destinoNuevo);
            break;

        case '6':
            echo "Ingrese el nuevo codigo del viaje: \n";
            $codigoNuevo = trim(fgets(STDIN));
            $viaje1->setCodigo($codigoNuevo);
            break;

        case '7':
            echo "Modificar cantidad de asientos disponibles: \n";
            $nuevoMax = trim(fgets(STDIN));
            $nuevoMax = intval($nuevoMax);
            $viaje1->setMaxPasajeros($nuevoMax);
            break;

        case '8':
            echo "Datos del responsable: ";
            $responsableV = obtenerDatos("responsable");
            $viaje1->setResponsable($responsableV);
            break;

        case '9':
            echo "Ingrese los datos del pasajero: ";
            $pasajero = obtenerDatos("pasajero");
            if ($tipo == "micro") {
                echo "El viaje es de (ida) o (vuelta)? Coloque (ida y vuelta) si es el caso: \n";
                $viajeDe = trim(fgets(STDIN));
                $viaje1->setViajeDe($viajeDe);
                echo "Ingrese el tipo de butaca: ";
                $butaca = trim(fgets(STDIN));
                $viaje1->setComodidadAsiento($butaca);
            } elseif ($tipo == "avion") {
                echo "El viaje es de (ida) o (vuelta)? Coloque (ida y vuelta) si es el caso: \n";
                $viajeDe = trim(fgets(STDIN));
                $viaje1->setViajeDe($viajeDe);
                echo "Ingrese la categoria del asiento: ";
                $categoriaAsiento = trim(fgets(STDIN));
                $viaje1->setCategoriaAsiento($categoriaAsiento);
            }
            $precioPasaje = $viaje1->venderPasaje($pasajero);
            echo "El precio del pasaje fue: $precioPasaje";
            break;

        case '10':
            $inicializar = false;
    }
} while ($inicializar);

function menu()
{
    $menu = "
    1 - Informacion sobre el viaje.\n
    2 - Agregar pasajero.\n
    3 - Modificar datos del pasajero.\n
    4 - Eliminar pasajero.\n
    5 - Modificar destino del viaje.\n
    6 - Modificar codigo del viaje.\n
    7 - Modificar la cantidad de asientos habilitados.\n
    8 - Modificar datos del responsable.\n
    9 - Vender boleto.\n
    10 - Salir.\n";
    return $menu;
}

/** Función que obtiene los datos de cada uno de los pasajeros o responsable
 * @param string $deQuien
 * @return object
 */

function obtenerDatos($deQuien)
{
    if ($deQuien == "pasajero") {
        echo "Nombre: \n";
        $nombre = trim(fgets(STDIN));
        echo "Apellido: \n";
        $apellido = trim(fgets(STDIN));
        echo "DNI: \n";
        $dni = intval(fgets(STDIN));
        echo "Telefono: \n";
        $telefono = trim(fgets(STDIN));
        $objeto = new Pasajero($nombre, $apellido, $dni, $telefono);
    } elseif ($deQuien == "responsable") {
        echo "Número Empleado: \n";
        $numEmpleado = trim(fgets(STDIN));
        echo "Número Licencia: \n";
        $numLicencia = trim(fgets(STDIN));
        echo "Nombre: \n";
        $nombre = trim(fgets(STDIN));
        echo "Apellido: \n";
        $apellido = trim(fgets(STDIN));
        $objeto = new ResponsableV($numEmpleado, $numLicencia, $nombre, $apellido);
    }

    return $objeto;
}
