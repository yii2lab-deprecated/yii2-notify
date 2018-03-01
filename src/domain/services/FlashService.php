<?php

namespace yii2lab\notify\domain\services;

use yii2lab\domain\services\ActiveBaseService;
use yii2lab\notify\domain\entities\FlashEntity;
use yii2lab\notify\domain\widgets\Alert;

/**
 * Class FlashService
 *
 * @package yii2lab\notify\domain\services
 * @deprecated use yii2lab\navigation\domain\services\FlashService
 */
class FlashService extends ActiveBaseService {
	
	public function send($content, $type = Alert::TYPE_SUCCESS, $delay = FlashEntity::DELAY_DEFAULT) {
		$entity = $this->repository->forgeEntity([
			'type' => $type,
			'content' => $content,
			'delay' => $delay,
		]);
		$this->repository->send($entity);
	}
	
	public function fetch() {
		return $this->repository->fetch();
	}
	
}
