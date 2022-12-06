-- phpMyAdmin SQL Dump

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
-- /*!40101 SET NAMES utf8_unicode_ci */;

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

-- -------------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `nivelEducativo`
--

DROP TABLE IF EXISTS `nivelEducativo`;

CREATE TABLE IF NOT EXISTS  `nivelEducativo` (
    `id_nivelEducativo` int (3) NOT NULL AUTO_INCREMENT,
    `nombre_nivelEducativo` varchar(33) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `descripcion_nivelEducativo` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `estatus_nivelEdu` bit(1) DEFAULT 1 NOT NULL,
    `f_creacion_nivelEdu` datetime NOT NULL,
    `f_modificacion` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    PRIMARY KEY (`id_nivelEducativo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- -----------------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `telefono`
--
DROP TABLE IF EXISTS `telefono`;

CREATE TABLE IF NOT EXISTS `telefono` (
    `id_telefono` int(3) NOT NULL AUTO_INCREMENT,
    `lada_tel` varchar(4) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '+52' NOT NULL ,
    `numero_telefonico` varchar(10) NOT NULL,
    `f_creacion_tel` datetime NOT NULL,
    `f_modificacion_tel` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    PRIMARY KEY (`id_telefono`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -----------------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `docente`
--

DROP TABLE IF EXISTS `docente`;

CREATE TABLE IF NOT EXISTS `docente` (
    `id_docente` int(5) NOT NULL AUTO_INCREMENT,
    `subMatDoc` varchar(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'DOC' NOT NULL,
    `nombre_docente` varchar(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `segundo_nombreDocente` varchar(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `apellido_paternoDocente` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `apellido_maternoDocente` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `edad_Docente` int(3) not null,
    `genero_Docente` varchar(9) not null,
    `estatus_Docente` varchar(16) DEFAULT 'ACTIVO' not null,
    `numero_tel_Docente` varchar(16) not null,
    `email_docente` varchar(64) not null,
    `password_docente` varchar(128) not null,
    `fecha_nacimientoDocente` date not null,
    `f_creacion_Docente` datetime not null,
    `f_modificacion_Docente` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    PRIMARY KEY (`id_docente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -----------------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `alumno`
--

DROP TABLE IF EXISTS `alumno`;

CREATE TABLE IF NOT EXISTS `alumno` (
    `id_alumno` int(5) NOT NULL AUTO_INCREMENT,
    `subMatAl` varchar(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'Al' NOT NULL,
    `nombre_alumno` varchar(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `segundo_nombreAlumno` varchar(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `apellido_paternoAlumno` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `apellido_maternoAlumno` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `edad_Alumno` int(3) not null,
    `genero_Alumno` varchar(9) not null,
    `estatus_Alumno` varchar(16) DEFAULT 'ACTIVO' not null,
    `numero_tel_Alumno` varchar(16) not null,
    `email_alumno` varchar(64) not null,
    `password_alumno` varchar(128) not null,
    `fecha_nacimientoAlumno` date not null,
    `f_creacion_Alumno` datetime not null,
    `f_modificacion_Alumno` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    PRIMARY KEY (`id_alumno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -----------------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `aspirante`
--

DROP TABLE IF EXISTS `aspirante`;

CREATE TABLE IF NOT EXISTS `aspirante` (
    `id_aspirante` int(5) NOT NULL AUTO_INCREMENT,
    `subMatAsp` varchar(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'ASP' NOT NULL,
    `nombre_aspirante` varchar(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `segundo_nombreAspirante` varchar(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `apellido_paternoAspirante` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `apellido_maternoAspirante` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `edad_Aspirante` int(3) not null,
    `genero_Aspirante` varchar(9) not null,
    `estatus_Aspirante` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'ACTIVO' not null,
    `numero_tel_Aspirante` varchar(16) not null,
    `email_aspirante` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci not null,
    `password_aspirante` varchar(128) not null,
    `fecha_nacimientoAspirante` date not null,
    `f_creacion_Aspirante` datetime not null,
    `f_modificacion_Aspirante` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    PRIMARY KEY (`id_aspirante`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
-- -----------------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `escuela`
--

DROP TABLE IF EXISTS `escuela`;

CREATE TABLE IF NOT EXISTS `escuela` (
    `id_escuela` int(5) NOT NULL AUTO_INCREMENT,
    `nombre_escuela` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `nombre_corto_esc` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `estatus_escuela` bit(1) DEFAULT 1 NOT NULL,
    `logotipo_escuela` mediumblob,
    `direccion_escuela` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `sector_escuela` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `f_creacion_esc` datetime NOT NULL,
    `f_modificacion_esc` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    PRIMARY KEY (`id_escuela`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



-- -----------------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `master`
--

DROP TABLE IF EXISTS `master`;

CREATE TABLE IF NOT EXISTS `master` (
    `id_master` int(5) NOT NULL AUTO_INCREMENT,
    `subMatMst` varchar(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'MST' NOT NULL,
    `nombre_master` varchar(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `segundo_nombreMaster` varchar(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `apellido_paternoMaster` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `apellido_maternoMaster` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `edad_Master` int(3) not null,
    `genero_Master` varchar(9) not null,
    `estatus_Master` varchar(16) DEFAULT 'ACTIVO' not null,
    `numero_tel_Master` varchar(16) not null,
    `email_master` varchar(64) not null,
    `password_master` varchar(128) not null,
    `fecha_nacimientoMaster` date not null,
    `f_creacion_Master` datetime not null,
    `f_modificacion_Master` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    PRIMARY KEY (`id_master`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -----------------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `administrador`
--

DROP TABLE IF EXISTS `administrador`;

CREATE TABLE IF NOT EXISTS `administrador` (
    `id_administrador` int(5) NOT NULL AUTO_INCREMENT,
    `subMatAdm` varchar(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'ADM' NOT NULL,
    `nombre_admin` varchar(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `segundo_nombreAdmin` varchar(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `apellido_paternoAdmin` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `apellido_maternoAdmin` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `edad_Admin` int(3) not null,
    `genero_Admin` varchar(9) not null,
    `estatus_Admin` varchar(16) DEFAULT 'ACTIVO' not null,
    `numero_tel_Admin` varchar(16) not null,
    `email_admin` varchar(64) not null,
    `password_admin` varchar(128) not null,
    `fecha_nacimientoAdmin` date not null,
    `f_creacion_Admin` datetime not null,
    `f_modificacion_Admin` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    PRIMARY KEY (`id_administrador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -----------------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `padreDeFamilia`
--

DROP TABLE IF EXISTS `padreDeFamilia`;

CREATE TABLE IF NOT EXISTS `padreDeFamilia` (
    `id_padreDeFamilia` int(5) NOT NULL AUTO_INCREMENT,
    `subMatPF` varchar(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'PF' NOT NULL,
    `nombre_padreDeFam` varchar(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `segundo_nombrepadreDeFam` varchar(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `apellido_paternopadreDeFam` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `apellido_maternopadreDeFam` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `edad_padreDeFam` int(3) not null,
    `genero_padreDeFam` varchar(9) not null,
    `estatus_padreDeFam` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'ACTIVO' not null,
    `numero_tel_padreDeFam` varchar(16) not null,
    `email_padreDeFam` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci not null,
    `password_padreDeFam` varchar(128) not null,
    `fecha_nacimientopadreDeFam` date not null,
    `f_creacion_padreDeFam` datetime not null,
    `f_modificacion_padreDeFam` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    PRIMARY KEY (`id_padreDeFamilia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `cursos`
--

DROP TABLE IF EXISTS `cursos`;

CREATE TABLE IF NOT EXISTS `cursos`(
    `id_curso` int(5) NOT NULL AUTO_INCREMENT,
    `nombre_curso` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `descripcion_curso` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `portada_curso` longblob NULL,
    `fecha_inicio_curso` date NOT NULL,
    `fecha_fin_curso` date NOT NULL,
    `requisitos_curso` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `responsables_curso` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `total_participantes` int(3) NOT NULL,
    `participantes_registrados` int(3) NOT NULL,
    `costo_unitario` float NOT NULL,
    `estatus_curso` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `f_creacion_curso` datetime NOT NULL,
    `f_modificacion_curso` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `rol_dirigido` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    PRIMARY KEY (`id_curso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `facultad`
--

DROP TABLE IF EXISTS `facultad`;

CREATE TABLE IF NOT EXISTS `facultad`(
    `id_facultad` int(5) NOT NULL AUTO_INCREMENT,
    `nombre_facultad` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `nombre_corto_facultad` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `estatus_facultad` bit(1) DEFAULT 1 NOT NULL,
    `f_creacion_facultad` datetime NOT NULL,
    `f_modificacion_facultad` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    PRIMARY KEY(`id_facultad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -----------------------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `periodoEscolar`
--
DROP TABLE IF EXISTS `periodoEscolar`;

CREATE TABLE IF NOT EXISTS `periodoEscolar` (
    `id_periodoEscolar` int(3) NOT NULL AUTO_INCREMENT,
    `nombre_periodo` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `f_creacion_periodoE` datetime NOT NULL,
    `f_modificacion_periodoE` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    PRIMARY KEY (`id_periodoEscolar`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -----------------------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `aula`
--
DROP TABLE IF EXISTS `aula`;

CREATE TABLE IF NOT EXISTS `aula` (
    `id_aula` int(3) NOT NULL AUTO_INCREMENT,
    `numero_aula` int(5) NOT NULL,
    `nombre_aula` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `grupo_aula` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `numero_asientosAula` int(5) NOT NULL,
    `estatus_aula` bit(1) DEFAULT 0 NOT NULL,
    `f_creacion_aula` datetime NOT NULL,
    `f_modificacion_aula` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    PRIMARY KEY (`id_aula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `asignatura`
--
DROP TABLE IF EXISTS `asignatura`;

CREATE TABLE IF NOT EXISTS `asignatura` (
    `id_asignatura` int(5) NOT NULL AUTO_INCREMENT,
    `nombre_asignatura` varchar(150) ,
    `nombre_corto_asig` varchar(16),
    `estatus_asignatura` bit(1) NOT NULL,
    `f_creacion_asig` datetime NOT NULL,
    `f_modificacion_asig` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    PRIMARY KEY (`id_asignatura`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `calificacion`
--
DROP TABLE IF EXISTS `calificacion`;

CREATE TABLE IF NOT EXISTS `calificacion` (
    `id_calificacion` int(5) NOT NULL AUTO_INCREMENT,
    `calificacion` varchar(6) NOT NULL ,
    `estatus_calificacion` varchar(13) NOT NULL,
    `f_creacion_calificacion` datetime NOT NULL,
    `f_modificacion_calificacion` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    PRIMARY KEY (`id_calificacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `pago`
--
DROP TABLE IF EXISTS `pago`;

CREATE TABLE IF NOT EXISTS `pago` (
    `id_pago` int(5) NOT NULL AUTO_INCREMENT,
    `monto` decimal(13, 4) NOT NULL,
    `descripcion` varchar(160) NOT NULL,
    `moneda_concurrencia` varchar(6) NOT NULL,
    `estatus_pago` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `f_creacion_pago` datetime NOT NULL,
    `f_modificacion_pago` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    PRIMARY KEY (`id_pago`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ------------------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `carrera`
--

DROP TABLE IF EXISTS `carrera`;

CREATE TABLE IF NOT EXISTS `carrera` (
    `id_carrera` int(5) NOT NULL AUTO_INCREMENT,
    `nombre_carrera` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `nombre_corto_carrera` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `estatus_carrera` bit(1) DEFAULT 1 NOT NULL,
    `f_creacion_carrera` datetime NOT NULL,
    `f_modificacion_carrera` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    PRIMARY KEY (`id_carrera`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Dumping data for table `carrera`
--

INSERT INTO `carrera` (`id_carrera`, `nombre_carrera`, `nombre_corto_carrera`, `estatus_carrera`, `f_creacion_carrera`, `f_modificacion_carrera`) VALUES
(1, 'Ingeniería en Software', 'ISW', b'1', '2022-11-23 22:58:49', '2022-11-23 22:59:28'),
(2, 'Ingeniería Automotríz', 'IAU', b'1', '2022-11-23 22:58:49', '2022-11-23 22:59:28'),
(3, 'Ingeniería en Energía', 'IEN', b'1', '2022-11-23 22:58:49', '2022-11-23 22:59:28'),
(4, 'Ingeniería en Manufactura', 'IMF', b'1', '2022-11-23 22:58:49', '2022-11-23 22:59:28');


-- ------------------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `especializacion`
--

DROP TABLE IF EXISTS `especializacion`;

CREATE TABLE IF NOT EXISTS `especializacion` (
    `id_especializacion` int(3) NOT NULL AUTO_INCREMENT,
    `nombre_esp` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `estatus_esp` bit(1) DEFAULT 1 NOT NULL,
    `f_creacion_esp` datetime NOT NULL,
    `f_modificacion_esp` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    PRIMARY KEY (`id_especializacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `planEstudios`
--
DROP TABLE IF EXISTS `planEstudios`;

CREATE TABLE IF NOT EXISTS `planEstudios` (
    `id_planEstudios` int(5) NOT NULL AUTO_INCREMENT,
    `nombre_planEstudios` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `nombre_corto_planE` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `estatus_planEstudios` bit(1) DEFAULT 1 NOT NULL,
    `num_creditos_totales` tinyint NOT NULL,
    `num_creditos_min` tinyint NOT NULL,
    `num_creditos_max` tinyint NOT NULL,
    `f_creacion_planE` datetime NOT NULL,
    `f_modificacion_planE` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    PRIMARY KEY (`id_planEstudios`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
-- TABLAS CON CLAVE FORANEA

--
-- Estructura de tabla para la tabla `notificacion_curso`
--
DROP TABLE IF EXISTS `notificacion_curso`;

CREATE TABLE IF NOT EXISTS `notificacion_curso` (
    `id_notificacion_curso` int(5) NOT NULL AUTO_INCREMENT,
    `descripcion_notificacion` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `id_curso` int(5) NOT NULL,
    PRIMARY KEY (`id_notificacion_curso`),
    FOREIGN KEY (`id_curso`) REFERENCES `cursos`(`id_curso`)
) ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
-- TABLAS CON CLAVE FORANEA

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `notificacion_curso`
--

DROP TABLE IF EXISTS `notificacion_curso`;

CREATE TABLE IF NOT EXISTS `notificacion_curso` (
    `id_notificacion_curso` int(5) NOT NULL AUTO_INCREMENT,
    `descripcion_notificacion` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `id_curso` int(5) NOT NULL,
    PRIMARY KEY (`id_notificacion_curso`),
    FOREIGN KEY (`id_curso`) REFERENCES `cursos`(`id_curso`)
) ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `escuela_modalidadEscolar`
--

DROP TABLE IF EXISTS `escuela_modalidadEscolar`;

CREATE TABLE IF NOT EXISTS `escuela_modalidadEscolar` (
    `id_escuela_modalidadEscolar` int(5) NOT NULL AUTO_INCREMENT,
    `nombre_escuela` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `nombre_modalidad` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `f_creacion_escuela_modalidad` datetime NOT NULL,
    `f_modificacion_escuela_modalidad` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_escuela` int(5) NOT NULL,
    `id_modalidad` int(3) NOT NULL,
    PRIMARY KEY (`id_escuela_modalidadEscolar`),
    FOREIGN KEY (`id_escuela`) REFERENCES `escuela`(`id_escuela`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`id_modalidad`) REFERENCES `modalidadEscolar`(`id_modalidad`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `escuela_nivelEducativo`
--

DROP TABLE IF EXISTS `escuela_nivelEducativo`;

CREATE TABLE IF NOT EXISTS `escuela_nivelEducativo` (
    `id_escuela_nivelEducativo` int(5) NOT NULL AUTO_INCREMENT,
    `nombre_escuela` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `nombre_nivelEducativo` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `f_creacion_escuelaNivelEdu` datetime NOT NULL,
    `f_modificacion_escuelaNivelEdu` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_escuela` int(5) NOT NULL,
    `id_nivelEducativo` int(3) NOT NULL,
    PRIMARY KEY(`id_escuela_nivelEducativo`),
    FOREIGN KEY (`id_escuela`) REFERENCES `escuela`(`id_escuela`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`id_nivelEducativo`) REFERENCES `nivelEducativo`(`id_nivelEducativo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para `escuela_Telefono`
--

DROP TABLE IF EXISTS `escuela_Telefono`;

CREATE TABLE IF NOT EXISTS `escuela_Telefono` (
    `id_escuela_telefono` int(5) NOT NULL AUTO_INCREMENT,
    `departamento_escuela` varchar(50) CHARACTER SET utf8 COLLAte utf8_unicode_ci NOT NULL,
    `numero_telefonico` varchar(10) NOT NULL,
    `f_creacion_escuela_telefono` datetime NOT NULL,
    `f_modificacion_escuela_telefono` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_escuela` int(5) NOT NULL,
    `id_telefono` int(3) NOT NULL,
    PRIMARY KEY (`id_escuela_telefono`),
    FOREIGN KEY (`id_escuela`) REFERENCES `escuela`(`id_escuela`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`id_telefono`) REFERENCES `telefono`(`id_telefono`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `docente_curso`
--

DROP TABLE IF EXISTS `docente_curso`;

CREATE TABLE IF NOT EXISTS `docente_curso` (
    `id_docente_curso` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `descripcion_pago` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `cantidad_boletines` int(3) NOT NULL,
    `f_creacion_doc_cur` datetime NOT NULL,
    `f_modificacion_doc_cur` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_docente` int(5) NOT NULL,
    `id_curso` int(5) NOT NULL,
    PRIMARY KEY (`id_docente_curso`),
    FOREIGN KEY (`id_docente`) REFERENCES `docente`(`id_docente`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`id_curso`) REFERENCES `cursos`(`id_curso`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `alumno_curso`
--

DROP TABLE IF EXISTS `alumno_curso`;

CREATE TABLE IF NOT EXISTS `alumno_curso` (
    `id_alumno_curso` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `descripcion_pago` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `cantidad_boletines` int(3) NOT NULL,
    `f_creacion_al_cur` datetime NOT NULL,
    `f_modificacion_al_cur` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_alumno` int(5) NOT NULL,
    `id_curso` int(5) NOT NULL,
    PRIMARY KEY (`id_alumno_curso`),
    FOREIGN KEY (`id_alumno`) REFERENCES `alumno`(`id_alumno`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`id_curso`) REFERENCES `cursos`(`id_curso`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `direccionAlumno`
--
DROP TABLE IF EXISTS `direccionAlumno`;
CREATE TABLE IF NOT EXISTS `direccionAlumno`(
    `id_direccionAlumno` int(5) NOT NULL AUTO_INCREMENT,
    `calleAlumno` varchar(160) NOT NULL,
    `numeroCalleAlumno` int(5) NOT NULL,
    `coloniaAlumno` varchar(160) NOT NULL,
    `estadoAlumno` varchar(130) NOT NULL,
    `ciudadAlumno` varchar(130) NOT NULL,
    `codPostalAlumno` int(6) NOT NULL,
    `f_creacion_DirAlumno` datetime NOT NULL,
    `f_modificacion_DirAlumno` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_alumno` int(5) NOT NULL,
    PRIMARY KEY(`id_direccionAlumno`),
    FOREIGN KEY(`id_alumno`) REFERENCES `alumno`(`id_alumno`) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `escuela_periodoEscolar`
--

DROP TABLE IF EXISTS `escuela_periodoEscolar`;

CREATE TABLE IF NOT EXISTS `escuela_periodoEscolar` (
    `id_escuela_periodoEscolar` int(5) NOT NULL AUTO_INCREMENT,
    `nombre_escuela` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `numero_periodoE` int(3) not null,
    `nombre_periodoE` varchar(33) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `f_inicio_periodoE` datetime NOT NULL,
    `f_termino_periodoE` datetime NOT NULL,
    `f_creacion_escuelaPE` datetime NOT NULL,
    `f_modificacion_escuelaPE` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_escuela` int(5) NOT NULL,
    `id_periodoEscolar` int(3) NOT NULL,
    PRIMARY KEY (`id_escuela_periodoEscolar`),
    FOREIGN KEY (`id_escuela`) REFERENCES `escuela`(`id_escuela`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`id_periodoEscolar`) REFERENCES `periodoEscolar`(`id_periodoEscolar`) ON DELETE CASCADE ON UPDATE CASCADE 
) ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `escuela_facultad`
--

DROP TABLE IF EXISTS `escuela_facultad`;

CREATE TABLE IF NOT EXISTS `escuela_facultad` (
    `id_escuela_facultad` int(5) NOT NULL AUTO_INCREMENT,
    `nombre_escuela` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `nombre_facultad` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `f_creacion_escFacultad` datetime NOT NULL,
    `f_modificacion_escFacultad` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_escuela` int(5) NOT NULL,
    `id_facultad` int(5) NOT NULL,
    PRIMARY KEY (`id_escuela_facultad`),
    FOREIGN KEY (`id_escuela`) REFERENCES `escuela`(`id_escuela`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`id_facultad`) REFERENCES `facultad`(`id_facultad`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `docente_facultad`
--

DROP TABLE IF EXISTS `docente_facultad`;

CREATE TABLE IF NOT EXISTS `docente_facultad` (
    `id_DocFacultad` int(5) NOT NULL AUTO_INCREMENT,
    `nombre_docente` varchar(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `nombre_facultad` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `f_creacion_DocFac` datetime NOT NULL,
    `f_modificacion_DocFac` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_docente` int(5) NOT NULL,
    `id_facultad` int(5) NOT NULL,
    PRIMARY KEY (`id_DocFacultad`),
    FOREIGN KEY (`id_docente`) REFERENCES `docente`(`id_docente`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`id_facultad`) REFERENCES `facultad`(`id_facultad`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `administradorEscuela`
--

DROP TABLE IF EXISTS `administradorEscuela`;

CREATE TABLE IF NOT EXISTS `administradorEscuela` (
    `id_administradorEscuela` int(5) NOT NULL AUTO_INCREMENT,
    `nombre_admin` varchar(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `nombre_escuela` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `f_creacion_admin_escuela` datetime NOT NULL,
    `f_modificacion_admin_escuela` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_administrador` int(5) NOT NULL,
    `id_escuela` int(5) NOT NULL,
    PRIMARY KEY (`id_administradorEscuela`),
    FOREIGN KEY (`id_administrador`) REFERENCES `administrador`(`id_administrador`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`id_escuela`) REFERENCES `escuela`(`id_escuela`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `docenteEscuela`
--

DROP TABLE IF EXISTS `docenteEscuela`;

CREATE TABLE IF NOT EXISTS `docenteEscuela` (
    `id_docenteEscuela` int(5) NOT NULL AUTO_INCREMENT,
    `nombre_docente` varchar(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `nombre_escuela` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `f_creacion_doc_escuela` datetime NOT NULL,
    `f_modificacion_doc_escuela` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_docente` int(5) NOT NULL,
    `id_escuela` int(5) NOT NULL,
    PRIMARY KEY (`id_docenteEscuela`),
    FOREIGN KEY (`id_docente`) REFERENCES `docente`(`id_docente`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`id_escuela`) REFERENCES `escuela`(`id_escuela`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `alumnoEscuela`
--

DROP TABLE IF EXISTS `alumnoEscuela`;

CREATE TABLE IF NOT EXISTS `alumnoEscuela` (
    `id_alumnoEscuela` int(5) NOT NULL AUTO_INCREMENT,
    `nombre_alumno` varchar(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `nombre_escuela` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `f_creacion_alumno_escuela` datetime NOT NULL,
    `f_modificacion_alumno_escuela` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_alumno` int(5) NOT NULL,
    `id_escuela` int(5) NOT NULL,
    PRIMARY KEY (`id_alumnoEscuela`),
    FOREIGN KEY (`id_alumno`) REFERENCES `alumno`(`id_alumno`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`id_escuela`) REFERENCES `escuela`(`id_escuela`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `direccionDocente`
--
DROP TABLE IF EXISTS `direccionDocente`;
CREATE TABLE IF NOT EXISTS `direccionDocente`(
    `id_direccionDocente` int(5) NOT NULL AUTO_INCREMENT,
    `calleDocente` varchar(160) NOT NULL,
    `numeroCalleDocente` int(5) NOT NULL,
    `coloniaDocente` varchar(160) NOT NULL,
    `estadoDocente` varchar(130) NOT NULL,
    `ciudadDocente` varchar(130) NOT NULL,
    `codPostalDocente` int(6) NOT NULL,
    `f_creacion_DirDocente` datetime NOT NULL,
    `f_modificacion_DirDocente` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_docente` int(5) NOT NULL,
    PRIMARY KEY(`id_direccionDocente`),
    FOREIGN KEY(`id_docente`) REFERENCES `docente`(`id_docente`) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `direccionAspirante`
--
DROP TABLE IF EXISTS `direccionAspirante`;
CREATE TABLE IF NOT EXISTS `direccionAspirante`(
    `id_direccionAspirante` int(5) NOT NULL AUTO_INCREMENT,
    `calleAspirante` varchar(160) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `numeroCalleAspirante` int(5) NOT NULL,
    `coloniaAspirante` varchar(160) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `estadoAspirante` varchar(130) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `ciudadAspirante` varchar(130) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `codPostalAspirante` int(6) NOT NULL,
    `f_creacion_DirAspirante` datetime NOT NULL,
    `f_modificacion_DirAspirante` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_aspirante` int(5) NOT NULL,
    PRIMARY KEY(`id_direccionAspirante`),
    FOREIGN KEY(`id_aspirante`) REFERENCES `aspirante`(`id_aspirante`) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `admisionInteresesAspirante`
--
DROP TABLE IF EXISTS `admisionInteresesAspirante`;
CREATE TABLE IF NOT EXISTS `admisionInteresesAspirante`(
    `id_admsnIntePersona` int(5) NOT NULL AUTO_INCREMENT,
    `nombre_escuela` varchar(150) NOT NULL,
    `nombre_nivelEducativo` varchar(33) NOT NULL,
    `descripcion_nivelEducativo` varchar(100) NOT NULL,
    `nombre_facultad` varchar(150) NOT NULL,
    `nombre_esp` varchar(150) NOT NULL,
    `nombre_carrera` varchar(150) NOT NULL,
    `numero_grado` int(2) NOT NULL,
    `f_creacion_admsnIntePersona` datetime NOT NULL,
    `f_modificacion_admsnIntePersona` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_aspirante` int(5) NOT NULL,
    `id_escuela` int(5) NOT NULL,
    `id_nivelEducativo` int(5) NOT NULL,
    `id_facultad` int(5),
    `id_carrera` int(5),
    `id_especializacion` int(5),
    PRIMARY KEY(`id_admsnIntePersona`),
    FOREIGN KEY(`id_aspirante`) REFERENCES `aspirante`(`id_aspirante`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(`id_escuela`) REFERENCES `escuela`(`id_escuela`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(`id_nivelEducativo`) REFERENCES `nivelEducativo`(`id_nivelEducativo`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(`id_facultad`) REFERENCES `facultad`(`id_facultad`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(`id_carrera`) REFERENCES `carrera`(`id_carrera`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(`id_especializacion`) REFERENCES `especializacion`(`id_especializacion`) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `aspirante_pago`
--

DROP TABLE IF EXISTS `aspirante_pago`;
CREATE TABLE IF NOT EXISTS `aspirante_pago`(
    `id_asp_pago` int(5) NOT NULL AUTO_INCREMENT,
    `nombre_aspirante` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `id_charge` varchar(369) NOT NULL,
    `monto` decimal(13, 4) NOT NULL,
    `moneda_concurrencia` varchar(6) NOT NULL,
    `descripcion` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `estatus_pago` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `email_aspirante` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `f_creacion_AspPago` datetime NOT NULL,
    `f_modificacion_AspPago` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_aspirante` int(5) NOT NULL,
    `id_pago` int(5) NOT NULL,
    PRIMARY KEY(`id_asp_pago`),
    FOREIGN KEY(`id_aspirante`) REFERENCES `aspirante`(`id_aspirante`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(`id_pago`) REFERENCES `pago`(`id_pago`) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `padreDeFamiliaHijo`
--
DROP TABLE IF EXISTS `padreDeFamiliaHijo`;
CREATE TABLE IF NOT EXISTS `padreDeFamiliaHijo`(
    `id_padreDeFamHijo` int(5) NOT NULL AUTO_INCREMENT,
    `nombre_padreDeFam` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `nombre_aspirante` varchar(33) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `nombre_alumno` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `f_creacion_pfHijo` datetime NOT NULL,
    `f_modificacion_pfHijo` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_padreDeFamilia` int(5) NOT NULL,
    `id_aspirante` int(5),
    `id_alumno` int(5),
    PRIMARY KEY(`id_padreDeFamHijo`),
    FOREIGN KEY(`id_padreDeFamilia`) REFERENCES `padreDeFamilia`(`id_padreDeFamilia`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(`id_aspirante`) REFERENCES `aspirante`(`id_aspirante`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(`id_alumno`) REFERENCES `alumno`(`id_alumno`) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `direccionAdministrador`
--
DROP TABLE IF EXISTS `direccionAdministrador`;
CREATE TABLE IF NOT EXISTS `direccionAdministrador`(
    `id_direccionAdmin` int(5) NOT NULL AUTO_INCREMENT,
    `calleAdmin` varchar(160) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `numeroCalleAdmin` int(5) NOT NULL,
    `coloniaAdmin` varchar(160) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `estadoAdmin` varchar(130) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `ciudadAdmin` varchar(130) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `codPostalAdmin` int(6) NOT NULL,
    `f_creacion_DirAdmin` datetime NOT NULL,
    `f_modificacion_DirAdmin` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_administrador` int(5) NOT NULL,
    PRIMARY KEY(`id_direccionAdmin`),
    FOREIGN KEY(`id_administrador`) REFERENCES `administrador`(`id_administrador`) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `direccionAdministrador`
--
DROP TABLE IF EXISTS `direccionMaster`;
CREATE TABLE IF NOT EXISTS `direccionMaster`(
    `id_direccionMaster` int(5) NOT NULL AUTO_INCREMENT,
    `calleMaster` varchar(160) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `numeroCalleMaster` int(5) NOT NULL,
    `coloniaMaster` varchar(160) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `estadoMaster` varchar(130) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `ciudadMaster` varchar(130) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `codPostalMaster` int(6) NOT NULL,
    `f_creacion_DirMaster` datetime NOT NULL,
    `f_modificacion_DirMaster` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_master` int(5) NOT NULL,
    PRIMARY KEY(`id_direccionMaster`),
    FOREIGN KEY(`id_master`) REFERENCES `master` (`id_master`) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `direccionAdministrador`
--
DROP TABLE IF EXISTS `alumno_aula`;
CREATE TABLE IF NOT EXISTS `alumno_aula`(
    `id_AlAula` int(5) not null AUTO_INCREMENT,
    `nombre_alumno` varchar(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `nombre_aula` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `grupo_aula` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `f_creacion_Al_Aula` datetime not null,
    `f_modificacion_AlAula` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_alumno` int(5) not null,
    `id_aula` int(5) not null,
    PRIMARY KEY(`id_AlAula`),
    FOREIGN KEY(`id_alumno`) REFERENCES `alumno`(`id_alumno`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(`id_aula`) REFERENCES `aula`(`id_aula`) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `docente_aula`
--
DROP TABLE IF EXISTS `docente_aula`;
CREATE TABLE IF NOT EXISTS `docente_aula`(
    `id_DocAula` int(5) not null AUTO_INCREMENT,
    `nombre_docente` varchar(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `nombre_aula` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `grupo_aula` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `f_creacion_DocAula` datetime not null,
    `f_modificacion_DocAula` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_docente` int(5) not null,
    `id_aula` int(5) not null,
    PRIMARY KEY(`id_DocAula`),
    FOREIGN KEY(`id_docente`) REFERENCES `docente`(`id_docente`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(`id_aula`) REFERENCES `aula`(`id_aula`) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `alumno_facultad`
--

DROP TABLE IF EXISTS `alumno_facultad`;

CREATE TABLE IF NOT EXISTS `alumno_facultad` (
    `id_AlFacultad` int(5) NOT NULL AUTO_INCREMENT,
    `nombre_alumno` varchar(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `nombre_facultad` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `f_creacion_AlFac` datetime NOT NULL,
    `f_modificacion_AlFac` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_alumno` int(5) NOT NULL,
    `id_facultad` int(5) NOT NULL,
    PRIMARY KEY (`id_AlFacultad`),
    FOREIGN KEY (`id_alumno`) REFERENCES `alumno`(`id_alumno`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`id_facultad`) REFERENCES `facultad`(`id_facultad`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `escuela_aula`
--
DROP TABLE IF EXISTS `escuela_aula`;
CREATE TABLE IF NOT EXISTS `escuela_aula`(
    `id_escuelaAula` int(5) not null AUTO_INCREMENT,
    `nombre_escuela` varchar(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `numero_aula` int(5) NOT NULL,
    `nombre_aula` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `grupo_aula` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `f_creacion_aula` datetime not null,
    `f_modificacion_aula` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_escuela` int(5) not null,
    `id_aula` int(5) not null,
    PRIMARY KEY(`id_escuelaAula`),
    FOREIGN KEY(`id_escuela`) REFERENCES `escuela`(`id_escuela`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(`id_aula`) REFERENCES `aula`(`id_aula`) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `carrera_periodoEscolar`
--

DROP TABLE IF EXISTS `carrera_periodoEscolar`;

CREATE TABLE IF NOT EXISTS `carrera_periodoEscolar` (
    `id_carrera_periodoEscolar` int(5) NOT NULL AUTO_INCREMENT,
    `nombre_carrera` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `numero_periodoE` int(3) NOT NULL,
    `nombre_periodoE` varchar(33) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `f_inicio_PeriodoE` datetime NOT NULL,
    `f_termino_PeriodoE` datetime NOT NULL,
    `f_creacion_carreraPeriodoE` datetime NOT NULL,
    `f_modificacion_carreraPeriodoE` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_carrera` int(5) NOT NULL,
    `id_periodoEscolar` int(3) NOT NULL,
    PRIMARY KEY (`id_carrera_periodoEscolar`),
    FOREIGN KEY (`id_carrera`) REFERENCES `carrera`(`id_carrera`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`id_periodoEscolar`) REFERENCES `periodoEscolar`(`id_periodoEscolar`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `especializacion_periodoEscolar`
--

DROP TABLE IF EXISTS `especializacion_periodoEscolar`;

CREATE TABLE IF NOT EXISTS `especializacion_periodoEscolar` (
    `id_especializacion_periodoEscolar` int(5) NOT NULL AUTO_INCREMENT,
    `nombre_carrera` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `numero_periodoE` int(3) NOT NULL,
    `nombre_periodoE` varchar(33) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `f_inicio_PeriodoE` datetime NOT NULL,
    `f_termino_PeriodoE` datetime NOT NULL,
    `f_creacion_espPeriodoE` datetime NOT NULL,
    `f_modificacion_espPeriodoE` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_especializacion` int(5) NOT NULL,
    `id_periodoEscolar` int(3) NOT NULL,
    PRIMARY KEY (`id_especializacion_periodoEscolar`),
    FOREIGN KEY (`id_especializacion`) REFERENCES `especializacion`(`id_especializacion`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`id_periodoEscolar`) REFERENCES `periodoEscolar`(`id_periodoEscolar`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `asignatura_periodoEscolar`
--

DROP TABLE IF EXISTS `asignatura_periodoEscolar`;

CREATE TABLE IF NOT EXISTS `asignatura_periodoEscolar` (
    `id_asignatura_periodoEscolar` int(5) NOT NULL AUTO_INCREMENT,
    `nombre_asignatura` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `numero_periodoE` int(3) NOT NULL,
    `nombre_periodoE` varchar(33) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `f_creacion_asigPeriodoE` datetime NOT NULL,
    `f_modificacion_asigPeriodoE` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_asignatura` int(5) NOT NULL,
    `id_periodoEscolar` int(3) NOT NULL,
    PRIMARY KEY (`id_asignatura_periodoEscolar`),
    FOREIGN KEY (`id_asignatura`) REFERENCES `asignatura`(`id_asignatura`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`id_periodoEscolar`) REFERENCES `periodoEscolar`(`id_periodoEscolar`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `facultad_aula`
--

DROP TABLE IF EXISTS `facultad_aula`;

CREATE TABLE IF NOT EXISTS `facultad_aula` (
    `id_facultadAula` int(5) NOT NULL AUTO_INCREMENT,
    `nombre_facultad` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `numero_aula` int(5) NOT NULL,
    `nombre_aula` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `grupo_aula` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `f_creacion_FacAula` datetime NOT NULL,
    `f_modificacion_FacAula` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_facultad` int(5) NOT NULL,
    `id_aula` int(5) NOT NULL,
    PRIMARY KEY (`id_facultadAula`),
    FOREIGN KEY (`id_facultad`) REFERENCES `facultad`(`id_facultad`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`id_aula`) REFERENCES `aula`(`id_aula`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `asignatura_aula`
--

DROP TABLE IF EXISTS `asignatura_aula`;

CREATE TABLE IF NOT EXISTS `asignatura_aula` (
    `id_asinaturaAula` int(5) NOT NULL AUTO_INCREMENT,
    `nombre_asignatura` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `numero_aula` int(5) NOT NULL,
    `nombre_aula` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `grupo_aula` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `f_creacion_AsigAula` datetime NOT NULL,
    `f_modificacion_AsigAula` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_asignatura` int(5) NOT NULL,
    `id_aula` int(5) NOT NULL,
    PRIMARY KEY (`id_asinaturaAula`),
    FOREIGN KEY (`id_asignatura`) REFERENCES `asignatura`(`id_asignatura`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`id_aula`) REFERENCES `aula`(`id_aula`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `asignatura_calificacion`
--
DROP TABLE IF EXISTS `asignatura_calificacion`;

CREATE TABLE IF NOT EXISTS `asignatura_calificacion` (
    `id_asig_cal` int(5) NOT NULL AUTO_INCREMENT,
    `nombre_asignatura` varchar(6) NOT NULL ,
    `calificacion` varchar(6) NOT NULL ,
    `f_creacion_asigCal` datetime NOT NULL,
    `f_modificacion_asigCal` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_asignatura` int(5) NOT NULL,
    `id_calificacion` int(5) NOT NULL,
    `id_alumno` int(5) NOT NULL,
    PRIMARY KEY (`id_asig_cal`),
    FOREIGN KEY (`id_asignatura`) REFERENCES `asignatura`(`id_asignatura`),
    FOREIGN KEY (`id_calificacion`) REFERENCES `calificacion`(`id_calificacion`),
    FOREIGN KEY (`id_alumno`) REFERENCES `alumno`(`id_alumno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `asignatura_alumno`
--
DROP TABLE IF EXISTS `asignatura_alumno`;

CREATE TABLE IF NOT EXISTS `asignatura_alumno` (
    `id_asig_al` int(5) NOT NULL AUTO_INCREMENT,
    `nombre_asignatura` varchar(6) NOT NULL ,
    `calificacion` varchar(6) NOT NULL ,
    `f_creacion_asigAl` datetime NOT NULL,
    `f_modificacion_asigAl` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_asignatura` int(5) NOT NULL,
    `id_alumno` int(5) NOT NULL,
    PRIMARY KEY (`id_asig_al`),
    FOREIGN KEY (`id_asignatura`) REFERENCES `asignatura`(`id_asignatura`),
    FOREIGN KEY (`id_alumno`) REFERENCES `alumno`(`id_alumno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `padreDeFamilia_pago`
--
-- -- VALUES ('$charge[id]','$charge[balance_transaction]','$charge[description]','$total','$charge[currency]','$charge[status]','$email',NOW())

DROP TABLE IF EXISTS `padreDeFamilia_pago`;
CREATE TABLE IF NOT EXISTS `padreDeFamilia_pago`(
    `id_PF_pago` int(5) NOT NULL AUTO_INCREMENT,
    `nombre_padreDeFam` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `id_charge` varchar(369) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `monto` decimal(13, 4) NOT NULL,
    `moneda_concurrencia` varchar(6) NOT NULL,
    `descripcion` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `estatus_pago` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `email_padreDeFam` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `f_creacion_PFPago` datetime NOT NULL,
    `f_modificacion_PFPago` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_padreDeFamilia` int(5) NOT NULL,
    `id_pago` int(5) NOT NULL,
    PRIMARY KEY(`id_PF_pago`),
    FOREIGN KEY(`id_padreDeFamilia`) REFERENCES `padreDeFamilia`(`id_padreDeFamilia`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(`id_pago`) REFERENCES `pago`(`id_pago`) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `escuela_pago`
--
--  -- VALUES ('$charge[id]','$charge[balance_transaction]','$charge[description]','$total','$charge[currency]','$charge[status]','$email',NOW())

DROP TABLE IF EXISTS `escuela_pago`;
CREATE TABLE IF NOT EXISTS `escuela_pago`(
    `id_esc_pago` int(5) NOT NULL AUTO_INCREMENT,
    `nombre_escuela` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `monto` decimal(13, 4) NOT NULL,
    `moneda_concurrencia` varchar(6) NOT NULL,
    `descripcion` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `estatus_pago` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `f_creacion_EscPago` datetime NOT NULL,
    `f_modificacion_EscPago` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_escuela` int(5) NOT NULL,
    `id_pago` int(5) NOT NULL,
    PRIMARY KEY(`id_esc_pago`),
    FOREIGN KEY(`id_escuela`) REFERENCES `escuela`(`id_escuela`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(`id_pago`) REFERENCES `pago`(`id_pago`) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ------------------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `alumno_esp`
--

DROP TABLE IF EXISTS `alumno_esp`;

CREATE TABLE IF NOT EXISTS `alumno_esp` (
    `id_alumno_esp` int(3) NOT NULL AUTO_INCREMENT,
    `alumno` varchar(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `nombre_esp` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `f_creacion_AlEsp` datetime NOT NULL,
    `f_modificacion_AlEsp` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_alumno` int(5) NOT NULL,
    `id_especializacion` int(5) NOT NULL,
    PRIMARY KEY (`id_alumno_esp`),
    FOREIGN KEY (`id_alumno`) REFERENCES `alumno`(`id_alumno`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`id_especializacion`) REFERENCES `especializacion`(`id_especializacion`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `alumno_carrera`
--

DROP TABLE IF EXISTS `alumno_carrera`;

CREATE TABLE IF NOT EXISTS `alumno_carrera` (
    `id_alumno_carrera` int(5) NOT NULL AUTO_INCREMENT,
    `nombre_alumno` varchar(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `nombre_carrera` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `f_creacion_AlCarrera` datetime NOT NULL,
    `f_modificacion_AlCarrera` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_alumno` int(5) NOT NULL,
    `id_carrera` int(5) NOT NULL,
    PRIMARY KEY (`id_alumno_carrera`),
    FOREIGN KEY (`id_alumno`) REFERENCES `alumno`(`id_alumno`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`id_carrera`) REFERENCES `carrera`(`id_carrera`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `docente_carrera`
--

DROP TABLE IF EXISTS `docente_carrera`;

CREATE TABLE IF NOT EXISTS `docente_carrera` (
    `id_doc_carrera` int(5) NOT NULL AUTO_INCREMENT,
    `nombre_docente` varchar(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `nombre_carrera` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `f_creacion_DocCarrera` datetime NOT NULL,
    `f_modificacion_DocCarrera` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_docente` int(5) NOT NULL,
    `id_carrera` int(5) NOT NULL,
    PRIMARY KEY (`id_doc_carrera`),
    FOREIGN KEY (`id_docente`) REFERENCES `docente`(`id_docente`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`id_carrera`) REFERENCES `carrera`(`id_carrera`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `carrera_asignatura`
--
DROP TABLE IF EXISTS `carrera_asignatura`;

CREATE TABLE IF NOT EXISTS `carrera_asignatura` (
    `id_carreraAsig` int(5) NOT NULL AUTO_INCREMENT,
    `nombre_carrera` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `nombre_asignatura` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `f_creacion_carreraAsig` datetime NOT NULL,
    `f_modificacion_carreraAsig` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_carrera` int(5) NOT NULL,
    `id_asignatura` int(5) NOT NULL,
    PRIMARY KEY (`id_carreraAsig`),
    FOREIGN KEY (`id_carrera`) REFERENCES `carrera`(`id_carrera`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`id_asignatura`) REFERENCES `asignatura`(`id_asignatura`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `facultad_carrera`
--
DROP TABLE IF EXISTS `facultad_carrera`;

CREATE TABLE IF NOT EXISTS `facultad_carrera` (
    `id_facultadCarrera` int(5) NOT NULL AUTO_INCREMENT,
    `nombre_facultad` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `nombre_carrera` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `f_creacion_faCarrera` datetime NOT NULL,
    `f_modificacion_faCarrera` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_facultad` int(5) NOT NULL,
    `id_carrera` int(5) NOT NULL,
    PRIMARY KEY (`id_facultadCarrera`),
    FOREIGN KEY (`id_facultad`) REFERENCES `facultad`(`id_facultad`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`id_carrera`) REFERENCES `carrera`(`id_carrera`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `horario`
--
DROP TABLE IF EXISTS `horario`;

CREATE TABLE IF NOT EXISTS `horario` (
    `id_horario` int(5) NOT NULL AUTO_INCREMENT,
    `archivo_horario` mediumblob NOT NULL,
    `estatus_horario` bit(1) DEFAULT 1 NOT NULL,
    `f_creacion_horario` datetime NOT NULL,
    `f_modificacion_horario` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_aula` int(5) NOT NULL,
    PRIMARY KEY (`id_horario`),
    FOREIGN KEY (`id_aula`) REFERENCES `aula`(`id_aula`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `carrera_planEstudios`
--
DROP TABLE IF EXISTS `carrera_planEstudios`;

CREATE TABLE IF NOT EXISTS `carrera_planEstudios` (
    `id_carreraPlanE` int(5) NOT NULL AUTO_INCREMENT,
    `nombre_carrera` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `nombre_planEstudios` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `f_creacion_carreraPlanE` datetime NOT NULL,
    `f_modificacion_carreraPlanE` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_carrera` int(5) NOT NULL,
    `id_planEstudios` int(5) NOT NULL,
    PRIMARY KEY (`id_carreraPlanE`),
    FOREIGN KEY (`id_carrera`) REFERENCES `carrera`(`id_carrera`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`id_planEstudios`) REFERENCES `planEstudios`(`id_planEstudios`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `facultad_especializacion`
--
DROP TABLE IF EXISTS `facultad_especializacion`;

CREATE TABLE IF NOT EXISTS `facultad_especializacion` (
    `id_facultadEsp` int(5) NOT NULL AUTO_INCREMENT,
    `nombre_facultad` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `nombre_esp` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `f_creacion_faEsp` datetime NOT NULL,
    `f_modificacion_faEsp` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_facultad` int(5) NOT NULL,
    `id_especializacion` int(5) NOT NULL,
    PRIMARY KEY (`id_facultadEsp`),
    FOREIGN KEY (`id_facultad`) REFERENCES `facultad`(`id_facultad`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`id_especializacion`) REFERENCES `especializacion`(`id_especializacion`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `especilizacion_asignatura`
--
DROP TABLE IF EXISTS `especilizacion_asignatura`;

CREATE TABLE IF NOT EXISTS `especilizacion_asignatura` (
    `id_espAsignatura` int(5) NOT NULL AUTO_INCREMENT,
    `nombre_esp` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `nombre_asignatura` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `f_creacion_espAsig` datetime NOT NULL,
    `f_modificacion_espAsig` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_especializacion` int(5) NOT NULL,
    `id_asignatura` int(5) NOT NULL,
    PRIMARY KEY (`id_espAsignatura`),
    FOREIGN KEY (`id_especializacion`) REFERENCES `especializacion`(`id_especializacion`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`id_asignatura`) REFERENCES `asignatura`(`id_asignatura`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `asignatura_planEstudios`
--
DROP TABLE IF EXISTS `asignatura_planEstudios`;

CREATE TABLE IF NOT EXISTS `asignatura_planEstudios` (
    `id_asigPlanE` int(5) NOT NULL AUTO_INCREMENT,
    `nombre_asignatura` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `nombre_planE` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `f_creacion_asigPlanE` datetime NOT NULL,
    `f_modificacion_asigPlanE` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_asignatura` int(5) NOT NULL,
    `id_planEstudios` int(5) NOT NULL,
    PRIMARY KEY (`id_asigPlanE`),
    FOREIGN KEY (`id_asignatura`) REFERENCES `asignatura`(`id_asignatura`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`id_planEstudios`) REFERENCES `planEstudios`(`id_planEstudios`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `docente_carrera`
--

DROP TABLE IF EXISTS `docente_carrera`;

CREATE TABLE IF NOT EXISTS `docente_carrera` (
    `id_doc_carrera` int(5) NOT NULL AUTO_INCREMENT,
    `nombre_docente` varchar(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `nombre_carrera` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `f_creacion_DocCarrera` datetime NOT NULL,
    `f_modificacion_doc_cur` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_docente` int(5) NOT NULL,
    `id_carrera` int(5) NOT NULL,
    PRIMARY KEY (`id_doc_carrera`),
    FOREIGN KEY (`id_docente`) REFERENCES `docente`(`id_docente`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`id_carrera`) REFERENCES `carrera`(`id_carrera`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `docente_pago`
--

DROP TABLE IF EXISTS `docente_pago`;

CREATE TABLE IF NOT EXISTS `docente_pago` (
    `id_docente_pago` int(5) NOT NULL AUTO_INCREMENT,
    `nombre_docente` varchar(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `monto` decimal(13, 4) NOT NULL,
    `descripcion` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `estatus_pago` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `f_creacion_DocPago` datetime NOT NULL,
    `f_modificacion_DocPago` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_docente` int(5) NOT NULL,
    PRIMARY KEY (`id_docente_pago`),
    FOREIGN KEY (`id_docente`) REFERENCES `docente`(`id_docente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `alumno_pago`
--

DROP TABLE IF EXISTS `alumno_pago`;

CREATE TABLE IF NOT EXISTS `alumno_pago` (
    `id_alumno_pago` int(5) NOT NULL AUTO_INCREMENT,
    `nombre_alumno` varchar(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `id_charge` varchar(369) NOT NULL,
    `monto` decimal(13, 4) NOT NULL,
    `moneda_concurrencia` varchar(6) NOT NULL,
    `descripcion` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `estatus_pago` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `email_alumno` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `f_creacion_AlPago` datetime NOT NULL,
    `f_modificacion_AlPago` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_alumno` int(5) NOT NULL,
    `id_pago` int(5) NOT NULL,
    PRIMARY KEY (`id_alumno_pago`),
    FOREIGN KEY (`id_alumno`) REFERENCES `alumno`(`id_alumno`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(`id_pago`) REFERENCES `pago`(`id_pago`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `especializacion_planEstudios`
--

DROP TABLE IF EXISTS `especializacion_planEstudios`;

CREATE TABLE IF NOT EXISTS `especializacion_planEstudios` (
    `id_espPlanE` int(5) NOT NULL AUTO_INCREMENT,
    `nombre_esp` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `nombre_planEstudios` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `f_creacion_espPlanE` datetime NOT NULL,
    `f_modificacion_espPlanE` datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `id_especializacion` int(5) NOT NULL,
    `id_planEstudios` int(5) NOT NULL,
    PRIMARY KEY (`id_espPlanE`),
    FOREIGN KEY (`id_especializacion`) REFERENCES `especializacion`(`id_especializacion`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`id_planEstudios`) REFERENCES `planEstudios`(`id_planEstudios`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------------------------------------------
--
-- Estructura de tabla para la tabla `asistencia`
--

DROP TABLE IF EXISTS `asistencia`;

CREATE TABLE IF NOT EXISTS `asistencia` (
    `id_asistencia` int(5) NOT NULL AUTO_INCREMENT,
    `estatus_asistencia` varchar(19) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `fecha_asistencia` date NOT NULL,
    `id_alumno` int(5) NOT NULL,
    `id_docente` int(5) NOT NULL,
    PRIMARY KEY (`id_asistencia`),
    FOREIGN KEY (`id_alumno`) REFERENCES `alumno`(`id_alumno`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`id_docente`) REFERENCES `docente`(`id_docente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- seeders
--
-- Dumping data for table `escuela`
--

INSERT INTO `escuela` (`id_escuela`, `nombre_escuela`, `nombre_corto_esc`, `estatus_escuela`, `logotipo_escuela`, `direccion_escuela`, `sector_escuela`, `f_creacion_esc`, `f_modificacion_esc`) VALUES
(1, 'Jardin de Niños Fantasía', 'JNF', b'1', NULL, 'Calle 2 Oriente, 6, 5 de Mayo, Puebla, Puebla, México', 'Privado', '2022-11-23 22:48:09', '2022-11-23 22:51:11'),
(2, 'Primaria Benito Juárez', 'PBJ', b'1', NULL, 'Calle 2 Norte, 3, Colonia Aguamarina, Amozoc, Puebla, México', 'Publico', '2022-11-23 22:48:09', '2022-11-23 22:51:11'),
(3, 'Telesecundaria Gabino Barreda', 'TGB', b'1', NULL, 'Calle 3 Pte. 5, Colonia los Pinos, Amozoc, Puebla, México', 'Publico', '2022-11-23 22:48:09', '2022-11-23 22:51:11'),
(4, 'Bachillerato General Oficial José María Sánchez Rojas', 'BGOJMSR', b'1', NULL, 'Calle 6 sur, 9, Colonia los ladrillos, Amozoc, Puebla, México', 'Publico', '2022-11-23 22:48:09', '2022-11-23 22:51:11'),
(5, 'Universidad Politécnica de Amozoc', 'UPAM', b'1', NULL, 'Av. Ampliacion, Luis Oropeza No. 5202, San Andrés las Vegas 1ra Secc, 72980 Amozoc, Pue.', 'Publico', '2022-11-23 22:48:09', '2022-11-23 22:51:11');

--
-- Dumping data for table `facultad`
--

INSERT INTO `facultad` (`id_facultad`, `nombre_facultad`, `nombre_corto_facultad`, `estatus_facultad`, `f_creacion_facultad`, `f_modificacion_facultad`) VALUES
(1, 'Ciencias Exactas', 'CE', b'1', '2022-11-23 22:54:34', '2022-11-23 22:54:54'),
(2, 'Ciencias de la Salud', 'CS', b'1', '2022-11-23 22:54:34', '2022-11-23 22:54:54');


--
-- Dumping data for table `modalidadEscolar`
--

INSERT INTO `modalidadEscolar` (`id_modalidad`, `nombre_modalidad`, `f_creacion_mod`, `f_modificacion_mod`) VALUES
(1, 'Escolarizada', '2022-11-23 22:52:01', '2022-11-23 22:52:15'),
(2, 'No Escolarizada', '2022-11-23 22:52:01', '2022-11-23 22:52:15'),
(3, 'Mixta', '2022-11-23 22:52:01', '2022-11-23 22:52:15');

--
-- Dumping data for table `nivelEducativo`
--

INSERT INTO `nivelEducativo` (`id_nivelEducativo`, `nombre_nivelEducativo`, `descripcion_nivelEducativo`, `estatus_nivelEdu`, `f_creacion_nivelEdu`, `f_modificacion`) VALUES
(1, 'Basica', '(Prescolar / Primaria / Secundaria)', b'1', '2022-11-23 22:52:44', '2022-11-23 22:53:20'),
(2, 'Media Superior', '(Bachillerato / Preparatoria / Técnico)', b'1', '2022-11-23 22:52:44', '2022-11-23 22:53:20'),
(3, 'Superior', '(Técnico superior, Licenciatura y Posgrado)', b'1', '2022-11-23 22:52:44', '2022-11-23 22:53:20');

--
-- Dumping data for table `periodoEscolar`
--

INSERT INTO `periodoEscolar` (`id_periodoEscolar`, `nombre_periodo`, `f_creacion_periodoE`, `f_modificacion_periodoE`) VALUES
(1, 'Semestre', '2022-11-23 22:53:50', '2022-11-23 22:54:01'),
(2, 'Cuatrimestre', '2022-11-23 22:53:50', '2022-11-23 22:54:01');

--
-- Dumping data for table `telefono`
--

INSERT INTO `telefono` (`id_telefono`, `lada_tel`, `numero_telefonico`, `f_creacion_tel`, `f_modificacion_tel`) VALUES
(1, '+52', '2215365896', '2022-11-23 23:03:12', '2022-11-23 23:03:50'),
(2, '+52', '2245987636', '2022-11-23 23:03:12', '2022-11-23 23:03:50'),
(3, '+52', '2259874638', '2022-11-23 23:03:12', '2022-11-23 23:03:50'),
(4, '+52', '2256987415', '2022-11-23 23:03:12', '2022-11-23 23:03:50'),
(5, '+52', '2232568425', '2022-11-23 23:03:12', '2022-11-23 23:03:50');

--
-- Dumping data for table `especializacion`
--

INSERT INTO `especializacion` (`id_especializacion`, `nombre_esp`, `estatus_esp`, `f_creacion_esp`, `f_modificacion_esp`) VALUES
(1, 'Maestría en Inteligencia Artificial', b'1', '2022-11-23 22:56:41', '2022-11-23 22:57:08'),
(2, 'Maestría en Mecánica Automotríz a Gasolina', b'1', '2022-11-23 22:56:41', '2022-11-23 22:57:08'),
(3, 'Maestría en Potencial Eléctrica Atómica', b'1', '2022-11-23 22:56:41', '2022-11-23 22:57:08'),
(4, 'Maestría en Ciencias de la Salud', b'1', '2022-11-23 22:56:41', '2022-11-23 22:57:08');

--
-- Dumping data for table `aula`
--
INSERT INTO `aula`(`id_aula`, `numero_aula`, `nombre_aula`, `grupo_aula`, `numero_asientosAula`, `estatus_aula`, `f_creacion_aula`, `f_modificacion_aula`) VALUES
(1,'1','Creatividad Inicial','A','30', b'1','2022-11-23 22:56:41', '2022-11-23 22:57:08'),
(2,'2','Creatividad Inicial','B','30', b'1','2022-11-23 22:56:41', '2022-11-23 22:57:08'),
(3,'3','Creatividad Inicial','C','30', b'1','2022-11-23 22:56:41', '2022-11-23 22:57:08'),
(4,'10','PRIMERO','A','33', b'1','2022-11-23 22:56:41', '2022-11-23 22:57:08'),
(5,'11','PRIMERO','B','33', b'1','2022-11-23 22:56:41', '2022-11-23 22:57:08'),
(6,'12','PRIMERO','C','33', b'1','2022-11-23 22:56:41', '2022-11-23 22:57:08'),
(7,'100','Multimedia','G1','60', b'1','2022-11-23 22:56:41', '2022-11-23 22:57:08'),
(8,'101','Maquinaria','G1','60', b'1','2022-11-23 22:56:41', '2022-11-23 22:57:08'),
(9,'102','Salón de Mac','G1','60', b'1','2022-11-23 22:56:41', '2022-11-23 22:57:08');

--
-- Dumping data for table `escuela_aula`
--
INSERT INTO `escuela_aula`(`id_escuelaAula`, `nombre_escuela`, `numero_aula`, `nombre_aula`, `grupo_aula`, `f_creacion_aula`, `f_modificacion_aula`, `id_escuela`, `id_aula`) VALUES
(1,'Jardin de Niños Fantasía','1','Creatividad Inicial','A','2022-11-23 22:56:41', '2022-11-23 22:57:08',1,1),
(2,'Jardin de Niños Fantasía','2','Creatividad Inicial','B','2022-11-23 22:56:41', '2022-11-23 22:57:08',1,2),
(3,'Jardin de Niños Fantasía','3','Creatividad Inicial','C','2022-11-23 22:56:41', '2022-11-23 22:57:08',1,3),
(4,'Bachillerato General Oficial José María Sánchez Rojas','10','PRIMERO','A','2022-11-23 22:56:41', '2022-11-23 22:57:08',4,4),
(5,'Bachillerato General Oficial José María Sánchez Rojas','11','PRIMERO','B','2022-11-23 22:56:41', '2022-11-23 22:57:08',4,5),
(6,'Bachillerato General Oficial José María Sánchez Rojas','12','PRIMERO','C','2022-11-23 22:56:41', '2022-11-23 22:57:08',4,6),
(7,'Universidad Politécnica de Amozoc','100','Multimedia','G1','2022-11-23 22:56:41', '2022-11-23 22:57:08',5,7),
(8,'Universidad Politécnica de Amozoc','101','Maquinaria','G1','2022-11-23 22:56:41', '2022-11-23 22:57:08',5,8),
(9,'Universidad Politécnica de Amozoc','102','Salón de Mac','G1','2022-11-23 22:56:41', '2022-11-23 22:57:08',5,9);

--
-- Dumping data for table `pago`
--
INSERT INTO `pago`(`id_pago`, `monto`, `descripcion`, `moneda_concurrencia`, `estatus_pago`, `f_creacion_pago`, `f_modificacion_pago`) VALUES
(1,'200','Exámen de Admisión','MXN','ACTIVO','2022-11-23 22:56:41', '2022-11-23 22:57:08'),
(2,'800','Pago Inscripción','MXN','ACTIVO','2022-11-23 22:56:41', '2022-11-23 22:57:08'),
(3,'360','Exámen de Admisión','MXN','ACTIVO','2022-11-23 22:56:41', '2022-11-23 22:57:08'),
(4,'1300','Pago Inscripción','MXN','ACTIVO','2022-11-23 22:56:41', '2022-11-23 22:57:08'),
(5,'460','Exámen de Admisión','MXN','ACTIVO','2022-11-23 22:56:41', '2022-11-23 22:57:08'),
(6,'1639','Pago Inscripción','MXN','ACTIVO','2022-11-23 22:56:41', '2022-11-23 22:57:08');

--
-- Dumping data for table `escuela_pago`
--
INSERT INTO `escuela_pago`(`id_esc_pago`, `nombre_escuela`, `monto`, `moneda_concurrencia`, `descripcion`, `estatus_pago`, `f_creacion_EscPago`, `f_modificacion_EscPago`, `id_escuela`, `id_pago`) VALUES
(1,'Jardin de Niños Fantasía','200','MXN','Exámen de Admisión','ACTIVO','2022-11-23 22:56:41', '2022-11-23 22:57:08', 1,1),
(2,'Jardin de Niños Fantasía','800','MXN','Pago Inscripción','ACTIVO','2022-11-23 22:56:41', '2022-11-23 22:57:08', 1,2),
(3,'Bachillerato General Oficial José María Sánchez Rojas','360','MXN','Exámen de Admisión','ACTIVO','2022-11-23 22:56:41', '2022-11-23 22:57:08', 4,3),
(4,'Bachillerato General Oficial José María Sánchez Rojas','1300','MXN','Pago Inscripción','ACTIVO','2022-11-23 22:56:41', '2022-11-23 22:57:08', 4,4),
(5,'Universidad Politécnica de Amozoc','460','MXN','Exámen de Admisión','ACTIVO','2022-11-23 22:56:41', '2022-11-23 22:57:08', 5,5),
(6,'Universidad Politécnica de Amozoc','1639','MXN','Pago Inscripción','ACTIVO','2022-11-23 22:56:41', '2022-11-23 22:57:08', 5,6);

--
-- Dumping data for table `escuela_facultad`
--

INSERT INTO `escuela_facultad` (`id_escuela_facultad`, `nombre_escuela`, `nombre_facultad`, `f_creacion_escFacultad`, `f_modificacion_escFacultad`, `id_escuela`, `id_facultad`) VALUES
(1, 'Universidad Politécnica de Amozoc', 'Ciencias Exactas', '2022-11-23 22:55:27', '2022-11-23 22:56:01', 5, 1),
(2, 'Universidad Politécnica de Amozoc', 'Ciencias de la Salud', '2022-11-23 22:55:27', '2022-11-23 22:56:01', 5, 2);

--
-- Dumping data for table `asignatura`
--
INSERT INTO `asignatura`(`id_asignatura`, `nombre_asignatura`, `nombre_corto_asig`, `estatus_asignatura`, `f_creacion_asig`, `f_modificacion_asig`) VALUES
(1,'Educación Socioemocional','ES', b'1','2022-11-23 22:55:27', '2022-11-23 22:56:01'),
(2,'Exploración y comprensión del mundo natural y social','ECMNS', b'1','2022-11-23 22:55:27', '2022-11-23 22:56:01'),
(3,'Pensamiento Matemático','PM', b'1','2022-11-23 22:55:27', '2022-11-23 22:56:01'),
(4,'Geometría y Trigonometría','GEOTRIG', b'1','2022-11-23 22:55:27', '2022-11-23 22:56:01'),
(5,'Filosofía','FSA', b'1','2022-11-23 22:55:27', '2022-11-23 22:56:01'),
(6,'Biología','BGA', b'1','2022-11-23 22:55:27', '2022-11-23 22:56:01'),
(7,'Introducción a la Programación','INPROG-EN', b'1','2022-11-23 22:55:27', '2022-11-23 22:56:01'),
(8,'Algoritmos','ALG-EN', b'1','2022-11-23 22:55:27', '2022-11-23 22:56:01'),
(9,'Inglés I','INGI-US', b'1','2022-11-23 22:55:27', '2022-11-23 22:56:01');


--
-- Dumping data for table `asignatura_aula`
--
INSERT INTO `asignatura_aula`(`id_asinaturaAula`, `nombre_asignatura`, `numero_aula`, `nombre_aula`, `grupo_aula`, `f_creacion_AsigAula`, `f_modificacion_AsigAula`, `id_asignatura`, `id_aula`) VALUES 
(1,'Educación Socioemocional','1','Creatividad Inicial','A','2022-11-23 22:56:41', '2022-11-23 22:57:08',1,1),
(2,'Exploración y comprensión del mundo natural y social','2','Creatividad Inicial','B','2022-11-23 22:56:41', '2022-11-23 22:57:08',2,2),
(3,'Pensamiento Matemático','3','Creatividad Inicial','C','2022-11-23 22:56:41', '2022-11-23 22:57:08',3,3),
(4,'Geometría y Trigonometría','10','PRIMERO','A','2022-11-23 22:56:41', '2022-11-23 22:57:08',4,4),
(5,'Filosofía','11','PRIMERO','B','2022-11-23 22:56:41', '2022-11-23 22:57:08',5,5),
(6,'Biología','12','PRIMERO','C','2022-11-23 22:56:41', '2022-11-23 22:57:08',6,6),
(7,'Introducción a la Programación','100','Creatividad Inicial','G1','2022-11-23 22:56:41', '2022-11-23 22:57:08',7,7),
(8,'Algoritmos','101','Creatividad Inicial','G1','2022-11-23 22:56:41', '2022-11-23 22:57:08',8,9),
(9,'Inglés I','102','Creatividad Inicial','G1','2022-11-23 22:56:41', '2022-11-23 22:57:08',9,7),
(10,'Inglés I','102','Creatividad Inicial','G1','2022-11-23 22:56:41', '2022-11-23 22:57:08',9,8),
(11,'Inglés I','102','Creatividad Inicial','G1','2022-11-23 22:56:41', '2022-11-23 22:57:08',9,9);

--
-- Dumping data for table `planestudios`
--
INSERT INTO `planEstudios`(`id_planEstudios`, `nombre_planEstudios`, `nombre_corto_planE`, `estatus_planEstudios`, `num_creditos_totales`, `num_creditos_min`, `num_creditos_max`, `f_creacion_planE`, `f_modificacion_planE`) VALUES
(1,'Jardín de Niños 2022','JNF-2022', b'1','160','96','160','2022-11-23 22:55:27', '2022-11-23 22:56:01'),
(2,'Bachillerato JMSR 2022','BJMSR-2022', b'1','260','156','260','2022-11-23 22:55:27', '2022-11-23 22:56:01'),
(3,'Ingeniería en Software 2022','ISW-2022', b'1','390','273','390','2022-11-23 22:55:27', '2022-11-23 22:56:01'),
(4,'Ingeniería Automotríz 2022','IAU-2022', b'1','390','273','390','2022-11-23 22:55:27', '2022-11-23 22:56:01'),
(5,'Maestría en Inteligencia Artificial 2022','MIA-2022', b'1','430','301','430','2022-11-23 22:55:27', '2022-11-23 22:56:01');

--
-- Dumping data for table `asignatura_planestudios`
--
INSERT INTO `asignatura_planEstudios`(`id_asigPlanE`, `nombre_asignatura`, `nombre_planE`, `f_creacion_asigPlanE`, `f_modificacion_asigPlanE`, `id_asignatura`, `id_planEstudios`) VALUES
(1,'Educación Socioemocional','Jardín de Niños 2022','2022-11-23 22:55:27', '2022-11-23 22:56:01',1,1),
(2,'Exploración y comprensión del mundo natural y social','Jardín de Niños 2022','2022-11-23 22:55:27', '2022-11-23 22:56:01',2,1),
(3,'Pensamiento Matemático','Jardín de Niños 2022','2022-11-23 22:55:27', '2022-11-23 22:56:01',3,1),
(4,'Geometría y Trigonometría','Bachillerato JMSR 2022','2022-11-23 22:55:27', '2022-11-23 22:56:01',4,2),
(5,'Filosofía','Bachillerato JMSR 2022','2022-11-23 22:55:27', '2022-11-23 22:56:01',5,2),
(6,'Biología','Bachillerato JMSR 2022','2022-11-23 22:55:27', '2022-11-23 22:56:01',6,2),
(7,'Introducción a la Programación','Ingeniería en Software 2022','2022-11-23 22:55:27', '2022-11-23 22:56:01',7,3),
(8,'Algoritmos','Ingeniería en Software 2022','2022-11-23 22:55:27', '2022-11-23 22:56:01',8,3),
(9,'Inglés I','Ingeniería en Software 2022','2022-11-23 22:55:27', '2022-11-23 22:56:01',9,3),
(10,'Inglés I','Ingeniería Automotríz 2022','2022-11-23 22:55:27', '2022-11-23 22:56:01',9,4);

--
-- Dumping data for table `carrera_asignatura`
--
INSERT INTO `carrera_asignatura`(`id_carreraAsig`, `nombre_carrera`, `nombre_asignatura`, `f_creacion_carreraAsig`, `f_modificacion_carreraAsig`, `id_carrera`, `id_asignatura`) VALUES 
(1,'Ingeniería en Software','Introducción a la Programación','2022-11-23 22:55:27', '2022-11-23 22:56:01',1,7),
(2,'Ingeniería en Software','Algoritmos','2022-11-23 22:55:27', '2022-11-23 22:56:01',1,8),
(3,'Ingeniería en Software','Inglés I','2022-11-23 22:55:27', '2022-11-23 22:56:01',1,9),
(4,'Ingeniería Automotríz','Inglés I','2022-11-23 22:55:27', '2022-11-23 22:56:01',2,9);


--
-- Dumping data for table `carrera_periodoescolar`
--
INSERT INTO `carrera_periodoEscolar`(`id_carrera_periodoEscolar`, `nombre_carrera`, `numero_periodoE`, `nombre_periodoE`, `f_inicio_PeriodoE`, `f_termino_PeriodoE`, `f_creacion_carreraPeriodoE`, `f_modificacion_carreraPeriodoE`, `id_carrera`, `id_periodoEscolar`) VALUES
(1,'Ingeniería en Software','1','Cuatrimestre','2022-09-05 22:53:50','2022-12-16 22:53:50', '2022-11-23 22:55:27', '2022-11-23 22:56:01',1,2),
(2,'Ingeniería Automotríz','1','Cuatrimestre','2022-09-05 22:53:50','2022-12-16 22:53:50', '2022-11-23 22:55:27', '2022-11-23 22:56:01',2,2),
(3,'Ingeniería en Energía','1','Cuatrimestre','2022-09-05 22:53:50','2022-12-16 22:53:50', '2022-11-23 22:55:27', '2022-11-23 22:56:01',3,2),
(4,'Ingeniería en Manufactura','1','Cuatrimestre','2022-09-05 22:53:50','2022-12-16 22:53:50', '2022-11-23 22:55:27', '2022-11-23 22:56:01',4,2),
(5,'Ingeniería en Software','2','Cuatrimestre','2022-09-05 22:53:50','2022-12-16 22:53:50', '2022-11-23 22:55:27', '2022-11-23 22:56:01',1,2),
(6,'Ingeniería Automotríz','2','Cuatrimestre','2022-09-05 22:53:50','2022-12-16 22:53:50', '2022-11-23 22:55:27', '2022-11-23 22:56:01',2,2),
(7,'Ingeniería en Energía','2','Cuatrimestre','2022-09-05 22:53:50','2022-12-16 22:53:50', '2022-11-23 22:55:27', '2022-11-23 22:56:01',3,2),
(8,'Ingeniería en Manufactura','2','Cuatrimestre','2022-09-05 22:53:50','2022-12-16 22:53:50', '2022-11-23 22:55:27', '2022-11-23 22:56:01',4,2),
(9,'Ingeniería en Software','3','Cuatrimestre','2022-09-05 22:53:50','2022-12-16 22:53:50', '2022-11-23 22:55:27', '2022-11-23 22:56:01',1,2),
(10,'Ingeniería Automotríz','3','Cuatrimestre','2022-09-05 22:53:50','2022-12-16 22:53:50', '2022-11-23 22:55:27', '2022-11-23 22:56:01',2,2),
(11,'Ingeniería en Energía','3','Cuatrimestre','2022-09-05 22:53:50','2022-12-16 22:53:50', '2022-11-23 22:55:27', '2022-11-23 22:56:01',3,2),
(12,'Ingeniería en Manufactura','3','Cuatrimestre','2022-09-05 22:53:50','2022-12-16 22:53:50', '2022-11-23 22:55:27', '2022-11-23 22:56:01',4,2),
(13,'Ingeniería en Software','4','Cuatrimestre','2022-09-05 22:53:50','2022-12-16 22:53:50', '2022-11-23 22:55:27', '2022-11-23 22:56:01',1,2),
(14,'Ingeniería Automotríz','4','Cuatrimestre','2022-09-05 22:53:50','2022-12-16 22:53:50', '2022-11-23 22:55:27', '2022-11-23 22:56:01',2,2),
(15,'Ingeniería en Energía','4','Cuatrimestre','2022-09-05 22:53:50','2022-12-16 22:53:50', '2022-11-23 22:55:27', '2022-11-23 22:56:01',3,2),
(16,'Ingeniería en Manufactura','4','Cuatrimestre','2022-09-05 22:53:50','2022-12-16 22:53:50', '2022-11-23 22:55:27', '2022-11-23 22:56:01',4,2),
(17,'Ingeniería en Software','5','Cuatrimestre','2022-09-05 22:53:50','2022-12-16 22:53:50', '2022-11-23 22:55:27', '2022-11-23 22:56:01',1,2),
(18,'Ingeniería Automotríz','5','Cuatrimestre','2022-09-05 22:53:50','2022-12-16 22:53:50', '2022-11-23 22:55:27', '2022-11-23 22:56:01',2,2),
(19,'Ingeniería en Energía','5','Cuatrimestre','2022-09-05 22:53:50','2022-12-16 22:53:50', '2022-11-23 22:55:27', '2022-11-23 22:56:01',3,2),
(20,'Ingeniería en Manufactura','5','Cuatrimestre','2022-09-05 22:53:50','2022-12-16 22:53:50', '2022-11-23 22:55:27', '2022-11-23 22:56:01',4,2),
(21,'Ingeniería en Software','6','Cuatrimestre','2022-09-05 22:53:50','2022-12-16 22:53:50', '2022-11-23 22:55:27', '2022-11-23 22:56:01',1,2),
(22,'Ingeniería Automotríz','6','Cuatrimestre','2022-09-05 22:53:50','2022-12-16 22:53:50', '2022-11-23 22:55:27', '2022-11-23 22:56:01',2,2),
(23,'Ingeniería en Energía','6','Cuatrimestre','2022-09-05 22:53:50','2022-12-16 22:53:50', '2022-11-23 22:55:27', '2022-11-23 22:56:01',3,2),
(24,'Ingeniería en Manufactura','6','Cuatrimestre','2022-09-05 22:53:50','2022-12-16 22:53:50', '2022-11-23 22:55:27', '2022-11-23 22:56:01',4,2),
(25,'Ingeniería en Software','7','Cuatrimestre','2022-09-05 22:53:50','2022-12-16 22:53:50', '2022-11-23 22:55:27', '2022-11-23 22:56:01',1,2),
(26,'Ingeniería Automotríz','7','Cuatrimestre','2022-09-05 22:53:50','2022-12-16 22:53:50', '2022-11-23 22:55:27', '2022-11-23 22:56:01',2,2),
(27,'Ingeniería en Energía','7','Cuatrimestre','2022-09-05 22:53:50','2022-12-16 22:53:50', '2022-11-23 22:55:27', '2022-11-23 22:56:01',3,2),
(28,'Ingeniería en Manufactura','7','Cuatrimestre','2022-09-05 22:53:50','2022-12-16 22:53:50', '2022-11-23 22:55:27', '2022-11-23 22:56:01',4,2),
(29,'Ingeniería en Software','8','Cuatrimestre','2022-09-05 22:53:50','2022-12-16 22:53:50', '2022-11-23 22:55:27', '2022-11-23 22:56:01',1,2),
(30,'Ingeniería Automotríz','8','Cuatrimestre','2022-09-05 22:53:50','2022-12-16 22:53:50', '2022-11-23 22:55:27', '2022-11-23 22:56:01',2,2),
(31,'Ingeniería en Energía','8','Cuatrimestre','2022-09-05 22:53:50','2022-12-16 22:53:50', '2022-11-23 22:55:27', '2022-11-23 22:56:01',3,2),
(32,'Ingeniería en Manufactura','8','Cuatrimestre','2022-09-05 22:53:50','2022-12-16 22:53:50', '2022-11-23 22:55:27', '2022-11-23 22:56:01',4,2),
(33,'Ingeniería en Software','9','Cuatrimestre','2022-09-05 22:53:50','2022-12-16 22:53:50', '2022-11-23 22:55:27', '2022-11-23 22:56:01',1,2),
(34,'Ingeniería Automotríz','9','Cuatrimestre','2022-09-05 22:53:50','2022-12-16 22:53:50', '2022-11-23 22:55:27', '2022-11-23 22:56:01',2,2),
(35,'Ingeniería en Energía','9','Cuatrimestre','2022-09-05 22:53:50','2022-12-16 22:53:50', '2022-11-23 22:55:27', '2022-11-23 22:56:01',3,2),
(36,'Ingeniería en Manufactura','9','Cuatrimestre','2022-09-05 22:53:50','2022-12-16 22:53:50', '2022-11-23 22:55:27', '2022-11-23 22:56:01',4,2),
(37,'Ingeniería en Software','10','Cuatrimestre','2022-09-05 22:53:50','2022-12-16 22:53:50', '2022-11-23 22:55:27', '2022-11-23 22:56:01',1,2),
(38,'Ingeniería Automotríz','10','Cuatrimestre','2022-09-05 22:53:50','2022-12-16 22:53:50', '2022-11-23 22:55:27', '2022-11-23 22:56:01',2,2),
(39,'Ingeniería en Energía','10','Cuatrimestre','2022-09-05 22:53:50','2022-12-16 22:53:50', '2022-11-23 22:55:27', '2022-11-23 22:56:01',3,2),
(40,'Ingeniería en Manufactura','10','Cuatrimestre','2022-09-05 22:53:50','2022-12-16 22:53:50', '2022-11-23 22:55:27', '2022-11-23 22:56:01',4,2);

--
-- Dumping data for table `carrera_planestudios`
--
INSERT INTO `carrera_planEstudios`(`id_carreraPlanE`, `nombre_carrera`, `nombre_planEstudios`, `f_creacion_carreraPlanE`, `f_modificacion_carreraPlanE`, `id_carrera`, `id_planEstudios`) VALUES
(1,'Ingeniería en Software','Ingeniería en Software 2022','2022-11-23 22:55:27', '2022-11-23 22:56:01',1,3),
(2,'Ingeniería Automotríz','Ingeniería Automotríz 2022','2022-11-23 22:55:27', '2022-11-23 22:56:01',2,4);


--
-- Dumping data for table `facultad_aula`
--

INSERT INTO `facultad_aula`(`id_facultadAula`, `nombre_facultad`, `numero_aula`, `nombre_aula`, `grupo_aula`, `f_creacion_FacAula`, `f_modificacion_FacAula`, `id_facultad`, `id_aula`) VALUES
(1,'Ciencias Exactas','100','Multimedia','G1','2022-11-23 22:56:41', '2022-11-23 22:57:08', 1, 7),
(2,'Ciencias Exactas','101','Maquinaria','G1','2022-11-23 22:56:41', '2022-11-23 22:57:08', 1, 8),
(3,'Ciencias Exactas','102','Salón de Mac','G1','2022-11-23 22:56:41', '2022-11-23 22:57:08', 1, 9);
--
-- Dumping data for table `escuela_modalidadEscolar`
--

INSERT INTO `escuela_modalidadEscolar` (`id_escuela_modalidadEscolar`, `nombre_escuela`, `nombre_modalidad`, `f_creacion_escuela_modalidad`, `f_modificacion_escuela_modalidad`, `id_escuela`, `id_modalidad`) VALUES
(1, 'Jardin de Niños Fantasía', 'Escolarizada', '2022-11-23 23:09:37', '2022-11-23 23:11:09', 1, 1),
(2, 'Primaria Benito Juárez', 'Escolarizada', '2022-11-23 23:09:37', '2022-11-23 23:11:09', 2, 1),
(3, 'Telesecundaria Gabino Barreda', 'Escolarizada', '2022-11-23 23:09:37', '2022-11-23 23:11:09', 3, 1),
(4, 'Bachillerato General Oficial José María Sánchez Rojas', 'Escolarizada', '2022-11-23 23:09:37', '2022-11-23 23:11:09', 4, 1),
(5, 'Universidad Politécnica de Amozoc', 'Mixta', '2022-11-23 23:09:37', '2022-11-23 23:11:09', 5, 3);

--
-- Dumping data for table `escuela_nivelEducativo`
--

INSERT INTO `escuela_nivelEducativo` (`id_escuela_nivelEducativo`, `nombre_escuela`, `nombre_nivelEducativo`, `f_creacion_escuelaNivelEdu`, `f_modificacion_escuelaNivelEdu`, `id_escuela`, `id_nivelEducativo`) VALUES
(1, 'Jardin de Niños Fantasía', 'Basica', '2022-11-23 23:08:06', '2022-11-23 23:09:20', 1, 1),
(2, 'Primaria Benito Juárez', 'Basica', '2022-11-23 23:08:06', '2022-11-23 23:09:20', 2, 1),
(3, 'Telesecundaria Gabino Barreda', 'Basica', '2022-11-23 23:08:06', '2022-11-23 23:09:20', 3, 1),
(4, 'Bachillerato General Oficial José María Sánchez Rojas', 'Media Superior', '2022-11-23 23:08:06', '2022-11-23 23:09:20', 4, 2),
(5, 'Universidad Politécnica de Amozoc', 'Superior', '2022-11-23 23:08:06', '2022-11-23 23:09:20', 5, 3);

--
-- Dumping data for table `escuela_periodoEscolar`
--
 
INSERT INTO `escuela_periodoEscolar` (`id_escuela_periodoEscolar`, `nombre_escuela`, `numero_periodoE`, `nombre_periodoE`, `f_inicio_periodoE`, `f_termino_periodoE`, `f_creacion_escuelaPE`, `f_modificacion_escuelaPE`, `id_escuela`, `id_periodoEscolar`) VALUES
(1, 'Jardin de Niños Fantasía', 1, 'Semestre', '2022-07-05 22:53:50','2022-12-16 22:53:50', '2022-11-23 23:06:17', '2022-11-23 23:07:45', 1, 1),
(2, 'Primaria Benito Juárez', 1, 'Semestre', '2022-07-05 22:53:50','2022-12-16 22:53:50', '2022-11-23 23:06:17', '2022-11-23 23:07:45', 2, 1),
(3, 'Telesecundaria Gabino Barreda', 1, 'Semestre', '2022-07-05 22:53:50','2022-12-16 22:53:50', '2022-11-23 23:06:17', '2022-11-23 23:07:45', 3, 1),
(4, 'Bachillerato General Oficial José María Sánchez Rojas', 1, 'Semestre', '2022-07-05 22:53:50','2022-12-16 22:53:50', '2022-11-23 23:06:17', '2022-11-23 23:07:45', 4, 1),
(5, 'Universidad Politécnica de Amozoc', 1, 'Cuatrimestre', '2022-09-05 22:53:50','2022-12-16 22:53:50', '2022-11-23 23:06:17', '2022-11-23 23:07:45', 5, 2);

--
-- Dumping data for table `escuela_Telefono`
--

INSERT INTO `escuela_Telefono` (`id_escuela_telefono`, `departamento_escuela`, `numero_telefonico`, `f_creacion_escuela_telefono`, `f_modificacion_escuela_telefono`, `id_escuela`, `id_telefono`) VALUES
(1, 'Servicios Escolares', '2216535896', '2022-11-23 23:04:10', '2022-11-23 23:05:53', 1, 1),
(2, 'Servicios Escolares', '2245987636', '2022-11-23 23:04:10', '2022-11-23 23:05:53', 2, 2),
(3, 'Servicios Escolares', '2259874638', '2022-11-23 23:04:10', '2022-11-23 23:05:53', 3, 3),
(4, 'Servicios Escolares', '2256987415', '2022-11-23 23:04:10', '2022-11-23 23:05:53', 4, 4),
(5, 'Servicios Escolares', '2232568425', '2022-11-23 23:04:10', '2022-11-23 23:05:53', 5, 5);

--
-- Dumping data for table `facultad_carrera`
--

INSERT INTO `facultad_carrera` (`id_facultadCarrera`, `nombre_facultad`, `nombre_carrera`, `f_creacion_faCarrera`, `f_modificacion_faCarrera`, `id_facultad`, `id_carrera`) VALUES
(1, 'Ciencias Exactas', 'Ingeniería en Software', '2022-11-23 23:01:43', '2022-11-23 23:02:50', 1, 1),
(2, 'Ciencias Exactas', 'Ingeniería Automotríz', '2022-11-23 23:01:43', '2022-11-23 23:02:50', 1, 2),
(3, 'Ciencias Exactas', 'Ingeniería en Energía', '2022-11-23 23:01:43', '2022-11-23 23:02:50', 1, 3),
(4, 'Ciencias Exactas', 'Ingeniería en Manufactura', '2022-11-23 23:01:43', '2022-11-23 23:02:50', 1, 4);

--
-- Dumping data for table `facultad_especializacion`
--

INSERT INTO `facultad_especializacion` (`id_facultadEsp`, `nombre_facultad`, `nombre_esp`, `f_creacion_faEsp`, `f_modificacion_faEsp`, `id_facultad`, `id_especializacion`) VALUES
(1, 'Ciencias Exactas', 'Maestría en Inteligencia Artificial', '2022-11-23 23:00:05', '2022-11-23 23:01:07', 1, 1),
(2, 'Ciencias Exactas', 'Maestría en Mecánica Automotríz a Gasolina', '2022-11-23 23:00:05', '2022-11-23 23:01:07', 1, 2),
(3, 'Ciencias Exactas', 'Maestría en Potencial Eléctrica Atómica', '2022-11-23 23:00:05', '2022-11-23 23:01:07', 1, 3),
(4, 'Ciencias de la Salud', 'Maestría en Ciencias de la Salud', '2022-11-23 23:00:05', '2022-11-23 23:01:07', 1, 4);
