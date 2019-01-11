<?php

namespace yii2lab\notify\domain\entities;

use yii2lab\domain\BaseEntity;

/**
 * Class PushEntity
 *
 * @package yii2lab\notify\domain\entities
 *
 * @property string $body
 * @property string $title
 */
class PushEntity extends BaseEntity {
	
	protected $body;
	protected $title;
	
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['body', 'title'], 'trim'],
			[['body', 'title'], 'required'],
		];
	}
}
