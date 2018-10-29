<?php

namespace yii2lab\notify\domain\entities;

use yii2lab\domain\BaseEntity;
use yii2lab\domain\values\LangValue;

/**
 * Class EmailEntity
 *
 * @package yii2lab\notify\domain\entities
 *
 * @property string $address
 * @property string $subject
 * @property string $content
 * @property AttachmentEntity[] $attachments
 */
class EmailEntity extends BaseEntity {
	
	protected $address;
	protected $subject;
	protected $content;
	protected $attachments;
	
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['content', 'subject'], 'trim'],
			[['address', 'content'], 'required'],
			['address', 'email'],
		];
	}
	
	public function fieldType() {
		return [
			'subject' => LangValue::class,
			'content' => LangValue::class,
			'attachments' => [
				'type' => AttachmentEntity::class,
				'isCollection' => true,
			],
		];
	}
	
}
