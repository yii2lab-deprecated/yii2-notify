<?php

namespace yii2lab\notify\admin\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii2lab\notify\domain\helpers\JobHelper;
use yii2lab\notify\domain\widgets\Alert;

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
		$jobList = JobHelper::getAll();
		if(!empty($jobList)) {
			$message = t('github/local', 'has_job');
			Yii::$app->notify->flash->send($message, Alert::TYPE_INFO, null);
		}
		return $this->render('index', compact('jobList'));
	}
	
	public function actionRun()
	{
		$jobList = JobHelper::getAll();
		if(!empty($jobList)) {
			Yii::$app->queue->run();
			Yii::$app->notify->flash->send(['notify/cron', 'cron_success_run']);
		} else {
			Yii::$app->notify->flash->send(['notify/cron', 'cron_empty_run'], Alert::TYPE_WARNING);
		}
		return $this->redirect('/notify/cron');
	}

}
