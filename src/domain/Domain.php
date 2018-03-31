<?php

namespace yii2lab\notify\domain;

use yii2lab\domain\enums\Driver;

/**
 * Class Domain
 *
 * @package yii2lab\notify\domain
 *
 * @property \yii2lab\notify\domain\services\EmailService $email
 * @property \yii2lab\notify\domain\services\SmsService $sms
 */
class Domain extends \yii2lab\domain\Domain {
	
	public function config() {
		return [
			'repositories' => [
				'transport',
				'email' => Driver::YII,
				'sms' => Driver::MOCK,
				'flash' => Driver::SESSION,
			],
			'services' => [
				'transport',
				'email',
				'sms',
				'flash',
			],
		];
	}
	
}