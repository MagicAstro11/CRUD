-- Creacion de tabla usuarios
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    contrasena VARCHAR(255) NOT NULL
);

-- Creacion de tabla articulos
CREATE TABLE libros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    autor VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10, 2) NOT NULL,
    fecha_publicacion DATE,
    categoria VARCHAR(50),
    isbn VARCHAR(20) UNIQUE NOT NULL
);

-- Inserts
INSERT INTO libros (titulo, autor, descripcion, precio, fecha_publicacion, categoria, isbn) VALUES
('El Hobbit', 'J.R.R. Tolkien', 'Una novela que precede a la trilogía de El Señor de los Anillos.', 29.99, '1937-09-21', 'Fantasía', '9780544174221'),
('El Cuarto Mono', 'J.D. Barker', 'Un thriller psicológico que sigue a un detective en la búsqueda de un asesino.', 24.99, '2017-06-27', 'Thriller', '9781328866917'),
('El Necronomicon', 'H.P. Lovecraft', 'Una recopilación de mitos y relatos de horror cósmico.', 19.99, '1927-07-01', 'Horror', '9788467029331'),
('La Metamorfosis', 'Franz Kafka', 'Una obra que narra la transformación de Gregor Samsa en un insecto gigante.', 15.99, '1915-10-15', 'Ficción Clásica', '9788491051573'),
('El Problema de los Tres Cuerpos', 'Liu Cixin', 'Un thriller de ciencia ficción que involucra extraterrestres y el destino de la humanidad.', 26.99, '2008-06-15', 'Ciencia Ficción', '9780765382030'),
('Rebelión en la Granja', 'George Orwell', 'Una alegoría política que critica la Revolución Rusa.', 12.99, '1945-08-17', 'Sátira', '9788499890944'),
('El Nombre del Viento', 'Patrick Rothfuss', 'La historia de Kvothe, un prodigioso músico y mago.', 21.99, '2007-03-27', 'Fantasía Épica', '9788499082479'),
('El Temor de un Hombre Sabio', 'Patrick Rothfuss', 'Segunda parte de la trilogía Crónica del Asesino de Reyes.', 23.99, '2011-09-20', 'Fantasía Épica', '9788499082097'),
('El Señor de las Moscas', 'William Golding', 'Un grupo de niños varados en una isla deben enfrentarse a sus instintos salvajes.', 16.99, '1954-09-17', 'Ficción', '9788420674179'),
('Un Mundo Feliz', 'Aldous Huxley', 'Una distopía que presenta una sociedad futura basada en la felicidad superficial.', 18.99, '1932-10-27', 'Ciencia Ficción', '9788490325072'),
('Metro 2033', 'Dmitri Glujovski', 'Una novela postapocalíptica que se desarrolla en el sistema de metro de Moscú.', 20.99, '2005-06-28', 'Ciencia Ficción', '9788499890945'),
('El Caballero de la Armadura Oxidada', 'Robert Fisher', 'Una historia de autoayuda que aborda temas de autoconocimiento.', 14.99, '1984-01-01', 'Autoayuda', '9788441400813'),
('¿Sueñan los Androides con Ovejas Eléctricas?', 'Philip K. Dick', 'La base para la película Blade Runner, explorando la humanidad y la inteligencia artificial.', 22.99, '1968-01-01', 'Ciencia Ficción', '9788492966703'),
('Jurassic Park', 'Michael Crichton', 'Un thriller de ciencia ficción que presenta la clonación de dinosaurios.', 25.99, '1990-11-20', 'Ciencia Ficción', '9780345370778'),
('Meditaciones', 'Marco Aurelio', 'Un conjunto de reflexiones filosóficas del emperador romano.', 13.99, '180', 'Filosofía', '9788494831565'),
('Fahrenheit 451', 'Ray Bradbury', 'Una distopía que explora la censura y la quema de libros en una sociedad futura.', 17.99, '1953-10-19', 'Ciencia Ficción', '9788497593714');
