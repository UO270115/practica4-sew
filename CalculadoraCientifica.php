<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"/>
    <meta name=viewport content="width=device-width, initial-scale=1" />
    <title>Calculadora científica</title>
	<link rel="stylesheet" href="CalculadoraCientifica.css"/>
</head>
<body>
    <h1>Calculadora básica</h1>  
    <div>
        <?php
            include_once("CalculadoraCientificaCodigo.php");
            $calculadoraCientifica = new CalculadoraCientifica();
            $calculadoraCientifica->init();
        ?>
    </div>  

    <div>
        <form action="#" method="post">
            <label id="label" for="resultado">Calculadora científica</label>
            <input type="text" id="resultado" name="resultado" value="<?php echo $calculadoraCientifica->mostrar();?>" readOnly />
            <div>
                <input type="submit" class="button" name="botonMrc" value="mrc" />
                <input type="submit" class="button" name="botonMmenos" value="m-" />
                <input type="submit" class="button" name="botonMmas" value="m+" />
                <input type="submit" class="button" name="botonExp" value="Exp" />
                <input type="submit" class="button" name="botonMod" value="Mod" />
            </div>
            <div>
                <input type="submit" class="button" name="botonElevarAlCuadrado" value="x^2" />
                <input type="submit" class="button" name="botonElevar" value="x^y" />
                <input type="submit" class="button" name="botonSeno" value="sin" />
                <input type="submit" class="button" name="botonCoseno" value="cos" />
                <input type="submit" class="button" name="botonTangente" value="tan" />
            </div>
            <div>
                <input type="submit" class="button" name="botonRaiz" value="√" />
                <input type="submit" class="button" name="botonDiezElevar" value="10^x" />
                <input type="submit" class="button" name="botonAsin" value="asin" />
                <input type="submit" class="button" name="botonAcos" value="acos" />
                <input type="submit" class="button" name="botonAtan" value="atan" />
            </div>
            <div>
                <input type="submit" class="button" name="botonE" value="e" />
                <input type="submit" class="button" name="botonLog" value="log" />
                <input type="submit" class="button" name="botonLn" value="ln" />
                <input type="submit" class="button" name="botonC" value="C" />
                <input type="submit" class="button" name="botonDividir" value="/" />
            </div>
            <div>
                <input type="submit" class="button" name="botonPi" value="π" />
                <input type="submit" class="button" name="boton7" value="7" />
                <input type="submit" class="button" name="boton8" value="8" />  
                <input type="submit" class="button" name="boton9" value="9" />
                <input type="submit" class="button" name="botonMultiplicar" value="*" />
            </div>
            <div>
                <input type="submit" class="button" name="botonFactorial" value="n!" />
                <input type="submit" class="button" name="boton4" value="4" />
                <input type="submit" class="button" name="boton5" value="5" />
                <input type="submit" class="button" name="boton6" value="6" />
                <input type="submit" class="button" name="botonResta" value="-" />
            </div>
            <div>
                <input type="submit" class="button" name="botonAbsoluto" value="|x|" />
                <input type="submit" class="button" name="boton1" value="1" />
                <input type="submit" class="button" name="boton2" value="2" />
                <input type="submit" class="button" name="boton3" value="3" />
                <input type="submit" class="button" name="botonSumar" value="+" />
            </div>
            <div>
                <input type="submit" class="button" name="botonAbrirParentesis" value="(" />
                <input type="submit" class="button" name="botonCerrarParentesis" value=")" />
                <input type="submit" class="button" name="boton0" value="0" />
                <input type="submit" class="button" name="botonPunto" value="." /> 
                <input type="submit" class="button" name="botonIgual" value="=" />
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