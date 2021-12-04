-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 13, 2021 at 11:26 PM
-- Server version: 5.7.26
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `anavelaz_adm_2021`
--

-- --------------------------------------------------------

--
-- Table structure for table `abono_cuenta_empleados`
--

CREATE TABLE `abono_cuenta_empleados` (
  `id_abono_cuenta` int(11) NOT NULL,
  `fk_id_empleado` int(11) DEFAULT NULL,
  `no_semana` int(11) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `monto_abono` decimal(13,2) DEFAULT NULL,
  `adeudo_anterior` decimal(13,2) DEFAULT NULL,
  `adeudo_anterior_despues_abono` decimal(13,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `abono_cuenta_empleados`
--

INSERT INTO `abono_cuenta_empleados` (`id_abono_cuenta`, `fk_id_empleado`, `no_semana`, `descripcion`, `monto_abono`, `adeudo_anterior`, `adeudo_anterior_despues_abono`, `created_at`, `updated_at`) VALUES
(6, 36, 45, 'abono a cuenta', '250.00', '2700.00', '2450.00', '2021-11-10 06:25:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `asistencias`
--

CREATE TABLE `asistencias` (
  `idasistencia` int(11) NOT NULL,
  `fk_id_empleado` int(11) DEFAULT NULL,
  `no_semana` int(11) DEFAULT NULL,
  `lun_asis` char(1) DEFAULT NULL,
  `mar_asis` char(1) DEFAULT NULL,
  `mie_asis` char(1) DEFAULT NULL,
  `jue_asis` char(1) DEFAULT NULL,
  `vie_asis` char(1) DEFAULT NULL,
  `sab_asis` char(1) DEFAULT NULL,
  `dom_asis` char(1) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `asistencias`
--

INSERT INTO `asistencias` (`idasistencia`, `fk_id_empleado`, `no_semana`, `lun_asis`, `mar_asis`, `mie_asis`, `jue_asis`, `vie_asis`, `sab_asis`, `dom_asis`, `fecha_inicio`, `fecha_fin`) VALUES
(9, 1, 43, '1', '1', '1', '1', '1', '1', NULL, '2021-10-25', '2021-10-31'),
(10, 36, 43, '1', '1', '1', '1', '1', '1', NULL, '2021-10-25', '2021-10-31'),
(127, 1, 45, '1', '1', '1', '1', '1', '1', NULL, '2021-11-08', '2021-11-14'),
(128, 36, 45, '1', '1', '0', '1', '1', '1', NULL, '2021-11-08', '2021-11-14');

-- --------------------------------------------------------

--
-- Table structure for table `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre_cliente` varchar(250) DEFAULT NULL,
  `direccion_cliente` varchar(500) DEFAULT NULL,
  `tel_cliente` varchar(10) DEFAULT NULL,
  `tel_cel_cliente` varchar(10) NOT NULL,
  `estatus_espera` char(1) DEFAULT '0',
  `estatus_seguimiento` char(1) DEFAULT '0',
  `estatus_avisa` char(1) DEFAULT '0',
  `estatus_aprobado` char(1) DEFAULT '0',
  `fk_id_tipo_producto` int(11) DEFAULT NULL,
  `presupuesto` double(10,2) DEFAULT '0.00',
  `presupuesto2` double(10,2) DEFAULT '0.00',
  `presupuesto3` double(10,2) DEFAULT '0.00',
  `presupuesto4` double(10,2) DEFAULT '0.00',
  `fecha_captura` datetime DEFAULT NULL,
  `ubicacion` varchar(300) DEFAULT NULL,
  `fk_id_empleado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre_cliente`, `direccion_cliente`, `tel_cliente`, `tel_cel_cliente`, `estatus_espera`, `estatus_seguimiento`, `estatus_avisa`, `estatus_aprobado`, `fk_id_tipo_producto`, `presupuesto`, `presupuesto2`, `presupuesto3`, `presupuesto4`, `fecha_captura`, `ubicacion`, `fk_id_empleado`) VALUES
(1, 'fide xxx', 'centro', '2200100101', '2002022020', '1', '1', '1', '1', 5, 1000.00, 2000.00, 2000.00, 200.00, '2021-11-06 16:35:13', 'centro', 1),
(2, 'cliente 2 xxx', 'lomas verdes', '2288191127', '2288523630', '1', '1', '1', '1', 5, 1500.00, 0.00, 0.00, 0.00, '2021-11-06 16:36:30', 'centro', 1),
(6, 'JUANITA LOPEZ', 'CONOCIDO', '8811191001', '2288191100', '1', '1', '1', '1', 8, 1200.00, 800.00, 700.00, 600.00, '2021-11-11 13:34:07', 'XCENTRO', 36),
(7, 'cliente 2', 'XX', '9999999999', '9999999999', '1', '1', '1', '1', 7, 3450.00, 0.00, 0.00, 0.00, '2021-11-11 13:34:28', 'centro', 36);

-- --------------------------------------------------------

--
-- Table structure for table `empleados`
--

CREATE TABLE `empleados` (
  `id_empleado` int(11) NOT NULL,
  `fk_id_user` int(11) NOT NULL,
  `nombre_empleado` varchar(255) DEFAULT NULL,
  `telefono_empleado` varchar(10) DEFAULT NULL,
  `direccion_empleado` varchar(100) DEFAULT NULL,
  `sueldo_semanal_empleado` decimal(13,2) DEFAULT NULL,
  `importe_prestamo_maximo` decimal(13,2) DEFAULT NULL,
  `adeudo_anterior` decimal(13,2) DEFAULT NULL,
  `adeudo_actual` decimal(13,2) DEFAULT NULL,
  `estatus` char(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `empleados`
--

INSERT INTO `empleados` (`id_empleado`, `fk_id_user`, `nombre_empleado`, `telefono_empleado`, `direccion_empleado`, `sueldo_semanal_empleado`, `importe_prestamo_maximo`, `adeudo_anterior`, `adeudo_actual`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 1, 'MARIO JIMENEZ', '2288777777', 'AMERICAS', '0.00', '0.00', '0.00', NULL, 'A', '2021-07-10 12:57:33', '2021-08-03 19:13:07'),
(36, 49, 'RAMON', '2288191100', 'DOMICILIO CONOCIDO', '1700.00', '0.00', '2700.00', '2600.00', 'A', '2021-10-26 16:15:57', '2021-11-10 06:27:59');

-- --------------------------------------------------------

--
-- Table structure for table `inasistencias`
--

CREATE TABLE `inasistencias` (
  `id_inasistencia` int(11) NOT NULL,
  `fk_id_empleado` int(11) NOT NULL,
  `no_semana` int(11) DEFAULT NULL,
  `dia_semana` varchar(3) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `fecha_inasistencia` date DEFAULT NULL,
  `estatus` char(1) DEFAULT NULL,
  `fk_id_user` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `inasistencias`
--

INSERT INTO `inasistencias` (`id_inasistencia`, `fk_id_empleado`, `no_semana`, `dia_semana`, `descripcion`, `fecha_inasistencia`, `estatus`, `fk_id_user`, `created_at`, `updated_at`) VALUES
(3, 36, 45, 'mie', 'ninguna', '2021-11-10', 'A', 1, '2021-11-10 06:20:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `prestamos_empleado`
--

CREATE TABLE `prestamos_empleado` (
  `id_prestamo` int(11) NOT NULL,
  `fk_id_empleado` int(11) NOT NULL,
  `tipo_prestamo` char(1) DEFAULT NULL,
  `no_semana` int(11) DEFAULT NULL,
  `dia_semana` varchar(3) DEFAULT NULL,
  `descripcion_prestamo` varchar(150) DEFAULT NULL,
  `fecha_prestamo` date DEFAULT NULL,
  `pagado` decimal(13,2) DEFAULT NULL,
  `adeuda` decimal(13,2) DEFAULT NULL,
  `monto_prestamo` decimal(13,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prestamos_empleado`
--

INSERT INTO `prestamos_empleado` (`id_prestamo`, `fk_id_empleado`, `tipo_prestamo`, `no_semana`, `dia_semana`, `descripcion_prestamo`, `fecha_prestamo`, `pagado`, `adeuda`, `monto_prestamo`, `created_at`, `updated_at`) VALUES
(7, 36, 'A', 45, 'mar', 'ADELANTO LUNES', '2021-11-08', '0.00', '500.00', '500.00', '2021-11-10 04:47:09', NULL),
(8, 36, 'A', 45, 'mar', 'ADELANTO MARTES', '2021-11-09', '0.00', '100.00', '100.00', '2021-11-10 04:47:47', NULL),
(9, 36, 'A', 45, 'mar', 'ADELANTO MIERCOLES', '2021-11-10', '0.00', '100.00', '100.00', '2021-11-10 04:48:07', NULL),
(10, 36, 'A', 45, 'mar', 'PRESTAMO JUEVES', '2021-11-11', '0.00', '50.00', '50.00', '2021-11-10 04:48:44', NULL),
(11, 36, 'A', 45, 'mar', 'PRESTAMO VIERNES', '2021-11-12', '0.00', '200.00', '200.00', '2021-11-10 04:49:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `descripcion_rol` varchar(45) DEFAULT NULL,
  `activo` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id_rol`, `descripcion_rol`, `activo`) VALUES
(1, 'Administrador', 'S'),
(2, 'Vendedor', 'S'),
(3, 'Trabajador', 'S');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_producto`
--

CREATE TABLE `tipo_producto` (
  `id_tipo_producto` int(11) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `img_principal` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipo_producto`
--

INSERT INTO `tipo_producto` (`id_tipo_producto`, `descripcion`, `img_principal`) VALUES
(1, 'VENTANAS', NULL),
(2, 'PUERTAS', NULL),
(3, 'CANCELES', NULL),
(4, 'BARANDALES', NULL),
(5, 'PORTONES', NULL),
(6, 'REJAS', NULL),
(7, 'COCINETAS', NULL),
(8, 'CLOSETS', NULL),
(9, 'DOMOS', NULL),
(10, 'AUTOMATIZACION PORTON', NULL),
(11, 'VIDRIOS', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trabajos`
--

CREATE TABLE `trabajos` (
  `id_trabajo` int(11) NOT NULL,
  `fk_id_cliente` int(11) DEFAULT NULL,
  `descripcion_trabajo` varchar(500) DEFAULT NULL,
  `estatus_fabricado` char(1) DEFAULT NULL,
  `estatus_instalado` char(1) DEFAULT NULL,
  `estatus_terminado` char(1) DEFAULT NULL,
  `monto_pagado` decimal(13,2) DEFAULT NULL,
  `monto_adeuda` decimal(13,2) DEFAULT NULL,
  `monto_precio` decimal(13,2) DEFAULT NULL,
  `presup_seleccionado` char(1) DEFAULT NULL,
  `fecha_creacion_trabajo` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `trabajos`
--

INSERT INTO `trabajos` (`id_trabajo`, `fk_id_cliente`, `descripcion_trabajo`, `estatus_fabricado`, `estatus_instalado`, `estatus_terminado`, `monto_pagado`, `monto_adeuda`, `monto_precio`, `presup_seleccionado`, `fecha_creacion_trabajo`) VALUES
(1, 2, 'presup aprob 1', '0', '0', '0', '0.00', '1500.00', '1500.00', '1', '2021-11-11 10:04:09'),
(2, 6, 'ccc', '0', '0', '0', '0.00', '800.00', '800.00', '2', '2021-11-11 16:45:05'),
(3, 7, 'ppp', '0', '0', '0', '0.00', '3450.00', '3450.00', '1', '2021-11-11 16:45:13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fk_id_rol` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `usuario` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `estatus` char(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fk_id_rol`, `name`, `usuario`, `email`, `email_verified_at`, `password`, `remember_token`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 1, 'MARIO JIMENEZ', 'MARIO', 'mario@correo.com', NULL, 'mario2021', NULL, 'A', '2021-07-10 12:57:32', '2021-08-03 19:13:07'),
(49, 3, 'RAMON', 'b27047546150f7ab89ee', 'demo@correo.com', NULL, '04ff70fbc1661fa72a84', NULL, 'A', '2021-10-26 16:15:57', '2021-11-10 04:46:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abono_cuenta_empleados`
--
ALTER TABLE `abono_cuenta_empleados`
  ADD PRIMARY KEY (`id_abono_cuenta`),
  ADD KEY `fk_pagos_prestamos_prestamos1_idx` (`no_semana`);

--
-- Indexes for table `asistencias`
--
ALTER TABLE `asistencias`
  ADD PRIMARY KEY (`idasistencia`);

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indexes for table `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id_empleado`),
  ADD KEY `fk_empleados_users1_idx` (`fk_id_user`);

--
-- Indexes for table `inasistencias`
--
ALTER TABLE `inasistencias`
  ADD PRIMARY KEY (`id_inasistencia`),
  ADD KEY `fk_inasistencias_empleados1_idx` (`fk_id_empleado`);

--
-- Indexes for table `prestamos_empleado`
--
ALTER TABLE `prestamos_empleado`
  ADD PRIMARY KEY (`id_prestamo`),
  ADD KEY `fk_prestamos_empleados1_idx` (`fk_id_empleado`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indexes for table `tipo_producto`
--
ALTER TABLE `tipo_producto`
  ADD PRIMARY KEY (`id_tipo_producto`);

--
-- Indexes for table `trabajos`
--
ALTER TABLE `trabajos`
  ADD PRIMARY KEY (`id_trabajo`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_roles_idx` (`fk_id_rol`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abono_cuenta_empleados`
--
ALTER TABLE `abono_cuenta_empleados`
  MODIFY `id_abono_cuenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `asistencias`
--
ALTER TABLE `asistencias`
  MODIFY `idasistencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `inasistencias`
--
ALTER TABLE `inasistencias`
  MODIFY `id_inasistencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `prestamos_empleado`
--
ALTER TABLE `prestamos_empleado`
  MODIFY `id_prestamo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tipo_producto`
--
ALTER TABLE `tipo_producto`
  MODIFY `id_tipo_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `trabajos`
--
ALTER TABLE `trabajos`
  MODIFY `id_trabajo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `fk_empleados_users1` FOREIGN KEY (`fk_id_user`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `inasistencias`
--
ALTER TABLE `inasistencias`
  ADD CONSTRAINT `fk_inasistencias_empleados1` FOREIGN KEY (`fk_id_empleado`) REFERENCES `empleados` (`id_empleado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `prestamos_empleado`
--
ALTER TABLE `prestamos_empleado`
  ADD CONSTRAINT `fk_prestamos_empleados1` FOREIGN KEY (`fk_id_empleado`) REFERENCES `empleados` (`id_empleado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_roles` FOREIGN KEY (`fk_id_rol`) REFERENCES `roles` (`id_rol`) ON DELETE NO ACTION ON UPDATE NO ACTION;
