<?php

namespace yii2lab\notify\domain\interfaces\repositories;

use yii2lab\notify\domain\entities\MessageEntity;

interface SendInterface {
	
	public function send(MessageEntity $message);

}