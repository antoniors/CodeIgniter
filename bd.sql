CREATE DATABASE prueba;
USE prueba;

  CREATE TABLE `keys` (
       `id` INT(11) NOT NULL AUTO_INCREMENT,
       `user_id` INT(11) NOT NULL,
       `key` VARCHAR(40) NOT NULL,
       `level` INT(2) NOT NULL,
       `ignore_limits` TINYINT(1) NOT NULL DEFAULT '0',
       `is_private_key` TINYINT(1)  NOT NULL DEFAULT '0',
       `ip_addresses` TEXT NULL DEFAULT NULL,
       `date_created` INT(11) NOT NULL,
       PRIMARY KEY (`id`)
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
   
   
      CREATE TABLE `api_logs` (
       `id` INT(11) NOT NULL AUTO_INCREMENT,
       `uri` VARCHAR(255) NOT NULL,
       `method` VARCHAR(6) NOT NULL,
       `params` TEXT DEFAULT NULL,
       `api_key` VARCHAR(40) NOT NULL,
       `ip_address` VARCHAR(45) NOT NULL,
       `time` INT(11) NOT NULL,
       `rtime` FLOAT DEFAULT NULL,
       `authorized` VARCHAR(1) NOT NULL,
       `response_code` smallint(3) DEFAULT '0',
       PRIMARY KEY (`id`)
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8;



      CREATE TABLE `usuario` (
       `id` INT(11) NOT NULL AUTO_INCREMENT,
       `nombre` VARCHAR(255) NOT NULL,
       `email` VARCHAR(50) NOT NULL,
       PRIMARY KEY (`id`)
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `prueba`.`keys`
(`id`,
`user_id`,
`key`,
`level`,
`ignore_limits`,
`is_private_key`,
`ip_addresses`,
`date_created`)
VALUES
('1', '0', '8k8884wgckscg0g0o4kgs8owk8gso8g8soc4c8cc', '10', '1', '0', NULL, '1463818875');


