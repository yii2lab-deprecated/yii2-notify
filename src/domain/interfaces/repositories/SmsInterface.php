<?php

namespace yii2lab\notify\domain\interfaces\repositories;

use yii2lab\notify\domain\entities\SmsEntity;

interface SmsInterface {
	
	public function send(SmsEntity $message);

}