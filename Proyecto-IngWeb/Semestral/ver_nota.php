<?php

include("conexion.php");


session_start();


if (!isset($_SESSION['id_usuario']) || $_SESSION['rol'] != 2) {
    
    header("Location: login.php");
    exit();
}


$id_estudiante = $_SESSION['id_usuario'];
$id_materia = $_GET['id_curso'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notas</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.cdnfonts.com/css/aileron" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/estudiante2.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark  shadow">
    <a class="navbar-brand" href="pagina_estudiante.php">
        <img src="img\logo.jpg" alt="Logo">
        UNITEC INNOVADORA
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href='pagina_estudiante.php'>Pagina Principal</a>
            </li>
             <li class="nav-item">
                <a class="nav-link" href='ver_perfil.php'>Perfil de Usuario</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href='ver_materias.php'>Ver Materias</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="cerrar_sesion.php">Cerrar Sesión</a>
            </li>
        </ul>
    </div>
</nav>

    <div class="container">
    <h1>Notas</h1>
    <?php
   
    $sql_asignaciones = "SELECT a.id_asignacion, a.nombre_asignacion, c.Calificacion
                         FROM asignaciones a
                         LEFT JOIN calificaciones c ON a.id_asignacion = c.id_asignacion AND c.id_estudiante = $id_estudiante
                         WHERE a.id_curso = $id_materia";

    $result_asignaciones = $conn->query($sql_asignaciones);

    
    if ($result_asignaciones->num_rows > 0) {
        while ($row_asignacion = $result_asignaciones->fetch_assoc()) {
            $id_asignacion = $row_asignacion['id_asignacion'];
            $nombre_asignacion = $row_asignacion['nombre_asignacion'];
            $nota = $row_asignacion['Calificacion'];

            
            if ($nota == NULL) {
                $nota = "No entregado";
            }

            
            echo "<p><strong>$nombre_asignacion</strong> - Nota: $nota</p>";
        }
    } else {
        echo "No hay asignaciones.";
    }
    ?>

<a href='ver_materias.php?id_usuario=<?php echo $id_estudiante; ?>' class="btn btn-primary mt-3">Volver a Materias</a>
</div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>