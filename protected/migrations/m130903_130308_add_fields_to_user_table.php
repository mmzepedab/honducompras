<?php

class m130903_130308_add_fields_to_user_table extends CDbMigration
{
	public function up()
	{   
            $this->addColumn('tbl_user','username','VARCHAR(255) NOT NULL AFTER `id` ');
            $this->addColumn('tbl_user','email','VARCHAR(255) NOT NULL AFTER `username` ');
            $this->addColumn('tbl_user','is_help_desk','int(1) NOT NULL DEFAULT 0 ');
            $this->addColumn('tbl_user','password_hash','CHAR(64) NOT NULL ');
            $this->createIndex('username', 'tbl_user', 'username', true);
            $this->createIndex('email', 'tbl_user', 'email', true);
	}

	public function down()
	{                
                $this->dropIndex('username','tbl_user');
                $this->dropIndex('email','tbl_user');
		$this->dropColumn('tbl_user','username');
                $this->dropColumn('tbl_user','email');
                $this->dropColumn('tbl_user','is_help_desk');
                $this->dropColumn('tbl_user','password_hash');
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