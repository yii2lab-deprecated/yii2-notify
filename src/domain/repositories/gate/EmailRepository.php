<?php

namespace yii2lab\notify\domain\repositories\gate;

use yii2lab\domain\repositories\BaseRepository;
use yii2lab\notify\domain\entities\MessageEntity;

class EmailRepository extends BaseRepository {
	
	public function send(MessageEntity $message) {
		prr('--- cron Email ---');
		prr($message,1,1);
	}
	
}