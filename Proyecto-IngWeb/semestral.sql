-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-12-2023 a las 07:30:14
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `semestral`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaciones`
--

CREATE TABLE `asignaciones` (
  `id_asignacion` int(100) NOT NULL,
  `id_curso` int(100) NOT NULL,
  `nombre_asignacion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `asignaciones`
--

INSERT INTO `asignaciones` (`id_asignacion`, `id_curso`, `nombre_asignacion`) VALUES
(1, 5, 'Taller #1 Laplace'),
(2, 5, 'Taller #2 Fourier'),
(3, 5, 'Taller #3 Laplace'),
(4, 3, 'Taller #1 Verb to be'),
(5, 3, 'Taller #2 pronouns'),
(6, 9, 'Taller #1 - Arrerglos PHP'),
(7, 10, 'Taller 1 - Automatas'),
(8, 12, 'Asignacion 1 - Frecuencias Relativas'),
(9, 11, 'Asignacion 1 - Redes Inhalambricas'),
(10, 9, 'Taller #2 - JSON y XML'),
(11, 11, 'Taller 2 - Protocolos'),
(12, 10, 'Asignacion 2 - Alfabeto y Lenguajes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificaciones`
--

CREATE TABLE `calificaciones` (
  `id_calificacion` int(100) NOT NULL,
  `id_asignacion` int(100) NOT NULL,
  `id_estudiante` int(100) NOT NULL,
  `Calificacion` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `calificaciones`
--

INSERT INTO `calificaciones` (`id_calificacion`, `id_asignacion`, `id_estudiante`, `Calificacion`) VALUES
(1, 1, 2, 95),
(2, 2, 2, 60),
(3, 1, 10, 65),
(4, 2, 10, 90),
(5, 3, 2, 20),
(6, 3, 10, 80),
(7, 4, 1, 90),
(8, 5, 1, 85),
(9, 6, 8, 95),
(10, 9, 8, 80),
(11, 8, 8, 97),
(12, 7, 8, 75),
(13, 6, 16, 87),
(14, 10, 8, 80),
(15, 10, 16, 97),
(16, 11, 16, 86),
(17, 12, 8, 70);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id_curso` int(100) NOT NULL,
  `Nombre_Curso` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id_curso`, `Nombre_Curso`) VALUES
(1, 'Calculo 1 '),
(2, 'Español'),
(3, 'Ingles 1'),
(4, 'Globalizacion de Software'),
(5, 'Matematicas Superior'),
(6, 'Fisica 2'),
(7, 'Programación 1'),
(8, 'HCI'),
(9, 'Ingenieria Web'),
(10, 'Lenguajes Formales'),
(11, 'Redes'),
(12, 'Estadistica ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

CREATE TABLE `estudiantes` (
  `id_estudiante` int(100) NOT NULL,
  `Nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`id_estudiante`, `Nombre`) VALUES
(1, 'Ian Beckford'),
(2, 'Roberto Cortes'),
(8, 'Mariam Ortega'),
(10, 'Regino Cornejo'),
(16, 'Jens Hoffman');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `id_grupo` int(100) NOT NULL,
  `nombre_grupo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`id_grupo`, `nombre_grupo`) VALUES
(1, '1SF141'),
(2, '1SF241'),
(3, '1SF341');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos_cursos`
--

CREATE TABLE `grupos_cursos` (
  `id_grupo_curso` int(100) NOT NULL,
  `id_grupo` int(100) NOT NULL,
  `id_curso` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `grupos_cursos`
--

INSERT INTO `grupos_cursos` (`id_grupo_curso`, `id_grupo`, `id_curso`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 2, 5),
(6, 2, 6),
(7, 2, 7),
(8, 2, 8),
(9, 3, 9),
(10, 3, 10),
(11, 3, 11),
(12, 3, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matriculas`
--

CREATE TABLE `matriculas` (
  `id_matricula` int(100) NOT NULL,
  `id_estudiante` int(100) NOT NULL,
  `id_grupo` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `matriculas`
--

INSERT INTO `matriculas` (`id_matricula`, `id_estudiante`, `id_grupo`) VALUES
(1, 1, 1),
(2, 8, 3),
(3, 2, 2),
(8, 10, 2),
(9, 16, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

CREATE TABLE `profesores` (
  `id_profesor` int(100) NOT NULL,
  `Nombre_Profesor` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `profesores`
--

INSERT INTO `profesores` (`id_profesor`, `Nombre_Profesor`) VALUES
(9, 'Fermin Pineda'),
(11, 'Ivan Clarence'),
(12, 'Belén Bonilla'),
(13, 'Nicolas Beliz'),
(14, 'Giovana Garrido'),
(15, 'Teresa Rowe');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores_cursos`
--

CREATE TABLE `profesores_cursos` (
  `id_profesor_curso` int(11) NOT NULL,
  `id_profesor` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `profesores_cursos`
--

INSERT INTO `profesores_cursos` (`id_profesor_curso`, `id_profesor`, `id_curso`) VALUES
(3, 9, 5),
(4, 11, 3),
(5, 12, 9),
(6, 13, 10),
(7, 14, 11),
(8, 15, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `rol` int(11) NOT NULL CHECK (`rol` in (1,2))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `contraseña`, `rol`) VALUES
(1, 'ian.beckford', '12345', 2),
(4, 'roberto.cortes', '12345', 2),
(8, 'mariam.ortega', '12345', 2),
(9, 'fermin.pineda', '12345', 1),
(10, 'regino.cornejo', '12345', 2),
(11, 'ivan.clarence', '12345', 1),
(12, 'belen.bonilla', '2345', 1),
(13, 'nico.beliz', '12345', 1),
(14, 'giovana.garrido', '12345', 1),
(15, 'teresa.rowe', '12345', 1),
(16, 'jens.hoffman', '12345', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  ADD PRIMARY KEY (`id_asignacion`),
  ADD KEY `FK_asig_curso` (`id_curso`);

--
-- Indices de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD PRIMARY KEY (`id_calificacion`),
  ADD KEY `FK_calificacion_asig` (`id_asignacion`),
  ADD KEY `FK_calificacion_est` (`id_estudiante`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id_curso`);

--
-- Indices de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`id_estudiante`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id_grupo`);

--
-- Indices de la tabla `grupos_cursos`
--
ALTER TABLE `grupos_cursos`
  ADD PRIMARY KEY (`id_grupo_curso`),
  ADD KEY `FK_grupo_curso` (`id_grupo`),
  ADD KEY `FK_curso_grupo` (`id_curso`);

--
-- Indices de la tabla `matriculas`
--
ALTER TABLE `matriculas`
  ADD PRIMARY KEY (`id_matricula`),
  ADD KEY `FK_estudiante_matricula` (`id_estudiante`),
  ADD KEY `FK_grupo_matricula` (`id_grupo`);

--
-- Indices de la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD PRIMARY KEY (`id_profesor`);

--
-- Indices de la tabla `profesores_cursos`
--
ALTER TABLE `profesores_cursos`
  ADD PRIMARY KEY (`id_profesor_curso`),
  ADD KEY `FK_profesor_curso` (`id_profesor`),
  ADD KEY `FK_curso_profesor` (`id_curso`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  MODIFY `id_asignacion` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  MODIFY `id_calificacion` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id_curso` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  MODIFY `id_estudiante` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id_grupo` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `grupos_cursos`
--
ALTER TABLE `grupos_cursos`
  MODIFY `id_grupo_curso` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `matriculas`
--
ALTER TABLE `matriculas`
  MODIFY `id_matricula` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `profesores`
--
ALTER TABLE `profesores`
  MODIFY `id_profesor` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `profesores_cursos`
--
ALTER TABLE `profesores_cursos`
  MODIFY `id_profesor_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  ADD CONSTRAINT `FK_asig_curso` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_curso`);

--
-- Filtros para la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD CONSTRAINT `FK_calificacion_asig` FOREIGN KEY (`id_asignacion`) REFERENCES `asignaciones` (`id_asignacion`),
  ADD CONSTRAINT `FK_calificacion_est` FOREIGN KEY (`id_estudiante`) REFERENCES `estudiantes` (`id_estudiante`);

--
-- Filtros para la tabla `grupos_cursos`
--
ALTER TABLE `grupos_cursos`
  ADD CONSTRAINT `FK_curso_grupo` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_curso`),
  ADD CONSTRAINT `FK_grupo_curso` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`id_grupo`);

--
-- Filtros para la tabla `matriculas`
--
ALTER TABLE `matriculas`
  ADD CONSTRAINT `FK_estudiante_matricula` FOREIGN KEY (`id_estudiante`) REFERENCES `estudiantes` (`id_estudiante`),
  ADD CONSTRAINT `FK_grupo_matricula` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`id_grupo`);

--
-- Filtros para la tabla `profesores_cursos`
--
ALTER TABLE `profesores_cursos`
  ADD CONSTRAINT `FK_curso_profesor` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_curso`),
  ADD CONSTRAINT `FK_profesor_curso` FOREIGN KEY (`id_profesor`) REFERENCES `profesores` (`id_profesor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
