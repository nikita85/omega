<?php

class m140417_144641_add_field_created_in_applicant_and_user_tables extends CDbMigration
{
/*	public function up()
	{
	}

	public function down()
	{
		echo "m140417_144641_add_field_created_in_applicant_and_user_tables does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("
            ALTER TABLE  `applicant` ADD  `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        ");

        $this->execute("
            ALTER TABLE  `user` ADD  `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        ");
	}

	public function safeDown()
	{
        $this->execute("
            ALTER TABLE `applicant` DROP `created`
        ");

        $this->execute("
            ALTER TABLE `user` DROP `created`
        ");
	}

}