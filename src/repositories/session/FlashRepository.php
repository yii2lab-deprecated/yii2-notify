<?php

namespace yii2lab\notify\repositories\session;

use yii2lab\domain\helpers\ReflectionHelper;
use yii2lab\domain\repositories\BaseRepository;
use Yii;
use yii2lab\notify\widgets\Alert;

class FlashRepository extends BaseRepository {
	
	public function send($message, $type) {
		Yii::$app->session->setFlash($type, $message);
	}
	
	public function fetch() {
		$typeList = ReflectionHelper::getConstantsValuesByPrefix(Alert::className(), 'type');
		foreach($typeList as $type) {
			if ($this->has($type)) {
				$entity = $this->fetchByType($type);
				return $entity;
			}
		}
		return null;
	}
	
	private function has($type) {
		return Yii::$app->session->hasFlash($type);
	}
	
	private function fetchByType($type) {
		$s = Yii::$app->session->getFlash($type);
		$entity = $this->domain->factory->entity->create('flash', [
			'type' => $type,
			'body' => $s,
		]);
		return $entity;
	}

}