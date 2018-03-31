<?php

namespace yii2lab\notify\domain\repositories\mock;

use yii2lab\domain\repositories\BaseRepository;
use yii2lab\notify\domain\entities\EmailEntity;
use yii2lab\notify\domain\interfaces\repositories\EmailInterface;

class EmailRepository extends BaseRepository implements EmailInterface {
	
	public function send(EmailEntity $message) {
		//prr('--- cron Email ---');
		//prr($message);
	}
	
}