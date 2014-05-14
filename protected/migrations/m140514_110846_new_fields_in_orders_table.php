<?php

class m140514_110846_new_fields_in_orders_table extends CDbMigration
{
	public function up()
	{
            $this->execute("
                    ALTER TABLE orders ADD created DATETIME NULL AFTER payment_status
            ");

            $this->execute("
                    ALTER TABLE orders ADD last_update DATETIME NULL AFTER created
            ");

            $this->execute("
                    ALTER TABLE orders ADD payer_email VARCHAR(255) NULL AFTER last_update
            ");

            $this->execute("
                    ALTER TABLE orders ADD transaction_id VARCHAR(45) NULL AFTER payer_email
            ");
	}

	public function down()
	{
		echo "m140514_110846_new_fields_in_orders_table does not support migration down.\n";
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