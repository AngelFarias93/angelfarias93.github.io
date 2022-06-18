<?php
class ControladorBase
{
    public function __construct()
    {
        require_once 'Conectar.php';
        require_once 'EntidadBase.php';
        require_once 'OrmConectar.php';
        //Incluir todos los modelos
        foreach (glob("app/Models/*.php") as $file) {
            require_once $file;
        }
    }
}