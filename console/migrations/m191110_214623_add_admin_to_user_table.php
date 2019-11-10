<?php
use common\models\User;
use yii\db\Migration;

/**
 * Class m191110_214623_add_admin_to_user_table
 */
class m191110_214623_add_admin_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $transaction = $this->getDb()->beginTransaction();
        $user = \Yii::createObject([
            'class'    => User::className(),
            'email'    => 'admin@example.com',
            'username' => 'admin',
            'password' => 'adminadmin',
            'status'   => 10,
            'auth_key' => 'adminadmin',
        ]);
        if (!$user->insert(false)) {
            $transaction->rollBack();
            return false;
        }
        $user->save();
        $transaction->commit();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191110_214623_add_admin_to_user_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191110_214623_add_admin_to_user_table cannot be reverted.\n";

        return false;
    }
    */
}
