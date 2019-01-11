<?php

namespace yii2lab\notify\domain\interfaces\services;

use yii2lab\domain\interfaces\services\CrudInterface;
use yii2lab\notify\domain\entities\SmsEntity;

interface PushInterface  {
	
	public function sendAll($body);
	
	public function send($id,$body);
}