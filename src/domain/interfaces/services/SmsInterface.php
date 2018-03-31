<?php

namespace yii2lab\notify\domain\interfaces\services;

use yii2lab\domain\interfaces\services\CrudInterface;

interface SmsInterface extends CrudInterface {
	
	public function send($address, $content);
	public function directSend($address, $content);
	
}