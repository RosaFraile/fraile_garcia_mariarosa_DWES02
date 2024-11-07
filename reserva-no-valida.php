<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Reserva No Válida</title>
    </head>
    <body>
        <h1>Reserva No Válida</h1>
        <ul>
            <?php
                foreach ($_SESSION['aciertos'] as $acierto) {
                    echo "<li style='color: green;'>$acierto</li>";
                }
            ?> 
        </ul>
        <ul>
            <?php
                foreach ($_SESSION['errores'] as $error) {
                    echo "<li style='color: red;'>$error</li>";
                }
            ?> 
        </ul>
        <a href="index.php">Volver al formulario</a>
    </body>
</html>