-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-01-2023 a las 19:58:44
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cars`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bodywork`
--

CREATE TABLE `bodywork` (
  `cod_bodywork` int(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `img_bodywork` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `bodywork`
--

INSERT INTO `bodywork` (`cod_bodywork`, `description`, `img_bodywork`) VALUES
(1, 'pick up', 'view/img/bodywork/body-pick-up.png'),
(2, 'monovolumen', 'view/img/bodywork/body-monovolumen.png'),
(3, 'familiar', 'view/img/bodywork/body-familiar.png'),
(4, 'coupe', 'view/img/bodywork/body-coupe.png'),
(5, 'cabrio', 'view/img/bodywork/body-cabrio.png'),
(6, 'berlina', 'view/img/bodywork/body-berlina.png'),
(7, '4x4-suv', 'view/img/bodywork/body-4x4-suv.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `brand`
--

CREATE TABLE `brand` (
  `cod_brand` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `img_brand` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `brand`
--

INSERT INTO `brand` (`cod_brand`, `description`, `img_brand`) VALUES
('AUD', 'audi', 'view/img/brand/audi.svg'),
('BMW', 'bmw', 'view/img/brand/bmw.svg'),
('CIT', 'citroen', 'view/img/brand/citroen.svg'),
('FIA', 'fiat', 'view/img/brand/fiat.svg'),
('FRD', 'ford', 'view/img/brand/ford.svg'),
('NSN', 'nissan', 'view/img/brand/nissan.svg'),
('OPL', 'opel', 'view/img/brand/opel.svg'),
('PGT', 'peugeot', 'view/img/brand/peugeot.svg'),
('RNT', 'renault', 'view/img/brand/renault.svg'),
('SEA', 'seat', 'view/img/brand/seat.svg'),
('TYT', 'toyota', 'view/img/brand/toyota.svg'),
('VWG', 'volkswagen', 'view/img/brand/volkswagen.svg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `car`
--

CREATE TABLE `car` (
  `cod_car` int(255) NOT NULL,
  `chassis_number` varchar(255) DEFAULT NULL,
  `license_plate` varchar(255) DEFAULT NULL,
  `km` int(255) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `shifter` varchar(255) DEFAULT NULL,
  `enrollment_date` date DEFAULT NULL,
  `publication_date` date DEFAULT NULL,
  `doors` int(10) DEFAULT NULL,
  `places` int(10) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `trunk_capacity` int(11) DEFAULT NULL,
  `power` int(10) DEFAULT NULL,
  `cod_model` int(255) DEFAULT NULL,
  `zip_code` int(10) DEFAULT NULL,
  `cod_location` int(255) DEFAULT NULL,
  `cod_label` char(100) DEFAULT NULL,
  `cod_fuel` varchar(255) DEFAULT NULL,
  `cod_cylinder` int(255) DEFAULT NULL,
  `cod_bodywork` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `car`
--

INSERT INTO `car` (`cod_car`, `chassis_number`, `license_plate`, `km`, `price`, `shifter`, `enrollment_date`, `publication_date`, `doors`, `places`, `color`, `state`, `trunk_capacity`, `power`, `cod_model`, `zip_code`, `cod_location`, `cod_label`, `cod_fuel`, `cod_cylinder`, `cod_bodywork`) VALUES
(1, '1HGBH41JXMN109186', '1010DGF', 2500, 56000, 'Manual', '2022-05-10', '2023-01-31', 5, 5, 'Negro', 'KM0', 481, 110, 6, 46890, 1, 'C', 'DL', 8, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cars`
--

CREATE TABLE `cars` (
  `id` int(10) UNSIGNED NOT NULL,
  `license_number` varchar(17) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `car_plate` varchar(7) NOT NULL,
  `km` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `comments` varchar(1000) NOT NULL,
  `discharge_date` varchar(10) NOT NULL,
  `color` varchar(1000) NOT NULL,
  `extras` varchar(1000) NOT NULL,
  `car_image` varchar(1000) NOT NULL,
  `price` longtext NOT NULL,
  `doors` int(11) NOT NULL,
  `city` varchar(100) NOT NULL,
  `lat` varchar(1000) NOT NULL,
  `lng` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cars`
--

INSERT INTO `cars` (`id`, `license_number`, `brand`, `model`, `car_plate`, `km`, `category`, `type`, `comments`, `discharge_date`, `color`, `extras`, `car_image`, `price`, `doors`, `city`, `lat`, `lng`) VALUES
(269, '1W2D50JIL04J3L5K1', 'BMW', 'I4', '4567DAB', 25600, 'Utilitario', 'ET', 'Siempre garaje nunca circuito', '2023-01-20', 'negro', 'Sensor aparcamiento:Cargador inalambrico:', 'imageni4', '150000', 4, 'Xativa', '0.56', '1.0'),
(270, '2OUD50JIL04J3L5G6', 'Seat', 'Leon', '2516TRF', 25600, 'Utilitario', 'HB', 'El rey de la discoteca', '2010-01-20', 'amarillo', 'Sensor aparcamiento:Cargador inalambrico:', 'imagenleon', '15000', 4, 'Alzira', '2.5', '-1.0'),
(271, '8P9D50JIL04J3L1H7', 'Porche', 'Panamera', '8526DFG', 22000, 'Compacto', 'ET', 'Ruedas recien cambiadas', '2021-01-20', 'rojo', 'Sensor aparcamiento', 'imagenpanamera', '200000', 5, 'Ontinyent', '-0.56', '1.0'),
(272, '44GD50JIL04J3LH58', 'Range Rover', 'Pajero', '7897PTR', 1500, 'Utilitario', 'ET', 'Coche km cero solo utilizado de muestra', '2022-01-20', 'negro', 'Sensor aparcamiento:', 'imagenpajero', '120000', 5, 'Alcoy', '3', '1.0'),
(273, '3J4750JIL04J3LKP4', 'Opel', 'Astra', '52458RF', 6005, 'Compacto', 'GS', 'No sabe girar', '2015-03-23', 'azul', 'Sensor aparcamiento', 'imagenopelsito', '6500', 5, 'Cocentaina', '0.22', '1.7'),
(274, 'DAF', 'ASDF', 'ADSF', '1234HYA', 0, 'Compacto', 'HB', 'Miguel Bobo', '2022-12-27', 'Mostaza', 'Sensor aparcamiento:Cargador inalambrico:', 'xd', '1', 5, 'Ontiniente', '2', '4');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `car_extras`
--

CREATE TABLE `car_extras` (
  `cod_extra` int(255) NOT NULL,
  `chassis_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `car_extras`
--

INSERT INTO `car_extras` (`cod_extra`, `chassis_number`) VALUES
(3, '1HGBH41JXMN109186'),
(5, '1HGBH41JXMN109186');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cylinder_capacity`
--

CREATE TABLE `cylinder_capacity` (
  `cod_cylinder` int(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `cylinder_capacity`
--

INSERT INTO `cylinder_capacity` (`cod_cylinder`, `description`) VALUES
(1, '1000'),
(2, '1200'),
(3, '1400'),
(4, '1600'),
(5, '1800'),
(6, '1900'),
(7, '2000'),
(8, '2200'),
(9, '2400'),
(10, '2600'),
(11, '2800'),
(12, '3000'),
(13, '3200'),
(14, '3600'),
(15, '3800'),
(16, '4000'),
(17, '4200'),
(18, '4400'),
(19, '4600'),
(20, '4800'),
(21, '5000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `environmental_label`
--

CREATE TABLE `environmental_label` (
  `cod_label` char(100) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `img_label` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `environmental_label`
--

INSERT INTO `environmental_label` (`cod_label`, `description`, `img_label`) VALUES
('B', 'amarilla', 'view/img/environmental_label/b.png'),
('C', 'verde', 'view/img/environmental_label/c.png'),
('CERO', 'azul', 'view/img/environmental_label/0.png'),
('ECO', 'azul/verde', 'view/img/environmental_label/e.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `extras`
--

CREATE TABLE `extras` (
  `cod_extras` int(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `extras`
--

INSERT INTO `extras` (`cod_extras`, `description`) VALUES
(1, 'Sistema de frenado automático'),
(2, 'Camara de aparcamiento trasera'),
(3, 'Camara de aparcamiento delantera'),
(4, 'Climatización bizona'),
(5, 'Aparcar con manos libres'),
(6, 'Luces automaticas'),
(7, 'Asientos calefactables'),
(8, 'Tapiceria de cuero'),
(9, 'Kit de altavoces Bose'),
(10, 'Rueda de repuesto'),
(11, 'Kit de pinchazos'),
(12, 'Luces adaptativas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fuel`
--

CREATE TABLE `fuel` (
  `cod_fuel` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `img_fuel` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `fuel`
--

INSERT INTO `fuel` (`cod_fuel`, `description`, `img_fuel`) VALUES
('CNG', 'gas natural', 'gas-natural.jpg'),
('DL', 'diesel', 'diesel.jpg'),
('EL', 'eléctrico', 'electrico.jpg'),
('GLP', 'gas licuado', 'gas-licuado.jpg'),
('GS', 'gasolina', 'gasolina.jpg'),
('HB', 'híbrido', 'hibrido.jpg'),
('HE', 'híbrido enchufable', 'hibrido-enchfable.jpg'),
('OT', 'otros', 'otros.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `image`
--

CREATE TABLE `image` (
  `cod_image` int(255) NOT NULL,
  `url_image` varchar(255) DEFAULT NULL,
  `chassis_number` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `image`
--

INSERT INTO `image` (`cod_image`, `url_image`, `chassis_number`) VALUES
(1, 'view/img/car_image/tcros1.png', '1HGBH41JXMN109186'),
(2, 'view/img/car_image/tcros2.png', '1HGBH41JXMN109186');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `location`
--

CREATE TABLE `location` (
  `cod_location` int(255) NOT NULL,
  `lat` float DEFAULT NULL,
  `lon` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `location`
--

INSERT INTO `location` (`cod_location`, `lat`, `lon`) VALUES
(1, 38.8228, -0.548253);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model`
--

CREATE TABLE `model` (
  `cod_model` int(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `cod_brand` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `model`
--

INSERT INTO `model` (`cod_model`, `description`, `cod_brand`) VALUES
(3, 'TROC', 'VWG'),
(4, 'ARTEON', 'VWG'),
(5, 'GOLF', 'VWG'),
(6, 'TCROSS', 'VWG'),
(7, 'TAIGO', 'VWG'),
(8, 'TIGUAN', 'VWG');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `population`
--

CREATE TABLE `population` (
  `zip_code` int(10) NOT NULL,
  `description` char(100) DEFAULT NULL,
  `cod_province` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `population`
--

INSERT INTO `population` (`zip_code`, `description`, `cod_province`) VALUES
(19442, 'Ablanque', 23),
(22440, 'Benasque', 25),
(24413, 'Molinaseca', 30),
(27240, 'Meira', 32),
(28931, 'Mostoles', 33),
(44413, 'Valdenirares', 47),
(46870, 'Ontinyent', 49),
(46890, 'Agullent', 49);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `province`
--

CREATE TABLE `province` (
  `cod_province` int(100) NOT NULL,
  `description` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `province`
--

INSERT INTO `province` (`cod_province`, `description`) VALUES
(1, 'A Coruña'),
(2, 'Alacant'),
(3, 'Albacete'),
(4, 'Almería'),
(5, 'Álava'),
(6, 'Asturias'),
(7, 'Ávila'),
(8, 'Badajoz'),
(9, 'Barcelona'),
(10, 'Vizcaya'),
(11, 'Burgos'),
(12, 'Cáceres'),
(13, 'Cádiz'),
(14, 'Cantabria'),
(15, 'Castellón'),
(16, 'Ceuta'),
(17, 'Ciudad Real'),
(18, 'Córdoba'),
(19, 'Cuenca'),
(20, 'Guipúzcua'),
(21, 'Girona'),
(22, 'Granada'),
(23, 'Guadalajara'),
(24, 'Huelva'),
(25, 'Huesca'),
(26, 'Islas Baleares'),
(27, 'Jaén'),
(28, 'La Rioja'),
(29, 'Las Palmas'),
(30, 'León'),
(31, 'Lleida'),
(32, 'Luego'),
(33, 'Madrid'),
(34, 'Málaga'),
(35, 'Melilla'),
(36, 'Murcia'),
(37, 'Navarra'),
(38, 'Ourense'),
(39, 'Palencia'),
(40, 'Pontevedra'),
(41, 'Salamanca'),
(42, 'Santa Cruz De Tenerige'),
(43, 'Segovia'),
(44, 'Sevilla'),
(45, 'Soria'),
(46, 'Tarragona'),
(47, 'Teruel'),
(48, 'Toledo'),
(49, 'Valencia'),
(50, 'Valladolid'),
(51, 'Zamora'),
(52, 'Zaragoza');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bodywork`
--
ALTER TABLE `bodywork`
  ADD PRIMARY KEY (`cod_bodywork`);

--
-- Indices de la tabla `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`cod_brand`);

--
-- Indices de la tabla `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`cod_car`),
  ADD UNIQUE KEY `chassis_number` (`chassis_number`),
  ADD UNIQUE KEY `license_plate` (`license_plate`),
  ADD KEY `cod_cylinder` (`cod_cylinder`),
  ADD KEY `cod_fuel` (`cod_fuel`),
  ADD KEY `cod_label` (`cod_label`),
  ADD KEY `cod_location` (`cod_location`),
  ADD KEY `cod_model` (`cod_model`),
  ADD KEY `zip_code` (`zip_code`),
  ADD KEY `cod_bodywork` (`cod_bodywork`);

--
-- Indices de la tabla `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `num_bastidor` (`license_number`);

--
-- Indices de la tabla `car_extras`
--
ALTER TABLE `car_extras`
  ADD PRIMARY KEY (`cod_extra`,`chassis_number`);

--
-- Indices de la tabla `cylinder_capacity`
--
ALTER TABLE `cylinder_capacity`
  ADD PRIMARY KEY (`cod_cylinder`),
  ADD UNIQUE KEY `description` (`description`);

--
-- Indices de la tabla `environmental_label`
--
ALTER TABLE `environmental_label`
  ADD PRIMARY KEY (`cod_label`);

--
-- Indices de la tabla `extras`
--
ALTER TABLE `extras`
  ADD PRIMARY KEY (`cod_extras`);

--
-- Indices de la tabla `fuel`
--
ALTER TABLE `fuel`
  ADD PRIMARY KEY (`cod_fuel`);

--
-- Indices de la tabla `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`cod_image`),
  ADD KEY `chassis_number` (`chassis_number`);

--
-- Indices de la tabla `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`cod_location`);

--
-- Indices de la tabla `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`cod_model`),
  ADD KEY `cod_brand` (`cod_brand`);

--
-- Indices de la tabla `population`
--
ALTER TABLE `population`
  ADD PRIMARY KEY (`zip_code`),
  ADD KEY `FK_cod_province` (`cod_province`);

--
-- Indices de la tabla `province`
--
ALTER TABLE `province`
  ADD PRIMARY KEY (`cod_province`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bodywork`
--
ALTER TABLE `bodywork`
  MODIFY `cod_bodywork` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `car`
--
ALTER TABLE `car`
  MODIFY `cod_car` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=275;

--
-- AUTO_INCREMENT de la tabla `cylinder_capacity`
--
ALTER TABLE `cylinder_capacity`
  MODIFY `cod_cylinder` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `extras`
--
ALTER TABLE `extras`
  MODIFY `cod_extras` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `image`
--
ALTER TABLE `image`
  MODIFY `cod_image` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `location`
--
ALTER TABLE `location`
  MODIFY `cod_location` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `model`
--
ALTER TABLE `model`
  MODIFY `cod_model` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `car`
--
ALTER TABLE `car`
  ADD CONSTRAINT `car_ibfk_2` FOREIGN KEY (`cod_cylinder`) REFERENCES `cylinder_capacity` (`cod_cylinder`),
  ADD CONSTRAINT `car_ibfk_3` FOREIGN KEY (`cod_fuel`) REFERENCES `fuel` (`cod_fuel`),
  ADD CONSTRAINT `car_ibfk_4` FOREIGN KEY (`cod_label`) REFERENCES `environmental_label` (`cod_label`),
  ADD CONSTRAINT `car_ibfk_5` FOREIGN KEY (`cod_location`) REFERENCES `location` (`cod_location`),
  ADD CONSTRAINT `car_ibfk_6` FOREIGN KEY (`cod_model`) REFERENCES `model` (`cod_model`),
  ADD CONSTRAINT `car_ibfk_7` FOREIGN KEY (`zip_code`) REFERENCES `population` (`zip_code`),
  ADD CONSTRAINT `car_ibfk_8` FOREIGN KEY (`cod_bodywork`) REFERENCES `bodywork` (`cod_bodywork`);

--
-- Filtros para la tabla `car_extras`
--
ALTER TABLE `car_extras`
  ADD CONSTRAINT `car_extras_ibfk_1` FOREIGN KEY (`chassis_number`) REFERENCES `car` (`chassis_number`),
  ADD CONSTRAINT `car_extras_ibfk_2` FOREIGN KEY (`cod_extra`) REFERENCES `extras` (`cod_extras`);

--
-- Filtros para la tabla `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`chassis_number`) REFERENCES `car` (`chassis_number`);

--
-- Filtros para la tabla `model`
--
ALTER TABLE `model`
  ADD CONSTRAINT `model_ibfk_1` FOREIGN KEY (`cod_brand`) REFERENCES `brand` (`cod_brand`);

--
-- Filtros para la tabla `population`
--
ALTER TABLE `population`
  ADD CONSTRAINT `FK_cod_province` FOREIGN KEY (`cod_province`) REFERENCES `province` (`cod_province`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
