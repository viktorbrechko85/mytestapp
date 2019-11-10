<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "country".
 *
 * @property int $c_id
 * @property string $c_code
 * @property string $c_name
 * @property string $alias
 */
class CountryModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'country';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['c_name'], 'required'],
            [['c_code'], 'string', 'max' => 2],
            [['c_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'c_id' => Yii::t('app', 'C ID'),
            'c_code' => Yii::t('app', 'Код'),
            'c_name' => Yii::t('app', 'Страна'),
        ];
    }
}
