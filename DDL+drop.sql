drop table customer;
drop table book;
drop table purchase;
drop table orders;
drop table review;

create table customer
	(username		varchar(20),
    pin		        varchar(15),
    fname		    varchar(20),
    lname		    varchar(20),
    street		    varchar(30),
    city		    varchar(15),
    state		    varchar(2),
    zip		        numeric(5,0),
    card_type       varchar(8),
    card_num        numeric(16,0),
    exp_date        char(5),
	 primary key (username)
	);

create table book
	(isbn		numeric(10,0),
    title		varchar(20),
    author		varchar(20),
    publisher	varchar(20),
    price		numeric(9,2),
    genre		varchar(15),
	 primary key (isbn)
	);

create table purchase
	(purchaseID		integer PRIMARY KEY AUTOINCREMENT, 
	total			numeric(13,2)
	);

create table orders
	(username		varchar(20), 
	isbn			numeric(10,0), 
	purchaseID		integer, 
	quantity	    integer,
	primary key (username, isbn, purchaseID),
	foreign key (username) references customer,
    foreign key (isbn) references book,
	foreign key (purchaseID) references purchase
	);

create table review
	(reviewID       integer PRIMARY KEY AUTOINCREMENT, 
    isbn            numeric(10,0),
    content         text,
    foreign key (isbn) references book
	);
