<?php

namespace yii2lab\notify\domain\entities;

use yii2lab\domain\BaseEntity;
use yii2lab\domain\values\TimeValue;

/**
 * Class TestEntity
 *
 * @package yii2lab\notify\domain\entities
 *
 * @property string $id
 * @property string $type
 * @property string $address
 * @property string $subject
 * @property string $message
 * @property string $created_at
 */
class TestEntity extends BaseEntity {

	const TYPE_SMS = 'sms';
	const TYPE_EMAIL = 'email';
	
	protected $type;
	protected $address;
	protected $subject;
	protected $message;
	protected $created_at;
	
	public function init() {
		parent::init();
		$this->created_at = new TimeValue;
	}
	
	public function fieldType() {
		return [
			'created_at' => TimeValue::class,
		];
	}
	
	public function rules() {
		$types = $this->getConstantEnum('type');
		return [
			[['type', 'subject', 'message', 'address'], 'trim'],
			[['type', 'message', 'address'], 'required'],
			[['type'], 'in', 'range' => $types],
		];
	}

	public function getId() {
		$data = $this->toArray();
		$dataString = serialize($data);
		$dataHash = hash('crc32b', $dataString);
		return $dataHash;
	}
	
}
