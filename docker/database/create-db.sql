CREATE DATABASE brandshop CHARACTER SET utf8 COLLATE utf8_general_ci;
CREATE USER 'db_user'@'%' IDENTIFIED BY 'db_password';
GRANT ALL PRIVILEGES ON db_name.* TO 'db_user'@'%';
FLUSH PRIVILEGES;
