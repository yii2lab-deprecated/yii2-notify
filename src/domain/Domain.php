<?php

namespace yii2lab\notify\domain;

use yii2lab\domain\enums\Driver;

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