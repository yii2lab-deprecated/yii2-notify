<?php

namespace yii2lab\notify\domain\job;

use App;
use yii\base\BaseObject;
use yii\queue\JobInterface;
use yii2lab\notify\domain\entities\EmailEntity;

class EmailJob extends BaseObject implements JobInterface {
	
	public $address;
	public $subject;
	public $content;
	public $attachments;
	
	public function execute($queue) {
		$email = new EmailEntity();
		$email->address = $this->address;
		$email->subject = $this->subject;
		$email->content = $this->content;
		$email->attachments = $this->attachments;
		App::$domain->notify->email->directSendEntity($email);
	}
}
