<?php

namespace yii2lab\notify\domain\repositories\yii;

use Yii;
use yii2lab\domain\repositories\BaseRepository;
use yii2lab\notify\domain\entities\EmailEntity;
use yii2lab\notify\domain\interfaces\repositories\EmailInterface;

class EmailRepository extends BaseRepository implements EmailInterface {
	
	public $email = null;
	
	public function send(EmailEntity $message) {
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