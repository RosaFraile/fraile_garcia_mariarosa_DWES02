<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva coches</title>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
</head>
<body>
    <!-- Sección de Introducción de Datos -->
    <div id="input-section">
            <h2>Introducir Datos de Reserva de Coche</h2>
            <form id="reserva-coche" action="validar-reserva.php" method="get">
                <label for="nombre">Nombre: </label>
                <input type="text" name="nombre">

                <label for="apellido">Apellido: </label>
                <input type="text" name="apellido">

                <label for="dni">DNI: </label>
                <input type="text" name="dni">

                <label for="modelo">Modelo de Vehículo:</label>
                <select id="modelo" name="modelo">
                    <option value="lancia stratos">Lancia Stratos</option>
                    <option value="audi quattro">Audi Quattro</option>
                    <option value="ford escort rs1800"> Ford Escort RS1800</option>
                    <option value="subaru impreza 555"> Subaru Impreza 555</option>
                </select>

                <label for="fecha">Fecha de Inicio:</label>
                <input type="date" id="fecha" name="fecha">

                <label for="duracion">Duración (dias):</label>
                <input type="number" id="duracion" name="duracion">

                <button type="submit">Guardar Reserva</button>
            </form>
    </div>  
</body>
</html>