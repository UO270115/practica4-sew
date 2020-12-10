<?php
    class BaseDatos{

        protected $servername = "localhost";
        protected $username = "DBUSER2020";
        protected $password = "DBPSWD2020";
        protected $database = "sewBD";

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
        
            $cadenaSQL = "CREATE DATABASE IF NOT EXISTS sewBD COLLATE utf8_spanish_ci";

            if($db->query($cadenaSQL) !== TRUE){
                exit ("<p>ERROR en la creación de la Base de Datos 'sewBD'. Error: " . $db->error . "</p>");  
            }

            $db->close();    
        }

        public function crearTabla(){
            $db = new mysqli($this->servername,$this->username,$this->password,$this->database);

            $crearTabla = "CREATE TABLE IF NOT EXISTS PruebasUsabilidad (
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
                PRIMARY KEY (dni))";
                      
            if($db->query($crearTabla) !== TRUE){
                exit("<p>ERROR en la creación de la tabla PruebasUsabilidad. Error : ". $db->error . "</p>");
            }   
        
            $db->close();    
        } 

        public function insertarDatos(){
            $db = new mysqli($this->servername,$this->username,$this->password,$this->database);

            if($db->connect_error) {
                exit ("<h2>ERROR de conexión:".$db->connect_error."</h2>");  
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
            }
    
            $consultaPre->close();
            $db->close();    
        }

        public function buscarTabla(){
            $db = new mysqli($this->servername,$this->username,$this->password,$this->database);

            if($db->connect_error) {
                exit ("<h2>ERROR de conexión:".$db->connect_error."</h2>");  
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

            if ($resultado->fetch_assoc()!=NULL) {
                $resultado->data_seek(0); //Se posiciona al inicio del resultado de búsqueda
                while($fila = $resultado->fetch_assoc()) {
                    $mostrar = "<p>Resultados:</p>";
                    $mostrar .= "<p>DNI: " . $fila["dni"] . " - Nombre: ". $fila['nombre'] ." - Apellidos: " . $fila['apellidos'] .
                        " - E-mail: " . $fila["email"] . " - Teléfono: " . $fila["telefono"] . " - Edad: " . $fila["edad"] .
                        " - Sexo: " . $fila["sexo"] . " - Pericia informática: " . $fila["periciaInformatica"] . 
                        " - Tiempo transcurrido para realizar la tarea: " . $fila["tiempoRealizarTarea"] . " - Tarea correcta: " .
                        $fila["tareaCorrecta"] . " - Comentarios sobre problemas: " . $fila["problemasEncontrados"] .
                        " - Propuestas de mejoras: " . $fila["propuestasMejoras"] . " - Valoración: " . $fila["valoracion"] ."</p>"; 
                    if(isset($_SESSION["buscar"])){
                        $_SESSION["buscar"] = $mostrar;
                    }else{
                        $_SESSION["buscar"] = $mostrar;
                    }
                }               
            } else {
                echo "<p>Búsqueda sin resultados</p>";
            }
        
            $consultaPre->close();
            $db->close();     
        }

        public function mostrarBuscar(){
            if(isset($_SESSION["buscar"])){
                return $_SESSION["buscar"];
            }
        }

        public function modificarDatos(){
            $db = new mysqli($this->servername,$this->username,$this->password,$this->database);

            if($db->connect_error) {
                exit ("<h2>ERROR de conexión:".$db->connect_error."</h2>");  
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
                echo "<p>La edad tiene que estar entre los 0 y 120 años<p>";
                return;
            }else if($_POST["sexoNuevo"] != "mujer" && $_POST["sexoNuevo"] != "hombre" && $_POST["sexoNuevo"] != "otros"){
                echo "<p>El sexo tiene que ser mujer, hombre y otros<p>";
                return;
            }else if(!in_array($_POST["periciaNuevo"], $range)){
                echo "<p>La pericia informática tiene que estar entre el rango de 0 a 10<p>";
                return;
            }else if(intval($_POST["tiempoNuevo"]) < 60){
                echo "<p>El tiempo para realizar la tarea tiene que ser mayor a un minuto<p>";
                return;
            }else if($_POST["tareaCorrectaNuevo"] != "sí" && $_POST["tareaCorrectaNuevo"] != "no"){
                echo "<p>Las únicas opciones para el campo de tarea realizada correctamente son: sí o no<p>";
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
  
            $consultaPre = $db->prepare("UPDATE PruebasUsabilidad SET  nombre = ?, apellidos = ?, email = ?, telefono = ?, edad = ?,
                sexo = ?, periciaInformatica = ?, tiempoRealizarTarea = ?, tareaCorrecta = ?, problemasEncontrados = ?, propuestasMejoras = ?,
                valoracion = ? where dni = ?");   
        
            $consultaPre->bind_param('sssiississsss', 
                $_POST["nombreNuevo"], $_POST["apellidosNuevo"], $_POST["emailNuevo"], $_POST["telefonoNuevo"], $_POST["edadNuevo"], 
                $_POST["sexoNuevo"], $_POST["periciaNuevo"], $_POST["tiempoNuevo"], $_POST["tareaCorrectaNuevo"], $_POST["problemasNuevo"], 
                $_POST["mejorasNuevo"], $_POST["valoracionNuevo"], $_POST["dniFilaModificar"]);    

            $consultaPre->execute();
            $consultaPre->close();
            $db->close();  
        }

        public function eliminarDatos(){
            $db = new mysqli($this->servername,$this->username,$this->password,$this->database);

            if($db->connect_error) {
                exit ("<h2>ERROR de conexión:".$db->connect_error."</h2>");  
            } 

            $consultaPre = $db->prepare("DELETE FROM PruebasUsabilidad WHERE dni = ?");   

            if(!$consultaPre){
                print_r($db->error);
            }

            if(!$consultaPre->bind_param('s', $_POST["dniFilaEliminar"])){
                print_r($db->error);
            }    

            if(!$consultaPre->execute()){
                print_r($db->error);
            }
        
            $consultaPre->close();
            $db->close();     
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
            $mostrar .= "<p> Edad media de los usuarios = " . $edadMedia  . "<p>";
            $mostrar .= "<p> Frecuencia del % de cada tipode sexo entre los usuarios -> mujeres = " . $mujeres . "% hombres = " .
                $hombres . "% otros = " . $otros . "% <p>";
            $mostrar .= "<p> Valor medio de la pericia informática de los usuarios = " . $periciaMedia . "<p>";
            $mostrar .= "<p> Tiempo medio transcurrido en la realización de la tarea (en segundos) = " . $tiempoMedio . "<p>";
            $mostrar .= "<p> Porcentaje de usuarios que han realizado la tarea correctamente -> sí = " . $porcentageCorrecto[0] . "% no = " . 
                $porcentageCorrecto[1]  . "% <p>";
            $mostrar .= "<p> Valor medio de la puntuación de los usuarios sobre la aplicación = " . $puntuacionMedia . "<p>";

            if(isset($_SESSION["informe"])){
                $_SESSION["informe"] = $mostrar;
            }else{
                $_SESSION["informe"] = $mostrar;
            }
        }

        public function getEdadMedia(){
            $db = new mysqli($this->servername,$this->username,$this->password,$this->database);

            if($db->connect_error) {
                exit ("<h2>ERROR de conexión:".$db->connect_error."</h2>");  
            }  
            
            $resultado =  $db->query("SELECT edad FROM PruebasUsabilidad");
            if(!$resultado){
                print_r($db->error);
            }

            $edad = 0;
            if ($resultado->num_rows > 0) {
                while($row = $resultado->fetch_assoc()) {
                    $edad += $row["edad"]; 
                }
            }  

            $media = $edad / $resultado->num_rows;

            return $media;
        }

        public function getFrecuenciaSexo(){
            $db = new mysqli($this->servername,$this->username,$this->password,$this->database);

            if($db->connect_error) {
                exit ("<h2>ERROR de conexión:".$db->connect_error."</h2>");  
            }  
            
            $resultado =  $db->query("SELECT sexo FROM PruebasUsabilidad");

            $mujeres = 0;
            $hombres = 0;
            $otros = 0;
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
            }  

            $m = ( $mujeres / $resultado->num_rows ) * 100;
            $h = ( $hombres / $resultado->num_rows ) * 100;
            $o = ( $otros / $resultado->num_rows ) * 100;

            return array($m, $h, $o);
        }

        public function getMediaPericiaInformatica(){
            $db = new mysqli($this->servername,$this->username,$this->password,$this->database);

            if($db->connect_error) {
                exit ("<h2>ERROR de conexión:".$db->connect_error."</h2>");  
            }  
            
            $resultado =  $db->query("SELECT periciaInformatica FROM PruebasUsabilidad");

            $pericia = 0;
            if ($resultado->num_rows > 0) {
                while($row = $resultado->fetch_assoc()) {
                    $pericia += $row["periciaInformatica"]; 
                }
            }  

            $media = $pericia / $resultado->num_rows;

            return $media;
        }

        public function getTiempoMedio(){
            $db = new mysqli($this->servername,$this->username,$this->password,$this->database);

            if($db->connect_error) {
                exit ("<h2>ERROR de conexión:".$db->connect_error."</h2>");  
            }  
            
            $resultado =  $db->query("SELECT tiempoRealizarTarea FROM PruebasUsabilidad");

            $tiempo = 0;
            if ($resultado->num_rows > 0) {
                while($row = $resultado->fetch_assoc()) {
                    $tiempo += $row["tiempoRealizarTarea"]; 
                }
            }  

            $media = $tiempo / $resultado->num_rows;

            return $media;
        }

        public function getPercentageTareaCorrecta(){
            $db = new mysqli($this->servername,$this->username,$this->password,$this->database);

            if($db->connect_error) {
                exit ("<h2>ERROR de conexión:".$db->connect_error."</h2>");  
            }  
            
            $resultado =  $db->query("SELECT tareaCorrecta FROM PruebasUsabilidad");

            $si = 0;
            $no = 0;
            if ($resultado->num_rows > 0) {
                while($row = $resultado->fetch_assoc()) {
                    if($row["tareaCorrecta"] == "sí"){
                        $si += 1; 
                    }else{
                        $no += 1;
                    }
                }
            }  

            $s = ( $si / $resultado->num_rows ) * 100;
            $n = ( $no / $resultado->num_rows ) * 100;

            return array($s, $n);
        }

        public function getPuntuacionMedia(){
            $db = new mysqli($this->servername,$this->username,$this->password,$this->database);

            if($db->connect_error) {
                exit ("<h2>ERROR de conexión:".$db->connect_error."</h2>");  
            }  
            
            $resultado =  $db->query("SELECT valoracion FROM PruebasUsabilidad");

            $valoracion = 0;
            if ($resultado->num_rows > 0) {
                while($row = $resultado->fetch_assoc()) {
                    $valoracion += $row["valoracion"]; 
                }
            }  

            $media = $valoracion / $resultado->num_rows;

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
                exit ("<h2>ERROR de conexión:".$db->connect_error."</h2>");  
            }  
            
            $resultado = $db->query("SELECT * FROM PruebasUsabilidad");

            if($resultado->num_rows > 0){
                $delimiter = ";";
                $filename = "pruebasUsabilidad.csv";
                
                // create a file pointer
                //$f = fopen("php://output", 'w'); // me incluye el contenido deseado junto con el contenido del Ejercicio6.php
                //$f = fopen('C:/Users/Andrea/Downloads/pruebasUsabilidad.csv', 'w');
                $f = fopen($filename, "w"); // wb?
                //$filename = "\xEF\xBB\xBF" . $filename;
                
                $fields = array('DNI', 'Nombre', 'Apellidos', 'E-mail', 'Teléfono', 'Edad', "Sexo", 'Pericia informática', 
                    'Tiempo transcurrido para realizar la tarea', 'Tarea realizada correctamente', 'Problemas encontrados', 
                    'Propuestas de mejora', 'Valoración');
                fputcsv($f, $fields, $delimiter);
                
                while($row = $resultado->fetch_assoc()){
                    $lineData = array($row['dni'], $row['nombre'], $row['apellidos'], $row['email'], $row['telefono'], $row["edad"], 
                        $row["sexo"], $row["periciaInformatica"], $row["tiempoRealizarTarea"], $row["tareaCorrecta"], 
                        $row["problemasEncontrados"], $row["propuestasMejoras"], $row["valoracion"]);
                    fputcsv($f, $lineData, $delimiter);
                }
                
                //output all remaining data on a file pointer
                //fpassthru($f);

                //set headers to download file rather than displayed
                // header('Content-Disposition: attachment; filename="' . $filename . '";');
                // header("Content-Type: text/csv; charset=utf-8");

                fclose($f);
            }
        }

        public function cargarArchivo(){
            if($_FILES){
                $filename = $_FILES["archivo"]["name"];
                $info = new SplFileInfo($filename);
                $extension = pathinfo($info->getFilename(), PATHINFO_EXTENSION);

                if($extension == "csv"){
                    $handle = fopen($filename, "r"); // rb?

                    $db = new mysqli($this->servername,$this->username,$this->password,$this->database);

                    if($db->connect_error) {
                        exit ("<h2>ERROR de conexión:".$db->connect_error."</h2>");  
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

                        $consultaPre->close();
                    }

                    $db->close();
                }
            }    
        }
    }
?>