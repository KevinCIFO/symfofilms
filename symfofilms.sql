-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-12-2021 a las 13:18:33
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `symfofilms`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actor`
--

CREATE TABLE `actor` (
  `id` int(11) NOT NULL,
  `nombre` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_nacimiento` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nacionalidad` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `biografia` varchar(4096) COLLATE utf8_unicode_ci NOT NULL,
  `imagen` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `actor`
--

INSERT INTO `actor` (`id`, `nombre`, `fecha_nacimiento`, `nacionalidad`, `biografia`, `imagen`) VALUES
(1, 'Robert Downey Jr.', '1965-04-04', 'Estadounidense', 'Robert John Downey Jr. (nacido el 4 de abril de 1965) es un actor y productor estadounidense. Downey hizo su debut en la pantalla en 1970, a la edad de cinco años, cuando apareció en la película Pound de su padre, y desde entonces ha trabajado consistentemente en cine y televisión. Recibió dos nominaciones al Oscar por sus papeles en las películas Chaplin (1992) y Tropic Thunder (2008).\r\n\r\nDowney Jr. es más conocido por su papel en el Universo Cinematográfico de Marvel como Tony Stark / Iron Man. Ha aparecido como el personaje en Iron Man (2008), The Incredible Hulk (2008), Iron Man 2 (2010), The Avengers (2012), Iron Man 3 (2013), Avengers: Age of Ultron (2015), Captain América: Civil War (2016), Spider-Man: Homecoming (2017), Avengers: Infinity War (2018) y Avengers: Endgame (2019).', '618bb19206c7d.jpg'),
(3, 'Chris Evans', '1981-06-13', 'Estadounidense', 'Un actor estadounidense. Evans es conocido por sus papeles de superhéroe como Steve Rogers en el Universo Cinematográfico de Marvel y Human Torch en Fantastic Four (2005) y su secuela de 2007. Evans comenzó su carrera en la serie de televisión de 2000 Opposite Sex. Además de sus películas de superhéroes, ha aparecido en películas como Not Another Teen Movie (2001), Sunshine (2007), Scott Pilgrim vs. the World (2010), Snowpiercer (2013) y Gifted (2017). En 2014, hizo su debut como director con la película dramática Before We Go, en la que también protagonizó. Evans hizo su debut en Broadway en una producción de 2018 de Lobby Hero.', '618bb23a50f4d.jpg'),
(4, 'Mark Ruffalo', '1967-11-22', 'Estadounidense', 'Mark Alan Ruffalo (/ ˈrʌfəloʊ /; nacido el 22 de noviembre de 1967) es un actor y productor estadounidense. Comenzó a actuar a principios de la década de 1990 y obtuvo reconocimiento por su trabajo en la obra de teatro This Is Our Youth (1998) de Kenneth Lonergan y en la película dramática You Can Count On Me (2000). Luego protagonizó las comedias románticas 13 Going on 30 (2004) y Just like Heaven (2005) y los thrillers In the Cut (2003), Zodiac (2007) y Shutter Island (2010); y recibió una nominación al premio Tony por su papel secundario en la reposición de Broadway de Awake and Sing! en 2006. Ruffalo ganó reconocimiento internacional por interpretar a Bruce Banner / Hulk en las películas de superhéroes del Universo Cinematográfico de Marvel The Avengers (2012), Iron Man 3 (2013), Avengers: Age of Ultron (2015), Thor: Ragnarok (2017), Avengers : Infinity War (2018), Capitán Marvel (2019), Vengadores: Endgame (2019), y Shang-Chi y la leyenda de los diez anillos (2021), así como la próxima serie de Disney + She-Hulk (2022). También en 2019, Ruffalo protagonizó y coprodujo Dark Waters.', '618bb27e23268.jpg'),
(5, 'Chris Hemsworth', '1983-08-11', 'Australiana', 'Chris Hemsworth (nacido el 11 de agosto de 1983) es un actor australiano. Es mejor conocido por sus papeles como Kim Hyde en la serie de televisión australiana Home and Away (2004) y como Thor en las películas del Universo Cinematográfico de Marvel Thor (2011), The Avengers (2012), Thor: The Dark World (2013), Avengers: Age of Ultron (2015), Thor: Ragnarok (2017), Avengers: Infinity War (2018), Avengers: Endgame (2019) y el próximo Thor: Love and Thunder (2022). También ha aparecido en la película de acción y ciencia ficción Star Trek (2009), el thriller de aventuras A Perfect Getaway (2009), la comedia de terror The Cabin in the Woods (2012), la película de acción y fantasía oscura Blancanieves y el cazador (2012)), la película de guerra Red Dawn (2012) y la película biográfica de drama deportivo Rush (2013).', '618bb2b3cdc17.jpg'),
(6, 'Scarlett Johansson', '1984-11-22', 'Estadounidense', 'Scarlett Johansson, nacida el 22 de noviembre de 1984, es una actriz, modelo y cantante estadounidense. Hizo su debut cinematográfico en North (1994) y más tarde fue nominada al premio Independent Spirit a la mejor protagonista femenina por su actuación en Manny & Lo (1996), obteniendo más aclamación y prominencia con papeles en The Horse Whisperer (1998) y Ghost. Mundo (2001). Pasó a papeles adultos con sus actuaciones en Girl with a Pearl Earring (2003) y Lost in Translation (2003) de Sofia Coppola, por la que ganó un premio BAFTA a la Mejor Actriz en un Papel Protagónico; ambas películas también le valieron nominaciones al Globo de Oro.\r\n\r\nUn papel en A Love Song for Bobby Long (2004) le valió a Johansson su tercera nominación al Globo de Oro a la Mejor Actriz. Johansson obtuvo otra nominación al Globo de Oro a la Mejor Actriz de Reparto con su papel en Match Point de Woody Allen (2005). Ha interpretado al personaje del cómic de Marvel Black Widow / Natasha Romanoff en Iron Man 2 (2010), The Avengers (2012) y Captain America: The Winter Soldier (2014), Avengers: Age of Ultron (2015), Captain America: Civil War (2016), Avengers: Infinity War (2018), Avengers: Endgame (2019) y Black Widow (2020). La reposición en Broadway en 2010 de A View From the Bridge, de Arthur Miller, le valió a Johansson el premio Tony a la mejor interpretación de una actriz destacada en una obra de teatro. Como cantante, Johansson ha lanzado dos álbumes, Anywhere I Lay My Head y Break Up.\r\n\r\nJohansson fue nominada a dos premios de la Academia en 2020 por su trabajo en Marriage Story (2019) y Jojo Rabbit (2019). Johansson nació en la ciudad de Nueva York. Su padre, Karsten Johansson, es un arquitecto nacido en Dinamarca, y su abuelo paterno, Ejner Johansson, fue guionista y director. Su madre, Melanie Sloan, productora, proviene de una familia judía asquenazí del Bronx. Johansson tiene una hermana mayor, Vanessa, que es actriz; un hermano mayor, Adrian; un hermano gemelo, Hunter (que apareció en la película Manny & Lo con Scarlett); y un medio hermano, Christian, del nuevo matrimonio de su padre.', '618bb2ec7e951.jpg'),
(9, 'Jeremy Renner', '1971-01-07', 'Estadounidense', 'Jeremy Lee Renner (nacido el 7 de enero de 1971), es un actor y músico estadounidense. Renner apareció en películas a lo largo de la década de 2000, principalmente en papeles secundarios. Saltó a la fama en películas como Dahmer (2002), SWAT (2003), Neo Ned (2005), 28 Weeks Later (2007), The Town (2010), y fue nominado a un Oscar al Mejor Actor por su papel protagónico en la ganadora de la Mejor Película de 2009. thriller de guerra The Hurt Locker.\r\n\r\nAl año siguiente apareció en la película aclamada por la crítica The Town. Su trabajo como \"James Coughlin\" en esa película recibió una nominación al Premio de la Academia 2010 al Mejor Actor de Reparto con más nominaciones en la categoría de Actor de Reparto en los Premios SAG y los Globos de Oro.\r\n\r\nRenner ha interpretado a Clint Barton / Hawkeye en el Universo Cinematográfico de Marvel, apareciendo en 5 películas hasta ahora como el personaje: Thor (2011), Los Vengadores (2012), Vengadores: La era de Ultrón (2015), Capitán América: Guerra civil (2016) y Vengadores: Endgame (2019). Renner volverá a aparecer como Hawkeye en una serie de Disney + sobre el personaje.', '618bb327b7b80.jpg'),
(10, 'Tom Hiddleston', '1981-02-09', 'Inglesa', 'Thomas William Hiddleston (nacido el 9 de febrero de 1981) es un actor inglés. Ha recibido varios galardones, incluido un Globo de Oro y un Premio Laurence Olivier, y ha sido nominado a dos premios Primetime Emmy. Al comienzo de su carrera, apareció en las producciones del West End de Cymbeline (2007) e Ivanov (2008). Ganó el premio Olivier a la Mejor Revelación en una Obra por su papel en Cymbeline y también fue nominado al mismo premio por su papel de Cassio en Othello (2008). Actuó como el personaje principal en una producción de Coriolanus (2013-2014), ganando el premio Evening Standard Theatre al mejor actor y recibiendo una nominación al premio Olivier al mejor actor. Hizo su debut en Broadway en una reposición de Betrayal en el 2019.\r\n\r\nHiddleston hizo su debut cinematográfico en el drama Unrelated (2007). Llamó la atención del público en general cuando fue elegido como Loki en el Universo Cinematográfico de Marvel, apareciendo en Thor (2011), The Avengers (2012), Thor: The Dark World (2013), Thor: Ragnarok (2017), Avengers: Infinity War (2018) y Vengadores: Endgame (2019). También ha aparecido en War Horse (2011), The Deep Blue Sea (2011), Midnight in Paris (2011), la serie de la BBC de 2012 Henry IV y Henry V, y Only Lovers Left Alive (2013). En 2015, protagonizó Crimson Peak, High Rise y I Saw The Light. La película Kong: Skull Island (2017) marcó su primer papel protagónico de gran presupuesto fuera del UCM.\r\n\r\nProtagonizó y fue productor ejecutivo de la serie limitada de AMC / BBC The Night Manager (2016), por la que recibió dos nominaciones al premio Primetime Emmy como actor principal destacado en una miniserie o película y miniserie excepcional, y ganó su primer Premio Globo de Oro al Mejor Actor - Miniserie o Película para Televisión.', '618bb4a8157e1.jpg'),
(13, 'Samuel L. Jackson', '1948-12-21', 'Estadounidense', 'Actor y productor de cine y televisión estadounidense. Después de que Jackson se involucró con el Movimiento de Derechos Civiles, pasó a actuar en teatro en Morehouse College y luego en películas. Tuvo varios papeles pequeños como en la película Goodfellas, Def by Temptation, antes de conocer a su mentor, Morgan Freeman, y al director Spike Lee. Después de ser aclamado por la crítica por su papel en Jungle Fever en 1991, apareció en películas como Patriot Games, Amos & Andrew, True Romance y Jurassic Park. En 1994 fue elegido para interpretar a Jules Winnfield en Pulp Fiction, y su actuación recibió varias nominaciones a premios y elogios de la crítica.\r\n\r\nDesde entonces, Jackson ha aparecido en más de 100 películas, incluidas Die Hard with a Vengeance, The 51st State, Jackie Brown, Unbreakable, The Incredibles, Black Snake Moan, Shaft, Snakes on a Plane, así como la trilogía precuela de Star Wars y pequeños papeles en Kill Bill Vol. De Quentin Tarantino 2 y Malditos bastardos. Interpretó a Nick Fury en el Universo Cinematográfico de Marvel en Iron Man (2008) Iron Man 2 (2010), Thor (2011), Captain America: The First Avenger (2011), The Avengers (2012), Captain America: The Winter Soldier ( 2014), Avengers: Age of Ultron (2015), Avengers: Infinity War (2018), Captain Marvel (2019), Avengers: Endgame (2019) y Spider-Man: Far From Home (2019). Los muchos papeles de Jackson lo han convertido en uno de los actores más taquilleros en taquilla. Jackson ha ganado múltiples premios a lo largo de su carrera y ha sido retratado en diversas formas de medios, incluidas películas, series de televisión y canciones. En 1980, Jackson se casó con LaTanya Richardson, con quien tiene una hija, Zoe.', '618e49874bf5f.jpg'),
(14, 'Cobie Smulders', '1982-04-03', 'Canadiense', 'Jacoba Francisca Maria \"Cobie\" Smulders (nacida el 3 de abril de 1982) es una actriz y ex modelo canadiense, conocida por su papel actual como Robin Scherbatsky en la serie de televisión de CBS How I Met Your Mother y Maria Hill en el Universo Cinematográfico de Marvel. Smulders nació en Vancouver, Columbia Británica, de padre holandés y madre inglesa. Ella fue nombrada en honor a su tía abuela, de quien ganó el apodo de \"Cobie\".\r\n\r\nSmulders trabajó en el modelaje, algo que luego dijo que \"un poco odiaba\", y agregó que la experiencia la hizo dudar acerca de seguir actuando como una carrera: \"Sabes que vas a estas habitaciones, y he tenido la experiencia de que la gente te juzgue físicamente durante tanto tiempo y lo había superado. Pero luego fue como, \'Oh no, tengo que actuar de verdad. Tengo que hacerlo bien, y tengo que tener una voz, y tengo que tener pensamientos ahora\' \". Después de dejar de modelar, se matriculó en la Universidad de Victoria para estudiar biología marina. Durante el verano, tomó clases de actuación y decidió seguir su carrera como actriz.\r\n\r\nEl primer papel actoral de Smulders fue como invitada en la serie de ciencia ficción de Showtime Jeremiah, y desde entonces ha aparecido en varias series de televisión, incluido un papel recurrente en The L Word. En el escenario de Nueva York, actuó en Love, Loss, and What I Wore desde al menos el 10 de junio hasta el 27 de junio de 2010. Su primer papel permanente en la serie fue en la breve serie de ABC Veritas: The Quest, y su segundo fue el reportero de televisión Robin Scherbatsky en la comedia de situación de CBS How I Met Your Mother, que rápidamente se hizo popular. Joss Whedon ha sugerido que la consideró para el papel de Wonder Woman en su borrador de la película homónima, que no entró en producción. Smulders interpretó a Maria Hill en la película The Avengers de Whedon de 2012 y repite su papel en el estreno de la serie de televisión Agents of SHIELD y Capitán América: The Winter Soldier (2014), Avengers: Age of Ultron (2015), Avengers: Infinity War (2018) y Spider-Man: Far From Home (2019). Smulders y el actor estadounidense Taran Killam se comprometieron en enero de 2009. Se casaron el 8 de septiembre de 2012 en Solvang, California. La pareja tiene una hija, Shaelyn Cado Killam (nacida el 14 de mayo de 2009).', '618e4b0cdc654.jpg'),
(15, 'aa', '1965-04-04', 'Estados Unidos', 'yy', '61a0c68556148.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20211117115251', '2021-11-17 12:54:34', NULL),
('DoctrineMigrations\\Version20211117115614', '2021-11-17 12:57:17', 30),
('DoctrineMigrations\\Version20211118083818', '2021-11-18 09:39:01', 47),
('DoctrineMigrations\\Version20211118094824', '2021-11-18 10:48:43', 36),
('DoctrineMigrations\\Version20211123074040', '2021-11-23 08:41:14', 69),
('DoctrineMigrations\\Version20211123102939', '2021-11-23 11:30:09', 68),
('DoctrineMigrations\\Version20211123112759', '2021-11-23 12:28:17', 75);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pelicula`
--

CREATE TABLE `pelicula` (
  `id` int(11) NOT NULL,
  `titulo` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `duracion` int(11) DEFAULT NULL,
  `director` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `genero` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imagen` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sinopsis` varchar(4096) COLLATE utf8_unicode_ci NOT NULL,
  `estreno` int(11) NOT NULL,
  `valoracion` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pelicula`
--

INSERT INTO `pelicula` (`id`, `titulo`, `duracion`, `director`, `genero`, `imagen`, `sinopsis`, `estreno`, `valoracion`, `user_id`) VALUES
(1, 'The Avengers: Los Vengadores', 143, 'Joss Whedon', 'Acción, ciencia ficción', '618a2cfd231cf.jpg', 'Cuando un enemigo inesperado surge como una gran amenaza para la seguridad mundial, Nick Fury, director S.H.I.E.L.D, decide reclutar a un equipo para salvar al mundo de un desastre casi seguro.', 2012, 4, NULL),
(2, 'Avengers: Era de Ultrón', 141, 'Joss Whedon', 'Acción, ciencia ficción', '618a2cf092b5e.jpg', 'Cuando Tony Stark intenta reactivar un programa caído en desuso cuyo objetivo es mantener la paz, las cosas empiezan a torcerse y los héroes más poderosos de la Tierra, Los Vengadores, tendrán que afrontar la prueba definitiva cuando el destino del planeta se ponga en juego. Cuando el villano Ultrón emerge, le corresponderá a Los Vengadores detener sus terribles planes, que junto a incómodas alianzas llevarán a una inesperada acción que allanará el camino para una épica y única aventura.', 2015, 3, NULL),
(3, 'Avengers: Infinity War', 149, 'Anthony Russo, Joe Russo', 'Acción, ciencia ficción', '618a2ccff259a.jpg', 'El todopoderoso Thanos ha despertado con la promesa de arrasar con todo a su paso, portando el Guantelete del Infinito, que le confiere un poder incalculable. Los únicos capaces de pararle los pies son los Vengadores y el resto de superhéroes de la galaxia, que deberán estar dispuestos a sacrificarlo todo por un bien mayor. Iron Man y Capitán América deberán dejar atrás sus diferencias, Black Panther apoyará con sus tropas desde Wakanda, Thor y los Guardianes de la Galaxia e incluso Spider-Man se unirán antes de que los planes de devastación y ruina pongan fin al universo. ¿Serán capaces de frenar el avance del titán loco?', 2018, 5, NULL),
(4, 'Avengers: Endgame', 181, 'Anthony Russo, Joe Russo', 'Acción, ciencia ficción', '618a2cc5060c5.jpg', 'Después de los eventos devastadores de \'Avengers: Infinity War\', el universo está en ruinas debido a las acciones de Thanos. Con la ayuda de los aliados que quedaron, los Vengadores deberán reunirse una vez más para intentar deshacer sus acciones y restaurar el orden en el universo de una vez por todas, sin importar cuáles sean las consecuencias.', 2019, 4, NULL),
(9, 'El Hombre Araña', 121, 'Sam Raimi', 'Acción, fantasía', '618a2c7a00654.jpg', 'Peter Parker es un joven y tímido estudiante que vive con su tía May y su tío Ben desde la muerte de sus padres. Un día es mordido por una araña que ha sido modificada genéticamente, descubriendo al día siguiente que posee unos poderes poco habituales: tiene la fuerza y agilidad de una araña.', 2002, 4, NULL),
(10, 'El Hombre Araña 2', 137, 'Sam Raimi', 'Acción, fantasía', '618a291f98c66.jpg', 'Han pasado dos años desde que el tranquilo Peter Parker dejó a Mary Jane Watson, su gran amor, y decidió seguir asumir sus responsabilidades como Spider-Man. Peter debe afrontar nuevos desafíos mientras lucha contra el don y la maldición de sus poderes equilibrando sus dos identidades: el escurridizo superhéroe Spider-Man y el estudiante universitario. Las relaciones con las personas que más aprecia están ahora en peligro de ser descubiertas con la aparición del poderoso villano de múltiples tentáculos Doctor Octopus, \"Doc Ock\". Su atracción por M.J. se hace más fuerte mientras lucha contra el impulso de abandonar su vida secreta y declarar su amor. Mientras tanto, M.J. ha seguido con su vida. Se ha embarcado en su carrera de actriz y tiene un nuevo hombre en su vida. La relación de Peter con su mejor amigo Harry Osborn se ha alejado por la creciente venganza de Harry contra Spider-Man, al que considera responsable de la muerte de su padre.', 2004, 4, NULL),
(11, 'El Hombre Araña 3', 139, 'Sam Raimi', 'Acción, fantasía', '618a2a3173d59.jpg', 'Parece que Parker ha conseguido por fin el equilibrio entre su devoción por Mary Jane y sus deberes como superhéroe. Pero, de repente, su traje cambia volviéndose negro y aumentando sus poderes; también Peter se transforma, sacando el lado más oscuro y vengativo de su personalidad. Bajo la influencia de este nuevo traje, Peter deja de proteger a la gente que realmente lo quiere y se preocupa por él. En estas circunstancias, no tiene más remedio que elegir entre disfrutar del tentador poder del nuevo traje o seguir siendo el compasivo héroe de antes. Mientras tanto, dos temibles enemigos, Venom y el Hombre de Arena, utilizarán sus poderes para calmar su sed de venganza', 2007, 4, NULL),
(16, 'El Sorprendente Hombre Araña', 136, 'Marc Webb', 'Acción, aventura', '618a2c9aa135a.jpg', 'Un estudiante de secundaria que fue abandonado por sus padres cuando era niño, dejándolo a cargo de su tío Ben (Martin Sheen) y su tía May (Sally Field). Como la mayoría de los adolescentes de su edad, Peter trata de averiguar quién es y qué quiere llegar a ser. Peter también está encontrando su camino con su primer amor de secundaria, Gwen Stacy (Emma Stone), y juntos luchan por su amor con compromiso. Cuando Peter descubre un misterioso maletín que perteneció a su padre, comienza la búsqueda para entender la desaparición de sus padres, una búsqueda que le lleva directamente a Oscorp, el laboratorio del Dr Curt Connors (Rhys Ifans), ex-compañero de trabajo de su padre. Mientras Spider-Man se encuentra en plena colisión con el alter-ego de Connors, el Lagarto, Peter hará elecciones que alterarán sus opciones para usar sus poderes y darán forma a un destino héroico.', 2012, 4, NULL),
(20, 'El Sorprendente Hombre Araña 2', 142, 'Marc Webb', 'Acción, aventura', '618a2caecfd10.jpg', 'Peter Parker lleva una vida muy ocupada, compaginando su tiempo entre su papel como Spider-Man, acabando con los malos, y en el instituto con la persona a la que quiere, Gwen. Peter no ve el momento de graduarse. No ha olvidado la promesa que le hizo al padre de Gwen de protegerla, manteniéndose lejos de ella, pero es una promesa que simplemente no puede cumplir. Las cosas cambiarán para Peter cuando aparece un nuevo villano, Electro, y un viejo amigo, Harry Osborn, regresa, al tiempo que descubre nuevas pistas sobre su pasado.', 2014, 3, NULL),
(21, 'Harry Potter y la Piedra Filosofal', 152, 'Chris Columbus', 'Aventura, fantasía', '618a2b36039ca.jpg', 'Harry Potter ha vivido debajo de las escaleras en la casa de su tía y su tío toda su vida. Pero en su undécimo cumpleaños, se entera de que es un mago poderoso, con un lugar esperándolo en el Colegio Hogwarts de Magia y Hechicería. Mientras aprende a aprovechar sus nuevos poderes con la ayuda del amable director de la escuela, Harry descubre la verdad sobre la muerte de sus padres y sobre el villano que tiene la culpa.', 2001, 4, NULL),
(22, 'Harry Potter y la Cámara Secreta', 161, 'Chris Columbus', 'Aventura, fantasía', '618a325b3d9ec.jpg', 'Los coches vuelan, los árboles se defienden y un misterioso elfo doméstico viene a advertir a Harry Potter al comienzo de su segundo año en Hogwarts. La aventura y el peligro aguardan cuando la escritura sangrienta en una pared anuncia: Se ha abierto la cámara de los secretos. Para salvar Hogwarts se necesitarán todas las habilidades mágicas y el coraje de Harry, Ron y Hermione.', 2002, 4, NULL),
(23, 'Harry Potter y el Prisionero de Azkaban', 141, 'Alfonso Cuarón', 'Aventura, fantasía', '618a4fcc03fb2.jpg', 'El tercer año en Hogwarts significa nueva diversión y desafíos. Harry aprende el delicado arte de acercarse a un hipogrifo, transformar Boggarts que cambian de forma en hilaridad e incluso retroceder en el tiempo. Pero el término también trae peligro: los dementores chupa almas se ciernen sobre la escuela y un aliado del maldito El-que-no-puede-ser-nombrado acecha dentro de los muros del castillo, y el temible mago Sirius Black escapa de Azkaban. Y Harry los enfrentará a todos.', 2004, 4, NULL),
(26, 'Harry Potter y el Cáliz de Fuego', 157, 'Mike Newell', 'Aventura, fantasía', '618a526b38ab4jpg', 'Cuando el nombre de Harry Potter emerge del cáliz de fuego, él se convierte en un competidor en una agotadora batalla por la gloria entre tres escuelas mágicas: el Torneo de los Tres Magos. Pero dado que Harry nunca presentó su nombre para el Torneo, ¿quién lo hizo? Ahora Harry debe enfrentarse a un dragón mortal, feroces demonios de agua y un laberinto encantado solo para encontrarse en las garras crueles de Aquel que no debe ser nombrado.', 2005, 5, NULL),
(27, 'Harry Potter y la Orden del Fénix', 138, 'David Yates', 'Aventura, fantasía', '618a6785c71a9.jpg', '¡Empieza la rebelión! Lord Voldemort ha regresado, pero el Ministerio de Magia está haciendo todo lo posible para evitar que el mundo mágico sepa la verdad, incluido el nombramiento de la funcionaria del Ministerio, Dolores Umbridge, como la nueva profesora de Defensa Contra las Artes Oscuras en Hogwarts. Cuando Umbridge se niega a enseñar magia defensiva práctica, Ron y Hermione convencen a Harry de que entrene en secreto a un grupo selecto de estudiantes para la guerra mágica que se avecina. Un enfrentamiento aterrador entre el bien y el mal aguarda en esta apasionante versión cinematográfica de la quinta novela de la serie de Harry Potter de JK Rowling. ¡Prepárate para la batalla!', 2007, 4, NULL),
(30, 'Harry Potter y el Misterio del Príncipe', 153, 'David Yates', 'Aventura, fantasía', '618b793097474.jpg', 'A medida que Lord Voldemort aprieta su control sobre los mundos muggle y mágico, Hogwarts ya no es un refugio seguro. Harry sospecha que los peligros pueden incluso estar dentro del castillo, pero Dumbledore está más decidido a prepararlo para la batalla final que se acerca rápidamente. Juntos trabajan para encontrar la clave para desbloquear las defensas de Voldemorts y, con este fin, Dumbledore recluta a su viejo amigo y colega Horace Slughorn, quien cree que tiene información crucial. Incluso mientras se avecina el enfrentamiento decisivo, el romance florece para Harry, Ron, Hermione y sus compañeros de clase. El amor está en el aire, pero el peligro se avecina y Hogwarts puede que nunca vuelva a ser el mismo.', 2009, 4, NULL),
(31, 'Harry Potter y las Reliquias de la Muerte: Parte 1', 146, 'David Yates', 'Aventura, fantasía', '618b7a486c520.jpg', 'Harry, Ron y Hermione se alejan de su último año en Hogwarts para encontrar y destruir los Horrocruxes restantes, poniendo fin a la apuesta de Voldemort por la inmortalidad. Pero con el amado Dumbledore de Harry muerto y los mortífagos sin escrúpulos de Voldemort sueltos, el mundo es más peligroso que nunca.', 2010, 4, NULL),
(32, 'Harry Potter y las Reliquias de la Muerte: Parte 2', 130, 'David Yates', 'Aventura, fantasía', '618b7ac78eadejpg', 'Harry, Ron y Hermione continúan su búsqueda para vencer al malvado Voldemort de una vez por todas. Justo cuando las cosas comienzan a parecer desesperadas para los jóvenes magos, Harry descubre un trío de objetos mágicos que lo dotan de poderes para rivalizar con las formidables habilidades de Voldemort.', 2011, 5, NULL),
(33, 'El Señor de los Anillos: La Comunidad del Anillo', 179, 'Peter Jackson', 'Aventura, fantasía', '618b89618f242.jpg', 'El joven hobbit Frodo Bolsón, tras heredar un anillo misterioso de su tío Bilbo, debe abandonar su casa para evitar que caiga en manos de su malvado creador. En el camino, se forma una confraternidad para proteger al portador del anillo y asegurarse de que el anillo llegue a su destino final: Mordor, el único lugar donde puede ser destruido.', 2001, 4, NULL),
(34, 'El Señor de los Anillos: Las Dos Torres', 179, 'Peter Jackson', 'Aventura, fantasía', '618b8acee5ece.jpg', 'Frodo y Sam están viajando a Mordor para destruir el Anillo Único de Poder mientras Gimli, Legolas y Aragorn buscan a Merry y Pippin capturados por los orcos. Todo el tiempo, el nefasto mago Saruman espera a los miembros de la Comunidad en la Torre Orthanc en Isengard.', 2002, 4, NULL),
(35, 'El Señor de los Anillos: El Retorno del Rey', 201, 'Peter Jackson', 'Aventura, fantasía', '618b9f18f32a8.jpg', 'Aragorn se revela como el heredero de los antiguos reyes mientras él, Gandalf y los otros miembros de la fraternidad fracturada luchan por salvar a Gondor de las fuerzas de Sauron. Mientras tanto, Frodo y Sam acercan el anillo al corazón de Mordor, el reino del señor oscuro.', 2003, 5, NULL),
(38, 'Star Wars: Episodio I - La Amenaza Fantasma', 136, 'George Lucas', 'Aventura, acción', '618b9fdc84062.jpg', 'Anakin Skywalker, un joven esclavo fuerte con la Fuerza, es descubierto en Tatooine. Mientras tanto, los malvados Sith han regresado, representando su plan de venganza contra los Jedi.', 1999, 4, NULL),
(39, 'Star Wars: Episodio II - El Ataque de los Clones', 142, 'George Lucas', 'Aventura, acción', '619cc423c9840.jpg', 'Tras un intento de asesinato de la senadora Padmé Amidala, los Caballeros Jedi Anakin Skywalker y Obi-Wan Kenobi investigan un misterioso complot que podría cambiar la galaxia para siempre.', 2002, 5, NULL),
(40, 'Star Wars: Episodio III - La Venganza de los Sith', 140, 'George Lucas', 'Aventura, acción', '618e318a2fb34.jpg', 'El malvado Darth Sidious pone en práctica su plan final de poder ilimitado, y el heroico Jedi Anakin Skywalker debe elegir un bando.', 2005, 4, NULL),
(41, 'Star Wars: Episodio IV - Una Nueva Esperanza', 121, 'George Lucas', 'Aventura, acción', '618e351c3af0e.jpg', 'La princesa Leia es capturada y rehén de las malvadas fuerzas imperiales en su esfuerzo por apoderarse del Imperio. El aventurero Luke Skywalker y el apuesto capitán Han Solo se unen al adorable dúo de robots R2-D2 y C-3PO para rescatar a la bella princesa y restaurar la paz y la justicia en el Imperio.', 1977, 4, NULL),
(42, 'Star Wars: Episodio V - El Imperio Contraataca', 124, 'Irvin Kershner', 'Aventura, acción', '618e3608edf70.jpg', 'La saga épica continúa mientras Luke Skywalker, con la esperanza de derrotar al malvado Imperio Galáctico, aprende los caminos de los Jedi del anciano maestro Yoda. Pero Darth Vader está más decidido que nunca a capturar a Luke. Mientras tanto, la líder rebelde (La Princesa Leia), el arrogante Han Solo, Chewbacca y los droides C-3PO y R2-D2 son lanzados a varias etapas de captura, traición y desesperación.', 1980, 4, NULL),
(43, 'Star Wars: Episodio VI - El Regreso del Jedi', 135, 'Richard Marquand', 'Aventura, acción', '618e36f1cbbbe.jpg', 'Luke Skywalker lidera una misión para rescatar a su amigo Han Solo de las garras de Jabba the Hutt, mientras el Emperador busca destruir la Rebelión de una vez por todas con una segunda y temida Estrella de la Muerte.', 1983, 5, NULL),
(46, 'Star Wars: Episodio VII - El Despertar de la Fuerza', 146, 'J.J. Abrams', 'Aventura, acción', '619cc4c1302e6.jpg', 'Treinta años después de derrotar al Imperio Galáctico, Han Solo y sus aliados enfrentan una nueva amenaza del malvado Kylo Ren y su ejército de Stormtroopers.', 2015, 4, NULL),
(47, 'Star Wars: Episodio VIII - Los Últimos Jedi', 152, 'Rian Johnson', 'Aventura, acción', '619cc5d092af1.jpg', 'Rey desarrolla sus habilidades recién descubiertas con la guía de Luke Skywalker, quien está inquieto por la fuerza de sus poderes. Mientras tanto, la Resistencia se prepara para luchar contra la Primera Orden.', 2017, 4, NULL),
(49, 'Star Wars: Episodio IX - El Ascenso de Skywalker', 142, 'J.J. Abrams', 'Aventura, acción', '619cce55820ea.jpg', 'La Resistencia superviviente se enfrenta a la Primera Orden una vez más mientras continúa el viaje de Rey, Finn y Poe Dameron. Con el poder y el conocimiento de generaciones a sus espaldas, comienza la batalla final.', 2019, 5, 17),
(50, 'hh', 140, 'Chris Columbus', 'Aventura, fantasía', '61a0c67247492.jpg', 'hh', 2003, 5, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pelicula_actor`
--

CREATE TABLE `pelicula_actor` (
  `pelicula_id` int(11) NOT NULL,
  `actor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pelicula_actor`
--

INSERT INTO `pelicula_actor` (`pelicula_id`, `actor_id`) VALUES
(1, 1),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 9),
(1, 10),
(1, 13),
(1, 14),
(50, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reset_password_request`
--

CREATE TABLE `reset_password_request` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `selector` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `hashed_token` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `requested_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `expires_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `displayname` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `imagen` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `displayname`, `username`, `phone`, `is_verified`, `imagen`, `city`, `country`) VALUES
(12, 'kevinnoverificado@gmail.com', '[\"ROLE_USER\",\"ROLE_SUPERVISOR\"]', '$2y$13$Os97n03J0GjD4xgV0M5pGeMg6DHvSDQSlzRbj8D6TGpTFhHW3FpYu', 'NoVerificado', 'UserNoVerified', '987654321', 1, '61a0a4f979018.jpg', 'Londres', 'Inglaterra'),
(13, 'kevinverificado@gmail.com', '[\"ROLE_USER\",\"ROLE_EDITOR\"]', '$2y$13$AyPYFW94rvSdhFtqI6ju6.QngzqQ5Sfc9pmKNSNRv9Y1cJfY/yAPa', 'Verificado', 'UserVerified', '246813579', 1, '61a0a4b4514ec.jpg', 'Lima', 'Perú'),
(17, 'kevinlarriega@gmail.com', '{\"0\":\"ROLE_USER\",\"2\":\"ROLE_ADMIN\"}', '$2y$13$NeUm9u0ClZ/QLdqvvYbr6e59d6oMLs472QmyF7b9qmvzmKG6iog4G', 'Kevin', 'symfokevin', '123456789', 1, '61a0a3f12c502.jpg', 'Barcelona', 'España'),
(18, 'kevin@gmail.com', '[]', '$2y$13$FVed6j1QuBFidiMa1O8rk.IiH1RVAE2S5xZZXddcUOzPp.HacFKe6', 'Kevin user', 'KevinUser', '111111111', 1, '61a0b1de2314d.jpg', 'Barcelona', 'España');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actor`
--
ALTER TABLE `actor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `pelicula`
--
ALTER TABLE `pelicula`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_73BC7095A76ED395` (`user_id`);

--
-- Indices de la tabla `pelicula_actor`
--
ALTER TABLE `pelicula_actor`
  ADD PRIMARY KEY (`pelicula_id`,`actor_id`),
  ADD KEY `IDX_7B27FA7170713909` (`pelicula_id`),
  ADD KEY `IDX_7B27FA7110DAF24A` (`actor_id`);

--
-- Indices de la tabla `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7CE748AA76ED395` (`user_id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actor`
--
ALTER TABLE `actor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `pelicula`
--
ALTER TABLE `pelicula`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `reset_password_request`
--
ALTER TABLE `reset_password_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pelicula`
--
ALTER TABLE `pelicula`
  ADD CONSTRAINT `FK_73BC7095A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `pelicula_actor`
--
ALTER TABLE `pelicula_actor`
  ADD CONSTRAINT `FK_7B27FA7110DAF24A` FOREIGN KEY (`actor_id`) REFERENCES `actor` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_7B27FA7170713909` FOREIGN KEY (`pelicula_id`) REFERENCES `pelicula` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD CONSTRAINT `FK_7CE748AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
