<?php

/* @var $this yii\web\View */

use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii2lab\helpers\yii\Html;

$this->title = Yii::t('this/cron', 'title');
$columns = [
	[
		'label' => 'class',
		'format' => 'raw',
		'value' => function($job) {
			return $job->className();
		},
	],
	[
		'label' => 'attributes',
		'format' => 'raw',
		'value' => function($job) {
            return json_encode(ArrayHelper::toArray($job), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
		},
	],
];
$dataProvider = new ArrayDataProvider([
	'models' => $jobList,
]);
?>

<div class="dashboard-index">

	<div class="jumbotron">
		<h1><?= Yii::t('this/cron', 'hello') ?></h1>

		<p class="lead"><?= Yii::t('this/cron', 'text') ?></p>
		
		<?= Html::a(t('this/cron', 'run'), '/notify/cron/run', [
			'data-method' => 'post',
			'class' => ['btn btn-primary'],
		]) ?>
		
        <p class="lead"><?= Yii::t('this/cron', 'description') ?></p>
  
	</div>

</div>

<?= GridView::widget([
	'dataProvider' => $dataProvider,
	'layout' => '{items}',
	'columns' => $columns,
]);
?>

