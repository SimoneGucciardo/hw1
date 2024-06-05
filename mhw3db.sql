use mwh3;

CREATE TABLE users (
    id integer primary key auto_increment,
    username varchar(16) not null unique,
    password varchar(255) not null,
    email varchar(255) not null unique,
    name varchar(255) not null,
    surname varchar(255) not null
) Engine = InnoDB;



CREATE TABLE recensioni(
    id integer,
    recensione varchar(255) not null,
    foreign key (id) references users(id)    
) Engine = InnoDB;


CREATE TABLE prodotti_in_vendita(
id integer primary key,
prodotto varchar(255) not null,
prezzo double,
image varchar(255)
)Engine = InnoDB;


CREATE TABLE preferiti(
 id_preferiti int primary key auto_increment,
 id_utente int,
 id_prodotto int,
 foreign key (id_utente) references users(id),
 foreign key (id_prodotto) references  prodotti_in_vendita(id) 
)Engine = InnoDB;


INSERT INTO prodotti_in_vendita VALUES( 1 , 'LOVLI FIOCCO ARGENTO' , 22.90 ,'https://amabilejewels.it/lovli-fiocco-argento' );
INSERT INTO prodotti_in_vendita VALUES(2, 'LOVLI CUORE MADREPERLA' , '22,90' ,'https://amabilejewels.it/lovli-cuore-madreperla-argento' );
INSERT INTO prodotti_in_vendita VALUES(3, 'LOVLI LETTERINA ARGENTO' , '22,90' ,'https://amabilejewels.it/lovli-letterina-argento' );
INSERT INTO prodotti_in_vendita VALUES(4, 'HOOP LISCIO ARGENTO' , '14,90' ,'https://amabilejewels.it/hoop-liscio-argento' );
