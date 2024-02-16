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


$sql_estudiantes = "SELECT id_estudiante, Nombre FROM estudiantes WHERE id_estudiante IN (SELECT id_estudiante FROM matriculas WHERE id_grupo IN (SELECT id_grupo FROM grupos_cursos WHERE id_curso = $id_curso))";
$result_estudiantes = $conn->query($sql_estudiantes);


$sql_asignaciones = "SELECT id_asignacion, nombre_asignacion FROM asignaciones WHERE id_curso = $id_curso";
$result_asignaciones = $conn->query($sql_asignaciones);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    while ($row_estudiante = $result_estudiantes->fetch_assoc()) {
        $id_estudiante = $row_estudiante['id_estudiante'];


        while ($row_asignacion = $result_asignaciones->fetch_assoc()) {
            $id_asignacion = $row_asignacion['id_asignacion'];

            
            $input_name = "nota_estudiante_$id_estudiante"."_asignacion_$id_asignacion";
            $nota = $_POST[$input_name];

   
            if (!empty($nota)) {
                
                $sql_exist_calificacion = "SELECT id_calificacion FROM calificaciones WHERE id_asignacion = $id_asignacion AND id_estudiante = $id_estudiante";
                $result_exist_calificacion = $conn->query($sql_exist_calificacion);

                if ($result_exist_calificacion->num_rows > 0) {
                   
                    $row_exist_calificacion = $result_exist_calificacion->fetch_assoc();
                    $id_calificacion = $row_exist_calificacion['id_calificacion'];

                    $sql_update_calificacion = "UPDATE calificaciones SET Calificacion = $nota WHERE id_calificacion = $id_calificacion";
                    $conn->query($sql_update_calificacion);
                } else {
                   
                    $sql_insert_calificacion = "INSERT INTO calificaciones (id_asignacion, id_estudiante, Calificacion) VALUES ($id_asignacion, $id_estudiante, $nota)";
                    $conn->query($sql_insert_calificacion);
                }
            }
        }

       
        $result_asignaciones->data_seek(0);
    }

    $success_msg = "Notas guardadas exitosamente.";
}

$notas_exist = [];


$estudiantes_array = [];
while ($row_estudiante = $result_estudiantes->fetch_assoc()) {
    $estudiantes_array[$row_estudiante['id_estudiante']] = $row_estudiante['Nombre'];
}


$result_estudiantes->data_seek(0);


while ($row_estudiante = $result_estudiantes->fetch_assoc()) {
    $id_estudiante = $row_estudiante['id_estudiante'];

   
    while ($row_asignacion = $result_asignaciones->fetch_assoc()) {
        $id_asignacion = $row_asignacion['id_asignacion'];

       
        $sql_get_nota = "SELECT Calificacion FROM calificaciones WHERE id_asignacion = $id_asignacion AND id_estudiante = $id_estudiante";
        $result_get_nota = $conn->query($sql_get_nota);

        if ($result_get_nota->num_rows > 0) {
            $row_get_nota = $result_get_nota->fetch_assoc();
            $nota_actual = $row_get_nota['Calificacion'];
        } else {
            $nota_actual = null;
        }

       
        $notas_exist[$id_estudiante][$id_asignacion] = $nota_actual;
    }

   
    $result_asignaciones->data_seek(0);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Project</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.cdnfonts.com/css/aileron" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/profesor3.css">
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
                    <a class="nav-link" href='agregar_asignacion.php?id_curso=$id_curso_profesor'>Agregar Asignación</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link custom-highlight" href='colocar_notas.php?id_curso=$id_curso_profesor'>Colocar Notas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cerrar_sesion.php">Cerrar Sesión</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="card">
            <div class="card-body">

                <h2 class="card-title">Colocar Notas</h2>

                <?php
         
                if (isset($success_msg)) {
                    echo "<p class='text-success'>$success_msg</p>";
                }
                ?>

                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="table-responsive">
                    <table class="table table-bordered">
    <thead>
        <tr>
            <th>Nombre</th>
            <?php
        
            foreach ($result_asignaciones as $row_asignacion) {
                echo "<th>{$row_asignacion['nombre_asignacion']}</th>";
            }
            ?>
        </tr>
    </thead>
    <tbody>
        <?php
       
        foreach ($notas_exist as $id_estudiante => $asignaciones) {
            echo "<tr>";
            
      
            if (array_key_exists($id_estudiante, $estudiantes_array)) {
                echo "<td>{$estudiantes_array[$id_estudiante]}</td>";
            } else {
                echo "<td>Nombre no encontrado</td>";
            }

            foreach ($asignaciones as $id_asignacion => $nota_exist) {
                echo "<td><input type='text' name='nota_estudiante_$id_estudiante"."_asignacion_$id_asignacion' value='$nota_exist'></td>";
            }

            echo "</tr>";
        }
        ?>
    </tbody>
</table>
                    </div>

                    <input type="submit" class="btn btn-primary" value="Guardar/Editar Notas">
                </form>

                <?php
               
                echo "<br><a href='pagina_profesor.php?id_usuario=$id_profesor' class='btn btn-secondary'>Volver a Inicio</a>";
                ?>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-Jj
</body>

</html>