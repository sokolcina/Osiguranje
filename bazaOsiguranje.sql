-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema osiguranje
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema osiguranje
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `osiguranje` DEFAULT CHARACTER SET utf8 ;
USE `osiguranje` ;

-- -----------------------------------------------------
-- Table `osiguranje`.`klijent`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `osiguranje`.`klijent` (
  `id_klijent` INT NOT NULL AUTO_INCREMENT,
  `korisnicko_ime` VARCHAR(45) NULL,
  `password` VARCHAR(45) NULL,
  `ime` VARCHAR(45) NULL,
  `prezime` VARCHAR(45) NULL,
  `starost` INT NULL,
  `mesto_rodjenja` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `status` TINYINT(2) NULL,
  PRIMARY KEY (`id_klijent`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `osiguranje`.`osiguranja`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `osiguranje`.`osiguranja` (
  `id_osiguranja` INT NOT NULL AUTO_INCREMENT,
  `ime` VARCHAR(45) NULL,
  `informacije` TEXT NULL,
  `trajanje` INT NULL,
  `mesecna_rata` INT NULL,
  PRIMARY KEY (`id_osiguranja`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `osiguranje`.`radnik`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `osiguranje`.`radnik` (
  `id_radnik` INT NOT NULL AUTO_INCREMENT,
  `ime` VARCHAR(45) NULL,
  `prezime` VARCHAR(45) NULL,
  `staz` INT NULL,
  `plata` INT NULL,
  `radno_mesto` VARCHAR(45) NULL,
  PRIMARY KEY (`id_radnik`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `osiguranje`.`ugovor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `osiguranje`.`ugovor` (
  `id_ugovor` INT NOT NULL AUTO_INCREMENT,
  `datum` DATE NULL,
  `id_osiguranja` INT NOT NULL,
  `id_klijent` INT NOT NULL,
  `id_radnik` INT NOT NULL,
  PRIMARY KEY (`id_ugovor`),
  INDEX `fk_ugovor_osiguranja_idx` (`id_osiguranja` ASC),
  INDEX `fk_ugovor_klijent1_idx` (`id_klijent` ASC),
  INDEX `fk_ugovor_radnik1_idx` (`id_radnik` ASC),
  CONSTRAINT `fk_ugovor_osiguranja`
    FOREIGN KEY (`id_osiguranja`)
    REFERENCES `osiguranje`.`osiguranja` (`id_osiguranja`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ugovor_klijent1`
    FOREIGN KEY (`id_klijent`)
    REFERENCES `osiguranje`.`klijent` (`id_klijent`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ugovor_radnik1`
    FOREIGN KEY (`id_radnik`)
    REFERENCES `osiguranje`.`radnik` (`id_radnik`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
