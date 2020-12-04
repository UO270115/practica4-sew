<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"/>
    <meta name=viewport content="width=device-width, initial-scale=1" />
    <title>Calculadora RPN</title>
	<link rel="stylesheet" href="CalculadoraRPN.css"/>
</head>
<body>
    <h1>Calculadora RPN</h1>
    <div>
        <?php
            include_once("CalculadoraRPNCodigo.php");
            $calculadoraRPN = new CalculadoraRPN();
            $calculadoraRPN->init();
        ?>
    </div>  

    <div>
        <form action="#" method="post">
            <div id="stack"><?php echo $calculadoraRPN->mostrarPila();?></div>
            <label id="label" for="resultado">Calculadora RPN</label>
            <input type="text" id="resultado" name="resultado" value="<?php echo $calculadoraRPN->mostrar();?>" readOnly />
            <div>
                <div><input type="submit" class="button" name="botonExp" value="Exp" /></div>
                <div><input type="submit" class="button" name="botonMod" value="Mod" /></div>
                <div><input type="submit" class="button" name="botonSeno" value="sin" /></div>
                <div><input type="submit" class="button" name="botonCoseno" value="cos" /></div>
                <div><input type="submit" class="button" name="botonTangente" value="tan" /></div>

                <div><input type="submit" class="button" name="botonElevarAlCuadrado" value="x^2"  /></div>
                <div><input type="submit" class="button" name="botonElevar" value="x^y" /></div>
                <div><input type="submit" class="button" name="botonAsin" value="asin" /></div>
                <div><input type="submit" class="button" name="botonAcos" value="acos" /></div>
                <div><input type="submit" class="button" name="botonAtan" value="atan" /></div>

                <div><input type="submit" class="button" name="botonRaiz" value="√" /></div>
                <div><input type="submit" class="button" name="botonDiezElevar" value="10^x" /></div>
                <div><input type="submit" class="button" name="botonLog" value="log" /></div>
                <div><input type="submit" class="button" name="botonLn" value="ln" /></div>
                <div><input type="submit" class="button" name="botonDividir" value="/" /></div>

                <div><input type="submit" class="button" name="botonPi" value="π" /></div>
                <div><input type="submit" class="button" name="boton7" value="7" /></div>
                <div><input type="submit" class="button" name="boton8" value="8" /></div>    
                <div><input type="submit" class="button" name="boton9" value="9" /></div>
                <div><input type="submit" class="button" name="botonMultiplicar" value="*" /></div>

                <div><input type="submit" class="button" name="botonFactorial" value="n!" /></div>
                <div><input type="submit" class="button" name="boton4" value="4" /></div>
                <div><input type="submit" class="button" name="boton5" value="5" /></div>
                <div><input type="submit" class="button" name="boton6" value="6" /></div>
                <div><input type="submit" class="button" name="botonResta" value="-" /></div>

                <div><input type="submit" class="button" name="botonAbsoluto" value="|x|" /></div>
                <div><input type="submit" class="button" name="boton1" value="1" /></div>
                <div><input type="submit" class="button" name="boton2" value="2" /></div>
                <div><input type="submit" class="button" name="boton3" value="3" /></div>
                <div><input type="submit" class="button" name="botonSumar" value="+" /></div>
                
                <div><input type="submit" class="button" name="botonE" value="e" /></div>
                <div><input type="submit" class="button" name="boton0" value="0" /></div>
                <div><input type="submit" class="button" name="botonPunto" value="." /></div>   
                <div><input type="submit" class="button" name="botonC" value="C" /></div>
                <div><input type="submit" class="button" name="botonEnter" value="Enter" /></div>
            </div>
        </form>
    </div>    

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