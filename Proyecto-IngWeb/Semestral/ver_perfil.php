<?php

include("conexion.php");


session_start();


if (!isset($_SESSION['id_usuario'])) {
  
    header("Location: login.php");
    exit();
}


$id_usuario = $_SESSION['id_usuario'];
$sql_nombre = "SELECT Nombre FROM estudiantes WHERE id_estudiante = $id_usuario";
$result_nombre = $conn->query($sql_nombre);


if ($result_nombre->num_rows > 0) {
    $row_nombre = $result_nombre->fetch_assoc();
    $nombre_usuario = $row_nombre['Nombre'];
} else {
    $nombre_usuario = "Usuario Desconocido";
}


$conn->close();
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Perfil</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/estudiante3.css">
    
    <link rel="stylesheet" type="text/css" href="css/estudiante3-custom.css">
</head>
<body class="bg-light">
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
             <li class="nav-item active">
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
    <div class="container mt-5 custom-container-bg">
        
        <div class="text-center">
            <img src="img/usuario.jpg" alt="Imagen predeterminada" class="img-fluid rounded-circle" style="width: 150px;">
            <h4 class="mt-3"><?php echo $nombre_usuario; ?></h4>
            <p>UNITEC INNOVADORA</p>
            <p>Ciudad de Panamá</p>
        </div>

        <hr>

       
        <div class="text-center mb-4">
            <form action="index_uni.php" method="post">
                <button type="submit" class="btn btn-primary">Ver API</button>
            </form>
        </div>

        <hr>

        
        <div>
            <h5>Contactanos:</h5>
            <ul>
                <li>Correo: innovadora@unitec.ac.pa</li>
                <li>Redes:
                    <ul>
                        <li>Instagram: @unitecinn</li>
                        <li>X: @unitecinn</li>
                    </ul>
                </li>
                <li>Telefono: +507 5555-5555</li>
            </ul>
        </div>
    </div>

    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>