create database cryptorechner;

use cryptorechner;

create table requests (id int NOT NULL AUTO_INCREMENT , zeit time DEFAULT current_timestamp(), fiat float,  fiatTyp varchar(4), crypto float, cryptoTyp varchar(16), PRIMARY KEY (id) );

