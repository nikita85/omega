<?php

class m140603_132222_new_table_month_puzzle_participanr extends CDbMigration
{
	public function up()
	{
        $this->execute("
            CREATE  TABLE IF NOT EXISTS `omega`.`month_puzzle_participant` (
              `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
              `email` VARCHAR(255) NOT NULL ,
              `created` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
              PRIMARY KEY (`id`) )
            ENGINE = InnoDB
            DEFAULT CHARACTER SET = utf8
            COLLATE = utf8_general_ci;
        ");
	}

	public function down()
	{
		echo "m140603_132222_new_table_month_puzzle_participanr does not support migration down.\n";
		return false;
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