<?php

namespace yii2lab\notify\admin\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii2lab\helpers\yii\FileHelper;
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
		$jobList = $this->getAll();
		if(!empty($jobList)) {
			$message = t('github/local', 'has_job') . ': ';
			$message .= implode(', ', $jobList);
			Yii::$app->notify->flash->send($message, Alert::TYPE_INFO, null);
		}
		return $this->render('index', compact('jobList'));
	}
	
	public function actionRun()
	{
		$jobList = $this->getAll();
		if(!empty($jobList)) {
			Yii::$app->queue->run();
			Yii::$app->notify->flash->send(['notify/cron', 'cron_success_run']);
		} else {
			Yii::$app->notify->flash->send(['notify/cron', 'cron_empty_run'], Alert::TYPE_WARNING);
		}
		return $this->redirect('/notify/cron');
	}

	private function getAll() {
		$jobList = FileHelper::scanDir(Yii::getAlias('@common/runtime/queue'));
		foreach($jobList as $id => &$fileName) {
			$fileName = str_replace('.data', '', $fileName);
			if($fileName == 'index') {
				unset($jobList[$id]);
			}
		}
		return $jobList;
		//$content = file_get_contents(Yii::getAlias('@common/runtime/queue/index.data'));
		//$data = $content === '' ? [] : unserialize($content);
		/*$taskList = [];
		foreach($jobList as $fileName) {
			$content = file_get_contents(Yii::getAlias("@common/runtime/queue/{$fileName}.data"));
			$data = $content === '' ? [] : unserialize($content);
			$taskList[] = $data;
		}
		prr($taskList);*/
	}

}
