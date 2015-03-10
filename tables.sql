SET FOREIGN_KEY_CHECKS=0; /*Syntax from http://stackoverflow.com/questions/3334619/cannot-delete-or-update-a-parent-row-a-foreign-key-constraint-fails as I was getting an error */
DROP TABLE IF EXISTS `profiles`;
DROP TABLE IF EXISTS products;
SET FOREIGN_KEY_CHECKS=1;



CREATE TABLE profiles(
id int(11) NOT NULL AUTO_INCREMENT,
pname varchar(255) NOT NULL,
pass varchar(255) NOT NULL,
pic int(11) NOT NULL,
PRIMARY KEY(id)
) ENGINE = InnoDB;



CREATE TABLE products(
id int(11) NOT NULL AUTO_INCREMENT,
pid int(11) NOT NULL,
item varchar(255),
cost decimal (5,2),
ptype varchar(255),
PRIMARY KEY(id),
FOREIGN KEY(pid) REFERENCES profiles(id)
) ENGINE = InnoDB;

INSERT INTO profiles (pname,pass, pic) VALUES ("Default","password","1");