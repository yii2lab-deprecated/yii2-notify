<?php

namespace yii2lab\notify\domain\repositories\mock;

use yii2lab\domain\repositories\BaseRepository;
use yii2lab\notify\domain\entities\SmsEntity;
use yii2lab\notify\domain\interfaces\repositories\SmsInterface;

class SmsRepository extends BaseRepository implements SmsInterface {
	
	public function send(SmsEntity $message) {
		//prr('--- cron sms ---');
		//prr($message);
	}
	
}