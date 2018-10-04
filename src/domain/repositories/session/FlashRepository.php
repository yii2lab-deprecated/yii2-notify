<?php

namespace yii2lab\notify\domain\repositories\session;

use yii2lab\extension\common\helpers\ReflectionHelper;
use yii2lab\domain\repositories\BaseRepository;
use Yii;
use yii2lab\notify\domain\entities\FlashEntity;
use yii2lab\notify\domain\widgets\Alert;

/**
 * Class FlashRepository
 *
 * @package yii2lab\notify\domain\repositories\session
 * @deprecated use yii2lab\navigation\domain\repositories\session\FlashRepository
 */
class FlashRepository extends BaseRepository {
	
	public function send(FlashEntity $entity) {
		$message = serialize($entity->toArray());
		Yii::$app->session->setFlash($entity->type, $message);
	}
	
	public function fetch() {
		$typeList = ReflectionHelper::getConstantsValuesByPrefix(Alert::class, 'type');
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