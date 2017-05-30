/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     30/5/2017 17:08:39                           */
/*==============================================================*/


drop table if exists canchas;

drop table if exists conformado;

drop table if exists equipos;

drop table if exists jugadores;

drop table if exists partidos;

/*==============================================================*/
/* Table: canchas                                               */
/*==============================================================*/
create table canchas
(
   id_can               int not null auto_increment,
   descripcion_can      varchar(50) not null,
   sector_can           varchar(30) not null,
   tipo_can             char(20),
   latitud_can          decimal(8,2),
   longitu_can          decimal(8,2),
   primary key (id_can)
);

/*==============================================================*/
/* Table: conformado                                            */
/*==============================================================*/
create table conformado
(
   id_ju                bigint not null,
   id_eq                int not null,
   fecha_co             timestamp,
   primary key (id_ju, id_eq)
);

/*==============================================================*/
/* Table: equipos                                               */
/*==============================================================*/
create table equipos
(
   id_eq                int not null auto_increment,
   descripcion_eq       varchar(40) not null,
   fecha_eq             timestamp,
   primary key (id_eq)
);

/*==============================================================*/
/* Table: jugadores                                             */
/*==============================================================*/
create table jugadores
(
   id_ju                bigint not null auto_increment,
   nombre_ju            char(20) not null,
   contrasena_ju        char(20) not null,
   correo_ju            varchar(50) not null,
   token_ju             char(100),
   fb_ju                bool default 0,
   primary key (id_ju)
);

/*==============================================================*/
/* Table: partidos                                              */
/*==============================================================*/
create table partidos
(
   id_part              int not null auto_increment,
   id_eq                int not null,
   id_can               int not null,
   fecha_part           datetime not null,
   primary key (id_part)
);

alter table conformado add constraint fk_conformado foreign key (id_ju)
      references jugadores (id_ju) on delete restrict on update restrict;

alter table conformado add constraint fk_conformado2 foreign key (id_eq)
      references equipos (id_eq) on delete restrict on update restrict;

alter table partidos add constraint fk_juegan foreign key (id_eq)
      references equipos (id_eq) on delete restrict on update restrict;

alter table partidos add constraint fk_utilizan foreign key (id_can)
      references canchas (id_can) on delete restrict on update restrict;

