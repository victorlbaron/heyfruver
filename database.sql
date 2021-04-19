CREATE TABLE PRODUCTO(
    codpro int not null AUTO_INCREMENT,
    nompro varchar(50) null,
    despro varchar(100) null,
    prepro numeric(6,3) null,
    estado int null,
    CONSTRAINT pk_producto
    PRIMARY KEY (codpro)
);

alter table PRODUCTO add rutimapro varchar(100) null;

INSERT INTO PRODUCTO(nompro, despro, prepro, estado, rutimapro)
VALUES('Cebollín', 'Description', '1.200', '1', 'cebollin.png');

CREATE TABLE USUARIO(
    codusu int not null AUTO_INCREMENT,
    nomusu varchar(50) null,
    apeusu varchar(50) null,
    emausu varchar(50) null,
    pasusu varchar(20),
    estado int not null,
    CONSTRAINT pk_usuario
    PRIMARY KEY (codusu)
);

INSERT INTO USUARIO(nomusu, apeusu, emausu, pasusu, estado)
VALUES ('Cesar','Varon','correo2@example.com','123456789',1);

CREATE TABLE PEDIDO(
    codped int  not null AUTO_INCREMENT,
    codusu int  not null.
    codpro int  not null,
    fecped datetime not null,
    estado int not null,
    dirusuped varchar(50) not null,
    telusuped varchar(10) not null,
    PRIMARY KEY (codped)
);