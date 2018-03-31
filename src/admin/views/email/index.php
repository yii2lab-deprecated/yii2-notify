<?php

/* @var $this yii\web\View */

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = Yii::t('article/main', 'list');

$baseUrl = $this->context->getBaseUrl();

$columns = [
	[
		'attribute' => 'type',
		'label' => Yii::t('notify/main', 'type'),
	],
	[
		'attribute' => 'address',
		'label' => Yii::t('notify/main', 'address'),
	],
	[
		'attribute' => 'subject',
		'label' => Yii::t('notify/main', 'subject'),
	],
	[
		'attribute' => 'message',
		'label' => Yii::t('notify/main', 'content'),
	],
	[
		'attribute' => 'created_at',
		'label' => Yii::t('main', 'created_at'),
	],
];

?>

<?= GridView::widget([
	'dataProvider' => $dataProvider,
	'layout' => '{summary}{items}',
	'columns' => $columns,
]); ?>

<?= Html::a(Yii::t('action', 'create'), $baseUrl . 'create', ['class' => 'btn btn-success']) ?>