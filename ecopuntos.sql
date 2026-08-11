--------------------------------------------------------
--  File created - Monday-August-10-2026   
--------------------------------------------------------
------------------------------------------------------------------
--  DDL for Sequence SEQ_CENTROS
--------------------------------------------------------

   CREATE SEQUENCE  "ECOPUNTOS_USER"."SEQ_CENTROS"  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 21 CACHE 20 NOORDER  NOCYCLE  NOKEEP  NOSCALE  GLOBAL ;
--------------------------------------------------------
--  DDL for Sequence SEQ_COMERCIOS
--------------------------------------------------------

   CREATE SEQUENCE  "ECOPUNTOS_USER"."SEQ_COMERCIOS"  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 41 CACHE 20 NOORDER  NOCYCLE  NOKEEP  NOSCALE  GLOBAL ;
--------------------------------------------------------
--  DDL for Sequence SEQ_CUPONES
--------------------------------------------------------

   CREATE SEQUENCE  "ECOPUNTOS_USER"."SEQ_CUPONES"  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 1 CACHE 20 NOORDER  NOCYCLE  NOKEEP  NOSCALE  GLOBAL ;
--------------------------------------------------------
--  DDL for Sequence SEQ_ENTREGAS
--------------------------------------------------------

   CREATE SEQUENCE  "ECOPUNTOS_USER"."SEQ_ENTREGAS"  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 1 CACHE 20 NOORDER  NOCYCLE  NOKEEP  NOSCALE  GLOBAL ;
--------------------------------------------------------
--  DDL for Sequence SEQ_ENTREGAS_DETALLE
--------------------------------------------------------

   CREATE SEQUENCE  "ECOPUNTOS_USER"."SEQ_ENTREGAS_DETALLE"  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 1 CACHE 20 NOORDER  NOCYCLE  NOKEEP  NOSCALE  GLOBAL ;
--------------------------------------------------------
--  DDL for Sequence SEQ_MATERIALES
--------------------------------------------------------

   CREATE SEQUENCE  "ECOPUNTOS_USER"."SEQ_MATERIALES"  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 41 CACHE 20 NOORDER  NOCYCLE  NOKEEP  NOSCALE  GLOBAL ;
--------------------------------------------------------
--  DDL for Sequence SEQ_RECOMPENSAS
--------------------------------------------------------

   CREATE SEQUENCE  "ECOPUNTOS_USER"."SEQ_RECOMPENSAS"  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 41 CACHE 20 NOORDER  NOCYCLE  NOKEEP  NOSCALE  GLOBAL ;
--------------------------------------------------------
--  DDL for Sequence SEQ_USUARIOS
--------------------------------------------------------

   CREATE SEQUENCE  "ECOPUNTOS_USER"."SEQ_USUARIOS"  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 41 CACHE 20 NOORDER  NOCYCLE  NOKEEP  NOSCALE  GLOBAL ;
--------------------------------------------------------
--  DDL for Table CENTROS_ACOPIO
--------------------------------------------------------

  CREATE TABLE "ECOPUNTOS_USER"."CENTROS_ACOPIO" 
   (	"ID_CENTRO" NUMBER DEFAULT "ECOPUNTOS_USER"."SEQ_CENTROS"."NEXTVAL", 
	"NOMBRE_CENTRO" VARCHAR2(150 BYTE) COLLATE "USING_NLS_COMP", 
	"PROVINCIA" VARCHAR2(50 BYTE) COLLATE "USING_NLS_COMP", 
	"CANTON" VARCHAR2(50 BYTE) COLLATE "USING_NLS_COMP", 
	"DIRECCION_EXACTA" VARCHAR2(255 BYTE) COLLATE "USING_NLS_COMP", 
	"ESTADO" VARCHAR2(10 BYTE) COLLATE "USING_NLS_COMP" DEFAULT 'ACTIVO'
   )  DEFAULT COLLATION "USING_NLS_COMP" SEGMENT CREATION IMMEDIATE 
  PCTFREE 10 PCTUSED 40 INITRANS 10 MAXTRANS 255 
 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
  BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "DATA" ;
--------------------------------------------------------
--  DDL for Table COMERCIOS
--------------------------------------------------------

  CREATE TABLE "ECOPUNTOS_USER"."COMERCIOS" 
   (	"ID_COMERCIO" NUMBER DEFAULT "ECOPUNTOS_USER"."SEQ_COMERCIOS"."NEXTVAL", 
	"ID_USUARIO" NUMBER, 
	"NOMBRE_COMERCIO" VARCHAR2(150 BYTE) COLLATE "USING_NLS_COMP", 
	"CEDULA_JURIDICA" VARCHAR2(30 BYTE) COLLATE "USING_NLS_COMP", 
	"TELEFONO" VARCHAR2(20 BYTE) COLLATE "USING_NLS_COMP", 
	"CORREO_CONTACTO" VARCHAR2(150 BYTE) COLLATE "USING_NLS_COMP"
   )  DEFAULT COLLATION "USING_NLS_COMP" SEGMENT CREATION IMMEDIATE 
  PCTFREE 10 PCTUSED 40 INITRANS 10 MAXTRANS 255 
 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
  BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "DATA" ;
--------------------------------------------------------
--  DDL for Table CUPONES_EMITIDOS
--------------------------------------------------------

  CREATE TABLE "ECOPUNTOS_USER"."CUPONES_EMITIDOS" 
   (	"ID_CUPON" NUMBER DEFAULT "ECOPUNTOS_USER"."SEQ_CUPONES"."NEXTVAL", 
	"CODIGO_CUPON" VARCHAR2(20 BYTE) COLLATE "USING_NLS_COMP", 
	"ID_USUARIO" NUMBER, 
	"ID_RECOMPENSA" NUMBER, 
	"FECHA_EMISION" DATE DEFAULT SYSDATE, 
	"FECHA_EXPIRACION" DATE, 
	"ESTADO" VARCHAR2(15 BYTE) COLLATE "USING_NLS_COMP" DEFAULT 'DISPONIBLE'
   )  DEFAULT COLLATION "USING_NLS_COMP" SEGMENT CREATION DEFERRED 
  PCTFREE 10 PCTUSED 40 INITRANS 10 MAXTRANS 255 
 NOCOMPRESS LOGGING
  TABLESPACE "DATA" ;
--------------------------------------------------------
--  DDL for Table DBTOOLS$MCP_LOG
--------------------------------------------------------

  CREATE TABLE "ECOPUNTOS_USER"."DBTOOLS$MCP_LOG" 
   (	"ID" NUMBER GENERATED BY DEFAULT AS IDENTITY MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 1 CACHE 20 NOORDER  NOCYCLE  NOKEEP  NOSCALE , 
	"MCP_CLIENT" VARCHAR2(200 BYTE) COLLATE "USING_NLS_COMP", 
	"MODEL" VARCHAR2(200 BYTE) COLLATE "USING_NLS_COMP", 
	"END_POINT_TYPE" VARCHAR2(12 BYTE) COLLATE "USING_NLS_COMP", 
	"END_POINT_NAME" VARCHAR2(100 BYTE) COLLATE "USING_NLS_COMP", 
	"LOG_MESSAGE" CLOB COLLATE "USING_NLS_COMP" DEFAULT NULL, 
	"CREATED_ON" TIMESTAMP (6) DEFAULT CURRENT_TIMESTAMP, 
	"CREATED_BY" VARCHAR2(100 BYTE) COLLATE "USING_NLS_COMP" DEFAULT USER, 
	"UPDATED_ON" TIMESTAMP (6) DEFAULT CURRENT_TIMESTAMP, 
	"UPDATED_BY" VARCHAR2(100 BYTE) COLLATE "USING_NLS_COMP" DEFAULT USER
   )  DEFAULT COLLATION "USING_NLS_COMP" SEGMENT CREATION IMMEDIATE 
  PCTFREE 10 PCTUSED 40 INITRANS 10 MAXTRANS 255 
 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
  BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "DATA" 
 LOB ("LOG_MESSAGE") STORE AS SECUREFILE (
  TABLESPACE "DATA" ENABLE STORAGE IN ROW 4000 CHUNK 8192
  NOCACHE LOGGING  NOCOMPRESS  KEEP_DUPLICATES 
  STORAGE(INITIAL 262144 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0
  BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)) ;
--------------------------------------------------------
--  DDL for Table ENTREGAS_DETALLE
--------------------------------------------------------

  CREATE TABLE "ECOPUNTOS_USER"."ENTREGAS_DETALLE" 
   (	"ID_DETALLE" NUMBER DEFAULT "ECOPUNTOS_USER"."SEQ_ENTREGAS_DETALLE"."NEXTVAL", 
	"ID_ENTREGA" NUMBER, 
	"ID_MATERIAL" NUMBER, 
	"PESO_KG" NUMBER(10,2), 
	"PUNTOS_GENERADOS" NUMBER
   )  DEFAULT COLLATION "USING_NLS_COMP" SEGMENT CREATION DEFERRED 
  PCTFREE 10 PCTUSED 40 INITRANS 10 MAXTRANS 255 
 NOCOMPRESS LOGGING
  TABLESPACE "DATA" ;
--------------------------------------------------------
--  DDL for Table ENTREGAS_RECICLAJE
--------------------------------------------------------

  CREATE TABLE "ECOPUNTOS_USER"."ENTREGAS_RECICLAJE" 
   (	"ID_ENTREGA" NUMBER DEFAULT "ECOPUNTOS_USER"."SEQ_ENTREGAS"."NEXTVAL", 
	"ID_USUARIO" NUMBER, 
	"ID_CENTRO" NUMBER, 
	"PUNTOS_TOTALES" NUMBER DEFAULT 0, 
	"FECHA_ENTREGA" DATE DEFAULT SYSDATE
   )  DEFAULT COLLATION "USING_NLS_COMP" SEGMENT CREATION DEFERRED 
  PCTFREE 10 PCTUSED 40 INITRANS 10 MAXTRANS 255 
 NOCOMPRESS LOGGING
  TABLESPACE "DATA" ;
--------------------------------------------------------
--  DDL for Table MATERIALES
--------------------------------------------------------

  CREATE TABLE "ECOPUNTOS_USER"."MATERIALES" 
   (	"ID_MATERIAL" NUMBER DEFAULT "ECOPUNTOS_USER"."SEQ_MATERIALES"."NEXTVAL", 
	"NOMBRE_MATERIAL" VARCHAR2(100 BYTE) COLLATE "USING_NLS_COMP", 
	"ESTADO" VARCHAR2(10 BYTE) COLLATE "USING_NLS_COMP" DEFAULT 'ACTIVO', 
	"KILOGRAMOS_RECICLAR" NUMBER(10,2), 
	"TIPO_MATERIAL" VARCHAR2(100 BYTE) COLLATE "USING_NLS_COMP"
   )  DEFAULT COLLATION "USING_NLS_COMP" SEGMENT CREATION IMMEDIATE 
  PCTFREE 10 PCTUSED 40 INITRANS 10 MAXTRANS 255 
 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
  BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "DATA" ;
--------------------------------------------------------
--  DDL for Table RECOMPENSAS
--------------------------------------------------------

  CREATE TABLE "ECOPUNTOS_USER"."RECOMPENSAS" 
   (	"ID_RECOMPENSA" NUMBER DEFAULT "ECOPUNTOS_USER"."SEQ_RECOMPENSAS"."NEXTVAL", 
	"ID_COMERCIO" NUMBER, 
	"TITULO" VARCHAR2(150 BYTE) COLLATE "USING_NLS_COMP", 
	"DESCRIPCION" VARCHAR2(500 BYTE) COLLATE "USING_NLS_COMP", 
	"PUNTOS_REQUERIDOS" NUMBER, 
	"CANTIDAD_SOLICITAR" NUMBER, 
	"ESTADO" VARCHAR2(10 BYTE) COLLATE "USING_NLS_COMP" DEFAULT 'ACTIVO'
   )  DEFAULT COLLATION "USING_NLS_COMP" SEGMENT CREATION IMMEDIATE 
  PCTFREE 10 PCTUSED 40 INITRANS 10 MAXTRANS 255 
 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
  BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "DATA" ;
--------------------------------------------------------
--  DDL for Table USUARIOS
--------------------------------------------------------

  CREATE TABLE "ECOPUNTOS_USER"."USUARIOS" 
   (	"ID_USUARIO" NUMBER DEFAULT "ECOPUNTOS_USER"."SEQ_USUARIOS"."NEXTVAL", 
	"NOMBRE" VARCHAR2(100 BYTE) COLLATE "USING_NLS_COMP", 
	"PRIMER_APELLIDO" VARCHAR2(100 BYTE) COLLATE "USING_NLS_COMP", 
	"SEGUNDO_APELLIDO" VARCHAR2(100 BYTE) COLLATE "USING_NLS_COMP", 
	"CORREO" VARCHAR2(150 BYTE) COLLATE "USING_NLS_COMP", 
	"CLAVE" VARCHAR2(256 BYTE) COLLATE "USING_NLS_COMP", 
	"TELEFONO" VARCHAR2(20 BYTE) COLLATE "USING_NLS_COMP", 
	"ESTADO" VARCHAR2(10 BYTE) COLLATE "USING_NLS_COMP" DEFAULT 'ACTIVO', 
	"FECHA_REGISTRO" DATE DEFAULT SYSDATE
   )  DEFAULT COLLATION "USING_NLS_COMP" SEGMENT CREATION IMMEDIATE 
  PCTFREE 10 PCTUSED 40 INITRANS 10 MAXTRANS 255 
 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
  BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "DATA" ;
--------------------------------------------------------
--  DDL for View VW_CATALOGO_RECOMPENSAS_ACTIVAS
--------------------------------------------------------

  CREATE OR REPLACE FORCE EDITIONABLE VIEW "ECOPUNTOS_USER"."VW_CATALOGO_RECOMPENSAS_ACTIVAS" ("ID_RECOMPENSA", "ID_COMERCIO", "NOMBRE_COMERCIO", "TITULO", "DESCRIPCION", "PUNTOS_REQUERIDOS", "STOCK_DISPONIBLE") DEFAULT COLLATION "USING_NLS_COMP"  AS 
  SELECT 
    r.id_recompensa,
    c.id_comercio,
    c.nombre_comercio,
    r.titulo,
    r.descripcion,
    r.puntos_requeridos,
    r.stock_disponible
FROM RECOMPENSAS r
JOIN COMERCIOS c ON r.id_comercio = c.id_comercio
WHERE r.estado = 'ACTIVO' AND r.stock_disponible > 0
;
--------------------------------------------------------
--  DDL for View VW_ESTADISTICAS_CENTROS_ACOPIO
--------------------------------------------------------

  CREATE OR REPLACE FORCE EDITIONABLE VIEW "ECOPUNTOS_USER"."VW_ESTADISTICAS_CENTROS_ACOPIO" ("ID_CENTRO", "NOMBRE_CENTRO", "PROVINCIA", "TOTAL_VISITAS", "TOTAL_KG_RECOLECTADOS", "TOTAL_PUNTOS_OTORGADOS") DEFAULT COLLATION "USING_NLS_COMP"  AS 
  SELECT 
    ca.id_centro,
    ca.nombre_centro,
    ca.provincia,
    COUNT(DISTINCT er.id_entrega) AS total_visitas,
    NVL(SUM(ed.peso_kg), 0) AS total_kg_recolectados,
    NVL(SUM(er.puntos_totales), 0) AS total_puntos_otorgados
FROM CENTROS_ACOPIO ca
LEFT JOIN ENTREGAS_RECICLAJE er ON ca.id_centro = er.id_centro
LEFT JOIN ENTREGAS_DETALLE ed ON er.id_entrega = ed.id_entrega
GROUP BY ca.id_centro, ca.nombre_centro, ca.provincia
;
--------------------------------------------------------
--  DDL for View VW_RESUMEN_CIUDADANOS
--------------------------------------------------------

  CREATE OR REPLACE FORCE EDITIONABLE VIEW "ECOPUNTOS_USER"."VW_RESUMEN_CIUDADANOS" ("ID_USUARIO", "NOMBRE_COMPLETO", "CORREO", "SALDO_PUNTOS", "TOTAL_KG_RECICLADOS", "RANGO_USUARIO") DEFAULT COLLATION "USING_NLS_COMP"  AS 
  SELECT 
    u.id_usuario,
    u.nombre || ' ' || u.primer_apellido || ' ' || NVL(u.segundo_apellido, '') AS nombre_completo,
    u.correo,
    u.saldo_puntos,
    NVL(SUM(ed.peso_kg), 0) AS total_kg_reciclados,
    CASE 
        WHEN NVL(SUM(ed.peso_kg), 0) >= 100 THEN 'CAMPEON VERDE'
        WHEN NVL(SUM(ed.peso_kg), 0) >= 30  THEN 'ECO-AMIGO'
        ELSE 'PRINCIPIANTE'
    END AS rango_usuario
FROM USUARIOS u
LEFT JOIN ENTREGAS_RECICLAJE er ON u.id_usuario = er.id_usuario
LEFT JOIN ENTREGAS_DETALLE ed ON er.id_entrega = ed.id_entrega
WHERE u.rol = 'CIUDADANO'
GROUP BY u.id_usuario, u.nombre, u.primer_apellido, u.segundo_apellido, u.correo, u.saldo_puntos
;
REM INSERTING into ECOPUNTOS_USER.CENTROS_ACOPIO
SET DEFINE OFF;
Insert into ECOPUNTOS_USER.CENTROS_ACOPIO (ID_CENTRO,NOMBRE_CENTRO,PROVINCIA,CANTON,DIRECCION_EXACTA,ESTADO) values (1,'Centro de Acopio Municipal Puriscal','San Jose','Puriscal','Contiguo al plantel municipal','ACTIVO');
REM INSERTING into ECOPUNTOS_USER.COMERCIOS
SET DEFINE OFF;
Insert into ECOPUNTOS_USER.COMERCIOS (ID_COMERCIO,ID_USUARIO,NOMBRE_COMERCIO,CEDULA_JURIDICA,TELEFONO,CORREO_CONTACTO) values (21,1,'Comercio San Juan.','3-101-123456','2222-3333','contacto@comercio.com');
Insert into ECOPUNTOS_USER.COMERCIOS (ID_COMERCIO,ID_USUARIO,NOMBRE_COMERCIO,CEDULA_JURIDICA,TELEFONO,CORREO_CONTACTO) values (1,2,'Cafe Santiago Puriscal','3-101-555888','24160000','contacto@cafesantiago.cr');
REM INSERTING into ECOPUNTOS_USER.CUPONES_EMITIDOS
SET DEFINE OFF;
REM INSERTING into ECOPUNTOS_USER.DBTOOLS$MCP_LOG
SET DEFINE OFF;
Insert into ECOPUNTOS_USER.DBTOOLS$MCP_LOG (ID,MCP_CLIENT,MODEL,END_POINT_TYPE,END_POINT_NAME,CREATED_ON,CREATED_BY,UPDATED_ON,UPDATED_BY) values (1,'Visual Studio Code','MAI-Code-1-Flash','tool','connect',to_timestamp('10-AUG-26 11.03.32.933833000 AM','DD-MON-RR HH.MI.SSXFF AM'),'ECOPUNTOS_USER',to_timestamp('10-AUG-26 11.03.32.933833000 AM','DD-MON-RR HH.MI.SSXFF AM'),'ECOPUNTOS_USER');
Insert into ECOPUNTOS_USER.DBTOOLS$MCP_LOG (ID,MCP_CLIENT,MODEL,END_POINT_TYPE,END_POINT_NAME,CREATED_ON,CREATED_BY,UPDATED_ON,UPDATED_BY) values (2,'Visual Studio Code','MAI-Code-1-Flash','tool','schema_information',to_timestamp('10-AUG-26 11.03.38.839020000 AM','DD-MON-RR HH.MI.SSXFF AM'),'ECOPUNTOS_USER',to_timestamp('10-AUG-26 11.03.38.839020000 AM','DD-MON-RR HH.MI.SSXFF AM'),'ECOPUNTOS_USER');
Insert into ECOPUNTOS_USER.DBTOOLS$MCP_LOG (ID,MCP_CLIENT,MODEL,END_POINT_TYPE,END_POINT_NAME,CREATED_ON,CREATED_BY,UPDATED_ON,UPDATED_BY) values (3,'Visual Studio Code','MAI-Code-1-Flash','tool','sql_run',to_timestamp('10-AUG-26 11.32.52.664993000 AM','DD-MON-RR HH.MI.SSXFF AM'),'ECOPUNTOS_USER',to_timestamp('10-AUG-26 11.32.52.664993000 AM','DD-MON-RR HH.MI.SSXFF AM'),'ECOPUNTOS_USER');
Insert into ECOPUNTOS_USER.DBTOOLS$MCP_LOG (ID,MCP_CLIENT,MODEL,END_POINT_TYPE,END_POINT_NAME,CREATED_ON,CREATED_BY,UPDATED_ON,UPDATED_BY) values (4,'Visual Studio Code','MAI-Code-1-Flash','tool','sql_run',to_timestamp('10-AUG-26 11.32.57.430855000 AM','DD-MON-RR HH.MI.SSXFF AM'),'ECOPUNTOS_USER',to_timestamp('10-AUG-26 11.32.57.430855000 AM','DD-MON-RR HH.MI.SSXFF AM'),'ECOPUNTOS_USER');
Insert into ECOPUNTOS_USER.DBTOOLS$MCP_LOG (ID,MCP_CLIENT,MODEL,END_POINT_TYPE,END_POINT_NAME,CREATED_ON,CREATED_BY,UPDATED_ON,UPDATED_BY) values (5,'Visual Studio Code','MAI-Code-1-Flash','tool','sql_run',to_timestamp('10-AUG-26 11.33.09.757678000 AM','DD-MON-RR HH.MI.SSXFF AM'),'ECOPUNTOS_USER',to_timestamp('10-AUG-26 11.33.09.757678000 AM','DD-MON-RR HH.MI.SSXFF AM'),'ECOPUNTOS_USER');
Insert into ECOPUNTOS_USER.DBTOOLS$MCP_LOG (ID,MCP_CLIENT,MODEL,END_POINT_TYPE,END_POINT_NAME,CREATED_ON,CREATED_BY,UPDATED_ON,UPDATED_BY) values (21,'Visual Studio Code','MAI-Code-1-Flash','tool','connect',to_timestamp('10-AUG-26 04.45.57.007350000 PM','DD-MON-RR HH.MI.SSXFF AM'),'ECOPUNTOS_USER',to_timestamp('10-AUG-26 04.45.57.007350000 PM','DD-MON-RR HH.MI.SSXFF AM'),'ECOPUNTOS_USER');
Insert into ECOPUNTOS_USER.DBTOOLS$MCP_LOG (ID,MCP_CLIENT,MODEL,END_POINT_TYPE,END_POINT_NAME,CREATED_ON,CREATED_BY,UPDATED_ON,UPDATED_BY) values (22,'Visual Studio Code','MAI-Code-1-Flash','tool','sql_run',to_timestamp('10-AUG-26 04.46.12.058261000 PM','DD-MON-RR HH.MI.SSXFF AM'),'ECOPUNTOS_USER',to_timestamp('10-AUG-26 04.46.12.058261000 PM','DD-MON-RR HH.MI.SSXFF AM'),'ECOPUNTOS_USER');
Insert into ECOPUNTOS_USER.DBTOOLS$MCP_LOG (ID,MCP_CLIENT,MODEL,END_POINT_TYPE,END_POINT_NAME,CREATED_ON,CREATED_BY,UPDATED_ON,UPDATED_BY) values (23,'Visual Studio Code','MAI-Code-1-Flash','tool','sql_run',to_timestamp('10-AUG-26 04.46.23.375496000 PM','DD-MON-RR HH.MI.SSXFF AM'),'ECOPUNTOS_USER',to_timestamp('10-AUG-26 04.46.23.375496000 PM','DD-MON-RR HH.MI.SSXFF AM'),'ECOPUNTOS_USER');
REM INSERTING into ECOPUNTOS_USER.ENTREGAS_DETALLE
SET DEFINE OFF;
REM INSERTING into ECOPUNTOS_USER.ENTREGAS_RECICLAJE
SET DEFINE OFF;
REM INSERTING into ECOPUNTOS_USER.MATERIALES
SET DEFINE OFF;
Insert into ECOPUNTOS_USER.MATERIALES (ID_MATERIAL,NOMBRE_MATERIAL,ESTADO,KILOGRAMOS_RECICLAR,TIPO_MATERIAL) values (22,'latas','ACTIVO',0.24,'metal');
Insert into ECOPUNTOS_USER.MATERIALES (ID_MATERIAL,NOMBRE_MATERIAL,ESTADO,KILOGRAMOS_RECICLAR,TIPO_MATERIAL) values (21,'papel','ACTIVO',0.51,'suave');
Insert into ECOPUNTOS_USER.MATERIALES (ID_MATERIAL,NOMBRE_MATERIAL,ESTADO,KILOGRAMOS_RECICLAR,TIPO_MATERIAL) values (1,'Plastico PET','ACTIVO',null,null);
Insert into ECOPUNTOS_USER.MATERIALES (ID_MATERIAL,NOMBRE_MATERIAL,ESTADO,KILOGRAMOS_RECICLAR,TIPO_MATERIAL) values (2,'Vidrio','ACTIVO',null,null);
Insert into ECOPUNTOS_USER.MATERIALES (ID_MATERIAL,NOMBRE_MATERIAL,ESTADO,KILOGRAMOS_RECICLAR,TIPO_MATERIAL) values (3,'Carton y Papel','ACTIVO',null,null);
REM INSERTING into ECOPUNTOS_USER.RECOMPENSAS
SET DEFINE OFF;
Insert into ECOPUNTOS_USER.RECOMPENSAS (ID_RECOMPENSA,ID_COMERCIO,TITULO,DESCRIPCION,PUNTOS_REQUERIDOS,CANTIDAD_SOLICITAR,ESTADO) values (1,1,'Cafe Expreso Gratis','Canjea 100 EcoPuntos por un cafe expreso caliente.',100,20,'ACTIVO');
REM INSERTING into ECOPUNTOS_USER.USUARIOS
SET DEFINE OFF;
Insert into ECOPUNTOS_USER.USUARIOS (ID_USUARIO,NOMBRE,PRIMER_APELLIDO,SEGUNDO_APELLIDO,CORREO,CLAVE,TELEFONO,ESTADO,FECHA_REGISTRO) values (23,'bruno','Salas',null,'brunolas0602@gmail.com','vgfbhtr65','64727963','ACTIVO',to_date('10-AUG-26','DD-MON-RR'));
Insert into ECOPUNTOS_USER.USUARIOS (ID_USUARIO,NOMBRE,PRIMER_APELLIDO,SEGUNDO_APELLIDO,CORREO,CLAVE,TELEFONO,ESTADO,FECHA_REGISTRO) values (25,'samuel','szaenz',null,'saenx@gmail.com','gret5645whrst','35286389','ACTIVO',to_date('10-AUG-26','DD-MON-RR'));
Insert into ECOPUNTOS_USER.USUARIOS (ID_USUARIO,NOMBRE,PRIMER_APELLIDO,SEGUNDO_APELLIDO,CORREO,CLAVE,TELEFONO,ESTADO,FECHA_REGISTRO) values (1,'Maria','Montero',null,'maria@gmail.com','123456',null,'ACTIVO',to_date('08-AUG-26','DD-MON-RR'));
Insert into ECOPUNTOS_USER.USUARIOS (ID_USUARIO,NOMBRE,PRIMER_APELLIDO,SEGUNDO_APELLIDO,CORREO,CLAVE,TELEFONO,ESTADO,FECHA_REGISTRO) values (2,'Juan','Perez',null,'juan@comercio.com','123456',null,'ACTIVO',to_date('08-AUG-26','DD-MON-RR'));
Insert into ECOPUNTOS_USER.USUARIOS (ID_USUARIO,NOMBRE,PRIMER_APELLIDO,SEGUNDO_APELLIDO,CORREO,CLAVE,TELEFONO,ESTADO,FECHA_REGISTRO) values (3,'Admin','Sistema',null,'admin@ecopuntos.cr','admin123',null,'ACTIVO',to_date('08-AUG-26','DD-MON-RR'));
Insert into ECOPUNTOS_USER.USUARIOS (ID_USUARIO,NOMBRE,PRIMER_APELLIDO,SEGUNDO_APELLIDO,CORREO,CLAVE,TELEFONO,ESTADO,FECHA_REGISTRO) values (21,'Sofia','Vargas Salas',null,'svargassalas0602@gmail.com','234567890''','88362556','ACTIVO',to_date('10-AUG-26','DD-MON-RR'));
--------------------------------------------------------
--  DDL for Procedure SP_AUTENTICAR_USUARIO
--------------------------------------------------------
set define off;

  CREATE OR REPLACE EDITIONABLE PROCEDURE "ECOPUNTOS_USER"."SP_AUTENTICAR_USUARIO" (
    p_correo     IN  VARCHAR2,
    p_clave      IN  VARCHAR2,
    o_id_usuario OUT NUMBER,
    o_rol        OUT VARCHAR2,
    o_estado     OUT VARCHAR2,
    o_mensaje    OUT VARCHAR2
) AS
BEGIN
    PKG_AUTENTICACION_USUARIOS.PR_AUTENTICAR_USUARIO(
        p_correo     => p_correo,
        p_clave      => p_clave,
        o_id_usuario => o_id_usuario,
        o_rol        => o_rol,
        o_estado     => o_estado,
        o_mensaje    => o_mensaje
    );
END SP_AUTENTICAR_USUARIO;

/
--------------------------------------------------------
--  DDL for Procedure SP_CANJEAR_RECOMPENSA
--------------------------------------------------------
set define off;

  CREATE OR REPLACE EDITIONABLE PROCEDURE "ECOPUNTOS_USER"."SP_CANJEAR_RECOMPENSA" (
    p_id_usuario    IN  NUMBER,
    p_id_recompensa IN  NUMBER,
    o_codigo_cupon  OUT VARCHAR2,
    o_mensaje       OUT VARCHAR2
) AS
BEGIN
    PKG_CANJES_Y_RECOMPENSAS.PR_CANJEAR_RECOMPENSA(
        p_id_usuario    => p_id_usuario,
        p_id_recompensa => p_id_recompensa,
        o_codigo_cupon  => o_codigo_cupon,
        o_mensaje       => o_mensaje
    );
END SP_CANJEAR_RECOMPENSA;

/
--------------------------------------------------------
--  DDL for Procedure SP_INICIAR_SESION_USUARIO
--------------------------------------------------------
set define off;

  CREATE OR REPLACE EDITIONABLE PROCEDURE "ECOPUNTOS_USER"."SP_INICIAR_SESION_USUARIO" (
    p_correo      IN VARCHAR2,
    p_clave       IN VARCHAR2,
    p_resultado   OUT SYS_REFCURSOR
)
AS
BEGIN

    OPEN p_resultado FOR

        SELECT
            ID_USUARIO,
            NOMBRE,
            PRIMER_APELLIDO,
            SEGUNDO_APELLIDO,
            CORREO,
            TELEFONO,
            ESTADO,
            FECHA_REGISTRO
        FROM USUARIOS
        WHERE LOWER(CORREO) = LOWER(p_correo)
          AND CLAVE = p_clave;

END SP_INICIAR_SESION_USUARIO;

/
--------------------------------------------------------
--  DDL for Procedure SP_OBTENER_RESUMEN_USUARIO
--------------------------------------------------------
set define off;

  CREATE OR REPLACE EDITIONABLE PROCEDURE "ECOPUNTOS_USER"."SP_OBTENER_RESUMEN_USUARIO" (
    p_id_usuario     IN  NUMBER,
    o_puntos_totales OUT NUMBER,
    o_cupones_activos OUT NUMBER,
    o_mensaje        OUT VARCHAR2
) AS
BEGIN
 
    SELECT NVL(SUM(PUNTOS_TOTALES), 0)
    INTO o_puntos_totales
    FROM ENTREGAS_RECICLAJE
    WHERE ID_USUARIO = p_id_usuario;

   
    SELECT COUNT(*)
    INTO o_cupones_activos
    FROM CUPONES_EMITIDOS
    WHERE ID_USUARIO = p_id_usuario 
      AND ESTADO = 'ACTIVO' 
      AND FECHA_EXPIRACION >= SYSDATE;

    o_mensaje := 'Resumen obtenido exitosamente.';
EXCEPTION
    WHEN OTHERS THEN
        o_puntos_totales := 0;
        o_cupones_activos := 0;
        o_mensaje := 'Error al obtener resumen: ' || SQLERRM;
END SP_OBTENER_RESUMEN_USUARIO;

/
--------------------------------------------------------
--  DDL for Procedure SP_REDIMIR_CUPON_COMERCIO
--------------------------------------------------------
set define off;

  CREATE OR REPLACE EDITIONABLE PROCEDURE "ECOPUNTOS_USER"."SP_REDIMIR_CUPON_COMERCIO" (
    p_codigo_cupon IN  VARCHAR2,
    p_id_comercio  IN  NUMBER,
    o_mensaje      OUT VARCHAR2
) AS
BEGIN
    PKG_CANJES_Y_RECOMPENSAS.PR_REDIMIR_CUPON_COMERCIO(
        p_codigo_cupon => p_codigo_cupon,
        p_id_comercio  => p_id_comercio,
        o_mensaje      => o_mensaje
    );
END SP_REDIMIR_CUPON_COMERCIO;

/
--------------------------------------------------------
--  DDL for Procedure SP_REGISTRAR_ENTREGA
--------------------------------------------------------
set define off;

  CREATE OR REPLACE EDITIONABLE PROCEDURE "ECOPUNTOS_USER"."SP_REGISTRAR_ENTREGA" (
    p_id_usuario  IN NUMBER,
    p_id_centro   IN NUMBER,
    p_id_material IN NUMBER,
    p_peso_kg     IN NUMBER,
    o_puntos      OUT NUMBER,
    o_mensaje     OUT VARCHAR2
) AS
BEGIN
    PKG_GESTION_RECICLAJE.PR_REGISTRAR_ENTREGA(
        p_id_usuario  => p_id_usuario,
        p_id_centro   => p_id_centro,
        p_id_material => p_id_material,
        p_peso_kg     => p_peso_kg,
        o_puntos      => o_puntos,
        o_mensaje     => o_mensaje
    );
END SP_REGISTRAR_ENTREGA;

/
--------------------------------------------------------
--  DDL for Procedure SP_REGISTRAR_MATERIAL
--------------------------------------------------------
set define off;

  CREATE OR REPLACE EDITIONABLE PROCEDURE "ECOPUNTOS_USER"."SP_REGISTRAR_MATERIAL" (
    p_nombre_material      IN VARCHAR2,
    p_kilogramos_reciclar  IN NUMBER,
    p_tipo_material        IN VARCHAR2,
    o_codigo_respuesta     OUT NUMBER,
    o_mensaje_respuesta    OUT VARCHAR2
)
AS
BEGIN

    INSERT INTO MATERIALES (
        NOMBRE_MATERIAL,
        KILOGRAMOS_RECICLAR,
        TIPO_MATERIAL
    )
    VALUES (
        p_nombre_material,
        p_kilogramos_reciclar,
        p_tipo_material
    );

    COMMIT;

    o_codigo_respuesta := 1;
    o_mensaje_respuesta := 'Material registrado exitosamente.';

EXCEPTION

    WHEN DUP_VAL_ON_INDEX THEN
        ROLLBACK;

        o_codigo_respuesta := 0;
        o_mensaje_respuesta :=
            'El material ya se encuentra registrado.';

    WHEN OTHERS THEN
        ROLLBACK;

        o_codigo_respuesta := 0;
        o_mensaje_respuesta :=
            'Error inesperado al registrar el material: '
            || SQLERRM;

END SP_REGISTRAR_MATERIAL;

/
--------------------------------------------------------
--  DDL for Procedure SP_REGISTRAR_RECOMPENSA
--------------------------------------------------------
set define off;

  CREATE OR REPLACE EDITIONABLE PROCEDURE "ECOPUNTOS_USER"."SP_REGISTRAR_RECOMPENSA" (
    p_nombre_comercio       IN VARCHAR2,
    p_titulo_recompensa     IN VARCHAR2,
    p_descripcion           IN VARCHAR2,
    p_puntos_requeridos     IN NUMBER,
    p_cantidad_solicitar    IN NUMBER,
    o_codigo_respuesta      OUT NUMBER,
    o_mensaje_respuesta     OUT VARCHAR2
)
AS
    v_id_comercio COMERCIOS.ID_COMERCIO%TYPE;
BEGIN
    SELECT ID_COMERCIO
    INTO v_id_comercio
    FROM COMERCIOS
    WHERE UPPER(NOMBRE_COMERCIO) = UPPER(p_nombre_comercio);

    INSERT INTO RECOMPENSAS (
        ID_COMERCIO,
        TITULO,
        DESCRIPCION,
        PUNTOS_REQUERIDOS,
        CANTIDAD_SOLICITAR
    )
    VALUES (
        v_id_comercio,
        p_titulo_recompensa,
        p_descripcion,
        p_puntos_requeridos,
        p_cantidad_solicitar
    );

    COMMIT;

    o_codigo_respuesta := 1;
    o_mensaje_respuesta := 'Recompensa solicitada exitosamente.';

EXCEPTION
    WHEN NO_DATA_FOUND THEN
        ROLLBACK;
        o_codigo_respuesta := 0;
        o_mensaje_respuesta := 'El comercio ingresado no se encuentra registrado.';

    WHEN DUP_VAL_ON_INDEX THEN
        ROLLBACK;
        o_codigo_respuesta := 0;
        o_mensaje_respuesta := 'La recompensa ya se encuentra registrada.';

    WHEN OTHERS THEN
        ROLLBACK;
        o_codigo_respuesta := 0;
        o_mensaje_respuesta := 'Error al solicitar la recompensa: ' || SQLERRM;
END SP_REGISTRAR_RECOMPENSA;

/
--------------------------------------------------------
--  DDL for Procedure SP_REGISTRAR_USUARIO
--------------------------------------------------------
set define off;

  CREATE OR REPLACE EDITIONABLE PROCEDURE "ECOPUNTOS_USER"."SP_REGISTRAR_USUARIO" (
    p_nombre             IN VARCHAR2,
    p_primer_apellido    IN VARCHAR2,
    p_segundo_apellido   IN VARCHAR2,
    p_correo             IN VARCHAR2,
    p_clave              IN VARCHAR2,
    p_telefono           IN VARCHAR2,
    o_codigo_respuesta   OUT NUMBER,  
    o_mensaje_respuesta  OUT VARCHAR2  
) 
AS
BEGIN
    
    INSERT INTO USUARIOS (
        NOMBRE,
        PRIMER_APELLIDO,
        SEGUNDO_APELLIDO,
        CORREO,
        CLAVE,
        TELEFONO
    ) VALUES (
        p_nombre,
        p_primer_apellido,
        p_segundo_apellido,
        p_correo,
        p_clave,
        p_telefono
    );

    
    COMMIT;

    
    o_codigo_respuesta := 1;
    o_mensaje_respuesta := 'Usuario registrado exitosamente.';

EXCEPTION
    
    WHEN DUP_VAL_ON_INDEX THEN
        ROLLBACK;
        o_codigo_respuesta := 0;
        o_mensaje_respuesta := 'El correo electrónico ingresado ya se encuentra registrado.';

  
    WHEN OTHERS THEN
        ROLLBACK;
        o_codigo_respuesta := 0;
        o_mensaje_respuesta := 'Error inesperado al registrar el usuario: ' || SQLERRM;

END SP_REGISTRAR_USUARIO;

/
--------------------------------------------------------
--  DDL for Package PKG_AUTENTICACION_USUARIOS
--------------------------------------------------------

  CREATE OR REPLACE EDITIONABLE PACKAGE "ECOPUNTOS_USER"."PKG_AUTENTICACION_USUARIOS" AS
    FUNCTION FN_ES_USUARIO_ACTIVO(p_id_usuario IN NUMBER) RETURN NUMBER;

    PROCEDURE PR_AUTENTICAR_USUARIO(
        p_correo     IN  VARCHAR2,
        p_clave      IN  VARCHAR2,
        o_id_usuario OUT NUMBER,
        o_rol        OUT VARCHAR2,
        o_estado     OUT VARCHAR2,
        o_mensaje    OUT VARCHAR2
    );
END PKG_AUTENTICACION_USUARIOS;

/
--------------------------------------------------------
--  DDL for Package PKG_CANJES_Y_RECOMPENSAS
--------------------------------------------------------

  CREATE OR REPLACE EDITIONABLE PACKAGE "ECOPUNTOS_USER"."PKG_CANJES_Y_RECOMPENSAS" AS
    FUNCTION FN_VALIDAR_CUPON_DISPONIBLE(p_id_recompensa IN NUMBER, p_id_usuario IN NUMBER) RETURN NUMBER;
    FUNCTION FN_VERIFICAR_CODIGO_CANJE(p_codigo_cupon IN VARCHAR2) RETURN NUMBER;

    PROCEDURE PR_CANJEAR_RECOMPENSA(
        p_id_usuario    IN  NUMBER,
        p_id_recompensa IN  NUMBER,
        o_codigo_cupon  OUT VARCHAR2,
        o_mensaje       OUT VARCHAR2
    );

    PROCEDURE PR_REDIMIR_CUPON_COMERCIO(
        p_codigo_cupon IN  VARCHAR2,
        p_id_comercio  IN  NUMBER,
        o_mensaje      OUT VARCHAR2
    );
END PKG_CANJES_Y_RECOMPENSAS;

/
--------------------------------------------------------
--  DDL for Package PKG_GESTION_RECICLAJE
--------------------------------------------------------

  CREATE OR REPLACE EDITIONABLE PACKAGE "ECOPUNTOS_USER"."PKG_GESTION_RECICLAJE" AS
    FUNCTION FN_CALCULAR_ECOPUNTOS(p_id_material IN NUMBER, p_peso_kg IN NUMBER) RETURN NUMBER;
    FUNCTION FN_OBTENER_SALDO_PUNTOS(p_id_usuario IN NUMBER) RETURN NUMBER;
    FUNCTION FN_NIVEL_USUARIO(p_id_usuario IN NUMBER) RETURN VARCHAR2;
    FUNCTION FN_EQUIVALENCIA_CO2_AHORRADO(p_total_kg IN NUMBER) RETURN NUMBER;

    PROCEDURE PR_REGISTRAR_ENTREGA(
        p_id_usuario  IN NUMBER,
        p_id_centro   IN NUMBER,
        p_id_material IN NUMBER,
        p_peso_kg     IN NUMBER,
        o_puntos      OUT NUMBER,
        o_mensaje     OUT VARCHAR2
    );
END PKG_GESTION_RECICLAJE;

/
--------------------------------------------------------
--  DDL for Package Body PKG_AUTENTICACION_USUARIOS
--------------------------------------------------------

  CREATE OR REPLACE EDITIONABLE PACKAGE BODY "ECOPUNTOS_USER"."PKG_AUTENTICACION_USUARIOS" AS

    FUNCTION FN_ES_USUARIO_ACTIVO(p_id_usuario IN NUMBER) RETURN NUMBER IS
        v_estado VARCHAR2(10);
    BEGIN
        SELECT estado INTO v_estado FROM USUARIOS WHERE id_usuario = p_id_usuario;
        IF v_estado = 'ACTIVO' THEN
            RETURN 1;
        ELSE
            RETURN 0;
        END IF;
    EXCEPTION
        WHEN NO_DATA_FOUND THEN
            RETURN 0;
    END FN_ES_USUARIO_ACTIVO;

    PROCEDURE PR_AUTENTICAR_USUARIO(
        p_correo     IN  VARCHAR2,
        p_clave      IN  VARCHAR2,
        o_id_usuario OUT NUMBER,
        o_rol        OUT VARCHAR2,
        o_estado     OUT VARCHAR2,
        o_mensaje    OUT VARCHAR2
    ) IS
    BEGIN
        SELECT id_usuario, rol, estado 
        INTO o_id_usuario, o_rol, o_estado
        FROM USUARIOS
        WHERE UPPER(correo) = UPPER(p_correo) AND clave = p_clave;

        IF o_estado <> 'ACTIVO' THEN
            o_mensaje := 'ERROR: La cuenta se encuentra inactiva o bloqueada.';
        ELSE
            o_mensaje := 'OK: Autenticacion exitosa.';
        END IF;
    EXCEPTION
        WHEN NO_DATA_FOUND THEN
            o_id_usuario := NULL;
            o_rol := NULL;
            o_estado := NULL;
            o_mensaje := 'ERROR: Credenciales invalidas.';
    END PR_AUTENTICAR_USUARIO;

END PKG_AUTENTICACION_USUARIOS;

/
--------------------------------------------------------
--  DDL for Package Body PKG_CANJES_Y_RECOMPENSAS
--------------------------------------------------------

  CREATE OR REPLACE EDITIONABLE PACKAGE BODY "ECOPUNTOS_USER"."PKG_CANJES_Y_RECOMPENSAS" AS

    FUNCTION FN_VALIDAR_CUPON_DISPONIBLE(p_id_recompensa IN NUMBER, p_id_usuario IN NUMBER) RETURN NUMBER IS
        v_puntos_req NUMBER;
        v_stock      NUMBER;
        v_saldo_usr  NUMBER;
    BEGIN
        SELECT puntos_requeridos, stock_disponible INTO v_puntos_req, v_stock 
        FROM RECOMPENSAS WHERE id_recompensa = p_id_recompensa AND estado = 'ACTIVO';

        SELECT saldo_puntos INTO v_saldo_usr FROM USUARIOS WHERE id_usuario = p_id_usuario;

        IF v_stock > 0 AND v_saldo_usr >= v_puntos_req THEN
            RETURN 1;
        ELSE
            RETURN 0;
        END IF;
    EXCEPTION
        WHEN NO_DATA_FOUND THEN
            RETURN 0;
    END FN_VALIDAR_CUPON_DISPONIBLE;

    FUNCTION FN_VERIFICAR_CODIGO_CANJE(p_codigo_cupon IN VARCHAR2) RETURN NUMBER IS
        v_estado VARCHAR2(15);
    BEGIN
        SELECT estado INTO v_estado FROM CUPONES_EMITIDOS WHERE codigo_cupon = UPPER(p_codigo_cupon);
        IF v_estado = 'DISPONIBLE' THEN
            RETURN 1;
        ELSE
            RETURN 0;
        END IF;
    EXCEPTION
        WHEN NO_DATA_FOUND THEN
            RETURN -1;
    END FN_VERIFICAR_CODIGO_CANJE;

    PROCEDURE PR_CANJEAR_RECOMPENSA(
        p_id_usuario    IN  NUMBER,
        p_id_recompensa IN  NUMBER,
        o_codigo_cupon  OUT VARCHAR2,
        o_mensaje       OUT VARCHAR2
    ) IS
        v_puntos_req NUMBER;
        v_stock      NUMBER;
        v_saldo_usr  NUMBER;
    BEGIN
        SELECT puntos_requeridos, stock_disponible 
        INTO v_puntos_req, v_stock 
        FROM RECOMPENSAS WHERE id_recompensa = p_id_recompensa AND estado = 'ACTIVO';

        SELECT saldo_puntos INTO v_saldo_usr FROM USUARIOS WHERE id_usuario = p_id_usuario;

        IF v_stock <= 0 THEN
            o_mensaje := 'ERROR: La recompensa ya no tiene stock disponible.';
            RETURN;
        END IF;

        IF v_saldo_usr < v_puntos_req THEN
            o_mensaje := 'ERROR: Saldo de EcoPuntos insuficiente.';
            RETURN;
        END IF;

        o_codigo_cupon := 'ECO-' || DBMS_RANDOM.STRING('X', 6);

        UPDATE USUARIOS SET saldo_puntos = saldo_puntos - v_puntos_req WHERE id_usuario = p_id_usuario;
        UPDATE RECOMPENSAS SET stock_disponible = stock_disponible - 1 WHERE id_recompensa = p_id_recompensa;

        INSERT INTO CUPONES_EMITIDOS (codigo_cupon, id_usuario, id_recompensa, fecha_expiracion)
        VALUES (o_codigo_cupon, p_id_usuario, p_id_recompensa, SYSDATE + 30);

        COMMIT;
        o_mensaje := 'OK: Cupon generado exitosamente.';
    EXCEPTION
        WHEN OTHERS THEN
            ROLLBACK;
            o_codigo_cupon := NULL;
            o_mensaje := 'ERROR AL CANJEAR RECOMPENSA: ' || SQLERRM;
    END PR_CANJEAR_RECOMPENSA;

    PROCEDURE PR_REDIMIR_CUPON_COMERCIO(
        p_codigo_cupon IN  VARCHAR2,
        p_id_comercio  IN  NUMBER,
        o_mensaje      OUT VARCHAR2
    ) IS
        v_id_cupon  NUMBER;
        v_estado    VARCHAR2(15);
        v_comercio  NUMBER;
    BEGIN
        SELECT c.id_cupon, c.estado, r.id_comercio
        INTO v_id_cupon, v_estado, v_comercio
        FROM CUPONES_EMITIDOS c
        JOIN RECOMPENSAS r ON c.id_recompensa = r.id_recompensa
        WHERE UPPER(c.codigo_cupon) = UPPER(p_codigo_cupon);

        IF v_comercio <> p_id_comercio THEN
            o_mensaje := 'ERROR: Este cupon no pertenece a su comercio.';
            RETURN;
        END IF;

        IF v_estado = 'REDIMIDO' THEN
            o_mensaje := 'ERROR: El cupon ya fue utilizado previamente.';
            RETURN;
        ELSIF v_estado = 'EXPIRADO' THEN
            o_mensaje := 'ERROR: El cupon ha expirado.';
            RETURN;
        END IF;

        UPDATE CUPONES_EMITIDOS SET estado = 'REDIMIDO' WHERE id_cupon = v_id_cupon;

        COMMIT;
        o_mensaje := 'OK: Cupon validado y redimido exitosamente.';
    EXCEPTION
        WHEN NO_DATA_FOUND THEN
            o_mensaje := 'ERROR: Codigo de cupon invalido o no encontrado.';
        WHEN OTHERS THEN
            ROLLBACK;
            o_mensaje := 'ERROR AL REDIMIR CUPON: ' || SQLERRM;
    END PR_REDIMIR_CUPON_COMERCIO;

END PKG_CANJES_Y_RECOMPENSAS;

/
--------------------------------------------------------
--  DDL for Package Body PKG_GESTION_RECICLAJE
--------------------------------------------------------

  CREATE OR REPLACE EDITIONABLE PACKAGE BODY "ECOPUNTOS_USER"."PKG_GESTION_RECICLAJE" AS

    FUNCTION FN_CALCULAR_ECOPUNTOS(p_id_material IN NUMBER, p_peso_kg IN NUMBER) RETURN NUMBER IS
        v_puntos_kg NUMBER(10,2);
    BEGIN
        SELECT puntos_por_kg INTO v_puntos_kg FROM MATERIALES WHERE id_material = p_id_material;
        RETURN ROUND(v_puntos_kg * p_peso_kg);
    EXCEPTION
        WHEN NO_DATA_FOUND THEN
            RETURN 0;
    END FN_CALCULAR_ECOPUNTOS;

    FUNCTION FN_OBTENER_SALDO_PUNTOS(p_id_usuario IN NUMBER) RETURN NUMBER IS
        v_saldo NUMBER := 0;
    BEGIN
        SELECT saldo_puntos INTO v_saldo FROM USUARIOS WHERE id_usuario = p_id_usuario;
        RETURN v_saldo;
    EXCEPTION
        WHEN NO_DATA_FOUND THEN
            RETURN 0;
    END FN_OBTENER_SALDO_PUNTOS;

    FUNCTION FN_NIVEL_USUARIO(p_id_usuario IN NUMBER) RETURN VARCHAR2 IS
        v_rango VARCHAR2(30);
    BEGIN
        SELECT rango_usuario INTO v_rango FROM VW_RESUMEN_CIUDADANOS WHERE id_usuario = p_id_usuario;
        RETURN v_rango;
    EXCEPTION
        WHEN NO_DATA_FOUND THEN
            RETURN 'PRINCIPIANTE';
    END FN_NIVEL_USUARIO;

    FUNCTION FN_EQUIVALENCIA_CO2_AHORRADO(p_total_kg IN NUMBER) RETURN NUMBER IS
    BEGIN
        RETURN ROUND(p_total_kg * 0.5, 2);
    END FN_EQUIVALENCIA_CO2_AHORRADO;

    PROCEDURE PR_REGISTRAR_ENTREGA(
        p_id_usuario  IN NUMBER,
        p_id_centro   IN NUMBER,
        p_id_material IN NUMBER,
        p_peso_kg     IN NUMBER,
        o_puntos      OUT NUMBER,
        o_mensaje     OUT VARCHAR2
    ) IS
        v_id_entrega NUMBER;
    BEGIN
        o_puntos := FN_CALCULAR_ECOPUNTOS(p_id_material, p_peso_kg);

        IF o_puntos <= 0 THEN
            o_mensaje := 'ERROR: Material no valido o peso incorrecto.';
            RETURN;
        END IF;

        INSERT INTO ENTREGAS_RECICLAJE (id_usuario, id_centro, puntos_totales)
        VALUES (p_id_usuario, p_id_centro, o_puntos)
        RETURNING id_entrega INTO v_id_entrega;

        INSERT INTO ENTREGAS_DETALLE (id_entrega, id_material, peso_kg, puntos_generados)
        VALUES (v_id_entrega, p_id_material, p_peso_kg, o_puntos);

        UPDATE USUARIOS
        SET saldo_puntos = saldo_puntos + o_puntos
        WHERE id_usuario = p_id_usuario;

        COMMIT;
        o_mensaje := 'OK: Registro exitoso. Se han acreditado ' || o_puntos || ' EcoPuntos.';
    EXCEPTION
        WHEN OTHERS THEN
            ROLLBACK;
            o_puntos := 0;
            o_mensaje := 'ERROR AL REGISTRAR ENTREGA: ' || SQLERRM;
    END PR_REGISTRAR_ENTREGA;

END PKG_GESTION_RECICLAJE;

/
--------------------------------------------------------
--  Constraints for Table MATERIALES
--------------------------------------------------------

  ALTER TABLE "ECOPUNTOS_USER"."MATERIALES" MODIFY ("NOMBRE_MATERIAL" NOT NULL ENABLE);
  ALTER TABLE "ECOPUNTOS_USER"."MATERIALES" ADD CHECK (estado IN ('ACTIVO', 'INACTIVO')) ENABLE;
  ALTER TABLE "ECOPUNTOS_USER"."MATERIALES" ADD PRIMARY KEY ("ID_MATERIAL")
  USING INDEX PCTFREE 10 INITRANS 20 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
  BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "DATA"  ENABLE;
--------------------------------------------------------
--  Constraints for Table DBTOOLS$MCP_LOG
--------------------------------------------------------

  ALTER TABLE "ECOPUNTOS_USER"."DBTOOLS$MCP_LOG" MODIFY ("MCP_CLIENT" NOT NULL ENABLE);
  ALTER TABLE "ECOPUNTOS_USER"."DBTOOLS$MCP_LOG" MODIFY ("END_POINT_NAME" NOT NULL ENABLE);
  ALTER TABLE "ECOPUNTOS_USER"."DBTOOLS$MCP_LOG" MODIFY ("ID" NOT NULL ENABLE);
  ALTER TABLE "ECOPUNTOS_USER"."DBTOOLS$MCP_LOG" MODIFY ("CREATED_ON" NOT NULL ENABLE);
  ALTER TABLE "ECOPUNTOS_USER"."DBTOOLS$MCP_LOG" MODIFY ("CREATED_BY" NOT NULL ENABLE);
  ALTER TABLE "ECOPUNTOS_USER"."DBTOOLS$MCP_LOG" ADD CHECK (end_point_type in ('tool', 'prompt', 'resource', 'sample', 'root', 'transport')) ENABLE;
  ALTER TABLE "ECOPUNTOS_USER"."DBTOOLS$MCP_LOG" ADD PRIMARY KEY ("ID")
  USING INDEX PCTFREE 10 INITRANS 20 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
  BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "DATA"  ENABLE;
--------------------------------------------------------
--  Constraints for Table CENTROS_ACOPIO
--------------------------------------------------------

  ALTER TABLE "ECOPUNTOS_USER"."CENTROS_ACOPIO" MODIFY ("NOMBRE_CENTRO" NOT NULL ENABLE);
  ALTER TABLE "ECOPUNTOS_USER"."CENTROS_ACOPIO" MODIFY ("PROVINCIA" NOT NULL ENABLE);
  ALTER TABLE "ECOPUNTOS_USER"."CENTROS_ACOPIO" MODIFY ("CANTON" NOT NULL ENABLE);
  ALTER TABLE "ECOPUNTOS_USER"."CENTROS_ACOPIO" ADD CHECK (estado IN ('ACTIVO', 'INACTIVO')) ENABLE;
  ALTER TABLE "ECOPUNTOS_USER"."CENTROS_ACOPIO" ADD PRIMARY KEY ("ID_CENTRO")
  USING INDEX PCTFREE 10 INITRANS 20 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
  BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "DATA"  ENABLE;
--------------------------------------------------------
--  Constraints for Table USUARIOS
--------------------------------------------------------

  ALTER TABLE "ECOPUNTOS_USER"."USUARIOS" MODIFY ("NOMBRE" NOT NULL ENABLE);
  ALTER TABLE "ECOPUNTOS_USER"."USUARIOS" MODIFY ("PRIMER_APELLIDO" NOT NULL ENABLE);
  ALTER TABLE "ECOPUNTOS_USER"."USUARIOS" MODIFY ("CORREO" NOT NULL ENABLE);
  ALTER TABLE "ECOPUNTOS_USER"."USUARIOS" MODIFY ("CLAVE" NOT NULL ENABLE);
  ALTER TABLE "ECOPUNTOS_USER"."USUARIOS" MODIFY ("FECHA_REGISTRO" NOT NULL ENABLE);
  ALTER TABLE "ECOPUNTOS_USER"."USUARIOS" ADD CHECK (estado IN ('ACTIVO', 'INACTIVO', 'BLOQUEADO')) ENABLE;
  ALTER TABLE "ECOPUNTOS_USER"."USUARIOS" ADD PRIMARY KEY ("ID_USUARIO")
  USING INDEX PCTFREE 10 INITRANS 20 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
  BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "DATA"  ENABLE;
  ALTER TABLE "ECOPUNTOS_USER"."USUARIOS" ADD UNIQUE ("CORREO")
  USING INDEX PCTFREE 10 INITRANS 20 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
  BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "DATA"  ENABLE;
--------------------------------------------------------
--  Constraints for Table ENTREGAS_RECICLAJE
--------------------------------------------------------

  ALTER TABLE "ECOPUNTOS_USER"."ENTREGAS_RECICLAJE" MODIFY ("ID_USUARIO" NOT NULL ENABLE);
  ALTER TABLE "ECOPUNTOS_USER"."ENTREGAS_RECICLAJE" MODIFY ("ID_CENTRO" NOT NULL ENABLE);
  ALTER TABLE "ECOPUNTOS_USER"."ENTREGAS_RECICLAJE" MODIFY ("FECHA_ENTREGA" NOT NULL ENABLE);
  ALTER TABLE "ECOPUNTOS_USER"."ENTREGAS_RECICLAJE" ADD PRIMARY KEY ("ID_ENTREGA")
  USING INDEX PCTFREE 10 INITRANS 20 MAXTRANS 255 
  TABLESPACE "DATA"  ENABLE;
--------------------------------------------------------
--  Constraints for Table CUPONES_EMITIDOS
--------------------------------------------------------

  ALTER TABLE "ECOPUNTOS_USER"."CUPONES_EMITIDOS" MODIFY ("CODIGO_CUPON" NOT NULL ENABLE);
  ALTER TABLE "ECOPUNTOS_USER"."CUPONES_EMITIDOS" MODIFY ("ID_USUARIO" NOT NULL ENABLE);
  ALTER TABLE "ECOPUNTOS_USER"."CUPONES_EMITIDOS" MODIFY ("ID_RECOMPENSA" NOT NULL ENABLE);
  ALTER TABLE "ECOPUNTOS_USER"."CUPONES_EMITIDOS" MODIFY ("FECHA_EMISION" NOT NULL ENABLE);
  ALTER TABLE "ECOPUNTOS_USER"."CUPONES_EMITIDOS" MODIFY ("FECHA_EXPIRACION" NOT NULL ENABLE);
  ALTER TABLE "ECOPUNTOS_USER"."CUPONES_EMITIDOS" ADD CHECK (estado IN ('DISPONIBLE', 'REDIMIDO', 'EXPIRADO')) ENABLE;
  ALTER TABLE "ECOPUNTOS_USER"."CUPONES_EMITIDOS" ADD PRIMARY KEY ("ID_CUPON")
  USING INDEX PCTFREE 10 INITRANS 20 MAXTRANS 255 
  TABLESPACE "DATA"  ENABLE;
  ALTER TABLE "ECOPUNTOS_USER"."CUPONES_EMITIDOS" ADD UNIQUE ("CODIGO_CUPON")
  USING INDEX PCTFREE 10 INITRANS 20 MAXTRANS 255 
  TABLESPACE "DATA"  ENABLE;
--------------------------------------------------------
--  Constraints for Table ENTREGAS_DETALLE
--------------------------------------------------------

  ALTER TABLE "ECOPUNTOS_USER"."ENTREGAS_DETALLE" MODIFY ("ID_ENTREGA" NOT NULL ENABLE);
  ALTER TABLE "ECOPUNTOS_USER"."ENTREGAS_DETALLE" MODIFY ("ID_MATERIAL" NOT NULL ENABLE);
  ALTER TABLE "ECOPUNTOS_USER"."ENTREGAS_DETALLE" MODIFY ("PESO_KG" NOT NULL ENABLE);
  ALTER TABLE "ECOPUNTOS_USER"."ENTREGAS_DETALLE" MODIFY ("PUNTOS_GENERADOS" NOT NULL ENABLE);
  ALTER TABLE "ECOPUNTOS_USER"."ENTREGAS_DETALLE" ADD CHECK (peso_kg > 0) ENABLE;
  ALTER TABLE "ECOPUNTOS_USER"."ENTREGAS_DETALLE" ADD PRIMARY KEY ("ID_DETALLE")
  USING INDEX PCTFREE 10 INITRANS 20 MAXTRANS 255 
  TABLESPACE "DATA"  ENABLE;
--------------------------------------------------------
--  Constraints for Table RECOMPENSAS
--------------------------------------------------------

  ALTER TABLE "ECOPUNTOS_USER"."RECOMPENSAS" MODIFY ("ID_COMERCIO" NOT NULL ENABLE);
  ALTER TABLE "ECOPUNTOS_USER"."RECOMPENSAS" MODIFY ("TITULO" NOT NULL ENABLE);
  ALTER TABLE "ECOPUNTOS_USER"."RECOMPENSAS" MODIFY ("PUNTOS_REQUERIDOS" NOT NULL ENABLE);
  ALTER TABLE "ECOPUNTOS_USER"."RECOMPENSAS" MODIFY ("CANTIDAD_SOLICITAR" NOT NULL ENABLE);
  ALTER TABLE "ECOPUNTOS_USER"."RECOMPENSAS" ADD CHECK (puntos_requeridos > 0) ENABLE;
  ALTER TABLE "ECOPUNTOS_USER"."RECOMPENSAS" ADD CHECK ("CANTIDAD_SOLICITAR">=0) ENABLE;
  ALTER TABLE "ECOPUNTOS_USER"."RECOMPENSAS" ADD CHECK (estado IN ('ACTIVO', 'INACTIVO')) ENABLE;
  ALTER TABLE "ECOPUNTOS_USER"."RECOMPENSAS" ADD PRIMARY KEY ("ID_RECOMPENSA")
  USING INDEX PCTFREE 10 INITRANS 20 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
  BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "DATA"  ENABLE;
--------------------------------------------------------
--  Constraints for Table COMERCIOS
--------------------------------------------------------

  ALTER TABLE "ECOPUNTOS_USER"."COMERCIOS" MODIFY ("ID_USUARIO" NOT NULL ENABLE);
  ALTER TABLE "ECOPUNTOS_USER"."COMERCIOS" MODIFY ("NOMBRE_COMERCIO" NOT NULL ENABLE);
  ALTER TABLE "ECOPUNTOS_USER"."COMERCIOS" MODIFY ("CEDULA_JURIDICA" NOT NULL ENABLE);
  ALTER TABLE "ECOPUNTOS_USER"."COMERCIOS" ADD PRIMARY KEY ("ID_COMERCIO")
  USING INDEX PCTFREE 10 INITRANS 20 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
  BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "DATA"  ENABLE;
  ALTER TABLE "ECOPUNTOS_USER"."COMERCIOS" ADD UNIQUE ("CEDULA_JURIDICA")
  USING INDEX PCTFREE 10 INITRANS 20 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1
  BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "DATA"  ENABLE;
--------------------------------------------------------
--  Ref Constraints for Table COMERCIOS
--------------------------------------------------------

  ALTER TABLE "ECOPUNTOS_USER"."COMERCIOS" ADD CONSTRAINT "FK_COMERCIO_USUARIO" FOREIGN KEY ("ID_USUARIO")
	  REFERENCES "ECOPUNTOS_USER"."USUARIOS" ("ID_USUARIO") ENABLE;
--------------------------------------------------------
--  Ref Constraints for Table CUPONES_EMITIDOS
--------------------------------------------------------

  ALTER TABLE "ECOPUNTOS_USER"."CUPONES_EMITIDOS" ADD CONSTRAINT "FK_CUPON_USUARIO" FOREIGN KEY ("ID_USUARIO")
	  REFERENCES "ECOPUNTOS_USER"."USUARIOS" ("ID_USUARIO") ENABLE;
  ALTER TABLE "ECOPUNTOS_USER"."CUPONES_EMITIDOS" ADD CONSTRAINT "FK_CUPON_RECOMPENSA" FOREIGN KEY ("ID_RECOMPENSA")
	  REFERENCES "ECOPUNTOS_USER"."RECOMPENSAS" ("ID_RECOMPENSA") ENABLE;
--------------------------------------------------------
--  Ref Constraints for Table ENTREGAS_DETALLE
--------------------------------------------------------

  ALTER TABLE "ECOPUNTOS_USER"."ENTREGAS_DETALLE" ADD CONSTRAINT "FK_DET_ENTREGA" FOREIGN KEY ("ID_ENTREGA")
	  REFERENCES "ECOPUNTOS_USER"."ENTREGAS_RECICLAJE" ("ID_ENTREGA") ENABLE;
  ALTER TABLE "ECOPUNTOS_USER"."ENTREGAS_DETALLE" ADD CONSTRAINT "FK_DET_MATERIAL" FOREIGN KEY ("ID_MATERIAL")
	  REFERENCES "ECOPUNTOS_USER"."MATERIALES" ("ID_MATERIAL") ENABLE;
--------------------------------------------------------
--  Ref Constraints for Table ENTREGAS_RECICLAJE
--------------------------------------------------------

  ALTER TABLE "ECOPUNTOS_USER"."ENTREGAS_RECICLAJE" ADD CONSTRAINT "FK_ENTREGA_USUARIO" FOREIGN KEY ("ID_USUARIO")
	  REFERENCES "ECOPUNTOS_USER"."USUARIOS" ("ID_USUARIO") ENABLE;
  ALTER TABLE "ECOPUNTOS_USER"."ENTREGAS_RECICLAJE" ADD CONSTRAINT "FK_ENTREGA_CENTRO" FOREIGN KEY ("ID_CENTRO")
	  REFERENCES "ECOPUNTOS_USER"."CENTROS_ACOPIO" ("ID_CENTRO") ENABLE;
--------------------------------------------------------
--  Ref Constraints for Table RECOMPENSAS
--------------------------------------------------------

  ALTER TABLE "ECOPUNTOS_USER"."RECOMPENSAS" ADD CONSTRAINT "FK_RECOMPENSA_COMERCIO" FOREIGN KEY ("ID_COMERCIO")
	  REFERENCES "ECOPUNTOS_USER"."COMERCIOS" ("ID_COMERCIO") ENABLE;
