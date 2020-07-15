-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-07-2020 a las 23:06:47
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `noticias`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `id` int(11) NOT NULL,
  `imagen` text COLLATE utf8_spanish_ci NOT NULL,
  `titulo` text COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `palabras_clave` text COLLATE utf8_spanish_ci NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`id`, `imagen`, `titulo`, `descripcion`, `palabras_clave`, `id_usuario`, `created_at`) VALUES
(21, 'vistas/img/noticias/admin/696.png', 'Pellentesque scelerisque pulvinar diam at scelerisque', '<p><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Pellentesque scelerisque pulvinar diam at scelerisque. Suspendisse quis nibh ut sem maximus eleifend. Donec imperdiet fringilla auctor. Pellentesque tincidunt risus eget nisl iaculis hendrerit. Praesent auctor neque at dui ultricies efficitur. Morbi ullamcorper sodales nisi, sit amet laoreet felis lobortis eu. Donec viverra lectus tincidunt gravida convallis. Ut lorem odio, fermentum id urna sit amet, scelerisque condimentum lacus.</span><br></p>', '[\"sodales \",\"amet \",\"hendrerit\"]', 7, '2020-07-10 16:42:49'),
(22, 'vistas/img/noticias/admin/483.jpg', 'Proin at sapien sit amet lectus interdum semper', '<span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Etiam pulvinar mi nisl, ut sodales nunc blandit a. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Suspendisse scelerisque lacus nec lacus eleifend, eget rutrum dolor sagittis. Cras in tortor rutrum, mollis felis vel, maximus eros. Duis rhoncus tempor eros, sed lacinia mi. Duis nisi dolor, fermentum vel dui ac, consequat pharetra orci. Proin at sapien sit amet lectus interdum semper.</span>', '[\"rhoncus \",\"eleifend\",\"ipsum \"]', 7, '2020-07-12 16:43:30'),
(23, 'vistas/img/noticias/emily_myers/900.jpg', 'Vestibulum sit amet nisl vitae ligula efficitur ', '<p><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Praesent porttitor tortor ut diam ullamcorper tristique. Duis sit amet cursus est, sit amet volutpat tortor. Nam euismod, elit quis tempor tincidunt, sapien mi pretium risus, sed dictum elit velit eu dolor. Sed blandit orci ac mauris sagittis, ut mattis nibh euismod. Maecenas bibendum dictum mauris eget elementum. In eu pretium nisl, id varius leo. Nunc tempor mattis magna in venenatis. Vestibulum sit amet nisl vitae ligula efficitur ultrices vulputate eget mauris. Aenean luctus ligula elit, sed vehicula arcu tempus sed. Maecenas eget lectus pretium, posuere justo vel, fringilla lacus. Integer odio neque, ultricies non euismod pellentesque, accumsan sed ante. Integer at gravida justo. Suspendisse faucibus enim massa, at interdum urna pulvinar in. Donec semper rhoncus consectetur. Duis erat massa, tempus sed lorem et, feugiat tempor tortor. Suspendisse sit amet luctus urna.</span><br></p>', '[\"ultricies \",\"venenatis\",\"pretium \",\"tempor \"]', 12, '2020-07-15 16:50:35'),
(24, 'vistas/img/noticias/janedoe/243.png', 'Etiam suscipit aliquam tortor', '<p><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Sed a volutpat lacus. Phasellus congue nibh vel sodales facilisis. Sed a accumsan velit. Vestibulum ut fringilla massa. Curabitur lacinia sagittis nisl eget euismod. In pharetra tempor sapien vitae molestie. Nam ultrices sodales dictum. Praesent ultricies orci ac sollicitudin pharetra. Etiam suscipit aliquam tortor, sit amet mattis enim dignissim ac.</span><br></p>', '[\"euismod\",\"pharetra\"]', 14, '2020-07-18 19:17:57'),
(25, 'vistas/img/noticias/janedoe/897.png', 'Suspendisse sit amet luctus urna.', '<span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Aenean luctus ligula elit, sed vehicula arcu tempus sed. Maecenas eget lectus pretium, posuere justo vel, fringilla lacus. Integer odio neque, ultricies non euismod pellentesque, accumsan sed ante. Integer at gravida justo. Suspendisse faucibus enim massa, at interdum urna pulvinar in. Donec semper rhoncus consectetur. Duis erat massa, tempus sed lorem et, feugiat tempor tortor. Suspendisse sit amet luctus urna.</span>', '[\"tempor \"]', 14, '2020-07-22 19:19:52'),
(26, 'vistas/img/noticias/janedoe/324.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', '<span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut vel fermentum magna. Pellentesque vel dolor et eros cursus vehicula sed ut quam. Nullam in risus venenatis, vestibulum orci semper, fringilla leo. Mauris congue velit in massa euismod, sed fringilla eros eleifend. Phasellus gravida sit amet libero et tincidunt. Vivamus fringilla lacus arcu, quis egestas turpis accumsan auctor. Nam consequat quam pellentesque, pharetra metus eu, maximus massa. Nulla elementum neque vitae dictum fringilla. Sed scelerisque euismod tellus, ut bibendum risus efficitur et. In vehicula pellentesque justo et volutpat.</span>', '[\"volutpat\",\"consequat \",\"gravida \"]', 14, '2020-07-25 19:19:43'),
(27, 'vistas/img/noticias/janedoe/728.png', 'Pellentesque scelerisque pulvinar diam at scelerisque', '<p><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"><b>Pellentesque </b>scelerisque pulvinar diam at scelerisque. Suspendisse quis nibh ut sem maximus eleifend. Donec imperdiet fringilla auctor. </span><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify; background-color: rgb(255, 255, 0);\"><font color=\"#000000\">Pellentesque tincidunt risus eget</font></span><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"> nisl iaculis hendrerit. Praesent auctor neque at dui ultricies efficitur. Morbi ullamcorper sodales nisi, sit amet laoreet felis lobortis eu. Donec viverra lectus tincidunt gravida convallis. Ut lorem odio, <b>fermentum </b>id urna sit amet, scelerisque <u>condimentum </u>lacus.</span><br></p>', '[\"gravida \",\"convallis\"]', 14, '2020-07-15 19:49:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `email` text COLLATE utf8_spanish_ci NOT NULL,
  `usuario` text COLLATE utf8_spanish_ci NOT NULL,
  `password` text COLLATE utf8_spanish_ci NOT NULL,
  `perfil` text COLLATE utf8_spanish_ci NOT NULL,
  `foto` text COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `usuario`, `password`, `perfil`, `foto`, `estado`, `created_at`) VALUES
(7, 'Administrador', 'admin@admin.ad', 'admin', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 'Administrador', 'vistas/img/usuarios/admin/719.png', 1, '2020-07-15 20:58:38'),
(8, 'John Doe', 'john@doe.com', 'johndoe', '$2a$07$asxx54ahjppf45sd87a5auGZEtGHuyZwm.Ur.FJvWLCql3nmsMbXy', 'Usuario', 'vistas/img/usuarios/johndoe/551.png', 1, '2020-07-12 23:23:23'),
(12, 'Emily Myers Doe', 'emily@myers.mib', 'emily_myers', '$2a$07$asxx54ahjppf45sd87a5au8uJqn2VoaOMw86zRUoDH6inuYomGLDq', 'Usuario', 'vistas/img/usuarios/emily_myers/823.jpg', 1, '2020-07-13 23:01:36'),
(14, 'Jane Doe', 'janedoe@gmail.com', 'janedoe', '$2a$07$asxx54ahjppf45sd87a5au8uJqn2VoaOMw86zRUoDH6inuYomGLDq', 'Usuario', '', 1, '2020-07-15 17:10:18');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
