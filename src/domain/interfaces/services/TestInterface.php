<?php

namespace yii2lab\notify\domain\interfaces\services;

interface TestInterface {
	
	public function send($type, $address, $subject, $message);
	
}