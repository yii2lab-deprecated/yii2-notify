<?php

namespace yii2lab\notify\api\v1\controllers;

use Yii;
use yii2lab\app\domain\filters\config\LoadRouteConfig;
use yii2lab\extension\web\helpers\Behavior;
use yii2lab\notify\domain\enums\NotifyPermissionEnum;
use yii2lab\notify\domain\interfaces\services\PushInterface;
use yii2lab\rest\domain\rest\Controller;

/**
 * Class FireController
 *
 * @package yii2woop\notify\api\v1\controllers
 *
 * @property PushInterface $service
 */
class FireConsoleController extends Controller {
	
	public $service = 'notify.push';
	
	/**
	 * @inheritdock
	 */
	public function behaviors() {
		return [
			'authenticator' => Behavior::auth([
				'push-all',
				'push',
				'Routes'
			]),
			'verb' => Behavior::verb($this->verbs()),
			Behavior::access(NotifyPermissionEnum::MANAGE),
		];
	}
	
	protected function verbs() {
		return [
			'push-all' => ['POST'],
			'push' => ['POST'],
		];
	}
	
	public function actionPushAll() {
		$body = Yii::$app->request->getBodyParams();
		return $this->service->sendAll($body);
	}
	
	public function actionPush($id) {
		$body = Yii::$app->request->getBodyParams();
		return $this->service->send($id,$body);
	}
	public function actionRoutes(){
		$confg = new LoadRouteConfig;
		return Yii::$app->getUrlManager()->rules;
	}
}
