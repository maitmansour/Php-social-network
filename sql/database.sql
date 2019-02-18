drop table chat ;
drop table message ;
drop table post ;
drop table utilisateur ;

CREATE TABLE utilisateur (
 id SERIAL ,
 identifiant VARCHAR(45) NULL ,
 pass VARCHAR(45) NULL ,
 nom VARCHAR(45) NULL ,
 prenom VARCHAR(45) NULL ,
 date_de_naissance TIMESTAMP NULL ,
 statut VARCHAR(100) NULL ,
 avatar VARCHAR(200) NULL ,
 PRIMARY KEY (id) );


CREATE TABLE post (
 id SERIAL ,
 texte VARCHAR(2000) NOT NULL ,
 date TIMESTAMP NOT NULL ,
 image VARCHAR(200) NULL ,
 PRIMARY KEY (id) );


CREATE TABLE message (
 id SERIAL ,
 emetteur INT NULL ,
 destinataire INT NULL ,
 parent INT NULL,
 post INT NULL ,
 aime INT NULL,
 PRIMARY KEY (id) ,
 CONSTRAINT fk_message_utilisateur1
 FOREIGN KEY (emetteur )
 REFERENCES utilisateur (id )
 ON DELETE NO ACTION
 ON UPDATE NO ACTION,
 CONSTRAINT fk_message_utilisateur2
 FOREIGN KEY (destinataire )
 REFERENCES utilisateur (id )
 ON DELETE NO ACTION
 ON UPDATE NO ACTION,
 CONSTRAINT fk_message_post1
 FOREIGN KEY (post )
 REFERENCES post (id )
 ON DELETE NO ACTION
 ON UPDATE NO ACTION);

CREATE TABLE chat (
 id SERIAL ,
 post INT NULL ,
 emetteur INT NULL ,
 PRIMARY KEY (id) ,
 CONSTRAINT fk_chat_post1
 FOREIGN KEY (post )
 REFERENCES post (id )
 ON DELETE NO ACTION
 ON UPDATE NO ACTION,
 CONSTRAINT fk_chat_utilisateur1
 FOREIGN KEY (emetteur )
 REFERENCES utilisateur (id )
 ON DELETE NO ACTION
 ON UPDATE NO ACTION);
  
