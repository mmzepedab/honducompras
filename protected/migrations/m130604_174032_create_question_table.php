<?php

class m130604_174032_create_question_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('tbl_question',
			array(
				'id'=>'pk',
				'title'=>'string NOT NULL',
				'answer'=>'text NOT NULL',
				'create_time'=>'datetime DEFAULT NULL',
				'create_user'=>'string DEFAULT NULL',
				'update_user'=>'string DEFAULT NULL',
			), 'ENGINE=InnoDB');
	}

	public function down()
	{
		$this->dropTable('tbl_question');
		//echo "m130604_174032_create_question_table does not support migration down.\n";
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