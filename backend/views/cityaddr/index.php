<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CityaddrSearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Адреса');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cityaddr-model-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Создать адрес'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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
            [
                'attribute'=>'city_id',
                'value'=>'idCity.city_name',
                'filter'=>$arrCity
            ],
        
            //'Id',
           // 'country_id',
            //'city_id',
            'city_addr',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'visibleButtons' => [
                    'update' => \Yii::$app->user->can('admin'),
                    'delete' => \Yii::$app->user->can('admin'),
                ],
                'buttons' => [
                    'delete' => function($url, $model){
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $model->Id], [
                            'class' => '',
                            'data' => [
                                'confirm' => 'Вы уверены, что хотите удалить данный адрес?',
                                'method' => 'post',
                            ],
                        ]);
                    }
                ]
            ],
        ],
    ]); ?>


</div>
