<?php
/* @var $this yii\web\View */
?>
<h1><?=$news->header?></h1>

<div class="news-content">
	<!-- Remove this SHIT -->
	<?=nl2br($news->text)?>
</div>
<div class="pull-right">
	<?=date('d-m-Y', $news->date_created)?>
</div>

