<?php

namespace yii2lab\notify\admin\controllers;

use yii2lab\domain\data\Query;
use yii2lab\notify\domain\entities\TestEntity;

class EmailController extends BaseController
{
	
	const RENDER_INDEX = '@yii2lab/notify/admin/views/email/index';
	
	public $service = 'notify.email';
	public $formClass = 'yii2lab\notify\admin\forms\EmailForm';
	
	public function actions() {
		$actions = parent::actions();
		$actions['index'] = [
			'class' => self::ACTION_INDEX,
			'render' => self::RENDER_INDEX,
			//'query' => Query::forge()->where('type', TestEntity::TYPE_EMAIL)->orderBy(['created_at' => SORT_DESC]),
		];
		$actions['create'] = [
			'class' => self::ACTION_CREATE,
			'render' => self::RENDER_CREATE,
			'service' => \App::$domain->notify->email,
			'serviceMethod' => 'send',
			'serviceMethodParams' => ['address', 'subject', 'content'],
		];
		return $actions;
	}
	
}
