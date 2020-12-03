<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"/>
    <title>Ejercicio4</title>
	<link rel="stylesheet" href="Ejercicio4.css"/>
</head>
<body>
    <h1>DigitalCOVIDNews</h1>
    <div>
        <?php
            include_once("Ejercicio4Codigo.php");
            $news = new News();
        ?>
    </div>

    <div>
        <form action="#" method="post">
            <div id="noticias"><?php echo $news->mostrar();?></div>
        </form> 
    </div>

    <a href="https://validator.w3.org/check?uri=referer">
        <img src="HTML5.png" alt=" HTML5 Válido!" /></a>
    
    <a href=" http://jigsaw.w3.org/css-validator/check/referer">
        <img src="CSS3.png" alt="CSS Válido!" height="63" width="64"/></a>
</body>
</html>