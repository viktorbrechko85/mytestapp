<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%Cityaddr}}`.
 */
class m191203_195912_create_Cityaddr_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cityaddr}}', [
            'Id' => $this->primaryKey(),
            'country_id' => $this->integer()->notNull(),
            'city_id' => $this->integer()->notNull(),
            'city_addr' => $this->string(255),
            'city_addr_full' => $this->string(255),
        ]);

        // creates index for column `country_id`
        $this->createIndex(
            '{{%idx-cityaddr-country_id}}',
            '{{%cityaddr}}',
            'country_id'
        );

        // add foreign key for table `{{%country}}`
        $this->addForeignKey(
            '{{%fk-cityaddr-country_id}}',
            '{{%cityaddr}}',
            'country_id',
            '{{%country}}',
            'c_id',
            'CASCADE'
        );

        // creates index for column `city_id`
        $this->createIndex(
            '{{%idx-cityaddr-city_id}}',
            '{{%cityaddr}}',
            'city_id'
        );

        // add foreign key for table `{{%city}}`
        $this->addForeignKey(
            '{{%fk-cityaddr-city_id}}',
            '{{%cityaddr}}',
            'city_id',
            '{{%city}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%Cityaddr}}');
    }
}
