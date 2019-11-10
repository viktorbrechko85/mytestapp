<?php

namespace frontend\controllers;
use common\models\{
    CityModel,
    CountryModel
};

class CityController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    

    public function actionLists($id){
        $countCities = CityModel::find()
                    ->where(['country_id'=>$id])
                    ->count();
        $cities = CityModel::find()
                    ->where(['country_id'=>$id])
                    ->orderby('city_name')
                    ->all();
        if($countCities>0){
            echo "<option>Выбрать город...</option>";
            foreach($cities as $city){
                echo "<option value='".$city->city_id."'>".$city->city_name."</option>";
            }
        }
        else{
            echo "<option>-</option>";
        }
    }

    

}
