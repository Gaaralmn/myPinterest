create database if not exists myPinterest;
use myPinterest;


# Entity users
# I assume that different user can not have the same user name
create table if not exists users 
	(uid 				INT AUTO_INCREMENT,
     user_name			VARCHAR(20),
	 password			VARCHAR(15),
	 email				VARCHAR(30),
	 description		VARCHAR(50),
	 location 			VARCHAR(20),
	 time				datetime,

	 primary key (uid)
	);

# Entity pinboards (Weak) 
# Weak entity pinboards, I will combine it with the relation creates
create table if not exists pinboards
	(bid 				INT AUTO_INCREMENT,
	 uid				INT,
	 board_name			VARCHAR(20),
	 category			VARCHAR(15),
	 open_status	 	VARCHAR(15),
	 description		VARCHAR(50),
	 time				datetime,

	 primary key (bid),
	 foreign key (uid) references users (uid)
	 	on delete cascade
	);

# Entity pins 
# I will combine it with all the relationships between pins
# and users, pinboards and pictures
create table if not exists pins 
	(pid 				INT AUTO_INCREMENT,
     bid	 			INT,
	 url				VARCHAR(255),
	 time				datetime,

	 primary key (pid),
	 foreign key (bid) references pinboards (bid)
	 	on delete cascade
	);

#Relation follow, follow only works on pinboards    
create table if not exists follow
	(foid 				INT AUTO_INCREMENT,
	 uid				INT,
     bid				INT,
     time				datetime,
     
     primary key (foid),
     foreign key (uid) references users (uid),
	 foreign key (bid) references pinboards (bid)
	 	on delete cascade
    );
# Request for friendships.
create table if not exists request 
	(rid 				INT AUTO_INCREMENT,
     from_id			INT,
     to_id				INT,
     time				datetime,
     
     primary key (rid),
     foreign key (from_id) references users (uid),
	 foreign key (to_id) references users (uid)
    );

# Relation friends between users
# In this table, user with uid1 and user with uid2 are friends.
create table if not exists friends 
	(fid 				INT AUTO_INCREMENT,
     uid1				INT,
	 uid2				INT,
	 time 				datetime,

	 primary key (fid),
	 foreign key (uid1) references users (uid),
	 foreign key (uid2) references users (uid)
	);

# Relation commments
# users commments on the pictures that are pinned on the boards, that means 
# commments work on pins. 
create table if not exists comments 
	(cid 				INT AUTO_INCREMENT,				
	 uid	 			INT,
	 pid 				INT,
	 comment 			VARCHAR(255),
	 time				datetime,

	 primary key (cid), 
	 foreign key (pid) references pins (pid)
	 	on delete cascade,
	 foreign key (uid) references users (uid)
	);

# Relation likes
# Similar as the previous one users like the pins
create table if not exists likes 
	(lid 				INT AUTO_INCREMENT,
     uid	 			INT,
	 pid 				INT,
	 time				datetime,

	 primary key (lid),
	 foreign key (pid) references pins (pid)
	 	on delete cascade,
	 foreign key (uid) references users (uid)
	);

