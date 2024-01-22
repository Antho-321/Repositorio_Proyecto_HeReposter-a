/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     10/1/2024 12:57:55                           */
/*==============================================================*/


DROP TABLE IF EXISTS detalles_pedido;
DROP TABLE IF EXISTS pastel;
DROP TABLE IF EXISTS comprobante_venta;
DROP TABLE IF EXISTS pedido;
DROP TABLE IF EXISTS tamanos_formas;
DROP TABLE IF EXISTS roles;
DROP TABLE IF EXISTS auditoria;
DROP TABLE IF EXISTS clientes;
DROP TABLE IF EXISTS usuarios;
DROP TABLE IF EXISTS formas;
DROP TABLE IF EXISTS tamano;
DROP TABLE IF EXISTS tipo;
DROP TABLE IF EXISTS categoria;
DROP TABLE IF EXISTS rellenos;
DROP TABLE IF EXISTS cobertura;
DROP TABLE IF EXISTS sabores;
DROP TABLE IF EXISTS varios;

/*==============================================================*/
/* Table: auditoria                                             */
/*==============================================================*/
create table auditoria
(
   id_auditoria         int not null,
   cedula_usuario       int,
   fecha                date,
   hora                 time,
   tabla_afectada       varchar(20),
   operacion_realizada  varchar(20),
   primary key (id_auditoria)
);

/*==============================================================*/
/* Table: clientes                                              */
/*==============================================================*/
create table clientes
(
   cliente_id           int not null AUTO_INCREMENT,
   cedula               varchar(10),
   nombre_cliente       varchar(50),
   telefono             numeric(10,0),
   direccion_domicilio  varchar(50),
   email                varchar(40),
   clave                varchar(10),
   primary key (cliente_id)
);

/*==============================================================*/
/* Table: cobertura                                             */
/*==============================================================*/
create table cobertura
(
   cobertura_id         int not null AUTO_INCREMENT,
   cobertura_descripcion varchar(100),
   cobertura_precio_base_volumen decimal(10, 9),
   primary key (cobertura_id)
);

/*==============================================================*/
/* Table: comprobante_venta                                     */
/*==============================================================*/
create table comprobante_venta
(
   comprobante_id       int not null,
   pedido_id            int not null,
   lugar                varchar(100),
   fecha                date,
   cantidad             decimal,
   concepto             varchar(50),
   cedula_vendedor      varchar(10),
   primary key (comprobante_id)
);

/*==============================================================*/
/* Table: detalles_pedido                                       */
/*==============================================================*/
create table detalles_pedido
(
   detalle_id           int not null AUTO_INCREMENT,
   pedido_id            int,
   id_varios            int,
   pastel_id            int,
   cantidad_pastel      int,
   cantidad_varios      int,
   dedicatoria          varchar(300),
   especificacion_adicional                varchar(100),
   primary key (detalle_id)
);

/*==============================================================*/
/* Table: formas                                                */
/*==============================================================*/
create table formas
(
   formas_id            int not null AUTO_INCREMENT,
   formas_descripcion   varchar(50),
   primary key (formas_id)
);

/*==============================================================*/
/* Table: pastel                                                */
/*==============================================================*/
create table pastel
(
   pastel_id            int not null AUTO_INCREMENT,
   tamanos_formas_id    int,
   tipo_id              int,
   relleno_id           int,
   cobertura_id         int,
   sabores_id           int,
   precio               decimal,
   img                  varchar(300),
   categoria_id         int,
   primary key (pastel_id)
);

/*==============================================================*/
/* Table: pedido                                                */
/*==============================================================*/
create table pedido
(
   pedido_id            int not null AUTO_INCREMENT,
   cliente_id           int,
   fecha_pedido         date DEFAULT NOW(),
   fecha_entrega        date,
   hora_entrega         time,
   pedido_confirmado    boolean DEFAULT false,
   primary key (pedido_id)
);

/*==============================================================*/
/* Table: rellenos                                              */
/*==============================================================*/
CREATE TABLE rellenos
(
   relleno_id int NOT NULL AUTO_INCREMENT,
   relleno_descripcion varchar(50),
   relleno_altura decimal(10, 2), -- Example with 2 decimal places
   relleno_precio_base_volumen decimal(10, 9), -- Example with 9 decimal places
   PRIMARY KEY (relleno_id)
);

/*==============================================================*/
/* Table: roles                                                 */
/*==============================================================*/
create table roles
(
   id_rol               int not null,
   nombre_rol           varchar(20),
   cedula_usuario       int,
   primary key (id_rol)
);

/*==============================================================*/
/* Table: sabores                                               */
/*==============================================================*/
create table sabores
(
   sabores_id           int not null AUTO_INCREMENT,
   sabores_descripcion  varchar(100),
   sabores_precio_base_volumen decimal(10, 9),
   primary key (sabores_id)
);

/*==============================================================*/
/* Table: tamano                                                */
/*==============================================================*/
create table tamano
(
   tamano_id            int not null AUTO_INCREMENT,
   tamano_descripcion   varchar(50),
   primary key (tamano_id)
);

/*==============================================================*/
/* Table: tipo                                                */
/*==============================================================*/
create table tipo
(
   tipo_id            int not null AUTO_INCREMENT,
   tipo_descripcion   varchar(50),
   tipo_precio_base_volumen decimal(10, 9),
   primary key (tipo_id)
);

/*==============================================================*/
/* Table: categoria                                                */
/*==============================================================*/
create table categoria
(
   categoria_id            int not null AUTO_INCREMENT,
   categoria_descripcion   varchar(50),
   primary key (categoria_id)
);

/*==============================================================*/
/* Table: tamanos_formas                                        */
/*==============================================================*/
create table tamanos_formas
(
   tamanos_formas_id    int not null AUTO_INCREMENT,
   tamano_id            int,
   formas_id            int,
   num_porciones        varchar(8),
   altura               decimal(10, 9),
   longitud1            decimal(10, 8),
   longitud2            decimal(10, 8),
   primary key (tamanos_formas_id)
);

/*==============================================================*/
/* Table: usuarios                                              */
/*==============================================================*/
create table usuarios
(
   cedula_usuario       int not null,
   nombre_usuario       varchar(50),
   correo               varchar(50),
   contrasena           varchar(10),
   primary key (cedula_usuario)
);

/*==============================================================*/
/* Table: varios                                                */
/*==============================================================*/
create table varios
(
   id_varios            int not null,
   descripcion_varios   varchar(1000),
   precio_varios        decimal(10),
   img_varios           varchar(300),
   primary key (id_varios)
);

alter table auditoria add constraint fk_relationship_11 foreign key (cedula_usuario)
      references usuarios (cedula_usuario) on delete restrict on update restrict;

alter table comprobante_venta add constraint fk_pedido_comprobanteventa2 foreign key (pedido_id)
      references pedido (pedido_id) on delete restrict on update restrict;

alter table detalles_pedido add constraint fk_pastel_detalles_pedido foreign key (pastel_id)
      references pastel (pastel_id) on delete restrict on update restrict;

alter table detalles_pedido add constraint fk_pedido_detallespedidio foreign key (pedido_id)
      references pedido (pedido_id) on delete restrict on update restrict;

alter table detalles_pedido add constraint fk_varios_detallespedido foreign key (id_varios)
      references varios (id_varios) on delete restrict on update restrict;

alter table pastel add constraint fk_cobertura_detallespedido foreign key (cobertura_id)
      references cobertura (cobertura_id) on delete restrict on update restrict;

alter table pastel add constraint fk_rellenos_detallespedidos foreign key (relleno_id)
      references rellenos (relleno_id) on delete restrict on update restrict;

alter table pastel add constraint fk_sabores_detallespedido foreign key (sabores_id)
      references sabores (sabores_id) on delete restrict on update restrict;

alter table pastel add constraint fk_tamanoformas_detallespedido foreign key (tamanos_formas_id)
      references tamanos_formas (tamanos_formas_id) on delete restrict on update restrict;

alter table pastel add constraint fk_tipo_pastel foreign key (tipo_id)
      references tipo (tipo_id) on delete restrict on update restrict;

alter table pedido add constraint fk_clientes_pedidos foreign key (cliente_id)
      references clientes (cliente_id) on delete restrict on update restrict;

alter table roles add constraint fk_relationship_12 foreign key (cedula_usuario)
      references usuarios (cedula_usuario) on delete restrict on update restrict;

alter table tamanos_formas add constraint fk_formas_tamanosformas foreign key (formas_id)
      references formas (formas_id) on delete restrict on update restrict;

alter table tamanos_formas add constraint fk_tamano_tamanosformas foreign key (tamano_id)
      references tamano (tamano_id) on delete restrict on update restrict;

/*==============================================================*/
/* INSERCIONES                                             */
/*==============================================================*/

INSERT INTO `tamano`(`tamano_descripcion`) VALUES
('Extra grande'),
('Grande'),
('Mediana'),
('Pequeña'),
('Mini');

INSERT INTO `formas`(`formas_descripcion`) VALUES 
('Redonda'),
('Personalizada'),
('Cuadrada'),
('Rectangular');

INSERT INTO `tamanos_formas`(`tamano_id`, `formas_id`, `num_porciones`, `altura`, `longitud1`, `longitud2`) VALUES ('1','1','70','8.90625','18.06408604',null);
INSERT INTO `tamanos_formas`(`tamano_id`, `formas_id`, `num_porciones`, `altura`, `longitud1`, `longitud2`) VALUES ('2','1','30','8.4375','15.19929707',null);
INSERT INTO `tamanos_formas`(`tamano_id`, `formas_id`, `num_porciones`, `altura`, `longitud1`, `longitud2`) VALUES ('3','1','16','6.09375','12.09577567',null);
INSERT INTO `tamanos_formas`(`tamano_id`, `formas_id`, `num_porciones`, `altura`, `longitud1`, `longitud2`) VALUES ('4','1','10-12','5.15625','10.10633889',null);
INSERT INTO `tamanos_formas`(`tamano_id`, `formas_id`, `num_porciones`, `altura`, `longitud1`, `longitud2`) VALUES ('5','1','5-6','4.6875','8.116902098',null);
INSERT INTO `tamanos_formas`(`tamano_id`, `formas_id`, `num_porciones`, `altura`, `longitud1`, `longitud2`) VALUES ('1','2','66-68','8.90625','18.06408604',null);
INSERT INTO `tamanos_formas`(`tamano_id`, `formas_id`, `num_porciones`, `altura`, `longitud1`, `longitud2`) VALUES ('2','2','26-28','8.4375','15.19929707',null);
INSERT INTO `tamanos_formas`(`tamano_id`, `formas_id`, `num_porciones`, `altura`, `longitud1`, `longitud2`) VALUES ('3','2','12-14','6.09375','12.09577567',null);
INSERT INTO `tamanos_formas`(`tamano_id`, `formas_id`, `num_porciones`, `altura`, `longitud1`, `longitud2`) VALUES ('4','2','8-10','5.15625','10.10633889',null);
INSERT INTO `tamanos_formas`(`tamano_id`, `formas_id`, `num_porciones`, `altura`, `longitud1`, `longitud2`) VALUES ('5','2','2-4','4.6875','8.116902098',null);
INSERT INTO `tamanos_formas`(`tamano_id`, `formas_id`, `num_porciones`, `altura`, `longitud1`, `longitud2`) VALUES ('2','3','50','5.9','40.45','40.05');
INSERT INTO `tamanos_formas`(`tamano_id`, `formas_id`, `num_porciones`, `altura`, `longitud1`, `longitud2`) VALUES ('3','3','35-40','5.9','35.25','34.9');
INSERT INTO `tamanos_formas`(`tamano_id`, `formas_id`, `num_porciones`, `altura`, `longitud1`, `longitud2`) VALUES ('4','3','20-25','5.7','24.5','24.25');
INSERT INTO `tamanos_formas`(`tamano_id`, `formas_id`, `num_porciones`, `altura`, `longitud1`, `longitud2`) VALUES ('1','4','100','4.5','64.75','45.35');
INSERT INTO `tamanos_formas`(`tamano_id`, `formas_id`, `num_porciones`, `altura`, `longitud1`, `longitud2`) VALUES ('3','4','35-40','6','39.9','25');

INSERT INTO `rellenos` (`relleno_descripcion`, `relleno_altura`, `relleno_precio_base_volumen`) VALUES ('Mermelada', NULL, NULL);
INSERT INTO `rellenos` (`relleno_descripcion`, `relleno_altura`, `relleno_precio_base_volumen`) VALUES ('Glass de frutilla con crema', 0.75, 0.009185692);
INSERT INTO `rellenos` (`relleno_descripcion`, `relleno_altura`, `relleno_precio_base_volumen`) VALUES ('Crema napolitana', 0.75, 0.01102283);
INSERT INTO `rellenos` (`relleno_descripcion`, `relleno_altura`, `relleno_precio_base_volumen`) VALUES ('Durazno con crema', 0.75, 0.01102283);
INSERT INTO `rellenos` (`relleno_descripcion`, `relleno_altura`, `relleno_precio_base_volumen`) VALUES ('Ninguno', 0, 0);

INSERT INTO `sabores` (`sabores_descripcion`, `sabores_precio_base_volumen`) VALUES ('Naranja', 0.002061381);
INSERT INTO `sabores` (`sabores_descripcion`, `sabores_precio_base_volumen`) VALUES ('Naranja y chocolate (Marmoleada)', 0.002061381);
INSERT INTO `sabores` (`sabores_descripcion`, `sabores_precio_base_volumen`) VALUES ('Vainilla', 0.002061381);
INSERT INTO `sabores` (`sabores_descripcion`, `sabores_precio_base_volumen`) VALUES ('Chocolate', 0.003607416);
INSERT INTO `sabores` (`sabores_descripcion`, `sabores_precio_base_volumen`) VALUES ('Maracuyá', 0.004122762);
INSERT INTO `sabores` (`sabores_descripcion`, `sabores_precio_base_volumen`) VALUES ('Fresa', 0.009276214);
INSERT INTO `sabores` (`sabores_descripcion`, `sabores_precio_base_volumen`) VALUES ('Limón', 0.009276214);
INSERT INTO `sabores` (`sabores_descripcion`, `sabores_precio_base_volumen`) VALUES ('Uva', 0.009276214);
INSERT INTO `sabores` (`sabores_descripcion`, `sabores_precio_base_volumen`) VALUES ('Manzana', 0.009276214);

INSERT INTO `tipo` (`tipo_descripcion`, `tipo_precio_base_volumen`) VALUES ('Normal (Con receta propia)', 0.002061381);
INSERT INTO `tipo` (`tipo_descripcion`, `tipo_precio_base_volumen`) VALUES ('Normal (Con premezcla)', 0.002983874);
INSERT INTO `tipo` (`tipo_descripcion`, `tipo_precio_base_volumen`) VALUES ('Especial (Con frutos secos)', 0.007214833);
INSERT INTO `tipo` (`tipo_descripcion`, `tipo_precio_base_volumen`) VALUES ('Bizcochuelo', 0.002061381);
INSERT INTO `tipo` (`tipo_descripcion`, `tipo_precio_base_volumen`) VALUES ('Milhojas', 0.002061381);
INSERT INTO `tipo` (`tipo_descripcion`, `tipo_precio_base_volumen`) VALUES ('Cheesecake', 0.009276214);
INSERT INTO `tipo` (`tipo_descripcion`, `tipo_precio_base_volumen`) VALUES ('Mousse', 0.006069417);
INSERT INTO `tipo` (`tipo_descripcion`, `tipo_precio_base_volumen`) VALUES ('Tres leches', 0.003570245);

INSERT INTO `categoria` (`categoria_descripcion`) VALUES ('Bodas');
INSERT INTO `categoria` (`categoria_descripcion`) VALUES ('Bautizos');
INSERT INTO `categoria` (`categoria_descripcion`) VALUES ('XV años');
INSERT INTO `categoria` (`categoria_descripcion`) VALUES ('Cumpleaños');
INSERT INTO `categoria` (`categoria_descripcion`) VALUES ('Baby Shower');
INSERT INTO `categoria` (`categoria_descripcion`) VALUES ('San Valentin');
INSERT INTO `categoria` (`categoria_descripcion`) VALUES ('Halloween');
INSERT INTO `categoria` (`categoria_descripcion`) VALUES ('Navidad');

INSERT INTO `cobertura` (`cobertura_descripcion`, `cobertura_precio_base_volumen`) VALUES ('Crema', '0.008338684');
INSERT INTO `cobertura` (`cobertura_descripcion`, `cobertura_precio_base_volumen`) VALUES ('Fondant', '0.050032103');
INSERT INTO `cobertura` (`cobertura_descripcion`, `cobertura_precio_base_volumen`) VALUES ('Ninguna', '0');

SET FOREIGN_KEY_CHECKS=0;
INSERT INTO `pastel` ( `tamanos_formas_id`, `tipo_id`, `relleno_id`, `cobertura_id`, `sabores_id`, `precio`, `img`, `categoria_id`) VALUES
(1, 1, 1, 1, 1, 20, 'https://th.bing.com/th/id/R.b042dade06440a9cf8c236b81ad2c4d8?rik=8ynKhjpIzp3%2bmA&pid=ImgRaw&r=0', 1),
(2, 4, 2, 2, 4, 10, 'https://th.bing.com/th/id/R.b40b59c817f0ec2c24a5097a457b2c58?rik=LSOvD1PsMJfxeA&pid=ImgRaw&r=0', 2),
(1, 1, 1, 1, 1, 18, 'https://sallysbakingaddiction.com/wp-content/uploads/2013/04/triple-chocolate-cake-4.jpg', 1),
(1, 1, 1, 1, 1, 27, 'https://th.bing.com/th/id/OIP.-vDV59NDSrLbo5SKb2jxggHaF3?pid=ImgDet&rs=1', 4),
(1, 1, 1, 1, 1, 68, 'https://th.bing.com/th/id/R.46fb8a09fc2f95a905b4342a428bd1fd?rik=C3KVdZ9n6YOTIw&pid=ImgRaw&r=0', 5),
(1, 1, 1, 1, 1, 90, 'https://www.recipetineats.com/wp-content/uploads/2020/08/My-best-Vanilla-Cake_9-SQ.jpg', 1);
SET FOREIGN_KEY_CHECKS=1;

INSERT INTO `clientes` (`cliente_id`, `cedula`, `nombre_cliente`, `telefono`, `direccion_domicilio`, `email`, `clave`) VALUES
(1, NULL, NULL, NULL, NULL, 'anthonyluisluna225@gmail.com', '123');