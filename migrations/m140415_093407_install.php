<?php

use yii\db\Schema;

class m140415_093407_install extends \yii\db\Migration
{
    public function up()
    {
    	$tableOptions = null;
    	if ($this->db->driverName === 'mysql') {
    		$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
    	}
    	// employees
    	$this->createTable('{{%employee}}',[
    				'id' => Schema::TYPE_STRING,
    				'name' => Schema::TYPE_STRING,
    				'dob' => Schema::TYPE_DATE,
    				'address' => Schema::TYPE_TEXT,
    				'email' => Schema::TYPE_STRING,
    				'photo' => Schema::TYPE_STRING,
    				'sex' => Schema::TYPE_BOOLEAN,
    				'telephone' => Schema::TYPE_STRING,
    				'nationality' => Schema::TYPE_STRING,
    				'created_at' => Schema::TYPE_INTEGER,
    				'updated_at' => Schema::TYPE_INTEGER,
    				'created_by' => Schema::TYPE_INTEGER,
    				'updated_by' => Schema::TYPE_INTEGER,
    			], $tableOptions);
    	$this->createIndex('idx_id', '{{%employee}}', ['id'], true);

    	// e_certificate
    	$this->createTable('{{%e_certificate}}',[
    				'e_id' => Schema::TYPE_STRING,
    				'degree' => Schema::TYPE_STRING,
    				'year' => Schema::TYPE_INTEGER,
    				'certificated_by' => Schema::TYPE_STRING,
    				'created_at' => Schema::TYPE_INTEGER,
    				'updated_at' => Schema::TYPE_INTEGER,
    			], $tableOptions);
    	$this->createIndex('idx_cert_emp', '{{%e_certificate}}', ['e_id']);
    	$this->createIndex('idx_cert', '{{%e_certificate}}', ['e_id', 'degree', 'year', 'certificated_by'], true);
    	$this->addForeignKey('fk_cert_emp', '{{%e_certifcate}}', 'e_id', '{{%employee}}', 'id');
    }

    public function down()
    {
    	$this->dropTable('{{%e_certificate}}');
    	$this->dropTable('{{%employee}}');
    }
}
