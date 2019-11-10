<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "city".
 *
 * @property int $city_id
 * @property int $country_id
 * @property string $city_name
 * @property string $alias
 */
class CityModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['country_id', 'city_name'], 'required'],
            [['country_id'], 'integer'],
            [['city_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'city_id' => Yii::t('app', 'City ID'),
            'country_id' => Yii::t('app', 'Страна'),
            'city_name' => Yii::t('app', 'Город'),
        ];
    }

    public function getIdCountry(){
        return $this->hasOne(CountryModel::className(), ['c_id'=>'country_id']);
    }
}
