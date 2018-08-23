create database quickpayment2;
use quickpayment2;

create table usergroups(
	ID_UG varchar(8) primary key,
	Name_UG varchar(50)
	);

create table workplaces(
	ID_WP varchar(8) primary key,
	description varchar(100)
	);

create table members(
	id_member varchar(8) primary key,
	password varchar(50) not null,
	name varchar(120) not null ,
	sex varchar(5) not null,
	dayofbirth date not null,
	phone int,
	ID_UG varchar(8) not null,
	ID_WP varchar(8) not null,
	balance int default 0 not null,
	foreign key (ID_WP) references workplaces(ID_WP)  on update cascade,
	foreign key(ID_UG) references usergroups(ID_UG) on update cascade
	);

    create table payments(
		date_time timestamp default current_timestamp,
		id_pay_member varchar(8) not null,
		id_collect_member varchar(8) not null,
		amountofmoney int not null,
		type_payment varchar(3),
		primary key(date_time,id_pay_member),
		foreign key(id_pay_member) references members(id_member) on update cascade,
		foreign key(id_collect_member) references members(id_member) on update cascade
		);

create table cards(
	id_Card varchar(12) primary key,
	id_member varchar(8) not null,
	foreign key (id_member) references members(id_member)  on update cascade
	);




insert into usergroups values('1','Initial admin');
insert into usergroups values('2','Admin');
insert into usergroups values('3','Deposit staff');
insert into usergroups values('4','service staff');
insert into usergroups values('5','student/lecturer');

insert into workplaces values('KH' , 'Khoa KHTN');
insert into workplaces values('KT' , 'Khoa KT-QTKD');
insert into workplaces values('MT' , 'Khoa KHCT');
insert into workplaces values('XH' , 'Khoa KHXHNV');
insert into workplaces values('DB' , 'Khoa DBDT');
insert into workplaces values('DI' , 'Khoa CNTT&TT');
insert into workplaces values('CN' , 'Khoa CN');
insert into workplaces values('TS' , 'Khoa TS');
insert into workplaces values('NN' , 'Khoa NN&SHUD');
insert into workplaces values('SH' , 'Vien NC&PTCNSH');
insert into workplaces values('MTN' , 'Khoa MT&TNTN');
insert into workplaces values('HA' , 'Khoa PTNT');
insert into workplaces values('HL' , 'TTHL');
insert into workplaces values('NDH' , 'Nha dieu hanh');
insert into workplaces values('A1' , 'Nha hoc A1');
insert into workplaces values('A3' , 'Nha hoc A3');
insert into workplaces values('B1' , 'Nha hoc B1');
insert into workplaces values('C1' , 'Nha hoc C1');
insert into workplaces values('C2' , 'Nha hoc C2');

insert into members values('iadmin','21232f297a57a5a743894a0e4a801fc3','Initial Admin','nam','1996-02-06','01224099996','1','DI','0');
