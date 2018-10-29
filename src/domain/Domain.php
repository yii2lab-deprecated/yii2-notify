<?php

namespace yii2lab\notify\domain;

use yii2lab\domain\enums\Driver;

/**
 * Class Domain
 * 
 * @package yii2lab\notify\domain
 * @property-read \yii2lab\notify\domain\interfaces\services\EmailInterface $email
 * @property-read \yii2lab\notify\domain\interfaces\services\SmsInterface $sms
 * @property-read \yii2lab\notify\domain\interfaces\services\TestInterface $test
 * @property-read \yii2lab\notify\domain\interfaces\repositories\RepositoriesInterface $repositories
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