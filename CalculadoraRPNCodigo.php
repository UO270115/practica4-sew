<?php
    class Pila {

        public function __construct(){
            if(isset($_SESSION["pila"])){
                // nothing
            }else{
                $_SESSION["pila"] = array();
            }
        }
    
        public function push($elemento) {
            if(isset($_SESSION["pila"])){
                array_push($_SESSION["pila"], $elemento);
            }
        }
    
        public function pop() {  
            if(isset($_SESSION["pila"])){
                return array_pop($_SESSION["pila"]);
            }
        }
        
        public function length(){
            if(isset($_SESSION["pila"])){
                return count($_SESSION["pila"]);
            }   
        }

        public function reset(){
            if(isset($_SESSION["pila"])){
                reset($_SESSION["pila"]);
            } 
        }
                
        public function show(){
            $stringPila = "";
            $length = $this->length();
            if($length > 0){
                for ($i = $length - 1; $i >= 0; $i--){ 
                    if(isset($_SESSION["pila"])){
                        $stringPila .= "<p>" . $i . ": " .  $_SESSION["pila"][$i] . "</p>";
                    } 
                } 
            }
            if(isset($_SESSION["stack"])){
                $_SESSION["stack"] = $stringPila;
            }else{
                $_SESSION["stack"] = $stringPila;
            }
        } 
    }
    class CalculadoraRPN{

        protected $pila;

        public function __construct(){
            session_start();
            $this->pila = new Pila();
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
                if(isset($_POST["botonEnter"])){
                    $this->enter();
                }
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
            }
        }

        public function mostrar(){
            if(isset($_SESSION["mostrar"])){
                return $_SESSION["mostrar"];
            }
        }

        public function mostrarPila(){
            if(isset($_SESSION["stack"])){
                return $_SESSION["stack"];
            }
        }
    
        public function division(){
            $pila = $this->pila;
            $digit1 = $pila->pop();
            $digit2 = $pila->pop();
            $result = $digit1 / $digit2;
            $pila->push($result);
            $pila->show();
        }
    
        public function digitos($digito){
            if(isset($_SESSION["mostrar"])){
                $_SESSION["mostrar"] .= $digito;
            }else{
                $_SESSION["mostrar"] = $digito;
            }
        }
    
        public function multiplicacion(){
            $pila = $this->pila;
            $digit1 = $pila->pop();
            $digit2 = $pila->pop();
            $result = $digit1 * $digit2;
            $pila->push($result);
            $pila->show();
        }
    
        public function resta(){
            $pila = $this->pila;
            $digit1 = $pila->pop();
            $digit2 = $pila->pop();
            $result = $digit1 - $digit2;
            $pila->push($result);
            $pila->show();
        }
    
        public function suma(){
            $pila = $this->pila;
            $digit1 = $pila->pop();
            $digit2 = $pila->pop();
            $result = $digit1 + $digit2;
            $pila->push($result);
            $pila->show();
        }
    
        public function punto(){
            if(isset($_SESSION["mostrar"])){
                $_SESSION["mostrar"] .= ".";
            }else{
                $_SESSION["mostrar"] = ".";
            }
        }
    
        public function borrar(){
            if(isset($_SESSION["mostrar"])){
                $_SESSION["mostrar"] = "";
            }else{
                $_SESSION["mostrar"] = "";
            }
            $pila = $this->pila;
            $pila->reset();
            $pila->show();
        }
    
        public function exponencial(){
            $pila = $this->pila;
            $digit1 = $pila->pop();
            $result = exp($digit1);
            $pila->push($result);
            $pila->show();
        }
    
        public function enter(){
            $pila = $this->pila;
            if(isset($_SESSION["mostrar"])){
                $pila->push(floatval($_SESSION["mostrar"]));
                $_SESSION["mostrar"] = "";
            }
            $pila->show();
        }
    
        public function modulo(){
            $pila = $this->pila;
            $digit1 = $pila->pop();
            $digit2 = $pila->pop();
            $result = $digit1 % $digit2;
            $pila->push($result);
            $pila->show();
        }
    
        public function elevarAlCuadrado(){
            $pila = $this->pila;
            $digit1 = $pila->pop();
            $result = pow($digit1,2);
            $pila->push($result);
            $pila->show();
        }
    
        public function elevar(){
            $pila = $this->pila;
            $digit1 = $pila->pop();
            $digit2 = $pila->pop();
            $result = pow($digit1,$digit2);
            $pila->push($result);
            $pila->show();
        }
    
        public function seno(){
            $pila = $this->pila;
            $digit1 = $pila->pop();
            $result = sin($digit1);
            $pila->push($result);
            $pila->show();
        }
    
        public function coseno(){
            $pila = $this->pila;
            $digit1 = $pila->pop();
            $result = cos($digit1);
            $pila->push($result);
            $pila->show();
        }
    
        public function tangente(){
            $pila = $this->pila;
            $digit1 = $pila->pop();
            $result = tan($digit1);
            $pila->push($result);
            $pila->show();
        }
    
        public function logaritmo(){
            $pila = $this->pila;
            $digit1 = $pila->pop();
            $result = log10($digit1);
            $pila->push($result);
            $pila->show();
        }
    
        public function diezElevar(){
            $pila = $this->pila;
            $digit1 = $pila->pop();
            $result = pow(10,$digit1);
            $pila->push($result);
            $pila->show();
        }
    
        public function raiz(){
            $pila = $this->pila;
            $digit1 = $pila->pop();
            $result = sqrt($digit1);
            $pila->push($result);
            $pila->show();
        }
    
        public function pi(){
            $this->digitos(pi());
        }
    
        public function e(){
            $this->digitos(exp(1));
        }
    
        public function factorial(){
            $pila = $this->pila;
            $digit1 = $pila->pop();
            $result = $this->fact($digit1);
            $pila->push($result);
            $pila->show();
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
            $pila = $this->pila;
            $digit1 = $pila->pop();
            $result = abs($digit1);
            $pila->push($result);
            $pila->show();
        }
    
        public function aseno(){
            $pila = $this->pila;
            $digit1 = $pila->pop();
            $result = sinh($digit1);
            $pila->push($result);
            $pila->show();
        }
    
        public function acoseno(){
            $pila = $this->pila;
            $digit1 = $pila->pop();
            $result = cosh($digit1);
            $pila->push($result);
            $pila->show();
        }
    
        public function atangente(){
            $pila = $this->pila;
            $digit1 = $pila->pop();
            $result = tanh($digit1);
            $pila->push($result);
            $pila->show();
        }
    
        public function ln(){
            $pila = $this->pila;
            $digit1 = $pila->pop();
            $result = log($digit1);
            $pila->push($result);
            $pila->show();
        }
    }

?>