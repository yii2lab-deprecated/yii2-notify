<?php

/* @var $this yii\web\View */

use yii2lab\helpers\yii\Html;
use yii2lab\notify\domain\widgets\Alert;

$this->title = t('this/cron', 'title');

?>

<?= implode('<br/>', $jobList) ?>

<div class="dashboard-index">

	<div class="jumbotron">
		<h1><?= t('this/cron', 'hello') ?></h1>

		<p class="lead"><?= t('this/cron', 'text') ?></p>
		
		<?= Html::a(t('this/cron', 'run'), '/notify/cron/run', [
			'data-method' => 'post',
			'class' => ['btn btn-primary'],
		]) ?>
		
        <p class="lead"><?= t('this/cron', 'description') ?></p>
  
	</div>

</div>
