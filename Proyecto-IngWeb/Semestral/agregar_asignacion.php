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
    $id_curso = $row_curso_profesor['id_curso'];
} else {
   
    echo "Error: El profesor no está asociado a ningún curso.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nombre_asignacion = $_POST["nombre_asignacion"];

    
    if (empty($nombre_asignacion)) {
        $error_msg = "Por favor, ingrese el nombre de la asignación.";
    } else {
       
        $sql_insert_asignacion = "INSERT INTO asignaciones (id_curso, nombre_asignacion) VALUES ($id_curso, '$nombre_asignacion')";
        if ($conn->query($sql_insert_asignacion) === TRUE) {
            $success_msg = "Asignación agregada exitosamente.";
        } else {
            $error_msg = "Error al agregar la asignación: " . $conn->error;
        }
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Project</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.cdnfonts.com/css/aileron" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/profesor2.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="pagina_profesor.php">
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
                <a class="nav-link" href='pagina_profesor.php'>Pagina Principal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link custom-highlight" href='agregar_asignacion.php?id_curso=$id_curso_profesor'>Agregar Asignación</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href='colocar_notas.php?id_curso=$id_curso_profesor'>Colocar Notas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="cerrar_sesion.php">Cerrar Sesión</a>
            </li>
        </ul>
    </div>
</nav>

<body>
    <div class="container">
        <div class="card">
            <div class="card-body">

                <h2 class="card-title">Agregar Asignación</h2>

                <?php
               
                if (isset($success_msg)) {
                    echo "<p class='text-success'>$success_msg</p>";
                } elseif (isset($error_msg)) {
                    echo "<p class='text-danger'>$error_msg</p>";
                }
                ?>

                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group">
                        <label for="nombre_asignacion" class="text-white">Nombre de la Asignación:</label>
                        <input type="text" name="nombre_asignacion" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-info">Agregar Asignación</button>
                </form>

                <?php
                
                echo "<br><a href='pagina_profesor.php?id_usuario=$id_profesor' class='btn btn-secondary'>Volver a Inicio</a>";
                ?>

            </div>
        </div>
    </div>
</body>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>