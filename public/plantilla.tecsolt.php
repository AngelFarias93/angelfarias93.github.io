<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">

        <title><?= NAMESOFTWARE ?></title>
        <!--=====================================
        ICON
        ======================================-->
        <link rel="icon" href="<?= ICONO ?>">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta http-equiv="Content-Language" content="es">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"/>
        <!--=====================================
        Marcado HTML5
        ======================================-->
        <meta name="title" content="Tecsolt">
        <meta name="description" content="Tecsolt">
        <meta name="keyword" content="Tecsolt">
        <!--=====================================
        Marcado HTML5
        ======================================-->
        <meta name="title" content="Tecsolt">
        <meta name="description" content="Tecsolt">
        <meta name="keyword" content="Tecsolt">
        <!--=====================================
        Marcado de Open Graph FACEBOOK
        ======================================-->
        <meta property="og:title" content="Tecsolt">
        <meta property="og:url" content="">
        <meta property="og:description" content="Tecsolt">
        <meta property="og:image" content="">
        <meta property="og:type" content="website">
        <meta property="og:site_name" content="">
        <meta property="og:locale" content="es_MX">
        <!--=====================================
        Marcado para DATOS ESTRUCTURADOS GOOGLE
        ======================================-->
        <meta itemprop="name" content="Tecsolt">
        <meta itemprop="url" content="">
        <meta itemprop="description" content="Tecsolt">
        <meta itemprop="image" content="">
        <!--=====================================
        Marcado de TWITTER
        ======================================-->
        <meta name="twitter:card" content="summary">
        <meta name="twitter:title" content="Tecsolt">
        <meta name="twitter:url" content="">
        <meta name="twitter:description" content="Tecsolt">
        <meta name="twitter:image" content="">
        <meta name="twitter:site" content="@tecsolt">
        <!--=====================================
        PLUGINS DE CSS
        =====================================-->
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer">
        <!--=====================================
        PLUGINS DE JS
        =====================================-->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php
            //INSTANCIO NUEVO METODO CONTROLADOR GENERAL
            $objCrtGeneral = new ControladorCore();
            include dirname(__DIR__, 1) . "/resources/views/modules/home.tecsolt.php";

            echo '<script src="' . $_ENV["RUTA"] . 'public/js/minify/general.min.js?t=' . IDRECURSOS . '"></script>';
            /*-------------------------------------------------------
            CARGAMOS LOS JS DEPENDIENDO DE LA PESTAÑA
            --------------------------------------------------------*/
            $rutas = array();
            if (isset($_GET["ruta"])) {
                $rutas = explode("/", $_GET["ruta"]);
                $ruta = $rutas[0];
                $objCrtGeneral->cargarJavaScript($ruta);
            }
        ?>
    </body>
</html>