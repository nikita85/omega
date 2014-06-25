<?php

class m140625_153511_add_created_field_to_oak_and_hillview_forms extends CDbMigration
{
	public function up()
	{
        $this->execute("ALTER TABLE  `enroll_form_knoll` ADD  `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP");
        $this->execute("ALTER TABLE  `enroll_form_hillview` ADD  `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP");
	}

	public function down()
	{
		echo "m140625_153511_add_created_field_to_oak_and_hillview_forms does not support migration down.\n";
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