<?php

class m140619_122523_add_email_to_tutors_table extends CDbMigration
{
	public function up()
	{
        $this->execute("ALTER TABLE  `tutors` ADD  `email` VARCHAR( 255 ) NULL");
	}

	public function down()
	{
		echo "m140619_122523_add_email_to_tutors_table does not support migration down.\n";
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