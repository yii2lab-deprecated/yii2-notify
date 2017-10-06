<?php

namespace yii2lab\notify\job;

use yii\base\Object;
use yii\queue\Job;

class EmailJob extends Object implements Job
{
	public $address;
	public $subject;
	public $content;
	
	public function execute($queue)
	{
		prr('--- cron email ---');
		prr($this,0,1);
	}
}
