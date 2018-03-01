<?php

namespace yii2lab\notify\admin\helpers;

use common\enums\rbac\PermissionEnum;
use yii2lab\extension\menu\interfaces\MenuInterface;
use yii2lab\notify\domain\helpers\JobHelper;

class Menu implements MenuInterface {
	
	public function toArray() {
		return [
			'label' => ['notify/main', 'title'],
			'module' => 'notify',
			'access' => PermissionEnum::NOTIFY_MANAGE,
			'icon' => 'bell-o',
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
