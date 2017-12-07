<?php

namespace yii2lab\notify\admin\forms;

use yii2woop\account\domain\forms\RestorePasswordForm as ApiRestorePasswordForm;

class MessageForm extends ApiRestorePasswordForm {
	
	public $address;
	public $subject;
	public $content;
	
	public function attributeLabels()
	{
		return [
			'address' => t('notify/main', 'address'),
			'subject' => t('notify/main', 'subject'),
			'content' => t('notify/main', 'content'),
		];
	}
}
