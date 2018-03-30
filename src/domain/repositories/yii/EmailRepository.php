<?php

namespace yii2lab\notify\domain\repositories\yii;

use Yii;
use yii2lab\domain\repositories\BaseRepository;
use yii2lab\notify\domain\entities\MessageEntity;
use yii2lab\notify\domain\interfaces\repositories\SendInterface;

class EmailRepository extends BaseRepository implements SendInterface {
	
	public $email = null;
	
	public function send(MessageEntity $message) {
		$mailer = Yii::$app->mailer->compose();
		if(!empty($this->email)) {
			$mailer->setFrom($this->email);
		}
		$mailer->setTo($message->address);
		$mailer->setSubject($message->subject);
		$mailer->setTextBody($message->content);
		$mailer->setHtmlBody($message->content);
		return $mailer->send();
	}
	
}