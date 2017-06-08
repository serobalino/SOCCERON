/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     7/6/2017 21:05:50                            */
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
   id_ca                int not null auto_increment,
   descripcion_ca       varchar(50) not null,
   sector_ca            varchar(30),
   tipo_ca              char(20),
   latitud_ca           decimal(8,2) not null,
   longitu_ca           decimal(8,2) not null,
   primary key (id_ca)
);

/*==============================================================*/
/* Table: equipos                                               */
/*==============================================================*/
create table equipos
(
   id_pa                int not null,
   id_ju                int not null,
   fecha_co             timestamp
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
   id_pa                int not null auto_increment,
   id_ca                int not null,
   empieza_pa           datetime,
   estado_pa            bool default 1,
   jugadores_pa         int,
   primary key (id_pa)
);

alter table equipos add constraint fk_conformado2 foreign key (id_pa)
      references partidas (id_pa) on delete restrict on update restrict;

alter table equipos add constraint fk_conforman foreign key (id_ju)
      references jugadores (id_ju) on delete restrict on update restrict;

alter table partidas add constraint fk_utilizan foreign key (id_ca)
      references canchas (id_ca) on delete restrict on update restrict;

