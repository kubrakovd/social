<?php
use yii\helpers\Html;

?>
<h1>Messages</h1>

<?php
	foreach ($groups as $group) {
?>
	<li class="list-group-item">
	<?=$group->profile->firstname?>
	<?=$group->profile->lastname?>
		<div class="pull-right">
			<?=Html::a(Yii::t('app','View'), ['messages/view', 'id'=>$group->id],['class'=>'btn btn-success btn-xs']) ?>
		</div>
	</li>
<?php
	}
 ?>
