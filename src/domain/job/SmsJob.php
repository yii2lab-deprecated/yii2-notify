<?php

namespace yii2lab\notify\domain\job;

use Yii;
use yii\base\BaseObject;
use yii\queue\JobInterface;
use yii2lab\notify\domain\entities\SmsEntity;

class SmsJob extends BaseObject implements JobInterface
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
