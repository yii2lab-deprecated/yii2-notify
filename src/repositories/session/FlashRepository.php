<?php

namespace yii2lab\notify\repositories\session;

use yii2lab\domain\repositories\BaseRepository;
use Yii;

class FlashRepository extends BaseRepository {
	
	public function create($message, $type) {
		Yii::$app->session->setFlash($type, $message);
	}
	
	public function has($type) {
		return Yii::$app->session->hasFlash($type);
	}
	
	public function fetch($type) {
		$s = Yii::$app->session->getFlash($type);
		$entity = $this->domain->factory->entity->create('flash', [
			'type' => $type,
			'body' => $s,
		]);
		return $entity;
	}

}