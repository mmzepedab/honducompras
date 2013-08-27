<?php

class m130827_005620_create_category_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('tbl_category',
			array(
				'id'=>'pk',
				'name'=>'string NOT NULL',
			), 'ENGINE=InnoDB');
	}

	public function down()
	{
		$this->dropTable('tbl_category');
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