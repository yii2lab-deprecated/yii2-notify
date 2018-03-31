<?php

namespace yii2lab\notify\domain\services;

use yii2lab\domain\services\ActiveBaseService;
use yii2lab\notify\domain\entities\TestEntity;
use yii2lab\notify\domain\interfaces\services\TestInterface;

/**
 * Class SmsService
 *
 * @package yii2lab\notify\domain\services
 *
 * @property \yii2lab\notify\domain\interfaces\repositories\TestInterface $repository
 */
class TestService extends ActiveBaseService implements TestInterface {
	
	public function send($type, $address, $subject, $message) {
		$entity = new TestEntity();
		$entity->type = $type;
		$entity->address = $address;
		$entity->subject = $subject;
		$entity->message = $message;
		$this->repository->insert($entity);
	}
	
}
