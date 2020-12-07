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

        //     $list = array (
        //         array('aaa', 'bbb', 'ccc', 'dddd'),
        //         array('123', '456', '789'),
        //         array('"aaa"', '"bbb"')
        //  );
         
        //  $fp = fopen('file.csv', 'w');
         
        //  foreach ($list as $fields) {
        //         fputcsv($fp, $fields);
        //  }
         
        //  fclose($fp);
        ?>
    </div>

    <form action="#" method="post">
        <input type="submit" class="button" name="botonBD" value="Crear Base de Datos" />

        <div><input type="submit" class="button" name="botonTabla" value="Crear una tabla" /></div>

        <p>DNI (XXXXXXXX-X): <input type="text" name="dni" /> </p>
        <p>Nombre: <input type="text" name="nombre" /></p>
        <p>Apellidos: <input type="text" name="apellidos" /></p>
        <p>E-mail (@): <input type="text" name="email" /></p>
        <p>Télefono (9 dígitos): <input type="text" name="telefono" /></p>
        <p>Edad: <input type="text" name="edad" /></p>
        <p>Sexo (mujer, hombre, otros): <input type="text" name="sexo" /></p>
        <p>Pericia informática de la persona calificada (0-10): <input type="text" name="pericia" /></p>
        <p>Tiempo transcurrito para realizar la tarea (segundos): <input type="text" name="tiempo" /></p>
        <p>Tarea realizada correctamente (sí o no): <input type="text" name="tareaCorrecta" /></p>
        <p>Comentarios sobre problemas encontrados al usar la aplicación: <input type="text" name="problemas" /></p>
        <p>Propuestas mejoras: <input type="text" name="mejoras" /></p>
        <p>Valoración por parte del usuario (0-10): <input type="text" name="valoracion" /></p>
        <input type="submit" class="button" name="botonInsertar" value="Insertar datos en una tabla" />

        <p>DniFila: <input type="text" name="dniFilaBuscar" /></p>
        <div id="resultadoBuscar"><?php echo $baseDatos->mostrarBuscar();?></div>
        <input type="submit" class="button" name="botonBuscar" value="Buscar datos en una tabla" />

        <p>DNI (XXXXXXXX-X) para encontrar fila en la tabla: <input type="text" name="dniFilaModificar" /></p>
        <p>Datos que se van a modificar de la correspondiente fila:</p>
        <p>Nombre: <input type="text" name="nombreNuevo" /></p>
        <p>Apellidos: <input type="text" name="apellidosNuevo" /></p>
        <p>E-mail (@): <input type="text" name="emailNuevo" /></p>
        <p>Télefono (9 dígitos): <input type="text" name="telefonoNuevo" /></p>
        <p>Edad: <input type="text" name="edadNuevo" /></p>
        <p>Sexo (mujer, hombre, otros): <input type="text" name="sexoNuevo" /></p>
        <p>Pericia informática de la persona calificada (0-10): <input type="text" name="periciaNuevo" /></p>
        <p>Tiempo transcurrito para realizar la tarea (segundos): <input type="text" name="tiempoNuevo" /></p>
        <p>Tarea realizada correctamente (sí o no): <input type="text" name="tareaCorrectaNuevo" /></p>
        <p>Comentarios sobre problemas encontrados al usar la aplicación: <input type="text" name="problemasNuevo" /></p>
        <p>Propuestas mejoras: <input type="text" name="mejorasNuevo" /></p>
        <p>Valoración por parte del usuario (0-10): <input type="text" name="valoracionNuevo" /></p>
        <input type="submit" class="button" name="botonModificar" value="Modificar datos en una tabla" />

        <p>DniFila: <input type="text" name="dniFilaEliminar" /></p>
        <input type="submit" class="button" name="botonEliminar" value="Eliminar datos (fila) de una tabla" />

        <div>
            <input type="submit" class="button" name="botonInforme" value="Generar informe" />
            <div id="resultadoInforme"><?php echo $baseDatos->mostrarInforme();?></div>
        </div>

        <p>Cargar datos a una tabla de la Base de Datos desde un archivo a seleccionar</p> 
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