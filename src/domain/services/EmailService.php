<?php

namespace yii2lab\notify\domain\services;

use App;
use Yii;
use yii2lab\domain\services\ActiveBaseService;
use yii2lab\notify\domain\entities\EmailEntity;
use yii2lab\notify\domain\interfaces\services\EmailInterface;
use yii2lab\notify\domain\job\EmailJob;

/**
 * Class EmailService
 *
 * @package yii2lab\notify\domain\services
 *
 * @property \yii2lab\notify\domain\interfaces\repositories\EmailInterface $repository
 */
class EmailService extends ActiveBaseService implements EmailInterface {
	
	public $directOnly = false;
	
	public function sendEntity(EmailEntity $emailEntity) {
		if($this->directOnly) {
			$this->directSendEntity($emailEntity);
			return null;
		}
		$emailEntity->validate();
		return $this->createJob($emailEntity);
	}
	
	public function directSendEntity(EmailEntity $emailEntity) {
		$emailEntity->validate();
		$this->repository->send($emailEntity);
	}
	
	public function send($address, $subject, $content) {
		if($this->directOnly) {
			$this->directSend($address, $subject, $content);
			return null;
		}
		$emailEntity = new EmailEntity();
		$emailEntity->address = $address;
		$emailEntity->subject = $subject;
		$emailEntity->content = $content;
		$emailEntity->validate();
		$this->createJob($emailEntity);
	}
	
	public function directSend($address, $subject, $content) {
		$emailEntity = new EmailEntity();
		$emailEntity->address = $address;
		$emailEntity->subject = $subject;
		$emailEntity->content = $content;
		$this->repository->send($emailEntity);
	}

	public static function createView($view, array $params)
    {
        Yii::$app->mailer->viewPath = '@vendor/yii2woop/yii2-common/src/domain/notify/mail';
        $message = Yii::$app->mailer->compose($view, $params);
        $swiftMessage = $message->getSwiftMessage();
        $children = $swiftMessage->getChildren();
        foreach ($children as $child) {
            if ($child instanceof \Swift_MimePart && $child->getContentType() == 'text/html') {
                $body = $child->getBody();
                break;
            }
        }
        return $body;
    }

    public function tpsSend($login, $body, $email, $subject) {
        App::$domain->notify->repositories->email->tpsSend($login, $body, $email, $subject);
    }
	
	private function createJob(EmailEntity $emailEntity) {
		$job = Yii::createObject(EmailJob::class);
		Yii::configure($job, $emailEntity->toArray());
		$jobId = Yii::$app->queue->push($job);
		return $jobId;
	}
	
}
