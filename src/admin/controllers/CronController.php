<?php

namespace yii2lab\notify\admin\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii2lab\helpers\yii\FileHelper;

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
		$jobList = FileHelper::scanDir(Yii::getAlias('@common/runtime/queue'));
		foreach($jobList as $id => &$fileName) {
			$fileName = str_replace('.data', '', $fileName);
			if($fileName == 'index') {
				unset($jobList[$id]);
			}
		}
		//$content = file_get_contents(Yii::getAlias('@common/runtime/queue/index.data'));
		//$data = $content === '' ? [] : unserialize($content);
		/*$taskList = [];
		foreach($jobList as $fileName) {
			$content = file_get_contents(Yii::getAlias("@common/runtime/queue/{$fileName}.data"));
			$data = $content === '' ? [] : unserialize($content);
			$taskList[] = $data;
		}
		prr($taskList);*/
		return $this->render('index', compact('jobList'));
	}
	
	public function actionRun()
	{
		Yii::$app->queue->run();
		Yii::$app->notify->flash->send(['notify/cron', 'cron_success_run']);
		return $this->redirect('/notify/cron');
	}
	
}
