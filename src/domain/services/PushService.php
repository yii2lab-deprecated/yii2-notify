<?php

namespace yii2lab\notify\domain\services;

use yii2lab\domain\services\ActiveBaseService;
use yii2lab\domain\services\base\BaseActiveService;
use yii2lab\notify\domain\entities\FlashEntity;
use yii2lab\notify\domain\interfaces\services\PushInterface;
use yii2lab\notify\domain\widgets\Alert;

/**
 * Class PushService
 *
 * @package yii2lab\notify\domain\services
 *
 * @property \yii2lab\notify\domain\interfaces\repositories\PushInterface $repository
 */
class PushService extends BaseActiveService implements PushInterface{
	
	public function sendAll($body) {
		return $this->repository->sendAll($body);
	}
	public function send($id,$body) {
		return $this->repository->send($id,$body);
	}
}
