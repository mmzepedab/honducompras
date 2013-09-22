<?php

class m130921_181149_add_institution_id_to_issue extends CDbMigration
{
	public function up()
	{
               $this->addColumn('tbl_issue','institution_id','int DEFAULT NULL');
	}

	public function down()
	{
		$this->dropColumn('tbl_issue','institution_id');
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