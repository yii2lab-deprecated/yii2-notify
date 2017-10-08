<?php

namespace yii2lab\notify\services;

use yii2lab\domain\services\ActiveBaseService;
use yii2lab\notify\widgets\Alert;

class FlashService extends ActiveBaseService {
	
	public function send($message, $type = Alert::TYPE_SUCCESS) {
		$this->repository->send($message, $type);
	}
	
	public function fetch() {
		return $this->repository->fetch();
	}
	
}
