<?php

namespace yii2lab\notify\admin\helpers;

// todo: отрефакторить - сделать нормальный интерфейс и родителя

use common\enums\rbac\PermissionEnum;
use yii2lab\notify\domain\helpers\JobHelper;

class Menu {
	
	static function getMenu() {
		return [
			'label' => ['notify/main', 'title'],
			'module' => 'notify',
			'access' => PermissionEnum::NOTIFY_MANAGE,
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
					'badge' => count(JobHelper::getAll()),
				],
			],
		];
	}
	
}
