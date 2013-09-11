
delimiter $$

CREATE TABLE `MLCNamespace` (
  `idNamespace` int(11) NOT NULL AUTO_INCREMENT,
  `namespace` varchar(128) DEFAULT NULL,
  `idEntity` int(11) DEFAULT NULL,
  `entityType` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`idNamespace`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1$$



#Added 9.10.13
ALTER TABLE `ffs`.`ParentMessage` ADD COLUMN `fromName` VARCHAR(45) NULL  AFTER `atheleteName` ;
