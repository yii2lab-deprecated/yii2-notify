<?php

namespace yii2lab\notify\domain\services;

use Yii;
use yii2lab\domain\services\ActiveBaseService;
use yii2lab\notify\domain\entities\EmailEntity;
use yii2lab\notify\domain\interfaces\services\EmailInterface;
use yii2lab\notify\domain\job\EmailJob;

/**
 * Class EmailService
 *
 * @package yii2lab\notify\domain\services
 *
 * @property \yii2lab\notify\domain\interfaces\repositories\EmailInterface $repository
 */
class EmailService extends ActiveBaseService implements EmailInterface {
	
	public function send($address, $subject, $content) {
		$entity = new EmailEntity();
		$entity->address = $address;
		$entity->subject = $subject;
		$entity->content = $content;
		$entity->validate();
		$job = Yii::createObject(EmailJob::class);
		Yii::configure($job, $entity->toArray());
		$jobId = Yii::$app->queue->push($job);
		return $jobId;
	}
	
	public function directSend($address, $subject, $content) {
		$entity = new EmailEntity();
		$entity->address = $address;
		$entity->subject = $subject;
		$entity->content = $content;
		$this->repository->send($entity);
	}
	
}
