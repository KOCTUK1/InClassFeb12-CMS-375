drop database if exists SocialMediaDB;
create database SocialMediaDB;
use SocialMediaDB;

create table Users(
	username varchar(50) primary key,
	password varchar(225) not null
    );
    
insert into Users values
	('Admin', 'pass123')
;