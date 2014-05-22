<?php

class m140522_133021_new_tutors_tables extends CDbMigration
{
	public function up()
	{
        $this->execute("
                    CREATE  TABLE IF NOT EXISTS `omega`.`tutors` (
                      `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
                      `name` VARCHAR(255) NOT NULL ,
                      `subjects` VARCHAR(255) NULL DEFAULT NULL ,
                      `expirience` TEXT NULL DEFAULT NULL ,
                      `education` VARCHAR(255) NULL DEFAULT NULL ,
                      `active` TINYINT(1) NOT NULL DEFAULT '1' ,
                      PRIMARY KEY (`id`) )
                    ENGINE = InnoDB
                    DEFAULT CHARACTER SET = utf8
                    COLLATE = utf8_general_ci;
        ");

        $this->execute("
                    CREATE  TABLE IF NOT EXISTS `omega`.`tutors_days_times` (
                      `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
                      `weekday` TINYINT(1) NOT NULL ,
                      `start_time` TIME NOT NULL ,
                      `end_time` TIME NOT NULL ,
                      `tutors_id` INT(11) UNSIGNED NOT NULL ,
                      PRIMARY KEY (`id`) ,
                      INDEX `fk_tutors_days_times_tutors1` (`tutors_id` ASC) ,
                      CONSTRAINT `fk_tutors_days_times_tutors1`
                        FOREIGN KEY (`tutors_id` )
                        REFERENCES `omega`.`tutors` (`id` )
                        ON DELETE CASCADE
                        ON UPDATE NO ACTION)
                    ENGINE = InnoDB
                    DEFAULT CHARACTER SET = utf8
                    COLLATE = utf8_general_ci;
        ");

        $this->execute("
                    CREATE  TABLE IF NOT EXISTS `omega`.`tutor_students` (
                      `id` INT(11) NOT NULL ,
                      `first_name` VARCHAR(255) NOT NULL ,
                      `second_name` VARCHAR(255) NOT NULL ,
                      `phone` VARCHAR(255) NOT NULL ,
                      `email` VARCHAR(255) NOT NULL ,
                      `alternative_time` VARCHAR(255) NULL DEFAULT NULL ,
                      `other_requests` TEXT NULL DEFAULT NULL ,
                      `tutors_days_times_id` INT(11) UNSIGNED NOT NULL ,
                      `tutors_id` INT(11) UNSIGNED NOT NULL ,
                      PRIMARY KEY (`id`) ,
                      INDEX `fk_tutor_students_tutors_days_times1` (`tutors_days_times_id` ASC) ,
                      INDEX `fk_tutor_students_tutors1` (`tutors_id` ASC) ,
                      CONSTRAINT `fk_tutor_students_tutors_days_times1`
                        FOREIGN KEY (`tutors_days_times_id` )
                        REFERENCES `omega`.`tutors_days_times` (`id` )
                        ON DELETE NO ACTION
                        ON UPDATE NO ACTION,
                      CONSTRAINT `fk_tutor_students_tutors1`
                        FOREIGN KEY (`tutors_id` )
                        REFERENCES `omega`.`tutors` (`id` )
                        ON DELETE NO ACTION
                        ON UPDATE NO ACTION)
                    ENGINE = InnoDB
                    DEFAULT CHARACTER SET = utf8
                    COLLATE = utf8_general_ci;
        ");

	}

	public function down()
	{
		$this->execute("DROP table tutor_students, DROP table tutors_days_times, DROP table tutors");
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}