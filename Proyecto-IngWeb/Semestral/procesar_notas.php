<?php

include("conexion.php");

session_start();

if (!isset($_SESSION['id_usuario']) || $_SESSION['rol'] != 1) {
   
    header("Location: login.php");
    exit();
}


$id_profesor = $_SESSION['id_usuario'];


$sql_curso_profesor = "SELECT id_curso FROM profesores_cursos WHERE id_profesor = $id_profesor";
$result_curso_profesor = $conn->query($sql_curso_profesor);

if ($result_curso_profesor->num_rows > 0) {
    $row_curso_profesor = $result_curso_profesor->fetch_assoc();
    $id_curso_profesor = $row_curso_profesor['id_curso'];
} else {
   
    echo "Error: No se encontró el curso asociado al profesor.";
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    foreach ($_POST as $key => $value) {
        
        if (strpos($key, 'nota_') !== false && !empty($value)) {
         
            $id_estudiante_asignacion = substr($key, 5);
            list($id_estudiante, $id_asignacion) = explode("_", $id_estudiante_asignacion);

            $sql_insert_update = "INSERT INTO calificaciones (id_estudiante, id_asignacion, Calificacion)
                                 VALUES ($id_estudiante, $id_asignacion, $value)
                                 ON DUPLICATE KEY UPDATE Calificacion = $value";
            $conn->query($sql_insert_update);
        }
    }

    header("Location: colocar_notas.php?success=1");
} else {

    header("Location: colocar_notas.php?error=1");
}


$conn->close();
?>
