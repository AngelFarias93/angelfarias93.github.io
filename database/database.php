<?php
//CARGO VARIABLES DE ENTORNO
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__,1));
$dotenv->load();
//FIN DE CARGA VARIABLES DE ENTORNO
$statusDeveloper = $_ENV['STATUSDEVELOPER'];

