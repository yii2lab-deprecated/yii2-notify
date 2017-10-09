<?php

namespace yii2lab\notify\domain\repositories\gate;

use yii2lab\domain\repositories\BaseRepository;
use yii2lab\notify\domain\entities\MessageEntity;

class SmsRepository extends BaseRepository {
	
	public function send(MessageEntity $message) {
		prr('--- cron sms ---');
		prr($message,1,1);
	}
	
}