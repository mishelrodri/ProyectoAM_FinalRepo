-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-10-2021 a las 16:09:17
-- Versión del servidor: 10.1.40-MariaDB
-- Versión de PHP: 7.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda_anime`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idcategoria` varchar(50) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idcategoria`, `nombre`) VALUES
('20212614265800000058-2', 'nueva'),
('2147483647', 'plastico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleventa`
--

CREATE TABLE `detalleventa` (
  `iddetalle` varchar(50) NOT NULL,
  `idventa` varchar(50) DEFAULT NULL,
  `idproducto` varchar(50) DEFAULT NULL,
  `cantidad` int(20) DEFAULT NULL,
  `monto` double(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalleventa`
--

INSERT INTO `detalleventa` (`iddetalle`, `idventa`, `idproducto`, `cantidad`, `monto`) VALUES
('20210020003700000037-5', '20210020003700000037-25', '20214714475100000051-1', 8, 8.00),
('20210020003700000037-6', '20210020003700000037-25', '20214714475100000051-1', 4, 4.00),
('20210620063500000035-7', '20210620063500000035-26', '20214714475100000051-1', 250, 250.00),
('20210620063500000035-8', '20210620063500000035-26', '20214714475100000051-1', 250, 250.00),
('20211220123700000037-9', '20211220123700000037-27', '20214714475100000051-1', 5555, 55555.00),
('20211420143600000036-10', '20211420143600000036-28', '20214714475100000051-1', 77, 77.00),
('20215320531300000013-1', '20215320531300000013-21', '20214714475100000051-1', 0, 0.00),
('20215420540300000003-2', '20215420540300000003-22', '20214714475100000051-1', 20, 0.00),
('20215420544000000040-3', '20215420544000000040-23', '20214714475100000051-1', 20, 5.00),
('20215720573400000034-4', '20215720573300000033-24', '20214714475100000051-1', 8, 9.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idproducto` varchar(50) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `stock` int(255) DEFAULT NULL,
  `precio` double(8,2) DEFAULT NULL,
  `idcategoria` varchar(50) DEFAULT NULL,
  `dimension` varchar(255) DEFAULT NULL,
  `color` int(20) DEFAULT NULL,
  `material` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idproducto`, `nombre`, `stock`, `precio`, `idcategoria`, `dimension`, `color`, `material`) VALUES
('20214714475100000051-1', ' Katsuki de My Hero Academia', 25, 30.99, '2147483647', '6 x 15.2 x 25.4 centímetros', 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT 'llave de la tabla',
  `id_persona` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT 'relacion con tb_persona',
  `usuario` varchar(20) CHARACTER SET utf8 NOT NULL COMMENT 'usuario de la persona (unico)',
  `contrasena` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'contraseña de la persona (será un hash)'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `id_persona`, `usuario`, `contrasena`) VALUES
('20213113312200000022-1', '20213113312200000022-2', 'mishel', '$2y$10$8iCxsf5qSXAT1fg8VVF3u.1CjD6Z3o04KaxTVBrf9qctdybn/r8pq'),
('20213215321100000011-2', '20213215321100000011-3', 'hola', '$2y$10$vIIYPEaENuq2LR9eE8WCVu8fzNR0wCWDs3GG6wVqlEKoxxhFzCpkC'),
('20215121513400000034-3', '20215121513400000034-4', 'kely', '$2y$10$cgfhbMJK5RJyvWpTLcDS8.UQGMgGsfK5J9cAExbfvKgv1ttIJd3Cy');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `idventa` varchar(50) NOT NULL,
  `fechaventa` date DEFAULT NULL,
  `id` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT 'llame de la tabla'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`idventa`, `fechaventa`, `id`) VALUES
('20210020003700000037-25', '2021-10-20', '20213113312200000022-2'),
('20210219021700000017-1', '2021-10-19', '20213113312200000022-2'),
('20210620063500000035-26', '2021-10-20', '20213113312200000022-2'),
('20211019104100000041-2', '2021-10-19', '20213113312200000022-2'),
('20211219120400000004-3', '2021-10-19', '20213113312200000022-2'),
('20211220123700000037-27', '2021-10-20', '20213113312200000022-2'),
('20211419145600000056-4', '2021-10-19', '20213113312200000022-2'),
('20211420140100000001-7', '2021-10-20', '20213113312200000022-2'),
('20211420143600000036-28', '2021-10-20', '20213113312200000022-2'),
('20211420145600000056-8', '2021-10-20', '20213113312200000022-2'),
('20211719174700000047-5', '2021-10-19', '20213113312200000022-2'),
('20211720172600000026-9', '2021-10-20', '20213113312200000022-2'),
('20211820185400000054-10', '2021-10-20', '20213113312200000022-2'),
('20212620260600000006-11', '2021-10-20', '20213113312200000022-2'),
('20212620265800000058-12', '2021-10-20', '20213113312200000022-2'),
('20212720273600000036-13', '2021-10-20', '20213113312200000022-2'),
('20212820284100000041-14', '2021-10-20', '20213113312200000022-2'),
('20213019302700000027-6', '2021-10-19', '20213113312200000022-2'),
('20213220325600000056-15', '2021-10-20', '20213113312200000022-2'),
('20213520355300000053-16', '2021-10-20', '20213113312200000022-2'),
('20213820383200000032-17', '2021-10-20', '20213113312200000022-2'),
('20213820385700000057-18', '2021-10-20', '20213113312200000022-2'),
('20215120511800000018-19', '2021-10-20', '20213113312200000022-2'),
('20215220522100000021-20', '2021-10-20', '20213113312200000022-2'),
('20215320531300000013-21', '2021-10-20', '20213113312200000022-2'),
('20215420540300000003-22', '2021-10-20', '20213113312200000022-2'),
('20215420544000000040-23', '2021-10-20', '20213113312200000022-2'),
('20215720573300000033-24', '2021-10-20', '20213113312200000022-2');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idcategoria`);

--
-- Indices de la tabla `detalleventa`
--
ALTER TABLE `detalleventa`
  ADD PRIMARY KEY (`iddetalle`),
  ADD KEY `fk_producto` (`idproducto`),
  ADD KEY `fk_venta` (`idventa`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idproducto`),
  ADD KEY `fk_cate` (`idcategoria`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `fk_persona` (`id_persona`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`idventa`),
  ADD KEY `fk_emple` (`id`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalleventa`
--
ALTER TABLE `detalleventa`
  ADD CONSTRAINT `fk_producto` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`),
  ADD CONSTRAINT `fk_venta` FOREIGN KEY (`idventa`) REFERENCES `venta` (`idventa`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_cate` FOREIGN KEY (`idcategoria`) REFERENCES `categoria` (`idcategoria`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_persona` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id`);

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `fk_emple` FOREIGN KEY (`id`) REFERENCES `persona` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
