<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CountryModel */

$this->title = Yii::t('app', '{name}', [
    'name' => $model->c_name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Страны'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->c_id, 'url' => ['update', 'id' => $model->c_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Изменить');
?>
<div class="country-model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
