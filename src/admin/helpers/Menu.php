<?php

namespace yii2lab\notify\admin\helpers;

// todo: отрефакторить - сделать нормальный интерфейс и родителя

class Menu {
	
	static function getMenu() {
		return [
			'label' => t('notify/main', 'title'),
			'icon' => 'bell',
			'items' => [
				[
					'label' => ['notify/main', 'sms'],
					'url' => 'notify/send/sms',
				],
				[
					'label' => ['notify/main', 'email'],
					'url' => 'notify/send/email',
				],
				[
					'label' => ['notify/cron', 'title'],
					'url' => 'notify/cron',
				],
			],
		];
	}
	
}
