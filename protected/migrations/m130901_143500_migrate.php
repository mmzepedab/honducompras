<?php

class m130901_143500_migrate extends CDbMigration
{
	public function up()
	{
            $this->createTable('tbl_issue_reception_type',
			array(
				'id'=>'pk',
				'name'=>'string NOT NULL',
			), 'ENGINE=InnoDB');
            $this->addColumn('tbl_issue','reception_type_id','int(11) DEFAULT NULL');
            $this->addForeignKey('FK_reception_type', 'tbl_issue', 'reception_type_id', 'tbl_issue_reception_type', 'id', 'CASCADE', 'CASCADE');
	}

	public function down()
	{
            $this->dropForeignKey('FK_reception_type','tbl_issue');
            $this->dropTable('tbl_issue_reception_type');
            $this->dropColumn('tbl_issue','reception_type_id');

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