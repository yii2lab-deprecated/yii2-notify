<?php

namespace yii2lab\notify\admin\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii2lab\helpers\Behavior;
use yii2lab\notify\domain\helpers\JobHelper;
use yii2lab\notify\domain\widgets\Alert;

class CronController extends Controller
{
	
	public function behaviors()
	{
		return [
			'verb' => Behavior::verb([
				'run' => ['post'],
			]),
		];
	}
	
	public function actionIndex()
	{
		$jobList = JobHelper::getAll();
		if(!empty($jobList)) {
			$message = Yii::t('notify/cron', 'has_job');
			Yii::$app->navigation->alert->create($message, Alert::TYPE_INFO, null);
		}
		return $this->render('index', compact('jobList'));
	}
	
	public function actionRun()
	{
		$jobList = JobHelper::getAll();
		if(!empty($jobList)) {
			$queue = Yii::$app->queue;
			/** @var \yii\queue\file\Queue $queue */
			$queue->run(false);
			Yii::$app->navigation->alert->create(['notify/cron', 'cron_success_run']);
		} else {
			Yii::$app->navigation->alert->create(['notify/cron', 'cron_empty_run'], Alert::TYPE_WARNING);
		}
		return $this->redirect('/notify/cron');
	}

}
