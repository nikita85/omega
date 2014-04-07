<?php

class m140407_161748_init_schema extends CDbMigration
{
/*	public function up()
	{
	}

	public function down()
	{
		echo "m140407_161748_init_schema does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `omega` DEFAULT CHARACTER SET utf8 ;
CREATE SCHEMA IF NOT EXISTS `omega` DEFAULT CHARACTER SET utf8 ;
USE `omega` ;

-- -----------------------------------------------------
-- Table `omega`.`seminar`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `omega`.`seminar` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(255) NOT NULL ,
  `price` DECIMAL NOT NULL ,
  `favourite` TINYINT(1) NOT NULL ,
  `active` TINYINT(1) NOT NULL ,
  `type` ENUM('summer', 'trimester') NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `omega`.`time`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `omega`.`time` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `start_time` TIME NULL ,
  `end_time` TIME NULL ,
  `weekday` VARCHAR(45) NULL ,
  `seminar_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_time_seminar1` (`seminar_id` ASC) ,
  CONSTRAINT `fk_time_seminar1`
    FOREIGN KEY (`seminar_id` )
    REFERENCES `omega`.`seminar` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `omega`.`grade`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `omega`.`grade` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `omega`.`date_period`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `omega`.`date_period` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `start_date` DATE NOT NULL ,
  `end_date` DATE NOT NULL ,
  `description` VARCHAR(255) NULL ,
  `seminar_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_date_periods_seminar1` (`seminar_id` ASC) ,
  CONSTRAINT `fk_date_periods_seminar1`
    FOREIGN KEY (`seminar_id` )
    REFERENCES `omega`.`seminar` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `omega`.`day_off`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `omega`.`day_off` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `date` DATE NOT NULL ,
  `description` VARCHAR(255) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `omega`.`user`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `omega`.`user` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `info` TEXT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `omega`.`user_seminar`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `omega`.`user_seminar` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `user_id` INT UNSIGNED NOT NULL ,
  `seminar_id` INT UNSIGNED NOT NULL ,
  `grade_id` INT UNSIGNED NOT NULL ,
  `time_id` INT UNSIGNED NOT NULL ,
  `date_periods_id` INT UNSIGNED NOT NULL ,
  `cost` DECIMAL NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_user_seminar_user1` (`user_id` ASC) ,
  INDEX `fk_user_seminar_seminar1` (`seminar_id` ASC) ,
  INDEX `fk_user_seminar_grade1` (`grade_id` ASC) ,
  INDEX `fk_user_seminar_time1` (`time_id` ASC) ,
  INDEX `fk_user_seminar_date_periods1` (`date_periods_id` ASC) ,
  CONSTRAINT `fk_user_seminar_user1`
    FOREIGN KEY (`user_id` )
    REFERENCES `omega`.`user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_seminar_seminar1`
    FOREIGN KEY (`seminar_id` )
    REFERENCES `omega`.`seminar` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_seminar_grade1`
    FOREIGN KEY (`grade_id` )
    REFERENCES `omega`.`grade` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_seminar_time1`
    FOREIGN KEY (`time_id` )
    REFERENCES `omega`.`time` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_seminar_date_periods1`
    FOREIGN KEY (`date_periods_id` )
    REFERENCES `omega`.`date_period` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `omega`.`payments`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `omega`.`payments` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `user_id` INT NULL ,
  `amount` DECIMAL NULL ,
  `email` VARCHAR(255) NULL ,
  `name` VARCHAR(255) NULL ,
  `details` TEXT NULL ,
  `state` ENUM('pending', 'canceled', 'completed', 'failed') NULL ,
  `user_seminar_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_payments_user_seminar1` (`user_seminar_id` ASC) ,
  CONSTRAINT `fk_payments_user_seminar1`
    FOREIGN KEY (`user_seminar_id` )
    REFERENCES `omega`.`user_seminar` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `omega`.`seminar_grade`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `omega`.`seminar_grade` (
  `seminar_id` INT UNSIGNED NOT NULL ,
  `grade_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`seminar_id`, `grade_id`) ,
  INDEX `fk_seminar_has_grade_grade1` (`grade_id` ASC) ,
  INDEX `fk_seminar_has_grade_seminar1` (`seminar_id` ASC) ,
  CONSTRAINT `fk_seminar_has_grade_seminar1`
    FOREIGN KEY (`seminar_id` )
    REFERENCES `omega`.`seminar` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_seminar_has_grade_grade1`
    FOREIGN KEY (`grade_id` )
    REFERENCES `omega`.`grade` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `omega` ;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
");
	}

	public function safeDown()
	{
        $this->execute("SET foreign_key_checks = 0;
                        DROP TABLE `seminar_grade`, `payments`, `user_seminar`, `user`, `time`, `grade`, `seminar`, `date_period`, `day_off`;
                        SET foreign_key_checks = 1;");
	}

}