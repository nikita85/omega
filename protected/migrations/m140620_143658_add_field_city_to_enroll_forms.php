<?php

class m140620_143658_add_field_city_to_enroll_forms extends CDbMigration
{
	public function up()
	{
        $this->execute("ALTER TABLE  `enroll_form_hillview` ADD  `city` VARCHAR( 255 ) NOT NULL AFTER  `address`");
        $this->execute("ALTER TABLE  `enroll_form_knoll` ADD  `city` VARCHAR( 255 ) NOT NULL AFTER  `address`");
        $this->execute("ALTER TABLE  `enroll_form_summer` ADD  `city` VARCHAR( 255 ) NOT NULL AFTER  `student_address`");
	}

	public function down()
	{
		echo "m140620_143658_add_field_city_to_enroll_forms does not support migration down.\n";
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