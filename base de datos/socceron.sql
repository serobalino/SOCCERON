/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     1/6/2017 12:49:36                            */
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
   id_ca                int not null,
   descripcion_ca       varchar(50) not null,
   sector_ca            varchar(30) not null,
   tipo_ca              char(20),
   latitud_ca           decimal(8,2),
   longitu_ca           decimal(8,2),
   primary key (id_ca)
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
   id_eq                int not null,
   descripcion_eq       varchar(40) not null,
   fecha_eq             timestamp,
   primary key (id_eq)
);

/*==============================================================*/
/* Table: jugadores                                             */
/*==============================================================*/
create table jugadores
(
   id_ju                bigint not null,
   nombre_ju            char(100) not null,
   contrasena_ju        char(100),
   correo_ju            varchar(50) not null,
   token_ju             char(100),
   fb_ju                char(50),
   estado_ju            bool,
   primary key (id_ju)
);

/*==============================================================*/
/* Table: partidos                                              */
/*==============================================================*/
create table partidos
(
   id_pa                int not null,
   id_eq                int not null,
   id_ca                int not null,
   fecha_pa             datetime not null,
   estado_pa            bool,
   numerojugadores_part int,
   primary key (id_pa)
);

alter table conformado add constraint fk_conformado foreign key (id_ju)
      references jugadores (id_ju) on delete restrict on update restrict;

alter table conformado add constraint fk_conformado2 foreign key (id_eq)
      references equipos (id_eq) on delete restrict on update restrict;

alter table partidos add constraint fk_juegan foreign key (id_eq)
      references equipos (id_eq) on delete restrict on update restrict;

alter table partidos add constraint fk_utilizan foreign key (id_ca)
      references canchas (id_ca) on delete restrict on update restrict;

