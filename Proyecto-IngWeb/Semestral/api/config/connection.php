<?php

class connection {
    private $server;
    private $user;
    private $password;
    private $database;
    private $port;

    function __construct(){
        $listadatos = $this->datosConexion();
        foreach ($listadatos as $key => $value) {
            $this->server = $value['server'];
            $this->user = $value['user'];
            $this->password = $value['password'];
            $this->database = $value['database'];
            $this->port = $value['port'];
        }
        $this->con = new mysqli($this->server,$this->user,$this->password,$this->database,$this->port);
        if($this->con->connect_errno){
            echo "Error en la conexion".$this->con->connect_error;
            die();
        }
    }


    private function datosConexion(){
        $direccion = dirname(__FILE__);
        $jsondata = file_get_contents($direccion."/"."config");
        return json_decode($jsondata, true);
    }

    private function convertirUTF8($array){
        array_walk_recursive($array,function(&$item,$key){
            if(!mb_detect_encoding($item,'utf-8',true)){
                $item = utf8_encode($item);
            }
        });
        return $array;
    }

    public function obtenerDatos($sqlstr){
        $results = $this->con->query($sqlstr);

        if (!$results) {
            // Manejar el error de la consulta
            echo "Error en la consulta: " . $this->con->error;
            return false;
        }

        $resultArray = $results->fetch_all(MYSQLI_ASSOC);

        return json_encode($this->convertirUTF8($resultArray), JSON_PRETTY_PRINT);
    }

    public function cerrarConexion() {
        if ($this->con) {
            $this->con->close();
        }
    }
}

?>