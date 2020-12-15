<?php
    class CalculadoraBasica{

        public function __construct(){
            session_start();
        }
    
        public function init(){
            if (count($_POST)>0) { 
                if(isset($_POST["boton0"])){
                    $this->digitos(0);
                } 
                if(isset($_POST["boton1"])){
                    $this->digitos(1);
                } 
                if(isset($_POST["boton2"])){
                    $this->digitos(2);
                } 
                if(isset($_POST["boton3"])){
                    $this->digitos(3);
                } 
                if(isset($_POST["boton4"])){
                    $this->digitos(4);
                } 
                if(isset($_POST["boton5"])){
                    $this->digitos(5);
                } 
                if(isset($_POST["boton6"])){
                    $this->digitos(6);
                } 
                if(isset($_POST["boton7"])){
                    $this->digitos(7);
                } 
                if(isset($_POST["boton8"])){
                    $this->digitos(8);
                } 
                if(isset($_POST["boton9"])){
                    $this->digitos(9);
                }
                if(isset($_POST["botonMrc"])){
                    $this->mrc();
                }
                if(isset($_POST["botonMmenos"])){
                    $this->mMenos();
                }
                if(isset($_POST["botonMmas"])){
                    $this->mMas(9);
                }
                if(isset($_POST["botonDividir"])){
                    $this->division();
                }
                if(isset($_POST["botonMultiplicar"])){
                    $this->multiplicacion();
                }
                if(isset($_POST["botonResta"])){
                    $this->resta();
                }
                if(isset($_POST["botonSumar"])){
                    $this->suma();
                }
                if(isset($_POST["botonPunto"])){
                    $this->punto();
                }
                if(isset($_POST["botonC"])){
                    $this->borrar();
                }
                if(isset($_POST["botonIgual"])){
                    $this->igual();
                }
            }
        }

        public function digitos($digito){
            if(isset($_SESSION["mostrar"])){
                $_SESSION["mostrar"] .= strval($digito);
            }else{
                $_SESSION["mostrar"] = strval($digito);
            }

            if(isset($_SESSION["resultado"])){
                $_SESSION["resultado"] .= strval($digito);
            }else{
                $_SESSION["resultado"] = strval($digito);
            }
        }

        public function mostrar(){
            if(isset($_SESSION["mostrar"])){
                return $_SESSION["mostrar"];
            }
        }

        public function mrc(){
            if(isset($_SESSION["memoria"])){
                if(isset($_SESSION["mostrar"])){
                    $_SESSION["mostrar"] = $_SESSION["memoria"];
                }
                
                if(isset($_SESSION["resultado"])){
                    $_SESSION["resultado"] = $_SESSION["memoria"];
                }
            }
        }

        public function mMenos(){
            if(isset($_SESSION["memoria"])){
                $memoria = floatval($_SESSION["memoria"]);
                $mostrar = floatval($_SESSION["mostrar"]);
                try {
                    $_SESSION["memoria"] = eval("return $memoria - $mostrar;");
                }
                catch(Throwable $exc) {
                    $_SESSION["mostrar"] = "Error: " . $exc->getMessage();
                }
            }else{
                $mostrar = floatval($_SESSION["mostrar"]);
                try {
                    $_SESSION["memoria"] = eval("return - $mostrar;");
                }
                catch(Throwable $exc) {
                    $_SESSION["mostrar"] = "Error: " . $exc->getMessage();
                }
            }
        }

        public function mMas(){
            if(isset($_SESSION["memoria"])){
                $memoria = floatval($_SESSION["memoria"]);
                $mostrar = floatval($_SESSION["mostrar"]);
                try {
                    $_SESSION["memoria"] = eval("return $memoria + $mostrar;");
                }
                catch(Throwable $exc) {
                    $_SESSION["mostrar"] = "Error: " . $exc->getMessage();
                }
            }else{
                $_SESSION["memoria"] = ($_SESSION["mostrar"]);
            }
        }

        public function division(){
            if(isset($_SESSION["mostrar"])){
                $_SESSION["mostrar"] .= "/";
            }
            
            if(isset($_SESSION["resultado"])){
                $_SESSION["resultado"] .= "/";
            }
        }

        public function multiplicacion(){
            if(isset($_SESSION["mostrar"])){
                $_SESSION["mostrar"] .= "*";
            }
            
            if(isset($_SESSION["resultado"])){
                $_SESSION["resultado"] .= "*";
            }
        }

        public function resta(){
            if(isset($_SESSION["mostrar"])){
                $_SESSION["mostrar"] .= "-";
            }
            
            if(isset($_SESSION["resultado"])){
                $_SESSION["resultado"] .= "-";
            }
        }

        public function suma(){
            if(isset($_SESSION["mostrar"])){
                $_SESSION["mostrar"] .= "+";
            }
            
            if(isset($_SESSION["resultado"])){
                $_SESSION["resultado"] .= "+";
            }
        }

        public function punto(){
            if(isset($_SESSION["mostrar"])){
                $_SESSION["mostrar"] .= ".";
            }
            
            if(isset($_SESSION["resultado"])){
                $_SESSION["resultado"] .= ".";
            }
        }

        public function borrar(){
            if(isset($_SESSION["mostrar"])){
                $_SESSION["mostrar"] = "";
            }
            
            if(isset($_SESSION["resultado"])){
                $_SESSION["resultado"] = "";
            }
        }

        public function igual(){
            if(isset($_SESSION["resultado"])){
                if(isset($_SESSION["mostrar"])){
                    try {
                        $result = $_SESSION["resultado"];
                        $_SESSION["mostrar"] = eval("return $result;");
                        $_SESSION["resultado"] = $_SESSION["mostrar"];
                    }
                    catch(Throwable $exc) {
                        $_SESSION["mostrar"] = "Error: " . $exc->getMessage();
                    }
                }
            } 
        }
        
    }
?>