<?php

namespace yii2lab\notify\domain\entities;

use yii2lab\domain\BaseEntity;
use yii2lab\extension\yii\helpers\FileHelper;

/**
 * Class AttachmentEntity
 *
 * @package yii2lab\notify\domain\entities
 *
 * @property $fileName
 * @property $content
 * @property $contentType
 */
class AttachmentEntity extends BaseEntity {
	
	protected $fileName;
	protected $content;
	protected $contentType;
	
	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['file', 'content', 'contentType'], 'trim'],
			[['file'], 'required'],
		];
	}
	
	public function getContentType() {
		if(isset($this->contentType)) {
			return $this->contentType;
		}
		return FileHelper::getMimeTypeByExtension($this->fileName);
	}
}
