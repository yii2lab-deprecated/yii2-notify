<?php

/* @var $this yii\web\View */
/* @var $jobList JobInterface[] */

use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\queue\JobInterface;
use yii2lab\extension\yii\helpers\Html;

$this->title = Yii::t('notify/cron', 'title');
$columns = [
	[
		'label' => 'class',
		'format' => 'raw',
		'value' => function($job) {
			return get_class($job);
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
		<h1><?= Yii::t('notify/cron', 'hello') ?></h1>

		<p class="lead"><?= Yii::t('notify/cron', 'text') ?></p>
		
		<?= Html::a(Yii::t('notify/cron', 'run'), '/notify/cron/run', [
			'data-method' => 'post',
			'class' => ['btn btn-primary'],
		]) ?>
		
        <p class="lead"><?= Yii::t('notify/cron', 'description') ?></p>
  
	</div>

</div>

<?= GridView::widget([
	'dataProvider' => $dataProvider,
	'layout' => '{items}',
	'columns' => $columns,
]);
?>

