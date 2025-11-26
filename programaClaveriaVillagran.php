<?php
include_once("memoria.php");

/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/

/* Apellido, Nombre. Legajo. Carrera. mail. Usuario Github */
/* Claveria, Erick. FAI-6061. Desarrollo Web. Erick2312cl*/
/* Villagran, Alan. FAI-6060. Desarrollo Web. Alan Villagran*/ 





/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/

function cargarJuegos (){
   $coleccionJuegos=[];

   $coleccionJuegos[0]=["jugador1"=>"Juan", "aciertos1"=>2, "jugador2"=>"Manuel", "aciertos2" =>2 ];
   $coleccionJuegos[1]=["jugador1"=>"Martin", "aciertos1"=>4, "jugador2"=>"Lourdes", "aciertos2" =>0 ];
   $coleccionJuegos[2]=["jugador1"=>"Luciano", "aciertos1"=>3, "jugador2"=>"Esteban", "aciertos2" =>1 ];
   $coleccionJuegos[3]=["jugador1"=>"Ezequiel", "aciertos1"=>3, "jugador2"=>"Thiago", "aciertos2" =>1 ];
   $coleccionJuegos[4]=["jugador1"=>"Martin", "aciertos1"=>2, "jugador2"=>"Lourdes", "aciertos2" =>2 ];
   $coleccionJuegos[5]=["jugador1"=>"Zahira", "aciertos1"=>4, "jugador2"=>"Daniela", "aciertos2" =>0 ];
   $coleccionJuegos[6]=["jugador1"=>"Lilen", "aciertos1"=>1, "jugador2"=>"Lucas", "aciertos2" =>3 ];
   $coleccionJuegos[7]=["jugador1"=>"Milagros", "aciertos1"=>0, "jugador2"=>"Ariel", "aciertos2" =>4 ];
   $coleccionJuegos[8]=["jugador1"=>"Danna", "aciertos1"=>1, "jugador2"=>"Fernando", "aciertos2" =>3 ];
   $coleccionJuegos[9]=["jugador1"=>"Agustina", "aciertos1"=>2, "jugador2"=>"Alejandro", "aciertos2" =>2 ];
   

   return ($coleccionJuegos);

}

/**
 * Muestra los datos de un solo juego en especifico.
 * @param array $coleccionjuegos
 * @param int $indice
 * 
 */

function mostrarJuego($coleccionJuegos,$indice ){


   $juego=$coleccionJuegos[$indice];

   echo"*******************************************";

   if ($juego["aciertos1"]>$juego["aciertos2"]) {
      echo"juego MEMORIA : $indice (gano jugador 1)\n";

   }elseif($juego["aciertos2"]>$juego["aciertos1"]){
      echo"juego MEMORIA : $indice (gano jugador 2)\n";
   }else {
      echo"juego MEMORIA : $indice (empate)\n";
   }

    echo "Jugador 1: ",$coleccionJuegos[$indice]["jugador1"], " obtuvo ",$coleccionJuegos[$indice]["aciertos1"], " aciertos \n";
    echo "Jugador 2: ",$coleccionJuegos[$indice]["jugador2"], " obtuvo ",$coleccionJuegos[$indice]["aciertos2"], " aciertos \n";

}

/**
 * Función  seleccionarOpcion que muestre las opciones del menú en la pantalla.
 * 
 * @return int
 */
function seleccionarOpcion(){
   echo"______________________________________________________________________________\n";
   echo"MENU OPCIONES\n";
   echo"1) Jugar a Memoria\n";
   echo"2) Mostrar un Juego\n";
   echo"3) Mostrar el Primer Juego Ganador \n";
   echo"4) Mostrar Porcentaje de Juegos Ganados\n";
   echo"5) Mostrar Resumen de Jugador\n";
   echo"6) Mostrar Listado de Juegos Ordenado por Jugador 2\n";
   echo"7) Salir\n";
   echo"______________________________________________________________________________\n";
  
   

   return solicitarNumeroEntre(1,7);

}




/**
 * Solicita un valor y devuelve un número entero entre min y max.
 * @param int $min
 * @param int $max
 * @return int 
 */
function solicitarNumeroEntre($min, $max):int {
    //int $numero

   echo "Ingrese un numero entre $min y $max: ";
    $numero = trim(fgets(STDIN));
    while (!(is_numeric($numero) && is_int($numero + 0) && ($numero >= $min && $numero <= $max))) {
        echo "Debe ingresar un número entre " . $min . " y " . $max . ": ";
        $numero=trim(fgets(STDIN));
    }

    return (int)$numero;
}

/** Recibe por parámetro la colección de juegos y un juego, para agregarlo a la colección
 * @param array $coleccionJuegos;
 * @param array $juego;
 * @return array $coleccionJuegos;
 */
function agregarJuego($coleccionJuegos, $juego){
    $juego["jugador1"] = strtolower($juego["jugador1"]); // Pasa el elemento $juego["jugador1"] a minúscula
    $juego["jugador2"] = strtolower($juego["jugador2"]); // Pasa el elemento $juego["jugador2"] a minúscula
    $coleccionJuegos[] = $juego;
    return $coleccionJuegos;
}

/**
 * Recibe por parametro un nombre y la coleccion de juegos y retorna el indice de su primer juego ganado
 * @param array $coleccionjuegos
 * @param string $nombre
 * 
 */ 
function primerJuegoGanado($coleccionJuegos, $nombre){
    //int $i, $indicarGanado, $cantJuegos


    $cantJuegos=count($coleccionJuegos);
    $indiceGanado=-1;
    $i=0;

    while($i<$cantJuegos && $indiceGanado ==-1){
        if ($coleccionJuegos[$i]["jugador1"]==$nombre && $coleccionJuegos[$i]["aciertos1"]>$coleccionJuegos[$i]["aciertos2"]) {
            $indiceGanado=$i;
        }elseif($coleccionJuegos[$i]["jugador2"]==$nombre && $coleccionJuegos[$i]["aciertos2"]>$coleccionJuegos[$i]["aciertos1"]){
            $indiceGanado=$i;
        }
        $i=$i+1;
    }

    return $indiceGanado;

}

/**
 * Recibe por parametro la coleccion juegos y un nombre, devuelve el resumen de un jugador
 * @param array $coleccionJuegos
 * @param string $nombre
 * @return array $resumen
 */


function resumenJugador($coleccionJuegos, $nombre){
//int $i
//array $resumen $juego


$resumen =[
    "nombre"=>$nombre,
    "juegosGanados"=>0,
    "juegosPerdidos"=>0,
    "juegosEmpatados"=>0,
    "aciertosAcumulados"=>0
];

foreach ($coleccionJuegos as $juego) {
    
  

if ($juego["jugador1"]==$nombre) {

      $resumen["aciertosAcumulados"]+= $juego["aciertos1"];

    if ($juego["aciertos1"]>$juego["aciertos2"]) {
        $resumen["juegosGanados"]++;
        
    }elseif ($juego["aciertos1"]<$juego["aciertos2"]) {
        $resumen["juegosPerdidos"]++;

    }else {
        $resumen["juegosEmpatados"]++;
    }

}elseif ($juego["jugador2"]==$nombre) {
    $resumen["aciertosAcumulados"]+= $juego["aciertos2"];

    if ($juego["aciertos2"]>$juego["aciertos1"]) {
        $resumen["juegosGanados"]++;

    }elseif ($juego["aciertos2"]<$juego["aciertos1"]) {
        $resumen["juegosPerdidos"]++;
    
    }else {
        $resumen["juegosEmpatados"]++;
    }


}

}
return ($resumen);

}


/** Recibe por parametro el resumen de un jugador y lo muestra por pantalla
 * @param array $resumen;
 */
function mostrarResumen($resumen){
    echo "******************************************\n";
    echo "Jugador: ",$resumen["nombre"],"\n";
    if($resumen["juegosGanados"] == 1){
        echo "Ganó: ",$resumen["juegosGanados"] , " juego \n";
    }else{
        echo "Ganó: ",$resumen["juegosGanados"] , " juegos \n";
    }
    if($resumen["juegosPerdidos"] == 1){
        echo "Perdió: ",$resumen["juegosPerdidos"] , " juego \n";
    }else{
        echo "Perdió: ",$resumen["juegosPerdidos"] , " juegos \n";
    }
    if($resumen["juegosEmpatados"] == 1 ){
        echo "Empató: ",$resumen["juegosEmpatados"] , " juego\n";
    }else{
        echo "Empató: ",$resumen["juegosEmpatados"] , " juegos\n";
    }
    if($resumen["aciertosAcumulados"] == 1){
        echo "Total de aciertos acumulados: ",$resumen["aciertosAcumulados"] ," acierto \n";
    }else{
        echo "Total de aciertos acumulados: ",$resumen["aciertosAcumulados"] ," aciertos \n";
    }
    echo "******************************************\n"; 
}


/**
 * recie por parametro coleccionJuegos cuenta la cantidad de partidas que tiene un ganador
 * @param array $coleccionJuegos
 * @return int $cantGanadores
 */

function partidasConGanador($coleccionJuegos){
    //int cantGanadores;


    $cantGanadores = 0;

    foreach ($coleccionJuegos as $juego){//Se usa la variable $juego para almacenar datos de los elementos de la coleccion

        if($juego=["aciertos1"] > $juego=["aciertos2"] || $juego=["aciertos2"] > $juego=["aciertos1"]){
            $cantGanadores=$cantGanadores + 1;
        }

    }

    return $cantGanadores;
}

/**
 * Cuenta cuántos juegos ganó el jugador 1 o el jugador 2
 * @param array $coleccionJuegos
 * @param int $nroJugador (1 o 2)
 * @return int $contador
 */


function contarVictoriasPorJugador($coleccionJuegos, $nroJugador) {
    $contador = 0;
    
    foreach ($coleccionJuegos as $juego) {
        if ($nroJugador == 1) {
            if ($juego["aciertos1"] > $juego["aciertos2"]) {
                $contador=$contador+1;
            }
        } else {
            if ($juego["aciertos2"] > $juego["aciertos1"]) {
                $contador=$contador+1;
            }
        }
    }
    
    return $contador;
    
}


/**
 * compara dos juegos por el nombre de jugador2
 * @param array $a
 * @param array $b
 * @param int $resultado
 */

function compararJugador2($a, $b) {
    //int resultado


    if($a["jugador2"] == $b["jugador2"]){
        $resultado = 0;
    // Si retorna 0, no cambia el orden
    
    } elseif ($a["jugador2"] < $b["jugador2"]){
        $resultado = -1;
    // Si retorna 1, $a queda por encima de $b
    }else{
        $resultado = 1;
        // Si retorna -1, $b queda por encima de $a
    }
    return $resultado;
}


/**
 * Recibe por parametro la colección de juegos y la muestra ordenada por el nombre del jugador 2
 * @param array $coleccionJuegos
 */
function coleccionJugador2($coleccionJuegos){

    uasort($coleccionJuegos, 'compararJugador2');

    print_r($coleccionJuegos);
}

/** verifica que el numero que pide este dentro del rango si no es asi avisa al usuario
 * @param array $rango; 
 * @return int $num;
 * 
*/
function verificarRango($rango){
    //int $num
    //boolean $fueraRango
    do{
        echo"Igrese un numero entre ".($rango["min"])." y ".$rango["max"].": ";
        $num = trim(fgets(STDIN));
        if($num < $rango["min"] || $num > $rango["max"]){
            $fueraRango = true;
            echo "El número esta fuera de rango \n";
        }else{
            $fueraRango = false;
        }

    }while($fueraRango);

    return $num;
}

/** Recibe por parámetro la colecciónJuegos y el número de jugador para retornar su porcentaje de victoria
 * @param array $coleccionJuegos;
 * @param int $numeroJ;
 * @return float $porcentaje;
 */
function porcentajeVictoria($coleccionJuegos,$numeroJ, ){
    //float $porcentaje
    //int $jganados, $cantJuegos

    $cantJuegos = partidasConGanador($coleccionJuegos);
    $jGanados= contarVictoriasPorJugador($coleccionJuegos, $numeroJ);
    $porcentaje = ($jGanados * 100) / $cantJuegos;
    return $porcentaje;
}


/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//Declaración de variables:


//Inicialización de variables:



//Proceso:

// Estas 3 líneas de código ejecutan el juego y muestran el arreglo retornado con los resultado
// Probar la primera vez y luego comentar/borrar
/*
$juego = jugarMemoria();
echo "jugador 1 " . $juego["jugador1"] . ": " . $juego["aciertos1"] . " aciertos" . "\n";
echo "jugador 2 " . $juego["jugador2"] . ": " . $juego["aciertos2"] . " aciertos" . "\n";
*/

$coleccion= cargarJuegos();//precargar los juegos

$cantPartidas = count($coleccion); // La función predeterminada count, devuelve el total de elementos que tiene el arreglo 


do {
    $opcion = seleccionarOpcion();
    
    switch ($opcion) {
        case 1: //jugar memoria
            $jugar= jugarMemoria();
            $coleccion=agregarJuego($coleccion, $jugar);
            $cantPartidas= count($coleccion);
            break;

        case 2: //Mostrar un juego
            $rango1 = ["min" => 1, "max" => 2];
            $indi=verificarRango($rango1);
            mostrarJuego($coleccion, $indi);
            break;

        case 3: //Mostrar el primer juego ganador
            echo"Ingrese el nombre del jugador";
            $nombre1 = trim(fgets(STDIN));
            $nombre1 = strtolower($nombre);
            $indi = primerJuegoGanado($coleccion, $nombre1, $cantPartidas);
            if($indi != -1){
                mostrarJuego($coleccion, $indi);
            }else{
                echo"El jugador ",$nombre1," no ganó ningun juego \n";
            }

            break;
        case 4: //Mostrar porcentaje de juegos ganados
                $rango1 = ["min" => 1, "max" => 2];               
                $numJugador = verificarRango($rango1);           
                $porcentajeV = porcentajeVictoria($coleccion, $numJugador, $cantPartidas);
                echo "Jugador ",$numJugador," ganó el ",$porcentajeV,"% de las partidas. \n";
        break;
        case 5: //Mostrar resumen de jugador
            echo "Ingrese el nombre del jugador: ";
            $nombre1 = trim(fgets(STDIN));
            $nombre1= strtolower($nombre1); // Pasa la variable string $name a minúscula
            $resumenJ = resumenJugador($coleccion,$nombre1);
            mostrarResumen($resumenJ);
        break;
        case 6: //Mostrar listado de juegos ordenado por jugador 2
            
            coleccionJugador2($coleccion);
            break;
            
        case 7: //Salir
            echo "\n*****************************\n";
            echo "*        NOS VEMOS !!!      *\n";
            echo "*****************************\n";
            break;
        }
} while ($opcion != 7);

