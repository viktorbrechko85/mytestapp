<?php

use common\models\CityaddrModel;
use yii\db\Migration;

/**
 * Class m191203_214735_add_datainto_Cityaddr_table
 */
class m191203_214735_add_datainto_Cityaddr_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $transaction = $this->getDb()->beginTransaction();
        $obj = \Yii::createObject([
            'class'    => CityaddrModel::className(),
            'country_id'    => 1,
            'city_id'    => 1,
            'city_addr' => 'бул. Шевченко, 274',
            'city_addr_full' => 'Украина, Мариуполь, бул. Шевченко, 274',
        ]);
        if (!$obj->insert(false)) {
            $transaction->rollBack();
            return false;
        }
        $obj->save();
        $transaction->commit();
    
        $transaction = $this->getDb()->beginTransaction();
        $obj = \Yii::createObject([
            'class'    => CityaddrModel::className(),
            'country_id'    => 1,
            'city_id'    => 1,
            'city_addr' => 'Запорожское шоссе, 1',
            'city_addr_full' => 'Украина, Мариуполь, Запорожское шоссе, 1',
        ]);
        if (!$obj->insert(false)) {
            $transaction->rollBack();
            return false;
        }
        $obj->save();
        $transaction->commit();

        $transaction = $this->getDb()->beginTransaction();
        $obj = \Yii::createObject([
            'class'    => CityaddrModel::className(),
            'country_id'    => 1,
            'city_id'    => 2,
            'city_addr' => 'ул. Дерибасовская, 1',
            'city_addr_full' => 'Украина, Одесса, ул. Дерибасовская, 1',
        ]);
        if (!$obj->insert(false)) {
            $transaction->rollBack();
            return false;
        }
        $obj->save();
        $transaction->commit();

        $transaction = $this->getDb()->beginTransaction();
        $obj = \Yii::createObject([
            'class'    => CityaddrModel::className(),
            'country_id'    => 1,
            'city_id'    => 2,
            'city_addr' => 'ул. Пушкинская, 13',
            'city_addr_full' => 'Украина, Одесса, ул. Пушкинская, 13',
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
        echo "m191203_214735_add_datainto_Cityaddr_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191203_214735_add_datainto_Cityaddr_table cannot be reverted.\n";

        return false;
    }
    */
}
