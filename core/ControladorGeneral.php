<?php

class ControladorCore
{
    /*=============================================
    FUNCIONES PARA EL CONTROLADOR FRONTAL
    =============================================*/
    public function cargarControladorDefault($controller)
    {
        $controlador = ucwords($controller) . 'Controller';
        $strFileController = 'app/Controllers/' . $controlador . '.php';
        $strFileController = 'app/Controllers/' . ucwords(CONTROLADOR_DEFECTO) . 'Controller.php';
        require_once $strFileController;
        return new $controlador();
    }

    /*================================================================
    FUNCIONES PARA CARGAR LOS CONTROLADORES CONFORME A LA VISTA
    ==================================================================*/
    public function cargarControlador($controller)
    {
        $controlador = ucwords($controller) . 'Controller';
        $strFileController = 'app/Controllers/' . $controlador . '.php';
        if (file_exists($strFileController)) {
            require_once $strFileController;
        }
    }
    /*===========================================================================
    FUNCIONES PARA CARGAR LOS ARCHIVOS DE JAVASCRIPT CONFORME A LA VISTA
    =============================================================================*/
    public function cargarJavaScript($javascript)
    {
        $javascript = ucwords($javascript) . 'Javascript';
        $strFilejavascript = 'public/js/minify/' . $javascript . '.min.js';
        if (file_exists($strFilejavascript)) {
            echo '<script src="' . RUTA . $strFilejavascript . '?t=' . IDRECURSOS . '"></script>';
        }
    }

    /*===========================================================================
    FUNCIONES PARA MINIFICAR DURANTE EL DESARROLLO
    =============================================================================*/
    public function MinificarJavaScript()
    {
        //Incluir todos los archivos
        foreach (glob("public/js/*.js") as $fileJs) {
            $sourcePath = $fileJs;
            $minifier = new MatthiasMullie\Minify\JS($sourcePath);
            $sourcePath2 = 'public/js/minify/' . substr($fileJs, 10, -3) . '.min.js';
            $minifier->minify($sourcePath2);
        }
    }

    /*=============================================
    FUNCIONES PARA CARGAR LA ACCION
    =============================================*/
    public function cargarAccion($controllerObj, $action)
    {
        $actions = $action;
        $controllerObj->$actions();
    }

    /*=============================================
    FUNCIONES PARA LANZAR LA ACCION
    =============================================*/
    public function lanzarAccion($controllerObj)
    {
        $obj = new self;
        $obj->cargarAccion($controllerObj, ACCION_DEFECTO);;
    }

}
