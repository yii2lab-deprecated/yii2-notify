<?php

namespace yii2lab\notify\domain\repositories\yii;

use Yii;
use yii2lab\domain\repositories\BaseRepository;
use yii2lab\notify\domain\entities\EmailEntity;
use yii2lab\notify\domain\interfaces\repositories\EmailInterface;

class EmailRepository extends BaseRepository implements EmailInterface {
	
	public $email = null;
	/**
	 * @var yii\mail\MailerInterface
	 */
	private $_mailerInstance;
	
	public function send(EmailEntity $message) {
		$mailer = $this->mailerInstance()->compose();
		if(!empty($this->email)) {
			$mailer->setFrom($this->email);
		}
		$mailer->setTo($message->address);
		$mailer->setSubject($message->subject);
		$mailer->setTextBody($message->content);
		$mailer->setHtmlBody($message->content);
		if($message->attachments) {
			foreach($message->attachments as $attachmentEntity) {
				if($attachmentEntity->content) {
					$mailer->attachContent($attachmentEntity->content, [
						'fileName' => basename($attachmentEntity->fileName),
						'contentType' => $attachmentEntity->contentType,
					]);
				} else {
					$mailer->attach($attachmentEntity->fileName);
				}
			}
		}
		//prr($message->attachments,1,1);
		return $mailer->send();
	}
	
	private function mailerInstance() {
		if(! $this->_mailerInstance instanceof yii\mail\MailerInterface) {
			$this->_mailerInstance = Yii::createObject('yii2lab\notify\domain\mailer\Mailer');
		}
		return $this->_mailerInstance;
	}
	
}