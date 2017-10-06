<?php

namespace yii2lab\notify\entities;

use yii2lab\domain\BaseEntity;

class MessageEntity extends BaseEntity {
	
	protected $address;
	protected $subject;
	protected $content;
	
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['content', 'subject'], 'trim'],
			[['address', 'content'], 'required'],
		];
	}
	
}
