<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CityaddrModel */

$this->title = Yii::t('app', '{name}', [
    'name' => $model->city_addr,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Адреса'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Создание');
?>

<div class="cityaddr-model-create">
<h1><?= Html::encode($this->title) ?></h1>
<?= $this->render('_form', [
        'model' => $model,
        'arrCountry'=>$arrCountry,
        'arrCity' =>$arrCity,
        'address' => $address,
        'view'=>false
    ]) ?>
	
</div>


  
    
    
 