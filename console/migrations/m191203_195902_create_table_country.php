<?php

use yii\db\Migration;

/**
 * Class m191203_195901_create_table_country
 */
class m191203_195902_create_table_country extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%country}}', [
            'c_id' => $this->primaryKey(),
            'c_code' => $this->string(2),
            'c_name' => $this->string(255),
        ], $tableOptions);
  

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%country}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191203_195901_create_table_country cannot be reverted.\n";

        return false;
    }
    */
}
