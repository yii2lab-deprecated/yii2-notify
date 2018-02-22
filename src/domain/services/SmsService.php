<?php

namespace yii2lab\notify\domain\services;

use Yii;
use yii2lab\domain\services\ActiveBaseService;
use yii2lab\notify\domain\entities\SmsEntity;
use yii2lab\notify\domain\job\SmsJob;

class SmsService extends ActiveBaseService {
	
	public function send($address, $subject, $content = '') {
		$data = compact('address', 'subject', 'content');
		if(empty($data['content']) && !empty($data['subject'])) {
			$data['content'] = $data['subject'];
			$data['subject'] = '';
		}
		$message = $this->domain->factory->entity->create(SmsEntity::class, $data);
		$message->validate();
		$job = Yii::createObject(SmsJob::class);
		Yii::configure($job, $message->toArray());
		$jobId = Yii::$app->queue->push($job);
		return $jobId;
	}
	
}
