drop database if exists SocialMediaDB_2;
create database SocialMediaDB_2;
use SocialMediaDB_2;

create table Users(
	username varchar(50) primary key,
	password varchar(255) not null,
    created_at date
    );
    
insert into Users values
	('Admin', 'pass123', '2026-02-25')
;

create table UserDetails(
	username varchar(50) primary key,
    fullname varchar(100),
    email varchar(50),
    city varchar(50),
    created_at date,
    foreign key (username) references Users(username)
);

insert into UserDetails values
	('Admin', 'Administrator Account', 'admin.acc@company.com', 'Penutville', '2026-02-25')
;

 -- select * from Users natural join UserDetails -- natural join is dangerous because it will not show rows that do not fully match
 -- instead add an on clause with regular inner join
select * from users join UserDetails on Users.username = UserDetails.username;
-- or do this
select * from USers join UserDetails using (username);


