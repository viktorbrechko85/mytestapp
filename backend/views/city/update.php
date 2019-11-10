<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CityModel */

$this->title = Yii::t('app', '{name}', [
    'name' => $model->city_name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Города'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->city_id, 'url' => ['update', 'id' => $model->city_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Изменить');
?>
<div class="city-model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'arrCountry'=>$arrCountry,
    ]) ?>

</div>
