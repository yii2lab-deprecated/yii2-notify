<?php

namespace yii2lab\notify\domain\repositories\rest;

use Yii;
use yii2lab\notify\domain\entities\PushEntity;
use yii2lab\notify\domain\interfaces\repositories\PushInterface;
use yii2lab\rest\domain\entities\ResponseEntity;
use yii2lab\rest\domain\repositories\base\BaseRestRepository;
use yii2woop\common\domain\account\v2\entities\FireUserEntity;

/**
 * Class PushRepository
 *
 * @package yii2lab\notify\domain\v1\repository
 *
 * @property \yii2lab\notify\domain\Domain $domain
 */
class PushRepository extends BaseRestRepository implements PushInterface
{

	/**
	 * @param $notification
	 *
	 * @return bool
	 */
	public function sendAll($notification)
	{
		$pushEntity = $this->prepareSend($notification);

		$usersList = \App::$domain->account->fireUser->all();
		$targetTokens = [];
		foreach ($usersList as $users) {
			if (!empty($users->device_token)) {
				$targetTokens[] = $users->device_token;
			}
		}
		$fireBase = new FireBaseSend();
		return $fireBase->sendMultiple($targetTokens, $pushEntity->toArray());
	}

	/**
	 * @param $notification
	 *
	 * @return bool
	 * @var FireUserEntity $fireUser
	 *
	 */
	public function send($id, $notification)
	{
		$pushEntity = $this->prepareSend($notification);
		$fireUser = \App::$domain->account->fireUser->oneById($id);
		$fireBase = new FireBaseSend();
		return $fireBase->send('dYxtWvqaR1A:APA91bEIhkotwlCtW0ld-7A22U3bMM5kMI4MPd8lahQkmo95hpO_zukxDrKY9fwcYutud5DufyeE-g-9L9BoWycXJC1CravdFNR-wTUnYjvTyAtuJBKOmL4vgd2LD1FIGUtbuCwiokaR'
			, $pushEntity->toArray());
	}

	private function prepareSend($notification)
	{
		$pushEntity = $this->forgeEntity($notification);
		$pushEntity->validate();
		return $pushEntity;
	}

	// todo:not work. function makes curl request to gcm servers
	private function sendPushNotification($fields)
	{
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
		if ($result->hasErrors()) {
			prr($result, 1, 1);
		}

		return true;
	}

	public function forgeEntity($data, $class = PushEntity::class)
	{
		if ($data instanceof ResponseEntity) {
			$data = $data->data;
		} elseif (empty($data)) {
			$data = [];
			return $this->domain->factory->entity->create($class, $data);
		}
		return parent::forgeEntity($data, $class);
	}
}
