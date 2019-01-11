<?php

namespace yii2lab\notify\domain\repositories\rest;

use Yii;
use yii2lab\domain\exceptions\UnprocessableEntityHttpException;
use yii2lab\domain\helpers\ErrorCollection;
use yii2lab\notify\domain\entities\PushEntity;
use yii2lab\notify\domain\interfaces\repositories\PushInterface;
use yii2lab\rest\domain\repositories\base\BaseRestRepository;
use yii2woop\common\domain\account\v2\entities\FireUserEntity;

/**
 * Class PushRepository
 *
 * @package yii2lab\notify\domain\v1\repository
 *
 * @property \yii2lab\notify\domain\Domain $domain
 */
class PushRepository extends BaseRestRepository implements PushInterface{
	
	/**
	 * @param $notification
	 *
	 * @return bool
	 */
	public function sendAll($notification) {
		$pushEntity = $this->forgeEntity($notification);
		
		$usersList = \App::$domain->account->fireUser->all();
		$targetTokens = [];
		foreach($usersList as $users) {
			if(!empty($users->device_token)) {
				$targetTokens[] = $users->device_token;
			}
		}
		$fields = [
			'to' => $targetTokens,
			'data' => $pushEntity->toArray(),
		];
		return $this->sendPushNotification($fields);
	}
	
	/**
	 * @param $notification
	 *
	 * @var FireUserEntity $fireUser
	 *
	 * @return bool
	 */
	public function send($id, $notification) {
		$pushEntity = $this->prepareSend($notification);
		$fireUser = \App::$domain->account->fireUser->oneById($id);
		//$fields = [
		//	'to' => $fireUser->device_token,
		//
		//	'notification' => $pushEntity->toArray()
		//];
		$fireBase = new FireBaseSend();

		return $fireBase->send( $fireUser->device_token, $pushEntity->toArray());
		//return $this->sendPushNotification($fields);
	}
	
	private function prepareSend($notification){
		$pushEntity = $this->forgeEntity($notification);
		$pushEntity->validate();
		return $pushEntity;
	}
	
	
	// Sending message to a topic by topic id
	public function sendToTopic($to, $message) {
		$fields = [
			'to' => '/topics/' . $to,
			'data' => $message,
		];
		return $this->sendPushNotification($fields);
	}
	
	// function makes curl request to gcm servers
	private function sendPushNotification($fields) {
		$api_key = Yii::$app->params['FIRE_BASE_PROJECT_NAME'];
		// Set POST variables
		$url = 'https://fcm.googleapis.com/fcm/send';
		$headers = [
			'Authorization: key=' . $api_key,
			'Content-Type: application/json',
		];
		$result = $this->post($url, $fields, $headers, [
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYPEER => false,
		]);
		if($result->hasErrors()){
			prr($result,1,1);
		}
		
		return true;
	}
}
