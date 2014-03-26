<?php

class m140324_124217_create_applicant_table extends CDbMigration
{
    public function up()
    {

        $this->execute("CREATE TABLE `applicant` (
             `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
             `name` varchar(255) NOT NULL,
             `phone` varchar(255) NOT NULL,
             `email` varchar(255) NOT NULL,
             `cv` varchar(255) NOT NULL,
             PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8
            ");
    }

    public function down()
    {
        $this->execute("DROP TABLE `applicant`");
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