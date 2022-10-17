
-- Datos para categorias 
INSERT INTO `tienda`.`categorias` (`nombre`, `descripcion`) VALUES ('sneakers', 'Las sneakers son unas zapatillas deportivas, pero las verás más a menudo por la calle que en el gimnasio.');
INSERT INTO `tienda`.`categorias` (`nombre`, `descripcion`) VALUES ('running', 'Para la actividad del running lo más importante es que el calzado sea de buena calidad. Pues, las rodillas se ven impactadas. Por lo tanto, la amortiguación debe ser cómoda y segura, para evitar correr el riesgo de lesionarnos.');
INSERT INTO `tienda`.`categorias` (`nombre`, `descripcion`) VALUES ('tenis', 'No es lo mismo hacer deporte en cemento o tierra batida que en césped. Los tipos de zapatillas que utilicemos deben adaptarse al tipo de terreno. Y cuando se trata de tennis, unas zapatillas adecuadas para tal fin son esenciales.');
INSERT INTO `tienda`.`categorias` (`nombre`, `descripcion`) VALUES ('fútbol', 'Son muy específicas e imprescindibles para realizar este deporte. Es completamente necesario que agarren en el césped para evitar resbalarnos, o el pavimento en el caso de fútbol sala. Además, deben permitirnos controlar el balón de forma precisa y aportar buena sujeción para el pie.');
INSERT INTO `tienda`.`categorias` (`nombre`, `descripcion`) VALUES ('slip-on', 'Estas zapatillas son de estilo casual y tienen la suela lisa. Normalmente son zapatillas de lona, aunque también las podemos encontrar de piel. Los elásticos en los laterales y el empeine cerrado son sus principales características.');

-- Datos usuarios
INSERT INTO `tienda`.`usuarios` (`roles`, `password`, `correo`, `direccion`, `cp`, `ciudad`, `pais`) 
VALUES ('["Role_user"]', 123, 'alex@gmail.com', 'Calle', '30510', 'Murcia', 'España');

-- Datos productos y sus imagenes
-- 1. Sneakers
INSERT INTO `tienda`.`productos` (`nombre`, `peso`, `stock`, `id_cat_id`, `precio`, `descripcion`) 
VALUES ( 'Air Force 1', 4.35 , 50, 1, 91.05, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.' );

INSERT INTO `tienda`.`imagenes` (`url`, `id_producto_id`) VALUES ('images/sneakers/air-force-1.jpg', 2);
INSERT INTO `tienda`.`imagenes` (`url`, `id_producto_id`) VALUES ('images/sneakers/air-force-2.jpg', 2);
INSERT INTO `tienda`.`imagenes` (`url`, `id_producto_id`) VALUES ('images/sneakers/air-force-3.jpg', 2);
INSERT INTO `tienda`.`imagenes` (`url`, `id_producto_id`) VALUES ('images/sneakers/air-force-4.jpg', 2);

INSERT INTO `tienda`.`productos` (`nombre`, `peso`, `stock`, `id_cat_id`, `precio`, `descripcion`) 
VALUES ( 'Air Jordan 1 Low SE', 2.23, 10, 1, 99.99, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s.' );

INSERT INTO `tienda`.`imagenes` (`url`, `id_producto_id`) VALUES ('images/sneakers/air-jordan-1.jpg', 3);
INSERT INTO `tienda`.`imagenes` (`url`, `id_producto_id`) VALUES ('images/sneakers/air-jordan-2.jpg', 3);
INSERT INTO `tienda`.`imagenes` (`url`, `id_producto_id`) VALUES ('images/sneakers/air-jordan-3.jpg', 3);
INSERT INTO `tienda`.`imagenes` (`url`, `id_producto_id`) VALUES ('images/sneakers/air-jordan-4.jpg', 3);
INSERT INTO `tienda`.`imagenes` (`url`, `id_producto_id`) VALUES ('images/sneakers/air-jordan-5.jpg', 3);

INSERT INTO `tienda`.`productos` (`nombre`, `peso`, `stock`, `id_cat_id`, `precio`, `descripcion`) 
VALUES ( 'WMNS Air Low', 2.23, 35, 1, 119.99, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s.' );

INSERT INTO `tienda`.`imagenes` (`url`, `id_producto_id`) VALUES ('images/sneakers/WMNS-Air-Low-1.jpg', 4);
INSERT INTO `tienda`.`imagenes` (`url`, `id_producto_id`) VALUES ('images/sneakers/WMNS-Air-Low-2.jpg', 4);
INSERT INTO `tienda`.`imagenes` (`url`, `id_producto_id`) VALUES ('images/sneakers/WMNS-Air-Low-3.jpg', 4);
INSERT INTO `tienda`.`imagenes` (`url`, `id_producto_id`) VALUES ('images/sneakers/WMNS-Air-Low-4.jpg', 4);
INSERT INTO `tienda`.`imagenes` (`url`, `id_producto_id`) VALUES ('images/sneakers/WMNS-Air-Low-5.jpg', 4);


INSERT INTO `tienda`.`productos` (`nombre`, `peso`, `stock`, `id_cat_id`, `precio`, `descripcion`) 
VALUES ( 'Elevate Low SE', 2.67, 100, 1, 139.95, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s.' );

INSERT INTO `tienda`.`imagenes` (`url`, `id_producto_id`) VALUES ('images/sneakers/elevate-low-se-1.jpg', 5);
INSERT INTO `tienda`.`imagenes` (`url`, `id_producto_id`) VALUES ('images/sneakers/elevate-low-se-2.jpg', 5);
INSERT INTO `tienda`.`imagenes` (`url`, `id_producto_id`) VALUES ('images/sneakers/elevate-low-se-3.jpg', 5);
INSERT INTO `tienda`.`imagenes` (`url`, `id_producto_id`) VALUES ('images/sneakers/elevate-low-se-4.jpg', 5);
INSERT INTO `tienda`.`imagenes` (`url`, `id_producto_id`) VALUES ('images/sneakers/elevate-low-se-5.jpg', 5);


INSERT INTO `tienda`.`productos` (`nombre`, `peso`, `stock`, `id_cat_id`, `precio`, `descripcion`) 
VALUES ( 'Jumpman Two Trey', 2.23, 55, 1, 125.99, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s.' );

INSERT INTO `tienda`.`imagenes` (`url`, `id_producto_id`) VALUES ('images/sneakers/jumpman-two-trey-1.jpg', 6);
INSERT INTO `tienda`.`imagenes` (`url`, `id_producto_id`) VALUES ('images/sneakers/jumpman-two-trey-2.jpg', 6);
INSERT INTO `tienda`.`imagenes` (`url`, `id_producto_id`) VALUES ('images/sneakers/jumpman-two-trey-3.jpg', 6);
INSERT INTO `tienda`.`imagenes` (`url`, `id_producto_id`) VALUES ('images/sneakers/jumpman-two-trey-4.jpg', 6);
INSERT INTO `tienda`.`imagenes` (`url`, `id_producto_id`) VALUES ('images/sneakers/jumpman-two-trey-5.jpg', 6);


-- 2. Running 
INSERT INTO `tienda`.`productos` (`nombre`, `peso`, `stock`, `id_cat_id`, `precio`, `descripcion`) 
VALUES ( 'Mizuno Wave Prodigy 4', 1.65, 129, 2, 109.99, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s.' );

INSERT INTO `tienda`.`imagenes` (`url`, `id_producto_id`) VALUES ('images/running/mizuno-wave-prodigy-4-1.jpg', 7);
INSERT INTO `tienda`.`imagenes` (`url`, `id_producto_id`) VALUES ('images/running/mizuno-wave-prodigy-4-2.jpg', 7);
INSERT INTO `tienda`.`imagenes` (`url`, `id_producto_id`) VALUES ('images/running/mizuno-wave-prodigy-4-3.jpg', 7);

INSERT INTO `tienda`.`productos` (`nombre`, `peso`, `stock`, `id_cat_id`, `precio`, `descripcion`) 
VALUES ( 'Nike Air', 1.95, 200, 2, 79.99, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s.' );

INSERT INTO `tienda`.`imagenes` (`url`, `id_producto_id`) VALUES ('images/running/nike-air-1.jpg', 8);
INSERT INTO `tienda`.`imagenes` (`url`, `id_producto_id`) VALUES ('images/running/nike-air-2.jpg', 8);
INSERT INTO `tienda`.`imagenes` (`url`, `id_producto_id`) VALUES ('images/running/nike-air-3.jpg', 8);
INSERT INTO `tienda`.`imagenes` (`url`, `id_producto_id`) VALUES ('images/running/nike-air-4.jpg', 8);
INSERT INTO `tienda`.`imagenes` (`url`, `id_producto_id`) VALUES ('images/running/nike-air-5.jpg', 8);

INSERT INTO `tienda`.`productos` (`nombre`, `peso`, `stock`, `id_cat_id`, `precio`, `descripcion`) 
VALUES ( 'Asics Gel-excite', 1.65, 129, 2, 89.99, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s.' );

INSERT INTO `tienda`.`imagenes` (`url`, `id_producto_id`) VALUES ('images/running/asics-gel-excite-1.jpg', 9);
INSERT INTO `tienda`.`imagenes` (`url`, `id_producto_id`) VALUES ('images/running/asics-gel-excite-2.jpg', 9);
INSERT INTO `tienda`.`imagenes` (`url`, `id_producto_id`) VALUES ('images/running/asics-gel-excite-3.jpg', 9);
INSERT INTO `tienda`.`imagenes` (`url`, `id_producto_id`) VALUES ('images/running/asics-gel-excite-4.jpg', 9);
INSERT INTO `tienda`.`imagenes` (`url`, `id_producto_id`) VALUES ('images/running/asics-gel-excite-5.jpg', 9);

-- 3. Tenis
INSERT INTO `tienda`.`productos` (`nombre`, `peso`, `stock`, `id_cat_id`, `precio`, `descripcion`) 
VALUES ( 'Express Light', 4.56, 25, 3, 45.55, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s.' );
INSERT INTO `tienda`.`imagenes` (`url`, `id_producto_id`) VALUES ('images/tennis/express-light-1.jpg', 10);
INSERT INTO `tienda`.`imagenes` (`url`, `id_producto_id`) VALUES ('images/tennis/express-light-2.jpg', 10);

INSERT INTO `tienda`.`productos` (`nombre`, `peso`, `stock`, `id_cat_id`, `precio`, `descripcion`) 
VALUES ( 'Asics Gel-game', 4.56, 100, 3, 79.55, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s.' );
INSERT INTO `tienda`.`imagenes` (`url`, `id_producto_id`) VALUES ('images/tennis/asics-gel-game-1.jpg', 11);
INSERT INTO `tienda`.`imagenes` (`url`, `id_producto_id`) VALUES ('images/tennis/asics-gel-game-2.jpg', 11);
INSERT INTO `tienda`.`imagenes` (`url`, `id_producto_id`) VALUES ('images/tennis/asics-gel-game-3.jpg', 11);
INSERT INTO `tienda`.`imagenes` (`url`, `id_producto_id`) VALUES ('images/tennis/asics-gel-game-4.jpg', 11);
INSERT INTO `tienda`.`imagenes` (`url`, `id_producto_id`) VALUES ('images/tennis/asics-gel-game-5.jpg', 11);

-- 4. Futbol
INSERT INTO `tienda`.`productos` (`nombre`, `peso`, `stock`, `id_cat_id`, `precio`, `descripcion`) 
VALUES ( '', , , , , 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s.' );

-- 5. slip-on
INSERT INTO `tienda`.`productos` (`nombre`, `peso`, `stock`, `id_cat_id`, `precio`, `descripcion`) 
VALUES ( '', , , , , 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s.' );


