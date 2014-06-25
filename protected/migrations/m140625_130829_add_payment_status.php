<?php

class m140625_130829_add_payment_status extends CDbMigration
{
	public function up()
	{
        $this->execute("ALTER TABLE  `orders` CHANGE  `payment_status`  `payment_status` ENUM(  'pending',  'canceled',  'completed',  'failed',  'completed_by_check' ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL");
	}

	public function down()
	{
		echo "m140625_130829_add_payment_status does not support migration down.\n";
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