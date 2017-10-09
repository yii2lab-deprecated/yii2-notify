<?php

namespace yii2lab\notify\domain\job;

use Yii;
use yii\base\Object;
use yii\queue\Job;
use yii2lab\notify\domain\entities\SmsEntity;

class SmsJob extends Object implements Job
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
		$entity = Yii::$app->notify->factory->entity->create(SmsEntity::className(), $data);
		Yii::$app->notify->repositories->sms->send($entity);
	}
}
