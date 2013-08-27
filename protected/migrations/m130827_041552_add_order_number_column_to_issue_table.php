<?php

class m130827_041552_add_order_number_column_to_issue_table extends CDbMigration
{
	public function up()
	{   
                $this->addColumn('tbl_issue','order_number','int(4) ZEROFILL DEFAULT NULL');
	}

	public function down()
	{
		$this->dropColumn('tbl_issue','order_number');
		//echo "m130608_174906_add_department_id_column_to_question_table does not support migration down.\n";
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