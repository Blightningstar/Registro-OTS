-- TODO: TRIGGER DE AUTOINCREMENT PARA LA LLAVE
CREATE TABLE SEG_PERMISO(
    SEG_PERMISO		INTEGER				NOT NULL,
    DESCRIPCION_ESP	VARCHAR2(256)		NOT NULL,
    DESCRIPCION_ING	VARCHAR2(256)		NOT NULL,
    
    CONSTRAINT	"SEG_PERMISO_PK" 		PRIMARY KEY (SEG_PERMISO),

	CONSTRAINT	"DESCRIPCION_ESP_REGEX"	CHECK(REGEXP_LIKE(DESCRIPCION_ESP, '([a-zA-ZñÑáéíóúÁÉÍÓÚ]|\s)*'),
	CONSTRAINT	"DESCRIPCION_ING_REGEX"	CHECK(REGEXP_LIKE(DESCRIPCION_ESP, '([a-zA-Z]|\s)*')
);

-- TODO: TRIGGER QUE DEPENDIENTE DEL SEG_ROL LE PONGA NOMBRE_ROL
-- IMPORTANTE: ESTA TABLA ES NECESARIA? PUEDE SER INCLUIDA COMO ATRIBUTO EN USUARIO DEBIDO A RELACIÓN 1 A 1
CREATE TABLE SEG_ROL(
    SEG_ROL		INTEGER				NOT NULL,
	NOMBRE_ROL	VARCHAR2(13)   		NOT NULL,
	
    CONSTRAINT	"SEG_ROL_PK" 		PRIMARY KEY (SEG_ROL),

	CONSTRAINT	"SEG_ROL_RANGE" 	CHECK (SEG_ROL  BETWEEN 1 and 3),
	CONSTRAINT	"NOMBRE_ROL_ENUM" 	CHECK(NOMBRE_ROL IN ('SuperUser','Administrator','Student'))
);

CREATE TABLE SEG_POSEE(
    SEG_ROL     INTEGER				NOT NULL, -- SI LA TABLA ROL ES ABSORBIDA, CAMBIAR POR PK DE USUARIO
    SEG_PERMISO INTEGER 			NOT NULL,

    CONSTRAINT 	"SEG_POSEE_PK" 		PRIMARY KEY(SEG_ROL, SEG_PERMISO),
    CONSTRAINT 	"SEG_ROL_FK" 		FOREING KEY SEG_ROL REFERENCES SEG_ROL(SEG_ROL),
    CONSTRAINT 	"SEG_PERMISO_FK" 	FOREING KEY SEG_PERMISO REFERENCES SEG_PERMISO(SEG_PERMISO)
);

-- TODO: TRIGGER DE AUTOINCREMENT PARA LA LLAVE si esta fuese autoincremental y no la cédula o id del usuario
CREATE TABLE SEG_USUARIO(
    SEG_USUARIO			INTEGER				NOT NULL, -- No es un número incremental?
    NOMBRE				VARCHAR2(30)		NOT NULL,
    APELLIDO_1			VARCHAR2(30)		NOT NULL,
    APELLIDO_2			VARCHAR2(30),
    NOMBRE_USUARIO		VARCHAR2(256)		NOT NULL,
    CONTRASENA			VARCHAR2(60)		NOT NULL, -- Probar almacenarlo como RAW o BINARY
    CORREO				VARCHAR2(256)		NOT NULL,
    NUMERO_TELEFONO		VARCHAR2(28)		NOT NULL,
    NACIONALIDAD		VARCHAR2(20)		NOT NULL,
    ACTIVO				CHAR(1)				NOT NULL 	DEFAULT '1',
	SEG_ROL				INTEGER				NOT NULL,
	CODIGO_RESTAURACION	VARCHAR2(15),
    
    CONSTRAINT	"SEG_USUARIO_PK" 			PRIMARY KEY (SEG_USUARIO),
	CONSTRAINT 	"SEG_ROL_FK"				FOREIGN KEY (SEG_ROL) REFERENCES SEG_ROL(SEG_ROL) -- VER LINEA 13

	CONSTRAINT	"NOMBRE_REGEX"				CHECK(REGEXP_LIKE(NOMBRE, '^[^±!@£$%^&*_+§¡€#¢§¶•ªº«\\/<>?:;|=.,]{1,30}$'),
	CONSTRAINT	"APELLIDO_1_REGEX"			CHECK(REGEXP_LIKE(APELLIDO_1, '^[^±!@£$%^&*_+§¡€#¢§¶•ªº«\\/<>?:;|=.,]{1,30}$'),
	CONSTRAINT	"APELLIDO_2_REGEX"			CHECK(REGEXP_LIKE(APELLIDO_2, '^[^±!@£$%^&*_+§¡€#¢§¶•ªº«\\/<>?:;|=.,]{0,30}$'),
	CONSTRAINT	"NOMBRE_USUARIO_REGEX"		CHECK(REGEXP_LIKE(NOMBRE_USUARIO, '^[^±!@£$%^&*_+§¡€#¢§¶•ªº«\\/<>?:;|=.,]{1,30}$'),
	CONSTRAINT	"CONTRASENA_REGEX"			CHECK(REGEXP_LIKE(CONTRASENA, '^[$./0-9a-zA-z]$'),
	CONSTRAINT	"CORREO_REGEX"				CHECK(REGEXP_LIKE(CORREO, '^(([^\"\'\'@\s\.\(\)\[\]\{\}\\\/,:;]+)\.)*\2@\2(\.\2)+$'),
	CONSTRAINT	"NUMERO_TELEFONO_REGEX"		CHECK(REGEXP_LIKE(NUMERO_TELEFONO, '^(\d|-|+){7,28}$'),
	CONSTRAINT	"NACIONALIDAD_REGEX"		CHECK(REGEXP_LIKE(NACIONALIDAD, '^([a-zA-Z]|\s)*$'),
	CONSTRAINT 	"ACTIVO_BOOL" 				CHECK(ACTIVO IN ('1','0')),
	CONSTRAINT	"CODIGO_RESTAURACION_REGEX"	CHECK(REGEXP_LIKE(CODIGO_RESTAURACION, '^\w{15}$'),
	--ON DELETE RESTRICT
);

-- TODO: TRIGGER INCREMENTAL O ABSORBER LA TABLA DENTRO DE CURSO COMO SOLO UN ATRIBUTO
CREATE TABLE PRO_PROGRAMA(
    PRO_PROGRAMA       INTEGER, -- AL IGUAL QUE ROL ESTA TABLA PUEDE SER ABSORBIDA
    NOMBRE             VARCHAR2(20)		NOT NULL,
    ACTIVO             CHAR(1)			NOT NULL DEFAULT '1',
	
	CONSTRAINT	"PRO_PROGRAMA_PK" 		PRIMARY KEY (PRO_PROGRAMA),
	CONSTRAINT 	"ACTIVO_BOOL" 			CHECK(ACTIVO IN ('1','0')),
);

