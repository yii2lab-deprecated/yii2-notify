<?php

namespace yii2lab\notify\services;

use yii2lab\notify\entities\TransportEntity;
use yii2lab\domain\services\ActiveBaseService;

class TransportService extends ActiveBaseService {
	
	public function sendSms($address, $message) {
		$body['type'] = TransportEntity::TYPE_SMS;
		$body['address'] = $address;
		$body['message'] = $message;
		$this->send($body);
	}

	public function sendEmail($address, $subject, $message) {
		$body['type'] = TransportEntity::TYPE_EMAIL;
		$body['address'] = $address;
		$body['subject'] = $subject;
		$body['message'] = $message;
		$this->send($body);
	}
	
	public function deleteAll() {
		$this->repository->deleteAll();
	}
	
	private function send($data) {
		$entity = $this->domain->factory->entity->create('transport', $data);
		$this->repository->insert($entity);
	}
	
}
