drop table review;
drop table orders;
drop table customer;
drop table book;
drop table purchase;

create table customer
	(username		varchar(20),
    pin		        varchar(15),
    fname		    varchar(20),
    lname		    varchar(20),
    street		    varchar(30),
    city		    varchar(15),
    state		    varchar(2),
    zip		        integer(5),
    card_type       varchar(8),
    card_num        char(16),
    exp_date        char(5),
	 primary key (username)
	);

create table book
	(isbn		integer(10),
    title		text,
    author		text,
    publisher	text,
    price		decimal(9,2),
    genre		varchar(15),
	 primary key (isbn)
	);

create table purchase
	(purchaseID		integer PRIMARY KEY AUTO_INCREMENT,
    total           decimal(13,2)
	);

create table orders
	(username varchar(20), 
	isbn integer(10), 
	purchaseID integer, 
	quantity integer,
	primary key (username, isbn, purchaseID),
	foreign key (username) references customer(username),
    foreign key (isbn) references book(isbn),
	foreign key (purchaseID) references purchase(purchaseID)
	);

create table review
	(reviewID       integer PRIMARY KEY AUTO_INCREMENT, 
    isbn            integer(10),
    content         text,
    foreign key (isbn) references book(isbn)
	);
