<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cityaddr".
 *
 * @property int $Id
 * @property int $country_id
 * @property int $city_id
 * @property string $city_addr
 */
class CityaddrModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cityaddr';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['country_id', 'city_id', 'city_addr', 'city_addr_full'], 'required'],
            [['country_id', 'city_id'], 'integer'],
            [['city_addr', 'city_addr_full'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => Yii::t('app', 'ID'),
            'country_id' => Yii::t('app', 'Страна'),
            'city_id' => Yii::t('app', 'Город'),
            'city_addr' => Yii::t('app', 'Адрес'),
            'city_addr_full' => Yii::t('app', 'Полный адрес'),
        ];
    }

    public function getIdCountry(){
        return $this->hasOne(CountryModel::className(), ['c_id'=>'country_id']);
    }

    public function getIdCity(){
        return $this->hasOne(CityModel::className(), ['city_id'=>'city_id']);
    }
}
