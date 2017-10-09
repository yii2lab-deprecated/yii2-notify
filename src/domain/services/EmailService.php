<?php

namespace yii2lab\notify\domain\services;

use Yii;
use yii2lab\domain\services\ActiveBaseService;
use yii2lab\notify\domain\entities\EmailEntity;
use yii2lab\notify\domain\job\EmailJob;

class EmailService extends ActiveBaseService {
	
	public function send($address, $subject, $content) {
		$data = compact('address', 'subject', 'content');
		$message = $this->domain->factory->entity->create(EmailEntity::className(), $data);
		$message->validate();
		$job = Yii::createObject(EmailJob::className());
		Yii::configure($job, $message->toArray());
		$jobId = Yii::$app->queue->push($job);
		return $jobId;
	}
	
}
