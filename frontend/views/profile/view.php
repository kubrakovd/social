<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Profile */

$this->title = $model->user_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Profiles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->user_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'user_id',
            'firstname',
            'lastname',
            'middlename',
            [
                'label'=>Yii::t('app', 'Birthdate'),
                'value'=>date('d.m.Y', $model->birthdate)
            ],
            // 'birthdate',
            'country' => [
                'label'=>Yii::t('app', 'Country'),
                'value'=> $country->name

            ],
              'state' => [
                'label'=>Yii::t('app', 'Region'),
                'value'=> $state->name

            ],
              'city' => [
                'label'=>Yii::t('app', 'City'),
                'value'=> $city->name

            ],
            'gender' =>[
                'label'=>Yii::t('app', 'Gender'),
                'value'=>Yii::$app->params['gender'][$model->gender]
            ],
            'phone',
            'address:ntext',
            'hobby:ntext',
            'education_type',
            'education_info:ntext',
            'marriage_status',
            'has_children',
            'skype',
            'website',
            'workplace:ntext',
            'religion',
        ],
    ]) ?>

</div>
