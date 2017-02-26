<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel common\models\GroupsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Groups');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="groups-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Groups'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
        foreach ($groups as $group) {
    ?>
        <div class="panel panel-default">
            <div class="panel-body">
                <?=Html::img('@web/uploads/groups/'.$group->image,
                 ['width'=>'100',
                  'class'=>'pull-left',
                  'style'=>'margin-right:20px;'
                  ])?><br>
                <?=Html::a($group->name, ['groups/view', 'id'=>$group->id])?><br>
                <?=mb_substr($group->description, 0,150)?>...
                <div class="pull-right">
                    <?php
                        if($group->owner_id == Yii::$app->user->id){
                            echo Html::a('<i class="fa fa-edit fa-2x"></i>',
                             ['groups/edit',
                              'id'=>$group->id],
                             ['class'=>'btn btn-success btn-xs']
                        );
                    }
                    if($group->owner_id != Yii::$app->user->id && $group->opened != 0){
                            echo Html::a('<i class="fa fa-user fa-2x"></i>',
                             ['groups/member',
                              'id'=>$group->id],
                             ['class'=>'btn btn-warning btn-xs']
                        );
                        }
                     ?>
                </div>
            </div>
        </div>
    <?php
        }
     ?>
    <p>
        <?php
            echo LinkPager::widget(['pagination'=>$pagination]);
         ?>
    </p>
</div>
