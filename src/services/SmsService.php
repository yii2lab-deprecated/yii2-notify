<?php

namespace yii2lab\notify\services;

use Yii;
use yii2lab\domain\services\ActiveBaseService;
use yii2lab\notify\entities\SmsEntity;
use yii2lab\notify\job\SmsJob;

class SmsService extends ActiveBaseService {
	
	public function send($address, $subject, $content) {
		$data = compact('address', 'subject', 'content');
		$message = $this->domain->factory->entity->create(SmsEntity::className(), $data);
		$message->validate();
		$job = Yii::createObject(SmsJob::className());
		Yii::configure($job, $message->toArray());
		$jobId = Yii::$app->queue->push($job);
		return $jobId;
	}
	
}
