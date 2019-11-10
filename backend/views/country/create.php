<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CountryModel */

$this->title = Yii::t('app', 'Создать страну');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Country Models'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="country-model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        
    ]) ?>

</div>
