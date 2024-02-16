<?php

include("conexion.php");


session_start();


if (!isset($_SESSION['id_usuario']) || $_SESSION['rol'] != 2) {
    
    header("Location: index.php");
    exit();
}


$id_estudiante = $_SESSION['id_usuario'];
$sql_matriculado = "SELECT * FROM matriculas WHERE id_estudiante = $id_estudiante";
$result_matriculado = $conn->query($sql_matriculado);


$esta_matriculado = $result_matriculado->num_rows > 0;


$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página del Estudiante</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.cdnfonts.com/css/aileron" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/estudiante1.css">

    </head>
    <body>

    <nav class="navbar navbar-expand-lg navbar-dark shadow navbar-custom" style="background-color: #081d3c;">
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
            <li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'pagina_estudiante.php') echo 'active'; ?>">
                <a class="nav-link" href='pagina_estudiante.php'>Pagina Principal</a>
            </li>
            <li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'ver_perfil.php') echo 'active'; ?>">
                <a class="nav-link" href='ver_perfil.php'>Perfil de Usuario</a>
            </li>
            <?php
            
            if ($esta_matriculado) {
                echo "<li class='nav-item ml-2 " . (basename($_SERVER['PHP_SELF']) == 'ver_materias.php' ? 'active' : '') . "'>";
                echo "<a class='nav-link' href='ver_materias.php'>Ver Materias</a>";
                echo "</li>";
            } else {
                echo "<li class='nav-item ml-2 " . (basename($_SERVER['PHP_SELF']) == 'ver_grupos.php' ? 'active' : '') . "'>";
                echo "<a class='nav-link' href='ver_grupos.php'>Ver Grupos</a>";
                echo "</li>";
            }
            ?>
            <li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'cerrar_sesion.php') echo 'active'; ?>">
                <a class="nav-link" href="cerrar_sesion.php">Cerrar Sesión</a>
            </li>
        </ul>
    </div>
</nav>  

<div class="container mt-4 custom-container-bg">
    <div class="welcome-container">
        <h2>Bienvenido a UNITEC INNOVADORA,  <?php echo $_SESSION['nombre']; ?>!</h2>
    </div>

    <div class="card-deck mt-3">
        <div class="card">
            <img src="img\perfil_usuario.jpg" class="card-img-top" alt="Image 1">
            <div class="card-body">
                <h5 class="card-title">Ver Perfil</h5>
                <p class="card-text">Accede a tu perfil estudiantil.</p>
                <a href="ver_perfil.php" class="btn btn-primary">Ir al Perfil</a>
            </div>
        </div>
        <?php
        if ($esta_matriculado) {
            
            echo "<div class='card'>";
            echo "<img src='img\Ver_matricula.jpeg' class='card-img-top' alt='Image 2'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>Ver Materias</h5>";
            echo "<p class='card-text'>Consulta las materias en las que estás inscrito.</p>";
            echo "<a href='ver_materias.php' class='btn btn-primary'>Ir a Materias</a>";
            echo "</div>";
            echo "</div>";
        } else {
            
            echo "<div class='card'>";
            echo "<img src='img\Ver_grupo.jpg' class='card-img-top' alt='Image 3'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>Ver Grupos</h5>";
            echo "<p class='card-text'>Explora y únete a grupos disponibles.</p>";
            echo "<a href='ver_grupos.php' class='btn btn-primary'>Ir a Grupos</a>";
            echo "</div>";
            echo "</div>";
        }
        ?>
    </div>
</div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>