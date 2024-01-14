/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     10/1/2024 12:57:55                           */
/*==============================================================*/


drop table if exists auditoria;

drop table if exists clientes;

drop table if exists cobertura;

drop table if exists comprobante_venta;

drop table if exists detalles_pedido;

drop table if exists formas;

drop table if exists pedido;

drop table if exists rellenos;

drop table if exists roles;

drop table if exists sabores;

drop table if exists tamano;

drop table if exists tamanos_formas;

drop table if exists usuarios;

drop table if exists varios;

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
   cobertura_id         int not null,
   cobertura_descripcion varchar(100),
   cobertura_volumen_precio_base decimal,
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
   tamanos_formas_id    int,
   relleno_id           int,
   cobertura_id         int,
   sabores_id           int,
   id_varios            int,
   cantidad             decimal,
   precio               int,
   img  varchar(300),
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
/* Table: pedido                                                */
/*==============================================================*/
create table pedido
(
   pedido_id            int not null,
   cliente_id           int,
   fecha_pedido         date,
   fecha_entrega        date,
   pedido_confirmado    boolean,
   primary key (pedido_id)
);

/*==============================================================*/
/* Table: rellenos                                              */
/*==============================================================*/
create table rellenos
(
   relleno_id           int not null,
   relleno_descripcion  varchar(50),
   relleno_altura       decimal,
   relleno_volumen_precio_base decimal,
   primary key (relleno_id)
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
   sabores_id           int not null,
   sabores_descripcion  varchar(100),
   sabores_volumen_precio_base decimal,
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
/* Table: tamanos_formas                                        */
/*==============================================================*/
create table tamanos_formas
(
   tamanos_formas_id    int not null AUTO_INCREMENT,
   tamano_id            int,
   formas_id            int,
   num_porciones        varchar(8),
   altura               decimal,
   longitud1            decimal,
   longitud2            decimal,
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

alter table detalles_pedido add constraint fk_cobertura_detallespedido foreign key (cobertura_id)
      references cobertura (cobertura_id) on delete restrict on update restrict;

alter table detalles_pedido add constraint fk_pedido_detallespedidio foreign key (pedido_id)
      references pedido (pedido_id) on delete restrict on update restrict;

alter table detalles_pedido add constraint fk_rellenos_detallespedidos foreign key (relleno_id)
      references rellenos (relleno_id) on delete restrict on update restrict;

alter table detalles_pedido add constraint fk_sabores_detallespedido foreign key (sabores_id)
      references sabores (sabores_id) on delete restrict on update restrict;

alter table detalles_pedido add constraint fk_tamanoformas_detallespedido foreign key (tamanos_formas_id)
      references tamanos_formas (tamanos_formas_id) on delete restrict on update restrict;

alter table detalles_pedido add constraint fk_varios_detallespedido foreign key (id_varios)
      references varios (id_varios) on delete restrict on update restrict;

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
