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
	
	public $directOnly = false;
	
	public function sendEntity(EmailEntity $emailEntity) {
		if($this->directOnly) {
			$this->directSendEntity($emailEntity);
			return null;
		}
		$emailEntity->validate();
		$this->createJob($emailEntity);
	}
	
	public function directSendEntity(EmailEntity $emailEntity) {
		$emailEntity->validate();
		$this->repository->send($emailEntity);
	}
	
	public function send($address, $subject, $content) {
		if($this->directOnly) {
			$this->directSend($address, $subject, $content);
			return null;
		}
		$emailEntity = new EmailEntity();
		$emailEntity->address = $address;
		$emailEntity->subject = $subject;
		$emailEntity->content = $content;
		$emailEntity->validate();
		$this->createJob($emailEntity);
	}
	
	public function directSend($address, $subject, $content) {
		$emailEntity = new EmailEntity();
		$emailEntity->address = $address;
		$emailEntity->subject = $subject;
		$emailEntity->content = $content;
		$this->repository->send($emailEntity);
	}
	
	private function createJob(EmailEntity $emailEntity) {
		$job = Yii::createObject(EmailJob::class);
		Yii::configure($job, $emailEntity->toArray());
		$jobId = Yii::$app->queue->push($job);
		return $jobId;
	}
	
}
