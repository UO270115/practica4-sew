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
                catch(Exception $exc) {
                    $_SESSION["mostrar"] = "Error: " . $exc->getMessage();
                }
            }else{
                $mostrar = floatval($_SESSION["mostrar"]);
                try {
                    $_SESSION["memoria"] = eval("return - $mostrar;");
                }
                catch(Exception $exc) {
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
                catch(Exception $exc) {
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
                    catch(Exception $exc) {
                        $_SESSION["mostrar"] = "Error: " . $exc->getMessage();
                    }
                }
            } 
        }
        
    }
    class CalculadoraCientifica extends CalculadoraBasica{

        public function __construct(){
            parent::__construct();
        }

        public function init(){
            parent::init();
            if (count($_POST)>0) { 
                if(isset($_POST["botonExp"])){
                    $this->exponencial();
                } 
                if(isset($_POST["botonMod"])){
                    $this->modulo();
                } 
                if(isset($_POST["botonElevarAlCuadrado"])){
                    $this->elevarAlCuadrado();
                } 
                if(isset($_POST["botonElevar"])){
                    $this->elevar();
                } 
                if(isset($_POST["botonSeno"])){
                    $this->seno();
                } 
                if(isset($_POST["botonCoseno"])){
                    $this->coseno();
                } 
                if(isset($_POST["botonTangente"])){
                    $this->tangente();
                } 
                if(isset($_POST["botonRaiz"])){
                    $this->raiz();
                } 
                if(isset($_POST["botonDiezElevar"])){
                    $this->diezElevar();
                } 
                if(isset($_POST["botonAsin"])){
                    $this->aseno();
                } 
                if(isset($_POST["botonAcos"])){
                    $this->acoseno();
                }
                if(isset($_POST["botonAtan"])){
                    $this->atangente();
                }
                if(isset($_POST["botonE"])){
                    $this->e();
                }
                if(isset($_POST["botonLog"])){
                    $this->logaritmo();
                }
                if(isset($_POST["botonLn"])){
                    $this->neperiano();
                }
                if(isset($_POST["botonPi"])){
                    $this->pi();
                }
                if(isset($_POST["botonFactorial"])){
                    $this->factorial();
                }
                if(isset($_POST["botonAbsoluto"])){
                    $this->valorAbsoluto();
                }
                if(isset($_POST["botonAbrirParentesis"])){
                    $this->abrirParentesis();
                }
                if(isset($_POST["botonCerrarParentesis"])){
                    $this->cerrarParentesis();
                }
            }
        }
    
        public function exponencial(){
            if(isset($_SESSION["exp"])){
                $_SESSION["exp"] = 1; // 1 -> true
            }else{
                $_SESSION["exp"] = 1;
            }

            if(isset($_SESSION["resultado"])){
                $_SESSION["resultado"] .= "exp(";
            }else{
                $_SESSION["resultado"] = "exp(";
            }

            if(isset($_SESSION["mostrar"])){
                $_SESSION["mostrar"] .= "e^";
            }else{
                $_SESSION["mostrar"] = "e^";
            }
        }
    
        public function check(){
            if(isset($_SESSION["exp"])){
                if($_SESSION["exp"] == 1){
                    $this->aux();
                    $_SESSION["exp"] = 0; // 0 -> false;
                }
            } if(isset($_SESSION["elevarY"])){
                if($_SESSION["elevarY"] == 1){
                    $this->aux();
                    $_SESSION["elevarY"] = 0;
                }
            }          
        }

        private function aux(){
            if(isset($_SESSION["resultado"])){
                $_SESSION["resultado"] .= ")";
            }else{
                $_SESSION["resultado"] .= ")";
            }

            if(isset($_SESSION["mostrar"])){
                $_SESSION["mostrar"] .= ")";
            }else{
                $_SESSION["mostrar"] .= ")";
            }
        }
    
        public function borrar(){
            $this->check();
            parent::borrar();
        }
    
        public function multiplicacion(){
            $this->check();
            parent::multiplicacion();
        }
    
        public function resta(){
            $this->check();
            parent::resta();
        }
    
        public function suma(){
            $this->check();
            parent::suma();
        }
    
        public function division(){
            $this->check();
            parent::division();
        }
    
        public function modulo(){
            $this->check();
            if(isset($_SESSION["resultado"])){
                $_SESSION["resultado"] .= "%";
            }else{
                $_SESSION["resultado"] = "%";
            }

            if(isset($_SESSION["mostrar"])){
                $_SESSION["mostrar"] .= "%";
            }else{
                $_SESSION["mostrar"] = "%";
            }
        }
    
        public function elevarAlCuadrado(){
            $this->parsear();
            if(isset($_SESSION["p"])){
                if($_SESSION["p"] > -1){
                    if(isset($_SESSION["resultado"]) & isset($_SESSION["mostrar"])){
                        $_SESSION["resultado"] .= "pow(" . $_SESSION["p"]  . ",2)";
                        $_SESSION["mostrar"] .= $_SESSION['p'] . "^2";
                    }
                }else{
                    if(isset($_SESSION["mostrar"])){
                        $_SESSION["mostrar"] = "Error";
                    }else{
                        $_SESSION["mostrar"] = "Error";
                    }
                }
                $_SESSION["p"] = -1;
            }else{
                $_SESSION["p"] = -1;
            }
        }
    
        public function parsear(){
            $counter = 0;
            if(isset($_SESSION["resultado"])){
                $counter = strlen($_SESSION["resultado"])-1;
            }
            while($counter >= 0){
                if(isset($_SESSION["pa"]) & isset($_SESSION["pc"])){
                    if($_SESSION["pa"] == 1 & $_SESSION["pc"] == 1){
                        if(isset($_SESSION["resultado"])){
                            if(substr($_SESSION["resultado"], $counter) == "("){
                                break;
                            }
                        }
                        if($counter > 0){
                            $counter--;
                        }else{
                            break;
                        }
                    }
                }else if(isset($_SESSION["pa"]) & isset($_SESSION["pc"])){
                    if(($_SESSION["pa"] == 1 & $_SESSION["pc"] == 0) | ($_SESSION["pa"] == 0 & $_SESSION["pc"] == 1)){
                        if(isset($_SESSION["resultado"])){
                            $_SESSION["resultado"] = "Error: los paréntesis no están colocados correctamente";
                        }
                    }
                }else{
                    if(isset($_SESSION["resultado"])){
                        if(!is_nan(floatval(substr($_SESSION["resultado"], 0, $counter)))){
                            if($counter >= 0){
                                $counter--;
                            }
                        }
                    }else{
                        break;
                    }
                }
            }
            if(isset($_SESSION["pa"]) & isset($_SESSION["pc"])){
                if($_SESSION["pa"] == 1 & $_SESSION["pc"] == 1){
                    $this->p($counter);
                }
            }else{
                if(isset($_SESSION["resultado"])){
                    if($counter == strlen($_SESSION["resultado"])-1){
                        if(isset($_SESSION["p"])){
                            $_SESSION["p"] = $_SESSION["resultado"];
                        }else{
                            $_SESSION["p"] = $_SESSION["resultado"];
                        } 
                        $_SESSION["resultado"] = substr($_SESSION["resultado"], 0, $counter);
                    }else{
                        if(isset($_SESSION["p"])){
                            $_SESSION["p"] = substr($_SESSION["resultado"], $counter+1);
                        }else{
                            $_SESSION["p"] = substr($_SESSION["resultado"], $counter+1);
                        }
                        $_SESSION["resultado"] = substr($_SESSION["resultado"], 0, $counter+1);
                    }
                }
            }
            if(isset($_SESSION["resultado"])){
                if(isset($_SESSION["mostrar"])){
                    $_SESSION["mostrar"] = $_SESSION["resultado"];
                }else{
                    $_SESSION["mostrar"] = $_SESSION["resultado"];
                }
            }
        }

        public function p($counter){
            if(isset($_SESSION["p"])){
                $this->r($counter);
            }else{
                $this->r($counter);
            } 
        }

        public function r($counter){
            if(isset($_SESSION["resultado"])){
                $result = substr($_SESSION["resultado"], $counter);
                $_SESSION["p"] = eval("return $result;");
                $_SESSION["resultado"] = substr($_SESSION["resultado"], 0, $counter);
                if(isset($_SESSION["pa"]) & isset($_SESSION["pc"])){
                    $_SESSION["pa"] == 0;
                    $_SESSION["pc"] == 0;
                }
            }
        }
    
        public function elevar(){
            $this->parsear();
            if(isset($_SESSION["p"])){
                if($_SESSION["p"] > -1){
                    if(isset($_SESSION["elevarY"])){
                        $_SESSION["elevarY"] = 1;
                    } else{
                        $_SESSION["elevarY"] = 1;
                    }
                    if(isset($_SESSION["resultado"]) & isset($_SESSION["mostrar"])){
                        $_SESSION["resultado"] .= "pow(" . $_SESSION["p"];
                        $_SESSION["mostrar"] .= $_SESSION['p'] . "^";
                    }
                }else{
                    if(isset($_SESSION["mostrar"])){
                        $_SESSION["mostrar"] = "Error";
                    }else{
                        $_SESSION["mostrar"] = "Error";
                    }
                }
            }
        }
    
        public function digitos($digito){
            if(isset($_SESSION["elevarY"])){
                if($_SESSION["elevarY"] == 1){
                    if(isset($_SESSION["resultado"]) & isset($_SESSION["mostrar"])){
                        $_SESSION["resultado"] .= ",";
                    }
                }
            } 
            parent::digitos($digito);
        }
    
        public function seno(){
            $this->parsear();
            if(isset($_SESSION["p"])){
                if($_SESSION["p"] > -1){
                    if(isset($_SESSION["resultado"]) & isset($_SESSION["mostrar"])){
                        $_SESSION["resultado"] .= "sin(((" . $_SESSION["p"] . " * pi()) / 180))";
                        $_SESSION["mostrar"] .= "sin(" . $_SESSION['p'] . ")";
                    }
                }else{
                    if(isset($_SESSION["mostrar"])){
                        $_SESSION["mostrar"] = "Error";
                    }else{
                        $_SESSION["mostrar"] = "Error";
                    }
                }
                $_SESSION["p"] = -1;
            }else{
                $_SESSION["p"] = -1;
            }
        }
    
        public function aseno(){
            $this->parsear();
            if(isset($_SESSION["p"])){
                if($_SESSION["p"] > -1){
                    if(isset($_SESSION["resultado"]) & isset($_SESSION["mostrar"])){
                        $_SESSION["resultado"] .= "asin(((" . $_SESSION["p"] . " * pi()) / 180))";
                        $_SESSION["mostrar"] .= "asin(" . $_SESSION['p'] . ")";
                    }
                }else{
                    if(isset($_SESSION["mostrar"])){
                        $_SESSION["mostrar"] = "Error";
                    }else{
                        $_SESSION["mostrar"] = "Error";
                    }
                }
                $_SESSION["p"] = -1;
            }else{
                $_SESSION["p"] = -1;
            }
        }
    
        public function coseno(){
            $this->parsear();
            if(isset($_SESSION["p"])){
                if($_SESSION["p"] > -1){
                    if(isset($_SESSION["resultado"]) & isset($_SESSION["mostrar"])){
                        $_SESSION["resultado"] .= "cos(((" . $_SESSION["p"] . " * pi()) / 180))";
                        $_SESSION["mostrar"] .= "cos(" . $_SESSION['p'] . ")";
                    } 
                }else{
                    if(isset($_SESSION["mostrar"])){
                        $_SESSION["mostrar"] = "Error";
                    }else{
                        $_SESSION["mostrar"] = "Error";
                    }
                }
                $_SESSION["p"] = -1;
            }else{
                $_SESSION["p"] = -1;
            }
        }
    
        public function acoseno(){
            $this->parsear();
            if(isset($_SESSION["p"])){
                if($_SESSION["p"] > -1){
                    if(isset($_SESSION["resultado"]) & isset($_SESSION["mostrar"])){
                        $_SESSION["resultado"] .= "acos(((" . $_SESSION["p"] . " * pi()) / 180))";
                        $_SESSION["mostrar"] .= "acos(" . $_SESSION['p'] . ")";
                    }
                }else{
                    if(isset($_SESSION["mostrar"])){
                        $_SESSION["mostrar"] = "Error";
                    }else{
                        $_SESSION["mostrar"] = "Error";
                    }
                }
                $_SESSION["p"] = -1;
            }else{
                $_SESSION["p"] = -1;
            }
        }
    
        public function tangente(){
            $this->parsear();
            if(isset($_SESSION["p"])){
                if($_SESSION["p"] > -1){
                    if(isset($_SESSION["resultado"]) & isset($_SESSION["mostrar"])){
                        $_SESSION["resultado"] .= "tan(((" . $_SESSION["p"] . " * pi()) / 180))";
                        $_SESSION["mostrar"] .= "tan(" . $_SESSION['p'] . ")";
                    }
                }else{
                    if(isset($_SESSION["mostrar"])){
                        $_SESSION["mostrar"] = "Error";
                    }else{
                        $_SESSION["mostrar"] = "Error";
                    }
                }
                $_SESSION["p"] = -1;
            }else{
                $_SESSION["p"] = -1;
            }
        }
    
        public function atangente(){
            $this->parsear();
            if(isset($_SESSION["p"])){
                if($_SESSION["p"] > -1){
                    if(isset($_SESSION["resultado"]) & isset($_SESSION["mostrar"])){
                        $_SESSION["resultado"] .= "atan(((" . $_SESSION["p"] . " * pi()) / 180))";
                        $_SESSION["mostrar"] .= "atan(" . $_SESSION['p'] . ")";
                    }
                }else{
                    if(isset($_SESSION["mostrar"])){
                        $_SESSION["mostrar"] = "Error";
                    }else{
                        $_SESSION["mostrar"] = "Error";
                    }
                }
                $_SESSION["p"] = -1;
            }else{
                $_SESSION["p"] = -1;
            }
        }
    
        public function logaritmo(){
            $this->parsear();
            if(isset($_SESSION["p"])){
                if($_SESSION["p"] > -1){
                    if(isset($_SESSION["resultado"]) & isset($_SESSION["mostrar"])){
                        $_SESSION["resultado"] .= "log10(" . $_SESSION["p"] . ")";
                        $_SESSION["mostrar"] .= "log(" . $_SESSION['p'] . ")";
                    }
                }else{
                    if(isset($_SESSION["mostrar"])){
                        $_SESSION["mostrar"] = "Error";
                    }else{
                        $_SESSION["mostrar"] = "Error";
                    }
                }
                $_SESSION["p"] = -1;
            }else{
                $_SESSION["p"] = -1;
            }
        }
    
        public function neperiano(){
            $this->parsear();
            if(isset($_SESSION["p"])){
                if($_SESSION["p"] > -1){
                    if(isset($_SESSION["resultado"]) & isset($_SESSION["mostrar"])){
                        $_SESSION["resultado"] .= "log(" . $_SESSION["p"] . ")";
                        $_SESSION["mostrar"] .= "ln(" . $_SESSION['p'] . ")";
                    }
                }else{
                    if(isset($_SESSION["mostrar"])){
                        $_SESSION["mostrar"] = "Error";
                    }else{
                        $_SESSION["mostrar"] = "Error";
                    }
                }
                $_SESSION["p"] = -1;
            }else{
                $_SESSION["p"] = -1;
            }
        }
    
        public function diezElevar(){
            $this->parsear();
            if(isset($_SESSION["p"])){
                if($_SESSION["p"] > -1){
                    if(isset($_SESSION["resultado"]) & isset($_SESSION["mostrar"])){
                        $_SESSION["resultado"] .= "pow(10," . $_SESSION["p"] . ")";
                        $_SESSION["mostrar"] .= "10^" . $_SESSION['p'];
                    }
                }else{
                    if(isset($_SESSION["mostrar"])){
                        $_SESSION["mostrar"] = "Error";
                    }else{
                        $_SESSION["mostrar"] = "Error";
                    }
                }
                $_SESSION["p"] = -1;
            }else{
                $_SESSION["p"] = -1;
            }
        }
    
        public function raiz(){
            $this->parsear();
            if(isset($_SESSION["p"])){
                if($_SESSION["p"] > -1){
                    if(isset($_SESSION["resultado"]) & isset($_SESSION["mostrar"])){
                        $_SESSION["resultado"] .= "sqrt(" . $_SESSION["p"] . ")";
                        $_SESSION["mostrar"] .= "√" . $_SESSION['p'];
                    }
                }else{
                    if(isset($_SESSION["mostrar"])){
                        $_SESSION["mostrar"] = "Error";
                    }else{
                        $_SESSION["mostrar"] = "Error";
                    }
                }
                $_SESSION["p"] = -1;
            }else{
                $_SESSION["p"] = -1;
            }
        }
    
        public function pi(){
            parent::digitos(pi());
        }
    
        public function e(){
            parent::digitos(exp(1));
        }
    
        public function factorial(){
            $this->parsear();
            if(isset($_SESSION["p"])){
                if($_SESSION["p"] > -1){
                    $this->fact($_SESSION["p"]);
                    if(isset($_SESSION["resultado"]) & isset($_SESSION["mostrar"]) & isset($_SESSION["f"])){
                        $_SESSION["resultado"] .= $_SESSION["f"];
                        $_SESSION["mostrar"] .= $_SESSION["f"];
                        $_SESSION["f"] = 1;
                    }
                }else{
                    if(isset($_SESSION["mostrar"])){
                        $_SESSION["mostrar"] = "Error";
                    }else{
                        $_SESSION["mostrar"] = "Error";
                    }
                }
                $_SESSION["p"] = -1;
            }else{
                $_SESSION["p"] = -1;
            }
        }
    
        public function fact($numero){
            $i = 1;
            if(isset($_SESSION["f"])){
                $_SESSION["f"] = 1;
            }else{
                $_SESSION["f"] = 1;
            }
            while($i <= $numero){
                if(isset($_SESSION["f"])){
                    $_SESSION["f"] *= $i;
                    $i++;
                }
            }
        }
    
        public function valorAbsoluto(){
            if(isset($_SESSION["resultado"]) & isset($_SESSION["mostrar"])){
                $_SESSION["resultado"] = "abs(" . $_SESSION["resultado"] . ")";
                $_SESSION["mostrar"] = "abs(" . $_SESSION["mostrar"] . ")";
            }
        }
    
        public function abrirParentesis(){
            if(isset($_SESSION["pa"])){
                $_SESSION["pa"] = 1;
            }else{
                $_SESSION["pa"] = 1;
            }
            if(isset($_SESSION["resultado"]) & isset($_SESSION["mostrar"])){
                $_SESSION["resultado"] .= "(";
                $_SESSION["mostrar"] .= "(";
            }else{
                $_SESSION["resultado"] = "(";
                $_SESSION["mostrar"] = "(";
            }
        }
    
        public function cerrarParentesis(){
            if(isset($_SESSION["pc"])){
                $_SESSION["pc"] = 1;
            }else{
                $_SESSION["pc"] = 1;
            }
            if(isset($_SESSION["resultado"]) & isset($_SESSION["mostrar"])){
                $_SESSION["resultado"] .= ")";
                $_SESSION["mostrar"] .= ")";
            }else{
                $_SESSION["resultado"] = ")";
                $_SESSION["mostrar"] = ")";
            }
        }
    
        public function igual(){
            if(isset($_SESSION["resultado"]) & isset($_SESSION["mostrar"])){
                try {
                    if(isset($_SESSION["exp"])){
                        if($_SESSION["exp"] == 1){
                            $_SESSION["resultado"] .= ")";
                            $_SESSION["mostrar"] .= ")";
                        }
                        $_SESSION["exp"] = 0;
                    }else if(isset($_SESSION["elevarY"])){
                        if($_SESSION["elevarY"] == 1){
                            $_SESSION["resultado"] .= ")";
                            $_SESSION["mostrar"] .= ")";
                        }
                        $_SESSION["elevarY"] = 0;
                    }else if(isset($_SESSION["pa"]) & isset($_SESSION["pc"])){
                        if($_SESSION["pa"] == 1 & $_SESSION["pc"] == 0){
                            $_SESSION["resultado"] .= ")";
                            $_SESSION["mostrar"] .= ")";
                        }
                        $_SESSION["pa"] = 0;
                        $_SESSION["pc"] = 0;
                    }
                    $result = $_SESSION["resultado"];
                    $_SESSION["mostrar"] = eval("return $result;");
                    $_SESSION["resultado"] = $_SESSION["mostrar"];
                }
                catch(Exception $exc) {
                    $_SESSION["mostrar"] = "Error: " . $exc->getMessage();
                }
            }
            if(isset($_SESSION["exp"])){
                $_SESSION["exp"] = 0;
            }
            if(isset($_SESSION["elevarY"])){
                $_SESSION["elevarY"] = 0;
            }
            if(isset($_SESSION["pa"])){
                $_SESSION["pa"] = 0;
            }
            if(isset($_SESSION["pc"])){
                $_SESSION["pc"] = 0;
            }
        }
    }
?>