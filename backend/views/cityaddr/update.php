<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CityaddrModel */

$this->title = Yii::t('app', '{name}', [
    'name' => $address,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Адреса'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Изменить');
?>

<div class="cityaddr-model-update">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
        'arrCountry'=>$arrCountry,
        'arrCity' =>$arrCity,
        'address'=>$address,
		'mapkey' => $mapkey,
        'view'=>false
    ]) ?>

</div>


