#cliente 32
#productos 30
#comprobante 43
SET foreign_key_checks = 0;
truncate table categoria;
truncate table producto;
truncate table detallecomprobante;
truncate table comprobante;
truncate table persona;
#select *from categoria;
insert into categoria values(null,'padre1','father1','','',0);
insert into categoria values(null,'padre2','father2','','',0);
insert into categoria values(null,'hijo1','hijo1','','',1);
insert into categoria values(null,'hijo2','hijo2','','',1);
insert into categoria values(null,'hijo3','hijo3','','',2);
insert into categoria values(null,'hijo4','hijo4','','',2);
#select * from categoria
insert into producto values(null,ceil(rand()*4)+2,ceil(rand()*30)+20,'','','','',30);#1
insert into producto(idcategoria,precio,stock) select ceil(rand()*4)+2,ceil(rand()*30)+20,ceil(rand()*30)+20 from producto;#2
insert into producto(idcategoria,precio,stock) select ceil(rand()*4)+2,ceil(rand()*30)+20,ceil(rand()*30)+20 from producto;#4
insert into producto(idcategoria,precio,stock) select ceil(rand()*4)+2,ceil(rand()*30)+20,ceil(rand()*30)+20 from producto;#8
insert into producto(idcategoria,precio,stock) select ceil(rand()*4)+2,ceil(rand()*30)+20,ceil(rand()*30)+20 from producto;#16
insert into producto(idcategoria,precio,stock) select ceil(rand()*4)+2,ceil(rand()*30)+20,ceil(rand()*30)+20 from producto;#32
update producto set nombre_es=concat('prod',idproducto),nombre_en=concat('item',idproducto),descripcion_es='',descripcion_en='';
#select * from producto
insert into persona(telefono) values('123456');#1;
insert into persona(telefono) select telefono from persona;#2
insert into persona(telefono) select telefono from persona;#4
insert into persona(telefono) select telefono from persona;#9
insert into persona(telefono) select telefono from persona;#16
insert into persona(telefono) select telefono from persona;#32
update persona set nombre=concat('nombre',idpersona),apellidos=concat('ap',idpersona),direccion=concat('dir',idpersona),correo=concat('correo',idpersona),idioma='es';
#select * from persona;
insert into comprobante(fechaComprobante) values(concat('2012-12-',floor(rand()*32)+1));#1
insert into comprobante(fechacomprobante) select concat('2012-12-',floor(rand()*32)+1) from comprobante;#2
insert into comprobante(fechacomprobante) select concat('2012-12-',floor(rand()*32)+1) from comprobante;#4
insert into comprobante(fechacomprobante) select concat('2012-12-',floor(rand()*32)+1) from comprobante;#8
insert into comprobante(fechacomprobante) select concat('2012-12-',floor(rand()*32)+1) from comprobante;#16
insert into comprobante(fechacomprobante) select concat('2012-12-',floor(rand()*32)+1) from comprobante;#32
update comprobante set clienteid = ceil(rand()*32);
#select * from comprobante;
insert into detallecomprobante(idproducto,idcomprobante,cantidad,precioUnitario) values(ceil(rand()*30),ceil(rand()*43),ceil(rand()*3),ceil(rand()*30)+30);#1
insert into detallecomprobante(idproducto,idcomprobante,cantidad,precioUnitario) select ceil(rand()*30),ceil(rand()*43),ceil(rand()*3),ceil(rand()*30)+30 from detallecomprobante;#2
insert into detallecomprobante(idproducto,idcomprobante,cantidad,precioUnitario) select ceil(rand()*30),ceil(rand()*43),ceil(rand()*3),ceil(rand()*30)+30 from detallecomprobante;#4
insert into detallecomprobante(idproducto,idcomprobante,cantidad,precioUnitario) select ceil(rand()*30),ceil(rand()*43),ceil(rand()*3),ceil(rand()*30)+30 from detallecomprobante;#8
insert into detallecomprobante(idproducto,idcomprobante,cantidad,precioUnitario) select ceil(rand()*30),ceil(rand()*43),ceil(rand()*3),ceil(rand()*30)+30 from detallecomprobante;#16
insert into detallecomprobante(idproducto,idcomprobante,cantidad,precioUnitario) select ceil(rand()*30),ceil(rand()*43),ceil(rand()*3),ceil(rand()*30)+30 from detallecomprobante;#32
insert into detallecomprobante(idproducto,idcomprobante,cantidad,precioUnitario) select ceil(rand()*30),ceil(rand()*43),ceil(rand()*3),ceil(rand()*30)+30 from detallecomprobante;#64
insert into detallecomprobante(idproducto,idcomprobante,cantidad,precioUnitario) select ceil(rand()*30),ceil(rand()*43),ceil(rand()*3),ceil(rand()*30)+30 from detallecomprobante;#128
insert into detallecomprobante(idproducto,idcomprobante,cantidad,precioUnitario) select ceil(rand()*30),ceil(rand()*43),ceil(rand()*3),ceil(rand()*30)+30 from detallecomprobante;#256
insert into detallecomprobante(idproducto,idcomprobante,cantidad,precioUnitario) select ceil(rand()*30),ceil(rand()*43),ceil(rand()*3),ceil(rand()*30)+30 from detallecomprobante;#512
update detallecomprobante set total=preciounitario*cantidad;
#select * from detallecomprobante;
delete from producto where not idcategoria in (select a.idcategoria from categoria a);
delete from comprobante where not clienteid in (select a.idpersona from persona a);
delete from detallecomprobante where not idcomprobante in (select idcomprobante from comprobante) or not idproducto in (select idproducto from producto);
SET foreign_key_checks = 1;