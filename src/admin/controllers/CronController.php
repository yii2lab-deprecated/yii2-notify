<?php

namespace yii2lab\notify\admin\controllers;

use Yii;
use yii\di\Instance;
use yii\filters\VerbFilter;
use yii\queue\Queue;
use yii\queue\serializers\Serializer;
use yii\web\Controller;
use yii2lab\helpers\yii\ArrayHelper;
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
			$message = t('github/local', 'has_job');
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
		$dir = Yii::getAlias('@common/runtime/queue');
		$dir = FileHelper::normalizePath($dir);
		$jobList = FileHelper::scanDir($dir);
		foreach($jobList as $id => &$fileName) {
			$fileName = str_replace('.data', '', $fileName);
			if($fileName == 'index') {
				unset($jobList[$id]);
			}
		}
		$jobList2 = [];
		//$serializer = Instance::ensure($serializer, Serializer::class);
		foreach($jobList as $fileName) {
			$file = $dir . DS . $fileName . '.data';
			$content = FileHelper::load($file);
			//$jobList2[] = json_decode($content);
			$job = unserialize($content);
			$item['class'] = $job->className();
			$item['attributes'] = ArrayHelper::toArray($job);
			$jobList2[] = $item;
		}
		//Queue::
		
		//prr($jobList2,1,1);
		return $jobList2;
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
