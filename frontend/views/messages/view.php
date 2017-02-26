<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
	<h2>Chat</h2>
<?php
$user = Yii::$app->user->id;
	foreach ($message_list as $item) {
		switch ($item['from_user']) {
			case $user:
				$side = 'right';
				$type = 'danger';
				break;
			default:
				$side = 'left';
				$type = 'info';
				break;
		}
?>
<div class="text-<?=$side?>">
	<strong> <?=$item->sender->profile->firstname?> <?=$item->sender->profile->lastname?></strong>
	<?php
		if(date('d-m-Y', time()) == date('d-m-Y', $item['date_created'])){
			echo date('H:i:s', $item['date_created']);
		}else{
			echo date('d-m-Y H:i:s', $item['date_created']);
		}
	 ?>
</div>
<div class="panel panel-<?=$type?>">

	<div class="panel-heading pull-<?=$side?>">
		<?=$item['message']?>
	</div>
</div>
<br>

<?php
	}
 ?>
 <br>
 <?php $form = ActiveForm::begin()?>
 <?php echo $form->field($model, 'message')->textInput(['placeholder'=>Yii::t('app', 'Type your message here...')])->label(false)?>
 <br>
 <?= Html::submitButton(Yii::t('app', 'Send'),['class'=>'text btn btn-primary']) ?>
 <?php ActiveForm::end()?>

