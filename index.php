<?php
error_reporting(E_ALL);
ini_set('ignore_repeated_errors', TRUE);
ini_set('display_errors', TRUE);
ini_set('log_errors', TRUE);
ini_set('error_log', 'php-error.log');
error_log('Start App');
/*-------------------------------------------------------------
DEPENDENCIAS
--------------------------------------------------------------*/
require_once "vendor/autoload.php";
/*-------------------------------------------------------------
DB
--------------------------------------------------------------*/
require_once "database/database.php";
/*-------------------------------------------------------------
CONFIGURACION GLOBAL
--------------------------------------------------------------*/
require_once "config/global.php";

/*-------------------------------------------------------------
BASE PARA CARGAR LOS CONTROLADORES
--------------------------------------------------------------*/
require_once "core/ControladorBase.php";
/*-------------------------------------------------------------
Funciones para el controlador frontal
--------------------------------------------------------------*/
require_once "core/ControladorGeneral.php";
/*-------------------------------------------------------------
CARGAMOS CONTROLADORES DEPENDIENDO DE LA RUTA
--------------------------------------------------------------*/
$ControladorCore = new ControladorCore();
/*-------------------------------------------------------------
LANZAMOS EL CONTROLADOR PARA MINIFICAR JS, SOLAMENTE DURANTE EL DESARROLLO
--------------------------------------------------------------*/
if ($_ENV["STATUSDEVELOPER"] != 3) {
    $controllerObj = $ControladorCore->MinificarJavaScript();
} 

if (isset($_GET["ruta"])) {
    $rutas = explode("/", $_GET["ruta"]);
    $ruta = $rutas[0];
    $controllerObj = GlobalRoutes($ruta);
    if ($controllerObj != 404) {
        $controllerObj = $ControladorCore->cargarControlador($controllerObj);
    }
}
/*-------------------------------------------------------------
LANZAMOS EL CONTROLADOR POR DEFECTO
--------------------------------------------------------------*/
$controllerObj = $ControladorCore->cargarControladorDefault(CONTROLADOR_DEFECTO);
$ControladorCore->lanzarAccion($controllerObj);
?>