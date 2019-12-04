<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%city}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%country}}`
 */
class m191203_195911_create_city_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%city}}', [
            'city_id' => $this->primaryKey(),
            'country_id' => $this->integer(),
            'city_name' => $this->string(255),
        ]);

        // creates index for column `country_id`
        $this->createIndex(
            '{{%idx-city-country_id}}',
            '{{%city}}',
            'country_id'
        );

        // add foreign key for table `{{%country}}`
        $this->addForeignKey(
            '{{%fk-city-country_id}}',
            '{{%city}}',
            'country_id',
            '{{%country}}',
            'c_id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%country}}`
        $this->dropForeignKey(
            '{{%fk-city-country_id}}',
            '{{%city}}'
        );

        // drops index for column `country_id`
        $this->dropIndex(
            '{{%idx-city-country_id}}',
            '{{%city}}'
        );

        $this->dropTable('{{%city}}');
    }
}
