<?php

namespace yii2lab\notify\domain\repositories\mock;

use yii2lab\domain\repositories\BaseRepository;
use yii2lab\notify\domain\entities\MessageEntity;
use yii2lab\notify\domain\interfaces\repositories\SendInterface;

class SmsRepository extends BaseRepository implements SendInterface {
	
	public function send(MessageEntity $message) {
		//prr('--- cron sms ---');
		//prr($message);
	}
	
}