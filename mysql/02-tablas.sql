-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-04-2019 a las 19:44:58
-- Versión del servidor: 10.1.35-MariaDB
-- Versión de PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mychustergames`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `id` int(11) NOT NULL,
  `idProd` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `texto_coment` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticia`
--

CREATE TABLE `noticia` (
  `id` int(11) NOT NULL,
  `titular` varchar(40) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `cuerpo` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `nombreProd` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `puntos` int(10) NOT NULL DEFAULT '0',
  `descript` text COLLATE utf8_spanish_ci NOT NULL,
  `edad` int(10) NOT NULL DEFAULT '0',
  `jugadores` int(10) NOT NULL DEFAULT '0',
  `link` text COLLATE utf8_spanish_ci NOT NULL,
  `empresa` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `num_votaciones` int(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `nombreProd`, `puntos`, `descript`, `edad`, `jugadores`, `link`, `empresa`, `num_votaciones`) VALUES
(0, 'carnival zombie', 8, '\r\nLos manuscritos antiguos hablan de un Leviatán, una enorme criatura que yace en el lecho de la laguna en la parte posterior de la cual la ciudad tiene sus cimientos. Todos los manuscritos coinciden en su sueño eterno y todos dicen que la bestia se despertará un día, sacudiendo la ciudad de sus raíces embarradas, rompiendo los pilotes vitrificados sobre los cuales se encuentra la ciudad, y estrellándola contra el mar hirviente donde el monstruo se levantará . ', 12, 4, 'https://www.google.com', 'Zombies SA', 7),
(1, 'TeotiHuacan City Of Gods', 7, '\r\nEn Teotihuacan: Ciudad de los Dioses, cada jugador controla una fuerza de dados de trabajadores, que crecen en fuerza con cada movimiento. En su turno, mueve a un trabajador alrededor de una tabla modular, siempre eligiendo una de las dos áreas del mosaico de ubicación en el que se encuentra: una que le ofrece una acción (y una mejora de trabajador), la otra que le proporciona una bonificación poderosa (pero sin una actualización).', 6, 4, 'https://www.tuenti.com', 'Tuenti SA', 11),
(2, 'root', 0, 'La infame Marquesa de Gato se ha apoderado del gran bosque, con la intención de cosechar sus riquezas. Bajo su gobierno, las muchas criaturas del bosque se han unido. Esta Alianza buscará fortalecer sus recursos y subvertir la regla de los Gatos. En este esfuerzo, la Alianza puede contar con la ayuda de los vagabundos errantes que pueden moverse a través de los caminos más peligrosos del bosque.', 5, 6, 'https://www.amazon.com/', 'Amazon SA', 0),
(3, 'lolita lola', 6, 'Este es otro producto que sirve como prueba', 3, 5, 'https://www.a.com', 'MyChuster SA', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `torneo`
--

CREATE TABLE `torneo` (
  `idTourn` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `tipoTorneo` varchar(20) NOT NULL,
  `idJuego` int(11) NOT NULL,
  `Puntuacion` int(20) NOT NULL,
  `dia_ganado` date NOT NULL,
  `esMensual` tinyint(1) NOT NULL DEFAULT '0',
  `esViernes` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `torneo`
--

INSERT INTO `torneo` (`idTourn`, `idUsuario`, `tipoTorneo`, `idJuego`, `Puntuacion`, `dia_ganado`, `esMensual`, `esViernes`) VALUES
(1, 5, 'Viernes', 0, 7, '2019-04-08', 0, 1),
(2, 4, 'Normal', 3, 7, '2019-03-15', 0, 0),
(3, 6, 'Mensual', 1, 7, '2019-02-14', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `torneos_disp`
--

CREATE TABLE `torneos_disp` (
  `id` int(11) NOT NULL,
  `idJuego` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `torneos_disp`
--

INSERT INTO `torneos_disp` (`id`, `idJuego`, `fecha`) VALUES
(1, 2, '2019-04-01'),
(2, 3, '2019-04-04'),
(3, 0, '2019-04-20'),
(4, 3, '2019-04-15'),
(5, 2, '2019-04-12'),
(6, 3, '2019-04-28'),
(7, 1, '2019-04-25'),
(8, 0, '2019-04-17'),
(9, 1, '2019-04-18'),
(10, 2, '2019-04-21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `torneo_jugando`
--

CREATE TABLE `torneo_jugando` (
  `id` int(11) NOT NULL,
  `jugadores_total` int(20) NOT NULL,
  `id_jugad_jugan` int(11) NOT NULL,
  `idJuego` int(11) NOT NULL,
  `esViernes` tinyint(1) NOT NULL DEFAULT '0',
  `esMensual` tinyint(1) NOT NULL DEFAULT '0',
  `dia_jugado` date NOT NULL,
  `puntos` int(10) NOT NULL DEFAULT '0',
  `ronda` varchar(40) NOT NULL DEFAULT 'clasificacion'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `torneo_jugando`
--

INSERT INTO `torneo_jugando` (`id`, `jugadores_total`, `id_jugad_jugan`, `idJuego`, `esViernes`, `esMensual`, `dia_jugado`, `puntos`, `ronda`) VALUES
(1, 1, 1, 1, 0, 0, '2019-04-09', 2, 'semis'),
(2, 1, 2, 1, 0, 0, '2019-04-09', 2, 'semis'),
(6, 1, 6, 2, 0, 0, '2019-04-15', 5, 'semis'),
(7, 1, 7, 2, 0, 0, '2019-04-15', 2, 'semis'),
(8, 1, 5, 2, 0, 0, '2019-04-20', 5, 'semis'),
(9, 1, 4, 2, 0, 0, '2019-04-15', 7, 'final'),
(10, 0, 1, 2, 0, 0, '2019-04-15', 2, 'final'),
(11, 0, 3, 2, 0, 0, '2019-04-15', 2, 'clasificacion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombreUsuario` varchar(15) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `password` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `ptosForum` int(10) DEFAULT '0',
  `ptosProd` int(10) DEFAULT '0',
  `ptosTourn` int(10) DEFAULT '0',
  `avatar` varchar(20) NOT NULL,
  `rol` varchar(10) NOT NULL DEFAULT 'user',
  `descrip` text,
  `cumple` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombreUsuario`, `nombre`, `password`, `email`, `ptosForum`, `ptosProd`, `ptosTourn`, `avatar`, `rol`, `descrip`, `cumple`) VALUES
(1, 'Chuster', 'Chuster Garcia', '$2y$10$.iJf.qUonY.Im9nM419W6eKWw0.q43ChW7maLJ3J/turPzzctyZ8O', 'chuster@gmail.com', 0, 0, 20, '', 'admin', 'Soy una persona meramente interesante', '1995-05-23'),
(2, 'Lolito', 'Lolito Lopez', '$2y$10$.iJf.qUonY.Im9nM419W6eKWw0.q43ChW7maLJ3J/turPzzctyZ8O', 'lolito@gmail.com', 0, 0, 81, '', 'user', 'asdkasjd lasjk lk jasdlkjas dlj dlkjasldjk aldkjas dlkasj dlkasj dlakjd laskjd lsakjdsalkdjsadjhfjkhas kljasd ', '2016-11-15'),
(3, 'Usuario2', 'Segundo Usuario', '$2y$10$.iJf.qUonY.Im9nM419W6eKWw0.q43ChW7maLJ3J/turPzzctyZ8O', 'user_dos@gmail.com', 0, 0, 0, '', 'user', 'Es un usuario de prueba para tener en cuenta', '1995-05-23'),
(4, 'Victor', 'Victor Manual Marta', '$2y$10$.iJf.qUonY.Im9nM419W6eKWw0.q43ChW7maLJ3J/turPzzctyZ8O', 'thevtc@gmail.com', 20, 7, 30, '', 'admin', 'Soy un persona bien alta, no lo quiero decir pero creo que es costilla de la edad.', '1998-05-18'),
(5, 'Dani', 'Daniel Lamana Gemma', '$2y$10$.iJf.qUonY.Im9nM419W6eKWw0.q43ChW7maLJ3J/turPzzctyZ8O', 'danonino@gmail.com', 45, 12, 28, '', 'admin', NULL, NULL),
(6, 'Rita', 'Rita LaCantaora Canario', '$2y$10$.iJf.qUonY.Im9nM419W6eKWw0.q43ChW7maLJ3J/turPzzctyZ8O', 'ritaestenovez@gmail.com', 22, 46, 18, '', 'admin', 'Hola muyayos soy diseñadora web', '1975-07-26'),
(7, 'Miguel', 'Miguel Murciano Atope', '$2y$10$.iJf.qUonY.Im9nM419W6eKWw0.q43ChW7maLJ3J/turPzzctyZ8O', 'martelldelamesa@gmail.com', 5, 15, 75, '', 'admin', 'Acho soy yo el Miguel, ¿nos echamos un PhotoRoullette?', '1962-09-13');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comentario_FK1` (`idProd`),
  ADD KEY `comentario_FK2` (`idUsuario`);

--
-- Indices de la tabla `noticia`
--
ALTER TABLE `noticia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`nombreProd`);

--
-- Indices de la tabla `torneo`
--
ALTER TABLE `torneo`
  ADD PRIMARY KEY (`idTourn`),
  ADD KEY `torneo_ibfk_1` (`idJuego`),
  ADD KEY `torneo_ibfk_2` (`idUsuario`);

--
-- Indices de la tabla `torneos_disp`
--
ALTER TABLE `torneos_disp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `JuegoDisp_FK` (`idJuego`);

--
-- Indices de la tabla `torneo_jugando`
--
ALTER TABLE `torneo_jugando`
  ADD PRIMARY KEY (`id`),
  ADD KEY `torneo_jugdFK1` (`idJuego`),
  ADD KEY `torneo_jugdFK2` (`id_jugad_jugan`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombreUsuario` (`nombreUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `noticia`
--
ALTER TABLE `noticia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `torneo`
--
ALTER TABLE `torneo`
  MODIFY `idTourn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `torneos_disp`
--
ALTER TABLE `torneos_disp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `torneo_jugando`
--
ALTER TABLE `torneo_jugando`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_FK1` FOREIGN KEY (`idProd`) REFERENCES `producto` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `comentario_FK2` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `torneo`
--
ALTER TABLE `torneo`
  ADD CONSTRAINT `torneo_ibfk_1` FOREIGN KEY (`idJuego`) REFERENCES `producto` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `torneo_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `torneos_disp`
--
ALTER TABLE `torneos_disp`
  ADD CONSTRAINT `JuegoDisp_FK` FOREIGN KEY (`idJuego`) REFERENCES `producto` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `torneo_jugando`
--
ALTER TABLE `torneo_jugando`
  ADD CONSTRAINT `torneo_jugdFK1` FOREIGN KEY (`idJuego`) REFERENCES `producto` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `torneo_jugdFK2` FOREIGN KEY (`id_jugad_jugan`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
