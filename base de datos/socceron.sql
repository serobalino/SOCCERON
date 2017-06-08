/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     7/6/2017 19:00:50                            */
/*==============================================================*/


drop table if exists canchas;

drop table if exists equipos;

drop table if exists jugadores;

drop table if exists partidas;

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
/* Table: equipos                                               */
/*==============================================================*/
create table equipos
(
   id_part              int not null auto_increment,
   id_ju                int,
   fecha_co             timestamp,
   primary key (id_part)
);

/*==============================================================*/
/* Table: jugadores                                             */
/*==============================================================*/
create table jugadores
(
   id_ju                int not null auto_increment,
   nombre_ju            char(20) not null,
   contrasena_ju        char(60) not null,
   correo_ju            varchar(50) not null,
   token_ju             char(100),
   fb_ju                char(20),
   estado_ju            bool default 1,
   primary key (id_ju)
);

/*==============================================================*/
/* Table: partidas                                              */
/*==============================================================*/
create table partidas
(
   id_part              int not null auto_increment,
   id_can               int not null,
   fecha_part           datetime,
   estado_part          bool,
   primary key (id_part)
);

alter table equipos add constraint fk_conformado2 foreign key (id_part)
      references partidas (id_part) on delete restrict on update restrict;

alter table equipos add constraint fk_conforman foreign key (id_ju)
      references jugadores (id_ju) on delete restrict on update restrict;

alter table partidas add constraint fk_utilizan foreign key (id_can)
      references canchas (id_can) on delete restrict on update restrict;

