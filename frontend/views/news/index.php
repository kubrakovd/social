<?php
	use yii\helpers\Html;

?>
<h1>News</h1>

<?php
	foreach ($news as $item) {
		switch ($item->type) {
			case 'service':
				$type = 'danger';
				break;
			case 'general':
				$type = 'default';
				break;
			case 'info':
				$type = 'info';
				break;
			default:
				$type = 'default';
				break;
		}
?>
	<div class="panel panel-<?=$type?>">
		<div class="panel-heading">
			<?=$item->header?>
			<div class="pull-right"><?=date('d-m-Y', $item->date_created) ?></div>
		</div>
		<div class="panel-body">
			<?=mb_substr($item->text,0, 200) ?>
		</div>
		<div class="panel-footer">
			<div class="pull-right">
				<?=Html::a(Yii::t('app', 'More'), ['news/view', 'id'=>$item->id]) ?>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
<?php
	}
 ?>

