<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Project</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.cdnfonts.com/css/aileron" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/profesor1.css">

    <script>
       
        document.addEventListener('DOMContentLoaded', function () {
            var alertCounter = getCookie('alert_counter');

            
            if (!alertCounter || parseInt(alertCounter) <= 5) {
                showProfessorAlert();
            }
        });

       
        function setCookie(name, value, days) {
            var expires = '';
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = '; expires=' + date.toUTCString();
            }
            document.cookie = name + '=' + value + expires + '; path=/';
        }

     
        function getCookie(name) {
            var nameEQ = name + '=';
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = cookies[i];
                while (cookie.charAt(0) === ' ') cookie = cookie.substring(1, cookie.length);
                if (cookie.indexOf(nameEQ) === 0) return cookie.substring(nameEQ.length, cookie.length);
            }
            return null;
        }

        function showProfessorAlert() {
     

         
            var alertCounter = getCookie('alert_counter') || 0;
            setCookie('alert_counter', parseInt(alertCounter) + 1, 5);
        }
    </script>
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
                <a class="nav-link custom-highlight" href='pagina_profesor.php'>Pagina Principal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href='agregar_asignacion.php?id_curso=$id_curso_profesor'>Agregar Asignación</a>
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

    <div class="container">
    <div class="class-message">
    
    <div id="professor-message" class="container mt-5">
    <?php
include("conexion.php");
session_start();

if (!isset($_SESSION['id_usuario']) || $_SESSION['rol'] != 1) {
    header("Location: login.php");
    exit();
}

$id_profesor = $_SESSION['id_usuario'];

$sql_materia_profesor = "SELECT cursos.id_curso, cursos.Nombre_Curso
                        FROM cursos
                        INNER JOIN profesores_cursos ON cursos.id_curso = profesores_cursos.id_curso
                        WHERE profesores_cursos.id_profesor = $id_profesor";

$result_materia_profesor = $conn->query($sql_materia_profesor);

if ($result_materia_profesor->num_rows > 0) {
    $row_materia_profesor = $result_materia_profesor->fetch_assoc();
    $id_curso_profesor = $row_materia_profesor['id_curso'];
    $nombre_materia_profesor = $row_materia_profesor['Nombre_Curso'];

   
    $alertCounter = isset($_COOKIE['alert_counter']) ? $_COOKIE['alert_counter'] : 0;

    
    $showAlert = ($alertCounter < 5);

    if ($showAlert) {
        echo "<div class='alert alert-info alert-dismissible fade show' role='alert'>";
        echo "Estás a cargo de la materia: <strong>$nombre_materia_profesor</strong>";
        echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
        echo "<span aria-hidden='true'>&times;</span>";
        echo "</button>";
        echo "</div>";

        
        setcookie('alert_counter', $alertCounter + 1, time() + (5 * 24 * 60 * 60), "/");
    }
}

$conn->close();
?>
    </div>

  
    <div class="card-deck">
        <div class="card">
            <img class="card-img-top" src="img\leccion.jpg" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Agregar asignacion</h5>
                <p class="card-text">Explora nuevas posibilidades educativas, diseñar tareas inspiradoras y fomentar la innovación.</p>
                <?php
        
                    echo "<a href='agregar_asignacion.php?id_curso=$id_curso_profesor' class='btn btn-primary'>Asignacion</a>";
                 ?>
            </div>
        </div>
        <div class="card">
            <img class="card-img-top" src="img\calificar.jpg" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Colocar Nota</h5>
                <p class="card-text">Evalúa el progreso con precisión.</p>
                <?php
                    echo "<a href='colocar_notas.php?id_curso=$id_curso_profesor' class='btn btn-primary'>Calificar</a>";
             ?>
            </div>
        </div>
    </div>
     
     <div id="scroll-section" class="container">
        <img id="scroll-image" src="img\Director.jpg" alt="Director Image">
        <p id="scroll-text">
        Estimado cuerpo docente,

¡Bienvenidos a un nuevo año académico en UNITEC INNOVADORA! 🚀 Enfrentemos este año con entusiasmo renovado, recordando la importancia de nuestro papel en la formación de los estudiantes. En nuestras aulas, no solo impartimos conocimientos, sino que también moldeamos el carácter y fomentamos la resiliencia.

Animo a cada uno de ustedes a abrazar la innovación y la creatividad en nuestros métodos de enseñanza, creando así un ambiente dinámico que despierte la curiosidad y aliente a los estudiantes a explorar más allá de los límites de los libros de texto.

"Explora. Descubre. Innova." es más que un lema; es nuestra filosofía. En UNITEC INNOVADORA, la educación es una herramienta poderosa para cambiar el mundo. Como educadores, sostenemos esa herramienta en nuestras manos cada día. Utilicémosla con cuidado, sabiduría y la creencia de que cada estudiante tiene el potencial de marcar la diferencia en el mundo.

Los invito a seguir siendo aprendices de por vida, ya que nuestra pasión por el conocimiento es contagiosa. Nuestro entusiasmo por la búsqueda de la sabiduría sin duda encenderá la llama de la curiosidad en nuestros estudiantes.

Recuerden, nuestro impacto es inconmensurable y nuestra influencia perdura. Así que embarquémonos en este viaje académico con renovado vigor, dedicación y un compromiso compartido de inspirar, nutrir y empoderar las brillantes mentes que se nos han confiado.

Gracias por su dedicación inquebrantable. ¡Que este año académico en UNITEC INNOVADORA sea un faro de inspiración para todos!

Juntos, eduquemos, elevemos e inspiremos.

Gracias,
Dr. Alejandro Martínez Techworth
Director, UNITEC INNOVADORA
        </p>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    var scrollSection = document.getElementById("scroll-section");

    function handleScroll() {
        var scrollSectionBottom = scrollSection.offsetTop + scrollSection.offsetHeight;

        if (window.scrollY + window.innerHeight >= scrollSectionBottom) {
            scrollSection.style.opacity = 1;
        } else {
            scrollSection.style.opacity = 0;
        }
    }

    window.addEventListener("scroll", handleScroll);
</script>


</body>
</html>