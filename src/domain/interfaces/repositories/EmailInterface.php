<?php

namespace yii2lab\notify\domain\interfaces\repositories;

use yii2lab\notify\domain\entities\EmailEntity;

interface EmailInterface {
	
	public function send(EmailEntity $message);

}