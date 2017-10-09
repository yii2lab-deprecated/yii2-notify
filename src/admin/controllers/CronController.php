<?php

namespace yii2lab\notify\admin\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;

class CronController extends Controller
{
	
	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'run' => ['post'],
				],
			]
		];
	}
	
	public function actionIndex()
	{
		return $this->render('index');
	}
	
	public function actionRun()
	{
		Yii::$app->queue->run();
		Yii::$app->notify->flash->send(['notify/cron', 'cron_success_run']);
		return $this->redirect('/notify/cron');
	}
	
}
