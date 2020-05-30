<?php


include_once("classes.php");

$pdo = Tools::connect();

/*$ct1='create table roles(
id int not null auto_increment primary key,
role varchar(128) unique not null
)default charset="utf8"';

$pdo->exec($ct1);*/

/*$pdo->exec('INSERT INTO `Roles` (`Id`, `Role`) VALUES (NULL, "Admin")');
$pdo->exec('INSERT INTO `Roles` (`Id`, `Role`) VALUES (NULL, "Customer")');
*/

/*$ct2='create table customers(
id int not null auto_increment primary key,
login varchar(128) unique not null,
pass varchar(128) not null,
email varchar(128) unique not null,
roleid int,
foreign key(roleid) references roles(id)
on delete cascade
)default charset="utf8"';

$pdo->exec($ct2);*/

/*$ct3 = 'create table categories(
id int not null auto_increment primary key,
name varchar(128) not null
)default charset="utf8"';

$pdo->exec($ct3);*/


/*$ct4='create table goods(
id int not null auto_increment primary key,
title varchar(128) not null,
price double not null,
categoryid int,
foreign key(categoryid) references categories(id)
on delete cascade,
image varchar(255),
info varchar(255)
)default charset="utf8"';

$pdo->exec($ct4);
*/


/*$ct5='create table sales(
id int not null auto_increment primary key,
goodid int,
foreign key(goodid) references goods(id)
on delete cascade,
count int not null,
time datetime,
info varchar(255)
)default charset="utf8"';

$pdo->exec($ct5);*/


?>