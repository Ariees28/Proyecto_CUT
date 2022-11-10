-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-11-2022 a las 00:00:35
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero`
--

CREATE TABLE `genero` (
  `id` int(10) NOT NULL,
  `genero` varchar(25) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `descripcion` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `genero`
--

INSERT INTO `genero` (`id`, `genero`, `imagen`, `descripcion`) VALUES
(31, 'Literatura y Novelas', 'literaturaYnovelas.jpg', 'La novela es la obra por excelencia del género narrativo y se distingue por su extensión y profundidad en torno al desarrollo de situaciones, personajes y el uso de recursos literarios.'),
(32, 'Arte', 'Arte.jpg', 'El arte es toda forma de expresión de carácter creativo que poseen los seres humanos. Es la capacidad que tiene el hombre para representar sus sentimientos, emociones y percepciones acerca de sus vivencias y el entorno que lo rodea.'),
(33, 'Arquitectura', 'Arquitectura.jpg', 'La arquitectura es el arte y la técnica de concebir, diseñar y construir edificaciones que funcionen como hábitat para el ser humano, ya sean viviendas, lugares de trabajo, de recreación o memoriales.'),
(34, 'Cine', 'Cine.jpg', 'En la carrera de Cine se forman los profesionales de la realización cinematográfica, quienes plasman sus conocimientos y su sensibilidad en trabajos de animación, de ficción, documentales, entre otros, gracias a los cuales despiertan un sinfín de sentimientos y hasta conciencia en la sociedad.  '),
(35, 'Diseño', 'Diseño.png', 'La palabra diseño tiene un rango muy amplio de definiciones, ya que se aplica a muchas áreas del saber humano de manera más o menos diferenciada. Sin embargo, por diseño nos referimos generalmente a un proceso de prefiguración mental, es decir, de planificación creativa, en el que se persigue la solución para algún problema concreto, especialmente en el contexto de la ingeniería, la industria, la arquitectura, la comunicación y otras disciplinas afines.'),
(36, 'Fotografía', 'Fotografia.jpg', 'Se llama fotografía a una técnica y a una forma de arte que consisten en capturar imágenes empleando para ello la luz, proyectándola y fijándola en forma de imágenes sobre un medio sensible (físico o digital).'),
(37, 'Musica y Danza', 'musicaydanza.jpg', 'La danza o el baile es un arte donde se utiliza el movimiento de las partes del cuerpo generalmente con música, como una forma de expresión y de interacción social con fines de entretenimiento, artísticos o religiosos.'),
(38, 'Novela gráfica', 'novelagrafica.jpg', 'La novela gráfica es un tipo de publicación que fusiona los formatos del cómic y la novela tradicional, tomando elementos de los dos géneros. La misma cuenta una historia mediante viñetas que contienen ilustraciones y textos pero, a diferencia de las historietas tradicionales, está dirigida a un público más adulto y el relato tiene tintes literarios.'),
(39, 'Cuerpo, Alma y Espíritu', 'cuerpoAlmayEspiritu.jpg', 'Estudios sobre la espiritualidad, el estudio del alma, la mente y el cuerpo como tres partes de uno solo.'),
(40, 'Religión y espiritualidad', 'Religión y espiritualidad.jpg', 'La religión puede definirse como “creencia en Dios o dioses para ser adorados, usualmente expresado en conducta y ritual” o “cualquier sistema específico de creencia, adoración, etc., que regularmente incluye un código de ética”. La espiritualidad puede definirse como “la cualidad o hecho de ser espiritual, no-físico” o “un carácter predominantemente espiritual demostrado por el pensamiento, vida, etc.; tendencia o tono espiritual”.'),
(41, 'Salud y ejercicio', 'Salud y ejercicio.jpg', 'El ejercicio es la actividad física planificada, estructurada y repetitiva, realizada para mantener o mejorar una forma física, empleando un conjunto de movimientos corporales que se realizan para tal fin. Por consiguiente, se considera ejercicio al conjunto de acciones motoras musculo-esqueléticas.'),
(42, 'Negocios y Finanzas', 'Negocios y Finanzas.jpg', 'Son el arte y la ciencia de administrar dinero. Personal: Afectan en las decisiones de cuánto dinero gastar, cuanto ahorrar y como invertir ahorro. Empresa: Implica en las decisiones como incrementar el dinero de los inversores, invertir dinero, reinvertir ganancia'),
(43, 'Administración', 'Administración.jpg', 'La administración es el proceso que busca por medio de la planificación, la organización, ejecución y el control de los recursos darles un uso más eficiente para alcanzar los objetivos de una institución'),
(44, 'Ciencia y Naturaleza', 'Ciencia y Naturaleza.jpg', 'La ciencia es un disciplina que se encarga de estudiar e investigar con rigor los fenómenos sociales, naturales y artificiales a través de la observación, experimentación y medición para dar respuesta a lo desconocido.'),
(45, 'Mercadotecnia', 'mercadotecnia.jpg', 'La mercadotecnia es un conjunto de actividades que se realizan para identificar las necesidades de un público determinado con el objeto de brindarle productos o servicios para satisfacerlos de la forma más adecuada.'),
(46, 'Comunicación', 'Comunicacion.jpg', 'La comunicación estudia el intercambio de ideas y mensajes que presuponen una participación generada entre diferentes grupos sociales y culturas. La comunicación como materia de estudio tiene el fin de crear mensajes claros y con un significado para quienes esté dirigido, el mensaje puede ser creado con fines de entretenimiento, informativo, lucrativo etc.'),
(47, 'Medicina', 'medicinaG.jpg', 'Medicina es la \'ciencia de la sanación\' o práctica del diagnóstico, tratamiento y prevención de alguna enfermedad, infección o dolencia. Medicina también es sinónimo de medicamento o remedio.'),
(48, 'Derecho', 'derechoG.jpg', 'El derecho es el conjunto de principios y normas, generalmente inspirados en ideas de justicia y orden, que regula las relaciones humanas en toda sociedad y cuya observancia puede ser impuesta de forma coactiva por parte de un poder público.'),
(49, 'Matemáticas', 'matematicas.jpg', 'Las matemáticas son una ciencia formal, que estudia la relación entre entes o elementos abstractos, como son los números, los signos y las figuras'),
(50, 'Algebra', 'algebra.jpg', 'El álgebra es una de las principales ramas de las matemáticas. Su objeto de estudio son estructuras abstractas operando en patrones fijos, dentro de las cuales suele haber más que números y operaciones aritméticas: también letras, que representan operaciones concretas, variables, incógnitas o coeficientes.'),
(51, 'Pedagogía', 'pedagogia.png', 'La pedagogía es la ciencia que estudia la educación. El objeto principal de su estudio es la educación como un fenómeno socio-cultural, por lo que existen conocimientos de otras ciencias que ayudan a comprender el concepto de educación, como por ejemplo, la historia, la psicología, la sociología, etc.'),
(52, 'Psicología', 'psicologia.jpg', 'La psicología es una ciencia social y una disciplina académica enfocadas en el análisis y la comprensión de la conducta humana y de los procesos mentalesexperimentados por individuos y por grupos sociales durante momentos y situaciones determinadas.'),
(53, 'Filosofía', 'filosofia.jpg', 'Filosofía es un conjunto de razonamientos lógicos y metódicos sobre conceptos abstractos que tratan de explicar las causas y fines de la verdad, la realidad, las experiencias y nuestra existencia.'),
(54, 'Física', 'fisica.jpg', 'Es considerada una ciencia pura y natural debido a que se encarga de estudiar no solo el tiempo y el espacio, sino también la energía y la materia. Esto se puede ver en física o química, pero al final, es la física pura en la que se hallan las respuestas adecuadas para las incógnitas referentes al universo.'),
(55, 'Química', 'quimica.jpg', 'La química Es una ciencia que se encarga de analizar la composición, propiedades y estructura de la materia, además, estudia también todos los cambios que tengan que ver con ella por reacciones químicas'),
(56, 'Ingeniería y Tecnología', 'ingYtec.jpg', 'La Tecnología se define como el conjunto de conocimientos y técnicas que, aplicados de forma lógica y ordenada, permiten al ser humano modificar su entorno material o virtual para satisfacer sus necesidades, esto es, un proceso combinado de pensamiento y acción con la finalidad de crear soluciones útiles.'),
(57, 'Lenguaje y Referencia', 'lenguaje.jpg', 'El lenguaje es la capacidad que tiene el ser humano para expresarse y comunicarse, a través de diversos sistemas de signos: orales, escritos o gestuales. La comunicación requiere de este sistema de signos para llegar al objetivo del entendimiento común.'),
(58, 'Viajes', 'viajes.jpg', 'Libros sobre viajes, culturas, destinos, mapas e información sobre diferentes países'),
(59, 'Gastronomía', 'gastronomia.png', 'Es una práctica que no solo hace énfasis en la preparación de alimentos, sino que también hace énfasis en la relación de estos con los seres humanos, el entorno del cual obtiene dichos alimentos y la forma en la cual los emplea, así como también los aspectos sociales y culturales que intervienen en la relación las sociedades del mundo establecen con su gastronomía.'),
(60, 'Historia', 'historia.jpg', 'La historia como ciencia social es la encargada de estudiary relatar los acontecimientos ocurridos en el pasado de la humanidad. También se dice, que es la historia, el período que ha transcurrido desde que se inventó la escritura (llamado año cero) hasta la época actual.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `id_libro` int(9) NOT NULL COMMENT 'ID del libro',
  `Titulo` varchar(100) NOT NULL COMMENT 'Titulo del libro',
  `Autor` varchar(100) NOT NULL COMMENT 'Autor del libro',
  `Paginas` int(10) NOT NULL COMMENT 'Numero de paginas del libro',
  `Genero` varchar(100) NOT NULL COMMENT 'Genero del libro',
  `ISBN` int(15) NOT NULL COMMENT 'identificador internacional del libro',
  `Editorial` varchar(100) NOT NULL,
  `Fecha` int(4) NOT NULL COMMENT 'año de publicación del libro',
  `Idioma` varchar(50) NOT NULL,
  `Ejemplares` int(10) NOT NULL COMMENT 'Número de ejemplares en físico',
  `prestados` int(10) NOT NULL DEFAULT 0 COMMENT 'Numero de libros prestados',
  `Portada` varchar(500) NOT NULL,
  `sipnosis` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id_libro`, `Titulo`, `Autor`, `Paginas`, `Genero`, `ISBN`, `Editorial`, `Fecha`, `Idioma`, `Ejemplares`, `prestados`, `Portada`, `sipnosis`) VALUES
(10, 'EL CODIGO DAVINCI', 'DAN BROWN', 656, 'Literatura y Novelas', 2147483640, 'Editorial Planeta, S.A.', 2003, 'ESPAÑOL', 5, 1, 'ELCODIGODAVINCI.jpg', 'Robert Langdon recibe una llamada en mitad de la noche: el conservador del museo del Louvre ha sido asesinado en extrañas circunstancias y junto a su cadáver ha aparecido un desconcertante mensaje cifrado. Al profundizar en la investigación, Langdon, experto en simbología, descubre que las pistas conducen a las obras de Leonardo Da Vinci… y que están a la vista de todos, ocultas por el ingenio del pintor.\n\nLangdon une esfuerzos con la criptóloga francesa Sophie Neveu y descubre que el conservador del museo pertenecía al priorato de Sión, una sociedad que a lo largo de los siglos ha contado con miembros tan destacados como sir Isaac Newton, Botticelli, Victor Hugo o el propio Da Vinci, y que ha velado por mantener en secreto una sorprendente verdad histórica.\n\nUna mezcla trepidante de aventuras, intrigas vaticanas, simbología y enigmas cifrados que provocó una extraordinaria polémica al poner en duda algunos de los dogmas sobre los que se asienta la Iglesia católica. Una de las novelas más leídas de todos los tiempos.'),
(11, 'EL IMPERIO FINAL Nacidos de la Bruma 1', 'BRANDON SANDERSON', 672, 'Literatura y Novelas', 2147483641, 'NOVA', 2018, 'ESPAÑOL', 5, 0, 'ImperioFinal.jpg', 'Durante mil años nada ha florecido. Durante mil años los skaa han sido esclavizados y viven en la miseria, sumidos en un miedo inevitable. Durante mil años el Lord Legislador ha reinado con poder absoluto, dominando gracias al terror, a sus poderes y a su inmortalidad, ayudado por obligadores e inquisidores, junto a la poderosa magia de la alomancia.Pero los nobles a menudo han tenido trato sexual con jóvenes skaa y, aunque la ley lo prohíbe, algunos de sus bastardos han sobrevivido y heredado los poderes alománticos: son los nacidosde la bruma (mistborn).Ahora, Kelsier, el superviviente, el único que ha logrado huir de los Pozos de Hathsin, ha encontrado a Vin, una pobre chica skaa con mucha suerte... Tal vez los dos, con el mejor equipo criminal jamás reunido, unidos a la rebelión que los skaa intentan desde hace mil años, logren cambiar el mundo y acabar con la atroz mano de hierro del Lord Legislador.'),
(12, 'MEDICINA 3', 'ROSS', 1, 'Medicina', 1, '1', 1, 'ESPAÑOL', 1, 0, 'MEDICINA 3_ROSS_MEDICINA 1_ROSS_medicina.jpg', 'Reseña medicina'),
(13, 'TITULO PRUEBA', 'AUTOR PRUEBA', 1, 'Literatura y Novelas', 11111111, 'Editorial Prueba', 1, 'Español', 1, 0, 'Portada_Generica.png', 'Reseña Prueba'),
(14, 'TITULO PRUEBA', 'AUTOR PRUEBA', 1, 'Literatura y Novelas', 10, 'Editorial Prueba', 1, 'Español', 1, 0, 'Portada_Generica.png', 'Reseña Prueba'),
(15, 'TITULO PRUEBA', 'AUTOR PRUEBA', 1, 'Literatura y Novelas', 11, 'Editorial Prueba', 1, 'Español', 1, 0, 'Portada_Generica.png', 'Reseña Prueba'),
(16, 'HUSH HUSH', 'BECCA FITZPATRICK', 368, 'Literatura y Novelas', 2147483642, 'PATITO', 2010, 'ESPAÑOL', 10, 0, 'HUSH HUSH_BECCA FITZPATRICK_hush hush.jpg', 'Un juramento sagrado, un ángel caído, un amor prohibido.  Enamorarse no formaba parte de los planes de Nora Grey. Nunca se había sentido especialmente atraída por sus compañeros en la escuela, a pesar de los esfuerzos de su mejor amiga, Vee, para encontrarle una pareja. Así era hasta la llegada de Patch. Con su sonrisa fácil y sus ojos que parecen ver en su interior, Nora se siente encandilada por él a pesar de sí misma.Tras una serie de encuentros aterradores, Nora no sabe en quién confiar. Patch aparece allí a donde va y parece saber más sobre ella que su mejor amiga. Imposible decidir si debe darse por vencida y sucumbir a sus encantos, o salir huyendo y esconderse.Cuando intenta encontrar algunas respuestas, descubre una verdad que es más perturbadora que nada de lo que Patch le hace sentir. Porque Nora está en medio de una ancestral batalla entre los inmortales y los que han caído, y cuando se trata de escoger bando, la elección equivocada puede costarte la vida.'),
(17, 'FUEGO Y SANGRE ( CANCION DE HIELO Y FUEGO )', 'GEORGE R.R. MARTIN', 880, 'Literatura y Novelas', 2147483643, 'PLAZA JANES', 2018, 'ESPAÑOL', 20, 17, 'FUEGO Y SANGRE ( CANCION DE HIELO Y FUEGO )_GEORGE R.R. MARTIN_a.jpg', 'El nuevo libro de George R. R. Martin narra la fascinante historia de los Targaryen, la dinastía que reinó en Poniente trescientos años antes del inicio de Canción de hielo y fuego, la saga que inspiró la serie de HBO: Juego de tronos.Siglos antes de que tuvieran lugar los acontecimientos que se relatan en Canción de hielo y fuego, la casa Targaryen, la única dinastía de señores dragón que sobrevivió a la Maldición de Valyria, se asentó en la isla de Rocadragón.Aquí tenemos el primero de los dos volúmenes en el que el autor de Juego de tronos nos cuenta, con todo lujo de detalles, la historia de tan fascinante familia: empezando por Aegon I Targaryen, creador del icónico Trono de Hierro, y seguido por el resto de las generaciones de Targaryens que lucharon con fiereza por conservar el poder, y el trono, hasta la llegada de la guerra civil que casi acaba con ellos.¿Qué pasó realmente durante la Danza de dragones? ¿Por qué era tan peligroso acercarse a Valyria después de la Maldición? ¿Cómo era Poniente cuando los dragones dominaban los cielos? Estas, y otras muchas, son las preguntas a las que responde esta monumental crónica, narrada por un culto maestre de la Ciudadela, que anticipa el ya conocido universo de George R.R. Martin.Fuego y Sangre brindará a los lectores la oportunidad de tener otra visión de la fascinante historia de Poniente. Esta obra, magníficamente ilustrada con 85 láminas inéditas de Doug Wheatley, se convertirá, sin duda, en una lectura ineludible para todos los fans de la aclamada serie.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(5) NOT NULL,
  `Login` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `clave` varchar(500) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `Correo` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL COMMENT 'correo electronico',
  `Privilegio` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL COMMENT 'Tipo de usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `Login`, `clave`, `nombre`, `Correo`, `Privilegio`) VALUES
(40, 'JORGE', '$argon2i$v=19$m=2048,t=4,p=3$NW9manQzRHZueUtoVjJsNg$TPBVBNrO8IsO3w1xEJBu2eKNnYzbieF9WyMgo1pnLZo', 'JORGE', 'sirius-black24@hotmail.com', '0');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id_libro`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `genero`
--
ALTER TABLE `genero`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `id_libro` int(9) NOT NULL AUTO_INCREMENT COMMENT 'ID del libro', AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
