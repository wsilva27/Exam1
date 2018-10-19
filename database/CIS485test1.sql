CREATE database CIS485test1;

USE CIS485test1;

DROP TABLE IF EXISTS inventory;

CREATE TABLE  inventory (
    prodid      CHAR(4)     NOT NULL,
    proddesc    VARCHAR(25) NOT NULL,
    QtyOnHand   INT(4)      NOT NULL,
    price       DECIMAL(5,2),
    PRIMARY KEY (prodid)
);

-- DROP TABLE IF EXISTS ordertbl;

-- CREATE TABLE  ordertbl (
--     ordernum INT(4)      NOT NULL AUTO_INCREMENT,
--     username VARCHAR(50) NOT NULL,
--     qty1     INT(4)      NOT NULL DEFAULT 0,
--     qty2     INT(4)      NOT NULL DEFAULT 0,
--     qty3     INT(4)      NOT NULL DEFAULT 0,
--     PRIMARY KEY (ordernum)
-- );

DROP TABLE IF EXISTS orders;
CREATE TABLE orders (
	orderid int(13) unsigned NOT NULL AUTO_INCREMENT primary key,
    username varchar(50) NOT NULL,
    orderdate datetime
);

DROP TABLE IF EXISTS orderdetails;

CREATE TABLE orderdetails (
	detailid int(13) unsigned NOT NULL AUTO_INCREMENT primary key,
	orderid int(13) unsigned NOT NULL,
    prodid char(4) NOT NULL,
    qty int(5) unsigned NOT NULL DEFAULT 0,
    unitprice decimal(5, 2) UNSIGNED  NOT NULL, default 0,
    FOREIGN KEY (orderid) REFERENCES orders (orderid),
    FOREIGN KEY (prodid) REFERENCES inventory (prodid)
);

INSERT INTO inventory (prodid, proddesc, QtyOnHand, price)
VALUES ('0001','Yellow Scarf', 100, 15.00);
INSERT INTO inventory (prodid, proddesc, QtyOnHand, price)
VALUES ('0002','Green Gloves', 100, 20.00);
INSERT INTO inventory (prodid, proddesc, QtyOnHand, price)
VALUES ('0003','Red Skirt', 100, 25.00);
INSERT INTO inventory (prodid, proddesc, QtyOnHand, price)
VALUES ('0004','Blue Jacket', 100, 125.00);
INSERT INTO inventory (prodid, proddesc, QtyOnHand, price)
VALUES ('0005','White Mug', 100, 5.00);
