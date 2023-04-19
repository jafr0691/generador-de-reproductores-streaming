-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 18-04-2023 a las 23:15:37
-- Versión del servidor: 10.6.12-MariaDB-cll-lve
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ppsltots_crm`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `logo` varchar(150) NOT NULL,
  `favicon` varchar(150) NOT NULL,
  `text_footer` text NOT NULL,
  `web` varchar(100) NOT NULL,
  `servidores` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `firma` text DEFAULT NULL,
  `facebook` varchar(100) NOT NULL,
  `messenger` varchar(100) NOT NULL,
  `twitter` varchar(100) NOT NULL,
  `instagram` varchar(100) NOT NULL,
  `youtube` varchar(100) NOT NULL,
  `whatsapp` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id`, `id_user`, `logo`, `favicon`, `text_footer`, `web`, `servidores`, `firma`, `facebook`, `messenger`, `twitter`, `instagram`, `youtube`, `whatsapp`) VALUES
(1, 1, '/img/pefiles/1/logo/logo.png', '/img/pefiles/1/favicon/favicon.png', 'Evolucion Streaming - Servicios Informáticos', 'https://www.evolucionstreaming.com', '[\"streaming.evolucionstreaming.com\",\"streaming.suradioonline.com\",\"streaming.radiosenlinea.com.ar\",\"streaming01.shockmedia.com.ar\"]', '<tbody>\n					<tr>\n						<td style=\"padding:0\" bgcolor=\"#fff\"><a href=\"https://www.evolucionstreaming.com/\" target=\"_blank\" data-saferedirecturl=\"https://www.google.com/url?q=https://www.evolucionstreaming.com/&amp;source=gmail&amp;ust=1639758739812000&amp;usg=AOvVaw2jsTCIRD843NdnuBg-w4X_\"><center><img alt=\"El equipo de Evolucion Streaming - Servicios Informáticos\" border=\"0\" height=\"\" src=\"https://ci6.googleusercontent.com/proxy/VCUcE0j5uILaGgfLMSNfFZ1a87jcNKjttq63ZXB-_mfBuLT2VUBCJYOFG5-FNhxytBRm3zGgVLqbO0qIEz-jswFlH1sW4A=s0-d-e1-ft#https://evolucionstreaming.com/boletin/original.png\" style=\"width:100%;max-width:600px;height:auto;background-color:#fff;font-family:sans-serif;font-size:15px;color:#555555;display:block;outline:none;text-decoration:none;margin:auto;border:0\" width=\"600\" class=\"CToWUd\"></center> </a></td>\n					</tr>\n					<tr style=\"background-color:#f4f4f4\">\n						<td>\n						<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" role=\"presentation\" style=\"border-collapse:collapse\" width=\"100%\" bgcolor=\"#f4f4f4\">\n							<tbody>\n								<tr>\n									<td width=\"27%\"></td>\n									<td><a href=\"https://www.facebook.com/evolucionstream\" target=\"_blank\" data-saferedirecturl=\"https://www.google.com/url?q=https://www.facebook.com/evolucionstream&amp;source=gmail&amp;ust=1639758739812000&amp;usg=AOvVaw3UIJsfvprQQPfuyoqwLor7\"><img alt=\"Facebook\" border=\"0\" height=\"\" src=\"https://ci4.googleusercontent.com/proxy/nzN4yAFaJXRjaq7d1NQxF_XASbOdtxQZabPyMBP6fUci2FJ2W1I1W6we8W1uS3VMbs5Ea9nCoBl7UuzCDtuxrHLlMuPaQA=s0-d-e1-ft#https://evolucionstreaming.com/boletin/facebook.png\" style=\"width:100%;max-width:29px;height:auto;background-color:#f4f4f4;font-family:sans-serif;font-size:15px;line-height:15px;color:#333333;display:block;outline:none;text-decoration:none;margin:auto;border:0\" width=\"32\" class=\"CToWUd\"></a></td>\n									<td><a href=\"https://twitter.com/evolucionstream\" target=\"_blank\" data-saferedirecturl=\"https://www.google.com/url?q=https://twitter.com/evolucionstream&amp;source=gmail&amp;ust=1639758739812000&amp;usg=AOvVaw2ztRLErc6XcUvyP285F0aS\"><img alt=\"Twitter\" border=\"0\" height=\"\" src=\"https://ci3.googleusercontent.com/proxy/FGk79PFBp6Fk-oOprY2GtAGhQ-xIBMDKDaLBIjZA9mGApz_3vOm9hWra40SwRkQEHda4SHifV87YWCDrC__srsWqGEBX=s0-d-e1-ft#https://evolucionstreaming.com/boletin/twitter.png\" style=\"width:100%;max-width:29px;height:auto;background-color:#f4f4f4;font-family:sans-serif;font-size:15px;line-height:15px;color:#333333;display:block;outline:none;text-decoration:none;margin:auto;border:0\" width=\"32\" class=\"CToWUd\"></a></td>\n									<td><a href=\"https://www.instagram.com/evolucionstream\" target=\"_blank\" data-saferedirecturl=\"https://www.google.com/url?q=https://www.instagram.com/evolucionstream&amp;source=gmail&amp;ust=1639758739812000&amp;usg=AOvVaw0MK8874YRJPbvUEG0AFl2g\"><img alt=\"Instagram\" border=\"0\" height=\"\" src=\"https://ci3.googleusercontent.com/proxy/XtCmWP2JXCCqFGIMhCSsb5Xy1mh7ka0WeQVTo6fQSwH5tur49gJuQj4lE5eGkODKA4SsJiVlLUWh00_SmmL-CB_WW77IITU=s0-d-e1-ft#https://evolucionstreaming.com/boletin/instagram.png\" style=\"width:100%;max-width:29px;height:auto;background-color:#f4f4f4;font-family:sans-serif;font-size:15px;line-height:15px;color:#333333;display:block;outline:none;text-decoration:none;margin:auto;border:0\" width=\"32\" class=\"CToWUd\"></a></td>\n									<td><a href=\"https://www.evolucionstreaming.com/\" target=\"_blank\" data-saferedirecturl=\"https://www.google.com/url?q=https://www.evolucionstreaming.com/&amp;source=gmail&amp;ust=1639758739812000&amp;usg=AOvVaw2jsTCIRD843NdnuBg-w4X_\"><img alt=\"Ualá\" border=\"0\" height=\"\" src=\"https://ci3.googleusercontent.com/proxy/hCyjlOoEPwuJr0oJGUYTg1K0IFPoIICOwYTiUHoRMz2MbXnbG4ah8oFhiIy7a5Y2emuB_tVsg3cK5Pb6lJVBKkY=s0-d-e1-ft#https://evolucionstreaming.com/boletin/web.png\" style=\"width:100%;max-width:29px;height:auto;background-color:#f4f4f4;font-family:sans-serif;font-size:15px;line-height:15px;color:#333333;display:block;outline:none;text-decoration:none;margin:auto;border:0\" width=\"32\" class=\"CToWUd\"></a></td>\n                                    <td><a href=\"https://wa.me/541162474531\" target=\"_blank\" data-saferedirecturl=\"https://www.google.com/url?q=https://wa.me/541162474531&amp;source=gmail&amp;ust=1639758739812000&amp;usg=AOvVaw1WbI20J6rzrEoelcwZxW0u\"><img alt=\"Ualá\" border=\"0\" height=\"\" src=\"https://ci6.googleusercontent.com/proxy/lZSNkwnxwIDR5MdKV1yOyb2rR6HxsCKICTyHhN10SXnfDKJojuxZNxUf3idUdKxKGDxYjXfdMEYcuq4EsG7y1XqdWaEwZg=s0-d-e1-ft#https://evolucionstreaming.com/boletin/whatsapp.png\" style=\"width:100%;max-width:29px;height:auto;background-color:#f4f4f4;font-family:sans-serif;font-size:15px;line-height:15px;color:#333333;display:block;outline:none;text-decoration:none;margin:auto;border:0\" width=\"32\" class=\"CToWUd\"></a></td>\n									<td width=\"27%\"></td>\n								</tr>\n							</tbody>\n						</table>\n						</td>\n					</tr>\n					<tr>\n						<td bgcolor=\"#f4f4f4\">\n						<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" role=\"presentation\" width=\"100%\" style=\"border-collapse:collapse\">\n							<tbody>\n								<tr>\n									<td style=\"font-family:sans-serif;font-size:15px;line-height:20px;color:#333333;padding:35px 0 20px\" align=\"center\">\n									<div>Si tenés alguna consulta, escribinos a través de nuestras redes sociales,<br>\n									el chat de WhatsApp o por correo a <a href=\"mailto:info@evolucionstreaming.com\" style=\"color:#3e6bfd;text-decoration:underline\" target=\"_blank\"><u>info@evolucionstreaming.com</u></a></div>\n									</td>\n								</tr>\n								<tr>\n								<td align=\"center\" valign=\"top\">\n                                    <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" id=\"m_-79948416150329752templateFooter\">\n                                        <tbody><tr>\n                                            <td valign=\"top\" style=\"color: grey;font-size: 12px;padding: 20px;text-align: center;\">\n                                                 <a href=\"https://www.evolucionstreaming.com\" target=\"_blank\" data-saferedirecturl=\"https://www.google.com/url?q=https://www.evolucionstreaming.com&amp;source=gmail&amp;ust=1639758739812000&amp;usg=AOvVaw0R2yS9nPWurCZOopQshmFt\">Visitar nuestro sitio web</a>\n                                                <span class=\"m_-79948416150329752hide-mobile\"> | </span>\n                                                <a href=\"https://clientes.evolucionstreaming.com/\" target=\"_blank\" data-saferedirecturl=\"https://www.google.com/url?q=https://clientes.evolucionstreaming.com/&amp;source=gmail&amp;ust=1639758739812000&amp;usg=AOvVaw15T97P7CsFBvHr-kECc1cH\">Ingresar a tu cuenta</a>\n                                                <span class=\"m_-79948416150329752hide-mobile\"> | </span>\n                                                <a href=\"https://clientes.evolucionstreaming.com/submitticket.php\" target=\"_blank\" data-saferedirecturl=\"https://www.google.com/url?q=https://clientes.evolucionstreaming.com/submitticket.php&amp;source=gmail&amp;ust=1639758739813000&amp;usg=AOvVaw2_sEH_SAVRdedzj5HYc0N8\">Solicitar Soporte</a> <br>\n                                                Copyright 2013 - 2021 © Evolucion Streaming - Servicios Informáticos, Todos los derechos reservados.\n                                            </td>\n                                        </tr>\n                                    </tbody></table>\n                                </td>	\n		</tr>\n	</tbody>\n</table>\n\n									</td>\n								</tr>\n							</tbody>', 'evolucionstream', 'evolucionstream', 'evolucionstream', 'evolucionstream', 'evolucionstream', 'evolucionstream');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programacion`
--

CREATE TABLE `programacion` (
  `id_programa` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_repro` int(11) NOT NULL,
  `programa` varchar(250) NOT NULL,
  `url_portada` varchar(200) NOT NULL,
  `locutor` varchar(150) NOT NULL,
  `inicio` varchar(20) NOT NULL,
  `final` varchar(20) NOT NULL,
  `zonahoraria` varchar(100) NOT NULL,
  `dias` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `programacion`
--

INSERT INTO `programacion` (`id_programa`, `id_user`, `id_repro`, `programa`, `url_portada`, `locutor`, `inicio`, `final`, `zonahoraria`, `dias`) VALUES
(2, 1, 82, 'radio teste edi', 'https://3.bp.blogspot.com/-Zq4qi5pwJuY/Uj8MixZ4EOI/AAAAAAABCzo/GMa-Z0IlSYw/s1600/minions+28.jpg', 'teste edi', '16:05', '20:05', 'America/Argentina/Buenos_Aires', '[\"6\"]'),
(3, 1, 20, 'redio teste 2', '/img/programacion/portadas/1620.gif', 'teste 2', '18:00', '23:00', 'America/Caracas', '[\"1\",\"2\",\"3\"]'),
(4, 1, 0, 'programa teste 3', '/img/programacion/portadas/1649.jpg', 'teste progra 3', '16:05', '08:05', 'America/Caracas', ''),
(5, 1, 0, 'programa 4', '/img/programacion/portadas/1812.jpg', 'locutor 4', '12:06', '12:10', 'America/Caracas', ''),
(7, 1, 51, 'programa 5', '/img/programacion/portadas/1889.jpg', 'locutor 5', '21:00', '23:06', 'America/Argentina/Buenos_Aires', '[\"1\",\"3\",\"5\"]'),
(9, 1, 19, 'programa 6', '/img/programacion/portadas/6275.png', 'locutor 6', '22:30', '06:00', 'America/Argentina/Buenos_Aires', '[\"5\",\"6\"]'),
(10, 1, 88, 'Silvia', '/img/programacion/portadas/1427.gif', 'La secre', '12:00', '23:00', 'America/Argentina/Buenos_Aires', '[\"1\",\"2\"]'),
(23, 1, 54, 'demo', '/img/programacion/portadas/1117.jpg', 'charly', '01:07', '01:16', 'America/Argentina/Buenos_Aires', '[\"4\"]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relacionrepro`
--

CREATE TABLE `relacionrepro` (
  `id` int(11) NOT NULL,
  `iduser` int(11) DEFAULT NULL,
  `idrepro` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `relacionrepro`
--

INSERT INTO `relacionrepro` (`id`, `iduser`, `idrepro`) VALUES
(1, 2147483647, 2147483646);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reproductores`
--

CREATE TABLE `reproductores` (
  `ID` int(4) NOT NULL,
  `user_id` int(11) NOT NULL,
  `Mampara` varchar(50) NOT NULL,
  `Tema` varchar(7) NOT NULL DEFAULT 'uno',
  `SVersion` varchar(30) NOT NULL,
  `Color` varchar(30) NOT NULL,
  `Servidor` varchar(255) NOT NULL,
  `Puerto` int(5) NOT NULL,
  `CPuerto` int(5) NOT NULL,
  `BPuerto` int(5) NOT NULL,
  `Montaje` varchar(10) NOT NULL,
  `Autoplay` varchar(8) NOT NULL,
  `Blur` varchar(8) NOT NULL,
  `vertical` varchar(8) NOT NULL,
  `Latido` varchar(40) NOT NULL,
  `btn` varchar(40) NOT NULL,
  `abtn` varchar(15) NOT NULL,
  `Artista` varchar(30) NOT NULL,
  `Cancion` varchar(50) NOT NULL,
  `enlace` varchar(350) NOT NULL,
  `UserDominio` varchar(250) NOT NULL,
  `TituloEmisora` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `TituloWeb` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `WebDescription` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `Logo` varchar(255) NOT NULL,
  `Logo2` varchar(255) NOT NULL,
  `Cover2` varchar(200) NOT NULL,
  `Artwork` varchar(5) NOT NULL,
  `Playstore` varchar(150) NOT NULL,
  `Facebook` varchar(150) NOT NULL,
  `Twitter` varchar(150) NOT NULL,
  `Winamp` varchar(150) NOT NULL,
  `Messenger` varchar(250) NOT NULL,
  `Whatsapp` varchar(250) NOT NULL,
  `Instagram` varchar(250) NOT NULL,
  `Youtube` varchar(250) NOT NULL,
  `ventana` text DEFAULT NULL,
  `ventana2` text DEFAULT NULL,
  `Listeners` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `reproductores`
--

INSERT INTO `reproductores` (`ID`, `user_id`, `Mampara`, `Tema`, `SVersion`, `Color`, `Servidor`, `Puerto`, `CPuerto`, `BPuerto`, `Montaje`, `Autoplay`, `Blur`, `vertical`, `Latido`, `btn`, `abtn`, `Artista`, `Cancion`, `enlace`, `UserDominio`, `TituloEmisora`, `TituloWeb`, `WebDescription`, `Logo`, `Logo2`, `Cover2`, `Artwork`, `Playstore`, `Facebook`, `Twitter`, `Winamp`, `Messenger`, `Whatsapp`, `Instagram`, `Youtube`, `ventana`, `ventana2`, `Listeners`) VALUES
(19, 1, 'hidden', 'uno', 'icecast', 'ac3131', 'streaming.evolucionstreaming.com', 10868, 9908, 0, '/stream', 'true', 'true', 'false', 'Haga click para comenzar a reproducir', 'purple', 'pink', 'En vivo Charly', 'Buena Música las 24 horas! y mas ...', 'https://www.evolucionstreaming.com.ar', 'https://radiofan.com.ar', 'RADIO FAN', 'FM RADIO FAN', 'LA RADIO DEL SIGLO', '/img/portadas/1648.png', '5670.jpg', '', 'true', '', '', '#', '', '', '#', '#', '#', 'width: 100%; height: 117px;', 'width=326,height=117', 'true'),
(20, 1, 'visible', 'uno', '1', 'ffffff', 'streaming.evolucionstreaming.com', 10965, 0, 0, '/stream', 'true', 'false', 'false', 'Haga click para comenzar a reproducir', 'black', 'blue', 'En vivo', 'Buena Música las 24 horas!', 'https://www.evolucionstreaming.com.ar', '', 'DEMO', '', '', '/img/portadas/4475.jpeg', '', '', 'true', '', '', '', '', '', '', '', '', 'width: 100%; height: 117px;', 'width=326,height=117', 'true'),
(22, 1, 'visible', 'uno', '2', 'ffffff', 'streaming01.shockmedia.com.ar', 10542, 0, 0, '/stream', 'true', 'true', 'false', 'Haga click para comenzar a reproducir', 'black', 'green', 'En vivo 2', 'Buena Música las 24 horas! con Charly...', 'https://www.evolucionstreaming.com.ar', 'jesus', 'PRUEBA', 'PRUEBA', 'REA', '/img/portadas/2123.png', '', '', 'true', '', '', '', '', '', '', '', '', 'width: 100%; height: 117px;', 'width=326,height=117', 'true'),
(31, 1, 'visible', 'uno', '2', 'ffffff', 'streaming.evolucionstreaming.com', 10965, 9908, 0, '/stream', 'true', 'true', 'false', 'Haga click para comenzar a reproducir', 'black', 'pink', 'En vivo', 'Buena Música las 24 horas!', 'https://www.evolucionstreaming.com.ar', '', 'DEMO PRUEBA', '', '', '/img/portadas/', '', '', 'true', '', '', '', '', '', '', '', '', 'width: 100%; height: 117px;', 'width=326,height=117', 'true'),
(33, 1, 'visible', 'uno', '2', 'ffffff', 'streaming.evolucionstreaming.com', 10965, 0, 0, '/stream', 'true', 'true', 'false', 'Haga click para comenzar a reproducir', 'black', 'pink', 'En vivo', 'Buena Música las 24 horas!', 'https://www.evolucionstreaming.com.ar', '', 'PRUEBA 01', '', '', '', '', '', 'true', '', '', '', '', '', '', '', '', 'width: 100%; height: 117px;', 'width=326,height=117', 'true'),
(51, 1, 'visible', 'uno', '2', 'ffffff', 'streaming.evolucionstreaming.com', 10965, 0, 0, '/stream', 'true', 'true', 'false', 'Haga click para comenzar a reproducir', 'black', 'pink', 'En vivo', 'Buena Música las 24 horas!', 'https://www.evolucionstreaming.com', '', 'DEMO CHARL', '', '', '', '/img/fb/', '/img/cover/', 'false', '', '', '', '', '', 'hola', '', '', 'width: 100%; height: 117px;', 'width=326,height=117', 'true'),
(54, 1, 'hidden', 'uno', '2', 'ffffff', 'streaming.evolucionstreaming.com', 10990, 0, 0, '/stream', 'true', 'true', 'false', 'Haga click para comenzar a reproducir', 'black', 'pink', 'En vivo...', 'Buena Música las 24 horas!.', 'https://www.evolucionstreaming.com', '', 'DEMO CHARLY', '', '', '/img/portadas/', '/img/fb/', '/img/cover/', 'false', '', '', '', '', '', '', '', '', 'width: 100%; height: 117px;', 'width=326,height=117', 'true'),
(55, 1, 'visible', 'uno', '2', 'ffffff', 'streaming.evolucionstreaming.com', 10965, 0, 0, '/stream', 'true', 'true', 'false', 'Haga click para comenzar a reproducir', 'black', 'pink', 'En vivo', 'Buena Música las 24 horas!', 'https://www.evolucionstreaming.com', '', 'JESUS TESTE', '', '', '/img/portadas/1984.jpg', '/img/fb/1832.jpg', '/img/cover/1744.jpg', 'true', '', '', '', '', '', '', '', '', 'width: 100%; height: 117px;', 'width=326,height=117', 'true'),
(62, 1, 'visible', 'tres', '2', 'ffffff', 'streaming.evolucionstreaming.com', 10965, 0, 0, '/stream', 'true', 'true', 'false', 'Haga click para comenzar a reproducir', 'black', 'grey', 'En vivo Charly', 'Buena Música las 24 horas! y mucho mas ....', 'https://www.evolucionstreaming.com', '', 'DEMO 21', '', '', '/img/portadas/1212.jpg', '/img/fb/', '/img/cover/', 'true', '', '', '', '', '', '', '', '', 'width: 100%; height: 400px;', 'width=360,height=300', 'true'),
(70, 1, 'visible', 'uno', '2', 'ffffff', 'streaming01.shockmedia.com.ar', 10542, 0, 0, '/stream', 'true', 'true', 'false', 'Haga click para comenzar a reproducir', 'black', 'pink', 'En vivo ...', 'Buena Música las 24 horas!...', 'https://www.evolucionstreaming.com', '', 'GALANA FM 2 ', '', '', '/img/portadas/9443.jpg', '/img/fb/', '/img/cover/', 'true', '', '', '', '', '', '', '', '', 'width: 100%; height: 117px;', 'width=326,height=117', 'false'),
(80, 1, 'visible', 'cinco', '2', 'ffffff', 'streaming.evolucionstreaming.com', 10965, 0, 0, '/stream', 'true', 'true', 'false', 'Haga click para comenzar a reproducir', 'black', 'pink', 'En vivo', 'Buena Música las 24 horas!', 'https://www.evolucionstreaming.com', '', 'DEMO 5 CHARLY', '', '', '/img/portadas/1834.png', '/img/fb/', '/img/cover/', 'true', '', '', '', '', '', '', '', '', '', '', 'true'),
(83, 1, 'visible', 'cinco', '2', 'ffffff', 'streaming.evolucionstreaming.com', 10965, 0, 0, '/stream', 'true', 'true', 'false', 'Haga click para comenzar a reproducir', 'black', 'pink', 'En vivo', 'Buena Música las 24 horas!', 'https://www.evolucionstreaming.com', '', 'DEMO 05 V3', '', '', 'https://http2.mlstatic.com/D_NQ_NP_919011-MLA29761463820_032019-O.webp', '/img/fb/', '/img/cover/', 'true', '', '', '', '', '', '', '', '', '', '', 'true'),
(85, 1, 'visible', 'cuatro', '2', 'ffffff', 'streaming.evolucionstreaming.com', 10965, 0, 0, '/stream', 'true', 'true', 'false', 'Haga click para comenzar a reproducir', 'black', 'pink', 'En vivo', 'Buena Música las 24 horas!', 'https://www.evolucionstreaming.com', '', 'DEMO 004', '', '', '/img/portadas/1394.png', '/img/fb/', '/img/cover/', 'true', '', '', '', '', '', '', '', '', '', '', 'true'),
(86, 1, 'visible', 'cinco', '2', '#ffffff', 'streaming.evolucionstreaming.com', 10965, 0, 0, '/stream', 'true', 'true', 'false', 'Haga click para comenzar a reproducir', 'black', 'pink', 'En vivo', 'Buena M&uacute;sica las 24 horas!', 'https://www.evolucionstreaming.com', '', 'DEMO 05 V5', '', '', '/img/portadas/', '/img/fb/', '/img/cover/', 'true', '', '', '', '', '', '', '', '', '', NULL, 'true'),
(88, 1, 'visible', 'seis', '2', 'ffffff', 'streaming.evolucionstreaming.com', 10965, 0, 0, '/stream', 'true', 'true', 'false', 'Haga click para comenzar a reproducir', 'black', 'pink', 'En vivo', 'Buena Música las 24 horas!', 'https://www.evolucionstreaming.com', '', 'DEMO 06 CHARLY', '', '', '/img/portadas/', '/img/fb/', '/img/cover/', 'false', '', '', '', '', '', '', '', '', '', '', 'true'),
(89, 1, 'visible', 'seis', '2', '#ffffff', 'streaming.evolucionstreaming.com', 10965, 0, 0, '/stream', 'true', 'true', 'false', 'Haga click para comenzar a reproducir', 'black', 'pink', 'En vivo', 'Buena M&uacute;sica las 24 horas!', 'https://www.evolucionstreaming.com', '', 'DEMO 06 V2 CHARL', '', '', '/img/portadas/', '/img/fb/1990.jpg', '/img/cover/', 'true', '', '', '', '', '', '', '', '', '', NULL, 'true'),
(100, 1, 'visible', 'uno', '', '#ffffff', 'streaming.evolucionstreaming.com', 10965, 0, 0, '/;stream', 'true', 'true', 'false', 'Haga click para comenzar a reproducir', 'black', 'pink', 'En vivo', 'Buena M&uacute;sica las 24 horas!', 'https://www.evolucionstreaming.com', '', 'DEMO NUEVO', '', '', '/img/portadas/', '/img/fb/', '/img/cover/', 'true', '', '', '', '', '', '', '', '', 'width: 100%; height: 117px;', NULL, 'true'),
(101, 1, 'visible', 'uno', '', '#ffffff', 'streaming.evolucionstreaming.com', 10965, 0, 0, '/;stream', 'true', 'true', 'false', 'Haga click para comenzar a reproducir', 'black', 'pink', 'En vivo', 'Buena M&uacute;sica las 24 horas!', 'https://www.evolucionstreaming.com', '', 'DEMO NUEVO 01', '', '', '/img/portadas/', '/img/fb/', '/img/cover/', 'true', '', '', '', '', '', '', '', '', 'width: 100%; height: 117px;', NULL, 'true'),
(102, 1, 'visible', 'uno', '', '#ffffff', 'streaming.evolucionstreaming.com', 10965, 0, 0, '/;stream', 'true', 'true', 'false', 'Haga click para comenzar a reproducir', 'black', 'pink', 'En vivo', 'Buena M&uacute;sica las 24 horas!', 'https://www.evolucionstreaming.com', '', 'DEMO NUEVO 05', '', '', '/img/portadas/', '/img/fb/', '/img/cover/', 'true', '', '', '', '', '', '', '', '', 'width: 100%; height: 117px;', NULL, 'true'),
(103, 1, 'visible', 'uno', '1', '#ffffff', 'streaming.evolucionstreaming.com', 10965, 0, 0, '/;stream', 'true', 'true', 'false', 'Haga click para comenzar a reproducir', 'black', 'pink', 'En vivo', 'Buena M&uacute;sica las 24 horas!', 'https://www.evolucionstreaming.com', '', 'DEMO HOY', '', '', '/img/portadas/', '/img/fb/', '/img/cover/', 'true', '', '', '', '', '', '', '', '', 'width: 100%; height: 117px;', NULL, 'true'),
(104, 1, 'visible', 'uno', '2', '#ffffff', 'streaming.evolucionstreaming.com', 10990, 0, 0, 'stream', 'true', 'true', 'false', 'Haga click para comenzar a reproducir', 'black', 'pink', 'En vivo', 'Buena M&uacute;sica las 24 horas!', 'https://www.evolucionstreaming.com', '', 'DEMO MA&Ntilde;ANA', '', '', '/img/portadas/', '/img/fb/', '/img/cover/', 'true', '', '', '', '', '', '', '', '', 'width: 100%; height: 117px;', NULL, 'true'),


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(70) DEFAULT NULL,
  `password` varchar(60) NOT NULL,
  `activacion` int(3) NOT NULL,
  `token` varchar(100) DEFAULT NULL,
  `token_password` varchar(100) DEFAULT NULL,
  `password_request` int(3) NOT NULL,
  `roles` varchar(10) NOT NULL,
  `crear` int(11) NOT NULL,
  `activ` int(1) DEFAULT NULL,
  `userid` int(11) NOT NULL,
  `hast` varchar(70) DEFAULT NULL,
  `acthash` int(3) NOT NULL DEFAULT 2,
  `date` varchar(19) NOT NULL,
  `ip` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `activacion`, `token`, `token_password`, `password_request`, `roles`, `crear`, `activ`, `userid`, `hast`, `acthash`, `date`, `ip`) VALUES
(1, 'demo', 'info@demo.com', '$2y$10$pJol9XST7lLGbQLqMPOM2.y4JU.Loun5XOUWVhVVH4XbUTfVSN17i', 1, '4e97049cdf58700beebb3213a93311e4', NULL, 0, 'admin', 0, 1, 1, 'bed3482f502c7bbfb6f9fa54f36e77d7', 1, '19:27:47 06/02/2019', '::1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indices de la tabla `programacion`
--
ALTER TABLE `programacion`
  ADD PRIMARY KEY (`id_programa`);

--
-- Indices de la tabla `relacionrepro`
--
ALTER TABLE `relacionrepro`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reproductores`
--
ALTER TABLE `reproductores`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT de la tabla `programacion`
--
ALTER TABLE `programacion`
  MODIFY `id_programa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `relacionrepro`
--
ALTER TABLE `relacionrepro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT de la tabla `reproductores`
--
ALTER TABLE `reproductores`
  MODIFY `ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
