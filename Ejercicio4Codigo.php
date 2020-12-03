<?php
    class News{

        public function __construct(){

            $fechaHoy = date_create(); // DateTime
            $fechaHoy->sub(new DateInterval('P7D'));
            setlocale(LC_TIME, "es-ES");
            $fechaHaceUnaSemana = strftime("%V,%G,%Y", date_timestamp_get($fechaHoy));
    
            $url = "https://gnews.io/api/v4/search?everything?&q=COVID&lang=es&country=es&from=" . $fechaHaceUnaSemana . "&sortBy=publishedAt&token=2956d20a0e0f5189c281f15099a359ee";
    
            $datos = file_get_contents($url);
            $json = json_decode($datos, true);

            $articles = $json["articles"];
            for($i = 0; $i < count($articles); $i++){
                $noticia = "";
                $noticia .= "<article>";
                $noticia .= "<h2>" . $articles[$i]["title"] . "</h2>";
                $noticia .= "<p>" . $articles[$i]["description"] . "</p>";
                $noticia .= "<p>" . $articles[$i]["content"] . "</p>";
                $noticia .= "<img src='" . $articles[$i]["image"] . "' alt='Foto representativa de la noticia' />";
                $noticia .= "<p>Fuente de información: " . $articles[$i]["source"]["name"] . "</p>";
                $noticia .= "<p>Fecha de la punlicación: " . $articles[$i]["publishedAt"] . "</p>";
                $noticia .= "<a href='" . $articles[$i]["url"] . "'>Ver la noticia completa</a>";
                $noticia .= "</article>";

                if(isset($_SESSION["mostrar"])){
                    $_SESSION["mostrar"] .= $noticia;
                }else{
                    $_SESSION["mostrar"] = $noticia;
                }
            }
        }

        public function mostrar(){
            if(isset($_SESSION["mostrar"])){
                return $_SESSION["mostrar"];
            }
        }

    }
?>