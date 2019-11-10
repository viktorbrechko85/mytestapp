<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CitySearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Города';//Yii::t('app', 'City Models');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="city-model-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
    </p>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'country_id',
                'value'=>'idCountry.c_name',
                'filter'=>$arrCountry
            ],    

            //'city_id',
            //'country_id',
            'city_name',
           

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'visibleButtons' => [
                    'update' => \Yii::$app->user->can('admin'),
                    'delete' => \Yii::$app->user->can('admin'),
                ],
                'buttons' => [
                    'delete' => function($url, $model){
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $model->city_id], [
                            'class' => '',
                            'data' => [
                                'confirm' => 'Вы уверены, что хотите удалить данный город?',
                                'method' => 'post',
                            ],
                        ]);
                    }
                ]
            ],
        ],
    ]); ?>


</div>
