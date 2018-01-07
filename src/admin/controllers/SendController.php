<?php

namespace yii2lab\notify\admin\controllers;

use common\enums\rbac\PermissionEnum;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii2lab\domain\exceptions\UnprocessableEntityHttpException;
use yii2lab\helpers\Behavior;
use yii2lab\notify\admin\forms\MessageForm;

class SendController extends Controller
{
	
	public function behaviors()
	{
		return [
			'access' => Behavior::access(PermissionEnum::NOTIFY_MANAGE),
		];
	}
	
	public function actionSms() {
		$model = new MessageForm();
		if(Yii::$app->request->isPost) {
			$body = Yii::$app->request->post('MessageForm');
			$model->setAttributes($body, false);
			try {
				Yii::$app->notify->sms->send($model->address, $model->content);
				Yii::$app->notify->flash->send(['notify/main', 'message_success_send']);
			} catch (UnprocessableEntityHttpException $e){
				$model->addErrorsFromException($e);
			}
		}
		return $this->render('sms', ['model' => $model]);
	}
	
	public function actionEmail() {
		$model = new MessageForm();
		if(Yii::$app->request->isPost) {
			$body = Yii::$app->request->post('MessageForm');
			$model->setAttributes($body, false);
			try {
				Yii::$app->notify->email->send($model->address, $model->subject, $model->content);
				Yii::$app->notify->flash->send(['notify/main', 'message_success_send']);
			} catch (UnprocessableEntityHttpException $e){
				$model->addErrorsFromException($e);
			}
		}
		return $this->render('email', ['model' => $model]);
	}
}
