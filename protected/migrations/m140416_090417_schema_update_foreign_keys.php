<?php

class m140416_090417_schema_update_foreign_keys extends CDbMigration
{
/*	public function up()
	{
	}

	public function down()
	{
		echo "m140416_090417_schema_update_foreign_keys does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("
            CREATE  TABLE  `seminar` (
              `id` INT(11)  UNSIGNED NOT NULL AUTO_INCREMENT ,
              `title` VARCHAR(255) NOT NULL ,
              `price` DECIMAL NOT NULL ,
              `favourite` TINYINT(1) NOT NULL ,
              `active` TINYINT(1) NOT NULL ,
              `type` ENUM('summer', 'trimester') NULL ,
              PRIMARY KEY (`id`) )
            ENGINE = InnoDB;
          ");

        $this->execute("
            CREATE  TABLE  `time` (
              `id` INT(11)  UNSIGNED NOT NULL AUTO_INCREMENT ,
              `start_time` TIME NULL ,
              `end_time` TIME NULL ,
              `weekday` VARCHAR(45) NULL ,
              `seminar_id` INT(11)  UNSIGNED NOT NULL ,
              PRIMARY KEY (`id`) ,
              INDEX `fk_time_seminar1` (`seminar_id` ASC) ,
              CONSTRAINT `fk_time_seminar1`
                FOREIGN KEY (`seminar_id` )
                REFERENCES  `seminar` (`id` )
                ON DELETE CASCADE
                ON UPDATE NO ACTION)
            ENGINE = InnoDB;
        ");

        $this->execute("
            CREATE  TABLE  `grade` (
              `id` INT(11)  UNSIGNED NOT NULL AUTO_INCREMENT ,
              `title` VARCHAR(255) NOT NULL ,
              PRIMARY KEY (`id`) )
            ENGINE = InnoDB;
        ");


        $this->execute("
            CREATE  TABLE  `date_period` (
              `id` INT(11)  UNSIGNED NOT NULL AUTO_INCREMENT ,
              `start_date` DATE NOT NULL ,
              `end_date` DATE NOT NULL ,
              `description` VARCHAR(255) NULL ,
              `seminar_id` INT(11)  UNSIGNED NOT NULL ,
              PRIMARY KEY (`id`) ,
              INDEX `fk_date_periods_seminar1` (`seminar_id` ASC) ,
              CONSTRAINT `fk_date_periods_seminar1`
                FOREIGN KEY (`seminar_id` )
                REFERENCES  `seminar` (`id` )
                ON DELETE CASCADE
                ON UPDATE NO ACTION)
            ENGINE = InnoDB;
        ");


        $this->execute("
            CREATE  TABLE  `day_off` (
              `id` INT(11)  UNSIGNED NOT NULL AUTO_INCREMENT ,
              `date` DATE NOT NULL ,
              `description` VARCHAR(255) NULL ,
              PRIMARY KEY (`id`) )
            ENGINE = InnoDB;
        ");

        $this->execute("
            CREATE  TABLE  `user` (
              `id` INT(11)  UNSIGNED NOT NULL AUTO_INCREMENT ,
              `info` TEXT NULL ,
              PRIMARY KEY (`id`) )
            ENGINE = InnoDB;
        ");


        $this->execute("
            CREATE  TABLE  `user_seminar` (
              `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
              `user_id` INT(11)  UNSIGNED NOT NULL ,
              `seminar_id` INT(11)  UNSIGNED NOT NULL ,
              `grade_id` INT(11)  UNSIGNED NOT NULL ,
              `time_id` INT(11)  UNSIGNED NOT NULL ,
              `date_periods_id` INT(11)  UNSIGNED NOT NULL ,
              `cost` DECIMAL NULL ,
              PRIMARY KEY (`id`) ,
              INDEX `fk_user_seminar_user1` (`user_id` ASC) ,
              INDEX `fk_user_seminar_seminar1` (`seminar_id` ASC) ,
              INDEX `fk_user_seminar_grade1` (`grade_id` ASC) ,
              INDEX `fk_user_seminar_time1` (`time_id` ASC) ,
              INDEX `fk_user_seminar_date_periods1` (`date_periods_id` ASC) ,
              CONSTRAINT `fk_user_seminar_user1`
                FOREIGN KEY (`user_id` )
                REFERENCES  `user` (`id` )
                ON DELETE CASCADE
                ON UPDATE NO ACTION,
              CONSTRAINT `fk_user_seminar_seminar1`
                FOREIGN KEY (`seminar_id` )
                REFERENCES  `seminar` (`id` )
                ON DELETE CASCADE
                ON UPDATE NO ACTION,
              CONSTRAINT `fk_user_seminar_grade1`
                FOREIGN KEY (`grade_id` )
                REFERENCES  `grade` (`id` )
                ON DELETE CASCADE
                ON UPDATE NO ACTION,
              CONSTRAINT `fk_user_seminar_time1`
                FOREIGN KEY (`time_id` )
                REFERENCES  `time` (`id` )
                ON DELETE CASCADE
                ON UPDATE NO ACTION,
              CONSTRAINT `fk_user_seminar_date_periods1`
                FOREIGN KEY (`date_periods_id` )
                REFERENCES  `date_period` (`id` )
                ON DELETE CASCADE
                ON UPDATE NO ACTION)
            ENGINE = InnoDB;
        ");

        $this->execute("
            CREATE  TABLE  `payments` (
              `id` INT(11)  UNSIGNED NOT NULL AUTO_INCREMENT ,
              `user_id` INT(11)  NULL ,
              `amount` DECIMAL NULL ,
              `email` VARCHAR(255) NULL ,
              `name` VARCHAR(255) NULL ,
              `details` TEXT NULL ,
              `state` ENUM('pending', 'canceled', 'completed', 'failed') NULL ,
              `user_seminar_id` INT(11)  UNSIGNED ,
              PRIMARY KEY (`id`) ,
              INDEX `fk_payments_user_seminar1` (`user_seminar_id` ASC) ,
              CONSTRAINT `fk_payments_user_seminar1`
                FOREIGN KEY (`user_seminar_id` )
                REFERENCES  `user_seminar` (`id` )
                ON DELETE SET NULL
                ON UPDATE NO ACTION)
            ENGINE = InnoDB;
        ");


        $this->execute("
            CREATE  TABLE  `seminar_grade` (
              `seminar_id` INT(11)  UNSIGNED NOT NULL ,
              `grade_id` INT(11)  UNSIGNED NOT NULL ,
              PRIMARY KEY (`seminar_id`, `grade_id`) ,
              INDEX `fk_seminar_has_grade_grade1` (`grade_id` ASC) ,
              INDEX `fk_seminar_has_grade_seminar1` (`seminar_id` ASC) ,
              CONSTRAINT `fk_seminar_has_grade_seminar1`
                FOREIGN KEY (`seminar_id` )
                REFERENCES  `seminar` (`id` )
                ON DELETE CASCADE
                ON UPDATE NO ACTION,
              CONSTRAINT `fk_seminar_has_grade_grade1`
                FOREIGN KEY (`grade_id` )
                REFERENCES  `grade` (`id` )
                ON DELETE CASCADE
                ON UPDATE NO ACTION)
            ENGINE = InnoDB;
        ");

        $this->execute("
            CREATE  TABLE  `applicant` (
              `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
              `name` VARCHAR(255) NOT NULL ,
              `phone` VARCHAR(255) NOT NULL ,
              `email` VARCHAR(255) NOT NULL ,
              `cv` VARCHAR(255) NOT NULL ,
              PRIMARY KEY (`id`) )
            ENGINE = InnoDB
            AUTO_INCREMENT = 30
            DEFAULT CHARACTER SET = utf8;
        ");

	}

	public function safeDown()
	{
        $this->execute("SET foreign_key_checks = 0;
                        DROP TABLE `seminar_grade`, `payments`, `user_seminar`, `user`, `time`, `grade`, `seminar`, `date_period`, `day_off`, `applicant`;
                        SET foreign_key_checks = 1;");
	}

}