<?php

namespace yii2lab\notify\services;

use yii2lab\domain\services\ActiveBaseService;
use yii2lab\notify\entities\FlashEntity;
use yii2lab\notify\widgets\Alert;

class FlashService extends ActiveBaseService {
	
	public function send($message, $type = Alert::TYPE_SUCCESS, $delay = FlashEntity::DELAY_DEFAULT) {
		$entity = $this->domain->factory->entity->create(FlashEntity::className());
		$entity->type = $type;
		$entity->content = $message;
		$entity->delay = $delay;
		$this->repository->send($entity);
	}
	
	public function fetch() {
		return $this->repository->fetch();
	}
	
}
