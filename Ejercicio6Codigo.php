<?php
    class BaseDatos{

        protected $servername = "localhost";
        protected $username = "DBUSER2020";
        protected $password = "DBPSWD2020";
        protected $database = "sewBDEjer6";

        public function __construct(){
            session_start();
        }

        public function init(){
            if (count($_POST)>0) { 
                if(isset($_POST["botonBD"])){
                    $this->crearBD();
                } 
                if(isset($_POST["botonTabla"])){
                    $this->crearTabla();
                } 
                if(isset($_POST["botonInsertar"])){
                    $this->insertarDatos();
                } 
                if(isset($_POST["botonBuscar"])){
                    $this->buscarTabla();
                } 
                if(isset($_POST["botonModificar"])){
                    $this->modificarDatos();
                } 
                if(isset($_POST["botonEliminar"])){
                    $this->eliminarDatos();
                } 
                if(isset($_POST["botonInforme"])){
                    $this->generarInforme();
                } 
                if(isset($_POST["botonCargar"])){
                    $this->cargarArchivo();
                } 
                if(isset($_POST["botonExportar"])){
                    $this->exportarArchivo();
                } 
            }
        }

        public function crearBD(){
            $db = new mysqli($this->servername, $this->username, $this->password);
            if($db->connect_error) {
                exit ("<p>ERROR de conexión:" . $db->connect_error . "</p>");  
            }
        
            $cadenaSQL = "CREATE DATABASE IF NOT EXISTS sewBDEjer6 COLLATE utf8_spanish_ci";
            if($db->query($cadenaSQL) !== TRUE){
                exit ("<p>ERROR en la creación de la Base de Datos 'sewBDEjer6'. Error: " . $db->error . "</p>");  
            }else{
                echo "<p>La base de datos sewDBEjer6 se ha creado correctamente</p>";
            }

            if(!$db->close()){
                exit ("<p>ERROR al cerrar la conexión con la Base de Datos 'sewBDEjer6'. Error: " . $db->error . "</p>");
            }   
        }

        public function crearTabla(){
            $db = new mysqli($this->servername,$this->username,$this->password,$this->database);
            if($db->connect_error) {
                exit ("<p>ERROR de conexión:".$db->connect_error."</p>");  
            }

            // dejo abierta la posibilidad de que un mismo usuario realice varias pruebas de usabilidad y se guarden los datos recabados
            $crearTabla = "CREATE TABLE IF NOT EXISTS PruebasUsabilidad (
                id INT NOT NULL AUTO_INCREMENT,
                dni VARCHAR(9) NOT NULL,
                nombre VARCHAR(255) NOT NULL, 
                apellidos VARCHAR(255) NOT NULL,  
                email VARCHAR(255) NOT NULL,
                telefono INT(9) NOT NULL,
                edad TINYINT(3) NOT NULL,
                sexo ENUM('mujer','hombre','otros') NOT NULL,
                periciaInformatica ENUM('0','1','2','3','4','5','6','7','8','9','10') NOT NULL,
                tiempoRealizarTarea INT NOT NULL,
                tareaCorrecta ENUM('sí','no') NOT NULL,
                problemasEncontrados VARCHAR(255) NOT NULL,
                propuestasMejoras VARCHAR(255) NOT NULL,
                valoracion ENUM('0','1','2','3','4','5','6','7','8','9','10') NOT NULL,
                PRIMARY KEY (id))";
                      
            if($db->query($crearTabla) !== TRUE){
                exit("<p>ERROR en la creación de la tabla PruebasUsabilidad. Error : ". $db->error . "</p>");
            }else{
                echo "<p>La tabla PruebasUsabilidad se ha creado correctamente</p>";
            }
        
            if(!$db->close()){
                print_r($db->error);
            }
        } 

        public function insertarDatos(){
            $db = new mysqli($this->servername,$this->username,$this->password,$this->database);
            if($db->connect_error) {
                exit ("<p>ERROR de conexión:".$db->connect_error."</p>");  
            }

            $range = array('0','1','2','3','4','5','6','7','8','9','10');
            if(strlen($_POST["dni"]) != 9){
                echo "<p>El dni tiene que estar formado por 8 dígitos y una letra al final</p>";
                return;
            }else if(strlen($_POST["nombre"]) <= 0){
                echo "<p>El campo del nombre tiene que estar completado</p>";
                return;
            }else if(strlen($_POST["apellidos"]) <= 0){
                echo "<p>El campo de apellidos tiene que estar completado</p>";
                return;
            }else if(strpos($_POST["email"], "@") === False){
                echo "</p>El campo del email tiene que contener @</p>";
                return;
            }else if(intval($_POST["edad"]) < 0 || intval($_POST["edad"] > 120)){
                echo "<p>La edad tiene que estar entre los 0 y 120 años<p>";
                return;
            }else if($_POST["sexo"] != "mujer" && $_POST["sexo"] != "hombre" && $_POST["sexo"] != "otros"){
                echo "<p>El sexo tiene que ser mujer, hombre y otros<p>";
                return;
            }else if(!in_array($_POST["pericia"], $range)){
                echo "<p>La pericia informática tiene que estar entre el rango de 0 a 10<p>";
                return;
            }else if(intval($_POST["tiempo"]) < 60){
                echo "<p>El tiempo para realizar la tarea tiene que ser mayor a un minuto<p>";
                return;
            }else if($_POST["tareaCorrecta"] != "sí" && $_POST["tareaCorrecta"] != "no"){
                echo "<p>Las únicas opciones para el campo de tarea realizada correctamente son: sí o no<p>";
                return;
            }else if(strlen($_POST["problemas"]) <= 0){
                echo "<p>El campo de problemas encontrados no puede estar vacío</p>";
                return;
            }else if(strlen($_POST["mejoras"]) <= 0){
                echo "<p>El campo de las propuestas de mejoras no puede estar vacío</p>";
                return;
            }else if(!in_array($_POST["valoracion"], $range)){
                echo "<p>La valoración tiene que estar entre el rango de 0 a 10</p>";
                return;
            }
  
            $consultaPre = $db->prepare("INSERT INTO PruebasUsabilidad
                (dni, nombre, apellidos, email, telefono, edad, sexo, periciaInformatica, tiempoRealizarTarea, tareaCorrecta, 
                problemasEncontrados, propuestasMejoras, valoracion) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");   
            if(!$consultaPre){
                print_r($db->error);
            }

            if(!$consultaPre->bind_param('ssssiississss', 
                $_POST["dni"], $_POST["nombre"], $_POST["apellidos"], $_POST["email"], $_POST["telefono"],$_POST["edad"], $_POST["sexo"], 
                $_POST["pericia"], $_POST["tiempo"], $_POST["tareaCorrecta"], $_POST["problemas"], $_POST["mejoras"], $_POST["valoracion"])){
                print_r($db->error);
            }

            if(!$consultaPre->execute()){
                print_r($db->error);
            }else{
                echo "<p>Los datos se han insertado en la base de datos correctamente</p>";
            }
    
            if(!$consultaPre->close()){
                print_r($db->error);
            }

            if(!$db->close()){
                print_r($db->error);
            }
        }

        public function buscarTabla(){
            $db = new mysqli($this->servername,$this->username,$this->password,$this->database);
            if($db->connect_error) {
                exit ("<p>ERROR de conexión:".$db->connect_error."</p>");  
            } 

            $consultaPre = $db->prepare("SELECT * FROM PruebasUsabilidad WHERE dni = ?");   
            if(!$consultaPre){
                print_r($db->error);
            }

            if(!$consultaPre->bind_param('s', $_POST["dniFilaBuscar"])){
                print_r($db->error);
            }    

            if(!$consultaPre->execute()){
                print_r($db->error);
            }

            $resultado = $consultaPre->get_result();
            if(!$resultado){
                print_r($db->error);
            }

            if ($resultado->fetch_assoc()!=NULL) {
                $resultado->data_seek(0); //Se posiciona al inicio del resultado de búsqueda
                $mostrar = "<p>RESULTADOS:</p>";
                while($fila = $resultado->fetch_assoc()) {
                    $mostrar .= "<p>DNI: " . $fila["dni"] . "</p>";
                    $mostrar .= "<p>Nombre: " . $fila['nombre'] . "</p>";
                    $mostrar .= "<p>Apellidos: " . $fila['apellidos'] . "</p>";
                    $mostrar .= "<p>E-mail: " . $fila["email"] ."</p>";
                    $mostrar .= "<p>Teléfono: " . $fila["telefono"] . "</p>";
                    $mostrar .= "<p>Edad: " . $fila["edad"] .  "</p>";
                    $mostrar .= "<p>Sexo: " . $fila["sexo"] .  "</p>";
                    $mostrar .= "<p>Nivel de pericia informática: " . $fila["periciaInformatica"] . "</p>";
                    $mostrar .= "<p>Tiempo transcurrido para realizar la tarea (en segundos): " . $fila["tiempoRealizarTarea"] . "</p>";
                    $mostrar .= "<p>Tarea correcta: " . $fila["tareaCorrecta"] . "</p>";
                    $mostrar .= "<p>Comentarios sobre los problemas encontrados en la prueba: " . $fila["problemasEncontrados"] . "</p>";
                    $mostrar .= "<p>Propuestas de mejoras: " . $fila["propuestasMejoras"] . "</p>";
                    $mostrar .= "<p>Valoración: " . $fila["valoracion"] .  "</p>";
                } 
                if(isset($_SESSION["buscar"])){
                    $_SESSION["buscar"] = $mostrar;
                }else{
                    $_SESSION["buscar"] = $mostrar;
                }
                echo "<p>Búsqueda realizada con éxito, los datos pueden encontrarse en el apartado de Búsqueda</p>";
            } else {
                echo "<p>Búsqueda sin resultados</p>";
            }
            
            if(!$consultaPre->close()){
                print_r($db->error);
            }

            if(!$db->close()){
                print_r($db->error);
            }
        }

        public function mostrarBuscar(){
            if(isset($_SESSION["buscar"])){
                return $_SESSION["buscar"];
            }
        }

        public function modificarDatos(){
            $db = new mysqli($this->servername,$this->username,$this->password,$this->database);
            if($db->connect_error) {
                exit ("<p>ERROR de conexión:".$db->connect_error."</p>");  
            }

            $range = array('0','1','2','3','4','5','6','7','8','9','10');
            if(strlen($_POST["nombreNuevo"]) <= 0){
                echo "<p>El campo del nombre tiene que estar completado</p>";
                return;
            }else if(strlen($_POST["apellidosNuevo"]) <= 0){
                echo "<p>El campo de apellidos tiene que estar completado</p>";
                return;
            }else if(strpos($_POST["emailNuevo"], "@") === False){
                echo "</p>El campo del email tiene que contener @</p>";
                return;
            }else if(intval($_POST["edadNuevo"]) < 0 || intval($_POST["edad"] > 120)){
                echo "<p>La edad tiene que estar entre los 0 y 120 años</p>";
                return;
            }else if($_POST["sexoNuevo"] != "mujer" && $_POST["sexoNuevo"] != "hombre" && $_POST["sexoNuevo"] != "otros"){
                echo "<p>El sexo tiene que ser mujer, hombre y otros</p>";
                return;
            }else if(!in_array($_POST["periciaNuevo"], $range)){
                echo "<p>La pericia informática tiene que estar entre el rango de 0 a 10</p>";
                return;
            }else if(intval($_POST["tiempoNuevo"]) < 60){
                echo "<p>El tiempo para realizar la tarea tiene que ser mayor a un minuto</p>";
                return;
            }else if($_POST["tareaCorrectaNuevo"] != "sí" && $_POST["tareaCorrectaNuevo"] != "no"){
                echo "<p>Las únicas opciones para el campo de tarea realizada correctamente son: sí o no</p>";
                return;
            }else if(strlen($_POST["problemasNuevo"]) <= 0){
                echo "<p>El campo de problemas encontrados no puede estar vacío</p>";
                return;
            }else if(strlen($_POST["mejorasNuevo"]) <= 0){
                echo "<p>El campo de las propuestas de mejoras no puede estar vacío</p>";
                return;
            }else if(!in_array($_POST["valoracionNuevo"], $range)){
                echo "<p>La valoración tiene que estar entre el rango de 0 a 10</p>";
                return;
            }

            // chekear si el id y el dni son correctos: se encuentran en la base de datos y se corresponden entre ellos!!
            $correct = true;

            $consultaPre = $db->prepare("SELECT count(*) FROM PruebasUsabilidad WHERE id = ? and dni = ?");   
            if(!$consultaPre){
                print_r($db->error);
            }

            if(!$consultaPre->bind_param('is', $_POST["idFilaModificar"], $_POST["dniFilaModificar"])){
                print_r($db->error);
            }    

            if(!$consultaPre->execute()){
                print_r($db->error);
            }

            $nrows = $consultaPre->get_result()->fetch_row()[0];
            if ($nrows <= 0) {
                $correct = false;
                echo "<p>No se ha encontrado en la base de datos una fila con el identificador y dni proporcionados</p>";
            }

            if(!$consultaPre->close()){
                print_r($db->error);
            }

            if(!$correct){
                return;
            }
  
            $consultaPre = $db->prepare("UPDATE PruebasUsabilidad SET nombre = ?, apellidos = ?, email = ?, telefono = ?, edad = ?,
                sexo = ?, periciaInformatica = ?, tiempoRealizarTarea = ?, tareaCorrecta = ?, problemasEncontrados = ?, propuestasMejoras = ?,
                valoracion = ? where id = ? and dni = ?");   
            if(!$consultaPre){
                print_r($db->error);
            }
        
            if(!$consultaPre->bind_param('sssiississssis', 
                $_POST["nombreNuevo"], $_POST["apellidosNuevo"], $_POST["emailNuevo"], $_POST["telefonoNuevo"], $_POST["edadNuevo"], 
                $_POST["sexoNuevo"], $_POST["periciaNuevo"], $_POST["tiempoNuevo"], $_POST["tareaCorrectaNuevo"], $_POST["problemasNuevo"], 
                $_POST["mejorasNuevo"], $_POST["valoracionNuevo"], $_POST["idFilaModificar"], $_POST["dniFilaModificar"])){
                    print_r($db->error);
            }

            if(!$consultaPre->execute()){
                print_r($db->error);
            }else{
                echo "<p>Modificación realizada con éxito</p>";
            }
    
            if(!$consultaPre->close()){
                print_r($db->error);
            }

            if(!$db->close()){
                print_r($db->error);
            }
        }

        public function eliminarDatos(){
            $db = new mysqli($this->servername,$this->username,$this->password,$this->database);
            if($db->connect_error) {
                exit ("<p>ERROR de conexión:".$db->connect_error."</p>");  
            } 

            $correct = true;

            $consultaPre = $db->prepare("SELECT count(*) FROM PruebasUsabilidad WHERE id = ? and dni = ?");   
            if(!$consultaPre){
                print_r($db->error);
            }

            if(!$consultaPre->bind_param('is', $_POST["idFilaEliminar"], $_POST["dniFilaEliminar"])){
                print_r($db->error);
            }    

            if(!$consultaPre->execute()){
                print_r($db->error);
            }

            $nrows = $consultaPre->get_result()->fetch_row()[0];
            if ($nrows <= 0) {
                $correct = false;
                echo "<p>No se ha encontrado en la base de datos una fila con el identificador y dni proporcionados</p>";
            }

            if(!$consultaPre->close()){
                print_r($db->error);
            }

            if(!$correct){
                return;
            }

            $consultaPre = $db->prepare("DELETE FROM PruebasUsabilidad WHERE id = ? and dni = ?");   
            if(!$consultaPre){
                print_r($db->error);
            }

            if(!$consultaPre->bind_param('is', $_POST["idFilaEliminar"], $_POST["dniFilaEliminar"])){
                print_r($db->error);
            }  

            if(!$consultaPre->execute()){
                print_r($db->error);
            }else{
                echo "<p>Eliminación realizada con éxito</p>";
            }
            
            if(!$consultaPre->close()){
                print_r($db->error);
            }

            if(!$db->close()){
                print_r($db->error);
            }
        }

        public function generarInforme(){
            $edadMedia = $this->getEdadMedia();
            $frecuenciaSexo = $this->getFrecuenciaSexo();
            list($mujeres, $hombres, $otros) = $frecuenciaSexo;
            $periciaMedia = $this->getMediaPericiaInformatica();
            $tiempoMedio = $this->getTiempoMedio();
            $porcentageCorrecto = $this->getPercentageTareaCorrecta();
            $puntuacionMedia = $this->getPuntuacionMedia();

            $mostrar = "<p>Resultados informe:</p>";
            $mostrar .= "<p> Edad media de los usuarios = " . $edadMedia  . "</p>";
            $mostrar .= "<p> Frecuencia del % de cada tipode sexo entre los usuarios -> mujeres = " . $mujeres . "% hombres = " .
                $hombres . "% otros = " . $otros . "% </p>";
            $mostrar .= "<p> Valor medio de la pericia informática de los usuarios = " . $periciaMedia . "</p>";
            $mostrar .= "<p> Tiempo medio transcurrido en la realización de la tarea (en segundos) = " . $tiempoMedio . "</p>";
            $mostrar .= "<p> Porcentaje de usuarios que han realizado la tarea correctamente -> sí = " . $porcentageCorrecto[0] . "% no = " . 
                $porcentageCorrecto[1]  . "% <p>";
            $mostrar .= "<p> Valor medio de la puntuación de los usuarios sobre la aplicación = " . $puntuacionMedia . "</p>";

            if(isset($_SESSION["informe"])){
                $_SESSION["informe"] = $mostrar;
            }else{
                $_SESSION["informe"] = $mostrar;
            }
        }

        public function getEdadMedia(){
            $db = new mysqli($this->servername,$this->username,$this->password,$this->database);
            if($db->connect_error) {
                exit ("<p>ERROR de conexión:".$db->connect_error."</p>");  
            }  
            
            $resultado =  $db->query("SELECT edad FROM PruebasUsabilidad");
            if(!$resultado){
                print_r($db->error);
            }

            $media = 0;
            $edad = 0;
            if ($resultado->num_rows > 0) {
                while($row = $resultado->fetch_assoc()) {
                    $edad += $row["edad"]; 
                }
                $media = $edad / $resultado->num_rows; // evito divisiones entre 0
            }

            if(!$resultado->close()){
                print_r($db->error);
            }

            if(!$db->close()){
                print_r($db->error);
            }

            return $media;
        }

        public function getFrecuenciaSexo(){
            $db = new mysqli($this->servername,$this->username,$this->password,$this->database);
            if($db->connect_error) {
                exit ("<p>ERROR de conexión:".$db->connect_error."</p>");  
            }  
            
            $resultado =  $db->query("SELECT sexo FROM PruebasUsabilidad");
            if(!$resultado){
                print_r($db->error);
            }

            $mujeres = 0;
            $hombres = 0;
            $otros = 0;
            $m = 0;
            $h = 0;
            $o = 0;
            if ($resultado->num_rows > 0) {
                while($row = $resultado->fetch_assoc()) {
                    if($row["sexo"] == "mujer"){
                        $mujeres += 1; 
                    }else if($row["sexo"] == "hombre"){
                        $hombres += 1; 
                    }else{
                        $otros += 1;
                    }
                }
                $m = ( $mujeres / $resultado->num_rows ) * 100;
                $h = ( $hombres / $resultado->num_rows ) * 100;
                $o = ( $otros / $resultado->num_rows ) * 100;
            }
            
            if(!$resultado->close()){
                print_r($db->error);
            }

            if(!$db->close()){
                print_r($db->error);
            }

            return array($m, $h, $o);
        }

        public function getMediaPericiaInformatica(){
            $db = new mysqli($this->servername,$this->username,$this->password,$this->database);
            if($db->connect_error) {
                exit ("<p>ERROR de conexión:".$db->connect_error."</p>");  
            }  
            
            $resultado =  $db->query("SELECT periciaInformatica FROM PruebasUsabilidad");
            if(!$resultado){
                print_r($db->error);
            }

            $pericia = 0;
            $media = 0;
            if ($resultado->num_rows > 0) {
                while($row = $resultado->fetch_assoc()) {
                    $pericia += $row["periciaInformatica"]; 
                }
                $media = $pericia / $resultado->num_rows;
            }  

            if(!$resultado->close()){
                print_r($db->error);
            }

            if(!$db->close()){
                print_r($db->error);
            }

            return $media;
        }

        public function getTiempoMedio(){
            $db = new mysqli($this->servername,$this->username,$this->password,$this->database);
            if($db->connect_error) {
                exit ("<p>ERROR de conexión:".$db->connect_error."</p>");  
            }  
            
            $resultado =  $db->query("SELECT tiempoRealizarTarea FROM PruebasUsabilidad");
            if(!$resultado){
                print_r($db->error);
            }

            $tiempo = 0;
            $media = 0;
            if ($resultado->num_rows > 0) {
                while($row = $resultado->fetch_assoc()) {
                    $tiempo += $row["tiempoRealizarTarea"]; 
                }
                $media = $tiempo / $resultado->num_rows;
            } 
            
            if(!$resultado->close()){
                print_r($db->error);
            }

            if(!$db->close()){
                print_r($db->error);
            }

            return $media;
        }

        public function getPercentageTareaCorrecta(){
            $db = new mysqli($this->servername,$this->username,$this->password,$this->database);
            if($db->connect_error) {
                exit ("<p>ERROR de conexión:".$db->connect_error."</p>");  
            }  
            
            $resultado =  $db->query("SELECT tareaCorrecta FROM PruebasUsabilidad");
            if(!$resultado){
                print_r($db->error);
            }

            $si = 0;
            $no = 0;
            $s = 0;
            $n = 0;
            if ($resultado->num_rows > 0) {
                while($row = $resultado->fetch_assoc()) {
                    if($row["tareaCorrecta"] == "sí"){
                        $si += 1; 
                    }else{
                        $no += 1;
                    }
                }
                $s = ( $si / $resultado->num_rows ) * 100;
                $n = ( $no / $resultado->num_rows ) * 100;
            }  

            if(!$resultado->close()){
                print_r($db->error);
            }

            if(!$db->close()){
                print_r($db->error);
            }

            return array($s, $n);
        }

        public function getPuntuacionMedia(){
            $db = new mysqli($this->servername,$this->username,$this->password,$this->database);
            if($db->connect_error) {
                exit ("<p>ERROR de conexión:".$db->connect_error."</p>");  
            }  
            
            $resultado =  $db->query("SELECT valoracion FROM PruebasUsabilidad");
            if(!$resultado){
                print_r($db->error);
            }

            $valoracion = 0;
            $media = 0;
            if ($resultado->num_rows > 0) {
                while($row = $resultado->fetch_assoc()) {
                    $valoracion += $row["valoracion"]; 
                }
                $media = $valoracion / $resultado->num_rows;
            } 
            
            if(!$resultado->close()){
                print_r($db->error);
            }

            if(!$db->close()){
                print_r($db->error);
            }

            return $media;
        }

        public function mostrarInforme(){
            if(isset($_SESSION["informe"])){
                return $_SESSION["informe"];
            }
        }

        public function exportarArchivo(){
            $db = new mysqli($this->servername,$this->username,$this->password,$this->database);
            if($db->connect_error) {
                exit ("<p>ERROR de conexión:".$db->connect_error."</p>");  
            }  
            
            $resultado = $db->query("SELECT * FROM PruebasUsabilidad");
            if(!$resultado){
                print_r($db->error);
            }

            if($resultado->num_rows > 0){
                $delimiter = ";";
                $filename = "pruebasUsabilidad.csv";
                
                try{
                    $f = fopen($filename, "w");
                
                    $fields = array('Id', 'DNI', 'Nombre', 'Apellidos', 'E-mail', 'Teléfono', 'Edad', "Sexo", 'Pericia informática', 
                        'Tiempo transcurrido para realizar la tarea', 'Tarea realizada correctamente', 'Problemas encontrados', 
                        'Propuestas de mejora', 'Valoración');
                    fputcsv($f, $fields, $delimiter);
                    
                    while($row = $resultado->fetch_assoc()){
                        $lineData = array($row['id'], $row['dni'], $row['nombre'], $row['apellidos'], $row['email'], $row['telefono'], $row["edad"], 
                            $row["sexo"], $row["periciaInformatica"], $row["tiempoRealizarTarea"], $row["tareaCorrecta"], 
                            $row["problemasEncontrados"], $row["propuestasMejoras"], $row["valoracion"]);
                        fputcsv($f, $lineData, $delimiter);
                    }

                    fclose($f);

                    echo "<p>Exportación del archivo realizada con éxito</p>"; 
                }catch(Throwable $exc){
                    echo "<p>Error: " . $exc->getMessage() . "</p>";
                }  
            }

            if(!$resultado->close()){
                print_r($db->error);
            }

            if(!$db->close()){
                print_r($db->error);
            }
        }

        public function cargarArchivo(){
            if($_FILES){
                $filename = $_FILES["archivo"]["name"];
                $info = new SplFileInfo($filename);
                $extension = pathinfo($info->getFilename(), PATHINFO_EXTENSION);

                if($extension == "csv"){
                    try{
                        $handle = fopen($filename, "r");

                        $db = new mysqli($this->servername,$this->username,$this->password,$this->database);

                        if($db->connect_error) {
                            exit ("<p>ERROR de conexión:".$db->connect_error."</p>");  
                        }  

                        while(($row = fgetcsv($handle, 1000, ";")) !== FALSE){
                            $consultaPre = $db->prepare("INSERT INTO PruebasUsabilidad 
                                (dni, nombre, apellidos, email, telefono, edad, sexo, periciaInformatica, tiempoRealizarTarea, tareaCorrecta, 
                                problemasEncontrados, propuestasMejoras, valoracion) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");   

                            if(!$consultaPre){
                                print_r($db->error);
                            }  

                            if(!($consultaPre->bind_param('ssssiississss', 
                                $row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9], $row[10], $row[11],
                                $row[12]))){
                                print_r($db->error);
                            }

                            if(!$consultaPre->execute()){
                                print_r($db->error);
                            }

                            if(!$consultaPre->close()){
                                print_r($db->error);
                            }
                        }

                        if(!$db->close()){
                            print_r($db->error);
                        }

                        fclose($handle);

                        echo "<p>Carga del archivo realizada con éxito</p>"; 
                    }catch(Throwable $exc){
                        echo "<p>Error: " . $exc->getMessage() . "</p>";
                    }
                }
            }    
        }
    }
?>