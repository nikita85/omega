<?php

class m140530_122314_alter_tutor_student_table extends CDbMigration
{
	public function up()
	{
        $this->execute("ALTER TABLE  `tutor_students` CHANGE  `id`  `id` INT( 11 ) UNSIGNED NOT NULL AUTO_INCREMENT");
	}

	public function down()
	{
		echo "m140530_122314_alter_tutor_student_table does not support migration down.\n";
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