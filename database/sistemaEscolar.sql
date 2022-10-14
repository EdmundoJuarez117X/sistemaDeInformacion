SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
-- /*!40101 SET NAMES utf8_unicode_ci */;

-- CREATE DATABASE sistema_escolar IF NOT EXISTS;

-- USE DATABASE sistema_escolar;


--
-- Base de datos: `sistemaEscolar`
--

--
-- Estructura de tabla para la tabla `nivelEducativo`
--

DROP TABLE IF EXISTS `nivelEducativo`;

CREATE TABLE IF NOT EXISTS  `nivelEducativo` (
    `id_nivelEducativo` int (3) NOT NULL AUTO_INCREMENT,
    `nombre_nivelEducativo` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `descripcion_nivelEducativo` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `estatus_nivelEdu` bit(1) DEFAULT (1) NOT NULL,
    `f_creacion_nivelEdu` datetime NOT NULL,
    `f_modificacion` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    PRIMARY KEY (`id_nivelEducativo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Estructura de tabla para la tabla `escuela`
--


DROP TABLE IF EXISTS `escuela`;

CREATE TABLE IF NOT EXISTS `escuela` (
    `id_escuela` int(4) NOT NULL AUTO_INCREMENT,
    `nombre_escuela` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `nombre_corto_esc` varchar(9) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `estatus_escuela` bit(1) DEFAULT 1 NOT NULL,
    `logotipo_escuela` varchar(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `num_tel_escuela` varchar(13) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `direccion_escuela` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `sector_escuela` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `f_creacion_esc` datetime NOT NULL,
    `f_modificacion_esc` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    PRIMARY KEY (`id_escuela`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `modalidadEscolar`
--

DROP TABLE IF EXISTS `modalidadEscolar`;

CREATE TABLE IF NOT EXISTS `modalidadEscolar` (
    `id_modalidad` int(3) NOT NULL AUTO_INCREMENT,
    `nombre_modalidad` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `f_creacion_mod` datetime NOT NULL,
    `f_modificacion_mod` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    PRIMARY KEY (`id_modalidad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ------------------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `carrera`
--

DROP TABLE IF EXISTS `carrera`;

CREATE TABLE IF NOT EXISTS `carrera` (
    `id_carrera` int(3) NOT NULL AUTO_INCREMENT,
    `nombre_carrera` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `nombre_corto_carrera` varchar(9) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `estatus_carrera` bit(1) DEFAULT (1) NOT NULL,
    `f_creacion_carrera` datetime NOT NULL,
    `f_modificacion_carrera` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    PRIMARY KEY (`id_carrera`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -----------------------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `periodoEscolar`
--
DROP TABLE IF EXISTS `periodoEscolar`;

CREATE TABLE IF NOT EXISTS `periodoEscolar` (
    `id_periodoEscolar` int(3) NOT NULL AUTO_INCREMENT,
    `numero_periodo` tinyint(2) NOT NULL,
    `nombre_periodo` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `f_creacion_periodoE` datetime NOT NULL,
    `f_modificacion_periodoE` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    PRIMARY KEY (`id_periodoEscolar`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -----------------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `telefono`
--
DROP TABLE IF EXISTS `telefono`;

CREATE TABLE IF NOT EXISTS `telefono` (
    `id_telefono` int(3) NOT NULL AUTO_INCREMENT,
    `lada_tel` varchar(4) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `numero_telefonico` int(10) NOT NULL,
    `f_creacion_tel` datetime NOT NULL,
    `f_modificacion_tel` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    PRIMARY KEY (`id_telefono`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `asignatura`
--
DROP TABLE IF EXISTS `asignatura`;

CREATE TABLE IF NOT EXISTS `asignatura` (
    `id_asignatura` int(4) NOT NULL AUTO_INCREMENT,
    `nombre_asignatura` varchar(150) ,
    `nombre_corto_asig` varchar(9),
    `estatus_asignatura` bit(1) NOT NULL,
    `f_creacion_asig` datetime NOT NULL,
    `f_modificacion_asig` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    PRIMARY KEY (`id_asignatura`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `planEstudios`
--
DROP TABLE IF EXISTS `planEstudios`;

CREATE TABLE IF NOT EXISTS `planEstudios` (
    `id_planEstudios` int(4) NOT NULL AUTO_INCREMENT,
    `nombre_planEstudios` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `nombre_corto_planE` varchar(9) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `estatus_planEstudios` bit(1) DEFAULT (1) NOT NULL,
    `num_creditos_totales` tinyint NOT NULL,
    `num_creditos_min` tinyint NOT NULL,
    `num_creditos_max` tinyint NOT NULL,
    `f_creacion_planE` datetime NOT NULL,
    `f_modificacion_planE` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    PRIMARY KEY (`id_planEstudios`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `rol`
--
DROP TABLE IF EXISTS `rol`;

CREATE TABLE IF NOT EXISTS `rol` (
    `id_rol` int(3) NOT NULL AUTO_INCREMENT,
    `nombre_rol` varchar(30),
    `f_creacion_rol` datetime NOT NULL,
    `f_modificacion_rol` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------




-- *************************************************************************
-- TABLAS AZUL CIELO
-- *************************************************************************




-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `persona`
--
DROP TABLE IF EXISTS `persona`;
CREATE TABLE IF NOT EXISTS `persona`(
    `id_persona` int(5), 
    `nombre_persona` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `segundo_nombre` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `apellido_paterno` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `apellido_materno` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `genero` varchar(9) NOT NULL,
    `fecha_nacimiento` date NOT NULL,
    `direccion_persona` varchar(300) NOT NULL,
    `email_persona` varchar(64) NOT NULL,
    `password_persona` varchar(32) NOT NULL,
    `f_creacion_persona` datetime NOT NULL,
    `f_modificacion_persona` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_rol` int(3) NOT NULL,
    PRIMARY KEY (`id_persona`),
    FOREIGN KEY (`id_rol`) REFERENCES `rol`(`id_rol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `cursos`
--

DROP TABLE IF EXISTS `cursos`;

CREATE TABLE IF NOT EXISTS `cursos`(
    `id_curso` int(5) NOT NULL AUTO_INCREMENT,
    `nombre_curso` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `descripcion_curso` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `portada_curso` blob NOT NULL,
    `fecha_inicio_curso` datetime NOT NULL,
    `fecha_fin_curso` datetime NOT NULL,
    `requisitos_curso` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `responsables_curso` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `total_participantes` int(3) NOT NULL,
    `participantes_registrados` int(3) NOT NULL,
    `costo_unitario` float NOT NULL,
    `estatus_curso` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `f_creacion_curso` datetime NOT NULL,
    `f_modificacion_curso` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_rol` int(3) NOT NULL,
    PRIMARY KEY (`id_curso`),
    FOREIGN KEY (`id_rol`) REFERENCES `rol`(`id_rol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `movimiento`
--
DROP TABLE IF EXISTS `movimiento`;

CREATE TABLE IF NOT EXISTS `movimiento` (
    `id_movimiento` int(5) NOT NULL AUTO_INCREMENT,
    `nombre_movimiento` varchar(150),
    `estatus_movimiento` varchar(50),
    `f_creacion_Mov` datetime NOT NULL,
    `f_modificacion_Mov` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_persona` int(5) NOT NULL,
    PRIMARY KEY (`id_movimiento`),
    FOREIGN KEY (`id_persona`) REFERENCES `persona`(`id_persona`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------




-- *************************************************************************
-- TABLAS AZUL FUERTE
-- *************************************************************************




-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `persona_curso`
--

DROP TABLE IF EXISTS `persona_curso`;

CREATE TABLE IF NOT EXISTS `persona_curso` (
    `id_persona_curso` int(5) NOT NULL AUTO_INCREMENT,
    `nombre_persona` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `nombre_curso` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `descripcion_pago` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `cantidad_pago` float NOT NULL,
    `cantidad_boletines` int(3) NOT NULL,
    `f_creacion_per_cur` datetime NOT NULL,
    `f_modificacion_per_cur` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_persona` int(5) NOT NULL,
    `id_curso` int(5) NOT NULL,
    PRIMARY KEY (`id_persona_curso`),
    FOREIGN KEY (`id_persona`) REFERENCES `persona`(`id_persona`),
    FOREIGN KEY (`id_curso`) REFERENCES `cursos`(`id_curso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `persona_telefono`
--

DROP TABLE IF EXISTS `persona_telefono`;

CREATE TABLE IF NOT EXISTS `persona_telefono` (
    `id_persona_telefono` int(5) NOT NULL AUTO_INCREMENT,
    `nombre_persona` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `tipo_tel` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `lada_tel` varchar(4) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `numero_telefonico` int(10),
    `f_creacion_persona_telefono` datetime NOT NULL,
    `f_modificacion_persona_telefono` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_persona` int(5) NOT NULL,
    `id_telefono` int(3) NOT NULL,
    PRIMARY KEY(`id_persona_telefono`),
    FOREIGN KEY(`id_persona`) REFERENCES`persona`(`id_persona`),
    FOREIGN KEY(`id_telefono`) REFERENCES `telefono`(`id_telefono`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para `la escuela_Telefono`
--

DROP TABLE IF EXISTS `escuela_Telefono`;

CREATE TABLE IF NOT EXISTS `escuela_Telefono` (
    `id_escuela_telefono` int(4) NOT NULL AUTO_INCREMENT,
    `nombre_escuela` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `departamento_escuela` varchar(50) CHARACTER SET utf8 COLLAte utf8_unicode_ci NOT NULL,
    `lada_tel` varchar(4) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `numero_telefonico` int(10) NOT NULL,
    `f_creacion_escuela_telefono` datetime NOT NULL,
    `f_modificacion_escuela_telefono` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_escuela` int(4) NOT NULL,
    `id_telefono` int(3) NOT NULL,
    PRIMARY KEY (`id_escuela_telefono`),
    FOREIGN KEY (`id_escuela`) REFERENCES `escuela`(`id_escuela`),
    FOREIGN KEY (`id_telefono`) REFERENCES `telefono`(`id_telefono`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `escuela_nivelEducativo`
--

DROP TABLE IF EXISTS `escuela_nivelEducativo`;

CREATE TABLE IF NOT EXISTS `escuela_nivelEducativo` (
    `id_escuela_nivelEducativo` int(4) NOT NULL AUTO_INCREMENT,
    `nombre_escuela` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `nombre_nivelEducativo` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `f_creacion_escuelaNivelEdu` datetime NOT NULL,
    `f_modificacion_escuelaNivelEdu` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_escuela` int(4) NOT NULL,
    `id_nivelEducativo` int(3) NOT NULL,
    PRIMARY KEY(`id_escuela_nivelEducativo`),
    FOREIGN KEY (`id_escuela`) REFERENCES `escuela`(`id_escuela`),
    FOREIGN KEY (`id_nivelEducativo`) REFERENCES`nivelEducativo`(`id_nivelEducativo`)
) ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `persona_escuela`
--

DROP TABLE IF EXISTS `persona_escuela`;

CREATE TABLE IF NOT EXISTS `persona_escuela` (
    `id_persona_escuela` int(4) NOT NULL AUTO_INCREMENT,
    `nombre_persona` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `nombre_escuela` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `f_creacion_persona_escuela` datetime NOT NULL,
    `f_modificacion_persona_escuela` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_persona` int(5) NOT NULL,
    `id_escuela` int(4) NOT NULL,
    PRIMARY KEY (`id_persona_escuela`),
    FOREIGN KEY (`id_persona`) REFERENCES `persona`(`id_persona`),
    FOREIGN KEY (`id_escuela`) REFERENCES `escuela`(`id_escuela`)
) ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `persona_carrera`
--
DROP TABLE IF EXISTS `persona_carrera`;

CREATE TABLE IF NOT EXISTS `persona_carrera` (
    `id_persona_carrera` int(5) NOT NULL AUTO_INCREMENT,
    `nombre_persona` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `nombre_carrera` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `f_creacion_personaCarrera` datetime NOT NULL,
    `f_modificacion_personaCarrera` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_persona` int(5) NOT NULL,
    `id_carrera` int(3) NOT NULL,
    PRIMARY KEY (`id_persona_carrera`),
    FOREIGN KEY(`id_persona`) REFERENCES `persona`(`id_persona`),
    FOREIGN KEY(`id_carrera`) REFERENCES `carrera`(`id_carrera`)
) ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `escuela_modalidadEscolar`
--

DROP TABLE IF EXISTS `escuela_modalidadEscolar`;

CREATE TABLE IF NOT EXISTS `escuela_modalidadEscolar` (
    `id_escuela_modalidadEscolar` int(4) NOT NULL AUTO_INCREMENT,
    `nombre_escuela` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `nombre_modalidad` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `f_creacion_escuela_modalidad` datetime NOT NULL,
    `f_modificacion_escuela_modalidad` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_escuela` int(4) NOT NULL,
    `id_modalidad` int(3) NOT NULL,
    PRIMARY KEY (`id_escuela_modalidadEscolar`),
    FOREIGN KEY (`id_escuela`) REFERENCES `escuela`(`id_escuela`),
    FOREIGN KEY (`id_modalidad`) REFERENCES `modalidadEscolar`(`id_modalidad`)
) ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `carrera_asignatura`
--

DROP TABLE IF EXISTS `carrera_asignatura`;

CREATE TABLE IF NOT EXISTS `carrera_asignatura` (
    `id_carrera_asignatura` int(4) NOT NULL AUTO_INCREMENT,
    `nombre_carrera` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `nombre_asignatura` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `f_creacion_carreraAsig` datetime NOT NULL,
    `f_modificacion_carreraAsig` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_carrera` int(3) NOT NULL,
    `id_asignatura` int(4) NOT NULL,
    PRIMARY KEY(`id_carrera_asignatura`),
    FOREIGN KEY(`id_carrera`) REFERENCES `carrera`(`id_carrera`),
    FOREIGN KEY(`id_asignatura`) REFERENCES `asignatura`(`id_asignatura`)
) ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `carrea_periodoEscolar`
--

DROP TABLE IF EXISTS `carrera_periodoEscolar`;

CREATE TABLE IF NOT EXISTS `carrera_periodoEscolar` (
    `id_carrera_periodoEscolar` int(4) NOT NULL AUTO_INCREMENT,
    `nombre_carrera` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `numero_periodoE` tinyint(2) NOT NULL,
    `nombre_periodoE` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `f_creacion_escPeriodoE` datetime NOT NULL,
    `f_modificacion` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_carrera` int(3) NOT NULL,
    `id_periodoEscolar` int(3) NOT NULL,
    PRIMARY KEY (`id_carrera_periodoEscolar`),
    FOREIGN KEY (`id_carrera`) REFERENCES `carrera`(`id_carrera`),
    FOREIGN KEY (`id_periodoEscolar`) REFERENCES `periodoEscolar`(`id_periodoEscolar`)
) ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `carrera_planEstudios`
--

DROP TABLE IF EXISTS `carrera_planEstudios`;

CREATE TABLE IF NOT EXISTS `carrera_planEstudios` (
    `id_carreraPlanE` int(3) NOT NULL AUTO_INCREMENT,
    `nombre_carrera` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `nombre_planEstudios` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `f_creacion_carreraPlanE` datetime NOT NULL,
    `f_modificacion_carreraPlanE` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_carrera` int(3) NOT NULL,
    `id_planEstudios` int(4) NOT NULL,
    PRIMARY KEY(`id_carreraPlanE`),
    FOREIGN KEY(`id_carrera`) REFERENCES `carrera`(`id_carrera`),
    FOREIGN KEY(`id_planEstudios`) REFERENCES `planEstudios`(`id_planEstudios`)
) ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `asignatura_planEstudios`
--

DROP TABLE IF EXISTS `asignatura_planEstudios`;

CREATE TABLE IF NOT EXISTS `asignatura_planEstudios` (
    `id_carreraPlanE` int(3) NOT NULL AUTO_INCREMENT,
    `nombre_asignatura` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `nombre_planE` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `f_creacion_asigPlanE` datetime NOT NULL,
    `f_modificacion_asigPlanE` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_asignatura` int(3) NOT NULL,
    `id_planEstudios` int(4) NOT NULL,
    PRIMARY KEY (`id_carreraPlanE`),
    FOREIGN KEY (`id_asignatura`) REFERENCES `asignatura`(`id_asignatura`),
    FOREIGN KEY (`id_planEstudios`) REFERENCES `planEstudios`(`id_planEstudios`)
) ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `nueva`
--