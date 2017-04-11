CREATE TABLE `caja_diaria` (
  `id` int(11) NOT NULL,
  `caja_inicial` int(11) NOT NULL,
  `fecha_caja` date NOT NULL,
  `estado` varchar(15) COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'ABIERTA'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caja_diaria`
--
ALTER TABLE `caja_diaria`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caja_diaria`
--
ALTER TABLE `caja_diaria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

CREATE TABLE `gastos` (
  `id` int(11) NOT NULL,
  `importe` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `comentario` text COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `gastos`
--
ALTER TABLE `gastos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `gastos`
--
ALTER TABLE `gastos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

CREATE TABLE `ticketventa` (
  `id_ticket` int(11) NOT NULL,
  `rut_usuario` varchar(14) COLLATE utf8_spanish2_ci NOT NULL,
  `monto` int(11) NOT NULL,
  `fecha_ticket` datetime NOT NULL,
  `comentario` text COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ticketventa`
--
ALTER TABLE `ticketventa`
  ADD PRIMARY KEY (`id_ticket`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ticketventa`
--
ALTER TABLE `ticketventa`
  MODIFY `id_ticket` int(11) NOT NULL AUTO_INCREMENT;