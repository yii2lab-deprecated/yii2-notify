<?php

namespace yii2lab\notify\domain\repositories\mock;

use Yii;
use yii2lab\domain\repositories\BaseRepository;
use yii2lab\notify\domain\entities\EmailEntity;
use yii2lab\notify\domain\entities\TestEntity;
use yii2lab\notify\domain\interfaces\repositories\EmailInterface;

class EmailRepository extends BaseRepository implements EmailInterface {
	
	public function send(EmailEntity $message) {
		return \App::$domain->notify->test->send(TestEntity::TYPE_EMAIL, $message->address, $message->subject, $message->content);
	}
	
}