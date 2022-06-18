<?php

class Conectar
{
    private $driver, $host, $user, $pass, $database, $charset;

    public function __construct()
    {
        $this->driver = DRIVER;
        $this->host = HOST;
        $this->user = USER;
        $this->pass = PASS;
        $this->database = DATABASE;
        $this->charset = CHARSET;
    }

    public function conexion()
    {
        if ($this->driver == "mysql" || $this->driver == null) {
            //$link = new PDO($this->driver . ":dbname=" . $this->database, $this->user, $this->pass);
            $link = new PDO($this->driver . ":host=".$this->host.";dbname=" . $this->database, $this->user, $this->pass);
            $link->exec("SET NAMES '" . $this->charset . "'");
        } else {
            $link = false;
        }
        return $link;
    }

    public function conexionTemporal($name)
    {
        if ($this->driver == "mysql" || $this->driver == null) {
            $temp = new PDO($this->driver . ":dbname=" . $name, $this->user, $this->pass);
            $temp->exec("SET NAMES '" . $this->charset . "'");
        } else {
            $temp = false;
        }
        return $temp;
    }


}
