<?php

namespace yii2lab\notify\domain\entities;

use yii2lab\domain\BaseEntity;
use yii2module\lang\domain\helpers\LangHelper;

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
	
	public function setSubject($value) {
		$this->subject = LangHelper::extract($value);
	}
	
	public function setContent($value) {
		$this->content = LangHelper::extract($value);
	}
	
}
