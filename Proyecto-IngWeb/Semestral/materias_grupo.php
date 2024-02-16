<?php
include("conexion.php");


session_start();


if (!isset($_SESSION['id_usuario']) || $_SESSION['rol'] != 2) {
   
    header("Location: login.php");
    exit();
}


if (isset($_GET['id_grupo'])) {
    $id_grupo = $_GET['id_grupo'];

    
    $sql_materias = "SELECT cursos.id_curso, cursos.Nombre_Curso
                     FROM cursos
                     INNER JOIN grupos_cursos ON cursos.id_curso = grupos_cursos.id_curso
                     WHERE grupos_cursos.id_grupo = $id_grupo";
    $result_materias = $conn->query($sql_materias);

    
    $id_estudiante = $_SESSION['id_usuario'];
    $sql_matriculado = "SELECT id_matricula FROM matriculas WHERE id_estudiante = $id_estudiante AND id_grupo = $id_grupo";
    $result_matriculado = $conn->query($sql_matriculado);
    $ya_matriculado = $result_matriculado->num_rows > 0;
} else {
    header("Location: pagina_estudiante.php");
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['matricular']) && !$ya_matriculado) {
    
    $sql_matricular = "INSERT INTO matriculas (id_estudiante, id_grupo) VALUES ($id_estudiante, $id_grupo)";
    $conn->query($sql_matricular);

    
    header("Location: pagina_estudiante.php");
    exit();
}


$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materias del Grupo</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/estudiante5.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Materias del Grupo:</h2>

        <?php
       
        if ($result_materias->num_rows > 0) {
            while ($row_materia = $result_materias->fetch_assoc()) {
                $id_curso = $row_materia['id_curso'];
                $nombre_materia = $row_materia['Nombre_Curso'];

                
                echo "<p>$nombre_materia</p>";
            }

         
            if (!$ya_matriculado) {
                echo "<form method='post'>";
                echo "<input type='submit' name='matricular' value='Matricular' class='btn btn-primary'>";
                echo "</form>";
            } else {
                echo "<p>Ya estás matriculado en este grupo.</p>";
            }
        } else {
            echo "<p>No hay materias disponibles para este grupo.</p>";
        }
        ?>

        <button onclick="history.back()" class="btn btn-secondary btn-regresar">Regresar</button>
    </div>

    <?php
    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['matricular']) && !$ya_matriculado) {
       
        $sql_matricular = "INSERT INTO matriculas (id_estudiante, id_grupo) VALUES ($id_estudiante, $id_grupo)";
        $conn->query($sql_matricular);

       
        header("Location: pagina_estudiante.php");
        exit();
    }
    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>