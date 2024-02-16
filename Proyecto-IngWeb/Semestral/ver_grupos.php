<?php

include("conexion.php");


$sql_grupos = "SELECT * FROM grupos";
$result_grupos = $conn->query($sql_grupos);


$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Grupos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/estudiante4.css">
   
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
                <a class="nav-link" href='ver_grupos.php'>Ver Grupos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="cerrar_sesion.php">Cerrar Sesión</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container mt-4 container-bg">
        <h2 class="mb-4">Lista de Grupos</h2>

        <div class="list-group">
            <?php
           
            if ($result_grupos->num_rows > 0) {
                while ($row_grupo = $result_grupos->fetch_assoc()) {
                    $id_grupo = $row_grupo['id_grupo'];
                    $nombre_grupo = $row_grupo['nombre_grupo'];

                 
                    echo "<a href='materias_grupo.php?id_grupo=$id_grupo' class='list-group-item list-group-item-action'>$nombre_grupo</a>";
                }
            } else {
                echo "<p class='text-muted'>No hay grupos disponibles.</p>";
            }
            ?>
        </div>
    </div>>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   
</body>
</html>