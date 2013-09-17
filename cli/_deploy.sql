

ALTER TABLE `ffs`.`Result` ADD COLUMN `sanctioned` TINYINT NULL DEFAULT 0  AFTER `dispDate` , ADD COLUMN `notes` LONGTEXT NULL  AFTER `sanctioned` ;
ALTER TABLE `ffs`.`Result` ADD COLUMN `startValue` VARCHAR(64) NULL  AFTER `notes` ;
ALTER TABLE `ffs`.`Result` ADD COLUMN `data` LONGTEXT NULL  AFTER `startValue` ;
ALTER TABLE `ffs`.`Competition` ADD COLUMN `sanctioned` TINYINT NULL  AFTER `data` ;
ALTER TABLE `ffs`.`Athelete` ADD COLUMN `event_default` VARCHAR(45) NULL  AFTER `level` ;
ALTER TABLE `ffs`.`Result` ADD COLUMN `idCompetition` INT NULL  AFTER `data` ;
ALTER TABLE `ffs`.`Result` ADD COLUMN `specialNotes` VARCHAR(64) NULL  AFTER `idCompetition` ;
#Added non sanctioned NS prefix
ALTER TABLE `ffs`.`Result` ADD COLUMN `NSTied` VARCHAR(45) NULL  AFTER `NSSpecialNotes` , CHANGE COLUMN `startValue` `NSStartValue` VARCHAR(64) NULL DEFAULT NULL  , CHANGE COLUMN `specialNotes` `NSSpecialNotes` VARCHAR(64) NULL DEFAULT NULL  ;
ALTER TABLE `ffs`.`Result` CHANGE COLUMN `NSTied` `NSTied` TINYINT NULL DEFAULT NULL  ;
ALTER TABLE `ffs`.`Result` ADD COLUMN `NSPlace` VARCHAR(45) NULL  AFTER `NSTied` ;
ALTER TABLE `ffs`.`Result` ADD COLUMN `idInputUser` INT NULL  AFTER `NSPlace` , CHANGE COLUMN `NSPlace` `NSPlace` INT(4) NULL DEFAULT NULL  ;





#Added 10.12.13
delimiter $$

CREATE TABLE `MLCNamespace` (
  `idNamespace` int(11) NOT NULL AUTO_INCREMENT,
  `namespace` varchar(128) DEFAULT NULL,
  `idEntity` int(11) DEFAULT NULL,
  `entityType` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`idNamespace`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1$$

ALTER TABLE `ffs`.`Competition` ADD COLUMN `clubType` VARCHAR(45) NULL  AFTER `signupCutOffDate` ;
ALTER TABLE `ffs`.`Competition` ADD COLUMN `data` LONGTEXT NULL  AFTER `clubType` ;


#Added 9.10.13
ALTER TABLE `ffs`.`ParentMessage` ADD COLUMN `fromName` VARCHAR(45) NULL  AFTER `atheleteName` ;
