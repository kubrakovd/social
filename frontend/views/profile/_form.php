<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\datepicker

/* @var $this yii\web\View */
/* @var $model common\models\Profile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'middlename')->textInput(['maxlength' => true]) ?>

    <?php
    echo 'Birth Date';
    echo DatePicker::widget([
        'name' => 'dp_1',
        'type' => DatePicker::TYPE_INPUT,
        'value' => '23-Feb-1982',
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'dd-M-yyyy'
        ]
    ]);
    ?>

    <?= $form->field($model, 'country_id')->textInput() ?>

    <?= $form->field($model, 'region_id')->textInput() ?>

    <?= $form->field($model, 'city_id')->textInput() ?>

    <?= $form->field($model, 'gender')->dropDownList(Yii::$app->params['gender']) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'hobby')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'education_type')->dropDownList(Yii::$app->params['education_type']) ?>

    <?= $form->field($model, 'education_info')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'marriage_status')->dropDownList(Yii::$app->params['marriage_status']) ?>

    <?= $form->field($model, 'has_children')->dropDownList(['0'=>Yii::t('app', 'No'),'1'=>Yii::t('app', 'Yes')]) ?>

    <?= $form->field($model, 'skype')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'website')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'workplace')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'religion')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
