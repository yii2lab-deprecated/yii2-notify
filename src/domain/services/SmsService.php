<?php

namespace yii2lab\notify\domain\services;

use Yii;
use yii2lab\domain\services\ActiveBaseService;
use yii2lab\notify\domain\entities\SmsEntity;
use yii2lab\notify\domain\interfaces\services\SmsInterface;
use yii2lab\notify\domain\job\SmsJob;

/**
 * Class SmsService
 *
 * @package yii2lab\notify\domain\services
 *
 * @property \yii2lab\notify\domain\interfaces\repositories\SmsInterface $repository
 */
class SmsService extends ActiveBaseService implements SmsInterface {
	
	public $directOnly = false;
	
	public function send($address, $content) {
		if($this->directOnly) {
			$this->directSend($address, $content);
			return null;
		}
		$entity = new SmsEntity();
		$entity->address = $address;
		$entity->content = $content;
		$entity->validate();
		$job = Yii::createObject(SmsJob::class);
		Yii::configure($job, $entity->toArray());
		$jobId = Yii::$app->queue->push($job);
		return $jobId;
	}
	
	public function directSend($address, $content) {
		$entity = new SmsEntity();
		$entity->address = $address;
		$entity->content = $content;
		$this->repository->send($entity);
	}
	
}
