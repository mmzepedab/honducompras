<?php

class m130826_222611_create_user_table extends CDbMigration
{
	public function up()
	{
            $this->createTable('tbl_user',
			array(
				'id'=>'pk',
				'first_name'=>'string NOT NULL',
                                'last_name'=>'string NOT NULL',
			), 'ENGINE=InnoDB');
	}

	public function down()
	{
                $this->dropTable('tbl_user');
		//echo "m130826_222611_create_user_table does not support migration down.\n";
		//return false;
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