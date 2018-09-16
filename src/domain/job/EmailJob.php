<?php

namespace yii2lab\notify\domain\job;

use Yii;
use yii\base\BaseObject;
use yii\queue\JobInterface;

class EmailJob extends BaseObject implements JobInterface
{
	public $address;
	public $subject;
	public $content;
	
	public function execute($queue)
	{
		\App::$domain->notify->email->directSend($this->address, $this->subject, $this->content);
	}
}
