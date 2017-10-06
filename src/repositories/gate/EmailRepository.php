<?php

namespace yii2lab\notify\repositories\gate;

use Yii;
use yii2lab\domain\repositories\BaseRepository;
use yii2lab\notify\entities\MessageEntity;
use yii2lab\notify\job\EmailJob;

class EmailRepository extends BaseRepository {
	
	public function send(MessageEntity $message) {
		$message->validate();
		$job = Yii::createObject(EmailJob::className());
		Yii::configure($job, $message->toArray());
		$jobId = Yii::$app->queue->push($job);
		return $jobId;
	}
	
}