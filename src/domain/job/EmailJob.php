<?php

namespace yii2lab\notify\domain\job;

use Yii;
use yii\base\BaseObject;
use yii\queue\Job;
use yii2lab\notify\domain\entities\EmailEntity;

class EmailJob extends BaseObject implements Job
{
	public $address;
	public $subject;
	public $content;
	
	public function execute($queue)
	{
		$data = [
			'address' => $this->address,
			'subject' => $this->subject,
			'content' => $this->content,
		];
		$entity = Yii::$app->notify->factory->entity->create(EmailEntity::className(), $data);
		Yii::$app->notify->repositories->email->send($entity);
	}
}
