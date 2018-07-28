<?php

namespace yii2lab\notify\domain\mailer;

use yii2lab\app\domain\helpers\EnvService;

class Mailer extends \yii\swiftmailer\Mailer {
	
	public $viewPath = '@common/mail';
	public $htmlLayout = '@yii2lab/notify/domain/mail/layouts/html';
	public $textLayout = '@yii2lab/notify/domain/mail/layouts/text';
	public $useFileTransport = YII_DEBUG;
	public $fileTransportPath = '@common/runtime/mail';
	
	public function __construct(array $config = []) {
		$config['transport'] = EnvService::getServer('mail');
		$config['transport']['class'] = 'Swift_SmtpTransport';
		parent::__construct($config);
	}
}
