<?php

namespace yii2lab\notify\entities;

use yii2lab\helpers\yii\ArrayHelper;

class EmailEntity extends MessageEntity {
	
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return ArrayHelper::merge(parent::rules(), [
			['address', 'email'],
		]);
	}
}
