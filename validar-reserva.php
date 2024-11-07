<?php
    session_start();

    require 'data/coches.php';
    require 'data/usuarios.php';

    //----------------------------------- VARIABLES ------------------------------------------
    $errores = array();
    $aciertos = array();

    //----------------------------------- FUNCIONES ------------------------------------------
    function validarDNI($dni) {
        $algoritmo23 = array('T','R','W','A','G','M','Y','F','P','D','X','B','N','J','Z','S','Q','V','H','L','C','K','E');
        if (strlen($dni) != 9 || !ctype_digit(substr($dni, 0, 8))) {
            return false;
        }
        $numero = substr($dni, 0, 8);
        $letra = substr($dni, -1);
        return $algoritmo23[$numero % 23] === strtoupper($letra);
    }

    function validarUsuarioRegistrado($usuarios, $nombre, $apellido, $dni) {
        foreach($usuarios as $usuario) {
            if(strtoupper($usuario['nombre']) === strtoupper($nombre) && strtoupper($usuario['apellido']) === strtoupper($apellido) && strtoupper($usuario['dni']) === strtoupper($dni)) {
                return true;
            }
        }
        return false;
    }

    function disponibilidadCoche($coches, $modelo, $fechaInicio, $fechaFin) {
        $cocheDisponible = false;

        foreach($coches as $coche) {
            if (strtoupper($modelo) === strtoupper($coche['modelo'])) {
                if ($coche['disponible']) {
                    $cocheDisponible = true;
                } else if (isset($fechaInicio) && isset($fechaFin)) {
                    if(($fechaInicio<$coche['fecha_inicio'] && $fechaFin<$coche['fecha_inicio']) || ($fechaInicio>$coche['fecha_fin'] && $fechaFin>$coche['fecha_fin'])) {
                        $cocheDisponible = true;
                    }
                }
            }
        }
        return $cocheDisponible;
    }


    //----------------------------------------- MAIN -------------------------------------

    // Cargar datos del formulario
    $nombre = $_GET['nombre'];
    $apellido = $_GET['apellido'];
    $dni = $_GET['dni'];
    $modelo = $_GET['modelo'];
    $fechaInicio = $_GET['fecha'];
    $duracion = $_GET['duracion'];

    // Validar nombre
    if (empty($nombre)) {
        $errores[] = "El campo nombre no debe estar vacio";
    } else {
        $aciertos[] = "Nombre: ".$nombre;
    }

    // Validar apellido
    if (empty($apellido)) {
        $errores[] = "El campo apellido no debe estar vacio";
    } else {
        $aciertos[] = "Apellido: ".$apellido;
    }

    // Validar DNI
    if (empty($_GET['dni'])) {
        $errores[] = "El DNI no debe estar vacio";
    } else {
        if(validarDNI($dni)) {
            $aciertos[] = "DNI: ".$dni;
        } else {
            $errores[] = "El DNI no es válido";
        }
        
    }

    // Validar si el usuario está registrado en el sistema
    $usuarioRegistrado = validarUsuarioRegistrado(USUARIOS, $nombre, $apellido, $dni);

    if($usuarioRegistrado) {
        $aciertos[] = "El usuario está registrado en el sistema";
    } else {
        $errores[] = "El usuario no está registrado en el sistema";
    }

    // Validar fecha de inicio
    $fechaInicioCorrecta = false;
    if (empty($fechaInicio)) {
        $errores[] = "La fecha de inicio no puede estar vacía";
    } else {  
        $fechaActual = date('Y-m-d');
        if($fechaInicio <= $fechaActual) {
            $errores[] = "La fecha de inicio tiene que ser posterior a la fecha actual";
        } else {
            $aciertos[] = "Fecha inicio: ".$fechaInicio;
            $fechaInicioCorrecta = true;
        }
        
    }
    
    // Validar duración
    $duracionCorrecta = false;
    if (empty($duracion)) {
        $errores[] = "La duración no puede estar vacía";
    } else {
        if(!ctype_digit($duracion) || $duracion < 1 || $duracion > 30) {
            $errores[] = "La duración tiene que ser un número entero entre 1 y 30";
        } else {
            $aciertos[] = "Duración: ".$duracion;
            $duracionCorrecta = true;
        }
    }

    // Validar si el coche está disponible para el periodo de tiempo solicitado
    $cocheDisponible = false;

    if($fechaInicioCorrecta && $duracionCorrecta) {
        $fechaFin = date('Y-m-d', strtotime($fechaInicio . " + $duracion days"));
        $cocheDisponible = disponibilidadCoche($coches, $modelo, $fechaInicio, $fechaFin);
    } else {
        $cocheDisponible = disponibilidadCoche($coches, $modelo, null, null);
    }

    if (!$cocheDisponible) {
        $errores[] = "El coche no está disponible";
    } else {
        $aciertos[] = "El coche está disponible";
    }

    // Guardar datos en las variables de sesión
    $_SESSION['nombre'] = $nombre;
    $_SESSION['apellido'] = $apellido;
    $_SESSION['modelo'] = $modelo;
    $_SESSION['errores'] = $errores;
    $_SESSION['aciertos'] = $aciertos;

    // Redirigir a la página de mostrar el resultado de la validación de los datos
    header('Location: mostrar-resultado.php');
    exit;

    
?>