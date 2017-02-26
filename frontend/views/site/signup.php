<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\url;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

               <div class="first_step">
                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                   <?= $form->field($model, 'email') ?>

                   <?= $form->field($model, 'password')->passwordInput() ?>
                </div>
               <!-- /.first_step -->
               <a href=""  id='next_step' class="btn btn-success"><?=Yii::t('app','Next step') ?></a>
                <div class="second_step">
                    <?= $form->field($model, 'firstname')->textInput() ?>
                    <?= $form->field($model, 'lastname')->textInput() ?>
                    <?= $form->field($model, 'middlename')->textInput() ?>
                    <?= $form->field($model, 'birthdate')->textInput() ?>
                    <?= $form->field($model, 'country_id')->dropDownList($countries) ?>

                    <?php
                        echo $form->field($model, 'region_id')->widget(DepDrop::classname(), [
                         'options' => ['id'=>'region-id'],
                         'pluginOptions'=>[
                             'depends'=>['signupform-country_id'],
                             'placeholder' => 'Select region...',
                             'url' => Url::to(['/site/getregions'])
                         ]
                        ]);
                    ?>
                     <?php
                        echo $form->field($model, 'city_id')->widget(DepDrop::classname(), [
                         'options' => ['id'=>'city-id'],
                         'pluginOptions'=>[
                             'depends'=>['region-id'],
                             'placeholder' => 'Select city...',
                             'url' => Url::to(['/site/getcities'])
                         ]
                        ]);
                    ?>
                    <?= $form->field($model, 'gender')->dropDownList(Yii::$app->params['gender']) ?>
                    <?= $form->field($model, 'phone')->textInput() ?>
                    <?= $form->field($model, 'address')->textInput() ?>
                    <?= $form->field($model, 'hobby')->textInput() ?>
                    <?= $form->field($model, 'education_type')->dropDownList(Yii::$app->params['education_type']) ?>
                    <?= $form->field($model, 'education_info')->textInput() ?>
                    <?= $form->field($model, 'marriage_status')->dropDownList(Yii::$app->params['marriage_status']) ?>
                    <?= $form->field($model, 'has_children')->dropDownList(['0'=>Yii::t('app','No'),'1'=>Yii::t('app','Yes')]) ?>
                    <?= $form->field($model, 'skype')->textInput() ?>
                    <?= $form->field($model, 'website')->textInput() ?>
                    <?= $form->field($model, 'workplace')->textInput() ?>
                    <?= $form->field($model, 'religion')->dropDownList(Yii::$app->params['religion']) ?>
                    <div class="form-group">
                        <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                    </div>
                </div>
                <!-- /.second_step -->

            <?php ActiveForm::end(); ?>
            <?php echo "<pre>";
            var_dump($_POST);
            echo "</pre>"; ?>
        </div>
    </div>
</div>
