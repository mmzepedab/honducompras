<?php

class m130826_143027_create_issue_table extends CDbMigration
{
	public function up()
	{
            $this->createTable('tbl_issue',
			array(
				'id'=>'pk',
				'ticket_number'=>'string NOT NULL',
				'assigned_to'=>'string NOT NULL',
                                'institution_name'=>'string NOT NULL',
                                'contact_number'=>'string NOT NULL',
                                'contact_email'=>'string NOT NULL',
                                'status'=>'string NOT NULL',
				'create_time'=>'datetime DEFAULT NULL',
				'create_user'=>'string DEFAULT NULL',
				'update_user'=>'string DEFAULT NULL',
			), 'ENGINE=InnoDB');
	}

	public function down()
	{
		$this->dropTable('tbl_issue');
                //echo "m130826_143027_create_issue_table does not support migration down.\n";
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