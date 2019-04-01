CREATE USER 'mychustergames'@'%' IDENTIFIED BY 'mychustergames';
GRANT ALL PRIVILEGES ON `mychustergames`.* TO 'mychustergames'@'%';

CREATE USER 'mychustergames'@'localhost' IDENTIFIED BY 'mychustergames';
GRANT ALL PRIVILEGES ON `mychustergames`.* TO 'mychustergames'@'localhost';