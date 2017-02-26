<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
?>
<div>

	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="#friends" aria-controls="home" role="tab" data-toggle="tab">Friends(<?=$accepted['count']?>)</a></li>
		<li role="presentation"><a href="#requests" aria-controls="profile" role="tab" data-toggle="tab">Requests(<?=$income['count']?>/<?=$outcome['count'] ?>)</a></li>
		<li role="presentation"><a href="#bl" aria-controls="messages" role="tab" data-toggle="tab">Blacklist(0)</a></li>
	</ul>

	<!-- Tab panes -->
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="friends">
			<h1><?=Yii::t('app', 'Friends') ?></h1>
			<?php
				foreach ($accepted['users'] as $item) {
			?>
			<div class="panel panel-success">
				<div class="panel-body">
					<?=Html::a($item->profile->firstname." ".$item->profile->lastname, ['profile/view', 'id'=>$item->id]) ?>
					<div class="pull-right">
							<?=Html::a(
								Yii::t('app', 'Send Message'),
								['messages/view/', 'id'=>$item->id],
								['class'=>'btn btn-success btn-xs']
								)
								?>
							<?=Html::a(
								Yii::t('app', 'Remove'),
								['friends/remove/', 'id'=>$item->id],
								['class'=>'btn btn-danger btn-xs']
								)
								?>


					</div>
				</div>
			</div>
			<?php
				}
			 ?>
		</div>
		<div role="tabpanel" class="tab-pane" id="requests">
			<h1><?=Yii::t('app', 'Requests') ?></h1>
			<hr>
			<h3><?=Yii::t('app', "Income requests") ?></h3>
			<?php

			foreach ($income['users'] as $item) {
				?>
				<div class="panel panel-default">
					<div class="panel-body">
						<?=Html::a($item->profile->firstname." ".$item->profile->lastname, ['profile/view', 'id'=>$item->id]) ?>
						<div class="pull-right">
							<?=Html::a(
								Yii::t('app', 'Accept'),
								['friends/decision/', 'id'=>$item->id, 'action'=>'accept'],
								['class'=>'btn btn-success btn-xs']
								)
								?>
								<?=Html::a(
								Yii::t('app', 'Decline'),
								['friends/decision/', 'id'=>$item->id, 'action'=>'decline'],
								['class'=>'btn btn-danger btn-xs']
								)
								?>
								<?=Html::a(
								Yii::t('app', 'Blacklist'),
								['friends/decision/', 'id'=>$item->id, 'action'=>'cancel', 'reverse'=> true],
								['class'=>'btn btn-info btn-xs']
								)
								?>
						</div>
					</div>
				</div>
				<?php
							}
			?>


			<hr>
			<h3><?=Yii::t('app', "Outcome requests") ?></h3>
			<?php
			foreach ($outcome['users'] as $item) {

				?>
				<div class="panel panel-default">
					<div class="panel-body">
						<?=Html::a($item->profile->firstname." ".$item->profile->lastname, ['profile/view', 'id'=>$item->id]) ?>
						<div class="pull-right">
							<?=Html::a(
								Yii::t('app', 'Cancel'),
								['friends/decision/', 'id'=>$item->id, 'action'=>'cancel', 'reverse'=>true],
								['class'=>'btn btn-default btn-xs']
								)

								?>

							</div>
					</div>
				</div>
				<?php
			}
			?>
		</div>
		<div role="tabpanel" class="tab-pane" id="bl">
			<h1><?=Yii::t('app', 'BlackList') ?></h1>
		</div>
	</div>

</div>

