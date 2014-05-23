<?php

class m140523_145045_seminars_table_update extends CDbMigration
{
	public function up()
	{
            $this->execute("
                    UPDATE `omega`.`seminar` SET `description` = `title` WHERE `title` NOT IN('knoll', 'hillview')
            ");
	}

	public function down()
	{
		echo "m140523_145045_seminars_table_update does not support migration down.\n";
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