<?php

namespace yii2lab\notify\services;

use yii2lab\domain\helpers\ReflectionHelper;
use yii2lab\domain\services\ActiveBaseService;
use yii2lab\notify\widgets\Alert;

class FlashService extends ActiveBaseService {
	
	public function send($message, $type = Alert::TYPE_SUCCESS) {
		if(is_array($message)) {
			$message = t($message[0], $message[1]);
		}
		$this->repository->create($message, $type);
	}
	
	public function fetch() {
		$typeList = ReflectionHelper::getConstantsValuesByPrefix(Alert::className(), 'type');
		foreach($typeList as $type) {
			if ($this->repository->has($type)) {
				$entity = $this->repository->fetch($type);
				return $entity;
			}
		}
	}
	
}
