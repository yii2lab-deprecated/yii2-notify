<?php

namespace yii2lab\notify\domain\services;

use Yii;
use yii2lab\domain\services\ActiveBaseService;
use yii2lab\extension\enum\enums\TimeEnum;
use yii2lab\notify\domain\entities\SmsEntity;
use yii2lab\notify\domain\exceptions\SmsTimeLimitException;
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
	public $timeLimit = TimeEnum::SECOND_PER_MINUTE;
	
	public function sendEntity(SmsEntity $smsEntity) {
		if($this->directOnly) {
			$this->directSendEntity($smsEntity);
			return null;
		}
		$this->validate($smsEntity);
		$this->createJob($smsEntity);
	}
	
	public function directSendEntity(SmsEntity $smsEntity) {
		$this->validate($smsEntity);
		$this->repository->send($smsEntity);
	}
	
	public function send($address, $content) {
		if($this->directOnly) {
			$this->directSend($address, $content);
			return null;
		}
		$smsEntity = new SmsEntity();
		$smsEntity->address = $address;
		$smsEntity->content = $content;
		$this->validate($smsEntity);
		$this->createJob($smsEntity);
	}
	
	public function directSend($address, $content) {
		$smsEntity = new SmsEntity();
		$smsEntity->address = $address;
		$smsEntity->content = $content;
		$this->validate($smsEntity);
		$this->repository->send($smsEntity);
	}
	
	private function validate(SmsEntity $smsEntity) {
		$smsEntity->validate();
		$key = 'SmsTimeLimit_' . $smsEntity->address;
		$isHas = Yii::$app->cache->get($key);
		if($isHas) {
			throw new SmsTimeLimitException;
		}
		Yii::$app->cache->set($key, TIMESTAMP, $this->timeLimit);
	}
	
	private function createJob(SmsEntity $smsEntity) {
		$job = Yii::createObject(SmsJob::class);
		Yii::configure($job, $smsEntity->toArray());
		$jobId = Yii::$app->queue->push($job);
		return $jobId;
	}
}
