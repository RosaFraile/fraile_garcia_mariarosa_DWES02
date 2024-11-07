<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="es">
    <head> 
        <meta charset="UTF-8">
        <title>Reserva Válida</title>
    </head>
    <body>
        <h1>Reserva Válida</h1>
        <p>Nombre: <?php echo $_SESSION['nombre']; ?></p>
        <p>Apellido: <?php echo $_SESSION['apellido']; ?></p>
        <p>Vehículo: <?php echo $_SESSION['modelo']; ?></p>
        <img src="img/<?php echo $_SESSION['modelo']; ?>.png" alt="<?php echo $_SESSION['modelo']; ?>">
    </body>
</html>