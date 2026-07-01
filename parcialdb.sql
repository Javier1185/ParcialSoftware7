-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2026 at 07:47 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parcialdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `cat_ocupaciones`
--

CREATE TABLE `cat_ocupaciones` (
  `id_ocupacion` int(11) NOT NULL,
  `nombre_ocupacion` varchar(100) NOT NULL,
  `estado_ocupacion` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `cat_ocupaciones`
--

INSERT INTO `cat_ocupaciones` (`id_ocupacion`, `nombre_ocupacion`, `estado_ocupacion`) VALUES
(1, 'Analista de Sistemas', 1),
(2, 'Desarrollador de Software', 1),
(3, 'Soporte Técnico', 1),
(4, 'Coordinador de Proyectos', 1),
(5, 'Recursos Humanos', 1),
(6, 'Auxiliar Administrativo', 1),
(7, 'Supervisor de Operaciones', 1),
(8, 'Gerente de Contrataciones', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cat_rutas`
--

CREATE TABLE `cat_rutas` (
  `id_ruta` int(11) NOT NULL,
  `nombre_ruta` varchar(50) NOT NULL,
  `estado_ruta` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `cat_rutas`
--

INSERT INTO `cat_rutas` (`id_ruta`, `nombre_ruta`, `estado_ruta`) VALUES
(1, 'Panamá Este', 1),
(2, 'Panamá Oeste', 1),
(3, 'Panamá Norte', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cat_sexo`
--

CREATE TABLE `cat_sexo` (
  `id_sexo` int(11) NOT NULL,
  `nombre_sexo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `cat_sexo`
--

INSERT INTO `cat_sexo` (`id_sexo`, `nombre_sexo`) VALUES
(2, 'Femenino'),
(1, 'Masculino');

-- --------------------------------------------------------

--
-- Table structure for table `cat_tipos_planilla`
--

CREATE TABLE `cat_tipos_planilla` (
  `id_tipo_planilla` int(11) NOT NULL,
  `nombre_tipo_planilla` varchar(30) NOT NULL,
  `estado_tipo_planilla` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `cat_tipos_planilla`
--

INSERT INTO `cat_tipos_planilla` (`id_tipo_planilla`, `nombre_tipo_planilla`, `estado_tipo_planilla`) VALUES
(1, 'Eventual', 1),
(2, 'Permanente', 1),
(3, 'Interino', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cat_tipos_sangre`
--

CREATE TABLE `cat_tipos_sangre` (
  `id_tipo_sangre` int(11) NOT NULL,
  `nombre_tipo_sangre` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `cat_tipos_sangre`
--

INSERT INTO `cat_tipos_sangre` (`id_tipo_sangre`, `nombre_tipo_sangre`) VALUES
(2, 'A-'),
(1, 'A+'),
(6, 'AB-'),
(5, 'AB+'),
(4, 'B-'),
(3, 'B+'),
(8, 'O-'),
(7, 'O+');

-- --------------------------------------------------------

--
-- Table structure for table `colaboradores`
--

CREATE TABLE `colaboradores` (
  `codigo_empleado` int(11) NOT NULL,
  `identidad` varchar(20) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `apellido` varchar(80) NOT NULL,
  `edad` tinyint(3) UNSIGNED NOT NULL,
  `id_tipo_sangre` int(11) NOT NULL,
  `id_sexo` int(11) NOT NULL,
  `nacionalidad` varchar(60) NOT NULL,
  `id_ruta` int(11) NOT NULL,
  `correo_electronico` varchar(120) NOT NULL,
  `celular` varchar(20) NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `perfiles_laborales`
--

CREATE TABLE `perfiles_laborales` (
  `id_perfil` int(11) NOT NULL,
  `codigo_empleado` int(11) NOT NULL,
  `id_ocupacion` int(11) NOT NULL,
  `id_tipo_planilla` int(11) NOT NULL,
  `salario` decimal(10,2) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date DEFAULT NULL,
  `cargo_activo` tinyint(1) NOT NULL DEFAULT 1,
  `empleado_activo` tinyint(1) NOT NULL DEFAULT 1,
  `motivo_baja` varchar(255) DEFAULT NULL,
  `firma_digital` text DEFAULT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT current_timestamp()
) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cat_ocupaciones`
--
ALTER TABLE `cat_ocupaciones`
  ADD PRIMARY KEY (`id_ocupacion`),
  ADD UNIQUE KEY `nombre_ocupacion` (`nombre_ocupacion`);

--
-- Indexes for table `cat_rutas`
--
ALTER TABLE `cat_rutas`
  ADD PRIMARY KEY (`id_ruta`),
  ADD UNIQUE KEY `nombre_ruta` (`nombre_ruta`);

--
-- Indexes for table `cat_sexo`
--
ALTER TABLE `cat_sexo`
  ADD PRIMARY KEY (`id_sexo`),
  ADD UNIQUE KEY `nombre_sexo` (`nombre_sexo`);

--
-- Indexes for table `cat_tipos_planilla`
--
ALTER TABLE `cat_tipos_planilla`
  ADD PRIMARY KEY (`id_tipo_planilla`),
  ADD UNIQUE KEY `nombre_tipo_planilla` (`nombre_tipo_planilla`);

--
-- Indexes for table `cat_tipos_sangre`
--
ALTER TABLE `cat_tipos_sangre`
  ADD PRIMARY KEY (`id_tipo_sangre`),
  ADD UNIQUE KEY `nombre_tipo_sangre` (`nombre_tipo_sangre`);

--
-- Indexes for table `colaboradores`
--
ALTER TABLE `colaboradores`
  ADD PRIMARY KEY (`codigo_empleado`),
  ADD UNIQUE KEY `identidad` (`identidad`),
  ADD UNIQUE KEY `correo_electronico` (`correo_electronico`),
  ADD KEY `fk_colaborador_tipo_sangre` (`id_tipo_sangre`),
  ADD KEY `fk_colaborador_sexo` (`id_sexo`),
  ADD KEY `fk_colaborador_ruta` (`id_ruta`);

--
-- Indexes for table `perfiles_laborales`
--
ALTER TABLE `perfiles_laborales`
  ADD PRIMARY KEY (`id_perfil`),
  ADD KEY `fk_perfil_ocupacion` (`id_ocupacion`),
  ADD KEY `fk_perfil_tipo_planilla` (`id_tipo_planilla`),
  ADD KEY `idx_perfil_codigo_empleado` (`codigo_empleado`),
  ADD KEY `idx_perfil_cargo_activo` (`cargo_activo`),
  ADD KEY `idx_perfil_empleado_activo` (`empleado_activo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cat_ocupaciones`
--
ALTER TABLE `cat_ocupaciones`
  MODIFY `id_ocupacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cat_rutas`
--
ALTER TABLE `cat_rutas`
  MODIFY `id_ruta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cat_sexo`
--
ALTER TABLE `cat_sexo`
  MODIFY `id_sexo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cat_tipos_planilla`
--
ALTER TABLE `cat_tipos_planilla`
  MODIFY `id_tipo_planilla` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cat_tipos_sangre`
--
ALTER TABLE `cat_tipos_sangre`
  MODIFY `id_tipo_sangre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `colaboradores`
--
ALTER TABLE `colaboradores`
  MODIFY `codigo_empleado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `perfiles_laborales`
--
ALTER TABLE `perfiles_laborales`
  MODIFY `id_perfil` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `colaboradores`
--
ALTER TABLE `colaboradores`
  ADD CONSTRAINT `fk_colaborador_ruta` FOREIGN KEY (`id_ruta`) REFERENCES `cat_rutas` (`id_ruta`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_colaborador_sexo` FOREIGN KEY (`id_sexo`) REFERENCES `cat_sexo` (`id_sexo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_colaborador_tipo_sangre` FOREIGN KEY (`id_tipo_sangre`) REFERENCES `cat_tipos_sangre` (`id_tipo_sangre`) ON UPDATE CASCADE;

--
-- Constraints for table `perfiles_laborales`
--
ALTER TABLE `perfiles_laborales`
  ADD CONSTRAINT `fk_perfil_colaborador` FOREIGN KEY (`codigo_empleado`) REFERENCES `colaboradores` (`codigo_empleado`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_perfil_ocupacion` FOREIGN KEY (`id_ocupacion`) REFERENCES `cat_ocupaciones` (`id_ocupacion`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_perfil_tipo_planilla` FOREIGN KEY (`id_tipo_planilla`) REFERENCES `cat_tipos_planilla` (`id_tipo_planilla`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
