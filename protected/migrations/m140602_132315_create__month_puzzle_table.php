<?php

class m140602_132315_create__month_puzzle_table extends CDbMigration
{
	public function up()
	{
        $this->execute("
                CREATE  TABLE IF NOT EXISTS `omega`.`month_puzzle` (
                  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
                  `month` VARCHAR(45) NOT NULL ,
                  `title` VARCHAR(255) NOT NULL ,
                  `question` TEXT NOT NULL ,
                  `answer` TEXT NOT NULL ,
                  `active` TINYINT(1) NOT NULL DEFAULT '0' ,
                  PRIMARY KEY (`id`) )
                ENGINE = InnoDB
                DEFAULT CHARACTER SET = utf8
                COLLATE = utf8_general_ci;
        ");
	}

	public function down()
	{
		$this->execute("DROP table `month_puzzle`");
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