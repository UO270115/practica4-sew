<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"/>
    <meta name=viewport content="width=device-width, initial-scale=1" />
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
        <section>
            <h2>Creación de la base de datos</h2>
            <input type="submit" class="button" name="botonBD" value="Crear bd" />
        </section>
       
        <section>
            <h2>Creación de la tabla PruebasUsabilidad</h2>
            <input type="submit" class="button" name="botonTabla" value="Crear tabla" />
        </section>

        <section>
            <h2>Inserción datos</h2>
            <div><label class="label" for="dni">DNI (NNNNNNNNL ; por ejemplo 12345678A): </label><input type="text" id="dni" name="dni" /></div>
            <div><label class="label" for="nombre">Nombre: </label><input type="text" id="nombre" name="nombre" /></div>
            <div><label class="label" for="apellidos">Apellidos: </label><input type="text" id="apellidos" name="apellidos" /></div>
            <div><label class="label" for="email">E-mail (@): </label><input type="text" id="email" name="email" /></div>
            <div><label class="label" for="telefono">Télefono (9 dígitos):</label><input type="text" id="telefono" name="telefono" /></div>
            <div><label class="label" for="edad">Edad: </label><input type="text" id="edad" name="edad" /></div>
            <div><label class="label" for="sexo">Sexo (mujer, hombre, otros): </label><input type="text" id="sexo" name="sexo" /></div>
            <div><label class="label" for="pericia">Pericia informática de la persona calificada (0-10): </label>
                <input type="text" id="pericia" name="pericia" />
            </div>
            <div><label class="label" for="tiempo">Tiempo transcurrito para realizar la tarea (segundos): </label>
                <input type="text" id="tiempo" name="tiempo" />
            </div>
            <div><label class="label" for="tareaCorrecta">Tarea realizada correctamente (sí o no): </label>
                <input type="text" id="tareaCorrecta" name="tareaCorrecta" />
            </div>
            <div><label class="label" for="problemas">Comentarios sobre problemas encontrados al usar la aplicación: </label>
                <input type="text" id="problemas" name="problemas" />
            </div>
            <div><label class="label" for="mejoras">Propuestas mejoras: </label><input type="text" id="mejoras" name="mejoras" /></div>
            <div><label class="label" for="valoracion">Valoración por parte del usuario (0-10): </label>
                <input type="text" id="valoracion" name="valoracion" />
            </div>
            <input type="submit" class="button" name="botonInsertar" value="Insertar" />
        </section>

        <section>
            <h2>Búsqueda de datos</h2>
            <div><label class="label" for="dniFilaBuscar">DniFila: </label><input type="text" id="dniFilaBuscar" name="dniFilaBuscar" /></div>
            <div id="resultadoBuscar"><?php echo $baseDatos->mostrarBuscar();?></div>
            <input type="submit" class="button" name="botonBuscar" value="Buscar" />
        </section>

        <section>
            <h2>Modificación de datos</h2>
            <div><label class="label" for="idFilaModificar">Identificador de la fila a encontrar: </label>
                <input type="text" id="idFilaModificar" name="idFilaModificar" />
            </div>
            <div><label class="label" for="dniFilaModificar">DNI (NNNNNNNNL ; por ejemplo 12345678A) para encontrar fila en la tabla: </label>
                <input type="text" id="dniFilaModificar" name="dniFilaModificar" />
            </div>
            <p>Datos que se van a modificar de la correspondiente fila:</p>
            <div><label class="label" for="nombreNuevo">Nombre: </label><input type="text" id="nombreNuevo" name="nombreNuevo" /></div>
            <div><label class="label" for="apellidosNuevo">Apellidos: </label><input type="text" id="apellidosNuevo" name="apellidosNuevo" /></div>
            <div><label class="label" for="emailNuevo">E-mail (@): </label><input type="text" id="emailNuevo" name="emailNuevo" /></div>
            <div><label class="label" for="telefonoNuevo">Télefono (9 dígitos):</label><input type="text" id="telefonoNuevo" name="telefonoNuevo" /></div>
            <div><label class="label" for="edadNuevo">Edad: </label><input type="text" id="edadNuevo" name="edadNuevo" /></div>
            <div><label class="label" for="sexoNuevo">Sexo (mujer, hombre, otros): </label><input type="text" id="sexoNuevo" name="sexoNuevo" /></div>
            <div><label class="label" for="periciaNuevo">Pericia informática de la persona calificada (0-10): </label>
                <input type="text" id="periciaNuevo" name="periciaNuevo" />
            </div>
            <div><label class="label" for="tiempoNuevo">Tiempo transcurrito para realizar la tarea (segundos): </label>
                <input type="text" id="tiempoNuevo" name="tiempoNuevo" />
            </div>
            <div><label class="label" for="tareaCorrectaNuevo">Tarea realizada correctamente (sí o no): </label>
                <input type="text" id="tareaCorrectaNuevo" name="tareaCorrectaNuevo" />
            </div>
            <div><label class="label" for="problemasNuevo">Comentarios sobre problemas encontrados al usar la aplicación: </label>
                <input type="text" id="problemasNuevo" name="problemasNuevo" />
            </div>
            <div><label class="label" for="mejorasNuevo">Propuestas mejoras: </label><input type="text" id="mejorasNuevo" name="mejorasNuevo" /></div>
            <div><label class="label" for="valoracionNuevo">Valoración por parte del usuario (0-10): </label>
                <input type="text" id="valoracionNuevo" name="valoracionNuevo" />
            </div>
            <input type="submit" class="button" name="botonModificar" value="Modificar" />
        </section>

        <section>
            <h2>Eliminación de datos</h2>
            <div><label class="label" for="idFilaEliminar">Identificador de la fila a eliminar: </label>
                <input type="text" id="idFilaEliminar" name="idFilaEliminar" />
            </div>
            <div><label class="label" for="dniFilaEliminar">DniFila: </label><input type="text" id="dniFilaEliminar" name="dniFilaEliminar" /></div>
            <input type="submit" class="button" name="botonEliminar" value="Eliminar" />
        </section>

        <section>
            <h2>Obtención del informe</h2>
            <div id="resultadoInforme"><?php echo $baseDatos->mostrarInforme();?></div>
            <input type="submit" class="button" name="botonInforme" value="Generar informe" />
        </section>

        <section>
            <h2>Carga de datos a la base de datos</h2>
            <div><label class="label" for="archivo">Seleccionar un archivo con extensión csv para realizar la carga</label></div>
            <input type="file" id="archivo" name="archivo" /> 
            <input type="submit" class="button" name="botonCargar" value="Cargar" />
        </section>

        <section>
            <h2>Exportación de información de la base de datos a PruebasUsabilidad.csv</h2>
            <input type="submit" class="button" name="botonExportar" value="Exportar" />
        </section>

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