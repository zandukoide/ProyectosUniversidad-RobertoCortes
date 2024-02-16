<?php
require_once 'api/config/connection.php';

$conexion = new connection();


$listaTablasJson = $conexion->obtenerDatos("SHOW TABLES");

$listaTablas = json_decode($listaTablasJson, true);

foreach ($listaTablas as $tabla) {
    
    $nombreTabla = reset($tabla);

    
    $sql = "SELECT * FROM $nombreTabla";
    $datosTablaJson = $conexion->obtenerDatos($sql);

    
    $datosTabla = json_decode($datosTablaJson, true);

    
    echo "Datos de la tabla $nombreTabla:\n";
    echo json_encode($datosTabla, JSON_PRETTY_PRINT);
    echo "\n";
}


$conexion->cerrarConexion();
?>