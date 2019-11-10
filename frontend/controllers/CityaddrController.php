<?php

namespace frontend\controllers;
use common\models\CityaddrModel;
use yii\helpers\Json;

class CityaddrController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLists($id){
        /*$countCities = CityModel::find()
                    ->where(['country_id'=>$id])
                    ->count();*/
        $citiesaddrs = CityaddrModel::find()
                    ->where(['city_id'=>$id])
                    ->orderby('city_addr')
                    ->all();
        if(count($citiesaddrs)>0){
            echo "<option>Выбрать адрес...</option>";
            foreach($citiesaddrs as $citiesaddr){
                echo "<option value='".$citiesaddr->Id."'>".$citiesaddr->city_addr."</option>";
            }
        }
        else{
            echo "<option>-</option>";
        }
    }

    public function actionLists2($id){
        $citiesaddrs = CityaddrModel::find()
                    ->where(['city_id'=>$id])
                    ->select(['city_addr_full'])
                    ->asArray()
                    ->all();
                    
        if(count($citiesaddrs)>0){
            echo Json::encode([$citiesaddrs]);
            return;
        }
        else{
            echo Json::encode(['output'=>'', 'selected'=>'']);
        }
        
    }

    

}
