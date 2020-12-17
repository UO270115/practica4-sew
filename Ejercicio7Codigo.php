<?php
    class BaseDatos{

        protected $servername = "localhost";
        protected $username = "DBUSER2020";
        protected $password = "DBPSWD2020";
        protected $database = "sewBDEjer7";

        public function __construct(){
            session_start();
            $this->crearBD();
            $this->crearTablas();
        }

        public function init(){
            if (count($_POST)>0) {
                if(isset($_POST["botonReservar"])){
                    $this->insertarDatos();
                } 
                if(isset($_POST["botonExportar"])){
                    $this->generarResguardo();
                } 
                if(isset($_POST["botonBuscar"])){
                    $this->buscarReserva();
                }
                if(isset($_POST["botonEliminar"])){
                    $this->eliminarReserva();
                }
                // if(isset($_POST["botonCargar"])){
                //     $this->cargarArchivo();
                // }
            }
        }

        public function crearBD(){
            $db = new mysqli($this->servername, $this->username, $this->password);
            if($db->connect_error) {
                exit ("<p>ERROR de conexión:" . $db->connect_error . "</p>");  
            }
        
            $cadenaSQL = "CREATE DATABASE IF NOT EXISTS sewBDEjer7 COLLATE utf8_spanish_ci";

            if($db->query($cadenaSQL) !== TRUE){
                exit ("<p>ERROR en la creación de la Base de Datos 'sewBDEjer7'. Error: " . $db->error . "</p>");  
            }

            if(!$db->close()){
                exit ("<p>ERROR al cerrar la conexión con la Base de Datos 'sewBDEjer7'. Error: " . $db->error . "</p>"); 
            }  
        }

        public function crearTablas(){
            $db = new mysqli($this->servername,$this->username,$this->password,$this->database);
            if($db->connect_error){
                exit ("<p>ERROR de conexión:".$db->connect_error."</p>");  
            }

            $crearTabla = "CREATE TABLE IF NOT EXISTS Cliente (
                id INT NOT NULL AUTO_INCREMENT,
                dni VARCHAR(9) NOT NULL,
                nombre VARCHAR(255) NOT NULL, 
                apellidos VARCHAR(255) NOT NULL,  
                email VARCHAR(255) NOT NULL,
                telefono INT(9) NOT NULL,
                PRIMARY KEY (id))";
                      
            if($db->query($crearTabla) !== TRUE){
                exit("<p>ERROR en la creación de la tabla Cliente. Error : ". $db->error . "</p>");
            }

            $crearTabla = "CREATE TABLE IF NOT EXISTS Habitacion (
                nHabitacion INT(2) NOT NULL,
                planta ENUM('1','2','3','4','5') NOT NULL, 
                PRIMARY KEY (nHabitacion))";
                      
            if($db->query($crearTabla) !== TRUE){
                exit("<p>ERROR en la creación de la tabla Habitacion. Error : ". $db->error . "</p>");
            }  

            $crearTabla = "CREATE TABLE IF NOT EXISTS Reserva (
                idReserva INT NOT NULL AUTO_INCREMENT, 
                fechaEntrada DATE NOT NULL,
                fechaSalida DATE NOT NULL,
                idCliente INT NOT NULL,
                nHabitacion INT(2) NOT NULL,
                FOREIGN KEY (idCliente) REFERENCES Cliente(id),
                FOREIGN KEY (nHabitacion) REFERENCES Habitacion(nHabitacion),
                PRIMARY KEY (idReserva))";
                      
            if($db->query($crearTabla) !== TRUE){
                exit("<p>ERROR en la creación de la tabla Reserva. Error : ". $db->error . "</p>");
            }
        
            if(!$db->close()){
                print_r($db->error);
            }    
        } 

        // no compruebo si un usuario realiza una reserva en las mismas fechas ya que la reserva podría ser para otra persona
        public function insertarDatos(){
            $db = new mysqli($this->servername,$this->username,$this->password,$this->database);
            if($db->connect_error){
                exit ("<p>ERROR de conexión:".$db->connect_error."</p>");  
            }

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
            }else if(strlen($_POST["telefono"]) != 9){
                echo "<p>El telefono tiene que estar compuesto por 9 dígitos<p>";
                return;
            }

            $query1 = $db->query("SELECT MAX(nHabitacion) FROM Reserva");
            if(!$query1){
                print_r($db->error);
            }

            $habitacion = -1;
            if ($query1->num_rows > 0) {
                while($row = $query1->fetch_assoc()) {
                    $habitacion = $row["MAX(nHabitacion)"];
                }
            }

            if(!$query1->close()){
                print_r($db->error);
            }

            if($habitacion < 49){
                if($habitacion < 0){
                    $habitacion = 1;
                }else{
                    $habitacion += 1;
                }
            }else{
                $habitacion = escogerHabitacion();
                if($habitacion == -1){
                    echo "<p>Lo sentimos, no hay habitaciones disponibles para las fechas seleccionadas</p>";
                    return;
                }
            }

            if($_POST["fechaEntrada"] >= $_POST["fechaSalida"]){
                echo "<p>La fecha de entrada no puede ser el mismo día o posterior a la fecha de salida</p>";
                return;
            }

            $consultaPre = $db->prepare("INSERT INTO Cliente (dni, nombre, apellidos, email, telefono) VALUES (?,?,?,?,?)");   

            if(!$consultaPre){
                print_r($db->error);
            }

            if(!$consultaPre->bind_param('ssssi', $_POST["dni"], $_POST["nombre"], $_POST["apellidos"], $_POST["email"], $_POST["telefono"])){
                print_r($db->error);
            }

            if(!$consultaPre->execute()){
                print_r($db->error);
            }
    
            if(!$consultaPre->close()){
                print_r($db->error);
            }

            $query2 = $db->query("SELECT MAX(id) FROM Cliente");
            if(!$query2){
                print_r($db->error);
            }

            $idCliente = -1;
            if ($query2->num_rows > 0) {
                while($row = $query2->fetch_assoc()) {
                    $idCliente = $row["MAX(id)"];
                }
            }

            if(!$query2->close()){
                print_r($db->error);
            }

            $consultaPre = $db->prepare("INSERT INTO Reserva (fechaEntrada, fechaSalida, idCliente, nHabitacion) VALUES (?,?,?,?)");   

            if(!$consultaPre){
                print_r($db->error);
            }

            if(!$consultaPre->bind_param('ssii', $_POST["fechaEntrada"], $_POST["fechaSalida"], $idCliente, $habitacion)){
                print_r($db->error);
            }

            $correct = true;
            if(!$consultaPre->execute()){
                $correct = false;
                print_r($db->error);
            }else{
                echo "<p>La reserva ha sido realizada correctamente</p>";
            }

            if(!$consultaPre->close()){
                print_r($db->error);
            }

            $query3 = $db->query("SELECT MAX(idReserva) FROM Reserva");
            if(!$query3){
                print_r($db->error);
            }

            if ($query3->num_rows > 0 && $correct) {
                while($row = $query3->fetch_assoc()) {
                    echo "<p>El identificador de la reserva realizada es  " . $row["MAX(idReserva)"] . "</p>";
                }
            }

            if(!$query3->close()){
                print_r($db->error);
            }

            if(!$db->close()){
                print_r($db->error);
            }    
        }

        public function escogerHabitacion(){
            $db = new mysqli($this->servername,$this->username,$this->password,$this->database);
            if($db->connect_error) {
                exit ("<p>ERROR de conexión:".$db->connect_error."</p>");  
            } 

            $consulta = $db->query("SELECT * FROM Reserva"); 
            if(!$consultaPre){
                print_r($db->error);
            }  

            $resultado = $consulta->get_result();
            if(!$resultado){
                print_r($db->error);
            }

            $habitacion = -1;
            if ($resultado->fetch_assoc()!=NULL) {
                $resultado->data_seek(0);
                while($fila = $resultado->fetch_assoc()) {
                    $fEReserva = $fila["fechaEntrada"];
                    $fSReserva = $fila["fechaSalida"];
                    $fE = $_POST["fechaEntrada"];
                    $fS = $_POST["fechaSalida"];
                    if(($fE < $fEReserva && $fS <= $fEReserva) || ($fE >= $fSReserva && $fS > $fSReserva)){
                        $habitacion = $fila["nHabitacion"];
                        break;
                    }
                }               
            }

            if(!$consulta->close()){
                print_r($db->error);
            }

            if(!$db->close()){
                print_r($db->error);
            } 

            return $habitacion;
        }

        public function generarResguardo(){
            $db = new mysqli($this->servername,$this->username,$this->password,$this->database);
            if($db->connect_error) {
                exit ("<p>ERROR de conexión:".$db->connect_error."</p>");  
            }  

            // chekear si el id y el dni son correctos: se encuentran en la base de datos y se corresponden entre ellos!!
            $correct = true;

            $consultaPre = $db->prepare("SELECT count(*) FROM Reserva r INNER JOIN Cliente c ON c.id = r.idCliente WHERE r.idReserva = ? and c.dni = ?");   
            if(!$consultaPre){
                print_r($db->error);
            }

            if(!$consultaPre->bind_param('is', $_POST["idReservaExportar"], $_POST["dniReservaExportar"])){
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

            $consultaPre = $db->prepare("SELECT r.idReserva, c.dni, c.nombre, c.apellidos, c.email, c.telefono, r.fechaEntrada, r.fechaSalida,
                r.nHabitacion FROM Reserva r INNER JOIN Cliente c ON c.id = r.idCliente WHERE r.idReserva = ? and c.dni = ?");  
            if(!$consultaPre){
                print_r($db->error);
            }

            if(!$consultaPre->bind_param('is', $_POST["idReservaExportar"], $_POST["dniReservaExportar"])){
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
                $filename = "resguardoReserva.txt";
                try{
                    $f = fopen($filename, "w"); 

                    $resultado->data_seek(0);
                    while($row = $resultado->fetch_assoc()) {
                        $lineData = "Datos del cliente: " . "\n";
                        $lineData .= "- Dni: " . $row["dni"] . "\n";
                        $lineData .= "- Nombre: " . $row["nombre"] . "\n";
                        $lineData .= "- Apellidos: " . $row["apellidos"] . "\n";
                        $lineData .= "- Email: " . $row["email"] . "\n";
                        $lineData .= "- Telefono: " . $row["telefono"] . "\n";
                        $lineData .= "Datos de la reserva: " . "\n";
                        $lineData .= "- Identificador: " . $row["idReserva"] . "\n";
                        $lineData .= "- Fecha de entrada: " . $row["fechaEntrada"] . "\n";
                        $lineData .= "- Fecha de salida: " . $row["fechaSalida"] . "\n";
                        $lineData .= "- Número de habitación: " . $row["nHabitacion"] . "\n";
                        fwrite($f, $lineData);
                    }

                    fclose($f);

                    echo "<p>El resguardo de la reserva seleccionada ha sido exportado correctamente</p>";
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

        public function buscarReserva(){
            $db = new mysqli($this->servername,$this->username,$this->password,$this->database);
            if($db->connect_error) {
                exit ("<p>ERROR de conexión:".$db->connect_error."</p>");  
            } 

            $consultaPre = $db->prepare("SELECT r.idReserva, c.dni, c.nombre, c.apellidos, c.email, c.telefono, r.fechaEntrada, r.fechaSalida,
                r.nHabitacion FROM Reserva r INNER JOIN Cliente c ON c.id=r.idCliente WHERE c.dni = ?");   
            if(!$consultaPre){
                print_r($db->error);
            }

            if(!$consultaPre->bind_param('s', $_POST["dniReservaBuscar"])){
                print_r($db->error);
            }    

            if(!$consultaPre->execute()){
                print_r($db->error);
            }

            $resultado = $consultaPre->get_result();
            if(!$resultado){
                print_r($db->error);
            }

            $counter = 0;
            if ($resultado->fetch_assoc()!=NULL) {
                $resultado->data_seek(0);
                $mostrar = "<p>Datos del cliente: </p>";
                while($row = $resultado->fetch_assoc()) {
                    if($counter == 0){
                        $mostrar .= "<p>- DNI: " . $row["dni"] . "</p>";
                        $mostrar .= "<p>- Nombre: " . $row["nombre"] . "</p>";
                        $mostrar .= "<p>- Apellidos: " . $row["apellidos"] . "</p>";
                        $mostrar .= "<p>- Email: " . $row["email"] . "</p>";
                        $mostrar .= "<p>- Telefono: " . $row["telefono"] . "</p>";
                        $mostrar .= "<p>Datos de la reserva: " . "</p>";
                        $mostrar .= "<p>- Identificador: " . $row["idReserva"] . "</p>";
                        $mostrar .= "<p>- Fecha de entrada: " . $row["fechaEntrada"] . "</p>";
                        $mostrar .= "<p>- Fecha de salida: " . $row["fechaSalida"] . "</p>";
                        $mostrar .= "<p>- Número de habitación: " . $row["nHabitacion"] . "</p>";
                    }else{
                        $mostrar .= "<p>Datos de la reserva: " . "</p>";
                        $mostrar .= "<p>- Identificador: " . $row["idReserva"] . "</p>";
                        $mostrar .= "<p>- Fecha de entrada: " . $row["fechaEntrada"] . "</p>";
                        $mostrar .= "<p>- Fecha de salida: " . $row["fechaSalida"] . "</p>";
                        $mostrar .= "<p>- Número de habitación: " . $row["nHabitacion"] . "</p>";
                    }
                    $counter += 1;
                }  
                if(isset($_SESSION["buscar"])){
                    $_SESSION["buscar"] = $mostrar;
                }else{
                    $_SESSION["buscar"] = $mostrar;
                }             
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

        public function eliminarReserva(){
            $db = new mysqli($this->servername,$this->username,$this->password,$this->database);
            if($db->connect_error) {
                exit ("<p>ERROR de conexión:".$db->connect_error."</p>");  
            }

            // chekear si el id y el dni son correctos: se encuentran en la base de datos y se corresponden entre ellos!!
            $correct = true;

            $consultaPre = $db->prepare("SELECT count(*) FROM Reserva r INNER JOIN Cliente c ON c.id = r.idCliente WHERE r.idReserva = ? and c.dni = ?");   
            if(!$consultaPre){
                print_r($db->error);
            }

            if(!$consultaPre->bind_param('is', $_POST["idReservaEliminar"], $_POST["dniReservaEliminar"])){
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

            $consultaPre = $db->prepare("SELECT r.idCliente FROM Reserva r INNER JOIN Cliente c ON c.id = r.idCliente WHERE r.idReserva = ? and c.dni = ?");   
            if(!$consultaPre){
                print_r($db->error);
            }

            if(!$consultaPre->bind_param('is', $_POST["idReservaEliminar"], $_POST["dniReservaEliminar"])){
                print_r($db->error);
            }    

            if(!$consultaPre->execute()){
                print_r($db->error);
            }

            $idCliente = $consultaPre->get_result()->fetch_row()[0];
            if(!$consultaPre->close()){
                print_r($db->error);
            }

            $consultaPre = $db->prepare("DELETE FROM Reserva WHERE idReserva = ?");   
            if(!$consultaPre){
                print_r($db->error);
            }

            if(!($consultaPre->bind_param('i', $_POST["idReservaEliminar"]))){
                print_r($db->error);
            }    

            if(!$consultaPre->execute()){
                print_r($db->error);
            }
        
            if(!$consultaPre->close()){
                print_r($db->error);
            }

            // por si vuelve a reservar el mismo cliente, que no haya PRIMARY KEYS duplicadas
            $consultaPre = $db->prepare("DELETE FROM Cliente WHERE id = ?");   

            if(!$consultaPre){
                print_r($db->error);
            }

            if(!$consultaPre->bind_param('i', $idCliente)){
                print_r($db->error);
            }    

            if(!$consultaPre->execute()){
                print_r($db->error);
            }else{
                echo "<p>La reserva seleccionada se ha eliminado correctamente</p>";
            }

            if(!$consultaPre->close()){
                print_r($db->error);
            }

            if(!$db->close()){
                print_r($db->error);
            }    
        }

        // public function cargarArchivo(){
        //     if($_FILES){
        //         $filename = $_FILES["archivo"]["name"];
        //         $info = new SplFileInfo($filename);
        //         $extension = pathinfo($info->getFilename(), PATHINFO_EXTENSION);

        //         if($extension == "csv"){
        //             try{
        //                 $handle = fopen($filename, "r");

        //                 $db = new mysqli($this->servername,$this->username,$this->password,$this->database);
        //                 if($db->connect_error) {
        //                     exit ("<p>ERROR de conexión:".$db->connect_error."</p>");  
        //                 }

        //                 while(($row = fgetcsv($handle, 1000, ";")) !== FALSE){
        //                     $consultaPre = $db->prepare("INSERT INTO Habitacion (nHabitacion, planta) VALUES (?,?)");   
        //                     if(!$consultaPre){
        //                         print_r($db->error);
        //                     }  

        //                     if(!($consultaPre->bind_param('is', 
        //                         $row[0], $row[1]))){
        //                         print_r($db->error);
        //                     }

        //                     if(!$consultaPre->execute()){
        //                         print_r($db->error);
        //                     }

        //                     if(!$consultaPre->close()){
        //                         print_r($db->error);
        //                     }
        //                 }

        //                 if(!$db->close()){
        //                     print_r($db->error);
        //                 }  

        //                 fclose($handle);
        //             }catch(Throwable $exc){
        //                 echo "<p>Error: " . $exc->getMessage() . "</p>";
        //             }
        //         }
        //     }    
        // }
    }
?>