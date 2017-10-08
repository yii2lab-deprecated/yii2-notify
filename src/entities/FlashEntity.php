<?php

namespace yii2lab\notify\entities;

use yii2lab\domain\BaseEntity;
use yii2module\lang\domain\helpers\LangHelper;

class FlashEntity extends BaseEntity {

	protected $type;
	protected $body;
	
	public function setBody($value) {
		$this->body = LangHelper::extract($value);
	}

}
