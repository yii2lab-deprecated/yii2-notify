<?php

/* @var $this yii\web\View */

use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii2lab\helpers\yii\Html;

$this->title = t('this/cron', 'title');
$columns = [
	[
		'label' => 'class',
		'attribute' => 'class',
	],
	[
		'label' => 'attributes',
		'format' => 'raw',
		'value' => function($data) {
            return json_encode($data['attributes'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
		},
	],
];
$dataProvider = new ArrayDataProvider([
	'models' => ArrayHelper::toArray($jobList),
]);
?>

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

<?= GridView::widget([
	'dataProvider' => $dataProvider,
	'layout' => '{items}',
	'columns' => $columns,
]);
?>

