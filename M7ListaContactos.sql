-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Temps de generació: 05-05-2023 a les 09:27:43
-- Versió del servidor: 10.4.24-MariaDB
-- Versió de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de dades: `M7ListaContactos`
--

-- --------------------------------------------------------

--
-- Estructura de la taula `contactos`
--

CREATE TABLE `contactos` (
  `id_contacto` int(11) NOT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `numero` int(9) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `direccion` varchar(30) DEFAULT NULL,
  `favorito` tinyint(1) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de la taula `contactos_grupos`
--

CREATE TABLE `contactos_grupos` (
  `id_contacto` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de la taula `grupos`
--

CREATE TABLE `grupos` (
  `id_grupo` int(11) NOT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `num_miembros` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Bolcament de dades per a la taula `grupos`
--

INSERT INTO `grupos` (`id_grupo`, `nombre`, `num_miembros`) VALUES
(1, 'Familia', 0),
(2, 'Amigos', 0);

-- --------------------------------------------------------

--
-- Estructura de suport per a vistes `mostrar_fav`
-- (mireu a sota per a la visualització real)
--
CREATE TABLE `mostrar_fav` (
`nombre` varchar(20)
,`numero` int(9)
,`email` varchar(30)
,`direccion` varchar(30)
,`favorito` tinyint(1)
,`id_usuario` int(11)
);

-- --------------------------------------------------------

--
-- Estructura de la taula `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(20) DEFAULT NULL,
  `contraseña` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Bolcament de dades per a la taula `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre_usuario`, `contraseña`) VALUES
(1, 'Pepe', '123'),
(2, 'fran', '123');

-- --------------------------------------------------------

--
-- Estructura per a vista `mostrar_fav`
--
DROP TABLE IF EXISTS `mostrar_fav`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `mostrar_fav`  AS SELECT `contactos`.`nombre` AS `nombre`, `contactos`.`numero` AS `numero`, `contactos`.`email` AS `email`, `contactos`.`direccion` AS `direccion`, `contactos`.`favorito` AS `favorito`, `contactos`.`id_usuario` AS `id_usuario` FROM `contactos` WHERE `contactos`.`favorito` = 11  ;

--
-- Índexs per a les taules bolcades
--

--
-- Índexs per a la taula `contactos`
--
ALTER TABLE `contactos`
  ADD PRIMARY KEY (`id_contacto`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índexs per a la taula `contactos_grupos`
--
ALTER TABLE `contactos_grupos`
  ADD PRIMARY KEY (`id_contacto`,`id_grupo`),
  ADD KEY `id_grupo` (`id_grupo`);

--
-- Índexs per a la taula `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id_grupo`);

--
-- Índexs per a la taula `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT per les taules bolcades
--

--
-- AUTO_INCREMENT per la taula `contactos`
--
ALTER TABLE `contactos`
  MODIFY `id_contacto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- Restriccions per a les taules bolcades
--

--
-- Restriccions per a la taula `contactos`
--
ALTER TABLE `contactos`
  ADD CONSTRAINT `contactos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Restriccions per a la taula `contactos_grupos`
--
ALTER TABLE `contactos_grupos`
  ADD CONSTRAINT `contactos_grupos_ibfk_1` FOREIGN KEY (`id_contacto`) REFERENCES `contactos` (`id_contacto`),
  ADD CONSTRAINT `contactos_grupos_ibfk_2` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`id_grupo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
