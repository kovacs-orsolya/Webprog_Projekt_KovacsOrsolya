-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema HallBooking
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `HallBooking` ;

-- -----------------------------------------------------
-- Schema HallBooking
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `HallBooking` DEFAULT CHARACTER SET utf8 ;
USE `HallBooking` ;

-- -----------------------------------------------------
-- Table `HallBooking`.`halls`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `HallBooking`.`halls` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NULL,
  `size` DECIMAL(5,2) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `HallBooking`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `HallBooking`.`users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NULL,
  `password` VARCHAR(255) NULL,
  `email` VARCHAR(255) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `HallBooking`.`bookings`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `HallBooking`.`bookings` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `halls_id` INT UNSIGNED NOT NULL,
  `users_id` INT UNSIGNED NOT NULL,
  `bookedDate` DATE NULL,
  `bookedTime` TIME NULL,
  `event` VARCHAR(500) NULL,
  PRIMARY KEY (`id`, `halls_id`, `users_id`),
  INDEX `fk_foglalasok_termek_idx` (`halls_id` ASC) VISIBLE,
  INDEX `fk_bookings_users1_idx` (`users_id` ASC) VISIBLE,
  CONSTRAINT `fk_foglalasok_termek`
    FOREIGN KEY (`halls_id`)
    REFERENCES `HallBooking`.`halls` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bookings_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `HallBooking`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
