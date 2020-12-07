<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"/>
    <title>Ejercicio6</title>
	<link rel="stylesheet" href="Ejercicio6.css"/>
</head>
<body>
    <h1>Gestión de una base de datos MySQL</h1>

    <div>
        <?php
            include_once("Ejercicio6Codigo.php");
            $baseDatos = new BaseDatos();
            $baseDatos->init();
        ?>
    </div>

    <form action="#" method="post" enctype="multipart/form-data">
        <input type="submit" class="button" name="botonBD" value="Crear Base de Datos" />

        <div><input type="submit" class="button" name="botonTabla" value="Crear una tabla" /></div>

        <div><label class="label" for="dni">DNI (XXXXXXXX-X): </label><input type="text" name="dni" /></div>
        <div><label class="label"for="nombre">Nombre: </label><input type="text" name="nombre" /></div>
        <div><label class="label"for="apellidos">Apellidos: </label><input type="text" name="apellidos" /></div>
        <div><label class="label"for="email">E-mail (@): </label><input type="text" name="email" /></div>
        <div><label class="label"for="telefono">Télefono (9 dígitos):</label><input type="text" name="telefono" /></div>
        <div><label class="label"for="edad">Edad: </label><input type="text" name="edad" /></div>
        <div><label class="label"for="sexo">Sexo (mujer, hombre, otros): </label><input type="text" name="sexo" /></div>
        <div><label class="label"for="pericia">Pericia informática de la persona calificada (0-10): </label><input type="text" name="pericia" /></div>
        <div><label class="label"for="tiempo">Tiempo transcurrito para realizar la tarea (segundos): </label><input type="text" name="tiempo" /></div>
        <div><label class="label"for="tareaCorrecta">Tarea realizada correctamente (sí o no): </label><input type="text" name="tareaCorrecta" /></div>
        <div><label class="label"for="problemas">Comentarios sobre problemas encontrados al usar la aplicación: </label><input type="text" name="problemas" /></div>
        <div><label class="label"for="mejoras">Propuestas mejoras: </label><input type="text" name="mejoras" /></div>
        <div><label class="label"for="valoracion">Valoración por parte del usuario (0-10): </label><input type="text" name="valoracion" /></div>
        <input type="submit" class="button" name="botonInsertar" value="Insertar datos en una tabla" />

        <div><label class="label"for="dniFilaBuscar">DniFila: </label><input type="text" name="dniFilaBuscar" /></div>
        <div id="resultadoBuscar"><?php echo $baseDatos->mostrarBuscar();?></div>
        <input type="submit" class="button" name="botonBuscar" value="Buscar datos en una tabla" />

        <div><label class="label"for="dniFilaModificar">DNI (XXXXXXXX-X) para encontrar fila en la tabla: </label><input type="text" name="dniFilaModificar" /></div>
        <p>Datos que se van a modificar de la correspondiente fila:</p>
        <div><label class="label"for="nombreNuevo">Nombre: </label><input type="text" name="nombreNuevo" /></div>
        <div><label class="label"for="apellidosNuevo">Apellidos: </label><input type="text" name="apellidosNuevo" /></div>
        <div><label class="label"for="emailNuevo">E-mail (@): </label><input type="text" name="emailNuevo" /></div>
        <div><label class="label"for="telefonoNuevo">Télefono (9 dígitos):</label><input type="text" name="telefonoNuevo" /></div>
        <div><label class="label"for="edadNuevo">Edad: </label><input type="text" name="edadNuevo" /></div>
        <div><label class="label"for="sexoNuevo">Sexo (mujer, hombre, otros): </label><input type="text" name="sexoNuevo" /></div>
        <div><label class="label"for="periciaNuevo">Pericia informática de la persona calificada (0-10): </label><input type="text" name="periciaNuevo" /></div>
        <div><label class="label"for="tiempoNuevo">Tiempo transcurrito para realizar la tarea (segundos): </label><input type="text" name="tiempoNuevo" /></div>
        <div><label class="label"for="tareaCorrectaNuevo">Tarea realizada correctamente (sí o no): </label><input type="text" name="tareaCorrectaNuevo" /></div>
        <div><label class="label"for="problemasNuevo">Comentarios sobre problemas encontrados al usar la aplicación: </label><input type="text" name="problemasNuevo" /></div>
        <div><label class="label"for="mejorasNuevo">Propuestas mejoras: </label><input type="text" name="mejorasNuevo" /></div>
        <div><label class="label"for="valoracionNuevo">Valoración por parte del usuario (0-10): </label><input type="text" name="valoracionNuevo" /></div>
        <input type="submit" class="button" name="botonModificar" value="Modificar datos en una tabla" />

        <div>
            <div><label class="label"for="dniFilaEliminar">DniFila: </label><input type="text" name="dniFilaEliminar" /></div>
            <input type="submit" class="button" name="botonEliminar" value="Eliminar datos (fila) de una tabla" />
        </div>

        <div id="resultadoInforme"><?php echo $baseDatos->mostrarInforme();?></div>
            <input type="submit" class="button" name="botonInforme" value="Generar informe" />
        </div>

        <div><label class="label"for="archivo">Cargar datos a una tabla de la Base de Datos desde un archivo a seleccionar</label></div>
        <input type="file" name="archivo" /> 
        <input type="submit" class="button" name="botonCargar" value="Cargar" />

        <div><input type="submit" class="button" name="botonExportar" value="Exportar datos de una tabla de la Base de Datos a un archivo a seleccionar" /></div>
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