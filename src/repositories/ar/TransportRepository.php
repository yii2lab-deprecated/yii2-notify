<?php

namespace yii2lab\notify\repositories\ar;

use yii2lab\domain\repositories\ActiveArRepository;

class TransportRepository extends ActiveArRepository {

	public function deleteAll() {
		$modelClass = $this->modelClass;
		$modelClass::deleteAll();
	}

}