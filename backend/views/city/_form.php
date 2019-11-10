<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CityModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="city-model-form">

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'fieldConfig'=>[
            'template'=>"{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}"
        ],
        'options'=>[
            'enctype'=>'multipart/form-data'
        ]
    ]
    ); 
    
    ?>

    <?= $form->field($model, 'country_id')->dropDownList($arrCountry, ['prompt'=>''])?>

    <?= $form->field($model, 'city_name')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
