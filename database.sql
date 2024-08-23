-- Membuat Tabel baru
create table brixhacktiv8.data_portfolio (
	id INT auto_increment not null,
	nama varchar(100) null,
	`role` varchar(100) NULL,
	availability varchar (100) null,
	age int null,
	lokasi varchar(100) null,
	pengalaman varchar(100) null,
	email varchar(100) null,
	constraint data_portfolio_pk primary key (id)
)