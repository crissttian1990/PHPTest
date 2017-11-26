-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 10-06-2014 a las 17:20:22
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `mepregunto2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
  `idanswer` int(11) NOT NULL AUTO_INCREMENT,
  `answer` text COLLATE utf8_spanish_ci NOT NULL,
  `idautor` int(11) NOT NULL,
  `idquestion` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`idanswer`),
  KEY `idautor` (`idautor`),
  KEY `idquestion` (`idquestion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `answers`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `idcategory` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `description` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idcategory`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `categories`
--



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `idlike` int(11) NOT NULL AUTO_INCREMENT,
  `idanswer` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`idlike`),
  KEY `idanswer` (`idanswer`),
  KEY `iduser` (`iduser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `likes`
--



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `idquestion` int(11) NOT NULL AUTO_INCREMENT,
  `question` text COLLATE utf8_spanish_ci NOT NULL,
  `questiontext` text COLLATE utf8_spanish_ci NOT NULL,
  `idcategory` int(11) NOT NULL,
  `idautor` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `views` int(11) NOT NULL,
  PRIMARY KEY (`idquestion`),
  KEY `idcategory` (`idcategory`),
  KEY `idautor` (`idautor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=39 ;

--
-- Volcado de datos para la tabla `questions`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `iduser` int(11) NOT NULL AUTO_INCREMENT,
  `nick` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `mail` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `birthday` date DEFAULT NULL,
  `country` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `idpermission` int(11) NOT NULL,
  `avatar` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`iduser`,`nick`),
  UNIQUE KEY `iduser` (`iduser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`iduser`, `nick`, `pass`, `mail`, `birthday`, `country`, `idpermission`, `avatar`) VALUES
(1, 'administrador', '91f5167c34c400758115c2a6826ec2e3', 'administrador@mepregunto.com', '2000-01-01', 'España', 2, 'img/avatar/avatar.jpg'),


--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`idautor`) REFERENCES `users` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `answers_ibfk_2` FOREIGN KEY (`idquestion`) REFERENCES `questions` (`idquestion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`idanswer`) REFERENCES `answers` (`idanswer`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`iduser`) REFERENCES `users` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`idcategory`) REFERENCES `categories` (`idcategory`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `questions_ibfk_2` FOREIGN KEY (`idautor`) REFERENCES `users` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
