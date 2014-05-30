<?php

class m140523_152331_add_images_fields_to_tutors_table extends CDbMigration
{
	public function up()
	{
        $this->execute("
            ALTER TABLE  `tutors` ADD  `big_image` VARCHAR( 255 ) NOT NULL ,
            ADD  `small_image` VARCHAR( 255 ) NOT NULL
        ");
	}

	public function down()
	{
		$this->execute("
		ALTER TABLE `tutors`
          DROP `big_image`,
          DROP `small_image`;
  ");
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