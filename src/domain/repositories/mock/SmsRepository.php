<?php

namespace yii2lab\notify\domain\repositories\mock;

use yii2lab\domain\repositories\BaseRepository;
use yii2lab\notify\domain\entities\MessageEntity;

class SmsRepository extends BaseRepository {
	
	public function send(MessageEntity $message) {
		//prr('--- cron sms ---');
		//prr($message);
	}
	
}