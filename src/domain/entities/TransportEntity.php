<?php

namespace yii2lab\notify\domain\entities;

use yii2lab\domain\BaseEntity;

class TransportEntity extends BaseEntity {

	const TYPE_SMS = 'sms';
	const TYPE_EMAIL = 'email';

	protected $id;
	protected $type;
	protected $subject;
	protected $message;
	protected $address;
	protected $created_at;

	public function rules() {
		$types = $this->getConstantEnum('type');
		return [
			[['type', 'subject', 'message', 'address'], 'trim'],
			[['type', 'message', 'address'], 'required'],
			[['type'], 'in', 'range' => $types],
		];
	}

}
