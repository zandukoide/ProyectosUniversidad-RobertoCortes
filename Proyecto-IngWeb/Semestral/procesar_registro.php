<?php

include("conexion.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nombre = $_POST['nombre'];
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];
    $rol = $_POST['rol'];

  
    $sql_insert_usuario = "INSERT INTO usuarios (nombre, contraseña, rol) VALUES ('$usuario', '$contraseña', $rol)";
    $result_insert_usuario = $conn->query($sql_insert_usuario);

    if ($result_insert_usuario) {
        
        $id_usuario = $conn->insert_id;

        
        if ($rol == 1) {
            
            $sql_insert_profesor = "INSERT INTO profesores (id_profesor, Nombre_Profesor) VALUES ($id_usuario, '$nombre')";
            $conn->query($sql_insert_profesor);
        } elseif ($rol == 2) {
           
            $sql_insert_estudiante = "INSERT INTO estudiantes (id_estudiante, Nombre) VALUES ($id_usuario, '$nombre')";
            $conn->query($sql_insert_estudiante);
        }

       
        header("Location: login.php");
        exit();
    } else {
       
        echo "Error al registrar el usuario. Por favor, intenta nuevamente.";
    }
}


$conn->close();
?>
