<?php

namespace yii2lab\notify\domain\interfaces\services;

interface SmsInterface {
	
	public function send($address, $content);

}