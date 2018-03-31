<?php

namespace yii2lab\notify\domain\entities;

use yii2lab\domain\BaseEntity;
use yii2lab\domain\values\LangValue;

/**
 * Class SmsEntity
 *
 * @package yii2lab\notify\domain\entities
 *
 * @property string $address
 * @property string $content
 */
class SmsEntity extends BaseEntity {
	
	protected $address;
	protected $content;
	
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['content'], 'trim'],
			[['address', 'content'], 'required'],
		];
	}
	
	public function fieldType() {
		return [
			'content' => LangValue::class,
		];
	}
	
}
