<?php

namespace yii2lab\notify\domain\interfaces\services;

use yii2lab\domain\interfaces\services\CrudInterface;

interface EmailInterface extends CrudInterface {
	
	public function send($address, $subject, $content);
	public function directSend($address, $subject, $content);
	
}