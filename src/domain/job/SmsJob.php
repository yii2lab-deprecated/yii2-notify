<?php

namespace yii2lab\notify\domain\job;

use App;
use yii\base\BaseObject;
use yii\queue\JobInterface;

class SmsJob extends BaseObject implements JobInterface {
	
	public $address;
	public $content;
	
	public function execute($queue) {
		App::$domain->notify->sms->directSend($this->address, $this->content);
	}
}
