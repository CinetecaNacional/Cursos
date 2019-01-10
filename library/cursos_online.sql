-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-12-2018 a las 20:28:19
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cursos_online`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `cursos_id` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `descripcion` text COLLATE utf8_bin,
  `disponible` tinyint(1) NOT NULL DEFAULT '1',
  `promocion` decimal(10,2) DEFAULT NULL,
  `fecha_limite_promocion` date DEFAULT NULL,
  `promocion_disponible` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `cursos`
--



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos_usuarios`
--

CREATE TABLE `cursos_usuarios` (
  `usuario_id` int(11) NOT NULL,
  `curso_id` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `fecha_limite_pago` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `contraseña` text COLLATE utf8_bin,
  `link_curso` text COLLATE utf8_bin,
  `vigencia_curso` date DEFAULT NULL,
  `numero_referencia` varchar(19) COLLATE utf8_bin NOT NULL,
  `pago` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `cursos_usuarios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario_id` int(11) NOT NULL,
  `apellido_paterno` varchar(35) COLLATE utf8_bin NOT NULL,
  `apellido_materno` varchar(35) COLLATE utf8_bin NOT NULL,
  `nombre` varchar(35) COLLATE utf8_bin NOT NULL,
  `curp` varchar(18) COLLATE utf8_bin NOT NULL,
  `sexo` varchar(20) COLLATE utf8_bin NOT NULL,
  `fecha_nacimiento` varchar(15) COLLATE utf8_bin NOT NULL,
  `codigo_postal` int(5) NOT NULL,
  `correo_electronico` varchar(50) COLLATE utf8_bin NOT NULL,
  `privilegios` tinyint(1) NOT NULL DEFAULT '0',
  `contraseña` text COLLATE utf8_bin NOT NULL,
  `cuenta` int(11) NOT NULL,
  `registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario_id`, `apellido_paterno`, `apellido_materno`, `nombre`, `curp`, `sexo`, `fecha_nacimiento`, `codigo_postal`, `correo_electronico`, `privilegios`, `contraseña`, `cuenta`, `registro`) VALUES
(1, 'GUERRERO', 'PLACENCIA', 'YAROSLAVA', 'GUPY740311MDFRLR0', 'M', '11/ 03/ 74', 14020, 'yarygp74@gmail.com', 1, 'adivina', 180002, '2018-11-07 09:46:33');

--
-- Disparadores `usuarios`
--
DELIMITER $$
CREATE TRIGGER `before_insert_generar_cuenta` BEFORE INSERT ON `usuarios` FOR EACH ROW BEGIN
  SET @year = YEAR(NOW())-2000;
  SET @consecutivo = (SELECT COUNT(cuenta) FROM usuarios WHERE LEFT(cuenta,2) = @year);
  SET NEW.cuenta  = CONCAT(@YEAR,LPAD(@consecutivo,3,'0'),2);
END
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`cursos_id`);

--
-- Indices de la tabla `cursos_usuarios`
--
ALTER TABLE `cursos_usuarios`
  ADD KEY `curso_id` (`curso_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario_id`),
  ADD UNIQUE KEY `usuario_id` (`usuario_id`),
  ADD UNIQUE KEY `cuenta` (`cuenta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `cursos_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cursos_usuarios`
--
ALTER TABLE `cursos_usuarios`
  ADD CONSTRAINT `cursos_usuarios_ibfk_1` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`cursos_id`),
  ADD CONSTRAINT `cursos_usuarios_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`usuario_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
