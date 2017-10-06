<?php

namespace yii2lab\notify\services;

use yii2lab\domain\services\ActiveBaseService;

class SmsService extends ActiveBaseService {
	
	public function send($address, $subject, $content) {
		$data = compact('address', 'subject', 'content');
		$entity = $this->domain->factory->entity->create('sms', $data);
		$this->repository->send($entity);
	}
	
}
