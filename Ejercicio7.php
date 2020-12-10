<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"/>
    <meta name=viewport content="width=device-width, initial-scale=1" />
    <title>Ejercicio7</title>
	<link rel="stylesheet" href="Ejercicio7.css"/>
</head>
<body>
    <h1>Gestión de las reservas de un hotel</h1>

    <div>
        <?php
            include_once("Ejercicio7Codigo.php");
            $baseDatos = new BaseDatos();
            $baseDatos->init();
        ?>
    </div>

    <form action="#" method="post" enctype="multipart/form-data">
        <section>
            <h2>Realizar una reserva</h2>
            <div><label class="label" for="dni">DNI (NNNNNNNNL): </label><input type="text" id="dni" name="dni" /> Por ejemplo, 123456789A</div>
            <div><label class="label" for="nombre">Nombre: </label><input type="text" id="nombre" name="nombre" /></div>
            <div><label class="label" for="apellidos">Apellidos: </label><input type="text" id="apellidos" name="apellidos" /></div>
            <div><label class="label" for="email">E-mail (@): </label><input type="text" id="email" name="email" /></div>
            <div><label class="label" for="telefono">Télefono (9 dígitos):</label><input type="text" id="telefono" name="telefono" /></div>
            <div><label class="label" for="fechaEntrada">Fecha entrada: </label><input type="date" id="fechaEntrada" name="fechaEntrada" /></div>
            <div><label class="label" for="fechaSalida">Fecha salida: </label><input type="date" id="fechaSalida" name="fechaSalida" /></div>
            <input type="submit" class="button" name="botonReservar" value="Confirmar reserva" />
        </section>

        <section>
            <h2>Obtener resguardo de la reserva realizada</h2>
            <div><label class="label" for="dniReservaExportar">DNI introducido en la reserva: </label>
                <input type="text" id="dniReservaExportar" name="dniReservaExportar" />
            </div>
            <div><input type="submit" class="button" name="botonExportar" value="Guardar resguardo reserva" /></div>
        </section>

        <section>
            <h2>Búsqueda de una reserva</h2>
            <div><label class="label" for="dniReservaBuscar">DNI introducido en la reserva: </label>
                <input type="text" id="dniReservaBuscar" name="dniReservaBuscar" />
            </div>
            <div id="resultadoBuscar"><?php echo $baseDatos->mostrarBuscar();?></div>
            <input type="submit" class="button" name="botonBuscar" value="Buscar un reserva" />
        </section>

        <section>
            <h2>Cancelación de una reserva</h2>
            <div><label class="label" for="dniReservaEliminar">DNI introducido en la reserva: </label>
                <input type="text" id="dniReservaEliminar" name="dniReservaEliminar" />
            </div>
            <input type="submit" class="button" name="botonEliminar" value="Cancelar reserva" />
        </section>

        <!-- Para introducir en la base de datos el archivo habitaciones.csv
        <div><label class="label" for="archivo">Cargar datos a una tabla de la Base de Datos desde un archivo a seleccionar</label></div>
        <input type="file" id="archivo" name="archivo" /> 
        <input type="submit" class="button" name="botonCargar" value="Cargar" /> -->
    </form> 

    <footer>
        <a href="http://validator.w3.org/check/referer" hreflang="en-us">
            <img src="HTML5.png" alt="¡HTML5 válido!"/>
        </a>
        <a href="http://jigsaw.w3.org/css-validator/check/referer">
            <img src="CSS3.png" alt="¡CSS Válido!" height="63" width="64" />
        </a>
    </footer>
</body>
</html>