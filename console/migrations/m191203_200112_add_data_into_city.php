<?php

use common\models\CityModel;
use yii\db\Migration;

/**
 * Class m191203_200112_add_data_into_city
 */
class m191203_200112_add_data_into_city extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $transaction = $this->getDb()->beginTransaction();
        $obj = \Yii::createObject([
            'class'    => CityModel::className(),
            'country_id'    => 1,
            'city_name' => 'Мариуполь',
        ]);
        if (!$obj->insert(false)) {
            $transaction->rollBack();
            return false;
        }
        $obj->save();
        $transaction->commit();
    
        $transaction = $this->getDb()->beginTransaction();
        $obj = \Yii::createObject([
            'class'    => CityModel::className(),
            'country_id'    => 1,
            'city_name' => 'Одесса',
        ]);
        if (!$obj->insert(false)) {
            $transaction->rollBack();
            return false;
        }
        $obj->save();
        $transaction->commit();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191203_200112_add_data_into_city cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191203_200112_add_data_into_city cannot be reverted.\n";

        return false;
    }
    */
}
