<?php
    session_start();

    // Cargamos los datos de la sesión en variables
    $nombre = $_SESSION['nombre'];
    $apellido = $_SESSION['apellido'];
    $modelo = $_SESSION['modelo'];
    $errores = $_SESSION['errores'];
    $aciertos = $_SESSION['aciertos'];

    //----------------------------------- FUNCIONES ------------------------------------------

    function mostrarErroresAciertos($errores, $aciertos) {
        $html = "<h1> Reserva no válida </h1>";
        $html .= "<ul>";

        foreach($aciertos as $acierto) {
            $html .= "<li style='color: green'>".$acierto."</li>";
        }

        foreach($errores as $error) {
            $html .= "<li style='color: red'>".$error."</li>";
        }
        
        $html .= "</ul>";

        echo $html;
    }

    function reservaValida($nombre, $apellido, $modelo) {
        $html = "<h1> Reserva válida </h1>";
        $html .= "<h4>Nombre: ".$nombre."</h4>";
        $html .= "<h4>Apellido: ".$apellido."</h4>";
        $html .= "<img src='img/".$modelo.".png' alt='coche'/>";

        echo $html;
    }

    //----------------------------------------- MAIN -------------------------------------

    if (count($errores) > 0) {
        mostrarErroresAciertos($errores, $aciertos);
    } else {
        reservaValida($nombre, $apellido, $modelo);
    }

