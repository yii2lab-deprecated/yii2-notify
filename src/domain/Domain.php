<?php

namespace yii2lab\notify\domain;

use yii2lab\domain\enums\Driver;

/**
 * Class Domain
 *
 * @package yii2lab\notify\domain
 *
 * @property \yii2lab\notify\domain\interfaces\services\EmailInterface $email
 * @property \yii2lab\notify\domain\interfaces\services\SmsInterface $sms
 * @property \yii2lab\notify\domain\interfaces\services\TestInterface $test
 */
class Domain extends \yii2lab\domain\Domain {
	
	public function config() {
		return [
			'repositories' => [
				'transport',
				'email' => Driver::YII,
				'sms' => Driver::MOCK,
				'flash' => Driver::SESSION,
				'test' => Driver::FILEDB,
			],
			'services' => [
				'transport',
				'email',
				'sms',
				'flash',
				'test',
			],
		];
	}
	
}