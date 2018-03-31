<?php

namespace yii2lab\notify\admin\forms;

use Yii;
use yii2lab\domain\base\Model;

class SmsForm extends Model {
	
	public $address;
	public $content;
	
	public function attributeLabels()
	{
		return [
			'address' => Yii::t('notify/main', 'address'),
			'content' => Yii::t('notify/main', 'content'),
		];
	}
}
