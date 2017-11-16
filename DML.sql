insert into customer
    values('bill', '1234', 'Bill', 'Doe', '123 Street', 'Ypsilanti', 'MI', 48198, 'VISA', '1234567891011234', '01/18');
    
insert into customer
    values('charlie2', 'abcd', 'Charlie', 'Smith', '124 Street', 'Ypsilanti', 'MI', 48198, 'MASTER', '1265567891021784', '02/18');
    
insert into customer
    values('hpfan1', 'voldemortsux1', 'Harry', 'Potter', '4 Privet Drive', 'Detroit', 'MI', 12345, 'DISCOVER', '1261356791021987', '11/23');
    
insert into book
    values(0764572091, 'How To Fix Everything For Dummies', 'Gary Hedstrom', 'Misc. Publisher', 13.59, 'Self Help');
    
insert into book
    values(1119114292, 'Personal Finance For Dummies', 'Eric Tyson', 'Thee Olde Publisher', 20.00, 'Action');
    
insert into book
    values(1119154685, 'Hacking For Dummies', 'Kevin Beaver', '1337 Hacker Publisher', 14.99, 'Romance');
        
insert into purchase
    values(1, 13.59);
    
insert into purchase
    values(2, 33.59);

insert into purchase
    values(3, 40.00);
    
insert into purchase
    values(4, 14.99);
    
insert into orders
    values('bill', 0764572091, 1, 1);
    
insert into orders
    values('hpfan1', 0764572091, 2, 1);
    
insert into orders
    values('hpfan1', 1119114292, 2, 1);
    
insert into orders
    values('charlie2', 1119114292, 3, 2);
    
insert into orders
    values('bill', 1119154685, 4, 1);
    
insert into review(isbn, content)
    values(1119154685, "Didn't work my computer never hacked anyone, what a rip off.\n Forgot to turn computer on");
    
insert into review(isbn, content)
    values(0764572091, "Doesn't work on paper set on fire.  Thanks pam.");
    
insert into review(isbn, content)
    values(1119114292, "5/5 A+++  Turned 1 dollar into 1 billion dollars!?!");