<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"/>
    <title>Calculadora científica</title>
	<link rel="stylesheet" href="CalculadoraCientifica.css"/>
</head>
<body>
    <h1>Calculadora básica</h1>  
    <section>
        <?php
            include_once("CalculadoraCientificaCodigo.php");
            $calculadoraCientifica = new CalculadoraCientifica();
            $calculadoraCientifica->init();
        ?>
    </section>  

    <section>
        <form action="" method="post">
            <label id="label" for="resultado">Calculadora científica</label>
            <input type="text" id="resultado" name="resultado" value="<?php echo $calculadoraCientifica->mostrar();?>" readOnly />
            <div>
                <div><input type="submit" class="button" name="botonMrc" value="mrc" /></div>
                <div><input type="submit" class="button" name="botonMmenos" value="m-" /></div>
                <div><input type="submit" class="button" name="botonMmas" value="m+" /></div>
                <div><input type="submit" class="button" name="botonExp" value="Exp" /></div>
                <div><input type="submit" class="button" name="botonMod" value="Mod" /></div>

                <div><input type="submit" class="button" name="botonElevarAlCuadrado" value="x^2"  /></div>
                <div><input type="submit" class="button" name="botonElevar" value="x^y" /></div>
                <div><input type="submit" class="button" name="botonSeno" value="sin" /></div>
                <div><input type="submit" class="button" name="botonCoseno" value="cos" /></div>
                <div><input type="submit" class="button" name="botonTangente" value="tan" /></div>

                <div><input type="submit" class="button" name="botonRaiz" value="√" /></div>
                <div><input type="submit" class="button" name="botonDiezElevar" value="10^x" /></div>
                <div><input type="submit" class="button" name="botonAsin" value="asin" /></div>
                <div><input type="submit" class="button" name="botonAcos" value="acos" /></div>
                <div><input type="submit" class="button" name="botonAtan" value="atan" /></div>

                <div><input type="submit" class="button" name="botonE" value="e" /></div>
                <div><input type="submit" class="button" name="botonLog" value="log" /></div>
                <div><input type="submit" class="button" name="botonLn" value="ln" /></div>
                <div><input type="submit" class="button" name="botonC" value="C" /></div>
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

                <div><input type="submit" class="button" name="botonAbrirParentesis" value="(" /></div>
                <div><input type="submit" class="button" name="botonCerrarParentesis" value=")" /></div>
                <div><input type="submit" class="button" name="boton0" value="0" /></div>
                <div><input type="submit" class="button" name="botonPunto" value="." /></div>   
                <div><input type="submit" class="button" name="botonIgual" value="=" /></div>
            </div>
        </form>
    </section>    

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