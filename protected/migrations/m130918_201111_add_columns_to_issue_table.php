<?php

class m130918_201111_add_columns_to_issue_table extends CDbMigration
{
	public function up()
	{
            $this->addColumn('tbl_issue','description','text NOT NULL DEFAULT \'\'');
            $this->addColumn('tbl_issue','update_time','datetime DEFAULT NULL');
            $this->addColumn('tbl_issue','attachment','string DEFAULT NULL');
	}

	public function down()
	{
		$this->dropColumn('tbl_issue','description');
                $this->dropColumn('tbl_issue','update_time');
                $this->dropColumn('tbl_issue','attachment');
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