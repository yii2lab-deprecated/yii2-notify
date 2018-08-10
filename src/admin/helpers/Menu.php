<?php

namespace yii2lab\notify\admin\helpers;

use Yii;
use yii2lab\domain\data\Query;
use yii2lab\extension\menu\interfaces\MenuInterface;
use yii2lab\notify\domain\entities\TestEntity;
use yii2lab\notify\domain\enums\NotifyPermissionEnum;
use yii2lab\notify\domain\helpers\JobHelper;

class Menu implements MenuInterface {
	
	public function toArray() {
		$smsCount = Yii::$domain->notify->test->count(Query::forge()->where('type', TestEntity::TYPE_SMS));
		$emailCount = Yii::$domain->notify->test->count(Query::forge()->where('type', TestEntity::TYPE_EMAIL));
		$cronCount = count(JobHelper::getAll());
		$sumBadge = $smsCount + $emailCount + $cronCount;
		return [
			'label' => ['notify/main', 'title'],
			'module' => 'notify',
			'access' => NotifyPermissionEnum::MANAGE,
			'icon' => 'bell-o',
			'badge' => $sumBadge ?: null,
			'items' => [
				[
					'label' => ['notify/main', 'sms'],
					'url' => 'notify/sms',
					'badge' => $smsCount ?: null,
				],
				[
					'label' => ['notify/main', 'email'],
					'url' => 'notify/email',
					'badge' => $emailCount ?: null,
				],
				[
					'label' => ['notify/cron', 'title'],
					'url' => 'notify/cron',
					'badge' => $cronCount ?: null,
				],
			],
		];
	}
	
}
