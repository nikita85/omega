<?php

class m140516_110028_add_primary_key_to_forms extends CDbMigration
{
	public function up()
	{
            $this->execute("
                    ALTER TABLE enroll_form_hillview ADD PRIMARY KEY(enroll_form_id)
            ");

            $this->execute("
                    ALTER TABLE enroll_form_knoll    ADD PRIMARY KEY(enroll_form_id)
            ");
            
            $this->execute("
                    ALTER TABLE enroll_form_summer   ADD PRIMARY KEY(enroll_form_id)
            ");

	}

	public function down()
	{
		echo "m140516_110028_add_primary_key_to_forms does not support migration down.\n";
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