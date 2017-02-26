<?php
    use yii\widgets\ActiveForm;
    use yii\helpers\Html;
    use kartik\widgets\Typeahead;
?>
<h1><?=Yii::t('app','Search')?></h1>
<div class="panel">
    <div class="panel-body">
        <?php
            $form = ActiveForm::begin();
            echo "<pre>";
            var_dump($data);
            echo "</pre>";
        // Usage with ActiveForm and model (with search term highlighting)
            echo $form->field($model, 'search')->widget(Typeahead::classname(), [
                'options' => ['placeholder' => 'Enter search here...'],
                'pluginOptions' => ['highlight'=>true],
                'dataset' => [
                    [
                        'local' => $data,
                        'limit' => 10
                    ]
                ]
            ]);
//            echo $form->field($model,'search')
//                      ->textInput([
//                              'placeholder'=>'Enter search here...',
//                              'class'=>'form-control input-lg',
//                              'value'=>isset($_POST['SearchForm']) && $_POST['SearchForm']['search'] ? $_POST['SearchForm']['search'] : ''
//                      ])
//                      ->label(false);
            echo Html::submitButton(
                Yii::t('app','Search'),
                ['class'=>'btn btn-success btn-lg']
            );
            ActiveForm::end();
        ?>
    </div>
    <?php
        if(count($search)>0) {
            foreach ($search as $item){
    ?>
        <div class="panel panel-default">
            <div class="panel-body">
                <?= Html::a($item->firstname . ' ' . $item->lastname, ['profile/view', 'id' => $item->user_id]) ?>
                <div class="pull-right">
                    <?=Html::a(Yii::t('app','Add friend'),['user/addfriend','id'=>$item->user_id])?>
                </div>
            </div>
        </div>
    <?php
            }
        }else{
    ?>
        <div class="alert alert-info">
            <?=Yii::t('app','No search results')?>
        </div>
    <?php
        }
    ?>
    <?php
//    echo "<pre>";
//    print_r($search);
//    echo "</pre>";
    ?>
</div>
