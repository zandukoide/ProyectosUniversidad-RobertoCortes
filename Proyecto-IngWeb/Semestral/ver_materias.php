<?php

include("conexion.php");


session_start();


if (!isset($_SESSION['id_usuario']) || $_SESSION['rol'] != 2) {
    header("Location: login.php");
    exit();
}


$id_estudiante = $_SESSION['id_usuario'];


$sql_materias = "SELECT cursos.id_curso, cursos.Nombre_Curso
                 FROM cursos
                 INNER JOIN grupos_cursos ON cursos.id_curso = grupos_cursos.id_curso
                 INNER JOIN matriculas ON grupos_cursos.id_grupo = matriculas.id_grupo
                 WHERE matriculas.id_estudiante = $id_estudiante";

$result_materias = $conn->query($sql_materias);


$conn->close();
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materias Matriculadas</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.cdnfonts.com/css/aileron" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/estudiante1.css">
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
            <li class="nav-item active">
                <a class="nav-link" href='ver_materias.php'>Ver Materias</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="cerrar_sesion.php">Cerrar Sesión</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-4 custom-container-bg">

    <h3>Materias Matriculadas:</h3>

    <div class="card-deck mt-3">
        <?php
        if ($result_materias->num_rows > 0) {
            while ($row_materia = $result_materias->fetch_assoc()) {
                $id_curso = $row_materia['id_curso'];
                $nombre_materia = $row_materia['Nombre_Curso'];

               
                echo "<div class='card'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>$nombre_materia</h5>";
                echo "<p class='card-text'>Consulta información adicional de la materia.</p>";
                echo "<a href='ver_nota.php?id_curso=$id_curso' class='btn btn-primary'>Ver Detalles</a>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>No estás matriculado en ninguna materia.</p>";
        }
        ?>
    </div>
    <a href='pagina_estudiante.php?id_usuario=<?php echo $id_estudiante; ?>' class='btn btn-secondary mt-3'>Volver a Inicio</a>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>