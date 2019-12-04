<?php

use common\models\CountryModel;
use yii\db\Migration;

/**
 * Class m191203_200104_add_data_into_country
 */
class m191203_200104_add_data_into_country extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $transaction = $this->getDb()->beginTransaction();
        $obj = \Yii::createObject([
            'class'    => CountryModel::className(),
            'c_code' => 'UA',
            'c_name' => 'Украина',
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
        echo "m191203_200104_add_data_into_country cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191203_200104_add_data_into_country cannot be reverted.\n";

        return false;
    }
    */
}
