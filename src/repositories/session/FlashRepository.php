<?php

namespace yii2lab\notify\repositories\session;

use yii2lab\domain\helpers\ReflectionHelper;
use yii2lab\domain\repositories\BaseRepository;
use Yii;
use yii2lab\notify\entities\FlashEntity;
use yii2lab\notify\widgets\Alert;

class FlashRepository extends BaseRepository {
	
	public function send(FlashEntity $entity) {
		$message = serialize($entity->toArray());
		Yii::$app->session->setFlash($entity->type, $message);
	}
	
	public function fetch() {
		$typeList = ReflectionHelper::getConstantsValuesByPrefix(Alert::className(), 'type');
		foreach($typeList as $type) {
			if ($this->has($type)) {
				$entity = $this->fetchByType($type);
				return $this->forgeEntity($entity);
			}
		}
		return null;
	}
	
	private function has($type) {
		return Yii::$app->session->hasFlash($type);
	}
	
	private function fetchByType($type) {
		$message = Yii::$app->session->getFlash($type);
		$data = unserialize($message);
		return $this->forgeEntity($data);
	}

}